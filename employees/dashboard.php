<?php

session_start();

if(!isset($_SESSION['employee_id']))
{
header("Location:login.php");
exit();
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Employee Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

body{
background:#f4f6f9;
font-family:Arial;
}

/* Navbar */

.navbar{
background:#2c3e50;
}

.navbar-brand{
color:white;
font-weight:bold;
}

.navbar-brand:hover{
color:#ddd;
}

/* Dashboard card */

.dashboard-card{
max-width:500px;
margin:auto;
margin-top:80px;
border-radius:10px;
box-shadow:0 10px 25px rgba(0,0,0,0.1);
}

/* Buttons */

.btn{
font-size:16px;
padding:10px;
}

/* Message */

#msg{
font-weight:500;
}

</style>

</head>

<body>

<!-- Navbar -->

<nav class="navbar navbar-expand-lg">

<div class="container">

<span class="navbar-brand">
<i class="fa fa-user"></i> Employee Dashboard
</span>

<a href="logout.php" class="btn btn-light btn-sm">
Logout
</a>

</div>

</nav>


<!-- Dashboard -->

<div class="container">

<div class="card dashboard-card p-4">

<h4 class="text-center mb-4">Attendance Panel</h4>

<div class="d-grid gap-3">

<button class="btn btn-success" onclick="punchIn()">
<i class="fa fa-sign-in-alt"></i> Punch In
</button>

<button class="btn btn-danger" onclick="punchOut()">
<i class="fa fa-sign-out-alt"></i> Punch Out
</button>

</div>

<p id="msg" class="text-center mt-3"></p>

</div>

</div>


<script>

function punchIn(){

fetch("../api/attendance_api.php",{

method:"POST",

body:new URLSearchParams({

action:"punch_in",
employee_id:"<?php echo $_SESSION['employee_id']; ?>"

})

})

.then(res=>res.json())
.then(data=>{

document.getElementById("msg").innerHTML=data.message;

});

}

function punchOut(){

fetch("../api/attendance_api.php",{

method:"POST",

body:new URLSearchParams({

action:"punch_out",
employee_id:"<?php echo $_SESSION['employee_id']; ?>"

})

})

.then(res=>res.json())
.then(data=>{

document.getElementById("msg").innerHTML=data.message;

});

}

</script>

</body>

</html>