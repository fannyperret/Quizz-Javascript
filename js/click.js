// TEST AJAX
// $(document).ready(function(){
//     $("button").click(function(){
//         $.ajax({url: "demo_test.txt", success: function(result){
//             $("#after_response").html(result);
//         }});
//     });
// });
$(document).ready(function(){
  $('#button').click(function(e) {
    var answer0 = $('#question0').val();
    var answer1 = $('#question1').val();
    $.ajax( {
      type: 'POST',
      url: 'controller.php',
      data: { question0: answer0, question1:answer1 },
      success: function(response) {
        $('#dataResponse').html(response);
      }, error: function(xhr, status, response){
        console.log(response);
      }
    });
    return false;
  });
})
