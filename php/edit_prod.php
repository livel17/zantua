<?php
session_start();
include "../dbcon.php";

$connection = mysqli_connect("localhost", "root", "", "auth_zantua");
$id = $_SESSION['id'];
$stmt = $conn->query("SELECT * FROM admin WHERE user_Id ='$id'");
$res = $stmt->fetch(PDO::FETCH_ASSOC);

$id = $_POST['productid'];
$prod_nm = $_POST['productname'];
$ref = $_POST['productname'];
$stock = $_POST['stockno'];
$cost = $_POST['cost'];
$tags = $_POST['tags'];
$desc = $_POST['description'];
$data = "prod=" . $prod_nm . "&stock=" . $stock . "&quantity=" . $stock . "&tags=" . $tags . "&desc=" . $desc;
if ($prod_nm == null) {
    $em = "Product Name is required";
    header("Location: ../admin/editproduct.php?error=$em&name=$prod_nm&stocks=$stock&price=$cost&tags=$tags&desc=$desc&id=$id");
} else if ($stock == null) {
    $em = "Stock is required";
    header("Location: ../admin/editproduct.php?error=$em&name=$prod_nm&stocks=$stock&price=$cost&tags=$tags&desc=$desc&id=$id");
} else if ($cost == null) {
    $em = "Cost is required";
    header("Location: ../admin/editproduct.php?error=$em&name=$prod_nm&stocks=$stock&price=$cost&tags=$tags&desc=$desc&id=$id");
} else if ($tags == null) {
    $em = "Tas is required";
    header("Location: ../admin/editproduct.php?error=$em&name=$prod_nm&stocks=$stock&price=$cost&tags=$tags&desc=$desc&id=$id");
} else if ($desc == null) {
    $em = "Description is required";
    header("Location: ../admin/editproduct.php?error=$em&name=$prod_nm&stocks=$stock&price=$cost&tags=$tags&desc=$desc&id=$id");
} else {

    $sql = "UPDATE `zantua_products` SET `prod_name` = '$prod_nm', `stocks` = '$stock', `price` = '$cost', `tags` = '$tags', `description` = '$desc' WHERE `prod_id` = '$id';";
    $result = mysqli_query($connection, $sql);

    if ($result == 1) {
        header("Location: ../admin/product.php?success=Successfully edited product: $prod_nm");
        exit();
    }

    $descs = $res['fname'] . " modified a product: " . $prod_nm;
    $log = $conn->prepare("INSERT INTO `activity_log` (`description`, `date`) VALUES (?, now() )");
    $log->execute([$descs]);

    header("Location: ../admin/addproduct.php?success=Successfully Added");
}
?>