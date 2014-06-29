/*receive data by GET*/

<?php

if(trim($_GET['id']))
	{echo "id=".$_GET['id'];}
if(trim($_GET['keyword']))
	{echo "keyword=".$_GET['keyword'];}
?>

/*receive data by POST*/

<?php 
if(trim($_POST['title']))
    {echo "title=".$_POST['title'];}
if(trim($_POST['content']))
	{echo "content=".$_POST['content'];}
 ?>