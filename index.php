<?php
  require 'Partials/connection.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
      #carouselExample {
        height: 400px; /* Adjust the height as needed */
      }
      .card-container {
        padding-left: 55px; /* Adjust the padding value as needed */
      }
      body {
    overflow-x: hidden;
}

.Container {
        max-width: 100%;
        margin-top: -20px; /* Adjust the margin-top value to reduce space */
      }
      .Container h2 {
        margin-bottom: 0; /* Remove bottom margin for h2 element */
      }

    </style>
  </head>
  <body>
    
    <!-- navabar code herer  -->
    <?php require 'Partials/header.php'?>
       <!-- card code start here  -->
   <div class="Container bg-dark card-container ">
   <h2 class="text-center mt-3"> Fourm-Categories</h2>

   <div class="row mt-3 pl-3 ">

      <!-- FETCH ALL Categories -->
      <?php
    $sql = "SELECT * FROM `categories`";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      // Use $row['img'] instead of $img
      $imgData = base64_encode($row['img']);
  
      echo '<div class="col-md-4 my-2 ">
              <div class="card mb-3  " style="width: 18rem;">
                <img src="data:image/jpeg;base64,' . $imgData . '" class="card-img-top" alt="Error"  style="height: 200px; width: 100%";>
                <div class="card-body">
                  <h5 class="card-title text-center ">' . $row['cat_name'] . '</h5>
                  <p class="card-text">' . substr($row['cat_des'], 0, 100) . '...</p>
                  <a href="threats.php?cat_id=' . $row['cat_id'] . '" class="btn btn-primary form-control">View Details</a>
                </div>
              </div>
            </div>';
  }
  
?>

   </div>
   
    
    </div>
   </div>
   </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <?php require 'Partials/footer.php'?>
  </body>
</html>