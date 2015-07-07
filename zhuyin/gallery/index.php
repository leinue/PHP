<!DOCTYPE html >
<html>
    <head>
        <title>高一(7)班</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen"/>
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script src="js/cufon-yui.js" type="text/javascript"></script>
		<!-- // <script src="js/Quicksand_Book_400.font.js" type="text/javascript"></script> -->
		<script type="text/javascript">
			Cufon.replace('span,p,h1',{
				textShadow: '0px 0px 1px #ffffff'
			});
		</script>
        <style>
			span.reference{
				font-family:Arial;
				position:fixed;
				left:10px;
				bottom:10px;
				font-size:11px;
			}
			span.reference a{
				color:#aaa;
				text-decoration:none;
				margin-right:20px;
			}
			span.reference a:hover{
				color:#ddd;
			}
			.post{
				display: none;
			}
		</style>
    </head>

    <body>

    <?php
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

    	function listDiffType($type,$imgstyle=null){
    		$imgstyle=$imgstyle==null?'height:126px;width:150px;':$imgstyle;
    		$imglist=listImages("images/album/$type");
			foreach ($imglist as $key => $value) {
				echo "<img key=\"$key\" style=\"$imgstyle\" src=\"$value\" alt=\"$value\"/>";
			}
    	}

    ?>
		<div id="st_main" class="st_main">
			<img src="images/album/1.jpg" alt="" class="st_preview" style="display:none;"/>
			<div class="st_overlay"></div>
			<h1>高一(7)班</h1>
			<div id="st_loading" class="st_loading"><span>Loading...</span></div>
			<ul id="st_nav" class="st_navigation">
				<li class="album">
					<span class="st_link">军训<span class="st_arrow_down"></span></span>
					<div class="st_wrapper st_thumbs_wrapper">
						<div class="st_thumbs">
							<?php listDiffType("train"); ?>
						</div>
					</div>
				</li>
				<li class="album">
					<span class="st_link">运动会<span class="st_arrow_down"></span></span>
					<div class="st_wrapper st_thumbs_wrapper">
						<div class="st_thumbs">
							<?php listDiffType("sports"); ?>
						</div>
					</div>
					<div class="post">
						<ul>
							<li>hhhhhhhhhhh</li>
							<li>23333333333</li>
						</ul>
					</div>
				</li>
				<li class="album">
					<span class="st_link">在课堂<span class="st_arrow_down"></span></span>
					<div class="st_wrapper st_thumbs_wrapper">
						<div class="st_thumbs">
							<?php listDiffType("classes"); ?>
						</div>
					</div>					
				</li>
				<li class="album">
					<span class="st_link">远足拉链<span class="st_arrow_down"></span></span>
					<div class="st_wrapper st_thumbs_wrapper">
						<div class="st_thumbs">
							<?php listDiffType("trip"); ?>
						</div>
					</div>
				</li>
				<li class="album">
					<span class="st_link">听报告<span class="st_arrow_down"></span></span>
					<div class="st_wrapper st_thumbs_wrapper">
						<div class="st_thumbs">
							<?php listDiffType("reports"); ?>
						</div>
					</div>
				</li>
				<li class="album">
					<span class="st_link">班级活动<span class="st_arrow_down"></span></span>
					<div class="st_wrapper st_thumbs_wrapper">
						<div class="st_thumbs">
							<?php listDiffType("activities",'height:100%;width100%;'); ?>
						</div>
					</div>
				</li>
				<li>
					<span class="st_link">其它<span class="st_arrow_down"></span></span>
					<div class="st_about st_thumbs_wrapper">
						<div class="st_subcontent">
							<p>
								我们是七班的，We are 伐木累
							</p>
						</div>
					</div>
				</li>
			</ul>
		</div>

        <div>
            <span class="reference">
            	<a href="http://www.ivydom.com">Developed by xieyang</a>
                <a href="http://ivydom.com">Graduated in 2014 at Lianyungang Foreign Languages School,Studying in NCU now.</a>
            </span>
		</div>

        <!-- The JavaScript -->
        <script type="text/javascript">
            $(function() {
				//the loading image
				var $loader		= $('#st_loading');
				//the ul element 
				var $list		= $('#st_nav');
				//the current image being shown
				var $currImage 	= $('#st_main').children('img:first');
				
				//let's load the current image 
				//and just then display the navigation menu
				$('<img>').load(function(){
					$loader.hide();
					$currImage.fadeIn(3000);
					//slide out the menu
					setTimeout(function(){
						$list.animate({'left':'0px'},500);
					},
					1000);
				}).attr('src',$currImage.attr('src'));
				
				//calculates the width of the div element 
				//where the thumbs are going to be displayed
				buildThumbs();
				
				function buildThumbs(){
					$list.children('li.album').each(function(){
						var $elem 			= $(this);
						var $thumbs_wrapper = $elem.find('.st_thumbs_wrapper');
						var $thumbs 		= $thumbs_wrapper.children(':first');
						//each thumb has 180px and we add 3 of margin
						var finalW 			= $thumbs.find('img').length * 183;
						$thumbs.css('width',finalW + 'px');
						//make this element scrollable
						makeScrollable($thumbs_wrapper,$thumbs);
					});
				}
				
				//clicking on the menu items (up and down arrow)
				//makes the thumbs div appear, and hides the current 
				//opened menu (if any)
				$list.find('.st_arrow_down').live('click',function(){
					var $this = $(this);
					hideThumbs();
					$this.addClass('st_arrow_up').removeClass('st_arrow_down');
					var $elem = $this.closest('li');
					$elem.addClass('current').animate({'height':'170px'},200);
					var $thumbs_wrapper = $this.parent().next();
					$thumbs_wrapper.show(200);
				});
				$list.find('.st_arrow_up').live('click',function(){
					var $this = $(this);
					$this.addClass('st_arrow_down').removeClass('st_arrow_up');
					hideThumbs();
				});
				
				//clicking on a thumb, replaces the large image
				$list.find('.st_thumbs img').bind('click',function(){
					if($('.st_description')!='undefined'){
						$('.st_description').remove();
					}
					var $this = $(this);
					$loader.show();
					$('<img class="st_preview"/>').load(function(){
						var $this = $(this);
						var $currImage = $('#st_main').children('img:first');
						$this.insertBefore($currImage);
						$loader.hide();
						$currImage.fadeOut(2000,function(){
							$(this).remove();
						});
					}).attr('src',$this.attr('alt'));

					var thisParent=$(this).parent().parent();
					var post=thisParent.next();
					if(post.length!=0){
						var myIndex=$(this).attr('key');
						myIndex=parseInt(myIndex)+1;
						var postli=post.find('ul li:nth-child('+myIndex+')');
						data=postli.html();
						if(data!=null){
							$('body').append('<div style="display:block;position:absolute;width:100%;" class="st_about st_thumbs_wrapper st_description"><div class="st_subcontent"><p>'+data+'</p></div></div>');								
						}
					}
				}).bind('mouseenter',function(){
					$(this).stop().animate({'opacity':'1'});
				}).bind('mouseleave',function(){
					$(this).stop().animate({'opacity':'0.7'});
				});
				
				//function to hide the current opened menu
				function hideThumbs(){
					$list.find('li.current')
						 .animate({'height':'50px'},400,function(){
							$(this).removeClass('current');
						 })
						 .find('.st_thumbs_wrapper')
						 .hide(200)
						 .andSelf()
						 .find('.st_link span')
						 .addClass('st_arrow_down')
						 .removeClass('st_arrow_up');
				}

				//makes the thumbs div scrollable
				//on mouse move the div scrolls automatically
				function makeScrollable($outer, $inner){
					var extra 			= 800;
					//Get menu width
					var divWidth = $outer.width();
					//Remove scrollbars
					$outer.css({
						overflow: 'hidden'
					});
					//Find last image in container
					var lastElem = $inner.find('img:last');
					$outer.scrollLeft(0);
					//When user move mouse over menu
					$outer.unbind('mousemove').bind('mousemove',function(e){
						var containerWidth = lastElem[0].offsetLeft + lastElem.outerWidth() + 2*extra;
						var left = (e.pageX - $outer.offset().left) * (containerWidth-divWidth) / divWidth - extra;
						$outer.scrollLeft(left);
					});
				}
            });
        </script>
    </body>
</html>
