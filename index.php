<?php
session_start();
include 'connetionfile.php';
if (isset($_POST['Signin'])) {
    $a = $_POST['email'];
    $b = $_POST['pwd'];
    $b = md5($b);
    $date = date_create()->format('d-m-Y');
    $sqlu = "SELECT * FROM users_table WHERE  email='$a' AND pwd='$b'"; 
    $resultu = $conn->query($sqlu);
    if ($resultu->num_rows > 0) {
      echo  $sql = "SELECT * FROM users_table WHERE email='$a' AND pwd='$b'";
        $result = mysqli_query($conn, $sql);
        $firm = mysqli_fetch_array($result);
        $customer_id = $firm['customer_id'];
        $status = $firm['active'];
        $userid = $firm['userid'];

        $id= $_SESSION['dtusr_id'] = $customer_id;
        $_SESSION['dtuserid'] = $firm['userid']; 
        echo ("<SCRIPT LANGUAGE='JavaScript'>window.location.href='https://castorcredit.com/dashboard/home.php';</SCRIPT>");
    } else {
        echo "<script>alert('Invalid Login Details Username Or Password')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container-lg my-4">
        <h2>Note Store Login or Registration</h2>
<form method="post">
  <!-- Email input -->
  <div class="form-outline my-4">
  <label class="form-label" for="email">Email address</label>
    <input type="email" id="email" name="email" placeholder="Enter Your Email or User ID" class="form-control" />
    
  </div>

  <!-- Password input -->
  <div class="form-outline my-4">
  <label class="form-label" for="pwd">Password</label>
    <input type="password" name="pwd" id="pwd" placeholder="Enter your password" class="form-control" />
    
  </div>

  <!-- 2 column grid layout for inline styling -->
  <div class="row mb-4">
    
    <div class="col">
      <!-- Simple link -->
      <a href="#!">Forgot password?</a>
    </div>
  </div>

  <!-- Submit button -->
  <input type="submit" name="Signin" class="btn btn-primary btn-block mb-4">

  <!-- Register buttons -->
  <div class="text-center">
    <p>Not a member?<br><a href="regi.php">Register</a></p>
    <p>or sign up with</p>

    <button type="button" class="btn btn-link btn-floating mx-1">
      <i class="fab fa-facebook-f"></i>
    </button>

    <button type="button" class="btn btn-link btn-floating mx-1">
      <i class="fab fa-google"></i>
    </button>

    <button type="button" class="btn btn-link btn-floating mx-1">
      <i class="fab fa-twitter"></i>
    </button>

    <button type="button" class="btn btn-link btn-floating mx-1">
      <i class="fab fa-github"></i>
    </button>
  </div>
</form>
</div>
</body>

</html>