<?php
// Returning JSON from a Php Script
header('content-type:application/json');
$questions = json_decode(file_get_contents('quiz.json'));
// Holds the name of the method for a form submission to restrict your form procesing only form POST type request
if ($_SERVER['REQUEST_METHOD'] === "POST") {

    // SECURITY
    $id = htmlentities(trim(strip_tags($_POST['id'])));
    $value = htmlentities(trim(strip_tags($_POST['value'])));

    if (isset($questions[$id])) {
        $question = $questions[$id];

        // EMPTY
        if (empty($value)) {
          echo json_encode([
              "error" => "Répondez à la question !",
              "id" => $id
          ]);

        // IS_NUMERIC
      } elseif ($question->type == "numeric") {
          $value = str_replace(",", ".", $value);
          $value = str_replace(" ", "", $value);
          $value = (float)$value;
          if (!preg_match('/^[0-9 \.,]+$/ui', $value)) {
            echo json_encode([
              "error" => "On met des chiffres !",
              "id" => $id
            ]);
          } else {
            $result = [
                "id" => $id,
                "title" => $question->titleAnswer,
                "text" => $question->textAnswer,
                "yourEstimation" => "",
            ];
            if ($value == $question->answer || (isset($question->aliasAnswer) && !empty($question->aliasAnswer) && in_array($value, $question->aliasAnswer))) {
                $result["yourEstimation"] = "Vous avez répondu " . $value . " : c'est une bonne réponse !";
            } else {
              $estimation = null;
              if(!isset($question->aliasAnswer)) $question->aliasAnswer = array();
              $question->aliasAnswer[] = $question->answer;
              foreach( $question->aliasAnswer as $k => $alias){
                if ($value < $alias) {
                  $estimation = "Vous avez répondu " . $value . " : c'est PLUS ! Il y a un écart de " . round(abs($question->answer - $value), 2) . " avec " . $question->answer;
                } elseif ($value > $alias) {
                  $estimation = "Vous avez répondu " . $value . ": c'est MOINS ! Il y a un écart de " . round(abs($question->answer - $value), 2) . " avec " . $question->answer;
                }
                if($estimation != null) break;
              }
              $result["yourEstimation"] = $estimation;
            }
            echo json_encode($result);
          }

        // IS_LETTERS
      } elseif ($question->type == "alpha") {
        // $value = ucfirst(strtolower(trim($value)));
        if (!preg_match('/^[^!<>,;?=+()@#"°{}_$%:]+$/ui', stripslashes($value))) {
          echo json_encode([
            "error" => "On met des lettres !",
            "id" => $id
          ]);
        } else {
          $result = [
              "id" => $id,
              "title" => $question->titleAnswer,
              "text" => $question->textAnswer,
              "yourEstimation" => "",
          ];
          $estimation = null;
          if (strtolower($value) === $question->answer || preg_match('/'.$question->answer.'/', $value)  || (isset($question->aliasAnswer) && !empty($question->aliasAnswer) && in_array(strtolower($value), $question->aliasAnswer))) {
            $estimation = true;
          } elseif(isset($question->aliasAnswer) && !empty($question->aliasAnswer)) {
            if(!isset($question->aliasAnswer)) $question->aliasAnswer = array();
            $question->aliasAnswer[] = $question->answer;
            foreach( $question->aliasAnswer as $k => $alias){
              if (preg_match('#'.addslashes($alias).'#ui', $value)) {
                $estimation = true;
                break;
              }
            }
          }
          if($estimation == null) $result["yourEstimation"] = "Vous avez répondu " . $value . " : désolé ! La bonne réponse était : " . $question->answer;
          else $result["yourEstimation"] = "Vous avez répondu " . $value . " : c'est EXACT !";

          echo json_encode($result);
        }

    } else {
        echo json_encode([
            "error" => "La question n'existe pas",
            "id" => $id
        ]);
    }

  }

}
