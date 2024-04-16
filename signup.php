<?php
require 'Partials/connection.php';

if ($conn) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $signupemail = $_POST['signupemail'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];
        $exist = false;

        // Check if the username already exists
        $checkUserQuery = "SELECT * FROM `users` WHERE `signupemail` = '$signupemail'";
        $checkUserResult = mysqli_query($conn, $checkUserQuery);

        if (mysqli_num_rows($checkUserResult) > 0) {
            // User already exists
            $showError= "User with the given username already exists.";
            header("Location: index.php?showError=  $showError");
        } elseif ($password == $c_password && $exist == false) {
            $sql ="INSERT INTO `users`(`signupemail`,`password`) VALUES ('$signupemail','$password')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $insert = true;
                $showAlert=true;
               
                // Redirect back to index.php with a query parameter
                $showAlert="Data Inserted successfully";
                header("Location: index.php?signup=true");
                exit();
            } else {
              $showError=  "Data Not Inserted successfully:  " ;
            }
        } else {
          $showError=  "Password do not match";
          header("Location: index.php?showError=  $showError");
        }
    }
} else {
  $showError= "Connection error:  " . mysqli_error($conn);
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
<form action="signup.php" method="post">
<div class="modal fade" id="signupmodal" tabindex="-1" aria-labelledby="signupmodalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header bg-dark text-success">
        <h1 class="modal-title fs-5" id="signupmodalLabel">SignUp Page</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body bg-dark text-success">
      
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="signupEmail" name="signupemail"aria-describedby="emailHelp">
      </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
 
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label"> Conform Password</label>
    <input type="password" class="form-control" id="c_password" name="c_password">
    <div id="emailHelp" class="form-text"> Check Both Passwords are Same.</div>

  </div>
 
  <button type="submit" class="btn btn-primary form-control">SignUp</button>

      </div>
    
    </div>
  </div>
</div>
</form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>


