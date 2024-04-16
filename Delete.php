<?php
// Include database connection or any necessary files
require 'Partials/connection.php';

// Start the session
session_start();

// Check if admin ID is provided in the URL
if (isset($_GET['id'])) {
    $admin_id = $_GET['id'];

    // Prepare a delete statement for admin
    $sql = "DELETE FROM `admin_tb` WHERE `a_id` = $admin_id";

    // Execute the delete statement
    if (mysqli_query($conn, $sql)) {
        // Set success message in session
        $_SESSION['delete_success'] = true;
    } else {
        // Set error message in session
        $_SESSION['delete_error'] = mysqli_error($conn);
    }

    // Redirect back to Admin.php
    header("Location: Dashbord.php?a_loggedin=true");
    exit();
}

// Check if category ID is provided in the URL
if (isset($_GET['c_id'])) {
    $category_id = $_GET['c_id'];

    // Prepare a delete statement for categories
    $sql = "DELETE FROM `categories` WHERE `cat_id` = $category_id";

    // Execute the delete statement
    if (mysqli_query($conn, $sql)) {
        // Set success message in session
        $_SESSION['delete_success'] = true;
    } else {
        // Set error message in session
        $_SESSION['delete_error'] = mysqli_error($conn);
    }

    // Redirect back to Admin.php
    header("Location: Dashbord.php?a_loggedin=true");
    exit();
}

// Neither admin ID nor category ID provided in the URL
$_SESSION['delete_error'] = "ID not provided.";
header("Location: Dashbord.php");
exit();
?>
