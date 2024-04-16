
<?php
require 'Partials/connection.php';
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Threads page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
          crossorigin="anonymous">
          <style>
            .custom-width {
      width: 400px; /* Adjust the width as needed */
      padding: 12px;
      
    }
          </style>

</head>
<body>
<div class="container-fluid bg-dark text-light">
<!-- navabar code here -->
<?php
// require 'Partials/header.php';

if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == "true")) {
    echo '
      <div class="container bg-dark  ">
      <a href="index.php?loggedin=true" class="btn btn-danger" >BackTo Start</a>
        </div>';

} else {
    echo '
        <div class="container  bg-dark ">
        <a href="index.php" class="btn btn-danger" >BackTo Start</a>
        </div>';
}

$t_id = $_GET['t_id'];
$sql = "SELECT * FROM `treats` WHERE t_id=$t_id";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $t_title = $row['t_title'];
    $t_des = $row['t_des'];
    $posted_by_user_id = $row['t_user_id'];

    // Retrieve the name of the user who posted the thread
    $sql_user = "SELECT signupemail FROM `users` WHERE u_id = $posted_by_user_id";
    $result_user = mysqli_query($conn, $sql_user);
    $row_user = mysqli_fetch_assoc($result_user);
    $posted_by_name = $row_user['signupemail'];
}
?>

<!-- insert post code here -->
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $c_contain = mysqli_real_escape_string($conn, $_POST['c_contain']);
    $u_id = $_SESSION['u_id'];

    $sql = "INSERT INTO `comments` (`c_contain`, `t_id`, `c_time`, `comment_by`) VALUES ('$c_contain', '$t_id', NOW(), '$u_id')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $insert = true;
        $showAlert = true;
        if ($showAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
         <strong>Success</strong> Your Comment Inserted Successfully.
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>';
        }

    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Fail!</strong> Data Not Inserted successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        // echo "Data Not Inserted successfully:  " . mysqli_error($conn);
    }
}
?>

<div class="container  mb-4">
    <div class="jumbotron mt-5">
        <h1 class="display-4"><?php echo $t_title; ?></h1>
        <p class="lead"><?php echo $t_des; ?></p>
        <hr class="my-4">
        <p>You are expected to participate in the course Forum. You are also expected to reply to at least two student
            peers’ postings per discussion board topic. Peer replies should be thoughtful, reflective, and respectful
            while prompting further discussion using content knowledge, critical thinking skills, questioning, and
            relevant information of the topic. Review the resources below for guidelines on how to participate in the
            online forum assignments.

        </p>
        <p><b>Posted By: <?php echo $posted_by_name; ?> </b></p>
    </div>
</div>

<!-- Post Comments code -->
<div class="container my-4">
    <h2 class="text-center mt-5">Post your Comments</h2>
</div>
<div class="container my-4">
    <?php
    if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == "true")) {
        echo'
        <form action="threatlist.php?t_id=' . $t_id . '" method="post">
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Type your Comments</label>
                <textarea class="form-control" id="c_contain" rows="3" name="c_contain"></textarea>
            </div>
            <button type="submit" class="btn btn-success custom-width d-block mx-auto mt-5" >Post Comments</button>
        </form>';
    } else {
        echo '
        <div class="alert alert  bg-warning mb-4 mt-4" style="padding: 20px;">
            <strong>Alert !</strong>  You Are Not Logged In!
        </div>';
    }
    ?>
</div>
<div class="container mt-5 ">
    <h3 class="mb-5">Discussion</h3>
    <?php
    $cat_id = $_GET['t_id'];
    $sql = "SELECT * FROM `comments` WHERE t_id=$t_id";
    $result = mysqli_query($conn, $sql);
    $noresult = true;
    while ($row = mysqli_fetch_assoc($result)) {
        $c_id = $row['c_id'];
        $c_contain = $row['c_contain'];
        $c_time = $row['c_time'];
        $t_user_id = $row['comment_by'];
        $noresult = false;

        $sql2 = "SELECT signupemail FROM `users` WHERE u_id = $t_user_id";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);

        echo '
        <div class="d-flex my-3">
            <div class="flex-shrink-0">
                <img src="Partials/image/User.jpg" alt="Image Not Found!" style="width: 40px; height: 40px;">
            </div>
            <div class="flex-grow-1 ms-3">
                <p class="font-weight-bold"><b>' . $row2['signupemail'] . '</b> <small>at ' . $c_time . '</small></p> 
                <p>' . $c_contain . '</p>
            </div>
        </div>';
    }

    if ($noresult) {
        echo '<div class="alert alert-info" role="alert">
        <h3> No Result found</h3>
        Be the first person ask the question</div>';
    }
    ?>
</div>

    <?php require 'Partials/footer.php' ?>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>
</html>
