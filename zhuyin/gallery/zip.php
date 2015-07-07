
<?php

ini_set("memory_limit","1024M");
set_time_limit(0);

		function listImages($dir){
			$filer=array();
			if (is_dir($dir)) {
				if ($dh = opendir($dir)) {
					while (($file = readdir($dh)) !== false) {
						array_push($filer, $dir . '/' .$file);
				} closedir($dh);
				}
			}
			array_splice($filer, 0,2);
			return $filer;
    	}

$imglist=listImages("images/album/trip");

foreach ($imglist as $key => $value) {
	resizeImage($value,2000,1000,"images/album/tmp/$key",'.jpg');
}


    /**
         +------------------------------------------------------------------------------
         *                等比例压缩图片
         +------------------------------------------------------------------------------
         * @param String $src_imagename 源文件名        比如 “source.jpg”
         * @param int    $maxwidth      压缩后最大宽度
         * @param int    $maxheight     压缩后最大高度
         * @param String $savename      保存的文件名    “d:save”
         * @param String $filetype      保存文件的格式 比如 ”.jpg“
         * @author Yovae     <yovae@qq.com>
         * @version 1.0
         +------------------------------------------------------------------------------
         */
    function resizeImage($src_imagename,$maxwidth,$maxheight,$savename,$filetype)
    {
        $im=imagecreatefromjpeg($src_imagename);
        $current_width = imagesx($im);
        $current_height = imagesy($im);
     
        if(($maxwidth && $current_width > $maxwidth) || ($maxheight && $current_height > $maxheight))
        {
            if($maxwidth && $current_width>$maxwidth)
            {
                $widthratio = $maxwidth/$current_width;
                $resizewidth_tag = true;
            }
     
            if($maxheight && $current_height>$maxheight)
            {
                $heightratio = $maxheight/$current_height;
                $resizeheight_tag = true;
            }
     
            if($resizewidth_tag && $resizeheight_tag)
            {
                if($widthratio<$heightratio)
                    $ratio = $widthratio;
                else
                    $ratio = $heightratio;
            }
     
            if($resizewidth_tag && !$resizeheight_tag)
                $ratio = $widthratio;
            if($resizeheight_tag && !$resizewidth_tag)
                $ratio = $heightratio;
     
            $newwidth = $current_width * $ratio;
            $newheight = $current_height * $ratio;
     
            if(function_exists("imagecopyresampled"))
            {
                $newim = imagecreatetruecolor($newwidth,$newheight);
                   imagecopyresampled($newim,$im,0,0,0,0,$newwidth,$newheight,$current_width,$current_height);
            }
            else
            {
                $newim = imagecreate($newwidth,$newheight);
               imagecopyresized($newim,$im,0,0,0,0,$newwidth,$newheight,$current_width,$current_height);
            }
     
            $savename = $savename.$filetype;
            if(file_exists($savename)){
            	return false;
            }
            imagejpeg($newim,$savename);
            imagedestroy($newim);
        }
        else
        {
            $savename = $savename.$filetype;
            if(file_exists($savename)){
            	return false;
            }
            imagejpeg($im,$savename);
        }          
    }


?>

