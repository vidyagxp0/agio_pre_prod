   <!--Start Checklist - Investigation of Bacterial Endotoxin Test CCForm18 -->
    @php
        $toText = function ($v) {
            if (is_array($v)) {
                $v = array_map(fn($x) => is_array($x) ? json_encode($x) : $x, $v);
                return implode(', ', array_filter($v, fn($x) => trim((string) $x) !== ''));
            }
            return trim(strip_tags((string) $v));
        };

        // Micro: $gridKey do (Helpers wali key)   |   Chemical: $grid do ($ph_meters etc.)
        $renderChecklist = function ($title, $questions, $gridKey = null, $grid = null) use ($data, $filled, $toText) {
            $questions = is_array($questions) ? $questions : [];

            $gridData = [];
            if (!$gridKey) {
                $raw = $grid->data ?? null;
                $gridData = is_string($raw) ? (json_decode($raw, true) ?: []) : (is_array($raw) ? $raw : []);
            }

            $main = 2.0; $sub = 0; $rowsHtml = '';

            foreach ($questions as $i => $q) {
                $text  = is_array($q) ? $q['question'] : $q;
                $isSub = is_array($q) && !empty($q['is_sub_question']);

                if ($isSub) { $sub++; } else { $sub = 0; $main += 0.1; }

                if ($gridKey) {
                    try {
                        $res = Helpers::getChemicalGridData($data, $gridKey, true, 'response', true, $i);
                        $rem = Helpers::getChemicalGridData($data, $gridKey, true, 'remark', true, $i);
                    } catch (\Throwable $e) {
                        $res = null; $rem = null;
                    }
                    $m  = number_format(round($main, 1), 1);
                    $no = $isSub ? $m . '.' . $sub : $m;
                } else {
                    $row = is_array($gridData[$i] ?? null) ? $gridData[$i] : [];
                    $res = $row['response'] ?? null;
                    $rem = $row['remark'] ?? ($row['remarks'] ?? null);
                    $no  = $i + 1;
                }

                $res = $toText($res);
                $rem = $toText($rem);

                if ($filled($res) || $filled($rem)) {
                    $rowsHtml .= '<tr><td class="text-center">' . e($no) . '</td><td>' . e($text) . '</td><td>'
                            . e($filled($res) ? $res : '-') . '</td><td>' . e($filled($rem) ? $rem : '-') . '</td></tr>';
                }
            }

            if ($rowsHtml === '') return '';

            return '<div class="block"><div class="block-head">' . e($title) . '</div><div class="border-table"><table>'
                . '<tr class="table_bg"><th style="width: 5%;">Sr.No.</th><th style="width: 40%;">Question</th>'
                . '<th style="width: 20%;">Response</th><th>Remarks</th></tr>' . $rowsHtml . '</table></div></div>';
        };
    @endphp

    @php
        // ---------- selected checklists (dash/case ka farq ignore) ----------
        $rawChecklist = $data->checklists ?? [];
        if (is_string($rawChecklist)) {
            $decodedChecklist = json_decode($rawChecklist, true);
            $rawChecklist = (json_last_error() === JSON_ERROR_NONE)
                ? $decodedChecklist
                : explode(',', trim($rawChecklist, '[]'));
        }
        if (!is_array($rawChecklist)) { $rawChecklist = []; }

        $selectedNorm = collect($rawChecklist)
            ->flatMap(fn($i) => explode(',', (string) $i))
            ->map(fn($i) => preg_replace('/[^a-z0-9]/', '', strtolower($i)))
            ->filter()->values()->all();

        $sel = fn($name) => in_array(preg_replace('/[^a-z0-9]/', '', strtolower($name)), $selectedNorm, true);

        $isBacterialEndotoxinSelected      = $sel('Bacterial-Endotoxin-Test');
        $isSterilitySelected               = $sel('Sterility');
        $isWaterTestSelected               = $sel('Water-Test');
        $isMicrobialAssaySelected          = $sel('Microbial-assay');
        $isEnvironmentalMonitoringSelected = $sel('Environmental-Monitoring');
        $isMediaSuitabilitySelected        = $sel('Media-Suitability-Test');

        // ---------- helpers ----------
        $microText = function ($v) {
            if (is_array($v)) {
                $v = implode(', ', array_filter(
                    array_map(fn($x) => is_array($x) ? json_encode($x) : (string) $x, $v),
                    fn($x) => trim($x) !== ''
                ));
            }
            return trim(strip_tags((string) $v));
        };
        $microVal = function ($v) {
            $v = strtolower(trim((string) $v));
            return !in_array($v, ['', '-', 'null', 'select', 'please select', 'choose', 'not applicable'], true);
        };

        // ---------- saare micro blocks: [selected flag, gridKey, title, questions] ----------
        // question = ['text'] (main)  ya  ['text', 1] (sub question)
        $microBlocks = [

            // ===== Bacterial-Endotoxin-Test =====
            ['Bacterial-Endotoxin-Test', 'analyst_training_procedure', 'Checklist for Analyst Training and Procedure :', [
                ['Is the analyst trained/qualified BET test procedure?'],
                ['Reference procedure number :-', 1],
                ['Effective date', 1],
                ['Date of qualification:', 1],
                ['Were appropriate precaution taken by the analyst throughout the test?'],
                ['Analyst interview record', 1],
                ['Was an analyst/sampling persons suffering from any ailment such as cough/cold or open wound or skin infections?'],
                ['Analyst interview record', 1],
                ['Was the correct procedure for the transfer of samples and accessories to sampling testing areas followed?'],
            ]],
            ['Bacterial-Endotoxin-Test', 'sample_receiving_var', 'Sample receiving & verification in lab', [
                ['Was the sample container (Physical integrity) verified at the time of sample receipt?'],
                ['Were clean and dehydrogenated sampling accessories and glassware used for sampling?', 1],
                ['Was the correct quantity of the sample withdrawn ?', 1],
                ['Was there any discrepancy observed during sampling ?', 1],
                ['Was the sample container (Physical integrity) checked before testing ? '],
            ]],
            ['Bacterial-Endotoxin-Test', 'method_used_during_analysis', 'Method /procedure used during analysis', [
                ['Was correct applicable specification/Test procedure/MOA/ used for analysis ?'],
                ['Verified specification/Test procedure/MOA No.', 1],
                ['Was the test procedure followed as per method validation ?', 1],
                ['Was the any change in the validated change method ?if yes, was test performed with the new validated method ?', 1],
                ['Was BET reagents (Lysate ,CSE,LRW and Buffer) procured from the approved vender ?'],
                ['Was lysate and CSE stored at the recommended temp.and duration? Storage condition:'],
                ['Were all product /reagents contact parts of BET testing (Tips/Accessories /Sample Container) depayrogenated ?'],
                ['Assay tube /Batch No.'],
                ['Expiry date:'],
                ['Tipe lot /Batch No.'],
                ['Expiry date:'],
                ['Was the test done at correct MVD as per validated method ?'],
                ['Were calculation of MVD/Test dilution done correctly?'],
                ['Were correct dilutions prepared ?'],
                ['Was labeled claim lysate sensitivity checked before the use of the lot?'],
                ['Were all reagents (LRW/CSE and Lysate) used in the test with in the expiry?'],
                ['LRW expiry date?'],
                ['CSE expiry date?'],
                ['Lysate expiry date?'],
                ['Buffer expiry date?'],
                ['Was рН of the test sample/dilution verified?'],
                ['Were appropriate рН strip /measuring device used, which provides the least count measurement of test sample/dilution wherever applicable?'],
                ['Were proper incubation conditions followed ?'],
                ['Was there any spillage that occurred during the vortexing of dilutions?'],
                ['Were the results of positive, negative and test controls found satisfactory?'],
                ['Is the test incubator /heating block kept on a vibration –free surface ?'],
                ['Were measures established and implemented to prevent contamination from personal material, material during testing reviewed and found satisfactory? List the measures:'],
            ]],
            ['Bacterial-Endotoxin-Test', 'instrument_equipment_detailss', 'Instrument/Equipment Details', [
                ['Was the equipment used, calibrated/qualified and within the specified range? '],
                ['Dry block /Heating block equipment ID:'],
                ['Calibration date & Next due date:'],
                ['Pipettes ID:'],
                ['Calibration date and Next due date:'],
                ['Refrigerator (2-8̊ C) ID:'],
                ['Validation date and next due date:'],
                ['Dehydrogenation over ID:'],
                ['Validation date and next due date:'],
                ['Did the dehydrogenation cycle challenge with endotoxin and found satisfactory during validation?'],
                ['Was the depyrogenation done as per the validated load pattern?'],
                ['Was there any power failure noticed during the incubation of samples in the heating block?'],
                ['Was assay tubes incubated in the dry block (time and temp).as specified in the procedure?'],
                ['Were any other samples tested along with this sample?'],
                ['If yes, whether those sample’s results found satisfactory?'],
                ['Were any other sample’s analyzed on the same time on the same instruments ?'],
                ['If yes, what were the results of other Batches:'],
            ]],
            ['Bacterial-Endotoxin-Test', 'result_and_calculation', 'Results and Calculation', [
                ['Were results taken properly ?'],
                ['Raw data checked By……………….'],
                ['Was formula dilution factor used for calculating the results corrected?'],
            ]],

            // ===== Sterility =====
            ['Sterility', 'Training_records_Analyst_Involved1', 'Checklist for Review of Training records Analyst Involved in Testing', [
                ['Was analyst trained on testing procedure?'],
                ['Date of training:', 1],
                ['Was the analyst qualified for testing?'],
                ['Date of qualification:', 1],
                ['Were the personnel in perfect health without any open injury or infection?'],
                ['Were the entry and exit procedures to the respective production area followed as per SOP?'],
            ]],
            ['Sterility', 'sample_intactness_before_analysis1', 'Checklist for Review of sample intactness before analysis ?', [
                ['Was intact samples/sample container received in lab?'],
                ['Was it verified by sample receipt persons at the time of receipt in lab?'],
                ['Was the sample collected in desired container and transported as per approved procedure?'],
                ['Was there any discrepancy observed during sampling?'],
                ['Any remark notified in sample request form?', 1],
                ['Were samples stored as per storage requirements specified in specification/SOP?'],
            ]],
            ['Sterility', 'test_methods_Procedure1', 'Review of test methods & Procedures', [
                ['Was correct applicable specification and method of analysis used for analysis?'],
                ['MOA & specification number?'],
                ['Were the results of the other samples analyzed on the same day/time satisfactory?'],
                ['Were the samples tested transferred and incubated at desired temperature as per approved procedure?'],
                ['Were the tested samples results observed within the valid time?'],
            ]],
            ['Sterility', 'Review_of_Media_Buffer_Standards_prep1', 'Review of Media, Buffer, Standards preparation & test accessories', [
                ['Name of the media used in the analysis:'],
                ['Did the COA of the media review and found satisfactory?', 1],
                ['Date of media preparation:', 1],
                ['Lot No.', 1],
                ['Use before date:', 1],
                ['Was the media sterilization and sanitization cycle found satisfactory?', 1],
                ['Validated load pattern references documents No.', 1],
                ['Was any contamination observed in test media/diluents?', 1],
                ['Was appropriate and cleaned and sterilized glassware used for testing?', 1],
                ['Are the negative controls still confirming?', 1],
                ['Is the growth promotion test for the media confirming?'],
            ]],
            ['Sterility', 'Checklist_for_Revi_of_Media_Buffer_Stand_prep1', 'Checklist for Review of Media, Buffer, Standards preparation & test accessories', [
                ['Were the environmental conditions during testing as per the conditions specified?'],
                ['Was the Temperature of the area within the limit?', 1],
                ['Pressure differentials of the area within the limit?', 1],
                ['Were the other types of monitoring results confirming?', 1],
                ['Are the under test environmental monitoring samples confirming?', 1],
                ['Were the entry and exit procedures to the clean room / controlled rooms followed as per SOP? (by all personnel)', 1],
                ['Was the HEPA filter integrity of the area found satisfactory?', 1],
            ]],
            ['Sterility', 'ccheck_for_disinfectant_detail1', 'Checklist for Disinfectant Details:', [
                ['Was the area disinfection done as per schedule?'],
                ['Is the disinfectant used approved?', 1],
                ['Is the concentration in which disinfectant used certified for efficacy?', 1],
                ['Name of the disinfectant used?', 1],
                ['Was the disinfectant prepared correctly?', 1],
                ['Was cleaning done during operations?', 1],
                ['Was area fumigation done as per schedule?', 1],
                ['Was the concentration in which fumigant used correct?', 1],
                ['Were there any spillages in the area?', 1],
            ]],
            ['Sterility', 'Checklist_for_Review_of_instrument_equip1', 'Checklist for Review of instrument/equipment', [
                ['Was there any malfunctioning of autoclave observed? Verify the qualification and requalification of steam sterilizer?'],
                ['Autoclave ID No:', 1],
                ['Qualification date and Next due date:', 1],
                ['Was there any power supply failure noted during analysis?'],
                ['Was incubators used is qualified Incubators ID:'],
                ['Qualification date and Next due date:', 1],
                ['Any events associated with incubators, when the samples under incubation.', 1],
                ['Was any breakdown/maintenance observed in any instrument/equipment/system, which may cause this failure?', 1],
            ]],

            // ===== Water-Test =====
            ['Water-Test', 'Checklist_for_Review_of_Training_records_Analyst1', 'Checklist for Review of Training records Analyst Involved in Testing', [
                ['Is the analyst trained on respective procedures?'],
                ['Was the analyst qualified for testing?'],
                ['Date of qualification:', 1],
                ['Was the analyst trained on entry exit /procedure?'],
                ['SOP No.& Trained On', 1],
                ['Was an analyst/sampling persons suffering from any ailment such as cough/cold or open wound or skin infections during analysis?'],
                ['Was the analyst followed gowning procedure?', 1],
                ['Was analyst performed colony counting correctly?'],
            ]],
            ['Water-Test', 'Checklist_for_Review_of_sampling_and_Transport1', 'Checklist for Review of sampling and Transportation procedures', [
                ['Name of the sampler:'],
                ['Was the sampling followed approved procedure?'],
                ['Reference procedure No. & Trained on', 1],
                ['Were clean and sterile sampling accessories used for sampling?'],
                ['Used before date:', 1],
                ['Was the sampling area cleaned on day of sampling?'],
                ['Name of the disinfectant used for cleaning?', 1],
                ['When was the last cleaning date from date of sampling?', 1],
                ['Was the cleaning operator trained on the cleaning procedure?', 1],
                ['Was the sample collected in desired container and transported as per approved procedure?'],
                ['Was there any discrepancy observed during sampling?'],
                ['Did the samples transfer to the lab within time?'],
                ['Were samples stored as per storage requirements specified in specifications/procedure?'],
                ['Was there any maintenance work carried out before or during sampling in sampling area?'],
            ]],
            ['Water-Test', 'Checklist_Review_of_Test_Method_proceds1', 'Checklist for Review of Test Method & procedure:', [
                ['Was correct applicable specification/Test procedure/MOA/SOP used for analysis?'],
                ['Verified specification/Test procedure/MOA No/SOP No.', 1],
                ['Was the test procedure mentioned in specification/analytical procedure validated w.r.t. product concentration?', 1],
                ['Was method used during testing evaluated with respect to method validation and historical data and found satisfactory?', 1],
                ['Was negative control of the test procedure found satisfactory?', 1],
                ['Were the results of the other samples analyzed on the same day/time by using same media, reagents and accessories found satisfactory?', 1],
                ['Were the sample tested transferred and incubated at desired temp. as per approved procedure?', 1],
                ['Were the test samples results observed within the valid time?', 1],
                ['Were colonies counted correctly?', 1],
                ['Was correct formula, dilution factor used for calculation of results?', 1],
                ['Was the interpretation of test result done correct?', 1],
            ]],
            ['Water-Test', 'Checklist_for_Review_Media_prepara_RTU_medias1', 'Checklist for Review of Media preparation, RTU media and Test Accessories', [
                ['Name of the media used in the analysis:'],
                ['Review of the media COA', 1],
                ['Date of media preparation', 1],
                ['Lot No.', 1],
                ['Use before date', 1],
                ['Was GPT of the media complied for its acceptance criteria?', 1],
                ['Was valid culture use in GPT of media?', 1],
                ['Any events noticed with the same media used in other tests?', 1],
                ['Was the media sterilized and sterilization cycle found satisfactory?'],
                ['Sterilization cycle No?', 1],
                ['Whether gloves used during testing were within the expiry date?'],
                ['Did the analyst use clean/sterilized garments during testing?'],
                ['Rinsing fluid/diluents used for testing:'],
                ['Were rinsing fluid/diluents used for testing within the validity?', 1],
                ['Date of preparation or manufacturing:', 1],
                ['Were the diluting or rinsing fluids visually inspected for any contamination before testing?', 1],
                ['Lot number of diluents:', 1],
                ['Use before date:', 1],
                ['Type of filter used in filter testing:'],
                ['Use before date of filter:', 1],
                ['Lot number of filter:', 1],
                ['Was sanitization filter assembly performed before execution of the testing?', 1],
                ['Were the filtration assembly and filtration cups sterilized?', 1],
                ['Whether sterilized petri plates used for testing?'],
                ['Lot No./Batch No of petri plates:', 1],
                ['Was temp. of media while pouring monitored and found satisfactory?'],
                ['Was any microbial cultures handled in BSC/LAF prior to testing?'],
            ]],
            ['Water-Test', 'Checklist_Review_Environment_condition_in_tests1', 'Checklist for Review of Environmental condition in the testing area :', [
                ['Was temp. of testing area within limit during testing?'],
                ['Was differential pressure of the area within the limit?', 1],
                ['Were Environmental monitoring (Microbial) results of the LAF/BSC and its surrounding area within the limit on the day of testing and prior to the testing?', 1],
                ['Was there any maintenance work performed in the testing area prior to the testing?', 1],
                ['Was recovered isolate reviewed for its occurrence in the past, source, frequency and control taken against the isolate?'],
                ['Were measures established and implemented to prevent contamination from personnel, material during testing reviewed and found satisfactory?'],
            ]],
            ['Water-Test', 'review_of_instrument_bioburden_and_waters1', 'Checklist for Review of Instrument/Equipment:', [
                ['Were there any preventative maintenances/ breakdowns/ changing of equipment parts etc) for the equipment’s used in the testing?'],
                ['Autoclave :ID No'],
                ['Qualification date and Next due date:', 1],
                ['BSC/LAF ID:', 1],
                ['Qualification date and Next due date:', 1],
                ['Incubator :ID No.', 1],
                ['Was temp. of incubator with in the limit during incubation period?', 1],
                ['Qualification date and Next due date:', 1],
                ['Was the BSC/LAF cleaned prior to testing?', 1],
                ['Was HVAC system of testing area qualified ?'],
                ['Qualification date and Next due date:', 1],
                ['Was there any power failure during analysis ?'],
                ['Any events associated with incubators, when the samples under incubation?', 1],
                ['Pipettes ID:'],
                ['Calibration date and Next due date:', 1],
            ]],
            ['Water-Test', 'disinfectant_details_of_bioburden_and_water_tests1', 'Checklist for Disinfectant Details:', [
                ['Name of the disinfectant used for area cleaning'],
                ['Was the disinfectant used for cleaning and sanitization validated?'],
                ['Concentration:', 1],
                ['Was the disinfectant prepared as per validated concentration?'],
            ]],

            // ===== Microbial-assay =====
            ['Microbial-assay', 'training_records_analyst_involvedIn_testing_microbial_asssays1', 'Checklist for Review of Training records Analyst Involved in Testing', [
                ['Was analyst trained on testing procedure?'],
                ['Was the analyst qualified for testing?'],
                ['Date of qualification:', 1],
            ]],
            ['Microbial-assay', 'checklist_for_review_of_test_method_IMA1', 'Checklist for Review of test methods & Procedures', [
                ['Was correct applicable specification and method of analysis used for analysis?'],
                ['MOA & specification number?'],
                ['Were the results of the other samples analyzed on the same day/time satisfactory?'],
                ['Was the samples pipetted or loaded in appropriate quantity?'],
                ['Were the samples tested transferred and incubated at desired temperature as per approved procedure?'],
                ['Were the tested samples results observed within the valid time?'],
                ['Were zones /readings measured correctly? (Applicable for Antibiotics –Microbial Assay)'],
                ['Was formula, dilution factors used for calculation of results corrected?'],
            ]],
            ['Microbial-assay', 'cr_of_media_buffer_st_IMA1', 'Checklist for Review of Media, Buffer, Standards preparation & test accessories', [
                ['Name of the media used in the analysis:'],
                ['Did the COA of the media review and found satisfactory?', 1],
                ['Date of media preparation:', 1],
                ['Lot No.', 1],
                ['Use before date:', 1],
                ['Did appropriate size wells prepare in the media plates? (Applicable for Antibiotics –Microbial Assay)', 1],
                ['Was the media sterilization and sanitization cycle found satisfactory?', 1],
                ['Validated load pattern references documents No.', 1],
                ['Was any contamination observed in test media /Buffers /Standard solution?', 1],
                ['Was appropriate and cleaned glasswares used for testing?', 1],
                ['Whether the volumetric flask calibrated?', 1],
                ['References standard lot No./Batch No?'],
                ['Reference standard expiry date?', 1],
                ['Were the challenged samples stored in appropriate storage condition?', 1],
                ['Was the standard weight accurately as mentioned in test procedure?', 1],
                ['Any event observed with the references standard of the same batch?', 1],
                ['Was the working standard prepared with appropriate dilutions?', 1],
                ['Date of preparation:', 1],
                ['Use before date:', 1],
                ['Were sterilized petriplates used for testing?'],
                ['Lot/Batch No. of petriplates', 1],
                ['Size of the petriplates'],
                ['Size of the petriplate', 1],
                ['Dilutor prepared on:'],
                ['Validity time of the dilutor:', 1],
                ['Used on:', 1],
            ]],
            ['Microbial-assay', 'CR_of_microbial_cultures_inoculation_IMA1', 'Checklist for Review of Microbial cultures/Inoculation (Test organism)', [
                ['Name of the test organism used:'],
                ['Passage No.', 1],
                ['Whether the culture suspension was prepared from valid source (Slant/Cryo vails)?'],
                ['Was the culture suspension used within the valid time?'],
                ['Was appropriate quantity of the inoculum challenged in the product?'],
                ['Was the stock/test culture dilution store as per recommended condition before used'],
            ]],
            ['Microbial-assay', 'CR_of_Environmental_condition_in_testing_IMA1', 'Checklist for Review of Environmental conditions in the testing area', [
                ['Was observed temp. of the area within limit'],
                ['Was differential pressure of the area within limit:', 1],
                ['Was viable environmental monitoring results of LAF /BSC (used for testing) found within limit?'],
                ['LAF/BSC ID:', 1],
            ]],
            ['Microbial-assay', 'CR_of_instru_equipment_IMA1', 'Checklist for Review of instrument/equipment', [
                ['Was there any malfunctioning of autoclave observed? verify the qualification and requalification of steam sterilizer?'],
                ['Autoclave ID No:', 1],
                ['Qualification date and Next due date:', 1],
                ['Was any Microbial cultures handled in BSC/LAF prior testing'],
                ['BSC/ULAF ID:', 1],
                ['Did the equipment cleaned prior to testing?', 1],
                ['Qualification date and Next due date:', 1],
                ['Incubators ID:', 1],
                ['Qualification date and Next due date:', 1],
                ['Any events associated with incubators, when the samples under incubation.', 1],
                ['Was there any power supply failure noted during analysis?'],
                ['Pipette IDs'],
                ['Calibration date & Next due date:', 1],
                ['Was any breakdown/maintenance observed in any instrument/equipment/system, which may cause of this failure?'],
            ]],
            ['Microbial-assay', 'disinfectant_details_IMA1', 'Disinfectant Details :', [
                ['Name of the disinfectant used for cleaning of testing area:'],
                ['Was the disinfectant prepared as per validated concentration?', 1],
                ['Use before date of the disinfectant used for cleaning:', 1],
            ]],

            // ===== Environmental-Monitoring =====
            ['Environmental-Monitoring', 'CR_of_training_rec_anaylst_in_monitoring_CIEM1', 'Checklist for review of Training records Analyst Involved in monitoring :', [
                ['Is the analyst trained for Environmental monitoring?'],
                ['Was the analyst qualified for Personnel qualification?'],
                ['Date of qualification:', 1],
                ['Was the analyst trained on entry exit /procedure/In production area or any monitoring area?'],
                ['SOP No.:', 1],
                ['Was an analyst /sampling persons suffering from any ailment such as cough/cold or open wound or skin infections during analysis?'],
                ['Was the analyst followed gowning procedure properly?', 1],
                ['Was analyst performed colony counting correctly?'],
            ]],
            ['Environmental-Monitoring', 'Check_for_Sample_details_CIEM1', 'Checklist for sample details :', [
                ['Was the plate verified at the time of monitoring?'],
                ['Was the plate transported as per approved procedure?'],
                ['Was the correct location ID & Room Name mentioned on plate exposed?'],
                ['What is the grade of plate exposed area?'],
                ['Is area crossing Alert limit or action limit?'],
            ]],
            ['Environmental-Monitoring', 'Check_for_comparision_of_results_CIEM1', 'Checklist for comparison of results with other parameters:', [
                ['Was any Excursions in other settle plate exposure?'],
                ['Was any Excursions in other active air plate sampling?'],
                ['Was any Excursions in surface monitoring?'],
                ['Was any Excursions in personnel monitoring on same day?'],
                ['Is results of next day monitoring within the acceptance?'],
                ['Was negative control of the test procedure found satisfactory?'],
                ['Were the results of the other samples analyzed on the same day/time by using same media, reagents and accessories found satisfactory?'],
                ['Were the plate transferred and incubated at desired temp.as per approved procedure?'],
            ]],
            ['Environmental-Monitoring', 'checklist_for_media_dehydrated_CIEM1', 'Checklist for details of media dehydrated media used:', [
                ['Name of media used for in the analysis:', 1],
                ['Did the COA of the media checked and found satisfactory?', 1],
                ['Media Lot. No.', 1],
                ['Media Qualified date /Qualified By', 1],
                ['Media expiry date', 1],
            ]],
            ['Environmental-Monitoring', 'checklist_for_media_prepara_sterilization_CIEM1', 'Checklist for media preparation details and sterilization :', [
                ['Date of media preparation', 1],
                ['Media Lot. No.', 1],
                ['Media prepared date', 1],
                ['Media expiry date', 1],
                ['Preincubation of media', 1],
                ['Was the media sterilized and sterilization cycle found satisfactory?', 1],
                ['Sterilization cycle No.:', 1],
                ['Were cycle sterilization parameters found satisfactory?', 1],
            ]],
            ['Environmental-Monitoring', 'CR_of_En_condition_in_testing_CIEM1', 'Checklist for review of environmental conditions in the testing area :', [
                ['Is temperature of MLT testing area within the acceptance?'],
                ['Was the differential pressure of the area within limit?'],
                ['While media plate preparation is LAF working satisfactory?'],
            ]],
            ['Environmental-Monitoring', 'check_for_disinfectant_CIEM1', 'Checklist for disinfectant Details :', [
                ['Name of the disinfectant used for area cleaning', 1],
                ['Was the disinfectant used for cleaning and sanitization validated?', 1],
                ['Concentration:', 1],
                ['Was the disinfectant prepared as per validated concentration?', 1],
            ]],
            ['Environmental-Monitoring', 'checklist_for_fogging_CIEM1', 'Checklist for fogging details :', [
                ['Name of the fogging agents used for area fogging', 1],
                ['Was the fogging agent used for fogging and validated?', 1],
                ['Concentration:', 1],
                ['Was the fogging agent prepared as per validated concentration?', 1],
            ]],
            ['Environmental-Monitoring', 'CR_of_test_method_CIEM1', 'Checklist for review of Test Method & procedure:', [
                ['Was the test method, monitoring SOP followed correctly?', 1],
                ['SOP No.:', 1],
            ]],
            ['Environmental-Monitoring', 'CR_microbial_isolates_contamination_CIEM1', 'Checklist for review of microbial isolates /Contamination (If completed at the time of filling of checklist, if not then this details shall be updated upon completion of identification) :', [
                ['Were the contaminants/ isolates subculture?', 1],
                ['Attach the colony morphology details:', 1],
                ['Was recovered isolates (From sample), Identified Gram nature of the organism(GP/GN)', 1],
                ['Gram nature of the organism (GP/GN)', 1],
                ['(Attach the details, if more than single organism)', 1],
                ['Review the isolates for its occurrence in the past, source, frequency and controls taken against the isolates.'],
            ]],
            ['Environmental-Monitoring', 'CR_of_instru_equip_CIEM1', 'Checklist for review of Instrument/Equipment:', [
                ['Were there any preventative maintenances/ breakdowns/ changing of equipment parts etc) for the equipment’s used in the testing?'],
                ['Is used incubators are qualified?'],
                ['Incubator :ID No.', 1],
                ['Qualification date:', 1],
                ['Next due date:', 1],
                ['Is used Colony counter qualified?', 1],
                ['Colony counter ID:', 1],
                ['Qualification date:', 1],
                ['Next due date:', 1],
                ['Is used Air sampler qualified?', 1],
                ['Air sampler ID', 1],
                ['Validation date:', 1],
                ['Next due date:', 1],
                ['Was temp. of incubator with in the limit during incubation period?', 1],
                ['Was HVAC system of testing area qualified?'],
                ['Qualification date and Next due date:', 1],
            ]],
            ['Environmental-Monitoring', 'Ch_Trend_analysis_CIEM1', 'Checklist for trend Analysis:', [
                ['Is trend of current month within acceptance?'],
                ['Is trend of previous month within acceptance?'],
            ]],

            // ===== Media-Suitability-Test =====
            ['Media-Suitability-Test', 'checklist_for_analyst_training_CIMT2', 'Checklist for Analyst training & Procedure', [
                ['Is the analyst trained/qualified GPT test procedure?'],
                ['Date of qualification:', 1],
                ['Were appropriate precaution taken by the analyst throughout the test?'],
                ['Analyst interview record.......', 1],
                ['Was an analyst persons suffering from any ailment such as cough/cold or open wound or skin infections?'],
                ['Was the correct procedure for the transfer of samples and accessories to sampling testing areas followed?'],
            ]],
            ['Media-Suitability-Test', 'checklist_for_comp_results_CIMT2', 'Checklist for Comparison of results (With same & Previous Day Media GPT) ::', [
                ['Which media GPT performed at previous day:'],
                ['Were dehydrated and ready to use media used for GPT?'],
                ['Lot No./Batch No:'],
                ['Date /Time of Incubation:'],
                ['Date/Time of Release:', 1],
                ['Results of previous day GPT record?'],
                ['Results of other plates released for GPT is within acceptance?'],
            ]],
            ['Media-Suitability-Test', 'checklist_for_Culture_verification_CIMT2', 'Checklist for Culture verification ?', [
                ['Is culture COA checked?'],
                ['Was the correct Inoculum used for GPT?'],
                ['Was used culture within culture due date?'],
                ['Date of culture dilution:', 1],
                ['Due date of culture dilution:', 1],
                ['Was the storage condition of culture appropriate?'],
                ['Was culture strength used within acceptance range?'],
            ]],
            ['Media-Suitability-Test', 'sterilize_accessories_CIMT2', 'Checklist for Sterilize Accessories :', [
                ['Was the media sterilized and sterilization cycle found satisfactory?'],
                ['Sterilization cycle No.:', 1],
                ['Whether disposable sterilized gloves used during testing were within the expiry date?'],
                ['Results of other plates released for GPT is within acceptance?'],
            ]],
            ['Media-Suitability-Test', 'checklist_for_intrument_equip_last_CIMT2', 'Checklist for Instrument/Equipment Details:', [
                ['Was the equipment used, calibrated/qualified and within the specified range?'],
                ['Biosafety equipment ID:', 1],
                ['Validation date:', 1],
                ['Next due date:', 1],
                ['Colony counter equipment ID:'],
                ['Calibration date:', 1],
                ['Was used pipettes within calibration?'],
                ['Pipettes ID:', 1],
                ['Calibration date', 1],
                ['Was the refrigerator used for storage of culture is validated?'],
                ['Refrigerator (2-8̊ C) ID:', 1],
                ['Validation date:', 1],
                ['Incubator ID:'],
                ['Validation date and next due date:', 1],
                ['Was there any power failure noticed during the incubation of samples in the heating block?'],
                ['Were any other media GPT tested along with this sample?'],
                ['If yes, whether those media GPT results found satisfactory?', 1],
            ]],
            ['Media-Suitability-Test', 'disinfectant_details_last_CIMT2', 'Checklist for Disinfectant Details:', [
                ['Name of the disinfectant used for area cleaning'],
                ['Was the disinfectant used for cleaning and sanitization validated?'],
                ['Concentration:', 1],
                ['Was the disinfectant prepared as per validated concentration?'],
            ]],
            ['Media-Suitability-Test', 'checklist_for_result_calculation_CIMT2', 'Checklist for Results and Calculation :', [
                ['Were results taken properly?'],
                ['Raw data checked?'],
                ['Was formula dilution factor used for calculating the results corrected?'],
            ]],
        ];

        // ---------- sirf selected + data wale blocks / rows ----------
        $microOut = [];

        if ($data->Form_type == 'OOS_Micro') {
            foreach ($microBlocks as $blk) {
                [$flag, $gridKey, $title, $questions] = $blk;

                if (!$sel($flag)) { continue; }          // checklist selected nahi to block hide

                $mainIdx = 2.0; $subIdx = 0; $rows = [];

                foreach ($questions as $i => $q) {
                    $isSub = !empty($q[1]);
                    if ($isSub) { $subIdx++; } else { $subIdx = 0; $mainIdx += 0.1; }

                    try {
                        $res = Helpers::getChemicalGridData($data, $gridKey, true, 'response', true, $i);
                        $rem = Helpers::getChemicalGridData($data, $gridKey, true, 'remark', true, $i);
                    } catch (\Throwable $e) {
                        $res = null; $rem = null;
                    }

                    $res = $microText($res);
                    $rem = $microText($rem);

                    if ($microVal($res) || $microVal($rem)) {   // jis question ka answer nahi, wo row hide
                        $m = round($mainIdx, 1);
                        $rows[] = [
                            $isSub ? ($m . '.' . $subIdx) : number_format($m, 1),
                            $q[0],
                            $microVal($res) ? $res : '-',
                            $microVal($rem) ? $rem : '-',
                        ];
                    }
                }

                if (count($rows)) {                          // block me kuch data ho tabhi block dikhe
                    $microOut[] = ['title' => $title, 'rows' => $rows];
                }
            }
        }
    @endphp

    @if($data->Form_type == 'OOS_Micro' && count($microOut))
        <div class="inner-block">
            <div class="content-table">
                @foreach($microOut as $blk)
                    <div class="block">
                        <div class="block-head">{{ $blk['title'] }}</div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th style="width: 5%;">Sr.No.</th>
                                    <th style="width: 40%;">Question</th>
                                    <th style="width: 20%;">Response</th>
                                    <th>Remarks</th>
                                </tr>
                                @foreach($blk['rows'] as $r)
                                    <tr>
                                        <td class="text-center">{{ $r[0] }}</td>
                                        <td>{{ $r[1] }}</td>
                                        <td>{{ $r[2] }}</td>
                                        <td>{{ $r[3] }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif


    @if($data->Form_type == 'OOS_Chemical' || $data->Form_type == 'OOT')
            
            @php
                $ph_meter_questions = array(
                    "Was instrument calibrated before start of analysis?",
                    "Was temperature sensor working efficiently?",
                    "Was pH electrode stored properly?",
                    "Was sampled prepared as per STP?",
                    "Was sufficient quantity of sample to ensure that the sensor is properly dipped?",
                    "Was electrode filling solution sufficient inside the electrode?",
                    "Were instrument properly connected at the time of analysis?",
                );
            @endphp

            @php
                $phData = [];

                if ($ph_meters && !empty($ph_meters->data)) {
                    if (is_string($ph_meters->data)) {
                        $phData = json_decode($ph_meters->data, true) ?: [];
                    } elseif (is_array($ph_meters->data)) {
                        $phData = $ph_meters->data;
                    } else {
                        $phData = (array) $ph_meters->data;
                    }
                }

                $hasPhData = false;

                foreach ($phData as $row) {
                    if (
                        is_array($row) &&
                        (
                            filled($row['response'] ?? null) ||
                            filled($row['remark'] ?? null) ||
                            filled($row['remarks'] ?? null)
                        )
                    ) {
                        $hasPhData = true;
                        break;
                    }
                }
            @endphp

            @if($isPhSelected && $hasPhData)
                <div class="block">
                    <div class="block-head">CheckList - pH</div>
                    <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>

                            @foreach($ph_meter_questions as $index => $question)
                                @php
                                    $answer = $phData[$index] ?? [];
                                    $response = $answer['response'] ?? null;
                                    $remark = $answer['remark'] ?? ($answer['remarks'] ?? null);
                                @endphp

                                @if(filled($response) || filled($remark))
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $question }}</td>
                                        <td>{{ filled($response) ? $response : '-' }}</td>
                                        <td>{{ filled($remark) ? $remark : '-' }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                </div>
            @endif

            @php
                $Viscometer_questions = array(
                    "Was instrument calibrated before start of analysis?",
                    "Was sampled prepared as per STP?",
                    "Was correct spindle used for analysis?",
                    "Was Sufficient quantity used to performed the analysis?",
                );
            @endphp

            @php
                $viscometerData = [];

                if ($Viscometers && !empty($Viscometers->data)) {
                    if (is_string($Viscometers->data)) {
                        $viscometerData = json_decode($Viscometers->data, true) ?: [];
                    } elseif (is_array($Viscometers->data)) {
                        $viscometerData = $Viscometers->data;
                    } else {
                        $viscometerData = (array) $Viscometers->data;
                    }
                }

                $hasViscometerData = false;

                foreach ($viscometerData as $row) {
                    if (
                        is_array($row) &&
                        (
                            filled($row['response'] ?? null) ||
                            filled($row['remark'] ?? null) ||
                            filled($row['remarks'] ?? null)
                        )
                    ) {
                        $hasViscometerData = true;
                        break;
                    }
                }
            @endphp

            @if($isViscometerSelected && $hasViscometerData)
                <div class="block">
                    <div class="block-head">CheckList - Viscometer</div>
                    <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>

                            @foreach($Viscometer_questions as $index => $question)
                                @php
                                    $answer = $viscometerData[$index] ?? [];
                                    $response = $answer['response'] ?? null;
                                    $remark = $answer['remark'] ?? ($answer['remarks'] ?? null);
                                @endphp

                                @if(filled($response) || filled($remark))
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $question }}</td>
                                        <td>{{ filled($response) ? $response : '-' }}</td>
                                        <td>{{ filled($remark) ? $remark : '-' }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                </div>
            @endif

           
            @php
                $Melting_Point_questions = array(
                    "Was instrument calibrated before start of analysis?",
                    "Was sampled prepared as per STP?",
                    "Was sampled properly filled inside the capillary tube?",
                    "Were instrument properly connected at the time of analysis?",
                    "Was temperature of the instrument as per STP?",
                    "Was temperature acquired during analysis?",
                    "Was analyst verified the oil is filled up to the level before start of analysis?",
                );
            @endphp

            @php
                $meltingPointData = [];

                if ($Melting_Points && !empty($Melting_Points->data)) {
                    if (is_string($Melting_Points->data)) {
                        $meltingPointData = json_decode($Melting_Points->data, true) ?: [];
                    } elseif (is_array($Melting_Points->data)) {
                        $meltingPointData = $Melting_Points->data;
                    } else {
                        $meltingPointData = (array) $Melting_Points->data;
                    }
                }

                $hasMeltingPointData = false;

                foreach ($meltingPointData as $row) {
                    if (
                        is_array($row) &&
                        (
                            filled($row['response'] ?? null) ||
                            filled($row['remark'] ?? null) ||
                            filled($row['remarks'] ?? null)
                        )
                    ) {
                        $hasMeltingPointData = true;
                        break;
                    }
                }
            @endphp

            @if($isMeltingPointSelected && $hasMeltingPointData)
                <div class="block">
                    <div class="block-head">CheckList - Melting Point</div>
                    <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>

                            @foreach($Melting_Point_questions as $index => $question)
                                @php
                                    $answer = $meltingPointData[$index] ?? [];
                                    $response = $answer['response'] ?? null;
                                    $remark = $answer['remark'] ?? ($answer['remarks'] ?? null);
                                @endphp

                                @if(filled($response) || filled($remark))
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $question }}</td>
                                        <td>{{ filled($response) ? $response : '-' }}</td>
                                        <td>{{ filled($remark) ? $remark : '-' }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                </div>
            @endif


            @php
                $Dis_solution_questions = array(
                    "Was dissolution appartus in calibrated state?",
                    "Was the instrument parameter as per STP?",
                    "Was the bowl temperature at the start and end of analysis as per STP ?",
                    "Was dissolution appartus clean before analysis?",
                    "Were the pH of dissolution medium as per STP?",
                    "Was correct volume of dissolution medium used for analysis?",
                    "Was correct Appartus used as per STP ?",
                    "Was the water level of dissolution bath as per SOP/recommendation?",
                    "Was Tablet/capsule/suspention dropped manually or was placed on dispensing tablet?",
                    "Was sampling involve profilling dissolution?",
                    "Was sampling done manually or using auto sampler?",
                    "Was filtration done immediately after sampling?",
                    "Was there any dilution of sample after withdrawl of sample?",
                    "Was correct filter used for dilution?",
                    "While performing profilling, Does sample withdrawl at specific timeline as per STP?",
                    "Was Glassware used as per STP?",
                    "Was bowl temperature found 37°C ± 0.5 before start of analysis?",
                    "Is method validation/verification available ?",
                );
            @endphp

            @php
                $disSolutionData = [];

                if ($Dis_solutions && !empty($Dis_solutions->data)) {
                    if (is_string($Dis_solutions->data)) {
                        $disSolutionData = json_decode($Dis_solutions->data, true) ?: [];
                    } elseif (is_array($Dis_solutions->data)) {
                        $disSolutionData = $Dis_solutions->data;
                    } else {
                        $disSolutionData = (array) $Dis_solutions->data;
                    }
                }

                $hasDisSolutionData = false;

                foreach ($disSolutionData as $row) {
                    if (
                        is_array($row) &&
                        (
                            filled($row['response'] ?? null) ||
                            filled($row['remark'] ?? null) ||
                            filled($row['remarks'] ?? null)
                        )
                    ) {
                        $hasDisSolutionData = true;
                        break;
                    }
                }
            @endphp

            @if(in_array('Dissolution', $selectedChecklist, true) && $hasDisSolutionData)

                <div class="block">
                    <div class="block-head">CheckList - Dissolution</div>

                    <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>

                            @foreach($Dis_solution_questions as $index => $question)
                                @php
                                    $answer = $disSolutionData[$index] ?? [];
                                    $response = $answer['response'] ?? null;
                                    $remark = $answer['remark'] ?? ($answer['remarks'] ?? null);
                                @endphp

                                @if(filled($response) || filled($remark))
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $question }}</td>
                                        <td>{{ filled($response) ? $response : '-' }}</td>
                                        <td>{{ filled($remark) ? $remark : '-' }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                </div>

            @endif

            @php
                $HPLC_GC_questions = array(
                    "Was analyst used correct column as per mentioned in STP?",
                    "Was Chromatography Condition/Instrument Parameter like Retention time, wavelength, flow rate, injection volume, column temperature and autos ampler temperature as per mentioned in STP?",
                    "Was inlet filter sonicated before start of analysis?",
                    "Was suction of port A,port B,port C,port D and rinse port are working correctly?",
                    "Was corrected rinse solution used for analysis as per SOP?",
                    "Was Buffer prepared as per mentioned in STP?",
                    "Is mobile phase within validity periods?",
                    "Is seal wash performed properly?",
                    "Whether analyst used corrected solution for column wash/seal wash before start of analysis as per SOP ?",
                    "Was buffer solution filtered before start of analysis?",
                    "Was mobile phase maintained in recommended storage condition as per SOP/STP?",
                    "Was mobile phase sonicated before start of analysis?",
                    "Was sonication performed with appropriate time line or as per mentioned in STP?",
                    "Was mobile phase ration maintained as per STP?",
                    "Was Mobile phase prepared as per mentioned in STP?",
                    "Was buffer/ mobile phase pH as per STP?",
                    "Was mobile phase degassed before start of analysis?",
                    "Whether analyst used correct water for mobile phase,diluent, sample and standard preparation?",
                    "Was purge valve was closed before start of analysis?",
                    "Was the vial position as per mentioned in printed sequence?",
                    "Was analyst used appropriate test tubes for analysis?",
                    "Was septa of vial/fitment of septa/ filament of cap proper?",
                    "were capping/crimping of GC vial/HPLC Vial done properly?",
                    "Was analyst used the Bonded septa for analysis?",
                    "Was analyst used cleaned septa for analysis?",
                    "Was vial labelled as per SOP?",
                    "Is there any bubble observed inside pump port?",
                    "Was vial filled 3/4th capacity ?",
                    "Is There any pressure fluctuation observed in sample and standard run ?",
                    "Is it correct placebo used during the analysis?",
                    "Was the Glassware's used for preparation of same manufacture's?",
                    "Was standard and sample weighed & prepared as per STP?",
                    "Was analyst used correct dilution solution and made as per mentioned in STP?",
                    "Was analyst used correct filtration technique for analysis of sample?",
                    "Were all solutions injected within Validity periods?",
                    "Is there any sign of unfiltered and non degassed mobile phase?",
                    "Is there any system back pressure/Leakage observed during analysis?",
                    "Is system suitability result as per acceptance criteria?",
                    "Is there any hump interfering to peak integration, spilt peak observed?",
                    "Is peak integrated properly?",
                    "Is there any anomalous chromatographic elution pattern observed?",
                    "Were environmental conditions within the proper limits (Temperature/Humidity)?",
                    "Is Instrument within calibrated state/periods?",
                    "Was cylinder level good before start of analysis?",
                    "Was instrument connected to properly during analysis?(Communication failure)",
                    "Was glass liner cleaned before analysis?",
                    "Was glass wool maintained properly? (change in color white to brown or black)",
                    "Was auto sampler work efficiently?",
                    "Is there color changes observed in oxytrap before and after analysis?(Check silica color)",
                    "Was jet cleaned before analysis?",
                    "Is there any leakage in cylinder?",
                    "Was column fitted properly before start of analysis?(Check Ferrules and nuts)",
                    "Was vial rack work efficiently?",
                    "Was elevator movement up and down efficiently?",
                    "was column conditioning before start of analysis?",
                    "Is there any column breakage observed during analysis?",
                    "was there syringe blockage check before analysis?",
                    "Was vial over-fitted?",
                    "Was analyst change the rubber septa before start of analysis?",
                    "Was chemical used of GC Grade?",
                    "Was calibrated micropipettes used for analysis?",
                    "Was tips sterilized before used?",
                    "Is method validation/verification available ?",
                );
            @endphp

            @php
                $hplcGcData = [];

                if ($HPLC_GCs && !empty($HPLC_GCs->data)) {
                    if (is_string($HPLC_GCs->data)) {
                        $hplcGcData = json_decode($HPLC_GCs->data, true) ?: [];
                    } elseif (is_array($HPLC_GCs->data)) {
                        $hplcGcData = $HPLC_GCs->data;
                    } else {
                        $hplcGcData = (array) $HPLC_GCs->data;
                    }
                }

                $hasHplcGcData = false;

                foreach ($hplcGcData as $row) {
                    if (
                        is_array($row) &&
                        (
                            filled($row['response'] ?? null) ||
                            filled($row['remark'] ?? null) ||
                            filled($row['remarks'] ?? null)
                        )
                    ) {
                        $hasHplcGcData = true;
                        break;
                    }
                }
            @endphp

            @if($isHplcGcSelected && $hasHplcGcData)

                <div class="block">
                    <div class="block-head">CheckList - HPLC GC</div>

                    <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>

                            @foreach($HPLC_GC_questions as $index => $question)
                                @php
                                    $answer = $hplcGcData[$index] ?? [];
                                    $response = $answer['response'] ?? null;
                                    $remark = $answer['remark'] ?? ($answer['remarks'] ?? null);
                                @endphp

                                @if(filled($response) || filled($remark))
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $question }}</td>
                                        <td>{{ filled($response) ? $response : '-' }}</td>
                                        <td>{{ filled($remark) ? $remark : '-' }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                </div>

            @endif


            @php
                $General_Checklist_questions = array(
                "Was solid/Liquid Chemical used as per STP?",
                "Was chemical used within validity periods?",
                "Was correct chemical grade used for analysis?",
                "Was analyst weighed the chemical as per mentioned in STP?",
                "Was analyst used correct Reagent/Volumentrick solution for analysis",
                "Were analyst used Cleaned and  Dried Glassware like volumetrik flask,Pippete,separating funnel & Beaker ? ",
                "Wheather analyst used corrected glassware's as per mentioned in STP?",
                "Is correct formulae used for calculation?",
                "Is correct response used for calculation?",
                "Is there any unauthorized change made in the formulae for calculation in excel sheet used for calculation",
                "Are correct weights, area count, dilution, factors transcribed in calculation sheet?",
                "Is correct specification, standard analytical procedure and version number used for analysis?",
                "Is analyst Qualified to performed the analysis? (Qualificaition number)",
                "Did analyst identify any usual finding during analysis?(Eg :- sample preparation,standard preparation)",
                "Was sample store as per storage condition?",
                "Was correct sample used for analysis?",
                "Was there any unusual obervation with respect to description of sample?",
                "Was correct Working/Reference(USP,EPCRS,JP,BP,In House standard)/Party Working standard/Primary/GC standard used for analysis?",
                "Was potency of Working/Reference(USP,EPCRS,JP,BP,In House standard)/Party Working standard/Primary/GC standard as per COA?",
                "Was Working/Reference(USP,EPCRS,JP,BP,In House standard)/Party Working standard/Primary/GC standard stored as per storage conditons?",
                "Wheather instrument parameter as per STP?",
                "Was Balance used for weighing within weighing range?",
                "Was Balance used withing validity periods?",
                "Was standard/Sample weights as per STP?",
                "Was there any spillage reported by analyst during weighing and transfer?",
                "Was sample/Standard diluted as per STP?",
                "Was solution stored as per storage requirements?",
                "Were chemical/Reagets used of same grade as per STP?",
                "Were chemical/Reagets used within validity/Expiry periods as per STP?",
                "Was correct filters and filtration technque used as STP?",
                "Was sonication time and temperature maintained as per STP?",
                "Were volumetric solution stored as per recommeded storage conditon?",
                "Were volumetric solution used within validity periods?",
                "Was appearance of sample solution satisfactory?",
                "Was validated analytical method used for analysis?",
                "Was method of analysis is inline with pharmacopial methods?",
                "Is instrument used for analysis in calibrated state?",
                "Is there any instrument breckdown before start of analysis?",


                );
            @endphp

            @if(in_array('General-checklist', $selectedChecklist, true))
                @php
                    $generalData = [];

                    if ($General_Checklists && !empty($General_Checklists->data)) {
                        $generalData = is_string($General_Checklists->data)
                            ? (json_decode($General_Checklists->data, true) ?: [])
                            : (array) $General_Checklists->data;
                    }

                    $hasGeneralData = false;

                    foreach ($generalData as $row) {
                        if (
                            is_array($row) &&
                            (
                                filled($row['response'] ?? null) ||
                                filled($row['remark'] ?? null)
                            )
                        ) {
                            $hasGeneralData = true;
                            break;
                        }
                    }
                @endphp

                @if($hasGeneralData)
                    <div class="block">
                        <div class="block-head">CheckList - General</div>
                        <div class="border-table">
                            <table>
                                <tr class="table_bg">
                                    <th style="width: 5%;">Sr.No.</th>
                                    <th style="width: 40%;">Question</th>
                                    <th style="width: 20%;">Response</th>
                                    <th>Remarks</th>
                                </tr>

                                @foreach($General_Checklist_questions as $index => $question)
                                    @php
                                        $answer = $generalData[$index] ?? [];
                                        $response = $answer['response'] ?? null;
                                        $remark = $answer['remark'] ?? null;
                                    @endphp

                                    @if(filled($response) || filled($remark))
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $question }}</td>
                                            <td>{{ $response ?? '-' }}</td>
                                            <td>{{ $remark ?? '-' }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </table>
                        </div>
                    </div>
                @endif
            @endif
           
            @php
                $kF_Potentionmeter_questions = array(
                    "Was Correct Reagent used for analysis?",
                    "Was dried methanol used for analysis?",
                    "Was bureate withn calibrated state?",
                    "Was kF reagent used within validity periods?",
                    "Was sample quantity transfer comppletely in titration vessel ?",
                    "Is there any sample spillage observed on side walls of titration vessel or out side of titration vessel?",
                    "Was silica found in good condition ?",
                    "Was electrode was saturated before start of analysis?",
                    "Was there any drift observed during analysis?",
                    "Was correct electrode used for analysis?",
                    "was power plug connection secure through out analsis?",
                    "Was inlet tube found bubble free ?",
                    "Was sample weight taken as per STP?",
                    "Was standardization performed before start of analysis?",
                    "Was electrode condtioning before start of analysis?",
                    "Is RSD of KF within limit as per SOP/STP?",
                    "Was activated desiccant used?",
                    "Was tip of nozzle correctly attached with delivery tube of volumetric solution reservior?",
                );
            @endphp

            @php
                $kfData = [];

                if ($kF_Potentionmeters && !empty($kF_Potentionmeters->data)) {
                    if (is_string($kF_Potentionmeters->data)) {
                        $kfData = json_decode($kF_Potentionmeters->data, true) ?: [];
                    } elseif (is_array($kF_Potentionmeters->data)) {
                        $kfData = $kF_Potentionmeters->data;
                    } else {
                        $kfData = (array) $kF_Potentionmeters->data;
                    }
                }

                $hasKfData = false;

                foreach ($kfData as $row) {
                    if (
                        is_array($row) &&
                        (
                            filled($row['response'] ?? null) ||
                            filled($row['remark'] ?? null) ||
                            filled($row['remarks'] ?? null)
                        )
                    ) {
                        $hasKfData = true;
                        break;
                    }
                }

                $isKfSelected = false;

                foreach ($selectedChecklist as $selected) {
                    $selectedValue = strtolower(preg_replace('/[^a-z]/', '', trim($selected)));

                    if (in_array($selectedValue, ['kfpotentionmeter', 'kfpotentiometer'], true)) {
                        $isKfSelected = true;
                        break;
                    }
                }
            @endphp

            @if($hasKfData)
                <div class="block">
                    <div class="block-head">CheckList - kF Potentionmeter</div>

                    <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>

                            @foreach($kF_Potentionmeter_questions as $index => $question)
                                @php
                                    $answer = $kfData[$index] ?? [];

                                    $response = $answer['response'] ?? null;
                                    $remark = $answer['remark'] ?? ($answer['remarks'] ?? null);
                                @endphp

                                @if(filled($response) || filled($remark))
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $question }}</td>
                                        <td>{{ filled($response) ? $response : '-' }}</td>
                                        <td>{{ filled($remark) ? $remark : '-' }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                </div>

            @endif

            @php
                $RM_PM_questions = array(
                "Was analyst Varified the GRN as per received samples?",
                "Was analyst used calibrated balanced for sampling ?",
                "Was analyst performed the correct sampling procedure?",
                "Was sampling performed by trained personal?",
                "Was analyst used the cleaned sampling tools for analysis?",
                "Was  analyst used correct container for sampling ?",
                "Was sample handled as per SOP?",
                "Was any deviation observed during the receipt of material?",
                "Was the material shipped as per recommended Transportation storage condition?",
                "Is the COA received with material complying with the specification and no discrepancy was observed?",
                "Was analyst performed the sampling inside the LAF?",
                "Was the prefilter pressure efficient before start of sampling?",
                "Was material stored as per recommeded storage conditon?",

                );
            @endphp
            
            @php
                $rmPmData = [];

                if ($RM_PMs && !empty($RM_PMs->data)) {
                    if (is_string($RM_PMs->data)) {
                        $rmPmData = json_decode($RM_PMs->data, true) ?: [];
                    } elseif (is_array($RM_PMs->data)) {
                        $rmPmData = $RM_PMs->data;
                    }
                }

                $hasRmPmData = false;

                foreach ($rmPmData as $row) {
                    if (
                        is_array($row) &&
                        (
                            filled($row['response'] ?? null) ||
                            filled($row['remark'] ?? null) ||
                            filled($row['remarks'] ?? null)
                        )
                    ) {
                        $hasRmPmData = true;
                        break;
                    }
                }
            @endphp

            @if(in_array('RM-PM Sampling', $selectedChecklist, true) && $hasRmPmData)

                <div class="block">
                    <div class="block-head">CheckList - RM-PM Sampling</div>

                    <div class="border-table">
                        <table>
                            <tr class="table_bg">
                                <th style="width: 5%;">Sr.No.</th>
                                <th style="width: 40%;">Question</th>
                                <th style="width: 20%;">Response</th>
                                <th>Remarks</th>
                            </tr>

                            @foreach($RM_PM_questions as $index => $question)
                                @php
                                    $answer = $rmPmData[$index] ?? [];

                                    $response = $answer['response'] ?? null;
                                    $remark = $answer['remark'] ?? ($answer['remarks'] ?? null);
                                @endphp

                                @if(filled($response) || filled($remark))
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $question }}</td>
                                        <td>{{ filled($response) ? $response : '-' }}</td>
                                        <td>{{ filled($remark) ? $remark : '-' }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                </div>

            @endif

    @endif
