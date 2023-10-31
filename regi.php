<?php
session_start();
include 'connetionfile.php';
function GetSpId()
{
    $sp_id = "BW" . rand(199999, 999999);
    return $sp_id;
}
if (isset($_POST['submit'])) {
    $pwd1 = $_POST['pass'];
    // $pwd = md5($pwd1);
    $pwd2 = $_POST['pass1'];
    // $pwd3 = md5($pwd2);
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $spid = $_POST['sponsor'];
    $isd = "";
    $bsc = "";
    $userid = GetSpId();
    $datetime = date_create()->format('Y-m-d');



    $sqlu = "SELECT * FROM users_table WHERE userid='$spid'";
    $resultu = $conn->query($sqlu);
    if ($resultu->num_rows > 0) {

        $sql = "INSERT INTO users_table ( `name`, `email`, `pwd`, `country`, `phone`, `sponerid`, `userid`, `package`,  `level`, `active`, `datetime`, `date`)
            VALUES ('$name', '$email', '$pwd1', '', '$phone', '$spid', '$userid','0','1','D', '$datetime','$datetime')"; 
        if ($conn->query($sql) === TRUE) {


            $actch = "SELECT *  FROM `users_table` WHERE userid='$userid'";
            $resulttch = mysqli_query($conn, $actch);
            $fd = mysqli_fetch_array($resulttch);
            $cid = $fd['customer_id'];
            session_start();
            $_SESSION['dtuserid'] = $fd['userid'];
            $_SESSION['dtusr_id'] = $fd['customer_id'];
            $_SESSION['name'] = $name;

            $spids = $spid;
            for ($i = 1; $i <= 5; $i++) {

                $sqlut1 = "SELECT * FROM users_table WHERE  userid='$spids'";
                $resultut1 = mysqli_query($conn, $sqlut1);
                $firmut1 = mysqli_fetch_array($resultut1);
                $userids1 = $spids;
                $ids = $firmut1['customer_id'];
                if ($ids == "") {
                    break;
                }
                $spids = $firmut1['sponerid'];
                $sql7 = "INSERT INTO tree (`cid`, `level`, `csid`)
                    					        VALUES ('$ids', '$i', '$cid')";
                if ($conn->query($sql7) === TRUE) {
                }
            }



            // $to = $email;
            // $subject = "Thanks For Successfully Registration";
            // $txt = "Hello $name, Thanks Your For Successfully Registration.Your Userid Is:$userid And Pass:$pwd1";
            // $headers = "From: info@demo.world";
            // mail($to, $subject, $txt, $headers);


            echo "<script>alert('Congratulations Your Successfully Signup Your Useris Is:$userid And Pass:$pwd1');</script>";


            // echo ("<SCRIPT LANGUAGE='JavaScript'>window.location.href='index.php'; </SCRIPT>");

            echo ("<SCRIPT LANGUAGE='JavaScript'>window.location.href='index.php'; </SCRIPT>");
        }
    } else {

        echo "<script>alert('This Sponser Id Is Not Valid.');</script>";
    }
}

$spname = "";
if (isset($_GET['refid'])) {
    $spid = $_GET['refid'];
    $actch = "SELECT *  FROM `users_table` WHERE userid='$spid'";
    $resulttch = mysqli_query($conn, $actch);
    $firmtch = mysqli_fetch_array($resulttch);
    $spname = $firmtch['name'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $tital ?> - Sign up
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>

<body>
    <div class="row g-3 align-items-center">
    <h1>Regitration Form</h1>
    <form method="post">
        <div class="col-auto">
            <label for="name" class="col-form-label">Enter your Name:-</label>
            <input type="text" name="name" class="form-control" placeholder="Enter your Name" id="name" aria-describedby=" ">

        </div>
        <div class="col-auto">
            <label for="email" class="col-form-label">Email address:-</label>
            <input type="email" name="email" class="form-control" placeholder="Enter your Email" id="email" aria-describedby=" ">
        </div>

        <div class="col-auto">
            <label for="psss" class="col-form-label">Password</label>
            <input type="password" name="pass" placeholder="make a password" class="form-control" id="pass" aria-describedby=" ">
        </div>

        <div class="col-auto">
            <label for="pass1" class="col-form-label">Confirm Password</label>
            <input type="password" name="pass1" placeholder="confirm password " class="form-control" id="pass1" aria-describedby=" ">
        </div>

        <div class="col-auto">
            <label for="sponsor" class="col-form-label">Referal ID</label>
            <input type="text" name="sponsor" <?php if (isset($_GET['refid'])) { ?> value="<?php echo $_GET['refid']; ?>" readonly <?php } ?> class="form-control"  placeholder="Referal ID" required>
        </div>

        <div class="col-auto">
            <label for="phone" class="col-form-label">Phone No:-</label>
            <input type="number" name="phone" placeholder="Enter your phone No" class="form-control" id="phone" aria-describedby=" ">
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
</body>

</html>