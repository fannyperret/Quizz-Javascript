<?php

$question0 = $_POST['question0'];
if(is_numeric($question0)) {
  echo $question0, PHP_EOL;
} else {
  echo "Vous avez répondu : '{$question0}'? Mais c'est même pas un nombre ! Jouez le jeu bon sang !", PHP_EOL;
}
