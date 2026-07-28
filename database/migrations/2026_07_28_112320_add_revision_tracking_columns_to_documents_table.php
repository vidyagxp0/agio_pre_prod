<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('documents', function (Blueprint $table) {

            $table->string(
                'base_document_number',
                255
            )
            ->nullable()
            ->after('document_number');

            $table->string(
                'supersedes_no',
                255
            )
            ->nullable()
            ->after('base_document_number');
        });

        /*
        |--------------------------------------------------------------------------
        | Existing records ka base document number update
        |--------------------------------------------------------------------------
        |
        | FPS/QC/001-00 => FPS/QC/001
        | FPS/QC/001-01 => FPS/QC/001
        |--------------------------------------------------------------------------
        */

        DB::table('documents')
            ->select(
                'id',
                'document_number'
            )
            ->whereNotNull('document_number')
            ->orderBy('id')
            ->chunkById(
                200,
                function ($documents) {

                    foreach ($documents as $document) {

                        $documentNumber =
                            trim(
                                (string) $document->document_number
                            );

                        if ($documentNumber === '') {
                            continue;
                        }

                        $baseDocumentNumber =
                            preg_replace(
                                '/-\d{2,}$/',
                                '',
                                $documentNumber
                            );

                        DB::table('documents')
                            ->where(
                                'id',
                                $document->id
                            )
                            ->update([
                                'base_document_number' =>
                                    $baseDocumentNumber,
                            ]);
                    }
                }
            );

        /*
        |--------------------------------------------------------------------------
        | Existing revisions ka supersedes number set karna
        |--------------------------------------------------------------------------
        |
        | Ye existing records ko base number aur revision sequence ke according
        | automatically link karega.
        |--------------------------------------------------------------------------
        */

        $allDocuments = DB::table('documents')
            ->select(
                'id',
                'document_number',
                'base_document_number'
            )
            ->whereNotNull('document_number')
            ->orderBy('id')
            ->get()
            ->groupBy('base_document_number');

        foreach (
            $allDocuments
            as $baseDocumentNumber => $documents
        ) {
            $revisionDocuments = [];

            foreach ($documents as $document) {

                $revisionNumber = 0;

                if (
                    preg_match(
                        '/-(\d{2,})$/',
                        $document->document_number,
                        $matches
                    )
                ) {
                    $revisionNumber =
                        (int) $matches[1];
                }

                $revisionDocuments[] = [
                    'id' =>
                        $document->id,

                    'document_number' =>
                        $document->document_number,

                    'revision_number' =>
                        $revisionNumber,
                ];
            }

            usort(
                $revisionDocuments,
                function ($first, $second) {
                    return $first['revision_number']
                        <=> $second['revision_number'];
                }
            );

            $previousDocumentNumber = null;

            foreach ($revisionDocuments as $revisionDocument) {

                DB::table('documents')
                    ->where(
                        'id',
                        $revisionDocument['id']
                    )
                    ->update([
                        'supersedes_no' =>
                            $revisionDocument['revision_number'] > 0
                                ? $previousDocumentNumber
                                : null,
                    ]);

                $previousDocumentNumber =
                    $revisionDocument['document_number'];
            }
        }
    }

    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn([
                'base_document_number',
                'supersedes_no',
            ]);
        });
    }
};