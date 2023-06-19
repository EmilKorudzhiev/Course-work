<style>
    body {
        background-image: url("../images/toppictures/pic4.jpeg")
    }
</style>
<div class="container pt-5 my-5">
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-9">
            <div class="card">

                <div class="card-header">
                    <h5>Количка</h5>
                </div>

                <div class="card-body">
                    <ul class="list-group" id="cartList">
                        <?php 
                            include('cart_item_display.php');
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script> 
$(document).ready(function() {
  const container = document.querySelector('#cartList');

    container.addEventListener('click', function (e) {
        if (e.target.classList.contains('removeButton')) {
        var id = e.target.value;
        console.log(id);
        $.ajax({
            url: '../components/remove_item_cart.php',
            type: 'POST',
            data: {
                productId:id
            },
            success: function(response) {
            window.scrollTo(0,0);
            $("#cartList").html(response);
            },
            error: function(jqXHR, textStatus, errorMessage) {
            console.log(errorMessage);
            }
        });
        }
    });
});
</script>