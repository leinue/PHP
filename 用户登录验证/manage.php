<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>manage</title>
</head>

<body>

<?php
session_start();

if($_SESSION['admin']==1){
	echo 'welcom '.$_SESSION['user'].'<br />';
	echo '1.user managment<br />';
    echo '2.news management<br />';
    echo '3.ads management<br />';
    echo '4.nav managment<br />';
}
else
{
	echo 'sorry';
}
?>

</body>
</html>