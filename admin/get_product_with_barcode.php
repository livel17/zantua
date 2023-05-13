<?php 

$barcode = isset($_GET['barcode']) ? $_GET['barcode'] : '';
$connection = mysqli_connect("localhost", "root", "", "auth_zantua");

$sql = "SELECT * FROM products";
$result = $connection->query($sql);


$response = "";

while ($row = $result->fetch_assoc()) {
    if (strcmp($barcode, (int)$row['barcodes'] . $row['stock_No']) == 0){
        $response = $response . $row['name'] . '|' . $row['tags'] . '|' . $row['retail_price'] . '|' . $row['quantity'] . '|' . (int)$row['barcodes'] . '|' . $row['description'] . $row['unit_sold']. '|' . $row['img'];
        break;
    }
}

echo $response;
?>