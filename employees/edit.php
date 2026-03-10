<?php
session_start();
include("../config/db.php");

$id = $_GET['id'];
$result = mysqli_query($conn,"SELECT * FROM employees WHERE id=$id");
$data = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $basic_salary = $_POST['basic_salary'];

    mysqli_query($conn,"UPDATE employees SET 
        name='$name',
        email='$email',
        department='$department',
        basic_salary='$basic_salary'
        WHERE id=$id");

    header("Location: list.php");
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Employee</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<?php include("../header.php"); ?>

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-6">

<div class="card shadow">

<div class="card-header bg-warning text-dark">
<h4 class="mb-0">Edit Employee</h4>
</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">
<label class="form-label">Name</label>
<input type="text" name="name" class="form-control"
value="<?php echo $data['name']; ?>" required>
</div>

<div class="mb-3">
<label class="form-label">Email</label>
<input type="email" name="email" class="form-control"
value="<?php echo $data['email']; ?>" required>
</div>

<div class="mb-3">
<label class="form-label">Department</label>
<input type="text" name="department" class="form-control"
value="<?php echo $data['department']; ?>" required>
</div>

<div class="mb-3">
<label class="form-label">Salary</label>
<input type="number" name="basic_salary" class="form-control"
value="<?php echo $data['basic_salary']; ?>" required>
</div>

<button type="submit" name="update" class="btn btn-primary">
Update Employee
</button>

<a href="list.php" class="btn btn-secondary">
Back
</a>

</form>

</div>

</div>

</div>

</div>

</div>

</body>
</html>