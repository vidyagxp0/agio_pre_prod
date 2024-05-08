@extends('frontend.layout.main')
@section('container')
<script type="text/javascript">
    window.history.pushState({ page: 1 }, "", "");
    window.addEventListener("popstate", function(event) {
      window.history.pushState({ page: 2 }, "", "");
      alert("You Can not back, please press the Close training button.");
    });

    </script>
    {{-- ======================================
                    HEAD BUTTONS
    ======================================= --}}
    <style>
      #complete-training{
        background: Black !important;
      }
    </style>
    <div id="training-quiz-page">
        <div class="container-fluid">

            <div class="training-head-block">
                <div class="btns">
                    <a href="{{ route('TMS.index') }}"><button style="background: Black">Close Training</button></a>

                </div>
            </div>

            <div class="inner-block question-block">
                <div class="inner-block-content">
                    <header class="header">
                        <div class="left-title">Quiz</div>
                        {{-- <div class="right-title">Total Questions: <span id="tque"></span></div> --}}
                    </header>
                    <div class="content">
                        <div id="result" class="quiz-body">
                            <form name="quizForm" onSubmit="">
                                <fieldset>
                                    <div class="question-data">
                                        <div id="qid"></div>
                                        <div id="question"></div>
                                    </div>

                                    <div class="option-block-container" id="question-options">

                                    </div>
                                </fieldset>
                                <div class="quiz-buttons">
                                  <button name="next" id="back-btn">Back</button>
                                  <button type="button" id="submit-btn">Submit</button>
                                    <button type="button" id="next-btn">Next</button>
                                </div>
                                <div id="summary-container" style="display: none;">
                                    <h2>Quiz Summary</h2>
                                    <p id="total-marks"></p>
                                    <ul id="summary"></ul>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div class="modal fade" id="trainee-sign">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <form action="{{ url('trainingComplete', $document->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="electronic-meaning">Electronic Signature Approved Meaning</label>
                            <select name="electronic-meaning">
                                <option selected>- Please Select -</option>
                                <option value="train-complete">Training Completed</option>
                            </select>
                        </div>
                        <div class="group-input">
                            <label for="username">Username</label>
                            <input type="text" name="email" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password</label>
                            <input type="password" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment</label>
                            <textarea name="comment"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                        <button>Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var idElement = document.getElementById('qid');
        var questionElement = document.getElementById('question');
var choicesElement = document.getElementById('question-options');
var backBtn = document.getElementById('back-btn');
var nextBtn = document.getElementById('next-btn');
var submitBtn = document.getElementById('submit-btn');
var summaryElement = document.getElementById('summary-container');
var totalMarksElement = document.getElementById('total-marks');

var quizData;
var currentQuestion = 0;
var userAnswers = [];

// Fetch quiz data from JSON file
fetch("{{ url('example',$document->id) }}")
  .then(function(response) {
    return response.json();
  })
  .then(function(data) {
    quizData = data;
    loadQuestion();
  })
  .catch(function(error) {
    console.log('Error fetching quiz data:', error);
  });

// Function to load question and choices
function loadQuestion() {


  var question = quizData[currentQuestion];
  questionElement.textContent = question.question;
  idElement.textContent = question.id;
  choicesElement.innerHTML = '';

  if (typeof question.answer === 'string') {
    var input = document.createElement('input');
    input.type = 'text';
    input.name = 'answer';
    input.placeholder = 'Type your answer...';
    choicesElement.appendChild(input);
  } else {
    for (var i = 0; i < question.choices.length; i++) {
      var li = document.createElement('li');
      var label = document.createElement('label');
      var input = document.createElement('input');
      input.type = question.answer instanceof Array ? 'checkbox' : 'radio';
      input.name = 'answer';
      input.value = i+1;
      label.appendChild(input);
      label.appendChild(document.createTextNode(question.choices[i]));
      li.appendChild(label);
      choicesElement.appendChild(li);
    }
  }

  updateButtons();
}

// Function to update navigation buttons
function updateButtons() {
  backBtn.disabled = currentQuestion === 0;
  nextBtn.disabled = currentQuestion === quizData.length - 1;
  submitBtn.style.display = currentQuestion === quizData.length - 1 ? 'block' : 'none';
}

// Function to go to the next question
function nextQuestion() {
  saveAnswer();
  currentQuestion++;
  loadQuestion();
}

// Function to go to the previous question
function previousQuestion() {
  saveAnswer();
  currentQuestion--;
  loadQuestion();
}

// Function to save the user's answer
function saveAnswer() {
  var inputs = document.getElementsByName('answer');

  var answer = [];

  for (var i = 0; i < inputs.length; i++) {
    if (inputs[i].type === 'text') {
      
      answer.push(inputs[i].value);
    } else if (inputs[i].type === 'checkbox' && inputs[i].checked) {
      answer.push(i);
    } else if (inputs[i].type === 'radio' && inputs[i].checked) {
      answer = [i];
     // answer = i+1;
      break;
    }
  }
  
  userAnswers[currentQuestion] = answer;
  console.log('userAnswer',userAnswers);
}

// Function to compare two arrays
function arraysEqual(arr1, arr2) {
  if (arr1.length !== arr2.length) {
    return false;
  }

  for (var i = 0; i < arr1.length; i++) {
    if (arr1[i] !== arr2[i]) {
      return false;
    }
  }

  return true;
}

// Function to display quiz summary
function displaySummary(marks) {
  questionElement.style.display = 'none';
  choicesElement.style.display = 'none';
  backBtn.style.display = 'none';
  nextBtn.style.display = 'none';
  submitBtn.style.display = 'none';
  summaryElement.style.display = 'block';
  totalMarksElement.textContent = 'Total Marks: ' + marks + '/' + quizData.length;

  for (var i = 0; i < quizData.length; i++) {
    var li = document.createElement('li');
    var question = quizData[i].question;
    var userAnswer = userAnswers[i];
    var summaryText = '';

    if (typeof quizData[i].answer === 'string') {
      summaryText = question + ' (Exact Answer): ';

      if (quizData[i].answer.toLowerCase() === userAnswer[0].toLowerCase()) {
        summaryText += 'Correct';
        marks++;
      } else {
        summaryText += 'Incorrect';
      }
    } else if (Array.isArray(quizData[i].answer)) {
      summaryText = question + ' (Multiple Select): ';

      if (arraysEqual(quizData[i].answer, userAnswer)) {
        summaryText += 'Correct';
        marks++;
      } else {
        summaryText += 'Incorrect';
      }
    } else {
      summaryText = question + ' (Single Select): ';

      if (quizData[i].answer == userAnswer) {
        summaryText += 'Correct';
        marks++;
      } else {
        summaryText += 'Incorrect';
      }
    }

    li.textContent = summaryText;
    summaryElement.appendChild(li);
  }
}

// Function to submit the quiz
function submitQuiz() {
  saveAnswer();
  var marks = 0;

  for (var i = 0; i < quizData.length; i++) {
    var correctAnswer = quizData[i].answer;
    var userAnswer = userAnswers[i];
    console.log(correctAnswer+' == '+userAnswer);
    
    if (typeof correctAnswer === 'string') {
      if (correctAnswer.toLowerCase() === userAnswer[0].toLowerCase()) {
        marks++;
      }
    } else if (Array.isArray(correctAnswer)) {
      if (arraysEqual(correctAnswer, userAnswer)) {
        marks++;
      }
    } else {
      if (correctAnswer == userAnswer) {
        marks++;
      }
    }
  }

  displaySummary(marks);

  var passing =  {{ $quize->passing }};
  var totalque = quizData.length;
  var percentage = (passing/100)*totalque;

  // if (marks >= percentage) {

// Find the element with the "btns" class
var btnsElement = document.querySelector(".btns");

// Create the button element
var button = document.createElement("button");
button.id = "complete-training";
button.setAttribute("data-bs-toggle", "modal");
button.setAttribute("data-bs-target", "#trainee-sign");
button.textContent = "Complete Training";

// Append the button to the btnsElement
btnsElement.innerHTML += button.outerHTML;

// }


}

// Event listeners for navigation buttons
nextBtn.addEventListener('click', nextQuestion);
backBtn.addEventListener('click', previousQuestion);
submitBtn.addEventListener('click', submitQuiz);

    </script>
@endsection
