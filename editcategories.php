
<?php
session_start();
require('conn.php');
if (empty($_POST['submitButton'])) {
    $id = $_GET['category_id'];
    $query = "SELECT * FROM `categories` WHERE `category_id` = $id";
    $catQuery = mysqli_query($connection,$query) or die("bad conn");
}
if (isset($_POST['submitButton'])) {
    $id = $_GET['category_id'];
    $category = $_POST['category'];
    $updateQuery = "UPDATE `categories` SET `category` = '$category' WHERE `category_id` = $id";
    mysqli_query($connection,$updateQuery) or die ("ver bad quwerry");
    header("Location: admincategories.php");
    exit();
}
if (isset($_POST['deleteCategory'])) {
  $id = $_GET['category_id'];
  $category = $_POST['category'];
  $postUpdateQuery = "UPDATE `posts` SET `category_id` = 0 WHERE `posts`.`category_id`=$id";
  mysqli_query($connection,$postUpdateQuery) or die ("ver bad quwerry");
  $updateQuery = "DELETE FROM `categories` WHERE `categories`.`category_id` = $id";
  mysqli_query($connection,$updateQuery) or die ("ver bad quwerry");

  header("Location: admin.php");
  exit();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

    <title>Blonkmin</title>
    <link rel="icon" href="blonk-website-favicon-black.ico">

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
      
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>

    <!-- Bootstrap core CSS -->
<link href="bootstrap-5.3.0-alpha2-dist\css\bootstrap.min.css" rel="stylesheet">

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
    <link href="bootstrap\bootstrap-5.0.2-examples\bootstrap-5.0.2-examples\dashboard\dashboard.css" rel="stylesheet">
  </head>
  <body>
    
<header  class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="index.php">Blonk</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <form action="edit.php" method="post"  role="form" class="form-control form-control-dark w-100">
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" name="search" aria-label="Search" >
  </form>
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="logout.php">Sign out</a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item" style="padding-top: 20px;">
            <a class="nav-link active" aria-current="page" href="admin.php">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="adminposts.php">
              <span data-feather="file"></span>
              Posts
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="admincomments.php">
              <span data-feather="shopping-cart"></span>
              Comments
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="admincategories.php">
              <span data-feather="users"></span>
              Categories
            </a>
          </li>
          
        </ul>

      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

      </div>
      <h2>User</h2>
      
      <form action="editcategories.php?category_id=<?php echo $id ?>" method="POST">
            <?php
                while ($row = mysqli_fetch_array($catQuery)) {
                    $id = $row['category_id'];
                    $category = $row['category'];
                }
                echo '<div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">*</span>
                        <input type="text" class="form-control" placeholder="Category" aria-label="Username" name="category" value= "'.$category.'" aria-describedby="basic-addon1" required>
                        <input type="submit" name="submitButton" value="Submit" class="btn btn-success">
                      </div>'
                ?>
                <input type="submit" value="Delete Category" name="deleteCategory" class="btn btn-danger">
            </form>
          <br>
      </div>
    </main>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
    <script src="blog\bootstrap-5.3.0-alpha2-dist\js\bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="bootstrap\bootstrap-5.0.2-examples\bootstrap-5.0.2-examples\dashboard\dashboard.js"></script>
  </body>
</html>
