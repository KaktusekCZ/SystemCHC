$(document).ready(function(){
  var request;
  $('.admin__logout').on('click', function(event){
      event.preventDefault();
      if (request) {
          request.abort();
      }
      request = $.ajax({
          url: "logout/logout.php",
          type: "post"
      });
      request.done(function (response, textStatus, jqXHR){
        if (response == 1) {
          window.location.href = "login/?status=logout";
        }
      });
      request.fail(function (jqXHR, textStatus, errorThrown){

      });
  });
});
