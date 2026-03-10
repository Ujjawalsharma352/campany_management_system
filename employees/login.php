<?php
session_start();
include("../config/db.php");

if(isset($_POST['login'])){

$name = $_POST['name'];
$email = $_POST['email'];

$query = mysqli_query($conn,"
SELECT * FROM employees
WHERE name='$name' AND email='$email'
");

if(mysqli_num_rows($query) > 0){

$emp = mysqli_fetch_assoc($query);

$_SESSION['employee_id'] = $emp['id'];
$_SESSION['employee_name'] = $emp['name'];

header("Location: dashboard.php");
exit();

}else{

$error = "Invalid Name or Email";

}

}
?>

<!DOCTYPE html>
<html>
<head>
<title>Employee Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container">
<div class="row justify-content-center align-items-center vh-100">
<div class="col-md-4">

<div class="card shadow">
<div class="card-body">

<h4 class="text-center mb-4">Employee Login</h4>

<?php if(isset($error)){ ?>
<div class="alert alert-danger">
<?php echo $error; ?>
</div>
<?php } ?>

<form method="POST">

<div class="mb-3">
<label class="form-label">Name</label>
<input type="text" name="name" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="d-grid">
<button type="submit" name="login" class="btn btn-success">
Login
</button>
</div>

</form>

</div>
</div>

</div>
</div>
</div>

</body>
</html>