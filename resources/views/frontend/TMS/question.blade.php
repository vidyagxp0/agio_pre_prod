@extends('frontend.layout.main')
@section('container')
    @include('frontend.TMS.head')

    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            @php
                toastr()->error($error);
            @endphp
        @endforeach
    @endif

    {{-- ======================================
                    QUESTION BANK
    ======================================= --}}
    <div id="tms-question">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9">
                    <div class="inner-block question-table">
                        <div class="head">
                            <div>Questions Lists</div>
                        </div>
                        <div class="table-block">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th class="question">Question</th>
                                        <th>Option List</th>
                                        <th>Solution</th>
                                        <th>Question Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="searchTable">
                                    @foreach ($data as $key => $temp)
                                        <tr class="single-select {{ $temp->type == 'Single Selection Questions' ? 'single-select' : '' }}
                                        {{ $temp->type == 'Multi Selection Questions' ? 'multi-select' : '' }}
                                        {{ $temp->type == 'Text Field' ? 'text-field' : '' }}">
                                            <td>{{ $temp->id }}.</td>
                                            <td>{{ $temp->question }}</td>
                                            <td>
                                                <ul>
                                                    @if (!empty($temp->options))
                                                        @foreach (unserialize($temp->options) as $option)
                                                            @if (!empty($option))
                                                                <li>{{ $option }}</li>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </td>
                                            <td>
                                                <ul>
                                                    @if (!empty($temp->answers))
                                                        @php
                                                            $answers = unserialize($temp->answers);
                                                        @endphp
                                                        @if (is_array($answers) || is_object($answers))
                                                            @foreach ($answers as $option)
                                                                <li>{{ $option }}</li>
                                                            @endforeach
                                                        @else
                                                            <li>No valid answers available</li>
                                                        @endif
                                                    @else
                                                        <li>No answers available</li>
                                                    @endif
                                                </ul>
                                            </td>
                                            <td>{{ $temp->type }}</td>
                                            <td>
                                                <div class="action-btns">
                                                    <!-- <a href="{{ route('question.edit', $temp->id) }}" class="button"><i class="fa-solid fa-file-pen"></i></a> -->
                                                    <form action="{{ route('question.destroy', $temp->id) }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="button delete-btn" type="submit"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{ $data->links() }}
                </div>
                <div class="col-lg-3">
                    <div class="inner-block add-question" data-bs-toggle="modal" data-bs-target="#add-question-modal">
                        <i class="fa-solid fa-plus"></i>&nbsp;Add Question
                    </div>

                    <!-- Filter Controls -->
                    <div class="inner-block filter-block">
                        <div class="head">Filter By</div>
                        <div class="list">
                            <label for="single-select">
                                <input type="checkbox" name="question-type" class="question-filter" id="single-select" data-target="single-select" checked>
                                Single Selection Questions
                            </label>
                            <label for="multi-select">
                                <input type="checkbox" name="question-type" class="question-filter" id="multi-select" data-target="multi-select" checked>
                                Multi Selection Questions
                            </label>
                            <!-- <label for="text-field">
                                <input type="checkbox" name="text-field" class="question-filter" id="text-field" data-target="text-field">
                                Text Field Questions
                            </label> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ======================================
                ADD QUESTION MODAL
    ======================================= --}}
    <div class="modal fade" id="add-question-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Question</h4>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal"> <i class="fa fa-times"></i> </button>
                </div>
                <form action="{{ route('question.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="group-input">
                            <label for="ques-type">Question Type</label>
                            <select name="type" id="questionType" onchange="handleChange(this.value)">
                                <option value="" disabled selected>Question Type Select</option>
                                <option value="Single Selection Questions" @if (old('type') == 'Single Selection Questions') selected @endif>Single Selection Questions</option>
                                <option value="Multi Selection Questions" @if (old('type') == 'Multi Selection Questions') selected @endif>Multi Selection Questions</option>
                                <!-- <option value="Text Field" @if (old('type') == 'Text Field') selected @endif>Text Field</option> -->
                            </select>
                            <p id="typecheck" style="color: red;">**Question Type is missing</p>
                        </div>

                        <div class="group-input" id="question-group">
                            <label for="ques">Question</label>
                            <input type="text" name="question" id="question" value="{{ old('question') }}">
                            <p id="questioncheck" style="color: red;">**Question is missing</p>
                        </div>

                        @php
                         $documentAll = DB::table('documents')->get();
                        @endphp
                            <div class="group-input">
                                <label for="type_of_training">Assign SOP (For On the Job & Induction Training)</label>  
                        <select name="document_id" id="sopdocument" onchange="fetchShortDescription(this.value)">
                            <option value="" disabled selected>Select SOP Number</option>
                            @foreach ($documentAll as $dat)
                            <option value="{{ $dat->id }}">
                                {{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}
                            </option>
                            @endforeach
                        </select>
                        </div>

                        <!-- Single Selection Questions Options -->
                        <div class="group-input single_question-options" id="options-group">
                            <label for="options">Options<button type="button" id="optionsbtnadd"><i class="fa-solid fa-plus"></i></button></label>
                            <div class="option-group">
                                <input type="text" id="option" name="options[]">
                                <input type="radio" class="answer" name="answer" value="0">
                            </div>
                            <div id="optionsdiv"></div>
                            <p id="optioncheck" style="color: red;">**Options are missing</p>
                        </div>

                        <!-- Multi Selection Questions Options -->
                        <div class="group-input multi_question-options" id="multi_options-group">
                            <label for="options">Options<button type="button" id="multi_optionsbtnadd"><i class="fa-solid fa-plus"></i></button></label>
                            <div class="option-group">
                                <input type="text" id="option2" name="options[]">
                                <input type="checkbox" class="answer" name="answer" value="0" style="margin-left: 10px;">
                            </div>
                            <div id="multi_optionsdiv"></div>
                            <p id="optioncheck2" style="color: red;">**Options are missing</p>
                        </div>

                        <!-- Answer Input -->
                        <div class="group-input question-answer" id="answer-group">
                            <label for="answer" id="answer-label">Answer</label>
                            <div><small class="text-primary" id="infoQuestion"></small></div>
                            <input type="text" id="answer" name="answers[]">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-outline" name="submit" value="save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('questionType').addEventListener('change', function() {
            var selectedValues = Array.from(this.selectedOptions).map(option => option.value);
            var infoTag = document.getElementById('infoQuestion');
            var answerInput = document.getElementById('answer');
            if (selectedValues.includes('Multi Selection Questions')) {
                answerInput.setAttribute('readonly');
                infoTag.textContent = "You need to write down the correct value answer in the below answer field and click the + button to add more correct answers.";
            } else if (selectedValues.includes('Single Selection Questions')) {
                infoTag.textContent = "Info: Value auto-populates upon selecting correct answer above.";
                answerInput.setAttribute('readonly', true);
                answerInput.value = "";
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.question-filter');
            
            // Load saved filter state
            checkboxes.forEach(checkbox => {
                const savedState = localStorage.getItem(checkbox.id);
                if (savedState !== null) {
                    checkbox.checked = JSON.parse(savedState);
                }
                toggleRows(); 
            });

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', () => {
                    localStorage.setItem(checkbox.id, checkbox.checked);
                    toggleRows(); 
                });
            });
        });

        function toggleRows() {
            const checkboxes = document.querySelectorAll('.question-filter');
            checkboxes.forEach((checkbox) => {
                const target = checkbox.dataset.target;
                const rows = document.querySelectorAll(`.${target}`);
                rows.forEach((row) => {
                    row.style.display = checkbox.checked ? '' : 'none';
                });
            });
        }

        function handleChange(questionType) {
            const isSingleSelection = questionType === 'Single Selection Questions';
            const isMultiSelection = questionType === 'Multi Selection Questions';

            document.getElementById('options-group').style.display = isSingleSelection ? 'block' : 'none';
            document.getElementById('multi_options-group').style.display = isMultiSelection ? 'block' : 'none';
            document.getElementById('answer-group').style.display = isSingleSelection || isMultiSelection ? 'block' : 'none';
        }

        document.addEventListener('DOMContentLoaded', function() {
            const selectedType = document.getElementById('questionType').value;
            handleChange(selectedType);
        });

        $(document).ready(function() {
            let optionCount = 1;
            const optionsContainer = $('#options-container');
            const addOptionBtn = $('#add-option');
            const selectedAnswerInput = $('#answer');

            // Add an option field to the form
            function addOption() {
                const newOption = $(`<div class="option">
                    <input type="text" name="options[]" placeholder="Option ${++optionCount}" />
                    <input type="radio" name="answer" value="${optionCount-1}">
                    <button type="button" class="remove-option">Remove</button>
                </div>`);
                optionsContainer.append(newOption);
            }

            // Remove an option field from the form
            function removeOption() {
                $(this).parent().remove();
            }

            // Update the selected answer field based on the user's selection
            function updateSelectedAnswer() {
                const selectedOption = $('input[name="answer"]:checked').prev().val();
                selectedAnswerInput.val(selectedOption);
            }

            // Add event listeners to the form elements
            addOptionBtn.click(addOption);
            optionsContainer.on('click', '.remove-option', removeOption);
            $(document).on('change', 'input[name="answer"]', updateSelectedAnswer);

            // Add the multi-select checkbox handler here
            $(document).on('change', 'input[name="answer"]', function() {
                let selectedAnswers = [];

                // Get all checked checkboxes
                $('input[name="answer"]:checked').each(function() {
                    selectedAnswers.push($(this).prev().val());  // Get the corresponding option value
                });

                // Join the selected answers with a comma or any separator you want
                $('#answer').val(selectedAnswers.join(', '));
            });

            // Add event listener for toggle button change event
            $('#toggle-options').change(function() {
                const isEnabled = $(this).is(':checked');
                $('input[name="options[]"]').prop('disabled', !isEnabled);
                $('input[name="answer"]').prop('disabled', !isEnabled);
            });
        });
    </script>
@endsection


<style>
.button {
    border: none;
    border-radius: 8px;
    font-size: 15px;
    cursor: pointer;
    transition: all 0.3s ease;
}


.delete-btn {
    background-color: #e74c3c;
    color: #ffffff;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    box-shadow: 0 4px 10px rgba(231, 76, 60, 0.3);
}

.delete-btn i {
    transition: transform 0.3s ease;
}

.delete-btn:hover {
    background-color: #c0392b;
    color: #ffffff;
    box-shadow: 0 6px 15px rgba(231, 76, 60, 0.4);
    transform: translateY(-2px);
}

.delete-btn:hover i {
    transform: rotate(-20deg);
}

.delete-btn:active {
    transform: translateY(0);
    box-shadow: 0 4px 10px rgba(231, 76, 60, 0.2);
}
</style>