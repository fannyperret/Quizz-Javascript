function ajaxQuestion(idQuestion, value) {
    $.ajax({
        type: 'POST',
        url: 'controller.php',
        data: {
            "id": idQuestion,
            "value": value
        },
        success: function (response) {
            if (typeof response.error !== 'undefined') {
                addError(response);
            } else {
                addAnswer(response);
            }
        }, error: function (xhr, status, response) {
            console.log(response);
        }
    });
}

function addAnswer(answer) {
    let html = "";
    let id = answer.id;
    html += "<h2>" + answer.title + "</h2>";
    html += "<p class=''>" + answer.yourEstimation + "</p>";
    html += "<p class=''>" + answer.text + "</p>";
    $('#card_' + id).fadeTo(1000, 0, function () {
        $(this).html(html);
        $(this).fadeTo(1000, 1, function () {
        });
    });
    $("#question_" + (id + 1)).focus()
}

function addError(error) {
    let html = "";
    let id = error.id;
    html += "<p class='error'>" + error.error + "</p>";
    $('#error_' + id).html(html);
}

$(document).ready(function () {
    $('.validateBtn').click(function (e) {
        let idQuestion = $(this).data('question');
        let value = $('#question_' + idQuestion).val();
        ajaxQuestion(idQuestion, value);
    });
});

$(document).keypress(function (event) {
    if (event.which === 13) {
        let target = $(event.target);
        if (target.is("input")) {
            let button = target.data("button");
            $('#' + button).click();
        }
    }
});
