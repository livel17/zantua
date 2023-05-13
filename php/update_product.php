<?php
session_start();
include "../dbcon.php";

$id = $_SESSION['id'];
$stmt = $conn->query("SELECT * FROM admin WHERE user_Id ='$id'");
$res = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['update']) && isset($_FILES['picture'])) {
    $prodid = $_POST['prodid'];
    $stockno = $_POST['product_id'];
    $bard = $_POST['barcodes'];
    $name = $_POST['productname'];
    $cost = $_POST['cost'];
    $rtl = $_POST['retailprice'];
    $qntty = $_POST['quantity'];
    $tags = $_POST['tags'];
    $taxs = $_POST['taxes'];
    $taxe = $_POST['tax_exempt'];
    $descs = $_POST['description'];

    echo "<pre>";
    print_r($_FILES['picture']);
    echo "</pre>";

    $img_name = $_FILES['picture']['name'];
    $img_size = $_FILES['picture']['size'];
    $tmp_name = $_FILES['picture']['tmp_name'];
    $error = $_FILES['picture']['error'];

    if ($error === 0) {
        if ($img_size > 25000000) {
            $em = "Sorry, your file is too large";
            header("Location: ../admin/editproduct.php?prodid=$prodid&error=$em");
        } else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                $img_upload_path = '../img/products/' . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                $res = $conn->query("UPDATE products SET stock_No='$stockno', barcodes='$bard', name='$name', cost='$cost', retail_price='$rtl', quantity='$qntty', tags='$tags',taxes='$taxs', tax_exempt='$taxe', description='$descs', img='$img_upload_path' WHERE id='$prodid'");
                echo '<script> alert("Data Updated"); </script>';
                header("Location: ../admin/editproduct.php?success=Successfully Updated&prodid=$prodid");
            } else {
                $em = "Unable to Apply Changes";
                header("Location: ../admin/editproduct.php?prodid=$prodid&error=$em");
            }
        }
    } else {
        $res = $conn->query("UPDATE products SET stock_No='$stockno', barcodes='$bard', name='$name', cost='$cost', retail_price='$rtl', quantity='$qntty', tags='$tags',taxes='$taxs', tax_exempt='$taxe', description='$descs' WHERE id='$prodid'");
        if ($res) {
            echo '<script> alert("Data Updated"); </script>';
            header("Location: ../admin/editproduct.php?success=Successfully Updated&prodid=$prodid");
        } else {
            $em = "Unknown Error Occurred!";
            header("Location: ../admin/editproduct.php?prodid=$prodid&error=$em");
        }
    }
}
?>