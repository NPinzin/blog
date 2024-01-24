
<?php
session_start();
require('conn.php');
$levels = ['Active','Banned','Admin'];
if (!isset($_POST['submitButton'])) {
    $id = $_GET['user_id'];
    $query = "SELECT * FROM `users` WHERE `user_id` = $id";
    $usersResult = mysqli_query($connection,$query) or die("bad conn");
}


if (isset($_POST['submitButton'])) {
    $id = $_GET['user_id'];
    $username = mysqli_real_escape_string($connection,$_POST['username']);
    $email = mysqli_real_escape_string($connection,$_POST['email']);
    $level_id = array_keys($levels,$_POST['level'])[0];
    $updateQuery = "UPDATE `users` SET `username` = '$username', `email` = '$email', `level_id`= $level_id WHERE `users`.`user_id` = $id";
    mysqli_query($connection,$updateQuery) or die ("ver bad quwerry");
    header("Location: admin.php");
    exit();
}
if (isset($_POST['deleteUser'])) {
    $id = $_GET['user_id'];
    $username = mysqli_real_escape_string($connection,$_POST['username']);
    $email = mysqli_real_escape_string($connection,$_POST['email']);
    $updateQuery = "UPDATE `users` SET `username` = '$username', `email` = '$email' ,`level_id` = 1 WHERE `users`.`user_id` = $id";
    mysqli_query($connection,$updateQuery) or die ("ver bad quwerry");
    $postUpdateQuery = "UPDATE `posts` SET `public` = 0 WHERE `posts`.`user_id`=$id";
    mysqli_query($connection,$postUpdateQuery) or die ("ver bad quwerry");
    $commentUpdateQuery = "UPDATE `comments` SET `public` = 0 WHERE `comments`.`user_id`=$id";
    mysqli_query($connection,$commentUpdateQuery) or die ("ver bad quwerry");
    header("Location: admin.php");
    exit();
}
if (isset($_POST['undeleteUser'])) {
  $id = $_GET['user_id'];
  $username = mysqli_real_escape_string($connection,$_POST['username']);
  $email = mysqli_real_escape_string($connection,$_POST['email']);
  $updateQuery = "UPDATE `users` SET `username` = '$username', `email` = '$email' ,`level_id` = 0 WHERE `users`.`user_id` = $id";
  mysqli_query($connection,$updateQuery) or die ("ver bad quwerry");
  header("Location: admin.php");
  exit();
}
if (isset($_POST['search'])) {
    $search = mysqli_real_escape_string($connection,$_POST['search']);
    $searchQuery = "SELECT * FROM `users` WHERE `username` LIKE '%$search%' OR `firstName` LIKE '%$search%' OR `lastName` LIKE '%$search%'";
    $result = mysqli_query($connection, $searchQuery) or DIE("QUERY ERROR");
    $row = mysqli_fetch_array($result);
    $_POST['search'] = null;
    if (isset($row['user_id'])) {
      $id = $row['user_id'];
      header("Location: edit.php?user_id=$id");
    } else {
      echo("<script>alert('No Search Results')</script>");
      echo("<script>window.location = 'edit.php';</script>");
    }
    
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
      <!-- Information pertaining to this specific user -->
      <h2>User</h2>
      
          <form action="edit.php?user_id=<?php echo $id ?>" method="POST">
                <?php
                    while ($row = mysqli_fetch_array($usersResult)) {
                        $username=$row['username'];
                        $email = $row['email'];
                        $password=$row['password'];
                        $level = $row['level_id'];
                        echo '<div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">@</span>
                        <input type="text" class="form-control" placeholder="Username" aria-label="Username" name="username" value= "'.$username.'" aria-describedby="basic-addon1">
                      </div>
                      
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon2" name="email" value= "'.$email.'">
                        <span class="input-group-text" id="basic-addon2">@example.com</span>
                      </div>';
                      echo '
                      <div class="col-md">
                      Role:
                      <select class="form-select" name="level" id="cat" required>';
                      
                      foreach ($levels as $key => $role) {
                        if ($key == $level) {
                          echo "<option selected='selected' value='".$role."'>".$role."</option>";
                        } else {
                          echo "<option value='".$role."'>".$role."</option>";
                        }
                      }
                      echo '</select><br>
                      <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">$</span>
                        <input type="text" class="form-control" placeholder="Username" aria-label="Username" name="password" value= "'.$password.'" aria-describedby="basic-addon1" disabled>
                      </div>';
                    }
                ?>
                <br>
                <input type="submit" name="submitButton" value="Submit" class="btn btn-success">
                <?php
                if ($level == 0) {
                  echo '<input type="submit" name="deleteUser" value="Delete" class="btn btn-danger">';
                } elseif ($level == 1) {
                  echo '<input type="submit" name="undeleteUser" value="Restore" class="btn btn-primary">';
                }
                
                ?>
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
