<?php
session_start();
include "../dbcon.php";

$id = $_SESSION['id'];

if (isset($_POST['deleted'])) {
    $item_id = $_POST['prodid'];
    print_r($item_id);
    if ($item_id != null) {
        for ($i = 0; $i < count($item_id); $i++) {
            $prod_id[$i] = $item_id[$i];

            $statement = $conn->query("SELECT * FROM products WHERE id IN ('$item_id[$i]')");
            while ($comp = $statement->fetch()) {
                $prodid = $comp['id'];

                $sql = $conn->query("UPDATE products SET deleted_at = NOW() WHERE id = $prodid");
                // Insert the deleted row into the recent_delete table
                $conn->query("INSERT INTO recent_delete (id, stock_No, name, cost, retail_price, quantity, barcodes, tags, taxes, tax_exempt, description, enable_decimal, enable_open_price, disable_discount, disable_inventory, supplier_name, supplier_list, category_name, subcategory, status, img, deleted_at)
                                SELECT id, stock_No, name, cost, retail_price, quantity, barcodes, tags, taxes, tax_exempt, description, enable_decimal, enable_open_price, disable_discount, disable_inventory, supplier_name, supplier_list, category_name, subcategory, status, img, NOW()
                                FROM products WHERE id = $prodid");

                header('Location: ../admin/product.php?success=Item deleted successfully.');
            }
        }
    } else {

        header('Location: ../admin/product.php?error=Please select an item to delete.');
        exit;
    }
} else {
    echo '<script> 
            alert("Please wait before checkout");
            window.location.href="product.php";
          </script>';
    exit;
}


?>