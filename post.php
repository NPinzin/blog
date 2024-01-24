<?php
session_start();
require('conn.php');
if (!isset($_SESSION['user_id'])) {
    echo "<script type='text/javascript'>alert('Please login before posting content');</script>";
    header("login.php");
}
if(isset($_POST['submitButton'])) {
    if (empty($_POST['content'])) {
        echo "<script type='text/javascript'>alert('Please Enter a Post');</script>";
      } else {
        $post = mysqli_real_escape_string($connection,$_POST['content']);
        $user_id = $_SESSION['user_id'];
        $title = mysqli_real_escape_string($connection,$_POST['title']);
        $category = $_POST['category'];
        $catQuery = "SELECT `category_id` from `categories` WHERE `category` = '$category'";
        $result = mysqli_query($connection,$catQuery);
        $row = mysqli_fetch_array($result);
        $cat_id = $row['category_id'];
        $query = "INSERT INTO `posts` (`post_id`, `user_id`, `title`,`post`, `category_id`, `public`) VALUES (NULL, $user_id, '$title', '$post',$cat_id, 1)";
        mysqli_query($connection,$query) or die ("ver bad quwerry");
        header('Location: index.php');
    }

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
    <div class="d-flex justify-content-between">
     <div>
      <form action="post.php" method="post">
      <div class="input-group mb-3">

        <input type="text" class="form-control" placeholder="Title" aria-label="Username" aria-describedby="basic-addon1" name="title" required>
      </div>
     </div>
     <div class="text-end">
      <select class="form-select" name="category" id="cat" required>
      <option value="" disabled selected>Choose a Category</option>
      <?php 
        $categorySelectQuery = "SELECT * FROM `categories`";
        $catRes = mysqli_query($connection, $categorySelectQuery) or DIE("QUERY ERROR");
        while ($cats = mysqli_fetch_array($catRes)) {
          $category = $cats['category'];
          if ($category != "Deleted") {
            echo "<option value='".$category."'>".$category."</option>";
          }

        }  
      ?>
      </select>
    </div>
      </div>


  <div class= "container align-items-center justify-content-center">
  <textarea name="content" id="editor" placeholder="Write your post here!">
  </textarea>
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
<input type="submit" name=submitButton value="Post!" class="btn btn-primary">
</form>
</div>
</main>
</body>
</html>