<!DOCTYPE html>
<html>
<head>
<title>Salary List</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
margin:0;
font-family:Arial;
background:#f4f6f9;
}

.content{
margin-left:220px;
margin-top:0;
padding:0;
width:calc(100% - 220px);
}

.card{
border-radius:0;
margin:0;
min-height:calc(100vh - 60px);
}

.card-body{
padding:20px;
}

table{
background:white;
color:black;
}

table th{
background:white;
color:black;
}

table td{
background:white;
color:black;
}

.table-responsive{
width:100%;
}
</style>

</head>

<body>

<?php include("../header.php"); ?>

<div class="content">

<div class="card shadow">

<div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
<h4 class="mb-0">Salary List</h4>

<a href="generate.php" class="btn btn-success">
Generate Salary
</a>
</div>

<div class="card-body">

<div class="mb-3" style="max-width:400px;">
<input type="text" 
id="searchInput" 
class="form-control" 
placeholder="Search by Employee Name or ID"
onkeyup="searchSalary()">
</button>
</div>


<div class="table-responsive">

<table class="table table-bordered table-striped table-hover" id="salaryTable">

<thead>
<tr>
<th>ID</th>
<th>Employee</th>
<th>Month</th>
<th>Year</th>
<th>Basic</th>
<th>Absent</th>
<th>Bonus</th>
<th>Deductions</th>
<th>Net Salary</th>
<th>Action</th>
</tr>
</thead>

<tbody>
</tbody>

</table>

</div>

</div>

</div>

</div>

<script>

var salaryData = [];

function loadSalary(){

var xhr = new XMLHttpRequest();

xhr.open("GET","../api/salary_api.php?action=fetch",true);

xhr.onload = function(){

salaryData = JSON.parse(xhr.responseText);

displaySalary(salaryData);

};

xhr.send();

}

function displaySalary(data){

var table = document.querySelector("#salaryTable tbody");

table.innerHTML = "";

for(var i=0;i<data.length;i++){

table.innerHTML += `
<tr>
<td>${data[i].id}</td>
<td>${data[i].name}</td>
<td>${data[i].month}</td>
<td>${data[i].year}</td>
<td>${data[i].basic}</td>
<td>${data[i].absent_days}</td>
<td>${data[i].bonus}</td>
<td>${data[i].deductions}</td>
<td>${data[i].net_salary}</td>
<td>
<button class="btn btn-danger btn-sm" onclick="deleteSalary(${data[i].id})">Delete</button>
</td>
</tr>`;
}

}

function searchSalary(){

var input = document.getElementById("searchInput").value.toLowerCase();

var filtered = salaryData.filter(function(s){

return s.name.toLowerCase().includes(input) ||
s.id.toString().includes(input);

});

displaySalary(filtered);

}

function deleteSalary(id){

if(confirm("Delete salary?")){

var xhr = new XMLHttpRequest();

xhr.open("POST","../api/salary_api.php",true);

xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

xhr.onload=function(){
loadSalary();
};

xhr.send("action=delete&id="+id);

}

}

loadSalary();

</script>

</body>
</html>