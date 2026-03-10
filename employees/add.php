<!DOCTYPE html>
<html>
<head>
<title>Add Employee</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{
margin:0;
font-family:Arial;
background:#f4f6f9;
}
.content{
margin-left:220px;
padding:0;
width:calc(100% - 220px);
}
.card{
border-radius:0;
margin:0;
height:calc(100vh - 60px);
}
table{
background:black;
color:white;
}
table th{
background:#000;
color:white;
}
table td{
background:#111;
color:white;
}
</style>
</head>
<body>

<?php include("../header.php"); ?>

<div class="content">

<div class="card shadow">

<div class="card-header bg-dark text-white">
<h4 class="mb-0">Add Employee</h4>
</div>

<div class="card-body">

<form id="empForm" style="max-width:500px;margin:auto;">

<div class="mb-3">
<label class="form-label">Name</label>
<input type="text" name="name" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Department</label>
<input type="text" name="department" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Salary</label>
<input type="number" name="basic_salary" class="form-control" required>
</div>

<button type="submit" class="btn btn-dark">Add Employee</button>

<a href="list.php" class="btn btn-secondary">Back</a>

</form>

</div>

</div>

</div>

<script>
document.getElementById("empForm").addEventListener("submit", function(add){
add.preventDefault();
var formData = new FormData(this);
formData.append("action","add");
var xhr = new XMLHttpRequest();
xhr.open("POST","../api/employee_api.php",true);
xhr.onload = function(){
if(xhr.status == 200){
var res = JSON.parse(xhr.responseText);
alert("Employee Added Successfully");
window.location = "list.php";
}
};
xhr.send(formData);
});
</script>

</body>
</html>