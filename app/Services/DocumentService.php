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

class DocumentService
{
    static function handleDistributionGrid(Document $document, $distributions)
    {
        try {

            $existing_distribution_grid = DocumentGridData::where('document_id', $document->id)->get();

            foreach ($existing_distribution_grid as $grid)
            {
                $grid->delete();
            }

            foreach ($distributions as $key => $distribution)
            {
                $document_distribution_grid = new DocumentGridData();
                $document_distribution_grid->document_id = $document->id;
                $document_distribution_grid->document_title = isset($distribution['document_title']) ? $distribution['document_title'] : '';
                $document_distribution_grid->document_number = isset($distribution['document_number']) ? $distribution['document_number'] : '';
                $document_distribution_grid->document_printed_by = isset($distribution['document_printed_by']) ? $distribution['document_printed_by'] : '';
                $document_distribution_grid->document_printed_on = isset($distribution['document_printed_on']) ? $distribution['document_printed_on'] : '';
                $document_distribution_grid->document_printed_copies = isset($distribution['document_printed_copies']) ? $distribution['document_printed_copies'] : '';
                $document_distribution_grid->issuance_date = isset($distribution['issuance_date']) ? $distribution['issuance_date'] : '';
                $document_distribution_grid->issuance_to = isset($distribution['issuance_to']) ? $distribution['issuance_to'] : '';
                $document_distribution_grid->location = isset($distribution['location']) ? $distribution['location'] : '';
                $document_distribution_grid->issued_copies = isset($distribution['issued_copies']) ? $distribution['issued_copies'] : '';
                $document_distribution_grid->issued_reason = isset($distribution['issued_reason']) ? $distribution['issued_reason'] : '';
                $document_distribution_grid->retrieval_date = isset($distribution['retrieval_date']) ? $distribution['retrieval_date'] : '';
                $document_distribution_grid->retrieval_by = isset($distribution['retrieval_by']) ? $distribution['retrieval_by'] : '';
                $document_distribution_grid->retrieved_department = isset($distribution['retrieved_department']) ? $distribution['retrieved_department'] : '';
                $document_distribution_grid->retrieved_copies = isset($distribution['retrieved_copies']) ? $distribution['retrieved_copies'] : '';
                $document_distribution_grid->retrieved_reason =  isset($distribution['retrieved_reason']) ? $distribution['retrieved_reason'] : '';
                $document_distribution_grid->remark = isset($distribution['remark']) ? $distribution['remark'] : '';
                $document_distribution_grid->save();
            }
        } catch (\Exception $e) {
            info('Error in DocumentService@handleDistributionGrid', [
                'message' => $e->getMessage(),
                'object' => $e
            ]);
        }
    }

    static function update_document_numbers()
    {
        try {
            
            $document_types = DocumentType::all();

            foreach ($document_types as $document_type)
            {
                $documents = Document::where('document_type_id', $document_type->id)->get();

                $record_number = 0;

                foreach ($documents as $document)
                {
                    if ($document->revised !== 'Yes') {
                        $record_number++;
                        $document->document_number = $record_number; 
                        $document->save();
                    } else {
                        $parent_document = Document::find($document->revised_doc);
                        if ($parent_document) {
                            $document->document_number = $parent_document->document_number;
                            $document->save();
                        }
                    }
                }
            }

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    static function update_qms_numbers()
    {
        try {

            $divisions = QMSDivision::all();

            foreach ($divisions as $division)
            {
                $capas = Capa::where('division_id', $division->id)->get();
                $extensions = Extension::where('division_id', $division->id)->get();
                $change_controls = CC::where('division_id', $division->id)->get();

                $capa_record_number = 1;
                $extensions_record_number = 1;
                $change_controls_record_number = 1;

                foreach ($capas as $capa)
                {
                    if ($capa->record_number) {
                        $r_n = $capa->record_number;
                        $r_n->record_number = $capa_record_number;
                    } else {
                        $r_n = new QmsRecordNumber;
                        $r_n->record_number = $capa_record_number;
                    }

                    $r_n->save();

                    $capa->record_number()->save($r_n);

                    $capa_record_number++;
                }

                foreach ($extensions as $extension)
                {
                    if ($extension->record_number) {
                        $r_n = $extension->record_number;
                        $r_n->record_number = $extensions_record_number;
                    } else {
                        $r_n = new QmsRecordNumber;
                        $r_n->record_number = $extensions_record_number;
                    }

                    $r_n->save();

                    $extension->record_number()->save($r_n);

                    $extensions_record_number++;
                }
                
                foreach ($change_controls as $change_control)
                {
                    if ($change_control->record_number) {
                        $r_n = $change_control->record_number;
                        $r_n->record_number = $change_controls_record_number;
                    } else {
                        $r_n = new QmsRecordNumber;
                        $r_n->record_number = $change_controls_record_number;
                    }

                    $r_n->save();

                    $change_control->record_number()->save($r_n);

                    $change_controls_record_number++;
                }



            }
            

            $record_number = 1;
            foreach ($capas as $capa)
            {
                $record_number++;
            }

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


}