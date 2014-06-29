<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
</head>

<body>
<input type="button" name="alert" value="test" onClick="alert('alert')">

hello,world

<?php 
echo "hello world! <br />";
?>

<p>GET</p>
<form name="news" action="news.php" method="get">
please enter number<br />
<input name="id" type="text" width="60"><br />
please enter key<br />
<input name="keyword" type="text" width="60"><br />
<input name="ok" type="submit" value="submit" />
</form>

<p>POST</p>
<form name="news" action="news.php" method="post">
please enter number<br />
<input name="title" type="text" width="60"><br />
please enter key<br />
<input name="content" type="text" width="60"><br />
<input name="ok" type="submit" value="submit" />
</form>

</body>
</html>
