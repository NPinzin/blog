<?php
session_start();
require('conn.php');
$id = $_GET['comment_id'];

if (isset($_POST['submitButton'])) {
    $id = $_GET['comment_id'];
    $comment = $_POST['comment'];
    $updateQuery = "UPDATE `comments` SET `comment` = '$comment' WHERE `comment_id` = $id";
    mysqli_query($connection,$updateQuery) or die ("ver bad quwerry");
    header("Location: admincomments.php");
    exit();
}
if (isset($_POST['deleteComment'])) {
    $id = $_GET['comment_id'];
    $comment = $_POST['comment'];
    $updateQuery = "UPDATE `comments` SET `comment` = '$comment', `public` = 0 WHERE `comment_id` = $id";
    mysqli_query($connection,$updateQuery) or die ("ver bad quwerry");
    header("Location: admincomments.php");
    exit();
}
if (isset($_POST['undeleteComment'])) {
  $id = $_GET['comment_id'];
  $comment = $_POST['comment'];
  $updateQuery = "UPDATE `comments` SET `comment` = '$comment', `public` = 1 WHERE `comments`.`comment_id` = $id";
  mysqli_query($connection,$updateQuery) or die ("ver bad quwerry");
  header("Location: admincomments.php");
  exit();
}
if (isset($_POST['search'])) {
    $search = mysqli_real_escape_string($connection,$_POST['search']);
    $searchQuery = "SELECT * FROM `comments` WHERE `comment` LIKE '%$search%'";
    $result = mysqli_query($connection, $searchQuery) or DIE("QUERY ERROR");
    $row = mysqli_fetch_array($result);
    $_POST['search'] = null;
    if (isset($row['comment_id'])) {
      $id = $row['comment_id'];
      header("Location: editcomments.php?comment_id=$id");
    } else {
      echo("<script>alert('No Search Results')</script>");
      echo("<script>window.location = 'admincomments.php';</script>");
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
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
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
  <form action="editcomments.php" method="post"  role="form" class="form-control form-control-dark w-100">
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
      <h2>Post</h2>

      
      <form action="editcomments.php?comment_id=<?php echo $id ?>" method="POST">
            <?php
                    $id = $_GET['comment_id'];
                    $query = "SELECT `comments`.`comment`,`comments`.`user_id`,`posts`.`title`,`users`.`username`,`comments`.`public` FROM `comments` INNER JOIN `posts` ON `posts`.`post_id`=`comments`.`post_id` INNER JOIN `users` ON `users`.`user_id`=`comments`.`user_id` WHERE `comment_id` = $id";
        
                    $com = mysqli_query($connection,$query) or die("bad conn");
                    while ($row = mysqli_fetch_array($com)) {
                    $authId = $row['user_id'];
                    $title = $row['title'];
                    $username = $row['username'];
                    $comment = $row['comment'];
                    $public = $row['public'];
                    
                    }
                echo '<div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Title</span>
                <input type="text" class="form-control" placeholder="Username" aria-label="Username" name="title" value= "'.$title.'" aria-describedby="basic-addon1" disabled>
              </div>
              
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon2" name="username" value= "'.$username.'" disabled>
                <span class="input-group-text" id="basic-addon2">User</span>
              </div>
              <div class="row g-2">
              <div class="col-md">
              Public:
              <input type="text" class="form-control" value="'.($public ? "Public" : "Private") . '" style="width: min-content" disabled>
              </div> 
              <div class="col-md">
              Author Id:
              <input type="text" class="form-control" id="floatingInputValue" value="'.$authId. '" style="width: min-content;" disabled>
               </div>
              </div>
              
              <br>
              <textarea name="comment" id="editor">' . $comment  . '</textarea>';
                ?>
                <input type="submit" name="submitButton" value="Submit" class="btn btn-success">
                <?php
                if ($public) {
                  echo '<input type="submit" name="deleteComment" value="Delete" class="btn btn-danger">';
                } else {
                  echo '<input type="submit" name="undeleteComment" value="Restore" class="btn btn-primary">';
                }
                
                ?>
            </form>
            <script>
            ClassicEditor
                    .create( document.querySelector( '#editor' ) )
                    .then( editor => {
                            console.log( editor );
                    } )
                    .catch( error => {
                            console.error( error );
                    } );
    
    
        </script>
          <br>
      </div>
    </main>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

    <script src="blog\bootstrap-5.3.0-alpha2-dist\js\bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="bootstrap\bootstrap-5.0.2-examples\bootstrap-5.0.2-examples\dashboard\dashboard.js"></script>
  </body>
</html>
