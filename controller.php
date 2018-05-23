<?php
// Returning JSON from a Php Script
header('content-type:application/json');
$questions = json_decode(file_get_contents('quiz.json'));
// Holds the name of the method for a form submission to restrict your form procesing only form POST type request
if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $id = intval($_POST['id']);
    $value = $_POST['value'];

    if (isset($questions[$id])) {
        $question = $questions[$id];
        // If empty
        if (empty($value)) {
          echo json_encode([
              "error" => "Répondez à la question !",
              "id" => $id
          ]);

        } elseif (is_numeric($value)) {
            $value = intval($value);
            $result = [
                "id" => $id,
                "title" => $question->titleAnswer,
                "text" => $question->textAnswer,
                "yourEstimation" => "",
            ];
            if ($value === $question->answer) {
                $result["yourEstimation"] = "Vous avez répondu " . $value . " : c'est une bonne réponse !";
            } elseif ($value < $question->answer) {
                $result["yourEstimation"] = "Vous avez répondu " . $value . " : c'est PLUS ! Il y a un écart de " . ($question->answer - $value) . " avec la véritable réponse.";
            } elseif ($value > $question->answer) {
                $result["yourEstimation"] = "Vous avez répondu " . $value . ": c'est MOINS ! Il y a un écart de " . ($value - $question->answer) . " avec la véritable réponse.";
            } else {
                $result["yourEstimation"] = "Votre réponse est Improbable";
            }
            echo json_encode($result);

        } else {
          $result = [
              "id" => $id,
              "title" => $question->titleAnswer,
              "text" => $question->textAnswer,
              "yourEstimation" => "",
          ];
          if ($value === $question->answer) {
            $result["yourEstimation"] = "Vous avez répondu " . $value . " : c'est EXACT !";
          } else {
            $result["yourEstimation"] = "Désolé ! Ce n'est pas la bonne réponse...";
          }
          echo json_encode($result);
        }

    } else {
        echo json_encode([
            "error" => "La question n'existe pas",
            "id" => $id
        ]);
    }


}
