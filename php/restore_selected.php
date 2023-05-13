<?php
    session_start();
    include "../dbcon.php";

    $id = $_SESSION['id'];

    if(isset($_POST['deleted'])){

        $item_id = $_POST['prodid'];

        if($item_id != null){
            foreach($item_id as $id) { 
                $statement = $conn->query("SELECT * FROM recent_delete WHERE id = $id");
                if($statement->rowCount() > 0) {
                    $row = $statement->fetch(PDO::FETCH_ASSOC);
                    unset($row['id']);
                    $keys = implode(',', array_keys($row));
                    $values = "'" . implode("','", array_values($row)) . "'";
                    $sql = "INSERT INTO products ($keys) VALUES ($values)";
                    $conn->query($sql);
                    $conn->query("DELETE FROM recent_delete WHERE id = $id");
                }
            }
            // header('Location: ../admin/recently_deleted.php');
        } else {
            // echo 
            //     '
            //     <script> 
            //         alert("Invalid Action");
            //         window.location.href="../admin/product.php?error=Please select an Item to Delete";
            //     </script>
            //     ';
            exit;
        }
    } else {
        echo 
                '
                <script> 
                    alert("Please wait before checkout");
                    window.location.href="product.php";
                </script>
                ';
            exit;
    }
?>
