<!DOCTYPE html>
<html>
<head>
<title>Attendance List</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
margin:0;
background:#f4f6f9;
font-family:Arial;
}

.content{
margin-left:220px;
margin-top:12px;
padding:20px;
}

</style>

</head>

<body>

<?php include("../header.php"); ?>

<div class="content">

<div class="card shadow">

<div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">

<h4 class="mb-0">Attendance List</h4>

<a href="mark.php" class="btn btn-success">
Mark Attendance
</a>

</div>

<div class="card-body">

<div class="row mb-3">

<div class="col-md-4">
<input type="date" id="dateFilter" class="form-control">
</div>

<div class="col-md-2">
<button class="btn btn-primary w-100" onclick="loadAttendance()">
Show Attendance
</button>
</div>

</div>

<div class="table-responsive">

<table class="table table-bordered table-striped" id="attendanceTable">

<thead class="table-light">

<tr>
<th>Employee</th>
<th>Date</th>
<th>Punch In</th>
<th>Punch Out</th>
</tr>

</thead>

<tbody></tbody>

</table>

</div>

</div>

</div>

</div>

<script>

window.onload = function(){

var today = new Date().toISOString().split('T')[0];
document.getElementById("dateFilter").value = today;

loadAttendance();

};

function loadAttendance(){

var date = document.getElementById("dateFilter").value;

var xhr = new XMLHttpRequest();

xhr.open("GET","../api/attendance_api.php?action=fetch&date="+date,true);

xhr.onload = function(){

if(xhr.status === 200){

var data = JSON.parse(xhr.responseText);

var table = document.querySelector("#attendanceTable tbody");

table.innerHTML = "";

if(data.length == 0){

table.innerHTML = "<tr><td colspan='4' class='text-center'>No Attendance Found</td></tr>";
return;

}

for(var i=0;i<data.length;i++){

table.innerHTML += `

<tr>

<td>${data[i].name}</td>

<td>${data[i].attendance_date}</td>

<td>${data[i].punch_in ? data[i].punch_in : '-'}</td>

<td>${data[i].punch_out ? data[i].punch_out : '-'}</td>

</tr>

`;

}

}

};

xhr.send();

}

</script>

</body>
</html>