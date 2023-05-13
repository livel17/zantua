<?php
$connection = mysqli_connect("localhost", "root", "", "auth_zantua");

class Product
{
    public $name;
    public $tag;
    public $cost;
    public $quantity;
    public $barcode;
    public $desc;
    public $unitSold;
    public $img;

}


$sql = "SELECT * FROM products";
$result = $connection->query($sql);

if (!$result) {
    die("Invalid query: " . $connection->error);
}

$query = isset($_GET['query']) ? $_GET['query'] : '';
$products = array();
$response = "";

if (strlen($query) === 0) {
    while ($row = $result->fetch_assoc()) {
        $product = new Product();
        $product->name = $row['name'];
        $product->tag = $row['tags'];
        $product->cost = $row['retail_price'];
        $product->quantity = $row['quantity'];
        $product->barcode = $row['barcodes'];
        $product->desc = $row['description'];
        $product->unitSold = $row['unit_sold'];
        $product->img = $row['img'];

        array_push($products, $product);
    }
} else {
    while ($row = $result->fetch_assoc()) {
        if (strpos(strtolower($row['name']), strtolower($query)) !== false) {
            $product = new Product();
            $product->name = $row['name'];
            $product->tag = $row['tags'];
            $product->cost = $row['retail_price'];
            $product->quantity = $row['quantity'];
            $product->barcode = $row['barcodes'];
            $product->desc = $row['description'];
            $product->unitSold = $row['unit_sold'];
            $product->img = $row['img'];

            array_push($products, $product);
        }
    }
}

echo json_encode($products);
?>