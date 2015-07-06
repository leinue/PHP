<?php get_header(); ?>

<?php

$current_url=add_query_arg($wp->query_string,'',home_url($wp->request));
$currentPageName=explode("?pagename=",$current_url);
if(file_exists("wp-content/themes/uniguy2/singlepages/".$currentPageName[1].".php")){
	include("wp-content/themes/uniguy2/singlepages/".$currentPageName[1].".php");	
}else{
	include('wp-content/themes/uniguy2/singlepages/default.php');
}

?>

<?php get_footer(); ?>