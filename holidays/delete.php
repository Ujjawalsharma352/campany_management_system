<?php
session_start();
include("../config/db.php");

$id = $_GET['id'];

mysqli_query($conn,"DELETE FROM holidays WHERE id=$id");

header("Location: list.php");
exit();
?>