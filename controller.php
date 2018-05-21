<?php

$questionZero = $_POST['question0'];
if(is_numeric($questionZero)) {
  echo $questionZero, PHP_EOL;
} else {
  echo "Vous avez répondu : '{$questionZero}'? Mais c'est même pas un nombre ! Jouez le jeu bon sang !", PHP_EOL;
}

$questionOne = $_POST['question1'];
if(is_numeric($questionOne)) {
  echo $questionOne, PHP_EOL;
} else {
  echo "Vous avez répondu : '{$questionOne}'? Faudrait peut-être répondre !", PHP_EOL;
}
