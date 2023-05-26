
<?php 
    if(!isset($_SESSION["USER"])){
      header("Location: /Course-work/controllers/home.php");
    }

    $sqlGetUser='
    SELECT * FROM users
    WHERE email = (?);
    ';

    $result = $connection -> prepare($sqlGetUser);
    $result -> execute([$_SESSION['USER'][3]]);
    $userInfo = $result -> fetch();
?>


<div class="container mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-12 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3">
                <img class="rounded-circle mt-5" width="150px" height="150px" src="/Course-work/images/profile/<?php if($userInfo['picture']){echo $userInfo['picture'];} else{ echo 'default.jpg';} ?>" style="object-fit: cover;">
                <h3 class="font-weight-bold"><?php echo $userInfo['first_name'].' '.$userInfo['last_name']?></h3>
                <h5 class="text-black-50"><?php echo $userInfo['email']?></h5>
                <br>
                <button class="btn btn-primary profile-button" onclick="location.href='/Course-work/components/logout_user.php'">Излез от профила</button>
                  
            </div>
        </div>
            
            <div class="col-md-6 border-right">
                <div class="p-3">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Профил</h4>
                        </div>
                        <form id="userDetail">
                            <div class="row mt-2">
                                <div class="col-md-6 pb-2">
                                    <label class="labels">Име</label>
                                    <input type="text" class="form-control" id="firstName" placeholder="Първо име" value="<?php echo $userInfo['first_name']?>" required>
                                </div>
                                <div class="col-md-6 pb-2">
                                    <label class="labels">Фамилия</label>
                                    <input type="text" class="form-control" id="surname" placeholder="Фамилия" value="<?php echo $userInfo['last_name']?>" required>
                                </div>
                                <div class="col-md-12 pb-2">
                                    <label class="labels">Телефонен номер</label>
                                    <input type="text" class="form-control" id="phone" placeholder="Телефонен номер" value="<?php echo $userInfo['phone']?>" required>
                                </div>
                                <div class="col-md-12 pb-2">
                                    <label class="labels">Имейл</label>
                                    <input type="email" class="form-control" id="email" placeholder="Имейл" value="<?php echo $userInfo['email']?>" required>
                                </div>
                                <div class="mb-3 text-center">
                                    <button class="btn btn-primary profile-button" type="submit" id="submitDetails">Запази детайли</button>
                                </div>
                            </div>
                        </form> 
                            <hr>
                        <form id="userPassword">
                                <div class="col-md-12 pb-0">
                                    <label class="labels">Парола</label>
                                    <input type="password" class="form-control mb-2" id="passwordOld" placeholder="Стара парола" required>
                                    <input type="password" class="form-control mb-2" id="passwordNew" placeholder="Нова парола" required>
                                </div>
                                <div class="mb-3 text-center">
                                    <button class="btn btn-primary profile-button" type="submit" id="submitPassword">Запази нова парола</button>
                                </div>
                        </form>
                            <hr>
                        <form id="userPicture">
                                <div class="col-md-12 pb-2">
                                    <label class="labels">Профилна снимка</label>
                                    <input type="file" class="form-control" name="picture" required>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-primary profile-button" type="submit" id="submitPicture">Запази снимка</button>
                                </div>
                        </form> 

                     
                </div>
            </div>
        </div>
    </div>
</div>


<script>

  $("#userDetail").on("submit", function(e) {
    e.preventDefault();
    var firstName = $("#firstName").val();
    var surname = $("#surname").val();
    var phone = $("#phone").val();
    var email = $("#email").val();

    $.ajax({
      url: "/Course-work/components/update_user_details.php",
      type: "post",
      data: {
        firstName: firstName,
        surname: surname,
        phone: phone,
        email: email
      },
      success: function(response) {
        alert(response);
      },
      error: function(xhr, status, error) {
        console.log(xhr.responseText);
      }
    });
  });

  
  $("#userPassword").on("submit", function(e) {
    e.preventDefault();
    
    var passwordOld = $("#passwordOld").val();
    var passwordNew = $("#passwordNew").val();

    $.ajax({
      url: "/Course-work/components/update_user_password.php",
      type: "post",
      data: {
        passwordOld:passwordOld,
        passwordNew:passwordNew
      },
      success: function(response) {
        alert(response);
      },
      error: function(xhr, status, error) {
        console.log(xhr.responseText);
      }
    });
  });

  $("#userPicture").on("submit", function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
      url: '/Course-work/components/update_user_picture.php',
      type: 'post',
      data: formData,
      processData: false,
      contentType: false,
      success: function(response) {
        console.log(response);
      },
      error: function(jqXHR, textStatus, errorMessage) {
        console.log(errorMessage);
      }
    });
  });
  
</script>