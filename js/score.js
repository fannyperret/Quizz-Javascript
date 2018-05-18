function check() {

  var question0 = document.quiz.question0.value;
  var correct = ["C'est une bonne réponse !"];

  if (question0 == "63") {
    correct;
  }

  document.getElementById("after_response").style.visibility = "hidden";
  document.getElementById("after_submit").style.visibility = "visible";

  document.getElementById("rightOrWrong").innerHTML = correct;
  document.getElementById("answer-0")
}
