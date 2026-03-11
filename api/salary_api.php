<?php
include("../config/db.php");
header("Content-Type: application/json");

$action = $_POST['action'] ?? $_GET['action'] ?? '';

if($action == "fetch"){

$result = mysqli_query($conn,"
SELECT salary.*, employees.name
FROM salary
JOIN employees ON salary.employee_id = employees.id
ORDER BY salary.year DESC
");

$data = [];

while($row = mysqli_fetch_assoc($result)){
$data[] = $row;
}

echo json_encode($data);
exit();

}

if($action == "add"){

$emp_id = $_POST['employee_id'];
$month = $_POST['month'];
$year = $_POST['year'];
$bonus = $_POST['bonus'];
$deductions = $_POST['deductions'];

$empQuery = mysqli_query($conn,"
SELECT basic_salary FROM employees
WHERE id='$emp_id'
");

$emp = mysqli_fetch_assoc($empQuery);

$basic = $emp['basic_salary'];

$total_days = cal_days_in_month(CAL_GREGORIAN,$month,$year);

$sundays = 0;
$alternate_saturdays = 0;
$sat_count = 0;

for($i=1;$i<=$total_days;$i++){

$date = $year."-".$month."-".$i;
$day = date("l",strtotime($date));

if($day == "Sunday"){
$sundays++;
}

if($day == "Saturday"){
$sat_count++;

if($sat_count == 2 || $sat_count == 4){
$alternate_saturdays++;
}

}

}

$total_holidays = $sundays + $alternate_saturdays;
$working_days = $total_days - $total_holidays;

$presentQuery = mysqli_query($conn,"
SELECT COUNT(*) as total_present
FROM attendance
WHERE employee_id='$emp_id'
AND punch_in IS NOT NULL
AND MONTH(attendance_date)='$month'
AND YEAR(attendance_date)='$year'
");

$presentData = mysqli_fetch_assoc($presentQuery);

$present_days = $presentData['total_present'];
$absent = $working_days - $present_days;

if($absent < 0){
$absent = 0;
}


$per_day = $basic / $working_days;

$attendance_deduction = $per_day * $absent;

$total_deduction = $attendance_deduction + $deductions;

$net = $basic + $bonus - $total_deduction;


mysqli_query($conn,"
INSERT INTO salary
(employee_id,month,year,basic,absent_days,bonus,deductions,net_salary)
VALUES
('$emp_id','$month','$year','$basic','$absent','$bonus','$total_deduction','$net')
");

echo json_encode([
"status"=>"success",
"working_days"=>$working_days,
"present_days"=>$present_days,
"absent"=>$absent
]);

exit();

}

if($action == "delete"){

$id = $_POST['id'];

mysqli_query($conn,"
DELETE FROM salary
WHERE id='$id'
");

echo json_encode([
"status"=>"deleted"
]);

exit();

}
?>