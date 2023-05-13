<?php 
session_start();
include "../dbcon.php";
	
	if(isset($_POST['change']))
	{
		$id = $_SESSION['id'];
		$oldpass = $_POST['oldpass'];
		$pass = $_POST['newpass'];
		$cpass = $_POST['newc_pass'];
		
		if(empty($oldpass)){
			$em = "Password is required";
			header("Location: ../admin/settings.php?error=$em");
			exit;
		}else{
			$stmt = $conn->query("SELECT * FROM admin WHERE user_Id='$id' ");

			if($stmt->rowCount() > 0 ){
					while($user = $stmt->fetch(PDO::FETCH_ASSOC)){
						$password = $user['pass'];

						if(password_verify($oldpass, $password)){
							if(empty($pass)){
								$em = "New Password is required";
                                header("Location: ../admin/settings.php?error=$em");
								exit;
							}else if(empty($cpass)){
								$em = "Confirm Password is required";
                                header("Location: ../admin/settings.php?error=$em");
								exit;
							}else{
								if($cpass == $pass){
									// hashing the password
									$pass = password_hash($pass, PASSWORD_DEFAULT);
									$cpass = password_hash($cpass, PASSWORD_DEFAULT);
											
									$sql = "UPDATE admin SET pass='$pass', c_pass='$cpass' WHERE user_Id='$id' ";
									$res = $conn->query($sql);
									if ($res){
										echo '<script> alert("Data Updated"); </script>';
										header("Location: ../admin/settings.php?success=Updated Successfully");
									}else{
										echo '<script> alert("Data Not Updated"); </script>';
										header("Location: ../admin/settings.php?result=UpdateFailed");
									}
								}else{
									$em = "Password should be match!";
									header("Location: ../admin/settings.php?error=$em");
									exit;
								}
							}
						}else{
							$em = "Incorrect Password";
							header("Location: ../admin/settings.php?error=$em");
						}
				}
			}
		}
	}

?>