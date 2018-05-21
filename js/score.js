function check() {

  var question0 = document.after_response.question0.value;
  var question1 = document.after_response.question1.value;

  if (question0 == "") {
    alert("Vous n'avez même pas essayé ! Répondez à la question !");
  } else {
    alert("Allons voir le résultat !");
    document.getElementById("after_response").style.visibility = "hidden";
    document.getElementById("after_submit").style.visibility = "visible";
  }

  if (question1 == "") {
    alert("Vous n'avez même pas essayé ! Répondez à la question !");
  } else {
    alert("Allons voir le résultat !");
    document.getElementById("after_response1").style.visibility = "hidden";
    document.getElementById("after_submit1").style.visibility = "visible";
  }

}
