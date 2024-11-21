<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    include 'connect.php';
    $employee_id = $_GET['id'];
    $query = "DELETE FROM tbl_employees WHERE employee_id = '$employee_id'";
    $delete = mysqli_query($conn, $query);
    if ($delete) {
        header("Location:dashboard.php");
    } else {
        echo "<div style='color: red;>Error, failed to delete. please try again</div>";
    }
}