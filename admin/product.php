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

    <title>Product</title>

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
                        <h1 class="h3 mb-0 text-gray-800">Products</h1>
                        <div class="d-flex">
                            <div class="p-2">
                                <a href="export_batch.php" class="btn btn-primary btn-lg btn-icon-split"
                                    data-toggle="tooltip" data-placement="bottom" title="Download Template"
                                    style="font-size: 15px;">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-download"></i>
                                    </span>
                                    <span class="text">Download All Rows</span>
                                </a>
                            </div>
                            <div class="p-2">
                                <a href="javascript:void(0);" onclick="downloadSelected()"
                                    class="btn btn-primary btn-lg btn-icon-split" data-toggle="tooltip"
                                    data-placement="bottom" title="Download Selected" style="font-size: 15px;">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-download"></i>
                                    </span>
                                    <span class="text">Download Selected</span>
                                </a>

                            </div>
                            <div class="p-2">
                                <button class="btn btn-danger btn-icon-split mr-1" data-toggle="modal"
                                    data-target="#deleteModal">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-trash"></i>
                                    </span>

                                    <span class="text text-white">Delete Table</span>
                                </button>


                            </div>
                            <div class="p-2">
                                <a href="addproduct.php" class="btn btn-icon-split"
                                    style="background-color: #40916C; float: right;">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-plus-square"></i>
                                    </span>
                                    <span class="text text-white">Add Product</span>
                                </a>
                            </div>
                            <div class="p-2">
                                <button class="btn btn-icon-split mr-1" style="background-color: #40916C; float: right;"
                                    data-toggle="modal" data-target="#importModal">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-plus-square"></i>
                                    </span>
                                    <span class="text text-white">Batch Import</span>
                                </button>
                            </div>
                        </div>

                    </div>

                    <!-- Delete Table Modal -->
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                        aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Delete Products Table</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete all data in the Products table? This action
                                        cannot be undone.</p>
                                </div>
                                <div class="modal-footer">
                                    <form action="delete_table.php" method="post">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php if (isset($_GET['success'])) { ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <?php echo $_GET['success']; ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php } else if (isset($_GET['error'])) { ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <?php echo $_GET['error']; ?>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                <?php } ?>
                                <form method="POST" action="delete_products.php">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <button class="btn btn-danger delete-selected-btn" type="submit"
                                                name="deleted">
                                                Delete Selected
                                            </button>
                                        </div>
                                        <div class="col-sm-6 d-flex justify-content-end">
                                            <a href="javascript:void(0);" onclick="downloadSelected()"
                                                class="btn btn-primary btn-lg btn-icon-split mr-2" data-toggle="tooltip"
                                                data-placement="bottom" title="Download Selected"
                                                style="font-size: 15px;">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-download"></i>
                                                </span>
                                                <span class="text">Download Selected</span>
                                            </a>
                                        </div>
                                    </div>
                                    <table class="table table-bordered table-striped" id="dataTable" width="100%"
                                        cellspacing="0" style="font-size: 12px">
                                        <thead style="text-align: center;">
                                            <tr>
                                                <th>Select</th>
                                                <th>Barcodes</th>
                                                <th>Stock No.</th>
                                                <th>Name</th>
                                                <th>Cost</th>
                                                <th>Retail Price</th>
                                                <th>Quantity</th>
                                                <th>Tags</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $stmt = $conn->query("SELECT * FROM products");
                                            while ($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                if (!empty($res["stock_No"]) && $res["deleted_at"] == null) {
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
                                                            <?php echo (int) $res["stock_No"]; ?>
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
                                                        <td style="display: flex">
                                                            <a href="editproduct.php?prodid=<?php echo $res["id"]; ?>"
                                                                class="btn btn-info viewbtn mr-1">
                                                                <i class='fas fa-edit'></i>
                                                            </a>
                                                        </td>
                                                    </tr>

                                                <?php }
                                            } ?>
                                        </tbody>
                                        <?php
                                        $stmt = $conn->query("SELECT * FROM products");
                                        while ($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            ?>

                                        <?php } ?>

                                    </table>
                                </form>
                            </div>
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
                    Please choose a file to import.
                    <form class="mt-3" action="" method="post" enctype="multipart/form-data"
                        style="display: flex; justify-content: space-between;">
                        <input type="file" name="excel" required value="">
                        <button type="submit" name="import">Import</button>
                    </form>

                    <?php
                    if (isset($_POST["import"])) {
                        $fileName = $_FILES["excel"]["name"];
                        $fileExtension = explode('.', $fileName);
                        $fileExtension = strtolower(end($fileExtension));
                        $newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;

                        $targetDirectory = "uploads/" . $newFileName;
                        move_uploaded_file($_FILES['excel']['tmp_name'], $targetDirectory);

                        error_reporting(0);
                        ini_set('display_errors', 0);

                        require 'excelReader/excel_reader2.php';
                        require 'excelReader/SpreadsheetReader.php';

                        $reader = new SpreadsheetReader($targetDirectory);
                        foreach ($reader as $key => $row) {
                            $Stock_No = $row[0];
                            $Name = $row[1];
                            $Cost = $row[2];
                            $Retail_Price = $row[3];
                            $Quantity = $row[4];
                            $Barcodes = $row[5];
                            $Tags = $row[6];
                            $Taxes = $row[7];
                            $Taxes_Exempt = $row[8];
                            $Description = $row[9];
                            $Enable_Decimal = $row[10];
                            $Enable_Open_Price = $row[11];
                            $Disable_Discount = $row[12];
                            $Disable_Inventory = $row[13];
                            $Supplier_Name = $row[14];
                            $Supplier_List = $row[15];
                            $Category_Name = $row[16];
                            $SubCategory = $row[17];
                            $Status = $row[18];

                            $stmt = $conn->prepare("SELECT * FROM products WHERE stock_No = ?");
                            $stmt->execute([$Stock_No]);
                            $existingProduct = $stmt->fetch(PDO::FETCH_ASSOC);

                            if ($existingProduct) {
                                // Product already exists, update details
                                $stmt = $conn->prepare("UPDATE products SET name = ?, cost = ?, retail_price = ?, quantity = ?, barcodes = ?, taxes = ?, tax_exempt = ?, description = ?, enable_decimal = ?, enable_open_price = ?, disable_discount = ?, disable_inventory = ?, supplier_name = ?, supplier_list = ?, category_name = ?, subcategory = ?, status = ? WHERE stock_No = ?");
                                $stmt->execute([$Name, $Cost, $Retail_Price, $Quantity, $Barcodes, $Taxes, $Taxes_Exempt, $Description, $Enable_Decimal, $Enable_Open_Price, $Disable_Discount, $Disable_Inventory, $Supplier_Name, $Supplier_List, $Category_Name, $SubCategory, $Status, $Stock_No]);
                            } else {
                                // Product does not exist, insert new record
                                $stmt = $conn->prepare("INSERT INTO products (id, stock_No, name, cost, retail_price, quantity, barcodes, tags, taxes, tax_exempt, description, enable_decimal, enable_open_price, disable_discount, disable_inventory, supplier_name, supplier_list, category_name, subcategory, status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                                $stmt->execute(["", $Stock_No, $Name, $Cost, $Retail_Price, $Quantity, $Barcodes, $Tags, $Taxes, $Taxes_Exempt, $Description, $Enable_Decimal, $Enable_Open_Price, $Disable_Discount, $Disable_Inventory, $Supplier_Name, $Supplier_List, $Category_Name, $SubCategory, $Status]);
                            }
                        }

                        $descs = $user['fname'] . " performed a batch import of products";
                        $log = $conn->prepare("INSERT INTO activity_log (description, date) VALUES (?, now() )");
                        $log->execute([$descs]);

                        mysqli_close($connection);
                        //$del = $conn->query("DELETE FROM products LIMIT 1");
                    
                        echo
                            "
        <script>
        document.location.href = '';
        </script>

        ";


                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript">
        function downloadSelected() {
            // Get the selected product IDs
            var selectedIDs = $('input[name="prodid[]"]:checked').map(function () {
                return $(this).val();
            }).get();

            // Create a form to submit the selected product IDs
            var form = $('<form>', {
                'action': 'download_selected.php',
                'method': 'POST'
            }).append($('<input>', {
                'name': 'selected_ids',
                'value': selectedIDs.join(',')
            }));

            // Submit the form
            $('body').append(form);
            form.submit();
        }

    </script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function () {
            $(".deletebtn").click(function () {
                var id = $(this).data("id");
                if (confirm("Are you sure you want to delete this product?")) {
                    $.ajax({
                        url: "delete_product.php",
                        type: "POST",
                        data: { id: id },
                        success: function () {
                            window.location.reload();
                        }
                    });
                }
            });
        });
    </script>


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