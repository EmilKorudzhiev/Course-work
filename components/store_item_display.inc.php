<?php 

$sql = "SELECT * FROM shop";
$result = $connection->query($sql);

while($row = $result->fetch()){
    echo 
    '<div class="col-sm-6 col-md-4 py-2">
        <a href=".\product\\'.$row["id"].'.php">
            <div class="card">
            <img src="..\images\shop items\\'.$row["item_image"].'" class="card-img-top shop-item-img" alt="image"/>
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