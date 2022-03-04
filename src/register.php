<?php
require_once('classes/User.php');
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Signin Template · Bootstrap v5.1</title>    

    <!-- Bootstrap core CSS -->
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="./assets/js/script.js"></script>

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
    <link href="./assets/css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">
  <form>
    <h1 class="h3 mb-3 fw-normal">Register Users</h1>

    <div class="form-floating">
      <input type="UserName" class="form-control" id="us"  placeholder="username">
      <label for="floatingInput">UserName</label>
    </div>
    <div class="form-floating">
      <input type="email" class="form-control mt-2" id="ml" id="floatingPassword" placeholder="@xyzgmail.com">
      <label for="floatingPassword">Email</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control mt-2" id="ps" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>

    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="cps" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Confirm Password</label>
      
    </div>

    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>
      <label for="" class="text-center" id="result"></label>
      <br><a href="login.php" class="text-center">go to login</a>
      <button class="w-100 btn btn-lg btn-primary" id="register" type="submit" name="action" value="register">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; CEDCOSS Technologies</p>

  </form>
</main>


    
  </body>
</html>