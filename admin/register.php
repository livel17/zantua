<?php 
    session_start();
    include "../dbcon.php";

    $id = $_SESSION['id'];
    $sql = $conn->query("SELECT * FROM admin WHERE user_Id = '$id' ");

    $stmt = $sql->fetch(PDO::FETCH_ASSOC);

    if(isset($_SESSION['Role'])){
        if($_SESSION['Role'] != 'Manager'){
            header('Location: ../login.php');
        }
    }else{
        header('Location: ../login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <style>
    #termsCheck {
        color: blue;
        text-decoration: underline;
        cursor: pointer;
    }
</style>
<style>
    /* Existing styles... */

    #termsCheck {
        color: blue;
        text-decoration: underline;
        cursor: pointer;
    }

    #modalLink {
        color: blue;
        text-decoration: underline;
    }

    #termsModal.show #modalLink {
        color: black;
        text-decoration: none;
    }
    .terms-link {
    color: blue;
    cursor: pointer;
}

</style>


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <hr class="sidebar-divider">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <img src="../img/logosmall.png" alt="Zantlo Logo" class="sidebar-brand-icon">
        <div class="sidebar-brand-text mx-3 main text">Zantua General Merchandising <sup></sup></div>
    </a>

    <!-- Divider -->
    <hr>
    <hr class="sidebar-divider">

    <!-- Nav Item - Dashboard -->
    <div class="sidebar-heading">
        Dashboard
    </div>

    <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
            <hr class="sidebar-divider">
    </li>

    <div class="sidebar-heading">
        Product
    </div>

    <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'product.php' ? 'active' : ''; ?>">
        <a class="nav-link" href="product.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Product</span></a>
    </li>

    <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'recently_deleted.php' ? 'active' : ''; ?>">
        <a class="nav-link" href="recently_deleted.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Recently Deleted</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Account
    </div>

    <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'active' : ''; ?>">
        <a class="nav-link" href="profile.php">
            <i class="fas fa-fw fa-cog"></i>
            <span>Account Information</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
               <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
  <a class="navbar-brand font-weight-bold mx-auto" href="index.php">Zantua General Merchandising</a>
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $stmt['fname']; ?></span>
                                <img class="img-profile rounded-circle" src="<?php echo '../img/' . $stmt['image'] ?? 'undraw_profile.svg'; ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                 <a class="dropdown-item" href="userprofile.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a> 
                                
                                <a class="dropdown-item" href="settings.php">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="activitylog.php">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Add User</h1>
                        <a href="profile.php" class="btn btn-dark btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-left"></i>
                            </span>
                            <span class="text">Back</span>
                        </a>
                    </div>

                    <!-- Content Row -->
                    <div class="container">
                        <form   class="shadow w-450 p-3" 
                                action="../php/add_admin.php"
                                method="POST">
                                <?php if(isset($_GET['error'])){ ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo $_GET['error']; ?>
                                    </div>
                                <?php } ?>
                            
                                <?php if(isset($_GET['success'])){ ?>
                                    <div class="alert alert-success" role="alert">
                                        <?php echo $_GET['success']; ?>
                                    </div>
                                <?php } ?>
                                <div class="card shadow mb-4">
    <div>
        <div class="card-body">
            <div class="form-group row">
                <div class="col-sm-4">
    <?php
        $stmt = $conn->query("SELECT id FROM admin ORDER BY id DESC LIMIT 1");
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        $mid = $res['id'] + 1;
    ?>
    <input type="text" name="userid" placeholder="User ID" class="form-control" value="<?php echo "000".$mid; ?>" readonly>
</div>

                <div class="col-sm-8"></div>
                </br></br>
                <div class="col-sm-6">
                    <input type="text" name="fname" placeholder="Full Name" class="form-control" value="<?php echo (isset($_GET['fname']))?$_GET['fname']:"" ?>">
                </div>
                <div class="col-sm-6">
                    <input type="text" name="role" placeholder="Position" class="form-control" value="<?php echo (isset($_GET['role']))?$_GET['role']:"" ?>">
                </div>
                </br></br>
                <div class="col-sm-5">
                    <input type="text" name="uname" placeholder="Username" class="form-control" value="<?php echo (isset($_GET['uname']))?$_GET['uname']:"" ?>">
                </div>
                <div class="col-sm-7">
                    <input type="email" name="email" placeholder="Email" class="form-control" value="<?php echo (isset($_GET['email']))?$_GET['email']:"" ?>">
                </div>
                </br></br>
                <div class="col-sm-6">
                    <input type="date" name="birthday" placeholder="Birthday" class="form-control" value="<?php echo (isset($_GET['birthday']))?$_GET['birthday']:"" ?>">
                </div>
                <div class="col-sm-6">
                    <input type="text" name="address" placeholder="Address" class="form-control" value="<?php echo (isset($_GET['address']))?$_GET['address']:"" ?>">
                </div>
                </br></br>
                <div class="col-sm-6">
                    <input type="password" name="pass" placeholder="Password" class="form-control" value="<?php echo (isset($_GET['pass']))?$_GET['pass']:"" ?>">
                </div>
                <div class="col-sm-6">
                    <input type="password" name="cpass" placeholder="Confirm Password" class="form-control" value="<?php echo (isset($_GET['cpass']))?$_GET['cpass']:"" ?>">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-6">
<div class="form-check">
    <input type="checkbox" class="form-check-input" id="termsCheck">
    <label class="form-check-label" for="termsCheck" data-toggle="modal" data-target="#termsModal">
    I have read and agree to the <span class="terms-link">Terms and Conditions</span>
</label>

</div>

    </div>
</div>

<div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p1>Intellectual Property Rights
Unless otherwise stated, we or our licensors own the intellectual property rights in the website and material on the website. You may view, download for caching purposes only, and print pages from the website for your own personal use, subject to the restrictions set out below and elsewhere in these terms and conditions.
<br></br>
</p1>

<p2>Acceptable Use
You must not use our website in any way that causes, or may cause, damage to the website or impairment of the availability or accessibility of the website; or in any way which is unlawful, illegal, fraudulent or harmful. You must not use our website to copy, store, host, transmit, send, use, publish or distribute any material which consists of (or is linked to) spyware, computer virus, Trojan horse, worm, keystroke logger, rootkit or other harmful computer software.
<br></br>
</p2>

<p3>Limitations of Liability
The information on our website is provided free-of-charge, and you acknowledge that it would be unreasonable to hold us liable in respect of this website and the information on this website. We will not be liable for any direct, indirect or consequential loss or damage arising under these terms and conditions or in connection with our website.
<br></br>
</p3>

<p4>Variation
We may revise these terms and conditions from time to time. The revised terms and conditions shall apply to the use of our website from the date of publication of the revised terms and conditions on our website.
<br></br>
</p4>

<p5>Entire Agreement
These terms and conditions, together with our privacy policy, constitute the entire agreement between you and us in relation to your use of our website.
<br></br>
</p5>

<p6>Governing Law and Jurisdiction
These terms and conditions will be governed by and construed in accordance with the laws of [Insert Country/State]. Any disputes relating to these terms and conditions will be subject to the exclusive jurisdiction of the courts of [Insert Country/State].
<br></br>
</p6>

<p7>Contact Information
If you have any questions about these terms and conditions, please contact us via email at [Insert Email Address].
<br></br>
</p7>

                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="modalTermsCheck">
                    <label class="form-check-label" for="modalTermsCheck">I agree to the above terms and conditions</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-6"></div>
    <div class="col-sm-6">
        <button type="submit" id="addUserBtn" name="add" class="btn btn-icon-split" style="background-color: #40916C; float: right;" disabled>
            <span class="icon text-white-50">
                <i class="fas fa-plus-square"></i>
            </span>
            <span class="text text-white">Add User</span>
        </button>
    </div>
</div>

<script>
    const modalTermsCheck = document.querySelector('#modalTermsCheck');
    const termsCheck = document.querySelector('#termsCheck');
    const addUserBtn = document.querySelector('#addUserBtn');

    // Enable the main checkbox and open modal when the terms and conditions text is clicked
    termsCheck.addEventListener('click', function() {
        termsCheck.checked = false; // Uncheck the checkbox to allow multiple clicks
        $('#termsModal').modal('show');
    });

    // Enable the main checkbox and the "Add User" button when the modal checkbox is checked
    modalTermsCheck.addEventListener('change', function() {
        termsCheck.checked = modalTermsCheck.checked;
        addUserBtn.disabled = !termsCheck.checked;
    });

    // Code to add a user when the "Add User" button is clicked
    addUserBtn.addEventListener('click', function() {
        // Code to add a user goes here
    });
</script>







                                <div class="form-group row">
                                    
                        </form>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>ZANTUA &copy; GENERAL MERCHANDISE 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../php/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>

</body>

</html>