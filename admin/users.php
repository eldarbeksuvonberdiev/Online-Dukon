<?php
session_start();
$con = new PDO("mysql:host=localhost;dbname=onlinedukon", 'root', 'root');
if (empty($_SESSION['id'])) {
    header("location:../login.php");
}

$limit = 7;


$sql = "SELECT COUNT(*) as count FROM users";
$rawCount = $con->query($sql)->fetch(PDO::FETCH_ASSOC);
$countPages = ceil($rawCount['count'] / $limit);

if (isset($_GET['page'])) {
    $page = $_GET['page'];
    $pn = ($page - 1) * $limit;
} else {
    $pn = 0;
    $page = 1;
}

$sql = "SELECT * FROM users ORDER BY id DESC LIMIT {$pn},{$limit}";
$result = $con->query($sql);
$users = $result->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Users control</title>
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
            <?php
            if ($_SESSION['role'] == 'admin') { ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Category</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="users.php">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Users</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="products.php">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>All Products</span></a>
                </li>
            <?php } ?>
            <li class="nav-item">
                <a class="nav-link" href="adminProducts.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Products</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="myOrders.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>My Orders</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="orders.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Orders</span></a>
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
                        <h1 class="h3 mb-0 text-gray-800">Users</h1>
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
                <button type="button" class="btn btn-success ml-4" data-bs-toggle="modal" data-bs-target="#CreateModal">
                    Add User
                </button>

                <!-- Modal -->
                <div class="modal fade" id="CreateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="createUser.php" method="POST" enctype="multipart/form-data">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">User creation</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <label class="form-label">
                                        <h6>Name</h6>
                                    </label>
                                    <input type="text" class="form-control" name="name" placeholder="User name">
                                    <label for="corder" class="form-label mt-3">
                                        <h6>Email</h6>
                                    </label>
                                    <input type="email" class="form-control" name="email" placeholder="User email">
                                    <label for="corder" class="form-label mt-3">
                                        <h6>Password</h6>
                                    </label>
                                    <input type="text" class="form-control" name="password" placeholder="User password">
                                    <label for="cstatus" class="form-label mt-3">
                                        <h6>Status</h6>
                                    </label>
                                    <select class="form-select" name="role" aria-label="Default select example">
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
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
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Update/Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($users as $user) { ?>
                                    <tr>
                                        <td><?= $user['id'] ?></td>
                                        <td><?= $user['name'] ?></td>
                                        <td><?= $user['email'] ?></td>
                                        <td><?= $user['role'] ?></td>
                                        <td>
                                            <!-- Button view trigger modal -->
                                            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#viewModal<?= $user['id'] ?>">
                                                <i class="bi bi-eye"></i>
                                            </button>

                                            <!-- View Modal -->
                                            <div class="modal fade" id="viewModal<?= $user['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                                                        <h5 style="font-weight:700"><?= $user['name'] ?></h5>
                                                                    </label>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="editname" class="form-label">
                                                                        <h4>Order : </h4>
                                                                    </label>
                                                                    <label for="editname" class="form-label">
                                                                        <h5 style="font-weight:700"><?= $user['email'] ?></h5>
                                                                    </label>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="editname" class="form-label">
                                                                        <h4>Status : </h4>
                                                                    </label>
                                                                    <label for="editname" class="form-label">
                                                                        <h5 style="font-weight:700"><?= $user['role'] ?></h5>
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
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $user['id'] ?>">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editModal<?= $user['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="editUser.php" method="POST">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="staticBackdropLabel" style="font-weight: 700;">Edit</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                                                    <label for="editname" class="form-label">
                                                                        <h6>Name</h6>
                                                                    </label>
                                                                    <input type="text" class="form-control" id="name" name="name" value="<?= $user['name'] ?>">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="editorder" class="form-label">
                                                                        <h6>Email</h6>
                                                                    </label>
                                                                    <input type="email" class="form-control" id="order" name="email" value="<?= $user['email'] ?>">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="editorder" class="form-label">
                                                                        <h6>Role</h6>
                                                                    </label>
                                                                    <select class="form-select" name="role" aria-label="Default select example">
                                                                        <option <?= $user['role'] == 'admin' ? 'selected' : '' ?> value="admin">Admin</option>
                                                                        <option <?= $user['role'] == 'user' ? 'selected' : '' ?> value="user">User</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="editorder" class="form-label">
                                                                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                                                        <input type="hidden" name="password" value="<?= $user['password'] ?>">
                                                                        <h6>Password</h6>
                                                                    </label>
                                                                    <input type="text" class="form-control" id="newpassword" name="newpassword" placeholder="User password">
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
                                            <!-- Button delete trigger modal -->
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $user['id'] ?>">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>

                                            <!--Delete Modal -->
                                            <div class="modal fade" id="deleteModal<?= $user['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="deleteUser.php" method="POST">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="staticBackdropLabel" style="font-weight: 700;">Delete</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                                                <h4><?= $user['name'] ?> user o'chirilsinmi?</h4>
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