<?php

$id = $_GET['id'];
// $name = $_GET['name'];
$connection = mysqli_connect("localhost", "root", "", "auth_zantua");

echo $id;

// $sql = "DELETE FROM zantua_products WHERE prod_id = $id";
// $result = mysqli_query($connection, $sql);

// header("Location: ../admin/product.php?success=Successfully Deleted product $name.");

?>