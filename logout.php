<?php
session_start();
session_unset();
session_destroy();
echo "<br> You are have been logged out";
header("location:index.php");
exit();
?>