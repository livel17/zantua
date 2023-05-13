<?php
include "../dbcon.php";

$sql = $conn->query("DELETE FROM recent_delete");
if ($sql) {
  header("Location: ../admin/recent_deleted.php");
  exit;
} else {
  echo "Error deleting table: " . mysqli_error($sql);
}
?>
