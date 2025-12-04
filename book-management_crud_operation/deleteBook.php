<?php

include('database.php');
$id = $_GET['id'];

$deleteQuery = "delete from books where id = ?";
$stmt = mysqli_stmt_init($conn);
$stmtprepare = mysqli_stmt_prepare($stmt,$deleteQuery);
if($stmtprepare){
    mysqli_stmt_bind_param($stmt,"i",$id);
    mysqli_stmt_execute($stmt);
    header("Location: index.php");
    exit;
}
?>