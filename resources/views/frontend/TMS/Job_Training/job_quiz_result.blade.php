@extends('frontend.layout.main')

@section('container')

<style>
    
    .result-container {
        width: 100%;
        max-width: 700px;
        margin: 30px auto;
        padding: 30px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
        /* box-shadow: 0 9px 15px rgb(18 5 23 / 60%); */
        text-align: center;
        animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: translateY(-30px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    h1 {
        font-size: 2.5em;
        color: #2C3E50;
        margin-bottom: 20px;
        animation: fadeInDown 1s ease-in-out;
    }

    @keyframes fadeInDown {
        0% {
            opacity: 0;
            transform: translateY(-50px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    p {
        font-size: 1.2em;
    }

  
    .score-badge {
        font-size: 1.5em;
        background-color: #f1f1f1;
        padding: 10px 20px;
        border-radius: 50px;
        display: inline-block;
        margin-bottom: 20px;
        animation: zoomIn 0.8s ease-in-out;
    }

    @keyframes zoomIn {
        0% {
            transform: scale(0);
            opacity: 0;
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

 
    .pass {
        color: #28a745;
        font-weight: bold;
        animation: fadeIn 1s ease-in-out;
    }

    .fail {
        color: #e74c3c;
        font-weight: bold;
        animation: fadeIn 1s ease-in-out;
    }

    
    .details {
        display: flex;
        justify-content: space-between;
        padding: 20px;
        background-color: #f7f7f7;
        border-radius: 10px;
        margin-bottom: 30px;
        justify-content: center;
        animation: slideInUp 0.8s ease-in-out;
    }

    @keyframes slideInUp {
        0% {
            opacity: 0;
            transform: translateY(30px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .details div {
        text-align: left;
    }

    .details p {
        margin: 0;
        font-size: 1.2em;
    }

   
    .question-details {
        margin-top: 20px;
        text-align: left;
        animation: fadeIn 1s ease-in-out;
    }

    .question {
        margin-bottom: 20px;
        padding: 15px;
        border: 1px solid #ebebeb;
        border-radius: 8px;
        background-color: #fafafa;
        animation: slideInUp 0.8s ease-in-out;
    }

    .question p {
        margin: 5px 0;
        font-size: 1.1em;
    }


    .correct-answer {
        color: #28a745;
        font-weight: bold;
    }

    .incorrect-answer {
        color: #e74c3c;
        font-weight: bold;
    }

  
    .certificate {
        border: 3px solid #4374da;
        padding: 30px;
        margin-top: 40px;
        border-radius: 10px;
        background-color: #ecf7fe;
        text-align: center;
        color: #2C3E50;
        animation: bounceIn 1s ease-in-out;
    }

    @keyframes bounceIn {
        0%, 20%, 40%, 60%, 80%, 100% {
            transition-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
        }
        0% {
            opacity: 0;
            transform: scale3d(0.3, 0.3, 0.3);
        }
        20% {
            transform: scale3d(1.1, 1.1, 1.1);
        }
        40% {
            transform: scale3d(0.9, 0.9, 0.9);
        }
        60% {
            opacity: 1;
            transform: scale3d(1.03, 1.03, 1.03);
        }
        80% {
            transform: scale3d(0.97, 0.97, 0.97);
        }
        100% {
            opacity: 1;
            transform: scale3d(1, 1, 1);
        }
    }

    .certificate h2 {
        font-size: 2em;
        margin-bottom: 15px;
    }

   
    button {
        margin-top: 20px;
        padding: 15px 30px;
        background-color: #4374da;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1.2em;
        transition: background-color 0.3s;
        animation: slideInUp 0.8s ease-in-out;
    }

    button:hover {
        background-color: #2f6eed;
    }

    .text-white {
        color: white !important;
        text-decoration: none;
    }
</style>

<div class="result-container">
    <h1>Quiz Result</h1>
    <div class="score-badge">
        Your Score: <strong>{{ $score }}%</strong>
    </div>
    <p class="{{ $result == 'Pass' ? 'pass' : 'fail' }}">
        {{ $result == 'Pass' ? '🎉 Congratulations! You Passed! 🎉' : '💥 Sorry, You Failed. 💥' }}
    </p>

    @if ($result == 'Pass')
    <div class="certificate">
        <h2>🎉 Certificate of Achievement 🎉</h2>
        <p>We hereby certify that you have successfully passed the quiz with a score of {{ $score }}%.</p>
        <p>Keep up the excellent work!</p>
    </div>
    @else
        <div class="certificate">
            <h2>💥 Certificate of Completion 💥</h2>
            <p>Unfortunately, you did not pass the quiz. Your score was {{ $score }}%. Please review the material and try again!</p>
            <p>Better luck next time!</p>
        </div>
    @endif

  
    <div class="details">
        <div>
            <p>Total Questions: <strong>{{ $totalQuestions }}</strong></p>
            <p>Correct Answers: <strong>{{ $correctCount }}</strong></p>
            <p>Incorrect Answers: <strong>{{ $totalQuestions - $correctCount }}</strong></p>
        </div>
    </div>

    <div class="question-details">
        <h2>Question Breakdown</h2>
        @foreach($questionsWithAnswers as $index => $question)
            <div class="question">
                <p><strong>Question {{ $index + 1 }}:</strong> {{ $question['question_text'] }}</p>
                <p><strong>Your Answer:</strong>
                    <span class="{{ $question['is_correct'] ? 'correct-answer' : 'incorrect-answer' }}">
                        {{ $question['user_answer'] ?? 'Not answered' }}
                    </span>
                </p>
                <p><strong>Correct Answer:</strong> {{ $question['correct_answers'] }}</p>
            </div>
        @endforeach
    </div>

    <button type="button">
        <a class="text-white" href="{{ route('tms.training') }}">Go Back to Home</a>
    </button>
</div>

@endsection
