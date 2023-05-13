<?php
session_start();
include "../dbcon.php";

$connection = mysqli_connect("localhost", "root", "", "auth_zantua");
$id = $_SESSION['id'];
$sql = $conn->query("SELECT * FROM admin WHERE user_Id = '$id' ");
$deleteParams = "";

$user = $sql->fetch(PDO::FETCH_ASSOC);

if (isset($_SESSION['Role'])) {
    if ($_SESSION['Role'] != 'Manager') {
        header('Location: ../login.php?error=Invalid Role');
    }
} else {
    header('Location: ../login.php?error=Invalid Role');
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

    <title>Recently Deleted</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../vendor/datatables.bootstrap4.min.css">
    <style text="text/css">
        th {
            text-align: center;
            color: black;
            font-weight: bold;
        }

        td {
            text-align: center;
            color: black;
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
                                    <?php echo $user['fname']; ?>
                                </span>
                                <img class="img-profile rounded-circle"
                                    src="<?php echo '../img/' . $user['image'] ?? 'undraw_profile.svg'; ?>">

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
                        <h1 class="h3 mb-0 text-gray-800">Recently Deleted</h1>
                        <div class="d-flex">

                        </div>

                    </div>

                    <!-- Delete Table Modal -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php if (isset($_GET['success'])) { ?>
                                    <div class="alert alert-success" role="alert">
                                        <?php echo $_GET['success']; ?>
                                    </div>
                                <?php } ?>
                                <form method="POST" action="../php/restore_selected.php">
                                    <button class="btn btn-danger delete-selected-btn" type="submit" name="deleted"
                                        style="text-align: right;">
                                        Restore Selected
                                    </button>
                                    <table class="table table-bordered table-striped" id="dataTable" width="100%"
                                        cellspacing="0" style="font-size: 12px">
                                        <thead style="text-align: center;">
                                            <tr>
                                                <th>Select</th>
                                                <th>Barcodes</th>
                                                <th>Stock No.</th>
                                                <th>Name</th>
                                                <th>Cost</th>
                                                <th>Retail_Price</th>
                                                <th>Quantity</th>
                                                <th>Tags</th>
                                                <th>Taxes</th>
                                                <th>Tax_Exempt</th>
                                                <th>Description</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $stmt = $conn->query("SELECT * FROM recent_delete");
                                            while ($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <tr>
                                                    <td style="text-align:center; background-color:white; flex: 0 0 15%;">
                                                        <input type="checkbox" name="prodid[]"
                                                            value="<?php echo $res['id'] ?>">
                                                    </td>
                                                    <td>
                                                        <?php echo (int) $res["barcodes"]; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $res["stock_No"]; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $res["name"]; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $res["cost"]; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $res["retail_price"]; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $res["quantity"]; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $res["tags"]; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $res["taxes"]; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $res["tax_exempt"]; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $res["description"]; ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>

                        <!-- Content Row -->
                        <div class="row">

                        </div>

                        <!-- Content Row -->

                        <div class="row">

                        </div>

                        <!-- Content Row -->
                        <div class="row">

                        </div>

                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- View Modal -->
                <div class="modal fade" id="viewModal_<?php echo $res["user_Id"]; ?>" tabindex="-1" role="dialog"
                    aria-labelledby="viewModalLabel_<?php echo $res["user_Id"]; ?>" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewModalLabel_<?php echo $res["user_Id"]; ?>">View User
                                    Information</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

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

        <!-- Batch Import Modal-->
        <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Batch Import</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Select "Logout" below if you are ready to end your current session.
                        <form class="mt-3" action="" method="post" enctype="multipart/form-data"
                            style="display: flex; justify-content: space-between;">
                            <input type="file" name="excel" required value="">
                            <button type="submit" name="import">Import</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JavaScript-->
        <script src="../vendor/jquery/jquery.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!--Datatable-->
        <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="../js/demo/datatables-demo.js"></script>
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