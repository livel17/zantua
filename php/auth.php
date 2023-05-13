<?php 
session_start();
if(	isset($_POST['uname']) && 
	isset($_POST['pass'])){
	include "../dbcon.php";

		$uname = $_POST['uname'];
		$pass = $_POST['pass'];

		$data = "uname=".$uname;
			
			if(empty($uname)){
				$em = "User Name is required";
				header("Location: ../login.php?error=$em&$data");
				exit;
			}else if(empty($pass)){
				$em = "Password is required";
				header("Location: ../login.php?error=$em&$data");
				exit;
			}else{
				// Verification
				$stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
				$stmt->execute([$uname]);
				if($stmt->rowCount() > 0 ){
					while($user = $stmt->fetch(PDO::FETCH_ASSOC)){
						$username = $user['username'];
						$password = $user['pass'];

						if($username != $uname){
							$em = "Incorrect Username or Password";
							header("Location: ../login.php?error=$em&$data");
							exit;
						}else{
							if(password_verify($pass, $password)){
								$_SESSION['Attempts'] = 0;
								unset($_SESSION['locked']);
								$id = $user['user_Id'];
 
								$_SESSION['id'] = $id;
                                $_SESSION['Role'] = $user["role"];

								//Others
								$_SESSION['name'] = $user['fname'];
								$_SESSION['gender'] = $user['gender'];
								$_SESSION['email'] = $user['email'];
								$_SESSION['address'] = $user['address'];
								$_SESSION['contact'] = $user['contact'];
								$_SESSION['Date'] = $user['date_created'];
                                //$stats = $conn->query("UPDATE schl_accounts SET status='Online' WHERE f_name='$fname' ") or die();
                                header("Location: ../admin/index.php");
                                exit;
							}else{
								$_SESSION['Attempts'] += 1;
								$con = $_SESSION['Attempts'];
								$em = "Incorrect Password";
								header("Location: ../login.php?error=$em&$data&count=$con");
							}
						}
					}
				}else{
					header("Location: ../login.php?error=Invalid Username or Password");
					exit;
				}

				// End of Verification

			}
}else{
	header("Location: ../login.php?error=error");
	exit;
}

?>