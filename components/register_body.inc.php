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
                    <h5>Registration Form</h5>
                </div>
                <div class="card-body">
                    <form id="registertrationForm">
                        <div class="px-3 pb-3">
                            <label for="name">Име<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name">
                        </div>
                        <div class="px-3 pb-3">
                            <label for="surname">Фамилия<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="surname">
                        </div>
                        <div class="px-3 pb-3">
                            <label for="phone">Телефонен номер<span class="text-danger">*</span></label>
                            <input type="tel" class="form-control" id="phone">
                        </div>
                        <div class="px-3 pb-3">
                            <label for="email">Имейл<span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        <div class="px-3 pb-3">
                            <label for="password">Парола<span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password">
                        </div>
                        <div class="px-3">
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
      url: "/Course-work/components/register_user.php",
      type: "post",
      data: {
        name: name,
        surname: surname,
        phone:phone,
        email: email,
        password: password
      },
      success: function(response) {
        alert(response);
      },
      error: function(xhr, status, error) {
        console.log(xhr.responseText);
      }
    });
  });
</script>
