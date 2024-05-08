// Document is ready
$(document).ready(function () {
	// Validate Question Type
	$("#typecheck").hide();
	let typecheckError = true;
	$("#questionType").keyup(function () {
		questionTypename();
	});
	function questionTypename() {
        let questionType = $("#questionType").val();
		if (questionType.length == "") {
			$("#typecheck").show();
			typecheckError = false;
			return false;
		}  else {
            typecheckError = true;
			$("#typecheck").hide();
		}
	}
    //question check
    $("#questioncheck").hide();
	let questionError = true;
	$("#question").keyup(function () {
		question();
	});
    function question() {
		let question = $("#question").val();
		if (question.length == "") {
			$("#questioncheck").show();
			questionError = false;
			return false;
		}  else {
            questionError = true;
			$("#questioncheck").hide();
		}
	}
    //options check
    $("#optioncheck").hide();
	let optionError = true;
	$("#option").keyup(function () {
		option();
	});
    function option() {
		// let option = $("#option").val();
        // let questionType = $("#questionType").val();
        // if(questionType != "Exact Match Questions"){
        //     if (option.length == "") {
        //         $("#optioncheck").show();
        //         optionError = false;
        //         return false;
        //     }  else {
        //         optionError = true;
        //         $("#optioncheck").hide();
        //     }
        // }
        // else{
        //     optionError = true;
        //     $("#optioncheck").hide();
        // }
        optionError = true;
            $("#optioncheck").hide();

	}

    //options check
    $("#optioncheck2").hide();
	let optionError2 = true;
	$("#option2").keyup(function () {
		option();
	});
    function option() {
		// let option = $("#option").val();
        // let questionType = $("#questionType").val();
        // if(questionType != "Exact Match Questions"){
        //     if (option.length == "") {
        //         $("#optioncheck2").show();
        //         optionError2 = false;
        //         return false;
        //     }  else {
        //         optionError2 = true;
        //         $("#optioncheck2").hide();
        //     }
        // }
        // else{
        //     optionError2 = true;
        //     $("#optioncheck2").hide();
        // }
        optionError2 = true;
            $("#optioncheck2").hide();

	}

    //answer check
    $("#answercheck").hide();
    let answerError = true;
    $("#answer").keyup(function () {
        answer();
    });
    function answer() {
        let answer = $("#answer").val();
            if (answer.length == "") {
                $("#answercheck").show();
                answerError = false;
                return false;
            }  else {
                answerError = true;
                $("#answercheck").hide();
            }
    }

	// Submit button
	$("#questionsubmitbtn").click(function () {
		questionTypename();
        question();
        option();
        answer();
		if (
			typecheckError == true &&
            questionError == true &&
            optionError == true &&
            answerError == true
		) {
			return true;
		} else {
			return false;
		}
	});

    // Quize Validations
    //title
    $("#quizecheck").hide();
	let quizecheckError = true;
	$("#quize-title").keyup(function () {
		quizeTitle();
	});
	function quizeTitle() {
        let quizeTitle = $("#quize-title").val();
		if (quizeTitle == "") {
			$("#quizecheck").show();
			quizecheckError = false;
			return false;
		}  else {
            quizecheckError = true;
			$("#quizecheck").hide();
		}
	}

       //Passing percentage
       $("#passingcheck").hide();
       let passingcheckError = true;
       $("#passing-percentage").keyup(function () {
        passingcheck();
       });
       function passingcheck() {
           let passingcheck = $("#passing-percentage").val();
           if (passingcheck == "") {
               $("#passingcheck").show();
               passingcheckError = false;
               return false;
           }  else {
               passingcheckError = true;
               $("#passingcheck").hide();
           }
       }

              //Passing percentage
              $("#question-bank-check").hide();
              let questionbankError = true;
              $("#question-bank").keyup(function () {
                questionbankcheck();
              });
              function questionbankcheck() {
                  let questionbank = $("#question-bank").val();
                  if (questionbank == "") {
                      $("#question-bank-check").show();
                      questionbankError = false;
                      return false;
                  }  else {
                    questionbankError = true;
                      $("#question-bank-check").hide();
                  }
              }





                            	// Submit button
       $("#quize-Submit").click(function () {
		quizeTitle();
        passingcheck();
        questionbankcheck();

		if (
			quizecheckError == true &&
            passingcheckError == true &&
            questionbankError == true
		) {
			return true;
		} else {
			return false;
		}
	});

//Training Plan

 //Name
 $("#trainingType").hide();
 let trainingTypeError = true;
 $("#training-select").keyup(function () {
    trainingType();
 });
 function trainingType() {
     let traning_plan_name = $("#training-select").val();
     if (traning_plan_name == "") {
         $("#trainingType").show();
         trainingTypeError = false;
         return false;
     }  else {
        trainingTypeError = true;
         $("#trainingType").hide();
     }
 }

 //Passing percentage
 $("#assessmentrequirederror").hide();
 let assessmentError = true;
 $("#assessment_required").keyup(function () {
     trainingAssessment();
 });
 function trainingAssessment() {
     let traning_plan_name = $("#training-select").val();
     let trainingQuiz = $("#assessment_required").val();
     if(traning_plan_name == "Classroom Training"){
         if (trainingQuiz == "") {
             $("#assessmentrequirederror").show();
             assessmentError = false;
             return false;
         }  else {
             assessmentError = true;
             $("#assessmentrequirederror").hide();
         }
     }
     else{
         assessmentError = true;
             $("#assessmentrequirederror").hide();
     }

 }


  //Passing percentage
  $("#trainingPlan").hide();
  let trainingPlanError = true;
  $("#traning_plan_name").keyup(function () {
     trainingPlan();
  });
  function trainingPlan() {
      let traning_plan_name = $("#traning_plan_name").val();
      if (traning_plan_name == "") {
          $("#trainingPlan").show();
          trainingPlanError = false;
          return false;
      }  else {
         trainingPlanError = true;
          $("#trainingPlan").hide();
      }
  }


    //Passing percentage
    $("#trainingQuiz").hide();
    let quizError = true;
    $("#quizzz").keyup(function () {
        trainingQuiz();
    });
    function trainingQuiz() {
        let traning_plan_name = $("#training-select").val();
        let trainingQuiz = $("#quizzz").val();
        if(traning_plan_name == "Read & Understand with Questions"){
            if (trainingQuiz == "") {
                $("#trainingQuiz").show();
                quizError = false;
                return false;
            }  else {
                quizError = true;
                $("#trainingQuiz").hide();
            }
        }
        else{
            quizError = true;
                $("#trainingQuiz").hide();
        }

    }


        //Passing percentage
        $("#trainingCriteria").hide();
        let trainingCriteriaError = true;
        $("#effective").keyup(function () {
            trainingCriteria();
        });
        function trainingCriteria() {
            let traning_plan_name = $("#training-select").val();
            let trainingCriteria = $("#effective").val();
            if(traning_plan_name == "Read & Understand with Questions"){
                if (trainingCriteria == "") {
                    $("#trainingCriteria").show();
                    trainingCriteriaError = false;
                    return false;
                }  else {
                    trainingCriteriaError = true;
                    $("#trainingCriteria").hide();
                }
            }
            else{
                trainingCriteriaError = true;
                    $("#trainingCriteria").hide();
            }

        }


          //Passing percentage
  $("#SOPType").hide();
  let SOPTypeError = true;
  $("#sopData").keyup(function () {
    SOPType();
  });
  function SOPType() {
      let sop = $("#sopData").val();

      if (sop == "") {
          $("#SOPType").show();
          SOPTypeError = false;
          return false;
      }  else {
        SOPTypeError = true;
          $("#SOPType").hide();
      }
  }

    //Passing percentage
    $("#TraineeType").hide();
    let TraineeTypeError = true;
    $("#trainee").keyup(function () {
        TraineeType();
    });
    function TraineeType() {
        let trainee = $("#trainee").val();
        if (trainee == "") {
            $("#TraineeType").show();
            TraineeTypeError = false;
            return false;
        }  else {
            TraineeTypeError = true;
            $("#TraineeType").hide();
        }
    }

    // Submit button
    $("#SubmitTraining").click(function () {
        trainingType();
        trainingPlan();
        trainingQuiz();
        SOPType();
        TraineeType();


        if (
            trainingPlanError == true &&
            trainingTypeError == true &&
            quizError == true &&
            TraineeTypeError == true &&
            SOPTypeError == true
        ) {
            return true;
        } else {
            return false;
        }
    });


    //Passing percentage
    $("#ChangeTitleError").hide();
    let ChangeTitleError = true;
    $("#ChangeTitle").keyup(function () {
        ChangeTitle();
    });
    function ChangeTitle() {
        let ChangeTitle = $("#ChangeTitle").val();
        if (ChangeTitle == "") {
            $("#ChangeTitleError").show();
            ChangeTitleError = false;
            return false;
        }  else {
            ChangeTitleError = true;
            $("#ChangeTitleError").hide();
        }
    }

    //Passing percentage
    $("#Changeshort_descriptionError").hide();
    let Changeshort_descriptionError = true;
    $("#Changeshort_description").keyup(function () {
        Changeshort_description();
    });
    function Changeshort_description() {
        let Changeshort_description = $("#Changeshort_description").val();
        if (Changeshort_description == "") {
            $("#Changeshort_descriptionError").show();
            Changeshort_descriptionError = false;
            return false;
        }  else {
            Changeshort_descriptionError = true;
            $("#Changeshort_descriptionError").hide();
        }
    }

    //Passing percentage
    $("#Changedue_dateError").hide();
    let Changedue_dateError = true;
    $("#Changedue_date").keyup(function () {
        Changedue_date();
    });
    function Changedue_date() {
        let Changedue_date = $("#Changedue_date").val();
        if (Changedue_date == "") {
            $("#Changedue_dateError").show();
            Changedue_dateError = false;
            return false;
        }  else {
            Changedue_dateError = true;
            $("#Changedue_dateError").hide();
        }
    }

    //Passing percentage
    $("#ChangecftError").hide();
    let ChangecftError = true;
    $("#cft").keyup(function () {
        cft();
    });
    function cft() {
        let cft = $("#cft").val();
        if (cft == "") {
            $("#ChangecftError").show();
            ChangecftError = false;
            return false;
        }  else {
            ChangecftError = true;
            $("#ChangecftError").hide();
        }
    }
        //Passing percentage
        $("#Changedocument_requiredError").hide();
        let Changedocument_requiredError = true;
        $("#document_required").keyup(function () {
            document_required();
        });
        function document_required() {
            let document_required = $("#document_required").val();
            if (document_required == "") {
                $("#Changedocument_requiredError").show();
                Changedocument_requiredError = false;
                return false;
            }  else {
                Changedocument_requiredError = true;
                $("#Changedocument_requiredError").hide();
            }
        }

        // Submit button
        $("#ChangeNextButton").click(function () {
            ChangeTitle();
            Changeshort_description();
            Changedue_date();
            cft();
            document_required();
            if (
                ChangeTitleError == true &&
                Changeshort_descriptionError == true &&
                Changedue_dateError == true &&
                ChangecftError == true &&
                Changedocument_requiredError == true
            ) {
                nextStep();
            } else {
               alert('Please fill the Required datafields');
               return false;
            }
        });

                // Submit button
                $("#ChangesaveButton").click(function () {
                    ChangeTitle();
                    Changeshort_description();
                    Changedue_date();
                    cft();
                    document_required();
                    if (
                        ChangeTitleError == true &&
                        Changeshort_descriptionError == true &&
                        Changedue_dateError == true &&
                        ChangecftError == true &&
                        Changedocument_requiredError == true
                    ) {
                        return true;
                    } else {
                        alert('Please fill the Required datafields');
                        return false;
                    }
                });

        //Passing percentage
        $("#docnameError").hide();
        let docnameError = true;
        $("#docname").keyup(function () {
        docname();
        });
        function docname() {
        let docname = $("#docname").val();
        if (docname == "") {
            $("#docnameError").show();
            docnameError = false;
            return false;
        }  else {
        docnameError = true;
            $("#docnameError").hide();
        }
        }

        $("#short_descError").hide();
        let short_descError = true;
        $("#short_desc").keyup(function () {
            short_desc();
        });
        function short_desc() {
        let short_desc = $("#short_desc").val();
        if (short_desc == "") {
            $("#short_descError").show();
            short_descError = false;
            return false;
        }  else {
            short_descError = true;
            $("#short_descError").hide();
        }
        }


        $("#due_dateDocError").hide();
        let due_dateDocError = true;
        $("#due_dateDoc").keyup(function () {
            due_dateDoc();
        });
        function due_dateDoc() {
        let due_dateDoc = $("#due_dateDoc").val();
        if (due_dateDoc == "") {
            $("#due_dateDocError").show();
            due_dateDocError = false;
            return false;
        }  else {
            due_dateDocError = true;
            $("#due_dateDocError").hide();
        }
        }

        $("#depart-nameError").hide();
        let departnameError = true;
        $("#depart-name").keyup(function () {
            departname();
        });
        function departname() {
        let departname = $("#depart-name").val();
        if (departname == "") {
            $("#depart-nameError").show();
            departnameError = false;
            return false;
        }  else {
            departnameError = true;
            $("#depart-nameError").hide();
        }
        }

         $("#minorError").hide();
        let minorError = true;
        $("#minor").keyup(function () {
            minor();
        });
        function minor() {
        let minor = $("#minor").val();
        if (minor == "") {
            $("#minorError").show();
            minorError = false;
            return false;
        }  else {
            minorError = true;
            $("#minorError").hide();
        }
        }

        $("#doc-typeError").hide();
        let doctypeError = true;
        $("#doc-type").keyup(function () {
            doctype();
        });
        function doctype() {
        let doctype = $("#doc-type").val();
        if (doctype == "") {
            $("#doc-typeError").show();
            doctypeError = false;
            return false;
        }  else {
            doctypeError = true;
            $("#doc-typeError").hide();
        }
        }


        $("#reviewerError").hide();
        let reviewerError = true;
        $(".choices-multiple-reviewer").keyup(function () {
            reviewer();
        });
        function reviewer() {
        let reviewer = $(".choices-multiple-reviewer").val();
        if (reviewer == "") {
            $("#reviewerError").show();
            reviewerError = false;
            return false;
        }  else {
            reviewerError = true;
            $("#reviewerError").hide();
        }
        }


        $("#approverError").hide();
        let approverError = true;
        $(".choices-multiple-approver").keyup(function () {
            approver();
        });
        function approver() {
        let approver = $(".choices-multiple-approver").val();
        if (approver == "") {
            $("#approverError").show();
            approverError = false;
            return false;
        }  else {
            approverError = true;
            $("#approverError").hide();
        }
        }

     // Submit button
     $("#DocsaveButton").click(function () {
        docname();
        short_desc();
        due_dateDoc();
        departname();
        doctype();
        reviewer();
        approver();
        if (
            docnameError == true &&
            short_descError == true &&
            due_dateDocError == true &&
            departnameError == true &&
            doctypeError == true &&
            reviewerError == true &&
            approverError == true
        ) {
            return true;
        } else {
            alert('Please fill the Required datafields');
            return false;
        }
    });
         // Submit button
         $("#DocnextButton").click(function () {
            docname();
            short_desc();
            due_dateDoc();
            departname();
            doctype();
            reviewer();
            approver();
            if (
                docnameError == true &&
                short_descError == true &&
                due_dateDocError == true &&
                departnameError == true &&
                doctypeError == true &&
                reviewerError == true &&
                approverError == true
            ) {
                nextStep();
            } else {
                alert('Please fill the Required datafields');
                return false;
            }
        });



});
