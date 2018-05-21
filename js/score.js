function check() {

  var count = 63;
  var question0 = document.after_response.question0.value;

  swift (question0) {
    case: "";
    case: < count;
    console.log("C'est beaucoup plus !");
    break;
    case > 63;
    console.console.log(("C'est un peu moins"));
    break;
    case: == count;
    console.log("C'est une bonne réponse !");
    document.getElementById("after_response").style.visibility = "hidden";
    document.getElementById("after_submit").style.visibility = "visible";
    break;

  }

  //
  // if (question0 == "") {
  //   alert("Vous n'avez même pas essayé ! Répondez à la question !");
  // } else {
  //   alert("C'est une bonne réponse !");
  //   document.getElementById("after_response").style.visibility = "hidden";
  //   document.getElementById("after_submit").style.visibility = "visible";
  // }

}
