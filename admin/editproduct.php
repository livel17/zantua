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

    <title>Edit Product</title>

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
                <div class="fas fa-shopping-cart">

                </div>
                <div class="sidebar-brand-text mx-3">Zantua General Merchandising <sup></sup></div>
            </a>

            <!-- Divider -->
            <hr>
            <hr class="sidebar-divider">

            <!-- Nav Item - Dashboard -->
            <div class="sidebar-heading">
                Dashboard
            </div>

            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>



            <!-- Divider -->
            <div class="sidebar-heading">
                Product
            </div>
            <li class="nav-item active">
                <a class="nav-link" href="product.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Product</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="recently_deleted.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Recently Deleted</span></a>
            </li>
            <!-- Heading -->
            <div class="sidebar-heading">
                Account
            </div>
            <li class="nav-item active">
                <a class="nav-link" href="profile.php">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Account Information</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->


            <!-- Divider -->

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
                        <h1 class="h3 mb-0 text-gray-800">Edit Product</h1>
                        <a href="product.php" class="btn btn-dark btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-left"></i>
                            </span>
                            <span class="text">Back</span>
                        </a>
                    </div>

                    <!-- Content Row -->
                    <div class="container">
                        <form class="shadow w-450 p-3" action="../php/update_product.php" enctype="multipart/form-data"
                            method="POST">
                            <?php if (isset($_GET['error'])) { ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $_GET['error']; ?>
                                </div>
                            <?php } ?>

                            <?php if (isset($_GET['success'])) { ?>
                                <div class="alert alert-success" role="alert">
                                    <?php echo $_GET['success']; ?>
                                </div>
                            <?php } ?>
                            <div class="card shadow mb-4">
                                <?php
                                $prodid = $_GET['prodid'];
                                $stmt = $conn->query("SELECT * FROM products WHERE id='$prodid'");
                                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            </br></br>
                                            <div class="col-sm-6">
                                                <input type="hidden" name="prodid" placeholder="Id" class="form-control"
                                                    value="<?php echo $res['id'] ?>">
                                                <label>Stock No.</label>
                                                <input type="text" name="product_id" placeholder="Id"
                                                    class="form-control" value="<?php echo $res['stock_No'] ?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Barcode</label>
                                                <input type="text" name="barcodes" placeholder="Product Barcode"
                                                    class="form-control" value="<?php echo $res['barcodes'] ?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Product Name</label>
                                                <input type="text" name="productname" placeholder="Product Name"
                                                    class="form-control" value="<?php echo $res['name'] ?>">
                                            </div>
                                            </br></br>
                                            <div class="col-sm-6">
                                                <label>Cost</label>
                                                <input type="text" name="cost" placeholder="cost" class="form-control"
                                                    value="<?php echo $res['cost'] ?>">
                                            </div>
                                            </br></br>
                                            <div class="col-sm-6">
                                                <label>Retail Price</label>
                                                <input type="number" name="retailprice" placeholder="Retail Price"
                                                    class="form-control" value="<?php echo $res['retail_price'] ?>">
                                            </div>
                                            </br></br>
                                            <div class="col-sm-6">
                                                <label>Quantity</label>
                                                <input type="number" name="quantity" placeholder="Stocks"
                                                    class="form-control" value="<?php echo $res['quantity'] ?>">
                                            </div>
                                            </br></br>
                                            <div class="col-sm-6">
                                                <label>Tags</label>
                                                <input type="text" name="tags" placeholder="Tags" class="form-control"
                                                    value="<?php echo $res['tags'] ?>">
                                            </div>
                                            </br></br>
                                            <div class="col-sm-6">
                                                <label>Taxes</label>
                                                <input type="text" name="taxes" placeholder="Taxes" class="form-control"
                                                    value="<?php echo $res['taxes'] ?>">
                                            </div>
                                            </br></br>
                                            <div class="col-sm-6">
                                                <label>Tax Exemption</label>
                                                <input type="text" name="tax_exempt" placeholder="Tax Exempt"
                                                    class="form-control" value="<?php echo $res['tax_exempt'] ?>">
                                            </div>
                                            </br></br>
                                            <div class="col-sm-6">
                                                <label>Description</label>
                                                <textarea name="description" placeholder="Input Description here..."
                                                    class="form-control" id="Description" cols="30"
                                                    rows="1"><?php echo $res['description'] ?></textarea>
                                            </div>
                                            </br></br>
                                            <div class="col-sm-12"></br>
                                                <input type="hidden" class="form-control" id="Description">
                                            </div>
                                            <div class="col-sm-3">
                                                <span id="file-chosen">No file chosen</span>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="file" name="picture" id="actual" hidden />
                                                <label for="actual" class="btn btn-lg btn-primary btn-icon-split"
                                                    style="font-size: 15px;">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-upload"></i></span>
                                                    <span class="text text-white">Choose File</span></label> &nbsp
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6"></div>
                                <div class="col-sm-6">
                                    <button type="submit" name="update" class="btn btn-icon-split"
                                        style="background-color: #40916C; float: right;">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-save"></i>
                                        </span>
                                        <span class="text text-white">Save</span>
                                    </button>
                                </div>
                            </div>
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
    <script type="text/javascript">
        const actualBtn = document.getElementById('actual');

        const fileChosen = document.getElementById('file-chosen');

        actualBtn.addEventListener('change', function () {
            fileChosen.textContent = this.files[0].name
        })
    </script>
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