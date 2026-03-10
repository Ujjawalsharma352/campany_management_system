<?php
include("../config/db.php");
header("Content-Type: application/json");

$action = $_POST['action'] ?? $_GET['action'] ?? '';

if($action == "fetch"){
    $result = mysqli_query($conn,"SELECT * FROM employees");
    $data = [];

    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
    }

    echo json_encode($data);
    exit();
}

if($action == "add"){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $salary = $_POST['basic_salary'];
    
    mysqli_query($conn,"INSERT INTO employees 
    (name,email,department,basic_salary)
    VALUES('$name','$email','$department','$salary')");

    (["status"=>"success"]);
    exit();
}

if($action == "delete"){
    $id = $_POST['id'];
    mysqli_query($conn,"DELETE FROM employees WHERE id=$id");

    echo json_encode(["status"=>"deleted"]);
    exit();
}

if($action == "update"){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $salary = $_POST['basic_salary'];

    mysqli_query($conn,"UPDATE employees SET
        name='$name',
        email='$email',
        department='$department',
        basic_salary='$salary'
        WHERE id=$id");

    echo json_encode(["status"=>"updated"]);
    exit();
}
?>