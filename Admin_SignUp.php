<?php
require 'Partials/connection.php';

if ($conn) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $a_email = $_POST['a_email'];
        $a_password = $_POST['a_password'];
        $c_a_password = $_POST['c_a_password'];
        $exist = false;

        // Check if the username already exists
        $checkUserQuery = "SELECT * FROM `admin_tb` WHERE `a_email` = '$a_email'";
        $checkUserResult = mysqli_query($conn, $checkUserQuery);

        if (mysqli_num_rows($checkUserResult) > 0) {
            // User already exists
            $showError= "User with the given username already exists.";
            header("Location: Admin.php?showError=  $showError");
        } elseif ($a_password == $c_a_password && $exist == false) {
            $sql ="INSERT INTO `admin_tb`(`a_email`,`a_password`) VALUES ('$a_email','$a_password')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $insert = true;
                $showAlert=true;
               
                // Redirect back to index.php with a query parameter
                $showAlert="Data Inserted successfully";
                header("Location:Admin.php?signup=true");
                exit();
            } else {
              $showError=  "Data Not Inserted successfully:  " ;
            }
        } else {
          $showError=  "a_password do not match";
          header("Location:Admin.php?showError=  $showError");
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
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  

<!-- Modal -->
<form  action="Admin_SignUP.php" method="post">
<div class="modal fade" id="Admin_signupmodal" tabindex="-1" aria-labelledby="Admin_signupmodalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header bg-dark text-success">
        <h1 class="modal-title fs-5" id="signupmodalLabel">Admin SignUp Page</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body bg-dark text-success">
      
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="a_email" name="a_email"aria-describedby="emailHelp">
      </div>
  <div class="mb-3">
    <label for="exampleInputa_password1" class="form-label">password</label>
    <input type="a_password" class="form-control" id="a_password" name="a_password">
  </div>
 
  <div class="mb-3">
    <label for="exampleInputa_password1" class="form-label"> Conform password</label>
    <input type="a_password" class="form-control" id="c_a_password" name="c_a_password">
    <div id="emailHelp" class="form-text"> Check Both a_passwords are Same.</div>

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