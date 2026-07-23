<?php

namespace App\Services;

use App\Models\Capa;
use App\Models\CC;
use App\Models\Document;
use App\Models\DocumentGridData;
use App\Models\DocumentType;
use App\Models\Extension;
use App\Models\QMSDivision;
use App\Models\QmsRecordNumber;
use App\Models\RecordNumber;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DocumentService
{
    public static function handleDistributionGrid(
        Document $document,
        $distributions): void {
        if (
            empty($distributions)
            || !is_array($distributions)
        ) {
            return;
        }

        foreach ($distributions as $index => $distribution) {

            /*
            |--------------------------------------------------------------------------
            | History source
            |--------------------------------------------------------------------------
            */

            $historyType = trim(
                (string) (
                    $distribution['history_type']
                    ?? ''
                )
            );

            $historyId = !empty(
                $distribution['history_id']
            )
                ? (int) $distribution['history_id']
                : null;

            $copyNumber = !empty(
                $distribution['copy_number']
            )
                ? (int) $distribution['copy_number']
                : null;

            if (
                !in_array(
                    $historyType,
                    ['print', 'download'],
                    true
                )
                || !$historyId
                || !$copyNumber
            ) {
                throw new \RuntimeException(
                    'Row '
                    . ($index + 1)
                    . ': Distribution history or copy number missing.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Retrieval status
            |--------------------------------------------------------------------------
            */

            $retrievalStatus = self::nullableString(
                $distribution['retrieval_status']
                ?? null
            );

            if (
                $retrievalStatus !== null
                && !in_array(
                    $retrievalStatus,
                    ['Retrieved', 'Used'],
                    true
                )
            ) {
                throw new \RuntimeException(
                    'Row '
                    . ($index + 1)
                    . ': Invalid retrieval status.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Find copy-specific record
            |--------------------------------------------------------------------------
            */

            $grid = DocumentGridData::firstOrNew([
                'document_id' =>
                    $document->id,

                'history_type' =>
                    $historyType,

                'history_id' =>
                    $historyId,

                'copy_number' =>
                    $copyNumber,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Do not allow changing completed retrieval status
            |--------------------------------------------------------------------------
            */

            if (
                !empty($grid->retrieval_status)
                && $retrievalStatus !== null
                && $grid->retrieval_status !== $retrievalStatus
            ) {
                throw new \RuntimeException(
                    'Row '
                    . ($index + 1)
                    . ': Retrieval status is already completed and cannot be changed.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Basic identity
            |--------------------------------------------------------------------------
            */

            $grid->document_id =
                $document->id;

            $grid->history_type =
                $historyType;

            $grid->history_id =
                $historyId;

            $grid->copy_number =
                $copyNumber;

            $grid->request_id =
                self::nullableString(
                    $distribution['request_id']
                    ?? null
                );

            /*
            |--------------------------------------------------------------------------
            | Distribution data - locked values
            |--------------------------------------------------------------------------
            */

            $grid->document_title =
                self::nullableString(
                    $distribution['document_title']
                    ?? $document->document_name
                );

            $grid->document_number =
                self::nullableString(
                    $distribution['document_number']
                    ?? $document->document_number
                );

            $grid->document_printed_by =
                self::nullableInteger(
                    $distribution['issued_by']
                    ?? null
                );

            $issuedDate = self::nullableDate(
                $distribution['issued_date']
                ?? null
            );

            $grid->document_printed_on =
                $issuedDate;

            $grid->issuance_date =
                $issuedDate;

            /*
            |--------------------------------------------------------------------------
            | Every row represents exactly one copy
            |--------------------------------------------------------------------------
            */

            $grid->document_printed_copies = 1;
            $grid->issued_copies = 1;

            $grid->issuance_to =
                self::nullableInteger(
                    $distribution['issued_to']
                    ?? null
                );

            $grid->issued_reason =
                self::nullableString(
                    $distribution['issued_reason']
                    ?? null
                );

            $grid->location =
                self::nullableString(
                    $distribution['location']
                    ?? null
                );

            /*
            |--------------------------------------------------------------------------
            | No retrieval status selected
            |--------------------------------------------------------------------------
            |
            | Only distribution data is stored.
            |--------------------------------------------------------------------------
            */

            if ($retrievalStatus === null) {
                $grid->save();
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Retrieval details required
            |--------------------------------------------------------------------------
            */

            $retrievalBy = self::nullableInteger(
                $distribution['retrieval_by']
                ?? null
            );

            $retrievalDate = self::nullableDate(
                $distribution['retrieval_date']
                ?? null
            );

            $retrievalReason = self::nullableString(
                $distribution['retrieved_reason']
                ?? null
            );

            if (!$retrievalBy) {
                throw new \RuntimeException(
                    'Row '
                    . ($index + 1)
                    . ': Retrieved/Used By is required.'
                );
            }

            if (!$retrievalDate) {
                throw new \RuntimeException(
                    'Row '
                    . ($index + 1)
                    . ': Retrieval/Used Date is required.'
                );
            }

            if (!$retrievalReason) {
                throw new \RuntimeException(
                    'Row '
                    . ($index + 1)
                    . ': Retrieval/Used Reason is required.'
                );
            }

            $grid->retrieval_status =
                $retrievalStatus;

            $grid->retrieval_by =
                $retrievalBy;

            $grid->retrieval_date =
                $retrievalDate;

            $grid->retrieved_reason =
                $retrievalReason;

            /*
            |--------------------------------------------------------------------------
            | Compatibility with old numeric columns
            |--------------------------------------------------------------------------
            */

            if ($retrievalStatus === 'Retrieved') {
                $grid->retrieved_copies = 1;
                $grid->used_copies = 0;
            }

            if ($retrievalStatus === 'Used') {
                $grid->retrieved_copies = 0;
                $grid->used_copies = 1;
            }

            /*
            |--------------------------------------------------------------------------
            | Used copy can never move to destruction
            |--------------------------------------------------------------------------
            */

            if ($retrievalStatus === 'Used') {

                $grid->destructed_by = null;
                $grid->destruction_date = null;
                $grid->destructed_copies = null;
                $grid->destruction_reason = null;

                $grid->save();

                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Retrieved copy destruction section
            |--------------------------------------------------------------------------
            */

            $destructedBy = self::nullableInteger(
                $distribution['destructed_by']
                ?? null
            );

            $destructionDate = self::nullableDate(
                $distribution['destruction_date']
                ?? null
            );

            $destructionReason = self::nullableString(
                $distribution['destruction_reason']
                ?? null
            );

            /*
            |--------------------------------------------------------------------------
            | If destruction has not started, save retrieval only
            |--------------------------------------------------------------------------
            */

            $hasDestructionData =
                $destructedBy !== null
                || $destructionDate !== null
                || $destructionReason !== null;

            if (!$hasDestructionData) {

                $grid->destructed_copies = null;
                $grid->save();

                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Complete destruction details required together
            |--------------------------------------------------------------------------
            */

            if (!$destructedBy) {
                throw new \RuntimeException(
                    'Row '
                    . ($index + 1)
                    . ': Destructed By is required.'
                );
            }

            if (!$destructionDate) {
                throw new \RuntimeException(
                    'Row '
                    . ($index + 1)
                    . ': Destruction Date is required.'
                );
            }

            if (!$destructionReason) {
                throw new \RuntimeException(
                    'Row '
                    . ($index + 1)
                    . ': Destruction Reason is required.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | One row means one destroyed physical copy
            |--------------------------------------------------------------------------
            */

            $grid->destructed_by =
                $destructedBy;

            $grid->destruction_date =
                $destructionDate;

            $grid->destructed_copies = 1;

            $grid->destruction_reason =
                $destructionReason;

            $grid->remark =
                self::nullableString(
                    $distribution['remark']
                    ?? null
                );

            $grid->save();
        }
    }

    private static function nullableString($value): ?string
    {
        if ($value === null) {
            return null;
        }

        $value = trim((string) $value);

        return $value === '' ? null : $value;
    }

    private static function nullableInteger($value): ?int
    {
        if ($value === null || $value === '') {
            return null;
        }

        return (int) $value;
    }

    private static function nullableDate($value): ?string
    {
        if ($value === null || trim((string) $value) === '') {
            return null;
        }

        return \Carbon\Carbon::parse($value)->format('Y-m-d');
    }
    public static function update_document_numbers()
    {
        try {
            $document_types = DocumentType::all();

            foreach ($document_types as $document_type) {
                $documents = Document::where(
                    'document_type_id',
                    $document_type->id
                )->get();

                $record_number = 0;

                foreach ($documents as $document) {
                    if ($document->revised !== 'Yes') {
                        $record_number++;
                        $document->document_number = $record_number;
                        $document->save();
                    } else {
                        $parent_document = Document::find(
                            $document->revised_doc
                        );

                        if ($parent_document) {
                            $document->document_number =
                                $parent_document->document_number;

                            $document->save();
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public static function update_qms_numbers()
    {
        try {
            $divisions = QMSDivision::all();

            foreach ($divisions as $division) {
                $capas = Capa::where(
                    'division_id',
                    $division->id
                )->get();

                $extensions = Extension::where(
                    'division_id',
                    $division->id
                )->get();

                $change_controls = CC::where(
                    'division_id',
                    $division->id
                )->get();

                $capa_record_number = 1;
                $extensions_record_number = 1;
                $change_controls_record_number = 1;

                foreach ($capas as $capa) {
                    if ($capa->record_number) {
                        $record = $capa->record_number;
                        $record->record_number =
                            $capa_record_number;
                    } else {
                        $record = new QmsRecordNumber();
                        $record->record_number =
                            $capa_record_number;
                    }

                    $record->save();
                    $capa->record_number()->save($record);

                    $capa_record_number++;
                }

                foreach ($extensions as $extension) {
                    if ($extension->record_number) {
                        $record = $extension->record_number;
                        $record->record_number =
                            $extensions_record_number;
                    } else {
                        $record = new QmsRecordNumber();
                        $record->record_number =
                            $extensions_record_number;
                    }

                    $record->save();
                    $extension->record_number()->save($record);

                    $extensions_record_number++;
                }

                foreach ($change_controls as $changeControl) {
                    if ($changeControl->record_number) {
                        $record = $changeControl->record_number;
                        $record->record_number =
                            $change_controls_record_number;
                    } else {
                        $record = new QmsRecordNumber();
                        $record->record_number =
                            $change_controls_record_number;
                    }

                    $record->save();
                    $changeControl->record_number()->save($record);

                    $change_controls_record_number++;
                }
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}