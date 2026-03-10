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

</head>

<body class="bg-light">

<div class="container mt-4 style="max-width:600px;">

<div class="card p-4 mt-4">

<h5>Attendance</h5>

<button class="btn btn-success me-2" onclick="punchIn()">Punch In</button>
<br>
<button class="btn btn-danger" onclick="punchOut()">Punch Out</button>

<p id="msg" class="mt-3"></p>

</div>

<a href="logout.php" class="btn btn-secondary mt-3">Logout</a>

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