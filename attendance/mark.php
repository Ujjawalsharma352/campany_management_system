<?php
include("../config/db.php");
$employees = mysqli_query($conn,"SELECT * FROM employees");
?>

<!DOCTYPE html>
<html>

<head>

<title>Mark Attendance</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
margin:0;
font-family:Arial;
background:#f4f6f9;
}

.content{
margin-left:320px;
margin-top:12px;
padding:20px;
}

</style>

</head>

<body>

<?php include("../header.php"); ?>

<div class="content">

<h3 class="mb-4">Mark Attendance</h3>

<form id="attendanceForm">

<div class="mb-3">
<label>Select Date</label>
<input type="date" name="attendance_date" class="form-control" required>
</div>

<table class="table table-bordered bg-white">

<thead class="table-dark">
<tr>
<th>Employee</th>
<th>Status</th>
</tr>
</thead>

<tbody>

<?php while($emp = mysqli_fetch_assoc($employees)){ ?>

<tr>

<td>
<?php echo $emp['name']; ?>
<input type="hidden" name="employee_id[]" value="<?php echo $emp['id']; ?>">
</td>

<td>

<select name="status[]" class="form-control">

<option value="Present">Present</option>
<option value="Absent">Absent</option>

</select>

</td>

</tr>

<?php } ?>

</tbody>

</table>

<button type="submit" class="btn btn-primary">Save Attendance</button>

</form>

<div id="msg" class="mt-3"></div>

</div>

<script>

document.getElementById("attendanceForm").addEventListener("submit",function(e){

e.preventDefault();

var formData = new FormData(this);

formData.append("action","bulk_add");

var xhr = new XMLHttpRequest();

xhr.open("POST","../api/attendance_api.php",true);

xhr.onload = function(){

var res = JSON.parse(xhr.responseText);

if(res.status=="success"){

document.getElementById("msg").innerHTML=
"<div class='alert alert-success'>Attendance Saved</div>";

}

};

xhr.send(formData);

});

</script>

</body>
</html>