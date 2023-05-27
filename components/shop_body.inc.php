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
<div class="container-fluid m-0 mt-5 pt-3 w-100">
    <div class="row flex-nowrap overflow-hidden">
        <div class="col-12 col-md-2 collapse d-md-block bg-dark text-white px-0 pb-3" id="sidebar">

          <form id="filters">

            <h3 class="text-center my-2">Филтри</h3>
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

            <h3 class="text-center my-2">Цена</h3>
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
                      <div class="col-6 col-md-12 p-0 d-flex justify-content-center">
                        <span>Мин</span>
                        <input type="number" class="input-min" min="0" max="<?php echo ceil($maxPrice['max_price']); ?>" value="0">
                      </div>
                    
                      <div class="col-6 col-md-12 p-0 d-flex justify-content-center">
                        <span>Макс</span>
                        <input type="number" class="input-max" min="0" max="<?php echo ceil($maxPrice['max_price']); ?>" value="<?php echo ceil($maxPrice['max_price']); ?>">
                      </div>
                  </div>
              </div>
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


        <div class="col collapse d-block p-0 w-100 min-vh-100">

            <div class="d-md-none col-auto text-white d-flex justify-content-center">
                <button type="button" class="btn btn-primary" data-bs-toggle="collapse" 
                data-bs-target="#sidebar" aria-expanded="false" aria-controls="sidebar">
                Toggle Sidebar
                </button>
            </div>

            <div class="p-0 m-0 w-100" id="items">
                
            </div>

        </div>

    </div>
</div>


<script>
  $(document).ready(function() {
      $("#filters").on("submit", function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      $.ajax({
        url: '/Course-work/components/store_item_display.php',
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          $("#items").html(response);
        },
        error: function(jqXHR, textStatus, errorMessage) {
          console.log(errorMessage);
        }
      });
    });
    $("#filters").submit();
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
          if (e.target.className === "input-min") {
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
          if (e.target.className === "range-min") {
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
