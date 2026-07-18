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
        $distributions
    ): void {
        if (empty($distributions) || !is_array($distributions)) {
            return;
        }

        DB::transaction(function () use ($document, $distributions) {

            foreach ($distributions as $index => $distribution) {

                /*
                |--------------------------------------------------------------------------
                | History source
                |--------------------------------------------------------------------------
                */

                $historyType = trim(
                    (string) ($distribution['history_type'] ?? '')
                );

                $historyId = !empty($distribution['history_id'])
                    ? (int) $distribution['history_id']
                    : null;

                if (
                    !in_array($historyType, ['print', 'download'], true)
                    || !$historyId
                ) {
                    throw new \RuntimeException(
                        'Row ' . ($index + 1) .
                        ': Distribution history reference missing.'
                    );
                }

                /*
                |--------------------------------------------------------------------------
                | Create or update grid record
                |--------------------------------------------------------------------------
                */

                $grid = DocumentGridData::firstOrNew([
                    'document_id' => $document->id,
                    'history_type' => $historyType,
                    'history_id' => $historyId,
                ]);

                $grid->document_id = $document->id;
                $grid->history_type = $historyType;
                $grid->history_id = $historyId;

                /*
                |--------------------------------------------------------------------------
                | Distribution section
                |--------------------------------------------------------------------------
                */

                $grid->document_title = self::nullableString(
                    $distribution['document_title']
                        ?? $document->document_name
                );

                $grid->document_number = self::nullableString(
                    $distribution['document_number']
                        ?? $document->document_number
                );

                $grid->document_printed_by = self::nullableInteger(
                    $distribution['issued_by'] ?? null
                );

                $issuedDate = self::nullableDate(
                    $distribution['issued_date'] ?? null
                );

                $grid->document_printed_on = $issuedDate;
                $grid->issuance_date = $issuedDate;

                $issuedCopies = self::nullableInteger(
                    $distribution['issued_copies'] ?? null
                );

                $grid->document_printed_copies = $issuedCopies;
                $grid->issued_copies = $issuedCopies;

                $grid->issuance_to = self::nullableInteger(
                    $distribution['issued_to'] ?? null
                );

                $grid->issued_reason = self::nullableString(
                    $distribution['issued_reason'] ?? null
                );

                $grid->location = self::nullableString(
                    $distribution['location'] ?? null
                );

                /*
                |--------------------------------------------------------------------------
                | Retrieval section
                |--------------------------------------------------------------------------
                */

                $retrievedCopies = self::nullableInteger(
                    $distribution['retrieved_copies'] ?? null
                );

                if (
                    $retrievedCopies !== null
                    && $issuedCopies !== null
                    && $retrievedCopies > $issuedCopies
                ) {
                    throw new \RuntimeException(
                        'Row ' . ($index + 1) .
                        ': Retrieved copies issued copies se zyada nahi ho sakti.'
                    );
                }

                $grid->retrieved_copies = $retrievedCopies;

                $grid->retrieval_by = self::nullableInteger(
                    $distribution['retrieval_by'] ?? null
                );

                $grid->retrieval_date = self::nullableDate(
                    $distribution['retrieval_date'] ?? null
                );

                $grid->retrieved_reason = self::nullableString(
                    $distribution['retrieved_reason'] ?? null
                );

                $grid->retrieved_department = self::nullableString(
                    $distribution['retrieved_department'] ?? null
                );

                /*
                |--------------------------------------------------------------------------
                | Destruction section
                |--------------------------------------------------------------------------
                */

                $destructedCopies = self::nullableInteger(
                    $distribution['destructed_copies'] ?? null
                );

                if (
                    $destructedCopies !== null
                    && $retrievedCopies === null
                ) {
                    throw new \RuntimeException(
                        'Row ' . ($index + 1) .
                        ': Destruction se pehle retrieved copies enter karo.'
                    );
                }

                if (
                    $destructedCopies !== null
                    && $retrievedCopies !== null
                    && $destructedCopies > $retrievedCopies
                ) {
                    throw new \RuntimeException(
                        'Row ' . ($index + 1) .
                        ': Destructed copies retrieved copies se zyada nahi ho sakti.'
                    );
                }

                $grid->destructed_by = self::nullableInteger(
                    $distribution['destructed_by'] ?? null
                );

                $grid->destruction_date = self::nullableDate(
                    $distribution['destruction_date'] ?? null
                );

                $grid->destructed_copies = $destructedCopies;

                $grid->destruction_reason = self::nullableString(
                    $distribution['destruction_reason'] ?? null
                );

                $grid->remark = self::nullableString(
                    $distribution['remark'] ?? null
                );

                $grid->save();
            }
        });
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