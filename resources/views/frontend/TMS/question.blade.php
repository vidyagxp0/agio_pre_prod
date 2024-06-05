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

            {{-- <div class="search-bar">
                <form action="#">
                    <input type="text" name="search" placeholder="Search Questions...">
                    <label for="search"><i class="fa-solid fa-magnifying-glass"></i></label>
                </form>
            </div> --}}

            <div class="row">
                <div class="col-lg-9">

                    <div class="inner-block question-table">
                        <div class="head">
                            <div>Questions Lists</div>
                            {{-- <button>Print</button> --}}
                        </div>
                        <div class="table-block">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th class="question">Question</th>
                                        <th>Answer List</th>
                                        <th>Solution</th>
                                        <th>Question Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="searchTable">

                                    @foreach ($data as $key => $temp)
                                        <tr class="single-select">
                                            <td>{{ $temp->id }}.</td>
                                            <td>
                                                {{ $temp->question }}
                                            </td>
                                            <td class="question">
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
                                                        @foreach (unserialize($temp->answers) as $option)
                                                            <li>
                                                                @if (is_numeric($option))
                                                                    {{ $loop->index + 1 }}
                                                                @else
                                                                    {{ $option }}
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </td>
                                            <td>{{ $temp->type }}</td>
                                            <td>
                                                <div class="action-btns">
                                                    <a href="{{ route('question.edit', $temp->id) }}" class="button"><i
                                                            class="fa-solid fa-file-pen"></i></a>
                                                    <form action="{{ route('question.destroy', $temp->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="button" type="submit"><i
                                                                class="fa fa-trash"></i></button>
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

                    <div class="inner-block filter-block">
                        <div class="head">
                            Filter By
                        </div>
                        <div class="list">
                            <label for="single-select">
                                <input type="checkbox" name="question-type" class="question-filter" id="single-select"
                                    data-target="single-select" checked>
                                Single Selection Questions
                            </label>
                            <label for="multi-select">
                                <input type="checkbox" name="question-type" class="question-filter" id="multi-select"
                                    data-target="multi-select" checked>
                                Multi Selection Questions
                            </label>
                            {{-- <label for="single-word">
                                <input type="checkbox" name="question-type" class="question-filter" id="single-word"
                                    data-target="single-word" checked>
                                Exact Match Questions
                            </label> --}}
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('question.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="group-input">
                            <label for="ques-type">Question Type</label>
                            <select name="type" id="questionType" onchange="handleChange(this.value)">
                                <option value="">---</option>
                                <option value="Single Selection Questions"
                                    @if (old('type') == 'Single Selection Questions') selected @endif>Single Selection Questions</option>
                                <option value="Multi Selection Questions"@if (old('type') == 'Multi Selection Questions') selected @endif>
                                    Multi Selection Questions</option>
                                {{-- <option value="Exact Match Questions"@if (old('type') == 'Exact Match Questions') selected @endif>Exact
                                    Match Questions</option> --}}
                            </select>
                            <p id="typecheck" style="color: red;">
                                **Question Type is missing
                            </p>
                        </div>
                        <div class="group-input">
                            <label for="ques">Question</label>
                            <input type="text" name="question" id="question" value="{{ old('question') }}">
                            <p id="questioncheck" style="color: red;">
                                **Question is missing
                            </p>
                        </div>
                        <div class="group-input single_question-options" id="options-group">
                            <label for="options">
                                Options<button type="button" id="optionsbtnadd"><i class="fa-solid fa-plus"></i></button>
                            </label>
                            <div class="option-group">
                                <input type="text" id="option" name="options[]">
                                <input type="radio" class="answer" name="answer" value="0">
                            </div>
                            <div id="optionsdiv"></div>
                            <p id="optioncheck" style="color: red;">
                                **Options are missing
                            </p>
                        </div>

                        <div class="group-input multi_question-options" id="multi_options-group">
                            <label for="options">
                                Options<button type="button" id="multi_optionsbtnadd"><i class="fa-solid fa-plus"></i></button>
                            </label>
                            <div class="option-group">
                                <input type="text" id="option2" name="options[]">
                                <input type="checkbox" class="answer" name="answer" value="0">
                            </div>
                            <div id="multi_optionsdiv"></div>
                            <p id="optioncheck2" style="color: red;">
                                **Options are missing
                            </p>
                        </div> 

                        <div class="group-input question-answer">
                            <label for="answer" id="answer-label">
                                Answer<button type="button" id="answersbtnadd"><i class="fa-solid fa-plus"></i></button>
                            </label>
                            <div><small class="text-primary" id="infoQuestion"></small></div>
                            <input type="text" class="answer" id="answer" name="answers[]" >
                            <div id="answersdiv"></div>
                        </div>
                        <p id="answercheck" style="color: red;">
                            **Answer is missing
                        </p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="questionsubmitbtn" name="submit" value="save">Save</button>
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
        </script>

    <script>
        // ================================ Show and Hide Rows
        function toggleRows() {
            const checkboxes = document.querySelectorAll('.question-filter');
            checkboxes.forEach((checkbox) => {
                checkbox.addEventListener('change', () => {
                    const target = checkbox.dataset.target;
                    const rows = document.querySelectorAll(`.${target}`);
                    rows.forEach((row) => {
                        row.style.display = checkbox.checked ? '' : 'none';
                    });
                });
            });
        }

        toggleRows();


        // ============================= Deleting Rows
        const deleteButtons = document.querySelectorAll('.fa-trash-can');
        deleteButtons.forEach(button => {
            button.addEventListener('click', () => {
                const row = button.parentNode.parentNode.parentNode.parentNode;
                row.parentNode.removeChild(row);
            });
        });

        // ============================= Add Options Inputs
        // function addOption() {
        //     var newInput = document.createElement('input');
        //     newInput.type = 'text';
        //     newInput.name = 'options';
        //     var container = document.querySelector('.question-options');
        //     container.appendChild(newInput);
        // }

        // ============================= Add Answer Inputs
        // function addAnswer() {
        //     var newInput = document.createElement('input');
        //     newInput.type = 'text';
        //     newInput.name = 'options';
        //     var container = document.querySelector('.question-answer');
        //     container.appendChild(newInput);
        // }

        // =========================== Toggle Input Fields Using Select Options
        var answerGroup = document.querySelector('.question-answer');
            var singleOptionsGroup = document.querySelector('.single_question-options');
            var multiOptionsGroup = document.querySelector('.multi_question-options');
            var answerButton = document.querySelector('#answer-label button');
            var optionsButton = document.querySelector('.question-options button');
                answerGroup.style.display = 'block';
                answerButton.style.display = 'none';
                singleOptionsGroup.style.display = 'block';
                multiOptionsGroup.style.display = 'none';
                optionsButton.style.display = 'inline-block';

        function handleChange(value) {
            var answerGroup = document.querySelector('.question-answer');
            var singleOptionsGroup = document.querySelector('.single_question-options');
            var multiOptionsGroup = document.querySelector('.multi_question-options');
            var answerButton = document.querySelector('#answer-label button');
            var optionsButton = document.querySelector('.question-options button');
            if (value === 'Multi Selection Questions') {
                answerGroup.style.display = 'block';
                answerButton.style.display = 'inline-block';
                multiOptionsGroup.style.display = 'block';
                singleOptionsGroup.style.display = 'none';
                optionsButton.style.display = 'inline-block';
            } else if (value === 'Exact Match Questions') {
                answerGroup.style.display = 'block';
                answerButton.style.display = 'none';
                singleOptionsGroup.style.display = 'none';
                multiOptionsGroup.style.display = 'none';
                optionsButton.style.display = 'none';
            } else if (value === 'Single Selection Questions') {
                answerGroup.style.display = 'block';
                answerButton.style.display = 'none';
                singleOptionsGroup.style.display = 'block';
                multiOptionsGroup.style.display = 'none';
                // optionsButton.style.display = 'inline-block';
            }
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
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
        });

        // Add event listener for toggle button change event
        $('#toggle-options').change(function() {
            const isEnabled = $(this).is(':checked');
            $('input[name="options[]"]').prop('disabled', !isEnabled);
            $('input[name="answer"]').prop('disabled', !isEnabled);
        });
    </script>
@endsection
