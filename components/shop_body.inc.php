<?php 
$sql = "
SELECT tags.tag FROM tags
;
";
$result = $connection->query($sql);
?>
<div class="container-fluid m-0 mt-5 pt-3 w-100">
    <div class="row flex-nowrap overflow-hidden">
        <div class="col-12 col-md-2 collapse d-md-block bg-dark text-white p-0" id="filters">

            <h3 class="text-center my-2">Филтри</h3>
            <div class="d-flex justify-content-center justify-content-md-start justify-content-lg-center">
                <div class="mt-0">
                
                <?php 
                    while($row = $result->fetch()){
                    echo '
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="'.$row["tag"].'" id="'.$row["tag"].'">
                        <label class="form-check-label" for="'.$row["tag"].'">
                            <p class="m-0">'.$row["tag"].'</p>
                        </label>
                    </div>
                    ';
                    }
                ?>
                </div>
            </div>

            <hr>

            <h3 class="text-center my-2">Цена</h3>
            <div class="row d-flex justify-content-center mt-3">
                <div class="price-slider col-6 col-md-12 col-lg-8">
                    <div class="slider">
                        <div class="diffrence"></div>
                    </div>
                    <div class="range-input">
                        <input type="range" class="range-min" min="0" max="100" value="20" step="1">
                        <input type="range" class="range-max" min="0" max="100" value="75" step="1">
                    </div>

                    <div class="price-input">
                        <span>Min</span>
                        <input type="number" class="input-min" value="20">
                        <br>
                        <span>Max</span>
                        <input type="number" class="input-max" value="75">
                    </div>
                </div>  
            </div>

            <div class="d-md-none col-auto text-white d-flex justify-content-center">
                <button type="button" class="btn btn-primary" data-bs-toggle="collapse" 
                    data-bs-target="#filters" aria-expanded="false" aria-controls="filters">
                    Toggle Sidebar
                </button>
            </div>

        </div>

        <div class="col collapse d-block p-0 w-100" id="items">

            <div class="d-md-none col-auto text-white d-flex justify-content-center">
                <button type="button" class="btn btn-primary" data-bs-toggle="collapse" 
                data-bs-target="#filters" aria-expanded="false" aria-controls="filters">
                Toggle Sidebar
                </button>
            </div>

            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 p-0 m-0 w-100">

                <?php require('../components/store_item_display.inc.php'); ?> 
                
            </div>
            
        </div>

    </div>
</div>

<script>
const rangeInput = document.querySelectorAll(".range-input input"),
priceInput = document.querySelectorAll(".price-input input"),
range = document.querySelector(".slider .diffrence");
let priceGap = 1;

priceInput.forEach((input) => {
  input.addEventListener("input", (e) => {
    let minPrice = parseInt(priceInput[0].value),
      maxPrice = parseInt(priceInput[1].value);

    if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInput[1].max) {
      if (e.target.className === "input-min") {
        rangeInput[0].value = minPrice;
        range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
      } else {
        rangeInput[1].value = maxPrice;
        range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
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
      range.style.left = (minVal / rangeInput[0].max) * 100 + "%";
      range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
    }
  });
});

</script>
