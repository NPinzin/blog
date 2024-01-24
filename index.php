<?php
session_start();
require ('conn.php');
require("simple_html_dom.php");

if (!isset($_SESSION['user_id'])) {
    header ("Location: login.php");
}
$user_id = $_SESSION['user_id'];
$query = "SELECT * from `users` WHERE `user_id` = $user_id";
$result = mysqli_query($connection, $query) or DIE("QUERY ERROR");
$rows = mysqli_fetch_array($result);
$username = $rows['username'];


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Blonk</title>
    <link rel="icon" href="blonk-website-favicon-black.ico">

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
        if ($rows['level_id'] == 2) {
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
  <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark" id="header">
    <div class="col-md-6 px-0">
      <h1 class="display-4 fst-italic">About Blonk</h1>
      <p class="lead my-3">Learn more about our mission statement to end the free press and supress media content across the globe, in our fight againt literacy.</p>
      <p class="lead mb-0"><a href="#" class="text-white fw-bold">Continue reading...</a></p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative" >
        <div class="col p-4 d-flex flex-column position-static">
        <?php
        // selecting posts
          $postQuery = "SELECT * FROM `posts` INNER JOIN `users` ON `users`.`user_id`=`posts`.`user_id` INNER JOIN `categories` ON `posts`.`category_id`=`categories`.`category_id` WHERE `posts`.`public`=1  ORDER BY RAND() LIMIT 1  ";
          $postResult = mysqli_query($connection,$postQuery);
          $row = mysqli_fetch_array($postResult);
              $id = $row['post_id'];
              $content = substr($row['post'], 0, 85). "...";
              $title = substr($row['title'], 0, 40). "...";
              $date = $row['timestamp'];
              $author = $row['firstName'] . " ". $row['lastName'];
              $category = $row['category'];
              // Creating HTML structure
              echo "<div>
              <strong class='d-inline-block mb-2 text-primary'>".$category."</strong>
              <h5 class='mb-0'>".$title."</h5>
              <div class='mb-1 text-muted'>".$date."</div>
              <p class='card-text mb-auto'>".$content."</p>
              <a href='page.php?post_id=" . $id."'>Continue reading</a>
              </div>";
        ?>
        </div>
        <div class="col-auto d-none d-lg-block">
          <?php
            $search_keyword = $title;
            $search_keyword=str_replace(' ','+',$search_keyword);
            $newhtml =file_get_html("https://www.google.com/search?q=".$search_keyword."&tbm=isch");
            $result_image_source = $newhtml->find('img', 1)->src;
            echo '<div style="background-repeat: no-repeat;
            background-image: url('.$result_image_source.'); height: 250px; width:200px"> </div>';
          ?>
          <!-- <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg> -->
        </div>

      </div>
    </div>
    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
        <?php
        // selecting posts
          $postQuery = "SELECT * FROM `posts` INNER JOIN `users` ON `users`.`user_id`=`posts`.`user_id` INNER JOIN `categories` ON `posts`.`category_id`=`categories`.`category_id` WHERE `posts`.`public`=1 ORDER BY RAND() LIMIT 1";
          $postResult = mysqli_query($connection,$postQuery);

          while($row = mysqli_fetch_array($postResult)){
              $id = $row['post_id'];
              $content = substr($row['post'], 0, 85). "...";
              $title = substr($row['title'], 0, 40). "...";
              $date = $row['timestamp'];
              $author = $row['firstName'] . " ". $row['lastName'];
              $category = $row['category'];
              // Creating HTML structure
              echo "<div>
              <strong class='d-inline-block mb-2 text-primary'>".$category."</strong>
              <h5 class='mb-0'>".$title."</h5>
              <div class='mb-1 text-muted'>".$date."</div>
              <p class='card-text mb-auto'>".$content."</p>
              <a href='page.php?post_id=" . $id."'>Continue reading</a>
              </div>";
          }
        ?>
        </div>
        <div class="col-auto d-none d-lg-block">
          <!-- <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg> -->
          <div class="col-auto d-none d-lg-block">
          <?php
            $search_keyword = $title;
            $search_keyword=str_replace(' ','+',$search_keyword);
            $newhtml =file_get_html("https://www.google.com/search?q=".$search_keyword."&tbm=isch");
            $result_image_source = $newhtml->find('img', 1)->src;
            echo '<div style="background-repeat: no-repeat;
            background-image: url('.$result_image_source.'); height: 250px; width:200px"> </div>';
          ?>
          <!-- <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg> -->
        </div>
        </div>
      </div>
    </div>
  </div>
  <form action="search.php" method="GET">
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search" name="search"></input>
  </form>
  <br>
  <div class="row g-5">
    <div class="col-md-8">
      <h3 class="pb-4 mb-4 fst-italic border-bottom">
        From the Firehose
      </h3>
        <?php
        // selecting posts
          $postQuery = "SELECT * FROM `posts` INNER JOIN `users` ON `users`.`user_id`=`posts`.`user_id` WHERE `posts`.`public`=1 ORDER BY `posts`.`post_id` DESC;";
          $postResult = mysqli_query($connection,$postQuery);

          while($row = mysqli_fetch_array($postResult)){
              $id = $row['post_id'];
              $content = $row['post'];
              $title = $row['title'];
              $date = $row['timestamp'];
              $author = $row['firstName'] . " ". $row['lastName'];
              // Creating HTML structure
              echo "<div id='post_".$id."' class='post' style='overflow: auto;'onclick='location.href=`page.php?post_id=" . $id . "`' style='cursor:pointer'>
              <article class='blog-post'>
              <h2 class='blog-post-title'>".$title."</h2>
              <p class='blog-post-meta'>".$date." by ".$author."</p>"
              .$content."
              </article>
              </div>";
          }
        ?>



             

      <nav class="blog-pagination" aria-label="Pagination">
        <a class="btn btn-outline-primary" href="#">Top Posts</a>
      </nav>

    </div>

    <div class="col-md-4">
      <div class="position-sticky" style="top: 2rem;">
        <div class="p-4 mb-3 bg-light rounded">
          <h4 class="fst-italic">About The Creator</h4>
          <p class="mb-0">Nick Pinzin is the creater of Blonk, he has long held his position against intelligent conversation and created Blonk as a way to escape meaningful dialogue. </p>
        </div>

      
    </div>
  </div>

</main>


    
  </body>
</html>