
<section>
	<div style="margin-top:100px;border:none;" class="news-block">
		<ul style="left: 0px;" id="st_nav" class="st_navigation">
			<li style="height: 170px; display: list-item;" class="album current">
				<div style="overflow: hidden; display: block;" class="st_wrapper st_thumbs_wrapper">
					<div style="width: 366px;" class="st_thumbs">
					<?php
						$allCateIds=get_all_category_ids();
				        foreach($allCateIds as $v){
				            $cat_info=get_category($v);
				            if($cat_info->parent!='0'){
				            	$parent_info=get_category($cat_info->parent);
				            	if($parent_info->name=='news'){
				            		$link=get_category_link($cat_info->term_id)."?$cat_info->term_id";
				     				//echo "<li>
									// 	<a href=\"$link\"><img src=\"$cat_info->description\"></a>
									// 	<span class=\"help-block\"><a href=\"$link\">$cat_info->name</a></span>
									// </li>";
									echo "<div href=\"$link\" class=\"news-cate-link\"><img style=\"height: 126px; width: 150px; opacity: 0.7;\" src=\"$cat_info->description\" alt=\"$cat_info->name\"><a style=\"color:rgb(100,100,100)\" href=\"$link\">$cat_info->name</a></div>";
				            	}
				            }
				        }
					?>
					</div>
				</div>
			</li>
		</ul>
	</div>

	


	<div style="margin-top:100px;padding:10px;" class="post-block">

	<?php
		$previous_year = $year = 0;
		$previous_month = $month = 0;
		$ul_open = false;

		$myposts = get_posts('numberposts=10&orderby=post_date&order=DESC');
	?>

	<?php foreach($myposts as $post) : ?>

		<?php if($post->post_status!='publish'){continue;} ?>

	<?php
		setup_postdata($post);
		$year = mysql2date('Y', $post->post_date);
		$month = mysql2date('n', $post->post_date);
		$day = mysql2date('j', $post->post_date);
	?>

	<?php if($year != $previous_year || $month != $previous_month) : ?>

	<?php if($ul_open == true) : ?>
	<?php endif; ?>
	<?php $ul_open = true; ?>
	<?php endif; ?>
	<?php $previous_year = $year; $previous_month = $month; ?>

			<ul class="latest-post">
				<li class="post-detail">
					<div class="post-title"><a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a></div>
					<div class="post-content">
						<?php the_excerpt(); ?>
					</div>
					<div class="post-more">
						<ul>
							<li class="post-time"><?php the_author(); ?> 发表于 <?php the_time('Y年m月d日'); ?></li>
							<li class="post-comment">更改于 <?php echo $post->post_date_gmt; ?></li>
						</ul>
					</div>
				</li>
			</ul>

	<?php endforeach; ?>
		
		<ul class="pagation">
			<li><?php previous_posts_link('上一页'); ?></li>
			<li><?php next_posts_link('下一页'); ?></li>
		</ul>
	</div>
</section>

<script type="text/javascript">
	$(document).ready(function(){

		var $list = $('#st_nav');

		$('.news-block').css('margin-top','0px');
		$('.post-block').css('margin-top','0px');

		var newCateCount=$('.news-block ul li').length;

		$('.news-block ul li').mouseenter(function(){
			if(newCateCount>6){
				$(this).scrollLeft(200);
			}
		});
		
		if(newCateCount>6){
			for (var i = 7; i < newCateCount+1; i++) {
				$('.news-block ul li:nth-child('+i+')').hide();
			};
		}

		$list.find('.st_thumbs img').bind('mouseenter',function(){
			$(this).stop().animate({'opacity':'1'});
		}).bind('mouseleave',function(){
			$(this).stop().animate({'opacity':'0.7'});
		});

		buildThumbs();
				
		function buildThumbs(){
			$list.children('li.album').each(function(){
				var $elem 			= $(this);
				var $thumbs_wrapper = $elem.find('.st_thumbs_wrapper');
				var $thumbs 		= $thumbs_wrapper.children(':first');
				//each thumb has 180px and we add 3 of margin
				var finalW 			= $thumbs.find('img').length * 190;
				$thumbs.css('width',finalW + 'px');
				//make this element scrollable
				makeScrollable($thumbs_wrapper,$thumbs);
			});
		}

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

		$('.st_thumbs div.news-cate-link').click(function(){
			var href=$(this).attr('href');
			window.location.href=href;
		});
	});
</script>
