<?php
// session_start();
require_once "./classes/User.php";
require_once "./classes/addtocart.php";
$cart = new cart();
$name = "";
$role = "";
$id = "";
if (isset($_SESSION['admin'])) {
  $name = $_SESSION['admin'][0]['name'];
  $role = $_SESSION['admin'][0]['role'];
  $id = $_SESSION['admin'][0]['id'];
  $userid = $_SESSION['admin'][0]['password'];
}
$myobj = new User();
// echo "<pre>";
// print_r($_SESSION['admin'][0]['name']);
// echo "</pre>";
// foreach($_SESSION['admin'] as $key=>$val){
//   if($key=='name')
//   {
//       $name= $val['name'];
//   }
// }
// $myobj->feachDetails($role, $id, 0);


//
// echo $len;

// // // for($i=0;$i<count($_SESSION['user']);$i++){
// // //   for($j=0;$j<count($_SESSION['user']);$j++){
// // //     echo $_SESSION['user'][$j];

// // //   }
// // // }
// echo $len;
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.88.1">
  <title>Dashboard Template · Bootstrap v5.1</title>
  <link rel="stylesheet" href=".//.//assets/css/dashboard.css">
  <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="./assets/js/script.js"></script>


  <!-- Bootstrap core CSS -->
  <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">


  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="./assets/css/dashboard.css" rel="stylesheet">
</head>

<body>

  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Hello <?php echo $name ?></a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <div class="navbar-nav">
      <div class="nav-item text-nowrap">
        <a class="nav-link px-3" href="login.php">Sign out <?php echo $name ?></a>
      </div>
    </div>
  </header>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="./dashboard.php">
                <span data-feather="home"></span>
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="
              <?php
              if ($role == 'user') {
                echo "#";
              } else {
                echo "./orders.php";
              }

              ?>
              ">
                <span data-feather="file"></span>
                Orders
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php
                                        if ($role == 'admin') {
                                          echo "products.php";
                                        } else {
                                          echo "#";
                                        }
                                        ?>">
                <span data-feather="shopping-cart"></span>
                Products
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="users"></span>
                Customers
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="bar-chart-2"></span>
                Reports
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="layers"></span>
                Integrations
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2"><?php echo $role ?> Dashboard</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
              <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
              <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
              <span data-feather="calendar"></span>
              This week
            </button>
          </div>
        </div>

        <h2>User Deatils</h2>
        <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead>

              <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Password</th>
                <th scope="col">Role</th>
                <th scope="col">Status</th>
                <th scope="col">Status/Approved</th>
                <th scope="col">Delete User</th>


              </tr>

            </thead>
            <tbody id='ll'>
              <?php echo $myobj->feachDetails($role, $id) ?>
            </tbody>

            <hr>
            <tfooter>
              <td><button class="btn btn-success"><a href="../register.php" style="text-decoration:none; color:black">add user</a></button></td>
            </tfooter>
          </table>
          <div class="col-12 d-flex justify-content-center">
            <nav aria-label="Page navigation example" class="">
              <ul class="pagination">
                <li class="page-item">
                  <p class="page-link" id="pageclickuser">Previous</p>
                </li>
                <li class="page-item">
                  <p class="page-link" id="pageclickuser">1</p>
                </li>
                <li class="page-item">
                  <p class="page-link" id="pageclickuser">2</p>
                </li>
                <li class="page-item">
                  <p class="page-link" id="pageclickuser">3</p>
                </li>
                <li class="page-item">
                  <p class="page-link" id="pageclickuser">Next</p>
                </li>
              </ul>
            </nav>
          </div>
        </div>

        <h2><?php
            if ($role == 'admin') {
              echo "Product Details";
            } else {
              echo "Order Details";
            } ?></h2>
        <div class="table-responsive">
          <table class="table table-striped table-sm">


            <?php
            if ($role == 'admin') {
              $myobj->fatchProductDashboard();
            } else {
              $cart->searchOrder($userid);
            } ?>

            <hr>
            <tfooter>
              <td><button class="btn btn-success"><a href="./products.php" style="text-decoration:none; color:black">Update Product</a></button></td>
            </tfooter>
          </table>
        </div>
      </main>
    </div>
  </div>


  <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>