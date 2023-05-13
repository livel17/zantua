<?php
    include "../dbcon.php";
    if(isset($_POST['archive'])){
        #ARCHIVE
        $userid = $_POST['user_id'];
    
        $role = $conn->query("UPDATE admin SET role='Unknown' WHERE user_Id='$userid'");
    
        header("Location: ../admin/profile.php?error=User added to Archive");
        exit;
    }else{
        #RESTORE
        $userid = $_GET['user_id'];
    
        $role = $conn->query("UPDATE admin SET role='Manager' WHERE user_Id='$userid'");
    
        header("Location: ../admin/archive_user.php?success=User Restoredd");
        exit;
    }
?>
