  (function($) {
    'use strict'

    $("#loginForm").submit(function(e){
      e.preventDefault();
      $("#loginBtn").html(`<i class="fa fa-spinner fa-spin"></i>`).prop("disabled", true);
      let login = $("#email").val();
      let password = $("#pass").val();
      let errorTracker = 0;
      if(!login || login.length < 4){
        errorTracker = 1;
      }

      if(password.length < 1){
        errorTracker = 1;
      }

      if(errorTracker > 0){
        swal("Entry errors", "Provide valid username/email and password", "warning");
        $("#loginBtn").text("Sign in").prop("disabled", false);
        return false;
      }

      $.post('process/users.php', {
        login: login,
        password: password
      }, function(data){
        data = JSON.parse(data);
        if(data.status == "success"){
          localStorage.uinfo = JSON.stringify(data.data);
          window.location = "./home";
        }
        else{
          swal("Login failed", data.message, "warning");
          $("#loginBtn").text("Sign in").prop("disabled", false);
        }
      })
    });
    
}(jQuery))