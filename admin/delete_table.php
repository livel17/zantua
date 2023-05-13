<?php
include "../dbcon.php";

// Move deleted rows to the recent_delete table
$sql = $conn->prepare("INSERT INTO recent_delete SELECT * FROM products WHERE deleted_at IS NULL");
$sql->execute();

// Set the deleted_at column for all rows in the table
$sql = $conn->prepare("UPDATE products SET deleted_at = NOW()");
$sql->execute();

// Delete all rows in the table
$sql = $conn->query("DELETE FROM products");
if ($sql) {
    header("Location: ../admin/product.php");
    exit;
} else {
    echo "Error deleting products: " . mysqli_error($sql);
}
?>
