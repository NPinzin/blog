<?php
session_start();
require('conn.php');
if (isset($_POST['submitButton'])) {
    $username = mysqli_real_escape_string($connection,$_POST['username']);
    $password = password_hash(mysqli_real_escape_string($connection,$_POST['password']),PASSWORD_DEFAULT);
    $email = mysqli_real_escape_string($connection,$_POST['email']);
    $firstName = mysqli_real_escape_string($connection,$_POST['firstName']);
    $lastName = mysqli_real_escape_string($connection,$_POST['lastName']);
    $insertQuery = "INSERT INTO `users` (`user_id`, `username`, `password`,`email`,`firstName`,`lastName`,`level_id`) VALUES (NULL, '$username', '$password','$email','$firstName','$lastName',0)" or die('QUERY ERROR');
    $selectQuery = "SELECT `username` FROM `users` WHERE `username` = '$username'";
    $result = mysqli_query($connection, $selectQuery) or DIE("QUERY ERROR");
    if (mysqli_num_rows($result)) {
        echo "<script type='text/javascript'>alert('Error Generating Account, Username already Exists');</script>";
    } else {
        mysqli_query($connection, $insertQuery) or DIE("INSERTING ERROR");
        $selectQuery = "SELECT * FROM `users` WHERE `username` = '$username'";
        $result = mysqli_query($connection, $selectQuery) or DIE("QUERY ERROR");
        while ($row = mysqli_fetch_array($result)) {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['level_id'] = $row['level_id'];
        }
        if (isset($_SESSION['user_id'])) {
            header ("Location: index.php");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Blonkistration</title>
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
<body>
<div class="center">
<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                <form action="registration.php" method="POST" class="mx-1 mx-md-4">

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="form3Example1c" class="form-control" name="firstName"  placeholder="First Name" required>
                    </div>
                  </div>
                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="form3Example1c" class="form-control" name="lastName"  placeholder="Last Name" required>
                    </div>
                  </div>
                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="email" id="form3Example3c" class="form-control" name="email" maxlength="55" placeholder="Email" required/>
                    </div>
                  </div>
                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="test" id="form3Example1c" class="form-control" name="username" minlength="3" maxlength="55"  placeholder="Username" required/>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" id="form3Example4cd" class="form-control" name="password" minlength="8" maxlength="18" placeholder="Password" required/>
                    </div>
                  </div>


                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button name="submitButton" type="submit" class="btn btn-primary btn-lg">Register</button>
                  </div>

                </form>

              </div>
              
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="blonk-high-resolution-color-logo.png"
                  class="img-fluid" alt="Sample image">

              </div>
              
            </div>
            <div class="create-account-link">
                Have an account? <a href="login.php" class="link">Click Here!</a>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    

</div>
</body>
</html>
