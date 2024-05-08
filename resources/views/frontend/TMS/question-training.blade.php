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
    <div id="training-quiz-page">
        <div class="container-fluid">

            <div class="training-head-block">
                <div class="btns">
                    <a href="{{ route('TMS.index') }}"><button>Close Training</button></a>

                </div>
            </div>

            <div class="inner-block question-block">
                <div class="inner-block-content">
                    <header class="header">
                        <div class="left-title">Quiz</div>
                        <div class="right-title">Total Questions:<span id="tque"></span></div>
                    </header>
                    <div class="content">
                        <div id="result" class="quiz-body">
                            <form name="quizForm" onSubmit="">
                                <fieldset>
                                    <div class="question-data">
                                        <div id="qid">01.</div>
                                        <div id="question"></div>
                                    </div>

                                    <div class="option-block-container" id="question-options">

                                    </div>
                                </fieldset>
                                <div class="quiz-buttons">
                                    <button name="previous" id="previous">Previous</button>
                                    <button name="next" id="next">Next</button>
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
        var quiz = {
            "JS": [
                <?php echo $data_array; ?>
            ]
        }



        var quizApp = function() {

            this.score = 0;
            this.qno = 1;
            this.currentque = 0;
            var totalque = quiz.JS.length;
            var passing =  {{ $quize->passing }};
            var percentage = (passing/100)*totalque;




            this.displayQuiz = function(cque) {
                this.currentque = cque;
                if (this.currentque < totalque) {
                    $("#tque").html(totalque);
                    $("#previous").attr("disabled", false);
                    $("#next").attr("disabled", false);
                    $("#qid").html(quiz.JS[this.currentque].id + '.');


                    $("#question").html(quiz.JS[this.currentque].question);
                    $("#question-options").html("");
                    for (var key in quiz.JS[this.currentque].options[0]) {
                        if (quiz.JS[this.currentque].options[0].hasOwnProperty(key)) {

                            $("#question-options").append(
                                "<div class='option-block'>" +
                                "<label>" +
                                "<input type='radio' name='option'   id='q" + key +
                                "' value='" + quiz.JS[this.currentque].options[0][key] +
                                "'><span id='optionval'>" +
                                quiz.JS[this.currentque].options[0][key] +
                                "</span></label>"
                            );
                        }
                    }
                }
                if (this.currentque <= 0) {
                    $("#previous").attr("disabled", true);
                }
                if (this.currentque >= totalque) {
                    $('#next').attr('disabled', true);
                    for (var i = 0; i < totalque; i++) {
                        this.score = this.score + quiz.JS[i].score;
                    }
                    return this.showResult(this.score);
                }
            }

            this.showResult = function(scr) {
                $("#result").addClass('result');
                $("#result").html("<h1 class='res-header'>Total Score: &nbsp;" + scr + '/' + totalque + "</h1>");
                for (var j = 0; j < totalque; j++) {
                    var res;
                    if (quiz.JS[j].score == 0) {
                        res = '<span class="wrong">' + quiz.JS[j].score +
                            '</span><i class="fa fa-remove c-wrong"></i>';
                    } else {
                        res = '<span class="correct">' + quiz.JS[j].score +
                            '</span><i class="fa fa-check c-correct"></i>';
                    }
                    $("#result").append(
                        '<div class="result-question"><span>Q ' + quiz.JS[j].id + '</span> &nbsp;' + quiz.JS[j]
                        .question + '</div>' +
                        '<div><b>Correct answer:</b> &nbsp;' + quiz.JS[j].answers + '</div>' +
                        '<div class="last-row"><b>Score:</b> &nbsp;' + res +

                        '</div>'

                    );


                }
                if(scr >= percentage){
                    $(".btns").append('<button id="complete-training" data-bs-toggle="modal" data-bs-target="#trainee-sign">Complete Training</button>')

                }
            }

            this.checkAnswer = function(option) {
                var answer = quiz.JS[this.currentque].answer;
                option = option.replace(/\</g, "&lt;") //for <
                option = option.replace(/\>/g, "&gt;") //for >
                option = option.replace(/"/g, "&quot;")

                if (option == quiz.JS[this.currentque].answers) {
                    if (quiz.JS[this.currentque].score == "") {
                        quiz.JS[this.currentque].score = 1;
                        quiz.JS[this.currentque].status = "correct";
                    }
                } else {
                    quiz.JS[this.currentque].status = "wrong";
                }

            }

            this.changeQuestion = function(cque) {
                this.currentque = this.currentque + cque;
                this.displayQuiz(this.currentque);

            }

        }


        var jsq = new quizApp();

        var selectedopt;
        $(document).ready(function() {
            jsq.displayQuiz(0);

            $('#question-options').on('change', 'input[type=radio][name=option]', function(e) {

                //var radio = $(this).find('input:radio');
                $(this).prop("checked", true);
                selectedopt = $(this).val();
            });



        });




        $('#next').click(function(e) {
            e.preventDefault();
            if (selectedopt) {
                jsq.checkAnswer(selectedopt);
            }
            jsq.changeQuestion(1);
        });

        $('#previous').click(function(e) {
            e.preventDefault();
            if (selectedopt) {
                jsq.checkAnswer(selectedopt);
            }
            jsq.changeQuestion(-1);
        });
    </script>
@endsection
