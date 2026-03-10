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

if($action == "punch_in"){

$employee_id = $_POST['employee_id'];

$date = date("Y-m-d");
$time = date("H:i:s");

$check = mysqli_query($conn,"
SELECT * FROM attendance
WHERE employee_id='$employee_id'
AND attendance_date='$date'
");

if(mysqli_num_rows($check) > 0){

echo json_encode([
"status"=>"exists",
"message"=>"Already Punched In"
]);

exit();

}

mysqli_query($conn,"
INSERT INTO attendance(employee_id,attendance_date,punch_in,status)
VALUES('$employee_id','$date','$time','IN')
");

echo json_encode([
"status"=>"success",
"message"=>"Punch In Successful"
]);

exit();

}

if($action == "punch_out"){

$employee_id = $_POST['employee_id'];

$date = date("Y-m-d");
$time = date("H:i:s");

mysqli_query($conn,"
UPDATE attendance
SET punch_out='$time', status='OUT'
WHERE employee_id='$employee_id'
AND attendance_date='$date'
");

echo json_encode([
"status"=>"success",
"message"=>"Punch Out Successful"
]);

exit();

}

?>