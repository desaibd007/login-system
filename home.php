<?php
$insert=false;
$reerror=false;
$del=false;
include 'connetionfile.php';

if(isset($_POST['submit']))  {
    $title = $_POST['title'];
    $descri=$_POST['descri'];

    $sqlu = "SELECT * FROM note WHERE title='$title' OR descri='$descri' "; 
    $resultu = $conn->query($sqlu);
    if ($resultu->num_rows > 0) 
{
    $reerror=true;
}
else
{  
       $sql = "INSERT INTO  `note` (title,descri) 
        VALUES ('$title','$descri')"; 

            if ($conn->query($sql) === TRUE) {
                // echo "form is sumbited";
                $insert=true;
        }else {
            echo "server is not connected";
        }
}
}
        if(isset($_GET['id']))  {
        $id= $_GET['id'];
        $sql1 = "DELETE FROM note WHERE id='$id'";
        if ($conn->query($sql1) === TRUE) {
            $del=true;
        } else {
            echo "Error deleting record: " . $conn->error;
        }
            }        
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Note App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>


</head>


<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <a class="navbar-brand" href="index.php">NoteStore</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto ">
                <li class="nav-item active">
                    <a class="nav-link" href="regi.php">Registration User<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>
               
                <li class="nav-item">
                    <a class="nav-link" href="singup.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>

            <form class="form-inline my-3 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <div class="mt-3 pt-3">
        <?php
        if($insert){
            echo "<div id='myAlert' class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <strong>Note</strong> is successfully saved
                      </div>";
            
            echo "<script>
                // Function to hide the alert after a delay
                function hideAlert() {
                    var alertDiv = document.getElementById('myAlert');
                    alertDiv.style.transition = 'opacity 1s';
                    alertDiv.style.opacity = 0;
                    setTimeout(function () {
                        alertDiv.style.display = 'none';
                    }, 1000); // Adjust the time to match your animation duration
                }
                setTimeout(hideAlert, 3000);
            </script>";
            
        }

        if($reerror){
            function showAlertWithTimeout($message, $timeout = 0) {
                echo "<div id='myAlert' class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>Alert</strong> $message
                </div>";

                if ($timeout > 0) {
                    echo "<script>
                        setTimeout(function () {
                            var alertDiv = document.getElementById('myAlert');
                            alertDiv.style.transition = 'opacity 1s';
                            alertDiv.style.opacity = 0;
                            setTimeout(function () {
                                alertDiv.style.display = 'none';
                            }, 1000);
                        }, $timeout);
                    </script>";
                }
            }
            showAlertWithTimeout("This Note Or Description Already Registered", 3000); 
        }
        if($del){
        echo "<div id='myAlert' class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Alert!</strong> Your Note is deleted successfully.
        </div>";

        echo "<script>
            function hideAlert() {
                var alertDiv = document.getElementById('myAlert');
                alertDiv.classList.remove('show');
                setTimeout(function () {
                    alertDiv.style.display = 'none';
                }, 1000);
            }
            setTimeout(hideAlert, 3000);
            document.querySelector('.btn-close').addEventListener('click', function () {
                hideAlert();
            });
        </script>"; }

         ?>
    </div>
    <div class="my-3 pt-3">
        <div>
            <form method="post">
                <div class="form-group my-3">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp"
                        placeholder="Enter Title">
                </div>

                <div class="form-group my-3">
                    <label for="descri">Descripition</label>
                    <input type="text" class="form-control" name="descri" id="descri" rows="3"
                        placeholder="Enter Descripition"></textarea>
                </div>
                <div>
             <input type="submit" name="submit">
                </div>
            </form>
        </div>

        <div class="pt-3 ">
            <hr style="border-top: 3px solid #000;">

            <table class="table table-hover table-dark " id="myTable">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Title</th>
                        <th scope="col">Descripition</th>
                        <th scope="col">Date</th>
                        <th scope="col">Battons</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
        $query = "SELECT * from note ";
        $firms = $conn->query($query);
        $i=1;
    while ($firm = $firms->fetch_assoc()) { ?>
                    <tr>
                        <th>
                            <?php echo $i;  ?>
                        </th>
                        <td>
                            <?php  echo $firm['title'] ?>
                        </td>
                        <td>
                            <?php  echo $firm['descri'] ?>
                        </td>
                        <td>
                            <?php  echo $firm['date'] ?>
                        </td>
                        <td> <button><a href="index.php?id=<?php echo $firm['id'] ?>"
                                    style="text-decoration:none; color: rgb(250, 7, 7);">Delete</button></a>
                            <button><a href="update.php?iid=<?php echo $firm['id']; ?>" target="_blank"
                                    style="text-decoration: none; color:  rgb(90, 156, 23);">updated</button></a>
                        </td>
                    </tr>
                    <?php $i++; } ?>


                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script> let table = new DataTable('#myTable');</script>
</body>

</html>