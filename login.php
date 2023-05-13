<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Zantua Genneral Merchandising</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body style="background-color: #e0b348;">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block" style="background-image: url(img/zantua_logo1.png); background-repeat: no-repeat; background-position: center; "></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <!--Validation-->
                                    <form action="php/auth.php" method="POST">
                                    <?php if(isset($_GET['error'])){ ?>
                                        <div class="alert" style="color: gray; text-align: center;" role="alert">
                                        <?php echo $_GET['error']; ?>
                                        </div>
                                    <?php } ?>

                                    <?php 
                                        $attemp = 0;
                                        if(isset($_GET['count'])){
                                        $attemp = $_GET['count'];
                                        }
                                        if($attemp != 3){
                                            $_SESSION['locked'] = time(); ?>
                                            <div class="form-group">
                                                <input class="form-control form-control-user"
                                                autofocus maxlength="50" type="text" placeholder="Username" name="uname" value="<?php echo (isset($_GET['uname']))?$_GET['uname']:"" ?>">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user"
                                                    id="exampleInputPassword" placeholder="Password" type="password" maxlength="25" placeholder="Password" name="pass">
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck">
                                                    <label class="custom-control-label" for="customCheck">Remember
                                                        Me</label>
                                                </div>
                                            </div>
                                            <input type="submit" value="Login" class="btn btn-primary btn-user btn-block" >
                                            <hr>
                                        <?php }else{ 
                                            $difference = time() - $_SESSION['locked'];
                                            if($difference > 15){
                                            $attemp = 0;
                                        ?>
                                            <div class="form-group">
                                                <input class="form-control form-control-user"
                                                autofocus maxlength="50" type="text" placeholder="Username" name="uname" value="<?php echo (isset($_GET['uname']))?$_GET['uname']:"" ?>">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user"
                                                    id="exampleInputPassword" placeholder="Password" type="password" maxlength="25" placeholder="Password" name="pass">
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck">
                                                    <label class="custom-control-label" for="customCheck">Remember
                                                        Me</label>
                                                </div>
                                            </div>
                                            <input type="submit" value="Login" class="btn btn-primary btn-user btn-block" >
                                            <hr>
                                    <?php }else{ ?> 
                                            <div class="form-group">
                                                <input class="form-control form-control-user"
                                                autofocus maxlength="50" type="text" placeholder="Username" name="uname" value="<?php echo (isset($_GET['uname']))?$_GET['uname']:"" ?>" disabled>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user"
                                                    id="exampleInputPassword" placeholder="Password" type="password" maxlength="25" placeholder="Password" name="pass" disabled>
                                            </div>
                                            <hr>
                                            <?php }
                                        }
                                    ?>
                                        
                                    </form>
                                    <!--End Validation-->
                                    <!-- <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div> -->
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    

</body>

</html>