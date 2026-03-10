<!DOCTYPE html>
<html>
<head>
<title>Employees</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
margin:0;
font-family:Arial;
background:#f4f6f9;
}

.sidebar{
width:220px;
height:100vh;
background:#2c3e50;
position:fixed;
left:0;
top:0;
transition:0.3s;
padding-top:20px;
}

.sidebar a{
display:block;
color:white;
padding:12px 20px;
text-decoration:none;
}

.sidebar a:hover{
background:#34495e;
}

.header{
height:60px;
background:#2c3e50;
color:white;
padding:15px;
margin-left:220px;
display:flex;
align-items:center;
transition:0.3s;
}

.header button{
margin-right:15px;
padding:5px 10px;
}

.content{
margin-left:220px;
padding:20px;
width:calc(100% - 220px);
transition:0.3s;
}

.sidebar.collapsed{
left:-220px;
}

.sidebar.collapsed + .header{
margin-left:0;
}

.sidebar.collapsed ~ .content{
margin-left:0;
width:100%;
}

</style>
</head>

<body>

<div class="sidebar" id="sidebar">
<a href="../admin/dashboard.php">Dashboard</a>
<a href="../employees/list.php">Employees</a>
<a href="../holidays/list.php">Holidays</a>
<a href="../salary/list.php">Salaries</a>
<a href="../attendance/list.php">Attendance</a>
<a href="../admin/logout.php">Logout</a>
</div>

<div class="header">
<button onclick="toggleSidebar()">☰</button>
<h5 class="mb-0">Admin Panel</h5>
</div>

<div class="content">

<div class="card shadow">

<div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
<h4 class="mb-0">Employees</h4>
<a href="add.php" class="btn btn-success btn-sm">Add Employee</a>
</div>

<div class="card-body">

<div class="row mb-3">

<div class="col-md-2">
<select id="limitSelect" class="form-control" onchange="changeLimit()">
       <option value="5">Show 5</option>
<option value="10">Show 10</option>
<option value="25">Show 25</option>
<option value="50">Show 50</option>
<option value="100">Show 100</option>
</select>
</div>

<div class="col-md-4">
<input type="text"
id="searchInput"
class="form-control"
placeholder="Search by Name or ID"
onkeyup="searchEmployee()">
</div>

<div class="col-md-3">
c

</div>

<table class="table table-bordered table-striped" id="empTable">

<thead class="table-dark">
<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Department</th>
<th>Salary</th>
<th>Action</th>
</tr>
</thead>

<tbody>
</tbody>

</table>

<nav>
<ul class="pagination justify-content-center" id="pagination">
</ul>
</nav>

</div>
</div>
</div>

<script>

function toggleSidebar(){
document.getElementById("sidebar").classList.toggle("collapsed");
}

var employeeData = [];
var filteredData = [];
var currentPage = 1;
var rowsPerPage = 10;

function loadEmployees(){

var xhr = new XMLHttpRequest();

xhr.open("GET","../api/employee_api.php?action=fetch",true);

xhr.onload = function(){

if(xhr.status == 200){

employeeData = JSON.parse(xhr.responseText);
filteredData = employeeData;

displayEmployees();

}

};

xhr.send();

}

function displayEmployees(){

var tbody = document.querySelector("#empTable tbody");
tbody.innerHTML = "";

var start = (currentPage - 1) * rowsPerPage;
var end = start + rowsPerPage;

var paginatedItems = filteredData.slice(start,end);

paginatedItems.forEach(function(emp){

tbody.innerHTML += `
<tr>
<td>${emp.id}</td>
<td>${emp.name}</td>
<td>${emp.email}</td>
<td>${emp.department}</td>
<td>${emp.basic_salary}</td>
<td>
<a href="edit.php?id=${emp.id}" class="btn btn-primary btn-sm">Edit</a>
<button class="btn btn-danger btn-sm" onclick="deleteEmp(${emp.id})">Delete</button>
</td>
</tr>
`;

});

setupPagination();

}

function setupPagination(){

var pagination = document.getElementById("pagination");
pagination.innerHTML = "";

var pageCount = Math.ceil(filteredData.length / rowsPerPage);

pagination.innerHTML += `
<li class="page-item ${currentPage==1?'disabled':''}">
<a class="page-link" href="#" onclick="changePage(${currentPage-1})">Prev</a>
</li>
`;

pagination.innerHTML += `
<li class="page-item disabled">
<span class="page-link">Page ${currentPage} of ${pageCount}</span>
</li>
`;

pagination.innerHTML += `
<li class="page-item ${currentPage==pageCount?'disabled':''}">
<a class="page-link" href="#" onclick="changePage(${currentPage+1})">Next</a>
</li>
`;

}

function changePage(page){

var pageCount = Math.ceil(filteredData.length / rowsPerPage);

if(page < 1 || page > pageCount){
return;
}

currentPage = page;
displayEmployees();

}

function searchEmployee(){

var input = document.getElementById("searchInput").value.toLowerCase();
var department = document.getElementById("departmentFilter").value.toLowerCase();

filteredData = employeeData.filter(function(emp){

var matchText = false;
emp.name.toLowerCase().includes(input) ||
emp.id.toString().includes(input);

var matchDept =
department === "" || emp.department.toLowerCase() === department;

return matchText && matchDept;

});

currentPage = 1;
displayEmployees();

}

function changeLimit(){

rowsPerPage = parseInt(document.getElementById("limitSelect").value);

currentPage = 1;

displayEmployees();

}

function deleteEmp(id){

if(confirm("Are you sure you want to delete?")){

var xhr = new XMLHttpRequest();

xhr.open("POST","../api/employee_api.php",true);

xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

xhr.onload = function(){

if(xhr.status == 200){

alert("Deleted Successfully");
loadEmployees();

}

};

xhr.send("action=delete&id=" + id);

}

}

loadEmployees();

</script>

</body>
</html>