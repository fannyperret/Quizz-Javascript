<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Quiz</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
  integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="js/click.js"></script>
</head>
<body>

  <div class="widthQuiz">

    <div class="titleBlock">
      <h1>Modèle de Quiz</h1>
    </div>

    <?php
    $questions = json_decode(file_get_contents('quiz.json'));
    foreach ($questions as $id => $question) {
      ?>

      <div class="card smallValue">
        <div class="quizBlock" id="card_<?php echo $id; ?>">
          <h2><?php echo $question->name; ?></h2>
          <p class="asterix">*<?php echo $question->intro; ?></p>
          <div class="inputWrapper">

            <p class="question">
              <?php echo $question->question; ?>
            </p>

            <div id="error_<?php echo $id; ?>" class="error"></div>
            <input id="question_<?php echo $id; ?>" data-button="button_<?php echo $id; ?>"
            class="responseInput" name="question_<?php echo $id; ?>" type="number"
            maxlength="2" autofocus>
            <span class="currency"><?php echo $question->currency; ?></span>
            <br/>
            <button id="button_<?php echo $id; ?>" type="button" data-question="<?php echo $id; ?>"
              class="btn validateBtn">VALIDER
            </button>

          </div>
        </div>
      </div>

      <?php
    }
    ?>
  </div>

</body>
</html>
