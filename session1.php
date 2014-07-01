<?php
session_start();

$_SESSION['admin']=1;
echo "<a href='session2.php'>admin entrence</a>";
?>