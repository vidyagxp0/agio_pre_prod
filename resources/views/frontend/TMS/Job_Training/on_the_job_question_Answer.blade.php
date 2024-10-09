@extends('frontend.layout.main')

@section('container')

<style>
    /* General Styles */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        color: #333;
        line-height: 1.6;
    }

    .instruction-note {
        background-color: #e7f3fe;
        border-left: 6px solid #2196F3;
        padding: 15px;
        margin-bottom: 20px;
    }

    .instruction-note h2 {
        color: #2196F3;
    }

    .quiz-container {
        width: 80%;
        max-width: 600px;
        margin: 20px auto;
        padding: 20px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #007BFF;
    }

    /* Question Styles */
    .question {
        margin-bottom: 20px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    .question-type {
        font-weight: bold;
        font-size: 14px;
        color: #555;
    }

    .question-text {
        margin: 10px 0;
        font-size: 1.2em;
    }

    /* Options Styles */
    div {
        margin: 5px 0;
    }

    input[type="radio"],
    input[type="checkbox"] {
        margin-right: 10px;
    }

    /* Button Styles */
    button {
        display: block;
        width: 100%;
        padding: 10px;
        margin-top: 20px;
        background-color: #007BFF;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1.1em;
    }

    button:hover {
        background-color: #0056b3;
    }

    .attempts-over {
        text-align: center;
        margin-top: 20px;
        color: #e74c3c;
    }
</style>

<div class="quiz-container">
    @if ($onthejobid->attempt_count == -1)
        <h1>Your attempts are over</h1>
    @else
        <div class="instruction-note">
            <h2>Instructions</h2>
            <ol>
                <li>Don't refresh, reload, or go back, as it will decrement your attempts.</li>
            </ol>
        </div>
        <h1>On The Job Training Quiz</h1>

        <form action="{{ route('check_answer_otj') }}" method="POST"> 
            @csrf 
            <input type="hidden"  name="training_id" value="{{ $onthejobid->id }}">
            <input type="hidden"  name="emp_id" value="{{ $onthejobid->empcode }}">
            <input type="hidden"  name="employee_name" value="{{ $onthejobid->name }}">
            <input type="hidden"  name="training_type" value="Induction Training">
            <input type="hidden"  name="attempt_count" value="{{ $onthejobid->attempt_count }}">
            @foreach ($questions as $index => $question) <!-- Use $index to display question number -->
                <div class="question">
                    <p class="question-text"><strong>Question {{ $index + 1 }}:</strong> {{ $question->question }} (<span class="question-type">{{ $question->type }}</span>)</p> <!-- Display index here -->

                    @php
                        // Unserialize the options and answers
                        $options = unserialize($question->options);
                        $answers = unserialize($question->answers);
                    @endphp

                    @if ($options && is_array($options) && count($options) > 0) 
                        @if ($question->type === 'Single Selection Questions')
                            @foreach ($options as $option)
                                @if ($option) 
                                    <div>
                                        <input type="radio" id="option_{{ $option }}" name="question_{{ $question->id }}" value="{{ $option }}">
                                        <label for="option_{{ $option }}">{{ $option }}</label>
                                    </div>
                                @endif
                            @endforeach
                        @elseif ($question->type === 'Multi Selection Questions')
                            @foreach ($options as $option)
                                @if ($option) <!-- Check if option is not null -->
                                    <div>
                                        <input type="checkbox" id="option_{{ $option }}" name="question_{{ $question->id }}[]" value="{{ $option }}">
                                        <label for="option_{{ $option }}">{{ $option }}</label>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    @else
                        <p>No options available for this question.</p> <!-- Message if no options are available -->
                    @endif
                </div>
                <hr>
            @endforeach

            <button type="submit">Submit</button>
        </form>
    @endif
</div>

@endsection
