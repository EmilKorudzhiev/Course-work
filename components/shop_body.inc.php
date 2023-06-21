<!DOCTYPE html>
<?php 
$sqlGetTags = "
SELECT tags.tag ,COUNT(tags.tag) as count FROM tags
JOIN products_has_tags ON tags.id=products_has_tags.tags_id
JOIN products ON products_has_tags.products_id=products.id
GROUP BY tags.tag
ORDER BY tags.tag
;
";
$resultTags = $connection->query($sqlGetTags);

$sqlGetMaxPrice = "
SELECT MAX(products.price) as max_price FROM products;
";
$maxPrice = $connection->query($sqlGetMaxPrice)->fetch();


?>
<div class="container-fluid m-0 mt-5 w-100">
    <div class="row flex-nowrap overflow-hidden minheight">
        <div class="col-12 col-md-2 collapse d-md-block bg-dark text-white px-0 pb-3" id="sidebar">

          <form id="filters">

            <h3 class="text-center my-2 px-1">Филтри</h3>
            <div class="d-flex justify-content-center justify-content-md-start justify-content-lg-center px-2">
                <div class="mt-0">
                
                <?php 
                    while($row = $resultTags->fetch()){
                    echo '
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="tags[]" value="'.$row["tag"].'" id="'.$row["tag"].'">
                        <label class="form-check-label" for="'.$row["tag"].'">
                            <p class="m-0">'.$row["tag"].' ('.$row["count"].')'.'</p>
                        </label>
                    </div>
                    ';
                    }
                ?>
                </div>
            </div>

            <hr>

            <h3 class="text-center my-2 px-1">Цена</h3>
            <div class="row d-flex justify-content-center mt-3 px-2">
              <div class="price-slider col-7 col-sm-5 col-md-12 col-lg-10 col-xl-8">
                  <div class="slider">
                      <div class="diffrence"></div>
                  </div>
                  <div class="range-input">
                      <input type="range" name="range[]" class="range-min" min="0" max="<?php echo ceil($maxPrice['max_price']); ?>" value="0" step="1">
                      <input type="range" name="range[]" class="range-max" min="0" max="<?php echo ceil($maxPrice['max_price']); ?>" value="<?php echo $maxPrice['max_price']; ?>" step="1">
                  </div>

                  <div class="price-input row mt-3">
                      <div class="col-6 p-0 d-flex justify-content-center">
                        <div class="w-75 form-floating">
                          <input id="input-min" type="number" class="input-min form-control px-0 pb-0 text-center" min="0" max="<?php echo ceil($maxPrice['max_price']); ?>" value="0">
                          <label for="input-min">Мин</label>
                        </div>
                      </div>
                    
                      <div class="col-6 p-0 d-flex justify-content-center">
                        <div class="w-75 form-floating">
                          <input id="input-max" type="number" class="input-max form-control px-0 pb-0 text-center" min="0" max="<?php echo ceil($maxPrice['max_price']); ?>" value="<?php echo ceil($maxPrice['max_price']); ?>">
                          <label for="input-max">Макс</label>
                        </div>
                      </div>
                  </div>
              </div>
            </div>

            <hr>

            <h5 class="text-center my-2 px-1">Елементи на страница</h5>
            <div class="d-flex justify-content-center">
                <select class="form-select" name="itemsPerPage" style="width: 75px;">
                  <option value="12" selected>12</option>
                  <option value="24">24</option>
                  <option value="36">36</option>
                  <option value="48">48</option>
                  <option value="96">96</option>
                </select>
            </div>

            <hr>

            <div class="d-flex justify-content-center">
              <button type="submit" class="btn btn-secondary d-none d-md-block">
                    Търси
              </button>

              <button type="submit" class="btn btn-secondary d-block d-md-none" data-bs-toggle="collapse" 
                    data-bs-target="#sidebar" aria-expanded="false" aria-controls="sidebar">
                    Търси
              </button>
            </div>

          </form>

        </div>


        <div class="col collapse d-block p-0 w-100">

            <div class="d-md-none col-auto text-white d-flex justify-content-center">
              <button type="button" class="btn btn-secondary mt-2" data-bs-toggle="collapse" 
              data-bs-target="#sidebar" aria-expanded="false" aria-controls="sidebar">
              Търсине с Филтри
              </button>
            </div>

            <div class="p-0 m-0 w-100" id="items">
                
            </div>

        </div>

    </div>
</div>

<script>

  $(document).ready(function() {
    
    var formData;

    $("#filters").on("submit", function(e) {
      e.preventDefault();
      formData = new FormData(this);
      formData.append('page', '1');

      $.ajax({
        url: '../components/shop_item_display.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          window.scrollTo(0,0);
          $("#items").html(response);
        },
        error: function(jqXHR, textStatus, errorMessage) {
          console.log(errorMessage);
        }
      });
    });

    $("#filters").submit();

    const container = document.querySelector('#items');

    container.addEventListener('click', function (e) {
      if (e.target.classList.contains('paginationButton')) {
        var value = e.target.value;
        formData.append('page', value);

        $.ajax({
          url: '../components/shop_item_display.php',
          type: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          success: function(response) {
            window.scrollTo(0,0);
            $("#items").html(response);
          },
          error: function(jqXHR, textStatus, errorMessage) {
            console.log(errorMessage);
          }
        });
      }

      if(e.target.classList.contains('addToCartButton')){
        const quantity = 1;
        var productId = e.target.value;
        $.ajax({
        url: "../components/update_cart.php",
        type: "post",
        data: {
          id: productId,
          quantity: quantity
        },
        success: function(response) {
          alert(response);
        },
        error: function(xhr, status, error) {
          console.log(xhr.responseText);
        }
      });
      }
    });
    
  });

</script>



<script>
    const rangeInput = document.querySelectorAll(".range-input input"),
      priceInput = document.querySelectorAll(".price-input input"),
      range = document.querySelector(".slider .diffrence");
    let priceGap = 1;

    let minPrice = parseInt(priceInput[0].value),
          maxPrice = parseInt(priceInput[1].value);
    rangeInput[0].value = minPrice;
    range.style.left = ((minPrice - rangeInput[0].min) / (rangeInput[0].max - rangeInput[0].min)) * 100 + "%";
    rangeInput[1].value = maxPrice;
    range.style.right = 100 - ((maxPrice - rangeInput[1].min) / (rangeInput[1].max - rangeInput[1].min)) * 100 + "%";


    priceInput.forEach((input) => {
      input.addEventListener("input", (e) => {
      let minPrice = parseInt(priceInput[0].value),
        maxPrice = parseInt(priceInput[1].value);
        if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInput[1].max) {
          if (e.target.classList.contains("input-min")) {
            rangeInput[0].value = minPrice;
            range.style.left = ((minPrice - rangeInput[0].min) / (rangeInput[0].max - rangeInput[0].min)) * 100 + "%";
          } else {
            rangeInput[1].value = maxPrice;
            range.style.right = 100 - ((maxPrice - rangeInput[1].min) / (rangeInput[1].max - rangeInput[1].min)) * 100 + "%";
          }
        }
      });
    });

    rangeInput.forEach((input) => {
      input.addEventListener("input", (e) => {
        let minVal = parseInt(rangeInput[0].value),
          maxVal = parseInt(rangeInput[1].value);

        if (maxVal - minVal < priceGap) {
          if (e.target.classList.contains("range-min")) {
            rangeInput[0].value = maxVal - priceGap;
          } else {
            rangeInput[1].value = minVal + priceGap;
          }
        } else {
          priceInput[0].value = minVal;
          priceInput[1].value = maxVal;
          range.style.left = ((minVal - rangeInput[0].min) / (rangeInput[0].max - rangeInput[0].min)) * 100 + "%";
          range.style.right = 100 - ((maxVal - rangeInput[1].min) / (rangeInput[1].max - rangeInput[1].min)) * 100 + "%";
        }
      });
    });
</script>