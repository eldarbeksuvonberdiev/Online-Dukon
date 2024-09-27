<?php
session_start();
$con = new PDO("mysql:host=localhost;dbname=onlinedukon", 'root', 'root');
if (empty($_SESSION['id'])) {
    header("location:../login.php");
}

$limit = 4;

$sql = "SELECT id,name FROM categories";
$result = $con->query($sql);
$categories = $result->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT COUNT(*) as count FROM products";
$rawCount = $con->query($sql)->fetch(PDO::FETCH_ASSOC);
$countPages = ceil($rawCount['count'] / $limit);

if (isset($_GET['page'])) {
    $page = $_GET['page'];
    $pn = ($page - 1) * $limit;
} else {
    $pn = 0;
    $page = 1;
}

$sql = "SELECT products.*,categories.name AS category, users.name AS user,users.id AS user_id 
FROM products LEFT JOIN categories ON products.category_id = categories.id 
LEFT JOIN users ON products.user_id = users.id ORDER BY id DESC LIMIT {$pn},{$limit}";
$result = $con->query($sql);
$products = $result->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Products control</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-secondary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Adminface</div>
            </a>
            <!-- Heading -->
            <div class="sidebar-heading">
                Adminface
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Category</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="products.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>All Products</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="adminProducts.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>My Products</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="users.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Users</span></a>
            </li>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column" style="background-color: #d7d7e0;">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand topbar mb-4 static-top shadow" style="background-color: #59595c;">
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600">
                                    <h5 style="font-weight:700"><?= $_SESSION['name'] ?></h5>
                                </span>
                                <img class="img-profile rounded-circle"
                                    src="../assets/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" style="color: greenyellow;">
                                    <i class="fas fa-user fa-sm fa-fw mr-1 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../logout.php" style="color: red;">
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
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h1 class="h3 mb-0 text-gray-800">Products</h1>
                    </div>
                    <hr>
                </div>
                <div class="container">
                <div class="row">
                    <?php
                    if (isset($_SESSION['alert']) && isset($_SESSION['text'])) { ?>
                        <div class="alert alert-<?= $_SESSION['alert'] ?> alert-dismissible fade show" role="alert">
                            <strong><?= $_SESSION['text'] ?></strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                        unset($_SESSION['alert']);
                        unset($_SESSION['text']);
                    } ?>
                </div>
                </div>
                <!-- Button trigger modal -->
                <!-- <button type="button" class="btn btn-success ml-4" data-bs-toggle="modal" data-bs-target="#AddproductModal">
                    Add Product
                </button> -->

                <!-- Modal -->
                <div class="modal fade" id="AddproductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="createProduct.php" method="POST" enctype="multipart/form-data">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Product creation</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <label for="cname" class="form-label">
                                        <h6>Name</h6>
                                    </label>
                                    <input type="text" class="form-control" name="name" placeholder="Product name">
                                    <label for="corder" class="form-label mt-3">
                                        <h6>Price</h6>
                                    </label>
                                    <input type="number" class="form-control" name="price" placeholder="Product price">
                                    <label for="corder" class="form-label mt-3">
                                        <h6>Image :</h6>
                                    </label>
                                    <input type="file" name="img" id=""><br>
                                    <label for="corder" class="form-label mt-3">
                                        <h6>Count</h6>
                                    </label>
                                    <input type="number" class="form-control" name="count" placeholder="Product count">
                                    <label for="corder" class="form-label mt-3">
                                        <h6>Premium or not</h6>
                                    </label>
                                    <select class="form-select" name="premium" aria-label="Default select example">
                                        <option selected value="1">Premium</option>
                                        <option value="0">Not Premium</option>
                                    </select>
                                    <label for="cstatus" class="form-label mt-3">
                                        <h6>Category</h6>
                                    </label>
                                    <select class="form-select" name="category" aria-label="Default select example">
                                        <?php
                                        foreach ($categories as $category) { ?>
                                            <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button name="add" type="submit" class="btn btn-success">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <table class="table table-secondary table-striped table-bordered mt-3" id="dataTable" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th>Count</th>
                                    <th>Premium</th>
                                    <th>Category</th>
                                    <th>Created user</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($products as $product) { ?>
                                    <tr>
                                        <td><?= $product['id'] ?></td>
                                        <td><?= $product['name'] ?></td>
                                        <td><?= $product['price'] ?></td>
                                        <td><img src="<?= $product['img'] ?>" width="150px" alt="" style="border-radius: 5px;"></td>
                                        <td><?= $product['count'] ?></td>
                                        <td><?= $product['premium'] ?></td>
                                        <td><?= $product['category'] ?></td>
                                        <td><?= $product['user'] ?></td>
                                        <td>
                                            <!-- Button view trigger modal -->
                                            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#viewModal<?= $product['id'] ?>">
                                                <i class="bi bi-eye"></i>
                                            </button>

                                            <!-- View Modal -->
                                            <div class="modal fade" id="viewModal<?= $product['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="editCategory.php" method="POST">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="staticBackdropLabel" style="font-weight:700">View information</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="editname" class="form-label">
                                                                        <h4>Nomi : </h4>
                                                                    </label>
                                                                    <label for="editname" class="form-label">
                                                                        <h5 style="font-weight:700"><?= $product['name'] ?></h5>
                                                                    </label>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="editname" class="form-label">
                                                                        <h4>Order : </h4>
                                                                    </label>
                                                                    <label for="editname" class="form-label">
                                                                        <h5 style="font-weight:700"><?= $product['price'] ?></h5>
                                                                    </label>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="editname" class="form-label">
                                                                        <h4>Image : </h4>
                                                                    </label>
                                                                    <img src="<?= $product['img'] ?>" alt="" width="150px">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="editname" class="form-label">
                                                                        <h4>Count : </h4>
                                                                    </label>
                                                                    <label for="editname" class="form-label">
                                                                        <h5 style="font-weight:700"><?= $product['count'] ?></h5>
                                                                    </label>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="editname" class="form-label">
                                                                        <h4>Premium or not : </h4>
                                                                    </label>
                                                                    <label for="editname" class="form-label">
                                                                        <h5 style="font-weight:700"><?= $product['premium'] ?></h5>
                                                                    </label>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="editname" class="form-label">
                                                                        <h4>Category : </h4>
                                                                    </label>
                                                                    <label for="editname" class="form-label">
                                                                        <h5 style="font-weight:700"><?= $product['category'] ?></h5>
                                                                    </label>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="editname" class="form-label">
                                                                        <h4>Created User : </h4>
                                                                    </label>
                                                                    <label for="editname" class="form-label">
                                                                        <h5 style="font-weight:700"><?= $product['user'] ?></h5>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                            <!--Button edit trigger Modal -->
                                            <?php
 //                                           if ($_SESSION['id'] == $product['user_id']) { ?>
                                                <!-- <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $product['id'] ?>">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </button> -->

                                                <!-- Edit Modal -->
                                                <div class="modal fade" id="editModal<?= $product['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <form action="editProduct.php" method="POST">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel" style="font-weight: 700;">Edit</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                                                        <label for="editname" class="form-label">
                                                                            <h6>Name</h6>
                                                                        </label>
                                                                        <input type="text" class="form-control" id="editname" name="editname" value="<?= $product['name'] ?>">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="editorder" class="form-label">
                                                                            <h6>Price</h6>
                                                                        </label>
                                                                        <input type="text" class="form-control" id="editorder" name="edittr" value="<?= $product['price'] ?>">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="editorder" class="form-label">
                                                                            <h6>Image</h6>
                                                                        </label>
                                                                        <input type="file" class="form-control" id="editorder" name="edittr">
                                                                        <img src="<?= $product['img'] ?>" alt="" style="width: 150px;">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="editorder" class="form-label">
                                                                            <h6>Count</h6>
                                                                        </label>
                                                                        <input type="text" class="form-control" id="editorder" name="edittr" value="<?= $product['count'] ?>">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="editorder" class="form-label">
                                                                            <h6>Premium or not</h6>
                                                                        </label>
                                                                        <select class="form-select" name="editstatus" aria-label="Default select example">
                                                                            <option <?= $product['premium'] == "1" ? "selected" : "" ?>>premium</option>
                                                                            <option <?= $product['premium'] == "0" ? "selected" : "" ?>>not premium</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="editorder" class="form-label">
                                                                            <h6>Category</h6>
                                                                        </label>
                                                                        <input type="text" class="form-control" id="editorder" name="edittr" value="<?= $product['category'] ?>">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="editorder" class="form-label">
                                                                            <h6>Created user</h6>
                                                                        </label>
                                                                        <input type="text" class="form-control" id="editorder" name="edittr" value="<?= $product['user'] ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" name="edit" class="btn btn-success">Change</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            <?php //}
                                            ?>

                                            <!-- Button delete trigger modal -->
                                            <!-- <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $product['id'] ?>">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>

                                            Delete Modal -->
                                            <div class="modal fade" id="deleteModal<?= $product['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="deleteProduct.php" method="POST">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="staticBackdropLabel" style="font-weight: 700;">Delete</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                                                <h4><?= $product['name'] ?> mahsuloti o'chirilsinmi?</h4>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" name="delete" class="btn btn-success">Delete</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    <?php }
                                    ?>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-start ml-4">
                        <li class="page-item">
                            <a class="page-link <?= ($page == 1) ? "disabled" : "" ?>" href="<?php if ($page > 1) echo "?page=" . ($page - 1) ?>">Previous</a>
                        </li>
                        <?php
                        for ($i = 1; $i <= $countPages; $i++) { ?>
                            <li class="page-item"><a class="page-link <?= ($page == $i) ? "active" : "" ?>" href="?page=<?= $i ?>"><?= $i ?></a></li>
                        <?php }
                        ?>
                        <li class="page-item">
                            <a class="page-link <?= ($page == $countPages) ? "disabled" : "" ?>" href="<?php if ($page < $countPages) echo "?page=" . ($page + 1) ?>">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- /.container-fluid -->

        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../assets/js/demo/chart-area-demo.js"></script>
    <script src="../assets/js/demo/chart-pie-demo.js"></script>

</body>

</html>