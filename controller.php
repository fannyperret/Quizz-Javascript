<?php
header('content-type:application/json');

$questions = json_decode(file_get_contents('quiz.json'));

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $id = intval($_POST['id']);
    $value = $_POST['value'];

    if (isset($questions[$id])) {
        $question = $questions[$id];
        if (is_numeric($value)) {
            $value = intval($value);
            $result = [
                "id" => $id,
                "title" => $question->titleAnswer,
                "text" => $question->textAnswer,
                "yourEstimation" => "",
            ];

            if ($value === $question->answer) {
                $result["yourEstimation"] = "Bonne réponse " . $value;
            } elseif ($value < $question->answer) {
                $result["yourEstimation"] = "Vous avez repondu " . $value . " c'est moins de " . ($question->answer - $value);
            } elseif ($value > $question->answer) {
                $result["yourEstimation"] = "Vous avez repondu " . $value . " c'est plus de " . ($value - $question->answer);
            } else {
                $result["yourEstimation"] = "Votre réponse est Improbable";
            }

            echo json_encode($result);

        } else {
            echo json_encode([
                "error" => "Repondez avec des chiffres",
                "id" => $id
            ]);
        }


    } else {
        echo json_encode([
            "error" => "La question n'existe pas",
            "id" => $id
        ]);
    }


}
