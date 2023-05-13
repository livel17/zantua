<?php
session_start();
include "../dbcon.php";

$id = $_SESSION['id'];
$sql = $conn->query("SELECT * FROM admin WHERE user_Id = '$id' ");

$stmt = $sql->fetch(PDO::FETCH_ASSOC);

if (isset($_SESSION['Role'])) {
    if ($_SESSION['Role'] != 'Manager') {
        header('Location: ../login.php');
    }
} else {
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

    <title>User Profile</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="profilestyles.css">
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="<ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php echo $stmt['fname']; ?>
                                </span>
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
                <div class="container-fluid" style="justify-content: center;">
                    <div class="d-sm-flex  justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Manage Profile</h1><br>
                        <a onclick="javascript:window.history.back();" class="btn btn-dark btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-left"></i>
                            </span>
                            <span class="text">Back</span>
                        </a>

                    </div>
                    <div style="margin-top: 10px;">
                        <form class="shadow w-450 p-3" id="form" enctype="multipart/form-data" method="post">
                            <div class="card mb-1" style="width: auto; height: auto;">
                                <div class="card-header py-3" style="text-align: left;">
                                    <h6 class="m-0 font-weight-bold text-gray-800">Profile Picture</h6>
                                </div>
                                <form class="form" id="form" action="" enctype="multipart/form-data" method="post">
                                    <div class="col-sm-12">
                                        </br>
                                    </div>
                                    <div class="col-sm-12">
                                        </br>
                                    </div>
                                    <input type="hidden" name="LRN" value="<?php echo $stmt['user_Id']; ?>">
                                    <!------- IMAGE -------->
                                    <!-- <div class="upload-pic">
                                        <img src="../img/12.png" width=150 height=150>
                                        <div class="round">
                                            <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png">
                                            <i class="fa fa-camera" style="color: #fff;"></i>
                                        </div>
                                    </div> -->
                                    <div class="upload-pic">
                                        <?php
                                        if ($stmt['image'] != null) {
                                            echo '<img src="../img/' . $stmt['image'] . '" width="150px" height="150px" id="profileImg">';
                                        } else {
                                            switch ($stmt['gender']) {
                                                case "Male":
                                                    echo '<img src="../img/undraw_profile_2.svg" id="profileImg">';
                                                    break;
                                                case "Female":
                                                    echo ' img src="../img/undraw_profile_3.svg" id="profileImg">';
                                                    break;
                                                default:
                                                    echo '<img src="../img/nophoto.png" id="profileImg">';
                                                    break;
                                            }
                                        }
                                        ?>

                                        <div class="round">
                                            <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png">
                                            <i class="fa fa-camera" style="color: #fff;"></i>
                                        </div>

                                        <!------- IMAGE-disabled -------->
                                        <!-- <div class="rightRound" id="upload">
                                            <input type="file" name="fileImg" id="fileImg" accept=".jpg, .jpeg, .png">
                                            <i class="fa fa-camera"></i>
                                        </div>

                                        <div class="leftRound" id="cancel" style="display: none;">
                                            <i class="fa fa-times"></i>
                                        </div>

                                        <div class="rightRound" id="confirm" style="display: none;">
                                            <input type="submit" name="" value="">
                                            <i class="fa fa-check"></i>
                                        </div> -->

                                    </div>
                                </form>
                                <script type="text/javascript">
                                    document.getElementById("image").onchange = function () {
                                        document.getElementById("form").submit();
                                    };
                                </script>
                                <?php
                                if (isset($_FILES["image"]["name"])) {
                                    $imageName = $_FILES["image"]["name"];
                                    $imageSize = $_FILES["image"]["size"];
                                    $tmpName = $_FILES["image"]["tmp_name"];

                                    // Image validation
                                    $validImageExtension = ['jpg', 'jpeg', 'png'];
                                    $imageExtension = explode('.', $imageName);
                                    $imageExtension = strtolower(end($imageExtension));
                                    if (!in_array($imageExtension, $validImageExtension)) {
                                        echo
                                            "
                                            <script>
                                            alert('Invalid Image Extension');
                                            document.location.href = '../updateimageprofile';
                                            </script>
                                            ";
                                    } elseif ($imageSize > 1200000) {
                                        echo
                                            "
                                            <script>
                                            alert('Image Size Is Too Large');
                                            document.location.href = '../updateimageprofile';
                                            </script>
                                            ";
                                    } else {
                                        $newImageName = date("Y.m.d") . " - " . date("h.i.sa"); // Generate new image name
                                        $newImageName .= '.' . $imageExtension;
                                        $sql = "UPDATE admin SET image = '$newImageName' WHERE user_Id = $id";
                                        // $query = "UPDATE admin SET image = '$newImageName' WHERE id = $id";
                                        // mysqli_query($conn, $query);
                                        move_uploaded_file($tmpName, '../img/' . $newImageName);

                                        $res = $conn->query($sql);

                                        if (!$res) {
                                            die("Invalid query!");
                                        } else {
                                            echo "<script>
                                            window.location.href = 'userprofile.php';
                                            </script>";
                                        }
                                    }
                                }
                                ?>
                                <!----- END OF CLASS UPLOAD ----->

                                <div>
                                    <div class="form-group row" style="margin: 10px;" id="upload">
                                        <div class="col-sm-12">
                                            <br>
                                        </div>
                                        <div class="col-sm-12">

                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive text-center">
                                    <table id="dataTable" width="100%" cellspacing="20" cellpadding="5">
                                        <tr>
                                            <th style="font-size:15px;">
                                                <?= $_SESSION['id'] ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th style="font-size:20px; text-transform: uppercase;" class="text-success">
                                                <?= $_SESSION['name'] ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="bg-secondary"></th>
                                        </tr>
                                        <!-- <tr>
                                            <th style="font-size:15px;">
                                                <i class="fas fa-fw fa-genderless text-dark"></i>
                                                <span class="text-dark">
                                                    <?= $_SESSION['gender'] ?>
                                                </span>
                                            </th>
                                        </tr> -->
                                        <tr>
                                            <th style="font-size:15px;">
                                                <i class="fas fa-fw fa-birthday-cake text-dark"></i>
                                                <span class="text-dark">
                                                    <?php echo date('F d, Y', strtotime($stmt['birthday'])); ?>
                                                </span>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th style="font-size:15px;">
                                                <i class="fas fa-fw fa-envelope text-dark"></i>
                                                <span class="text-dark">
                                                    <?= $_SESSION['email'] ?>
                                                </span>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th style="font-size:15px;">
                                                <i class="fas fa-fw fa-house-user text-dark"></i>
                                                <span class="text-dark">
                                                    <?= $_SESSION['address'] ?>
                                                </span>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th style="font-size:15px;">
                                                <i class="fas fa-fw fa-phone text-dark"></i>
                                                <span class="text-dark">
                                                    <?= $_SESSION['contact'] ?>
                                                </span>
                                            </th>
                                        </tr>
                                        <th style="font-size:15px;">
                                            <i class="fas fa-fw fa-grin-alt text-dark"></i>
                                            <span class="text-dark">Joined:
                                                <?php echo date('F d, Y h:i a', strtotime($_SESSION['Date'])) ?>
                                            </span>
                                        </th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>


                <!-- End of Content Wrapper -->

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