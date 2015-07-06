<?php get_header(); ?>

<?php

$current_url=add_query_arg($wp->query_string,'',home_url($wp->request));
$currentPageName=explode("?pagename=",$current_url);
include("wp-content/themes/uniguy2/singlepages/".$currentPageName[1].".php");

?>

<?php get_footer(); ?>