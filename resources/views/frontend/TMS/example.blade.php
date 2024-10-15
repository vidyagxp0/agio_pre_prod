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
                <button id="completeBtn" style="display: none; margin-left: 10px" data-bs-toggle="modal" data-bs-target="#trainee-sign">
                  Submit Signature<i class="fa-regular fa-paper-plane"></i>
              </button>
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
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal"> <i class="fa fa-times"></i> </button>

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
        var completeBtn = document.getElementById('completeBtn');
        var summaryElement = document.getElementById('summary-container');
        var totalMarksElement = document.getElementById('total-marks');

        var quizData;
        var currentQuestion = 0;
        var userAnswers = [];

// Local Serve
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

  // Live serve api https

// fetch("{{ url()->secure('example', $document->id) }}")
//   .then(function(response) {
//     return response.json();
//   })
//   .then(function(data) {
//     quizData = data;
//     loadQuestion();
//   })
//   .catch(function(error) {
//     console.log('Error fetching quiz data:', error);
//   });

function loadQuestion() {
  var question = quizData[currentQuestion]; 
  var questionType = question.type;

  questionElement.textContent = question.question; 
  idElement.textContent = question.id; 
  choicesElement.innerHTML = ''; 

  if (questionType === 'Single Selection Questions') {
    // Single selection (radio buttons)
    for (var i = 0; i < question.choices.length; i++) {
      var li = document.createElement('li');
      var label = document.createElement('label');
      var input = document.createElement('input');
      input.type = 'radio';
      input.name = 'answer';
      input.value = i;
      label.appendChild(input);
      label.appendChild(document.createTextNode(question.choices[i]));
      li.appendChild(label);
      choicesElement.appendChild(li);
    }
  } 
  else if (questionType === 'Multi Selection Questions') {
    // Multi selection (checkboxes)
    for (var i = 0; i < question.choices.length; i++) {
      var li = document.createElement('li');
      var label = document.createElement('label');
      var input = document.createElement('input');
      input.type = 'checkbox';
      input.name = 'answer';
      input.value = i;
      label.appendChild(input);
      label.appendChild(document.createTextNode(question.choices[i]));
      li.appendChild(label);
      choicesElement.appendChild(li);
    }
  }

  // Update navigation buttons (Next/Submit)
  updateButtons(); 
}




function updateButtons() {
  backBtn.disabled = currentQuestion === 0;
  nextBtn.disabled = currentQuestion === quizData.length - 1;
  submitBtn.style.display = currentQuestion === quizData.length - 1 ? 'block' : 'none';
}


function nextQuestion() {
  saveAnswer();
  currentQuestion++;
  loadQuestion();
}

function previousQuestion() {
  saveAnswer();
  currentQuestion--;
  loadQuestion();
}


function displaySummary(marks) {
  var percentageScore = ((marks / quizData.length) * 100).toFixed(2);

  if (percentageScore >= 80) {
    completeBtn.style.display = 'block';
  } else {
    completeBtn.style.display = 'none'; 
  }

  questionElement.style.display = 'none';
  choicesElement.style.display = 'none';
  backBtn.style.display = 'none';
  nextBtn.style.display = 'none';
  submitBtn.style.display = 'none';
  summaryElement.style.display = 'block';
  totalMarksElement.textContent = `Total Marks: ${marks} / ${quizData.length} (${percentageScore}%)`;

  
  var summaryList = document.getElementById('summary');
  summaryList.innerHTML = '';

  
  for (var i = 0; i < quizData.length; i++) {
    var li = document.createElement('li');
    var question = quizData[i].question;
    var userAnswer = userAnswers[i];
    var correctAnswer = parseCorrectAnswer(quizData[i].answers, quizData[i].type); 

    var summaryText = `Question ${i + 1}: ${question} - `;


    if (quizData[i].type === 'Single Selection Questions') {
      if (correctAnswer === quizData[i].choices[userAnswer[0]]) { 
        summaryText += 'Correct';
      } else {
        summaryText += 'Incorrect';
      }
    } 
    
    else if (quizData[i].type === 'Multi Selection Questions') {
      var userSelectedChoices = userAnswer.map(index => quizData[i].choices[index]); 
      if (arraysEqual(correctAnswer, userSelectedChoices)) {
        summaryText += 'Correct';
      } else {
        summaryText += 'Incorrect';
      }
    }

    li.textContent = summaryText;
    summaryList.appendChild(li);
  }
}




function parseCorrectAnswer(serializedAnswer, questionType) {
  if (!serializedAnswer) return [];

  var match = serializedAnswer.match(/s:\d+:"(.*?)";/);
  if (match && match[1]) {
    var answerString = match[1].trim();

    if (questionType === 'Single Selection Questions') {
      return answerString; 
    } else if (questionType === 'Multi Selection Questions') {
      return answerString.split(',').map(answer => answer.trim());
    }
  }
  return [];
} 




function arraysEqual(arr1, arr2) {
  if (arr1.length !== arr2.length) return false;
  arr1.sort();
  arr2.sort();
  for (var i = 0; i < arr1.length; i++) {
    if (arr1[i] !== arr2[i]) return false;
  }
  return true;
}



function saveAnswer() {
  var inputs = document.getElementsByName('answer');
  var answer = [];

  if (quizData[currentQuestion].type === 'Single Selection Questions') {
    for (var i = 0; i < inputs.length; i++) {
      if (inputs[i].checked) {
        answer = [i]; 
        break;
      }
    }
  } 
  else if (quizData[currentQuestion].type === 'Multi Selection Questions') {
    for (var i = 0; i < inputs.length; i++) {
      if (inputs[i].checked) {
        answer.push(i); 
      }
    }
  }

  userAnswers[currentQuestion] = answer;
  console.log(`Saved answer for question ${currentQuestion}`, answer);
}


function submitQuiz() {
  saveAnswer(); 
  var marks = 0;

  for (var i = 0; i < quizData.length; i++) {
    var correctAnswer = parseCorrectAnswer(quizData[i].answers, quizData[i].type); 
    var userAnswer = userAnswers[i];

    if (quizData[i].type === 'Single Selection Questions') {
      if (quizData[i].choices[userAnswer[0]] === correctAnswer) { 
        marks++; 
      }
    } 
    else if (quizData[i].type === 'Multi Selection Questions') {
      var userSelectedChoices = userAnswer.map(index => quizData[i].choices[index]); 
      if (arraysEqual(correctAnswer, userSelectedChoices)) {
        marks++; 
      }
    }
  }

  displaySummary(marks); 

}



nextBtn.addEventListener('click', nextQuestion);
backBtn.addEventListener('click', previousQuestion);
submitBtn.addEventListener('click', submitQuiz);

    </script>
@endsection
