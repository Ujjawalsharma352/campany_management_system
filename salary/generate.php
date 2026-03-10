<?php
include("../config/db.php");
$employees = mysqli_query($conn,"SELECT * FROM employees");
?>

<!DOCTYPE html>
<html>
<head>
<title>Generate Salary</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
margin:0;
font-family:Arial;
background:#f4f6f9;
}

.content{
margin-left:220px;
margin-top:12px;
padding:0;
width:calc(100% - 220px);
}

.card{
border-radius:0;
margin:0;
}

.card-header{
border-radius:0;
}
</style>

</head>

<body>

<?php include("../header.php"); ?>

<div class="content">

<div class="card shadow">

<div class="card-header bg-dark text-white">
Generate Salary
</div>

<div class="card-body p-4">

<form id="salaryForm">

<div class="mb-3">
<label>Employee</label>
<select name="employee_id" class="form-control">
<?php while($emp=mysqli_fetch_assoc($employees)){ ?>
<option value="<?php echo $emp['id']; ?>">
<?php echo $emp['name']; ?>
</option>
<?php } ?>
</select>
</div>

<div class="mb-3">
<label>Month</label>
<input type="number" name="month" class="form-control" required>
</div>

<div class="mb-3">
<label>Year</label>
<input type="number" name="year" class="form-control" required>
</div>

<div class="mb-3">
<label>Bonus</label>
<input type="number" name="bonus" class="form-control" value="0">
</div>

<div class="mb-3">
<label>Other Deduction</label>
<input type="number" name="deductions" class="form-control" value="0">
</div>

<button type="submit" class="btn btn-primary">
Generate Salary
</button>

</form>

<div id="msg" class="mt-3"></div>

</div>
</div>

</div>

<script>

document.getElementById("salaryForm").addEventListener("submit",function(e){

e.preventDefault();

var formData = new FormData(this);

formData.append("action","add");

var xhr = new XMLHttpRequest();

xhr.open("POST","../api/salary_api.php",true);

xhr.onload = function(){

var res = JSON.parse(xhr.responseText);

if(res.status=="success"){

document.getElementById("msg").innerHTML="<div class='alert alert-success'>Salary Generated</div>";

}

};

xhr.send(formData);

});

</script>

</body>
</html>