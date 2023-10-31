<?php
include 'connetionfile.php';


if (isset($_GET['iid'])) {
    $id = $_GET['iid'];
}

if (isset($_POST['submit'])) {
    $id = $_GET['iid'];
    $title = $_POST['title'];
    $descri = $_POST['descri'];

    $sql5 = 'UPDATE note SET title="' . $title . '", descri="' . $descri . '"
        where `id`="' . $id . '"';

    $conn->query($sql5);
    if ($conn->query($sql5) === TRUE) {
        echo "<script>alert('Profile Update Sucessfully')</script>";
        $msg = 'Profile Update Sucessfully';
        $msgClass = '1';
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
$id = $_GET['iid'];
$sqlgt = "SELECT * FROM note WHERE id='$id'";
$resultgt = mysqli_query($conn, $sqlgt);
$firmgt = mysqli_fetch_array($resultgt);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">NoteStore</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto ">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Contact Us</a>
                </li>
            </ul>

            <form class="form-inline my-3 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>

    </nav>
    <div>
        <form method="post">
            <div class="form-group my-3">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp"
                    value="<?php echo $firmgt['title']; ?>" placeholder="Enter Title">
            </div>

            <div class="form-group my-3">
                <label for="descri">Descripition</label>
                <input type="text" class="form-control" class="form-control" name="descri" id="descri" rows="3"
                    value="<?php echo $firmgt['descri']; ?>" placeholder="Enter Descripition"></textarea>
            </div>
            <div>
                <input type="submit" name="submit">
            </div>
        </form>
    </div>
</body>

</html>