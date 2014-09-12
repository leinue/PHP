<!DOCTYPE html>
<html lang="zh-cn">
 	<head>
 		<title>xieyang's word list</title>
		<link href="style/load_csv_css.css" rel="stylesheet">
		
		<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.0.js"></script>
 		
 		<script type="text/javascript">

			$(document).ready(function(){

				$(".mainlist").click(function(){
					var isUp="down";

					var idValue=$(this).attr('id');
					
					if(isUp=="down"){
						$("#"+idValue).slideUp()("slow");
						alert("#"+idValue);
						var t=setTimeout("$('"+"#"+idValue+"').stop()",330);
						isUp="up";
					}
					
					/*if(isUp=="up"){
						$("#"+idValue).slideDown("slow");
						var t=setTimeout("$('"+"#"+idValue+"').stop()",330);
						isUp="down";
					}*/
    				
  				});
			});

		</script>

 	</head>
	<body>
<?php

header("Content-Type:text/html;charset=gbk");
//mysql_query("set names utf-8")

echo '<h1>XieYang\'s word list</h1>';

try {
	$fp=fopen("words_list_2014-09-12-10-20-06.csv",'r');
} catch (Exception $e) {
	$e->getMessage();
}

$index=1;

while ($data=fgetcsv($fp)) {
	//$functionName='getID()'; onclick=\"$functionName\"
	echo "<div class=\"mainlist\" id=\"$index\">";
	foreach ($data as $key => $value) {
		if($key==0){
			echo "<span>NO.$index</span><br><span class=\"content\">$value</span><br>";
		}else{
			echo "<span class=\"content\">$value</span><br>";
		}
	}
	echo "</div>";
	$index++;
}

fclose($fp);

?>
	<body>
</html>
