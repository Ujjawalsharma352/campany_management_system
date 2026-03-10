<?php
include("../config/db.php");

header("Content-Type: application/json");


$input = json_decode(file_get_contents("php://input"), true);
$action = $input['action'] ?? $_GET['action'] ?? '';

if($action == "fetch"){

    $result = mysqli_query($conn,"SELECT * FROM holidays ORDER BY holiday_date DESC");

    $data = [];

    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
    }

    echo json_encode($data);
    exit();
}


if($action == "add"){

    $name = $input['holiday_name'];
    $date = $input['holiday_date'];

    mysqli_query($conn,"INSERT INTO holidays (holiday_name,holiday_date)
                        VALUES('$name','$date')");

    echo json_encode(["status"=>"success"]);
    exit();
}


if($action == "delete"){

    $id = $input['id'];

    mysqli_query($conn,"DELETE FROM holidays WHERE id=$id");

    echo json_encode(["status"=>"deleted"]);
    exit();
}
?>