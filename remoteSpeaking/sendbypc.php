<?php

require('function.php');

$content=test_input($_GET['c']);

echo sendbypc($content);

?>