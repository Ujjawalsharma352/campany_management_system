<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit();
}

$countQuery = "SELECT COUNT(*) as total FROM employees";
$countResult = mysqli_query($conn,$countQuery);
$totalEmployees = mysqli_fetch_assoc($countResult)['total'];

$holidayQuery = "SELECT COUNT(*) as total FROM holidays";
$holidayResult = mysqli_query($conn,$holidayQuery);
$totalHolidays = mysqli_fetch_assoc($holidayResult)['total'];

$salaryQuery = "SELECT COUNT(*) as total FROM salary";
$salaryResult = mysqli_query($conn,$salaryQuery);
$totalSalaries = mysqli_fetch_assoc($salaryResult)['total'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>

body{
margin:0;
background:#f4f6f9;
font-family:sans-serif;
}

#sidebar{
width:250px;
height:100vh;
position:fixed;
background:#1e293b;
transition:0.3s;
}

#sidebar.hide{
margin-left:-250px;
}

#sidebar h4{
color:white;
}

#sidebar a{
color:#cbd5e1;
display:block;
padding:12px 20px;
text-decoration:none;
font-size:15px;
}

#sidebar a:hover{
background:#334155;
color:white;
}

#content{
margin-left:250px;
transition:0.3s;
min-height:100vh;
display:flex;
flex-direction:column;
}

#content.full{
margin-left:0;
}

.navbar{
background:#1e293b;
}

.dashboard-card{
border:none;
border-radius:12px;
transition:0.3s;
height:150px;
}

.dashboard-card:hover{
transform:translateY(-5px);
box-shadow:0 8px 20px rgba(0,0,0,0.15);
}

.card-body{
height:100%;
display:flex;
justify-content:space-between;
align-items:center;
}

.icon-box{
font-size:30px;
opacity:0.8;
}

footer{
background:#1e293b;
color:white;
text-align:center;
padding:12px;
margin-top:auto;
}

</style>

</head>

<body>

<div id="sidebar">

<br>

<a href="dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a>

<a data-bs-toggle="collapse" href="#employeeMenu">
<i class="bi bi-people"></i> Employees
</a>

<div class="collapse" id="employeeMenu">
<a href="../employees/list.php" class="ps-4">Employee List</a>
<a href="../employees/add.php" class="ps-4">Add Employee</a>
</div>

<a data-bs-toggle="collapse" href="#holidayMenu">
<i class="bi bi-calendar-event"></i> Holidays
</a>

<div class="collapse" id="holidayMenu">
<a href="../holidays/list.php" class="ps-4">Holiday List</a>
<a href="../holidays/add.php" class="ps-4">Add Holiday</a>
</div>

<a data-bs-toggle="collapse" href="#salaryMenu">
<i class="bi bi-cash-stack"></i> Salary
</a>

<div class="collapse" id="salaryMenu">
<a href="../salary/list.php" class="ps-4">Salary List</a>
<a href="../salary/generate.php" class="ps-4">Generate Salary</a>
</div>

<a data-bs-toggle="collapse" href="#attendanceMenu">
<i class="bi bi-clock-history"></i> Attendance
</a>

<div class="collapse" id="attendanceMenu">
<a href="../attendance/list.php" class="ps-4">Attendance List</a>
<a href="../attendance/mark.php" class="ps-4">Mark Attendance</a>
</div>

<a href="logout.php" class="text-danger">
<i class="bi bi-box-arrow-right"></i> Logout
</a>

</div>

<div id="content">

<nav class="navbar px-4">

<button class="btn btn-light btn-sm" onclick="toggleSidebar()">
<i class="bi bi-list"></i>
</button>

<span class="navbar-brand text-white ms-3">
Company Management System
</span>

</nav>

<div class="container mt-4">

<h3 class="mb-4">Dashboard Overview</h3>

<div class="row g-4">

<div class="col-md-3">

<div class="card dashboard-card bg-primary text-white">

<div class="card-body">

<div>

<h6>Total Employees</h6>
<h2><?php echo $totalEmployees; ?></h2>

<a href="../employees/list.php" class="btn btn-light btn-sm mt-2">
Manage
</a>

</div>

<div class="icon-box">
<i class="bi bi-people-fill"></i>
</div>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card dashboard-card bg-success text-white">

<div class="card-body">

<div>

<h6>Total Holidays</h6>
<h2><?php echo $totalHolidays; ?></h2>

<a href="../holidays/list.php" class="btn btn-light btn-sm mt-2">
Manage
</a>

</div>

<div class="icon-box">
<i class="bi bi-calendar-event-fill"></i>
</div>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card dashboard-card bg-info text-white">

<div class="card-body">

<div>

<h6>Total Salaries</h6>
<h2><?php echo $totalSalaries; ?></h2>
<a href="../salary/list.php" class="btn btn-light btn-sm mt-2">
Manage
</a>

</div>

<div class="icon-box">
<i class="bi bi-cash-coin"></i>
</div>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card dashboard-card bg-warning text-white">

<div class="card-body">

<div>

<h6>Attendance</h6>
<br>
<br>

<a href="../attendance/list.php" class="btn btn-light btn-sm mt-2">
Manage
</a>

</div>

<div class="icon-box">
<i class="bi bi-clock"></i>
</div>

</div>

</div>

</div>

</div>

</div>

<footer>

© <?php echo date("Y"); ?> Company Management System

</footer>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>

function toggleSidebar(){
document.getElementById("sidebar").classList.toggle("hide");
document.getElementById("content").classList.toggle("full");
}

</script>

</body>
</html>