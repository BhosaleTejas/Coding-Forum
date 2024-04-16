
<?php 
require 'Partials/connection.php';
  
// Function to delete user, associated treats, and comments
function deleteUser($conn, $userId) {
    // Delete user
    $userDeleteSql = "DELETE FROM users WHERE u_id = $userId";
    mysqli_query($conn, $userDeleteSql);

    // Delete associated treats
    $treatsDeleteSql = "DELETE FROM treats WHERE t_uses_id = $userId";
    mysqli_query($conn, $treatsDeleteSql);

    // Delete associated comments
    $commentsDeleteSql = "DELETE comments FROM comments JOIN treats ON comments.t_id = treats.t_id WHERE treats.t_uses_id = $userId";
    mysqli_query($conn, $commentsDeleteSql);
}

// Fetch users data
$users_sql = "SELECT * FROM users";
$users_result = mysqli_query($conn, $users_sql);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <!-- here is bootstrap css link  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        #Main_Container {
            min-height: 100vh;
        }
    </style>
</head>
<body>
<div class="Container bg-dark" id="Main_Container">
    <?php require 'Partials/Admin_header.php'; ?>

    <?php
    // Check if the user is logged in
    if (isset($_SESSION['a_loggedin']) && $_SESSION['a_loggedin'] == true) {
        // Display tables only if the user is logged in
        ?>

        <div class="container mt-5">
            <h2 class="text-center" style="color: white; mt-5">Admin Table</h2>
            <table class="table card-container table-striped mt-5">
                <thead>
                <tr>
                    <th>Admin ID</th>
                    <th>Admin Email ID</th>
                    <th>Admin Password</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM `admin_tb`";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['a_id'] . "</td>";
                    echo "<td>" . $row['a_email'] . "</td>";
                    echo "<td>" . $row['a_password'] . "</td>";
                    echo "<td>
                        <a href='Delete.php?id=" . $row['a_id'] . "' class='btn btn-danger btn-sm'>Delete</a>
                      </td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>

        <div class="container mt-5">
            <h2 class="text-center" style="color: white; mt-5">Users Data Table</h2>
            <table class="table card-container table-striped mt-5">
                <thead>
                <tr>
                    <th>User ID</th>
                    <th>User Email</th>
                    <th>SignUp Time</th>
                    
                </tr>
                </thead>
                <tbody>
                <?php while ($userRow = mysqli_fetch_assoc($users_result)) { ?>
                    <tr>
                        <td><?php echo $userRow['u_id']; ?></td>
                        <td><?php echo $userRow['signupemail']; ?></td>
                        <td><?php echo $userRow['time']; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="container mt-5">
        <h2 class="text-center" style="color: white; mt-5">Categories Data Table</h2>
        <table class="table card-container table-striped mt-5">
          <thead>
            <tr>
              <th>Category ID</th>
              <th>Category Name</th>
              <th>Category Description</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT * FROM `categories`";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
              echo "<td>" . $row['cat_id'] . "</td>";
              echo "<td>" . $row['cat_name'] . "</td>";
              echo "<td>" . $row['cat_des'] . "</td>";
              echo "<td>
                      <a href='Delete.php?c_id=" . $row['cat_id'] . "' class='btn btn-danger btn-sm'>Delete</a>
                    </td>";
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
 
            <div class="container mt-5">
        <h2 class="text-center" style="color: white; mt-5">Treats Data Table</h2>
        <table class="table card-container table-striped mt-5">
          <thead>
            <tr>
              <th>Threats ID</th>
              <th>Threats Title</th>
              <th>Threats Description</th>
              <th>Categories ID</th>
              <th> User ID</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT * FROM `treats`";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
              echo "<td>" . $row['t_id'] . "</td>";
              echo "<td>" . $row['t_title'] . "</td>";
              echo "<td>" . $row['t_des'] . "</td>";
              echo "<td>" . $row['t_cat_id'] . "</td>";
              echo "<td>" . $row['t_user_id'] . "</td>";
             
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
            <div class="container mt-5">
        <h2 class="text-center" style="color: white; mt-5">Comments Data Table</h2>
        <table class="table card-container table-striped mt-5">
          <thead>
            <tr>
              <th>Comments ID</th>
              <th>Comments</th>
              <th>Threats  ID</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT * FROM `comments`";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
              echo "<td>" . $row['c_id'] . "</td>";
              echo "<td>" . $row['c_contain'] . "</td>";
              echo "<td>" . $row['t_id'] . "</td>";
        
             
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>

  

    <?php } else {
        // If the user is not logged in, show a message or redirect them to the login page
        echo '<div class="alert alert-info" role="alert">
                <h3>You are Not Logged In</h3>
            </div>';
    }
    ?>

    <!-- here is bootstrap js link  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <?php require 'Partials/footer.php'; ?>
</body>
</html>
