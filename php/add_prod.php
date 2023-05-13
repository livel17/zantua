<?php
session_start();
include "../dbcon.php";

$id = $_SESSION['id'];
$stmt = $conn->query("SELECT * FROM admin WHERE user_Id ='$id'");
$res = $stmt->fetch(PDO::FETCH_ASSOC);

if( isset($_POST['add']) && isset($_FILES['picture']) ){
  $stockNo = $_POST['stock'];
  $pName = $_POST['name'];
  $pCost = $_POST['cost'];
  $pRetailPrice = $_POST['retail_price'];
  $pQuantity = $_POST['quantity'];
  $pBarcodes = $_POST['barcodes'];
  $pTags = $_POST['tags'];
  $pTaxes = $_POST['taxes'];
  $pTaxesExcempt = $_POST['taxes_exempt'];
  $enableDecimal = $_POST['enable_decimal'];
  $enableOpenPrice = $_POST['enable_openprice'];
  $disableDiscount = $_POST['disable_discount'];
  $disableInventory = $_POST['disable_inventory'];
  $pSupplierName = $_POST['supplier_name'];
  $pSupplierList = $_POST['supplier_list'];
  $pCategory = $_POST['category'];
  $pSubCategory = $_POST['subcategory'];
  $pStatus = $_POST['status'];

  $img_name = $_FILES['picture']['name'];
  $img_size = $_FILES['picture']['size'];
  $tmp_name = $_FILES['picture']['tmp_name'];
  $error = $_FILES['picture']['error'];

  if($error === 0){
      if($img_size > 25000000){
          $em = "Sorry, your file is too large";
          header("Location: ../admin/addproduct.php?error=$em");
      }else{
          $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
          $img_ex_lc = strtolower($img_ex);

          $allowed_exs = array("jpg", "jpeg", "png");

          if(in_array($img_ex_lc, $allowed_exs)){
              $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
              $img_upload_path = '../img/products/'.$new_img_name;
              move_uploaded_file($tmp_name, $img_upload_path);

              $stmt = $conn->prepare( "INSERT INTO products (stock_No, name, cost, retail_price, quantity,
          barcodes, tags, taxes, tax_exempt, description, enable_decimal, enable_open_price, disable_discount, disable_inventory, supplier_name, supplier_list,category_name, subcategory, status, img) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)" );

              if($stmt){
                  $stmt->execute([$stockNo, $pName, $pCost, $pRetailPrice, $pQuantity, $pBarcodes, $pTags, $pTaxes, $pTaxesExcempt, "", $enableDecimal, $enableOpenPrice, $disableDiscount, $disableInventory, $pSupplierName, $pSupplierList, $pCategory, $pSubCategory, $pStatus, $img_upload_path]);
                  $descs = $res['fname'] . " added a Product Name: " . $pName;
                  $log = $conn->prepare("INSERT INTO activity_log (description, date) VALUES (?, now() )");
                  $log->execute([$descs]);
                  header("Location: ../admin/addproduct.php?success=Added successfully");
                  exit;
             }else{
                  $em = "Unable to Post Announcement";
                  header("Location: ../admin/addproduct.php?error=$em");
                  exit;
             }
          }else{
                $em = "You can't upload files of this type";
                header("Location: ../admin/addproduct.php?error=$em");
          }
      }
  }else{
      $stmt = $conn->prepare( "INSERT INTO products (stock_No, name, cost, retail_price, quantity,
          barcodes, tags, taxes, tax_exempt, description, enable_decimal, enable_open_price, disable_discount, disable_inventory, supplier_name, supplier_list,category_name, subcategory, status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)" );
      if($stmt){
          $stmt->execute([$stockNo, $pName, $pCost, $pRetailPrice, $pQuantity, $pBarcodes, $pTags, $pTaxes, $pTaxesExcempt, "", $enableDecimal, $enableOpenPrice, $disableDiscount, $disableInventory, $pSupplierName, $pSupplierList, $pCategory, $pSubCategory, $pStatus]);
          $descs = $res['fname'] . " added a Product Name: " . $pName;
          $log = $conn->prepare("INSERT INTO activity_log (description, date) VALUES (?, now() )");
          $log->execute([$descs]);
          header("Location: ../admin/addproduct.php?success=Added successfully");
          exit;
      }else{
          $em = "Unknown Error Occurred!";
          header("Location: ../admin/addproduct.php?error=$em");
      }
  }       
}
?>
