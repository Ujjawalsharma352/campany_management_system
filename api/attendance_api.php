<?php

include("../config/db.php");

header("Content-Type: application/json");

$action = $_POST['action'] ?? $_GET['action'] ?? '';

if($action == "fetch"){

$date = $_GET['date'] ?? '';

$query = "
SELECT attendance.*, employees.name
FROM attendance
JOIN employees ON attendance.employee_id = employees.id
";

if($date != ""){
$query .= " WHERE attendance.attendance_date='$date'";
}

$query .= " ORDER BY attendance.attendance_date DESC";

$result = mysqli_query($conn,$query);

$data = [];

while($row = mysqli_fetch_assoc($result)){
$data[] = $row;
}

echo json_encode($data);
exit();

}

if($action == "add"){

$employee_id = $_POST['employee_id'];
$date = $_POST['attendance_date'];
$status = $_POST['status'];

mysqli_query($conn,"
INSERT INTO attendance (employee_id,attendance_date,status)
VALUES ('$employee_id','$date','$status')
");

echo json_encode(["status"=>"success"]);
exit();

}


if($action == "bulk_add"){

$employee_ids = $_POST['employee_id'];
$statuses = $_POST['status'];
$date = $_POST['attendance_date'];

for($i=0;$i<count($employee_ids);$i++){

$emp = $employee_ids[$i];
$status = $statuses[$i];

mysqli_query($conn,"
INSERT INTO attendance(employee_id,attendance_date,status)
VALUES('$emp','$date','$status')
");

}

echo json_encode(["status"=>"success"]);
exit();

}

?>