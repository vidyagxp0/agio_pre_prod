@extends('frontend.layout.main')
@section('container')
@include('frontend.TMS.head')

    <div id="edit-question">
        <div class="container-fluid">
            <div class="inner-block">
                <div class="main-head">
                    Edit Question
                </div>
                <div class="inner-block-content">
                    <form action="{{ route('question.update',$question->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="group-input">
                            <label for="ques-type">Question Type</label>
                            <select name="type" id="questionType" onchange="handleChange(this.value)" disabled>
                                <option value="">---</option>
                                <option value="Single Selection Questions" @if($question->type == 'Single Selection Questions')selected @endif>Single Selection Questions</option>
                                <option value="Multi Selection Questions"@if($question->type == 'Multi Selection Questions')selected @endif>Multi Selection Questions</option>
                                {{-- <option value="Exact Match Questions"@if($question->type == 'Exact Match Questions')selected @endif>Exact Match Questions</option> --}}
                            </select>
                                <p id="typecheck"
                                style="color: red;">
                                **Question Type is missing
                                </p>
                        </div>
                        <div class="group-input">
                            <label for="ques">Question</label>
                            <input type="text" name="question" id="question" value="{{ $question->question }}">
                            <p id="questioncheck"
                            style="color: red;">
                            **Question is missing
                          </p>
                        </div>
                        @if($question->type == 'Single Selection Questions')
                        
                        <div class="group-input question-options" id="options-group">
                            <label for="options">
                                Options<button type="button" id="optionsbtnadd"><i class="fa-solid fa-plus"></i></button>
                            </label>
                            @if (!empty($question->options))
                                @foreach (unserialize($question->options) as $option)
                                    @if (!is_null($option))
                                        <div class="option-group">
                                            <input type="text" id="option" name="options[]" value="{{ $option }}">
                                            <input type="radio" class="answer" name="answer" value="{{ $option }}" 
                                                {{ in_array($option, unserialize($question->answers)) ? 'checked' : '' }}>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                            <input type="text" id="option" name="options[]">
                            <input type="radio" class="answer" name="answer" value="0">
                            @endif

                            <div id="optionsdiv"></div>
                        </div>
                            <p id="optioncheck"
                            style="color: red;">
                            **Options are missing
                            </p>

                            @else
                            <div class="group-input multi_question-options" id="multi_options-group">
                                <label for="options">
                                    Options<button type="button" id="multi_optionsbtnadd"><i class="fa-solid fa-plus"></i></button>
                                </label>
                                @if (!empty($question->options))
                                    @foreach (unserialize($question->options) as $option)
                                        @if (!is_null($option))
                                            <div class="option-group">
                                                <input type="text" id="option" name="options[]" value="{{ $option }}">
                                                <input type="checkbox" class="answer" name="answer" value="{{ $option }}" 
                                                    {{ in_array($option, unserialize($question->answers)) ? 'checked' : '' }}>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                                
                                    
                                    <div id="multi_optionsdiv"></div>
                                    <p id="optioncheck2" style="color: red;">
                                        **Options are missing
                                    </p>
                                </div> 

                            @endif


                            
 
                        <div class="group-input question-answer">
                            <label for="answer" id="answer-label">
                                Answer @if($question->type == 'Single Selection Questions') @else <button type="button" id="answersbtnadd"><i class="fa-solid fa-plus"></i></button> @endif
                                <div> <small style="
                                    font-weight: 500;
                                " class="text-primary" id="infoQuestion">@if($question->type == 'Single Selection Questions') Info: Value auto-populates upon selecting correct answer above. @else You need to write down the correct value answer in the below answer field and click the + button to add more correct answers.@endif </small></div>
                            </label>
                            @if (!empty($question->answers))
                            @foreach (unserialize($question->answers) as $data)
                            <div class="answer-group">
                                    <input type="text" id="answer" readonly name="answers[]" multiple
                                        value="{{ $data }}">
                            </div>
                            @endforeach
                            @else
                            <input type="text" id="answer" name="answers[]">
                            <input type="radio" class="answer" name="answer" value="" readonly>
                            @endif
                            
                            <div id="answersdiv"></div>
                        </div>
                            <p id="answercheck"
                            style="color: red;">
                            **Answer is missing
                            </p>
                        </div>
                        <div class="submit-btn">
                            <button type="submit" id="questionsubmitbtn">Update Question</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>


        // =========================== Toggle Input Fields Using Select Options
        function handleChange(value) {
            var answerGroup = document.querySelector('.question-answer');
            var optionsGroup = document.querySelector('.question-options');
            var answerButton = document.querySelector('#answer-label button');
            var optionsButton = document.querySelector('.question-options button');
            if (value === 'Multi Selection Questions') {
                answerGroup.style.display = 'block';
                answerButton.style.display = 'block';
                optionsGroup.style.display = 'block';
                optionsButton.style.display = 'inline-block';
            } else if (value === 'Exact Match Questions') {
                answerGroup.style.display = 'block';
                answerButton.style.display = 'none';
                optionsGroup.style.display = 'none';
                optionsButton.style.display = 'none';
            } else if (value === 'Single Selection Questions') {
                answerGroup.style.display = 'block';
                answerButton.style.display = 'none';
                optionsGroup.style.display = 'block';
                optionsButton.style.display = 'inline-block';
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
        </script>

@endsection
