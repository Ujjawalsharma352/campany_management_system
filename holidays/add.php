<!DOCTYPE html>
<html>
<head>
<title>Add Holiday</title>
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
padding:0;
width:calc(100% - 220px);
transition:0.3s;
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

<?php include("../header.php"); ?>

<div class="content">

<div class="card shadow">

<div class="card-header bg-dark text-white">
<h4 class="mb-0">Add Holiday</h4>
</div>

<div class="card-body">

<form id="holidayForm" >

<div class="mb-3">
<label class="form-label">Holiday Title</label>
<input type="text" id="holiday_name" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Holiday Date</label>
<input type="date" id="holiday_date" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Sunday</label>
<input type="number" id="sunday" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Saturday</label>
<input type="number" id="saturday" class="form-control" required>
</div>

<button type="submit" class="btn btn-dark">Add Holiday</button>

<a href="list.php" class="btn btn-secondary">Back</a>

</form>

<div id="message" class="mt-3"></div>

</div>

</div>

</div>

<script>
document.getElementById("holidayForm").addEventListener("submit", function(e){

e.preventDefault();

var name = document.getElementById("holiday_name").value;
var date = document.getElementById("holiday_date").value;
var sunday = document.getElementById("sunday").value;
var saturday = document.getElementById("saturday").value;

var xhr = new XMLHttpRequest();

xhr.open("POST","../api/holiday_api.php",true);

xhr.setRequestHeader("Content-Type","application/json");

xhr.onload = function(){
if(xhr.status === 200){
alert("Holiday Added Successfully");
window.location="list.php";
}
};

xhr.send(JSON.stringify({
action:"add",
holiday_name:name,
holiday_date:date,
sunday:sunday,
saturday:saturday
}));

});
</script>

</body>
</html>