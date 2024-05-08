@extends('frontend.layout.main')
@section('container')
    @include('frontend.TMS.head')


    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
        @php
        toastr()->error($error);
        @endphp
        @endforeach
    @endif
    {{-- ======================================
                CREATING TRAINING
    ======================================= --}}
    <div id="create-training-plan">
        <div class="container-fluid">

            <form action="{{ route('TMS.update',$train->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="inner-block">
                    <div class="main-head">
                        Basic Information
                    </div>
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="training-name">Training Plan Name</label>
                                    <input type="text" id="traning_plan_name" name="traning_plan_name" value="{{ $train->traning_plan_name }}" required>
                                </div>
                                <p id="trainingPlan" style="color: red">
                                    ** Training plan is missing...
                                </p>
                            </div>
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="training-id">Training Plan ID</label>
                                    <div class="static">Not-Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="training-type">Training Plan Type</label>
                                    <select id="training-select" name="training_plan_type"  required onchange="toggleMultiSelect()">
                                        <option value="">---</option>
                                        <option value="Read & Understand" @if($train->training_plan_type == "Read & Understand") selected @endif>Read & Understand</option>
                                        <option value="Read & Understand with Questions" @if($train->training_plan_type == "Read & Understand with Questions") selected @endif>Read & Understand with Questions
                                        </option>
                                        <option value="Classroom Training" @if($train->training_plan_type == "Classroom Training") selected @endif>Classroom Training</option>
                                    </select>
                                    <p id="trainingType" style="color: red">
                                        ** Training type is missing...
                                    </p>
                                </div> 
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="effective-criteria">Effective Criteria(in %) <span class="text-danger">*</span></label>
                                    <input type="number" min='0' max='100' value="{{ $train->effective_criteria }}" name="effective_criteria" oninput="validateInput(this)" required>
                                </div>
                            </div>
                            <script>
                                function validateInput(input) {
                                    if (input.value < 0) {
                                        input.value = 0;
                                    }
                                    if (input.value > 100) {
                                        input.value = 100;
                                    }
                                }
                            </script>
                            <div class="col-6">
                                <div class="group-input">
                                    <label for="classRoom_trainingName">Training Due Date <span class="text-danger">*</span></label>
                                    <input type="datetime-local" name="training_end_date" value="{{$train->training_end_date}}">
                                </div>
                            </div> 
                            <div class="col-6">
                                <div class="group-input"  id="assessmentBlock" @if($train->training_plan_type != "Classroom Training") style="display: none" @endif>
                                    <label for="classRoom_trainingName">Assessment Required?  <span class="text-danger">*</span></label>
                                    <select class="assessment_required" id="assessment_required" name="assessment_required[]" placeholder="SelectclassRoom_training Name"  onchange="toggleAssessmentQuiz()">
                                        <option value="">-- Select --</option>
                                        <option @if($train->assessment_required == "yes") selected @endif value="yes">Yes</option>
                                        <option @if($train->assessment_required == "no") selected @endif value="no"> No</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="group-input" id="classroomTrainingBlock" @if($train->training_plan_type != "Classroom Training") style="display: none" @endif>
                                    <label for="classRoom_trainingName">Class Room Trainer <span class="text-danger">*</span></label>
                                    <select  multiple class="classRoom_training" name="classRoom_training[]" placeholder="SelectclassRoom_training Name"
                                        data-search="false" data-silent-initial-value-set="true" id="classRoom_training">
                                        @foreach ($traineesPerson as $user_id)
                                            @php
                                                $user = \App\Models\User::find($user_id);
                                            @endphp
                                            @if ($user)
                                                <option @if($train->classRoom_training == $user->id) selected @endif value="{{ $user->id }}">{{ $user->name }}</option>
                                                
                                                @endif
                                        @endforeach

                                        {{-- <option  @if($train->classRoom_training == "Person 1") selected @endif value="Person 1"> Person 1</option>
                                        <option @if($train->classRoom_training == "Person 2") selected @endif value="Person 2">Person 2</option> --}}
                                   </select>
                                </div>
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    var selectField = document.getElementById('training-select');
                                    var inputsToToggle = [];

                                    // Add elements with class 'facility-name' to inputsToToggle
                                    var facilityNameInputs = document.getElementsByClassName('assessment_required');
                                    var facilityNameInputs1 = document.getElementsByClassName('classRoom_training');
                                    
                                    for (var i = 0; i < facilityNameInputs.length; i++) {
                                        inputsToToggle.push(facilityNameInputs[i]);
                                    }
                                    for (var i = 0; i < facilityNameInputs.length; i++) {
                                        inputsToToggle.push(facilityNameInputs1[i]);
                                    }
                                                                    
                                    selectField.addEventListener('change', function () {
                                        var isRequired = this.value === 'Classroom Training';

                                        inputsToToggle.forEach(function (input) {
                                            input.required = isRequired;
                                        });
                                    });
                                });
                            </script>

                            
                            <script>
                                function toggleMultiSelect() {
                                  var selectedValue = document.getElementById("training-select").value;
                                  var multiSelectField = document.getElementById("classroomTrainingBlock");
                                  var multiSelectField1 = document.getElementById("assessmentBlock");
                                  var AssessmentQuiz = document.getElementById("AssessmentQuiz");
                                
                                  if (selectedValue === "Classroom Training") {
                                    multiSelectField.style.display = "block";
                                    multiSelectField1.style.display = "block";

                                  } else {
                                    multiSelectField.style.display = "none";
                                    multiSelectField1.style.display = "none";
                                  }

                                  if (selectedValue === "Read & Understand with Questions") {
                                    AssessmentQuiz.style.display = "block";
                                  } else {
                                    AssessmentQuiz.style.display = "none";
                                  }
                                }
                                </script>
                            {{-- <div class="col-6">
                                <div class="group-input">
                                    <label for="classRoom_trainingName">Training Start Date & Time </label>
                                    <input type="datetime-local" name="training_start_date" value="{{ $train->training_start_date }}">
                                </div>
                            </div> --}}
                            {{-- <div class="col-6">
                                <div class="group-input">
                                    <label for="classRoom_trainingName">Training End  Date & Time</label>
                                    <input type="datetime-local" name="training_end_date" value="{{ $train->training_end_date }}">
                                </div>
                            </div> --}}
                            <div class="col-12">
                                <div class="group-input"> 
                                    <label for="desc">Training Plan Description</label>
                                    <textarea name="desc">{{ $train->desc }}</textarea>
                                </div>
                            </div>
                            {{-- <div class="col-lg-12">
                                <div class="group-input">
                                    <label for=" Attachments"> Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="training_attachment"></div>
                                        <div class="add-btn">
                                            <div class="add_training_attachment" style="cursor: pointer;">Add</div>
                                            <input type="file" id="myfile" name="attachment[]"
                                                oninput="addMultipleFiles(this, 'training_attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Attachments">Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                    <div class="file-attachment-field">
                                        <div disabled class="file-attachment-list" id="training_attachment">
                                            @if ($train->training_attachment)
                                                @foreach(json_decode($train->training_attachment) as $file)
                                                    <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                        <b>{{ $file }}</b>
                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                        <a  type="button" class="remove-file" train-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                    </h6>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="training_attachment[]"{{ $train->stage == 0 || $train->stage == 7 ? 'disabled' : '' }}
                                                oninput="addAttachmentFiles(this, 'training_attachment')"
                                                multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <script>
                                $(document).ready(function () {
                                    $(".add_training_attachment").click(function(){
                                        $("#myfile").trigger("click");
                                    });
                                });

                                function addAttachmentFiles(input, block_id) {
                                    console.log('test')
                                        let block = document.getElementById(block_id);
                                        let files = input.files;
                                        for (let i = 0; i < files.length; i++) {
                                            let div = document.createElement('div');
                                            div.className = 'attachment-item'; 
                                            div.innerHTML = files[i].name;
                            
                                            let viewLink = document.createElement("a");
                                            viewLink.href = URL.createObjectURL(files[i]);
                                            viewLink.textContent = "</View>";
                                            viewLink.addEventListener('click', function(e){
                                                e.preventDefault();
                                                window.open(viewLink.href,'_blank');
                                            });
                            
                                          
                                            let removeButton = document.createElement("a");
                                            removeButton.className = 'remove-button';
                                            removeButton.textContent = "</Remove>";
                                            removeButton.addEventListener('click', function() {
                                                div.remove();
                                                input.value = ''; 
                                            });

                                            console.log(removeButton)
                            
                                            div.appendChild(viewLink);
                                            div.appendChild(removeButton);
                                            block.appendChild(div);
                                        }
                                    }
                                    
                            </script>
                            <script>
                                function toggleAssessmentQuiz() {
                                    console.log('enter');
                                  var selectedValue = document.getElementById("assessment_required").value;
                                  var AssessmentQuiz = document.getElementById("AssessmentQuiz");
                                
                                  if (selectedValue === "yes") {
                                    AssessmentQuiz.style.display = "block";
                                  } else {
                                    AssessmentQuiz.style.display = "none";
                                  }

                                }
                            </script>

                            <div class="col-12" id="AssessmentQuiz" @if($train->training_plan_type != "Read & Understand with Questions" || $train->assessment_required == "yes") style="display: none" @endif style="display:none;">
                                <div class="group-input">
                                    <label for="quize">Quizz <span class="text-danger">*</span></label></label>
                                    <select id="quizzz" name="quize">
                                        <option value="">---</option>
                                        @foreach ($quize as $temp)
                                            <option data-id="{{ $temp->passing }}" value="{{ $temp->id }}" @if($train->quize == $temp->id) selected @endif>
                                                {{ $temp->title }}</option>
                                        @endforeach
                                    </select>
                                    <p id="trainingQuiz" style="color: red">
                                        ** Training quiz is missing...
                                    </p>
                                </div>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('#quizz').hide();
                            
                                    $('[name="classRoom_training[]"]').change(function() {
                                        if ($(this).val() === 'yes') {
                                            $('#quizz').show();
                                            $('#quizz span').show();
                                        } else {
                                            $('#quizz').hide();
                                            $('#quizz span').hide();
                                        }
                                    });
                                });
                            </script>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="effective-criteria">Effective Criteria(in %)</label>
                                    <input type="number" name="effective_criteria" value="{{ $train->effective_criteria }}" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="group-input">
                                    <label for="classRoom_trainingName">Status </label>
                                    <select class="assessment_required" id="status" name="status" placeholder="SelectclassRoom_training Name" >                
                                        <option value="active"> Active</option>
                                        <option value="inactive"> Inactive</option>
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="col-lg-6" id="trainee-criteria">
                                <div class="group-input">
                                    <label for="trainee-criteria">Trainee Criteria(in %)</label>
                                    <input type="number" id="effective" name="trainee_criteria">
                                </div>
                                <p id="trainingCriteria" style="color: red">
                                    ** Trainee Criteria is missing...
                                </p>
                            </div> --}}
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for=""></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="inner-block">
                            <div class="main-head">
                                Selecting SOP's
                            </div>
                            <div class="inner-block-content">
                                <div class="search-bar">

                                    <input type="text" name="search" placeholder="Search SOP's">
                                    <label for="search"><i class="fa-solid fa-magnifying-glass"></i></label>

                                </div>
                                <div class="selection-table">
                                    <table class="table table-bordered">
                                        {{--  <thead>
                                            <tr>
                                                <th>&nbsp;</th>
                                                <th>Document Number</th>
                                                <th>Document Title</th>
                                                <th>Originator</th>
                                            </tr>
                                        </thead>  --}}
                                        <tbody >
                                            <h6 style="color: red">Sorry !! You can not change the SOP group of training plan.</h6>

                                        </tbody>
                                    </table>
                                    <p id="SOPType" style="color: red">
                                        ** Please Select atliest one SOP...
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="inner-block">
                            <div class="main-head">
                                Selecting Trainees
                            </div>
                            <div class="inner-block-content">
                                <div class="search-bar">

                                    <input type="text" name="search" placeholder="Search Trainees">
                                    <label for="search"><i class="fa-solid fa-magnifying-glass"></i></label>

                                </div>
                                <div class="selection-table">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>&nbsp;</th>
                                                <th>Trainees Name</th>
                                                <th>Department</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $temp)
                                                <tr>
                                                    @php
                                                            if ($train->trainees) {
                                                                $traineesCount = count(explode(',', $train->trainees));
                                                            }
                                                    @endphp

                                                    <td class="text-center"><input type="checkbox" id="trainee" name="trainees[]"
                                                        @if ($traineesCount == $temp->id) checked @endif 
                                                            value="{{ $temp->id }}"></td>
                                                    <td>{{ $temp->name }}</td>
                                                    <td>{{ $temp->department }}</td>
                                                </tr>
                                            @endforeach
                                            <p id="TraineeType" style="color: red">
                                                ** Please Select atliest one Trainee...
                                            </p>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="inner-block add-question" id="question-select">
                    <div class="main-head">
                        Select Questions for Trainees
                    </div>
                    <div class="inner-block-content">
                        <div class="question-container">
                            <div class="left-block">
                                <div class="head">Select Questions</div>
                                <div class="table-max">
                                    <table class="table table-bordered left-table">
                                        <thead>
                                            <tr>
                                                <th>Question</th>
                                                <th>Type</th>
                                            </tr>
                                        </thead>
                                        <tbody id="training-question">
                                            <tr data-item="item1">
                                                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Est nesciunt at
                                                    cupiditate.</td>
                                                <td>Single Select Questions</td>
                                            </tr>
                                            <tr data-item="item2">
                                                <td>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quae dolor
                                                    reiciendis
                                                    ullam.</td>
                                                <td>Multi Selection Questions</td>
                                            </tr>
                                            <tr data-item="item3">
                                                <td>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quae dolor
                                                    reiciendis
                                                    ullam.</td>
                                                <td>Exact Answer Questions</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="right-block">
                                <div class="head">Selected Questions</div>
                                <div class="table-max">
                                    <table class="table table-bordered right-table">
                                        <thead>
                                            <tr>
                                                <th>Question</th>
                                                <th>Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="training-ques-selected">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="foot-btns">
                    <a href="{{ route('TMS.index') }}"><button>Cancel</button></a>
                    <button type="submit" id="SubmitTraining">Create</button>
                </div>
            </form>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#training-select").change(function() {
                var selectedValue = $(this).val();
                var quizDiv = $("#quizz");
                var traineeCriteriaDiv = $("#trainee_criteria");
                if (selectedValue === "Read & Understand") {
                    quizDiv.hide();
                    traineeCriteriaDiv.hide();
                } else if (selectedValue === "Read & Understand with Questions") {
                    quizDiv.show();
                    traineeCriteriaDiv.show();
                } else if (selectedValue === "Classroom Training") {
                    quizDiv.hide();
                    traineeCriteriaDiv.show();
                }
            });
        });




        const itemList = document.getElementById('training-question');
        const selectedList = document.getElementById('training-ques-selected');
        itemList.addEventListener('click', function(e) {
            const selectedItem = e.target.closest('tr');
            if (selectedItem) {
                const itemData = selectedItem.getAttribute('data-item');
                const existingItem = selectedList.querySelector(`tr[data-item="${itemData}"]`);
                if (!existingItem) {
                    const newItem = selectedItem.cloneNode(true);
                    const deleteBtn = document.createElement('button');
                    deleteBtn.textContent = 'Delete';
                    deleteBtn.addEventListener('click', function() {
                        newItem.remove();
                    });
                    const td = document.createElement('td');
                    td.appendChild(deleteBtn);
                    newItem.appendChild(td);
                    selectedList.appendChild(newItem);
                }
            }
        });
    </script>
     <script>
        VirtualSelect.init({
            ele: '#Facility, #Group, #Audit, #Auditee ,#capa_related_record ,#classRoom_training' 
        });
    </script>
@endsection
