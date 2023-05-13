<?php
session_start();
include "../dbcon.php";

$id = $_SESSION['id'];
$sql = $conn->query("SELECT * FROM admin WHERE user_Id = '$id' ");
$stmt = $sql->fetch(PDO::FETCH_ASSOC);

if (isset($_SESSION['Role'])) {
    if ($_SESSION['Role'] != 'Manager') {
        header('Location: ../login.php');
        exit;
    }
} else {
    header('Location: ../login.php');
    exit;
}

// select 8 products with highest searches from the famous_product table
$query1 = "SELECT prod_name, searches, barcode, img FROM famous_product ORDER BY searches DESC LIMIT 8";
$result1 = $conn->query($query1);

// select 8 random data from the products table
$query2 = "SELECT name, quantity, img FROM products WHERE quantity > 0 ORDER BY RAND() LIMIT 8";
$result2 = $conn->query($query2);

// process and display the data in a graph or table
$labels1 = array();
$data1 = array();
$images1 = array();
$count1 = 0;
while ($row = $result1->fetch(PDO::FETCH_ASSOC)) {
    $labels1[] = $row['prod_name'];
    $data1[] = $row['searches'];
    $images1[] = $row['img'];
    $count1++;
}

$labels2 = array();
$data2 = array();
$images2 = array();
$count2 = 0;
while ($row = $result2->fetch(PDO::FETCH_ASSOC)) {
    $labels2[] = $row['name'];
    $data2[] = $row['quantity'];
    $images2[] = $row['img'];
    $count2++;
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

    <title>Dashboard</title>

    <!-- Custom fonts for this template-->
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

            <li
                class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'recently_deleted.php' ? 'active' : ''; ?>">
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
                    <img src="../img/zantua_logo.png" alt="Zantlo Logo" class="logo-image">
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
                                <img class="img-profile rounded-circle"
                                    src="<?php echo '../img/' . $stmt['image'] ?? 'undraw_profile.svg'; ?>">

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
                        <h1 class="h3 mb-0 text-gray-800">Top Products</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <!-- Generate cards for famous products data -->
                        <?php
                        $stmt = $conn->query("SELECT * FROM products ORDER BY unit_sold DESC LIMIT 5");
                        while ($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-start">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                                    <?= $res['name'] ?>
                                                </div>
                                                <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">Total Searches:
                                                    1
                                                </div> -->
                                            </div>
                                            <div class="col-auto">
                                                <?php if ($res['img'] !== null && $res['img'] !== ''): ?>
                                                    <img src="<?php echo $res['img'] ?>" alt="Product Image"
                                                        style="max-width: 100px; max-height: 100px; height: 100px;">
                                                <?php else: ?>
                                                    <img src="https://via.placeholder.com/50x50" alt="Product Image"
                                                        style="max-width: 100px; max-height: 100px; height: 100px;">
                                                <?php endif; ?>
                                            </div>
                                            <style>
                                                .logo-image {
                                                    width: 125px;
                                                    height: 70px;
                                                    margin-left: 450px;
                                                }

                                                .main-text {
                                                    margin-left: -20px;
                                                    text-align: center;
                                                }
                                            </style>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>


                        <!-- Pending Requests Card Example -->

                    </div>

                    <!-- Content Row -->

                    <div class="row">
                        <div class="col-12">

                        </div>
                    </div>

                    <div class="row">

                        <div class="col-12">
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Available Products</h1>
                            </div>
                            <div class="row">
                                <?php for ($i = 0; $i < count($labels2); $i++): ?>
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div
                                                            class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                                            <?= $labels2[$i] ?>
                                                        </div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Quantity:
                                                            <?= $data2[$i] ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <?php if ($images2[$i] != null): ?>
                                                            <img src="<?php echo ($images2[$i]) ?>" alt="Product Image"
                                                                style="max-width: 100px; max-height: 100px; height: 100px;">
                                                        <?php else: ?>
                                                            <img src="https://via.placeholder.com/50x50" alt="Product Image"
                                                                style="max-width: 100px; max-height: 100px; height: 100px;">
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                            <!-- Project Card Example -->


                            <!-- Color System -->


                        </div>

                        <div class="col-lg-6 mb-4">

                            <!-- Illustrations -->

                        </div>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <!-- Ito Script ng Chart-->


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