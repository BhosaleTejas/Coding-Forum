<?php
require 'Partials/connection.php';
    if($conn)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      
        $a_email =$_POST['a_email'];
        $a_password =$_POST['a_password'];
        $login = false;
        $exist = false;

        // Check if the username already exists
        $checkUserQuery = "SELECT * FROM `admin_tb` WHERE `a_email` = '$a_email' AND `a_password`='$a_password'";
        $checkUserResult = mysqli_query($conn, $checkUserQuery);
        if (mysqli_num_rows($checkUserResult) == 1) {
            session_start();
            $admin = mysqli_fetch_assoc($checkUserResult);
            $_SESSION['a_loggedin'] =true;
            $_SESSION['a_id'] = $admin['a_id'];
            $_SESSION['a_email'] =$a_email;
            $showAlert=true;
            $showAlert=" Loggedin successfully";
            header("Location: Dashbord.php?a_loggedin=true");
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
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>

<!-- Modal -->
<form action="Admin_login.php" method="post">
<div class="modal fade" id="Admin_Loginmodal" tabindex="-1" aria-labelledby="Admin_LoginmodalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark text-success">
      <h1 class="modal-title fs-5 " id="loginmodalLabel"> Admin Login page</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body bg-dark text-success">
      
      <div class="mb-3">
        <label for="a_email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="a_email" name="a_email"aria-describedby="emailHelp">
    
      </div>
      <div class="mb-3">
        <label for="a_password" class="form-label">password</label>
        <input type="password" class="form-control" id="a_password" name="a_password">
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