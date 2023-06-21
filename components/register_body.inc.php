<?php 
if(isset($_SESSION["USER"])){
    header("Location: ../controllers/home.php");
}
?>
<style>
  body{
    background-image: url("../images/toppictures/pic4.jpg")
  }
</style>
<div class="container py-5 mt-5">
    <div class="row minheight">
        <div class="col-md-6 col-xl-5 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5>Registration Form</h5>
                </div>
                <div class="card-body">
                    <form id="registertrationForm">
                        <div class="px-3 pb-3">
                            <label for="name">Име<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" minlength="4" minlength="40" required>
                        </div>
                        <div class="px-3 pb-3">
                            <label for="surname">Фамилия<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="surname" minlength="4" minlength="40" required>
                        </div>
                        <div class="px-3 pb-3">
                            <label for="phone">Телефонен номер<span class="text-danger">*</span></label>
                            <input type="tel" class="form-control" id="phone" minlength="8" minlength="8" required>
                        </div>
                        <div class="px-3 pb-3">
                            <label for="email">Имейл<span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="px-3 pb-3">
                            <label for="password">Парола<span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password" minlength="8" minlength="40" required>
                        </div>
                        <div class="px-3">
                            <h5 class="text-center text-danger" id="emailError"></h5>
                            <button type="submit" class="btn btn-primary" id="registerButton">Регистрирай се</button>
                        </div>
                    </form>
                    <hr>
                    <div class="px-3 pt-2">
                        <p>Вече имате регистрация? <a href="login.php" class="btn btn-primary btn-sm">Влезте в профила си</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
  
  $("#registertrationForm").on("submit", function(e) {
    e.preventDefault();
    var name = $("#name").val();
    var surname = $("#surname").val();
    var phone = $("#phone").val();
    var email = $("#email").val();
    var password = $("#password").val();

    $.ajax({
      url: "../components/register_user.php",
      type: "post",
      data: {
        name: name,
        surname: surname,
        phone:phone,
        email: email,
        password: password
      },
      dataType: "json",
      success: function(response) {
        if(response.status == "Email not used"){
          window.location.href = '../controllers/home.php';
        }else{
          document.getElementById("emailError").innerHTML = "Email is already registered please enter a diffrent email!";
        }
      },
      error: function(xhr, status, error) {
        console.log(xhr.responseText);
      }
    });
  });
</script>
