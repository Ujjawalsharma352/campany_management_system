<!DOCTYPE html>
<html>
<head>

<title>Holiday List</title>

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

.table{
width:100%;
}
</style>

</head>

<body>

<?php include("../header.php"); ?>

<div class="content">

<div class="card shadow">

<div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">

<h4 class="mb-0">Holiday List</h4>

<a href="add.php" class="btn btn-success btn-sm">Add Holiday</a>

</div>

<div class="card-body">

<table class="table table-bordered table-striped" id="holidayTable">

<thead class="table-dark">

<tr>
<th>Title</th>
<th>Date</th>
<th>Action</th>
</tr>

</thead>

<tbody></tbody>

</table>

</div>

</div>

</div>

<script>

document.addEventListener("DOMContentLoaded", function(){
loadHolidays();
});

function loadHolidays(){

var xhr = new XMLHttpRequest();

xhr.open("GET","../api/holiday_api.php?action=fetch",true);

xhr.onload = function(){

if(xhr.status === 200){

var data = JSON.parse(xhr.responseText);

var tbody = document.querySelector("#holidayTable tbody");

tbody.innerHTML = "";

for(var i=0;i<data.length;i++){

tbody.innerHTML += `
<tr>
<td>${data[i].holiday_name}</td>
<td>${data[i].holiday_date}</td>
<td>
<button class="btn btn-danger btn-sm" onclick="deleteHoliday(${data[i].id})">
Delete
</button>
</td>
</tr>
`;

}

}

};

xhr.send();

}

function deleteHoliday(id){

if(confirm("delete this holiday...")){

var xhr = new XMLHttpRequest();

xhr.open("POST","../api/holiday_api.php",true);

xhr.setRequestHeader("Content-Type","application/json");

xhr.onload = function(){

if(xhr.status === 200){

loadHolidays();

}

};

xhr.send(JSON.stringify({
action:"delete",
id:id
}));

}

}

</script>

</body>
</html>