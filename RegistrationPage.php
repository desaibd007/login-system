<?php
$insert = false;
$reerror = false;
$pass = false;
include 'connetionfile.php';

if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
	$password = $_POST['password'];
	$rpassword = $_POST['rpassword'];

	if ($password !== $rpassword) {
		$pass = true;
	}
		$sqlu = "SELECT * FROM singin WHERE email='$email' OR mobile='$mobile' ";
		$resultu = $conn->query($sqlu);
		if ($resultu->num_rows > 0) {
			$reerror = true;
		 }
}
		else {
			$sql = "INSERT INTO  `singin` (name,email,mobile,password,rpassword) 
        	VALUES ('$name','$email','$mobile','$password','$rpassword')";

			if ($conn->query($sql) === TRUE) {
				// echo "form is sumbited";
				$insert = true;
			} else {
				echo "server is not connected";
			}
		}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registration Form</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!------ Include the above in your HEAD tag ---------->

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
</head>

<body>
	<?php
	if ($pass) {
		echo "password is not same plase input same password";
	}
	if($reerror){
		echo "email or mobile no is alredy exist";
	}
	?>
	<div class="card bg-light">
		<article class="card-body mx-auto" style="max-width: 400px;">
			<h4 class="card-title mt-3 text-center">Create Account</h4>
			<p class="text-center">Get started with your free account</p>
			<p>
				<a href="https//www.google.com" class="btn btn-block btn-google"> <i class="bi bi-google"></i>   Login
					via google</a>
				<a href="https//www.facebook.com" class="btn btn-block btn-facebook"> <i class="fab fa-facebook-f"></i>
					Login via facebook</a>
			</p>
			<p class="divider-text">
				<span class="bg-light">OR</span>
			</p>
			<form method="post">
				<div class="form-group input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"> <i class="fa fa-user"></i> </span>
					</div>
					<input type="text" name="name" class="form-control" placeholder="Full name" required>
				</div> <!-- form-group// -->

				<div class="form-group input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
					</div>
					<input type="email" name="email" class="form-control" placeholder="Email address" required>
				</div> <!-- form-group// -->

				<div class="form-group input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"> <i class="fa fa-phone"></i> </span>
					</div>
					<!-- <select class="custom-select" style="max-width: 120px;">
			<option selected="">+971</option>
			<option value="1">+972</option>
			<option value="2">+198</option>
			<option value="3">+701</option>
		</select> -->
					<input type="number" name="mobile" class="form-control" placeholder="Phone number" required>
				</div> <!-- form-group// -->

				<!-- <div class="form-group input-group">
		<div class="input-group-prepend">
			<span class="input-group-text"> <i class="fa fa-building"></i> </span>
		</div>
		<select class="form-control">
			<option selected=""> Select job type</option>
			<option>Designer</option>
			<option>Manager</option>
			<option>Accaunting</option>
		</select> -->
				<!-- </div> form-group end.// -->

				<div class="form-group input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
					</div>
					<input type="password" name="password" class="form-control" placeholder="Create password" required>
				</div> <!-- form-group// -->

				<div class="form-group input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
					</div>
					<input class="form-control" placeholder="conform password" type="password" name="rpassword" required>
				</div> <!-- form-group// -->

				<div class="form-group">
					<button type="submit" name="submit" class="btn btn-primary btn-block"> Create Account </button>
				</div> <!-- form-group// -->

				<p class="text-center">Have an account? <a href="loginpage.php">Log In</a> </p>
			</form>
		</article>
	</div>
</body>

</html>