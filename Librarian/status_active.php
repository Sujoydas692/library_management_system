<?php
include '../connection.php';

$id = base64_decode($_GET['id']);

mysqli_query($con, "UPDATE `student` SET `status` = '1' WHERE `id` = '$id'");
header('location: student.php');

?>