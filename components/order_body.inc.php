<?php 
    if(!isset($_SESSION["CART"])){
      header("Location: /Course-work/controllers/store.php");
    }
    if(!isset($_SESSION["USER"])){
        echo '
        <div class="container pt-5 mt-3">
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-lg-8 list-group p-0 border">
                    <h3 class="text-center">За да приключите поръчката трябва да сте влeзли в профила си.</h3>
                    <div class="d-flex justify-content-center p-3">
                        <a href="/Course-work/controllers/login.php" class="btn btn-primary mx-3">Влез в профил</a>
                        <a href="/Course-work/controllers/register.php" class="btn btn-primary mx-3">Регистрация</a>
                    </div>
                </div>
            </div>
        </div>
        ';
    }else{

        $sqlGetUser = "
        SELECT * FROM users
        WHERE email = ?
        ;";

        $userResult = $connection -> prepare($sqlGetUser);
        $userResult -> execute([$_SESSION["USER"][3]]);
        $userInfo = $userResult -> fetch();

        echo '
          <div class="container pt-5 my-5">
            <div class="row d-flex justify-content-center" id="orderContainer">
                <div class="col-12 col-md-10 col-lg-8 border rounded p-2">
                    <div class="col-12 border rounded mb-2">
                        <h3 class="text-center m-0">Създаване на поръчка за '.$userInfo["first_name"]." ".$userInfo["last_name"].'</h3>
                    </div>

                    <form id="order" class="border rounded">
                        <div class="m-2">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label for="city">Град:</label>
                                    <input type="text" class="form-control border-dark" id="city" name="city">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-check m-2">
                                        <input class="form-check-input" type="checkbox" value="" id="deliveryType">
                                        <label class="form-check-label" for="deliveryType">
                                            Доставка до вас
                                        </label>
                                    </div>
                                    <div class="form-check m-2">
                                        <input class="form-check-input" type="checkbox" value="" id="payType">
                                        <label class="form-check-label" for="payType">
                                            Плащане на място
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-none" id="addressInfo">
                                <div class="col-12 pb-2">
                                    <label for="address">Адрес:</label>
                                    <input type="text" class="form-control border-dark" id="address" name="address" required disabled>
                                </div>
                            </div>

                            <div class="row" id="cardInfo">
                                <div class="col-12 pb-2">
                                    <label for="cardNumber">Номер на кредитната карта:</label>
                                    <input type="text" class="form-control border-dark" id="cardNumber" name="cardNumber" pattern="[0-9]{13,16}" placeholder="0123 4567 8901 2345" required>
                                </div>
                                
                                <div class="col-12 pb-2">
                                    <label for="cardName">Име на притежателя:</label>
                                    <input type="text" class="form-control border-dark" id="cardName" name="cardName" placeholder="Ivan Ivanov" required>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <label for="expiryDate">Срок на валидност:</label>
                                    <input type="text" class="form-control border-dark" id="expiryDate" name="expiryDate" pattern="(0[1-9]|1[0-2])\/?([0-9]{2})" placeholder="01/23" required>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <label for="cvv">CVV:</label>
                                    <input type="password" class="form-control border-dark" id="cvv" name="cvv" pattern="[0-9]{3,4}" placeholder="123" required>
                                </div> 
                            </div>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-primary mt-2" type="submit">Направи поръчка</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        ';
    }
?>

<script>
const checkboxDeliveryType = document.getElementById("deliveryType");
const divAddressInfo = document.getElementById("addressInfo");
checkboxDeliveryType.addEventListener("change", function() {
  if (checkboxDeliveryType.checked) {
    divAddressInfo.classList.remove('d-none');
    enableFormControls(divAddressInfo);
  }else{
    divAddressInfo.classList.add('d-none');
    disableFormControls(divAddressInfo);
  }
});

const checkboxPayType = document.getElementById("payType");
const divCardInfo = document.getElementById("cardInfo");
checkboxPayType.addEventListener("change", function() {
  if (checkboxPayType.checked) {
    divCardInfo.classList.add('d-none');
    disableFormControls(divCardInfo);
  }else{
    divCardInfo.classList.remove('d-none');
    enableFormControls(divCardInfo);
  }
});

function disableFormControls(element) {
  const formControls = element.querySelectorAll("input");
  formControls.forEach((control) => {
    control.disabled = true;
  });
  const childDivs = element.querySelectorAll("div");
  childDivs.forEach((div) => {
    disableFormControls(div);
  });
}

function enableFormControls(element) {
  const formControls = element.querySelectorAll("input");
  formControls.forEach((control) => {
    control.disabled = false;
  });
  const childDivs = element.querySelectorAll("div");
  childDivs.forEach((div) => {
    enableFormControls(div);
  });
}
</script>

<script>
$("#order").on("submit", function(e) {
  e.preventDefault();
  formData = new FormData(this);

  $.ajax({
    url: '/Course-work/components/process_order_info.php',
    type: 'POST',
    data: formData,
    processData: false,
    contentType: false,
    success: function(response) {
      var div = document.getElementById('orderContainer');
      div.innerHTML = response;
    },
    error: function(jqXHR, textStatus, errorMessage) {
      console.log(errorMessage);
    }
  });
});
</script>