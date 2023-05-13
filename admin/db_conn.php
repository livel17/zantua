<?php
    $Server_Name="localhost";
    $User_Name="root";
    $Pwd="";
    $DB_Name="zantua_db";

    $connection = mysqli_connect($Server_Name,  $User_Name, $Pwd, $DB_Name);

        if (!$connection){
            die("Could not establish connection".mysqli_connect_error());
        }
            
?>