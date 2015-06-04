<?php

function my_scandir($dir)  
{  
    $files = array();  
    if ( $handle = opendir($dir) ) {  
        while ( ($file = readdir($handle)) !== false )   
        {  
            if ( $file != ".." && $file != "." )   
            {  
                if ( is_dir($dir . "/" . $file) )   
                {  
                    $files[$file] = my_scandir($dir . "/" . $file);  
                }  
                else   
                {  
                    $files[] = $file;  
                }  
            }  
        }  
        closedir($handle);  
        return $files;  
    }  
}

$result = my_scandir('./');
print_r($result);

?>