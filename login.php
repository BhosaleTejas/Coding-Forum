<?php
require 'Partials/connection.php';
    if($conn)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      
        $signupemail =$_POST['signupemail'];
        $password =$_POST['password'];
        $login = false;
        $exist = false;

        // Check if the username already exists
        $checkUserQuery = "SELECT * FROM `users` WHERE `signupemail` = '$signupemail' AND `password`='$password'";
        $checkUserResult = mysqli_query($conn, $checkUserQuery);
        if (mysqli_num_rows($checkUserResult) == 1) {
            session_start();
            $user = mysqli_fetch_assoc($checkUserResult);
            $_SESSION['u_id'] = $user['u_id'];
          
            $_SESSION['loggedin'] =true;
            $_SESSION['signupemail'] =$signupemail;
            $showAlert=true;
            $showAlert=" Loggedin successfully";
            header("Location: index.php?loggedin=true");
            exit();

        } else
       {
        $showError=  "User Not Exist: ";
        header("Location: index.php?showError=  $showError");
           
        }
       }
        
    }
    else
     {
      $showError=  "connection error: ";
        header("Location: index.php?showError=  $showError");
           
        
    }

   
?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
   <!-- Modal -->
<form action="login.php" method="post">
<div class="modal fade border-success " id="loginmodal" tabindex="-1" aria-labelledby="loginmodalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark text-success">
      <h1 class="modal-title fs-5 " id="loginmodalLabel">Login page</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body bg-dark text-success">
      
  <div class="mb-3">
    <label for="signupemail" class="form-label">Email address</label>
    <input type="email" class="form-control" id="signupemail" name="signupemail"aria-describedby="emailHelp">

  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  
  <button type="submit" class="btn btn-primary form-control mt-4">LogIn</button>

      </div>
      
    </div>
  </div>
</div>
</form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
