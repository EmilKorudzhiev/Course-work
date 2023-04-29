<?php 
if(isset($_SESSION["USER"])){
  header("Location: /Course-work/controllers/home.php");
}

?>

<div class="container py-5 mt-5">
    <div class="row">
      <div class="col-md-6 col-xl-5 mx-auto">
        <div class="card">
          <div class="card-header">
            <h5>Login Form</h5>
          </div>
          <div class="card-body">
            <form id="loginForm">
                <div class="px-3 pb-3">
                    <label for="email">Имейл<span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="email" required>
                </div>
                <div class="px-3 pb-3">
                    <label for="password">Парола<span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="password" required>
                </div>
                <div class="px-3">
                    <h5 class="text-center text-danger" id="wrongCredentials"></h5>
                    <button type="submit" class="btn btn-primary">Вход</button>
                </div>
            </form>
            </div>
        </div>
      </div>
    </div>
</div>

<script>
  
  $("#loginForm").on("submit", function(e) {
    e.preventDefault();
    var email = $("#email").val();
    var password = $("#password").val();

    $.ajax({
      url: "/Course-work/components/login_admin.php",
      type: "post",
      data: {
        email: email,
        password: password
      },
      dataType: "json",
      success: function(response) {
        if(response.status == "Correct info"){
          window.location.href = '/Course-work/controllers/admin_panel.php';
        }else{
          document.getElementById("wrongCredentials").innerHTML = "Password or email incorrect!";
        }
      },
      error: function(xhr, status, error) {
        console.log(xhr.responseText);
      }
    });
  });
</script>
