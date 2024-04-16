
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
    </div>
    <!-- here is bootstrap js link  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <?php require 'Partials/footer.php'; ?>
</body>
</html>
