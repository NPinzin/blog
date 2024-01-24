<?php
session_start();
require('conn.php');
if (isset($_POST['submitButton'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM `users` WHERE `username` = '$username'";
    $result = mysqli_query($connection, $query) or DIE("QUERY ERROR");
    $rows = mysqli_fetch_array($result);
    if (mysqli_num_rows($result)) {
        if ($rows['level_id'] == 1) {
            echo "<script type='text/javascript'>alert('Sorry, Your Account has been Deactivated');</script>";
        } else {
            if (password_verify($password,$rows['password'])) {
                $_SESSION['user_id'] = $rows['user_id'];
                $_SESSION['level_id'] = $rows['level_id'];
                header("Location: index.php");
            } else {
                echo "<script type='text/javascript'>alert('Sorry, Your Credentials Are Incorrect');</script>";
            }      
        } 
    } else {
        echo "<script type='text/javascript'>alert('Sorry, Your Credentials Are Incorrect');</script>";
    }
}
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Blonkin</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

    

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
    <link href="bootstrap\bootstrap-5.0.2-examples\bootstrap-5.0.2-examples\sign-in\signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">
  <form action="login.php" method="POST">
    <img class="mb-4" src="blonk-high-resolution-color-logo.png" alt="" width="288" height="228">
    <h1 class="h3 mb-3 fw-normal">Please Sign In</h1>

    <div class="form-floating">
     <input type="text" name="username" minlength="3" maxlength="55"  id="floatingInput" placeholder="Username" class="form-control" required>
     <label for="floatingInput">Username</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" minlength="8" maxlength="18" required>
      <label for="floatingPassword">Password</label>
    </div>

    <div class="create-account-link">
    Dont Have an Account? <a href="registration.php" class="link">Click Here!</a>
    </div>
    <div class="create-account-link">
    <a href="guest.php" class="link">Continue as Guest?</a>
    </div>
    <br>
    <button class="w-100 btn btn-lg btn-primary" type="submit" name="submitButton">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2023-2023</p>
  </form>
</main>


    
  </body>
</html>
