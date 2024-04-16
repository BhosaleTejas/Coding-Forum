<?php
  require 'Partials/connection.php';
  session_start();
  $showAlert=false;

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Threads page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
      #backButton {
    margin-top: 20px; /* Add some positive margin-top for the Back to Start button */
  }
  .Container {
    max-width: 100%;
      }


  body {
    overflow-x: hidden;
  }
  
    .custom-width {
      width: 400px; /* Adjust the width as needed */
      padding: 12px;
    }
  
</style>

  </head>
  <body>
  <div class="container-fluid bg-dark text-light">
    <!-- navabar code herer  -->
    <?php 
    
    if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == "true")) {
      echo '
      <div class="container bg-dark ">
      <a href="index.php?loggedin=true"class="btn btn-danger" >BackTo Start</a>
        </div>';
      
      }
      else
      {
        echo '
        <div class="container bg-dark mt-4" >
        <a href="index.php"class="btn btn-danger mt-5" >BackTo Start</a>

        </div>';
       
        }
    // require 'Partials/header.php'; 
    $cat_id=$_GET['cat_id'];
    $sql = "SELECT * FROM `categories` WHERE cat_id=$cat_id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
     $noresult=false;
      $cat_name =$row['cat_name'];
      $cat_des =$row['cat_des'];

      

    }
    ?>
    <!-- Add qustions code here  -->
 <?php

 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $t_title = $_POST['t_title'];
  $t_des = $_POST['t_des'];
 $u_id = $_GET['u_id'];


 $sql = "INSERT INTO `treats` (`t_title`, `t_des`, `t_cat_id`, `t_user_id`, `t_time`) VALUES ('$t_title', '$t_des', '$cat_id', '$u_id', NOW());";

  $result = mysqli_query($conn, $sql);
     if ($result) 
     {
         
         $insert = true;
         $showAlert=true;
        if($showAlert)
      {
         echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
         <strong>Success</strong> Data Inserted Successfuly.
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>';
       }
     
     } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Fail!</strong> Data Not Inserted successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
         echo "Data Not Inserted successfully:  " . mysqli_error($conn);
     }
 }
 ?>

   <!-- information language show here -->
    <div class="container mb-4">
  <div class="jumbotron mt-5">
    <h1 class="display-4"><?php echo $cat_name; ?></h1>
    <p class="lead"><?php echo $cat_des; ?></p>
    <hr class="my-4">
    <p>You are expected to participate in the course Forum. You are also expected to reply to at least two student peers’ postings per discussion board topic. Peer replies should be thoughtful, reflective, and respectful while prompting further discussion using content knowledge, critical thinking skills, questioning, and relevant information of the topic. Review the resources below for guidelines on how to participate in the online forum assignments.

</p>
    <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
  </div>
</div> 
<div class="container bg-dark mt-5">
<h2 class="text-center">Start Discussion</h2>
</div>
<?php
if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == "true")) {
  //  <!-- Add qustions code  -->
 echo'
 <div class="container bg-dark text-light my-4  ">

 <form action="threats.php?cat_id=' . $cat_id . '&u_id=' . $_SESSION['u_id'] . '" method="post">

      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Problem Title</label>
        <input type="text" class="form-control" id="t_title" name="t_title" aria-describedby="emailHelp">
        <div id="title" class="form-text">Keep your title as short as possible.</div>
      </div>
      <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Elaborate Your Concern</label>
        <textarea class="form-control" id="t_des" rows="3" name="t_des"></textarea>
      </div>
      <button type="submit" class="btn btn-success mt-5 custom-width d-block mx-auto">Submit</button>

    </form>';
}
else
{
  echo '
  <div class="alert alert text-light bg-warning mb-4 mt-4"style="padding: 20px;">
  <strong>Alert !</strong>  You Are Not LoggdIn!
</div>';
  
}
?>


<!-- qustions fetch code here  -->

<div class="container-fluid bg-dark text-light mt-4">
      <h2 class="mt-5 mb-5">Browse Questions</h2>
      <?php 
        $cat_id=$_GET['cat_id'];
        $sql = "SELECT * FROM `treats` WHERE t_cat_id=$cat_id";
        $result = mysqli_query($conn, $sql);
        $noresult=true;
        while ($row = mysqli_fetch_assoc($result)) {
          $t_cat_id =$row['t_id'];
          $t_title =$row['t_title'];
          $t_des =$row['t_des'];
          $t_user_id =$row['t_user_id'];
          $t_time =$row['t_time'];
          $noresult=false;

          $sql2 = "SELECT signupemail FROM `users` WHERE u_id = $t_user_id";
            $result2 = mysqli_query($conn, $sql2);

            if ($result2) {
                $row2 = mysqli_fetch_assoc($result2);

                // Check if $row2 is not null before accessing its elements
                if ($row2) {
                    echo '
                        <div class="d-flex my-3">
                            <div class="flex-shrink-0">
                                <img src="Partials/image/User.jpg" alt="Image Not Found!" style="width: 40px; height: 40px;">
                            </div>
                            <div class="flex-grow-1 ms-3  mb-2">
                                <p class="font-weight-bold"><b>' . $row2['signupemail'] . '</b> <small>at ' . $t_time . '</small></p> 
                                <h5><a class="text-white text-decoration-none" href="threatlist.php?t_id=' . $t_cat_id . '">Question:    ' . $t_title . '</a></h5>
                                ' . $t_des . '
                            </div>
                        </div>';
                }
            }
        }

        // If not any qustions than the alert code here 
        if($noresult)
        {
           
            echo '<div class="alert alert-info" role="alert">
            <h3> No Result found</h3>
            Be the first person ask the qustion</div>';
        }
      ?>
     <?php require 'Partials/footer.php'?>
    </div>
    
    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
  </body>
</html>