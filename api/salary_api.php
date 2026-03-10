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

while($row = mysqli_fetch_assoc($result))
{
    $data[] = $row;
}

echo json_encode($data);
exit();

}

if($action == "add")
{

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
$saturdays = 0;

for($i=1;$i<=$total_days;$i++)
{

$date = $year."-".$month."-".$i;

$day = date("l",strtotime($date));

if($day == "Sunday"){
$sundays++;
}

if($day == "Saturday"){
$saturdays++;
}

}

$holidayQuery = mysqli_query($conn,"
SELECT COUNT(*) as total
FROM holidays
WHERE MONTH(holiday_date)='$month'
AND YEAR(holiday_date)='$year'
");

$holidayData = mysqli_fetch_assoc($holidayQuery);

$festival_holidays = $holidayData['total'];
$total_holidays = $sundays + $saturdays + $festival_holidays;
$working_days = $total_days - $total_holidays;
$absentQuery = mysqli_query($conn,"
SELECT COUNT(*) as total_absent
FROM attendance
WHERE employee_id='$emp_id'
AND status='Absent'
AND MONTH(attendance_date)='$month'
AND YEAR(attendance_date)='$year'
");

$absentData = mysqli_fetch_assoc($absentQuery);

$absent = $absentData['total_absent'];



$final_working_days = $working_days - $absent;

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
"final_working_days"=>$final_working_days,
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