<?php
    session_start();
    include "../dbcon.php";

    $id = $_SESSION['id'];
    $stmt = $conn->query("SELECT * FROM admin WHERE user_Id ='$id'");
    $res = $stmt->fetch(PDO::FETCH_ASSOC);

    $userid = $_POST["userid"];
    $fname = $_POST["fname"];
    $role = $_POST["role"];
    $uname = $_POST["uname"];
    $email = $_POST["email"];
    $birthday = $_POST["birthday"];
    $address = $_POST["address"];
    $pass = $_POST["pass"];
    $cpass = $_POST["cpass"];
    $pattern = '/^(?=.*[!@#$%^&*])[A-Za-z0-9!@#$%^&*]{5,}$/';
$data = "fname=".$fname."&role=".$role."&uname=".$uname."&email=".$email."&birthday=".$birthday."&address=".$address."&pass=".$pass."&cpass=".$cpass;
if (!preg_match($pattern, $pass)) {
    // Password does not meet the criteria
    $em = "Must include a special character(!@#$%^&*)";
    $em_encoded = urlencode($em);
    header("Location: ../admin/register.php?error=$em_encoded&$data");
    exit;
}
    if($fname == null){
        $em = "Fullname is required";
        header("Location: ../admin/register.php?error=$em&$data");
    }else if($role == null){
        $em = "Role is required";
        header("Location: ../admin/register.php?error=$em&$data");
    }else if($uname == null){
        $em = "Username is required";
        header("Location: ../admin/register.php?error=$em&$data");
    }else if($email == null){
        $em = "Email is required";
        header("Location: ../admin/register.php?error=$em&$data");
    }else if($birthday == null){
        $em = "Birthday is required";
        header("Location: ../admin/register.php?error=$em&$data");
    }else if($address == null){
        $em = "Address is required";
        header("Location: ../admin/register.php?error=$em&$data");
    }else if($pass == null){
        $em = "Password is required";
        header("Location: ../admin/register.php?error=$em&$data");
    }else if($cpass == null){
        $em = "Confirm Password is required";
        header("Location: ../admin/register.php?error=$em&$data");
    }else{
        if($cpass == $pass){
            $pass = password_hash($pass, PASSWORD_DEFAULT);
            $cpass = password_hash($cpass, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO admin (user_Id, fname, role, username, email, birthday, address, pass, c_pass) VALUES (?,?,?,?,?,?,?,?,?)");
            $stmt->execute([$userid, $fname, $role, $uname, $email, $birthday, $address, $pass, $cpass]);
            
            $desc = $res['fname']." added a User with an ID: ".$userid." with a Name: ".$fname;
            $log = $conn->prepare("INSERT INTO activity_log (description, date) VALUES (?, now() )");
            $log->execute([$desc]);

            header("Location: ../admin/register.php?success=Successfully Added");
        }else{
            $em = "Confirm Password must same to the Password";
            header("Location: ../admin/register.php?error=$em&$data");
            exit;
        }
    }
?>