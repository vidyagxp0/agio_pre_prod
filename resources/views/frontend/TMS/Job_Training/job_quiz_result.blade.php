













@extends('frontend.layout.main')

@section('container')

<style>
    .result-container {
        width: 60%;
        max-width: 500px;
        margin: 20px auto;
        padding: 20px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .result-container h1 {
        font-size: 2em;
        color: #007BFF;
    }

    .result-container p {
        font-size: 1.2em;
        margin: 15px 0;
    }

    .pass {
        color: green;
    }

    .fail {
        color: red;
    }

    .certificate {
        border: 2px solid #007BFF;
        padding: 20px;
        margin-top: 20px;
        border-radius: 5px;
        background-color: #e7f3fe;
        color: #333;
    }

    .result-container .details {
        margin: 10px 0;
        padding: 10px;
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    button {
        margin-top: 20px;
        padding: 10px 20px;
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
</style>

<div class="result-container">
    <h1>Quiz Result</h1>
    <p>Your Score: <strong>{{ $score }}%</strong></p>
    <p class="{{ $result == 'Pass' ? 'pass' : 'fail' }}">
        {{ $result == 'Pass' ? 'Congratulations! You Passed!' : 'Sorry, You Failed.' }}
    </p>

    <div class="details">
        <p>Total Questions: <strong>{{ $totalQuestions }}</strong></p>
        <p>Correct Answers: <strong>{{ $correctCount }}</strong></p>
        <p>Incorrect Answers: <strong>{{ $totalQuestions - $correctCount }}</strong></p>
    </div>

    @if ($result == 'Pass')
        <!-- Display the pass certificate -->
        <div class="certificate">
            <h2>🎉Certificate of Achievement🎉</h2>
            <p>We hereby certify that you have successfully passed the quiz with a score of {{ $score }}%.</p>
            <p>Keep up the good work!</p>
        </div>
    @else
        <!-- Display the fail certificate -->
        <div class="certificate">
            <h2>💥Certificate of Completion💥</h2>
            <p>Unfortunately, you did not pass the quiz. Your score was {{ $score }}%. Please review the material and try again!</p>
            <p>Better luck next time!</p>
        </div>
    @endif

    <button >Go Back to Home</button>
</div>

@endsection

