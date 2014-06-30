<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<!-- TemplateBeginEditable name="doctitle" -->
<title>无标题文档</title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
</head>

<body>
<?php 

if(trim($_POST['user'])=='' or trim($_POST['content'])=='')
{

?>

<form action="" method="post" name="guestbook">
	<p>XML-GUESTBOOK</p>
	User:<input name="user" type="text" maxlength="20" /><br />
	title:<input name="title" type="text" maxlength="5" /><br />
	comment:<textarea name="content" cols=60 rows=5></textarea><br />
	<input name="submit" type="submit" value="submit" />
</form>

<?php
}
else{
	header('content-type:application/xml;charset=utf-8');
	header('cache-control:no-cache,must-revalidate');
	header('expires:fir,14 mar 1980 20:53:00 GMT');
	header('last-modified: '.date('r'));
	header('pragma:no-cache');

	$dom=new DOMDocument('1.0');
	if(file_exists('guesebook.xml')){
		$gb=simplexml_load_file('guesebook.xml');
		foreach ($gb->item as $item) {
			$gbit_arry[]=(int)$item->id;
		}
		$gbid=max($gbit_arry)+1;
		$gb=dom_import_simplexml($gb);
		$gb=$dom->importnode($gb,true);
	}
	else{
		$gb=$dom->createelement('guestbook');
		$gbid=1;
	}
	$gb=$dom->appendchild($gb);
	$item=$dom->createelement("item");

	//id
	$id=$dom->createelement('id');
	$text=$dom->createtextnode($gbid);
	$id->appendchild($text);
	$id=$item->appendchild($id);

	$user=$dom->createelement('user');
	$text=$dom->createtextnode(trim($_POST['user']));
	$user->appendchild($text);
	$user=$item->appendchild($user);

	$item=$gb->appendchild($item);

	echo $dom->saveXML();
	$dom->save("guestbook.xml");
}
?>
</body>
</html>