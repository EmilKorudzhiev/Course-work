<?php 

$sql = "SELECT * FROM shop";
$result = $connection->query($sql);

while($row = $result->fetch()){
    echo 
    '<div class="col-sm-6 col-md-4 py-2">
        <a href="#">
            <div class="card">
            <img src="..\images\site assets\/'.$row["item_image"].'" class="card-img-top" alt="image"/>
                <div class="card-body">
                    <h5 class="card-title">'
                        . $row["name"] .
                    '</h5>
                    <p class="card-text">'
                        . $row["price"] . " лв." .
                    '</p>
                </div>
            </div>
        </a>
    </div>';
}

?>