<?php
session_start();
require('conn.php');
if (!isset($_SESSION['user_id'])) {
    header ("Location: login.php");
}
$id = $_GET['post_id'];
if (isset($_POST['submitButton'])) {
    $id = $_GET['post_id'];
    $content = mysqli_real_escape_string($connection,$_POST['content']);
    $title = mysqli_real_escape_string($connection,$_POST['title']);
    $category = $_POST['category'];
    $catQuery = "SELECT `category_id` from `categories` WHERE `category` = '$category'";
    $result = mysqli_query($connection,$catQuery);
    $row = mysqli_fetch_array($result);
    $cat_id = $row['category_id'];
    $updateQuery = "UPDATE `posts` SET `post`= '$content', `title`= '$title', `category_id` = $cat_id WHERE `post_id`=$id";
    mysqli_query($connection,$updateQuery);
    header("Location: account.php");
}
if (isset($_POST['deletePost'])) {
  $id = $_GET['post_id'];
  $post = mysqli_real_escape_string($connection,$_POST['content']);
  $title = mysqli_real_escape_string($connection,$_POST['title']);
  $category = $_POST['category'];
    $catQuery = "SELECT `category_id` from `categories` WHERE `category` = '$category'";
    $result = mysqli_query($connection,$catQuery);
    $row = mysqli_fetch_array($result);
    $cat_id = $row['category_id'];
  $updateQuery = "UPDATE `posts` SET `post` = '$post', `public` = 0 , `title` = '$title', `category_id` = $cat_id WHERE `post_id` = $id";
  mysqli_query($connection,$updateQuery) or die ("ver bad quwerry");
  header("Location: account.php");
}
?>
    
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Blonk</title>
    <link rel="icon" href="blonk-website-favicon-black.ico">
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/blog/">
    

    <!-- Bootstrap core CSS -->
<link href="bootstrap\bootstrap-5.0.2-examples\bootstrap-5.0.2-examples\blog\blog.css" rel="stylesheet">

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
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="bootstrap-5.3.0-alpha2-dist\css\bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/main.css">

  </head>
  <body >
    
<div class="container">
  <header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-4 pt-1">
        <a class="btn btn-sm btn-outline-secondary" href="logout.php">Logout</a>
        <a class="link-secondary" href="account.php" style="padding-left: 10px">Profile</a>
        <?php
        //2 = admin?
        if ($_SESSION['level_id'] == 2) {
          echo '<a class="link-secondary" href="admin.php" style="padding-left: 10px">Admin</a>';
        }
        ?>
      </div>
      <div class="col-4 text-center">
        <a class="blog-header-logo text-dark" href="index.php">Blonk</a>
      </div>
      <div class="col-4 d-flex justify-content-end align-items-center">
        <a class="link-secondary" href="post.php" aria-label="Search">
          <img src="icons8-add-50.png"  width="30" height="30" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img">
        </a>
        <a class="btn btn-sm btn-outline-secondary" href="registration.php">Sign up</a>
      </div>
    </div>
  </header>
  <div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-between">
    <?php 
        $categorySelectQuery = "SELECT * FROM `categories`";
        $catRes = mysqli_query($connection, $categorySelectQuery) or DIE("QUERY ERROR");
        while ($cats = mysqli_fetch_array($catRes)) {
          $catid = $cats['category_id'];
          $category = $cats['category'];
          if ($category != 'Deleted') {
            echo "<a class='p-2 link-secondary' href='category.php?category_id=".$catid."'>".$category."</a>";
          }
        }   
      ?>
    </nav>
  </div>
</div>

<main class="container">


<form action="editpost.php?post_id=<?php echo $id?>" method="POST">
    <?php
    // selecting posts
      $user = $_SESSION['user_id'];

      $post_id = $_GET['post_id'];
      $postQuery = "SELECT * FROM `posts` INNER JOIN `categories` ON `posts`.`category_id`=`categories`.`category_id` INNER JOIN `users` ON `users`.`user_id`=`posts`.`user_id` WHERE `posts`.`post_id`='$post_id'";
      $postResult = mysqli_query($connection,$postQuery);
      while($row = mysqli_fetch_array($postResult)){
          $id = $row['post_id'];
          $content = $row['post'];
          $title = $row['title'];
          $date = $row['timestamp'];
          $author = $row['firstName'] . " ". $row['lastName'];
          $cat = $row['category'];
          // Creating HTML structure
          echo "<div id='post_".$id."' class='post' style='overflow: auto;>
          <article class='blog-post'>
          <div class='input-group'>
          <span class='input-group-text'>Title</span>
          <textarea name='title' class='form-control' aria-label='Title' id='border'>$title</textarea>
          </div>
          <p class='blog-post-meta'>".$date." by ".$author."</p>
          </article>
          </div>";
          $categorySelectQuery = "SELECT * FROM `categories`";
          $catRes = mysqli_query($connection, $categorySelectQuery) or DIE("QUERY ERROR");
          
      }
      ?>
          <select class="form-select" name="category" id="cat" required>
          <?php
            $categorySelectQuery = "SELECT * FROM `categories`";
            $catRes = mysqli_query($connection, $categorySelectQuery) or DIE("QUERY ERROR");
            while ($cats = mysqli_fetch_array($catRes)) {
              $category = $cats['category'];
              if ($category == $cat) {
                echo "<option selected='selected' value='".$category."'>".$category."</option>";
              } else {
                if ($category != 'Deleted') {
                  echo "<option value='".$category."'>".$category."</option>";
                }
              }
            }
          ?>
          </select>
          <br>
      <textarea name='content' id='editor'><?php echo $content ?></textarea>
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
    <input name='submitButton'type="submit" value='Edit Post!' class="btn btn-primary"></input>
    <input name='deletePost'type="submit" value='Delete Post' class="btn btn-danger"></input>
        </form>
    </body>
</html>