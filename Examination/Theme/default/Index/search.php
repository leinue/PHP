<?php require('header.php'); ?>

	<section>
		<div class="search_top">
			<div class="search_title">
				<h1>搜索</h1>
			</div>
			<div class="search_input">
				<input class="the_input" style="width:60%;" type="search" placeholder="请输入搜索内容">
				<a class="the_btn light_blue black_color no_radius" id="search_btn">搜索</a>
			</div>
			<div class="search_result">
				<div class="memo-top-box">
					
						
					</div>
				</div>
			</div>
		</div>
	</section>
	<script type="text/javascript">
		$(document).ready(function(){
			var docHeight=$(document).height();
			var headerHeight=$('header').height();
			var footerheight=$('footer').height();

			$('body').css('background','#FAFAFA');
			$('footer').css({
				'position':'fixed',
				'bottom':'0',
				'width':'100%'
			});
			
			$('.search_top').css({
				'margin-top':(docHeight)/2-$('.search_top').height()-50
			});

			$('#search_btn').click(function(){
				
				$('.search_top').css({
					'margin-top':$('header').height()
				});
				
				$('.memo-top-box').append('<div class="memo-content"><div class="memo-box"><div class="memo-left"><div class="memo-left-img"><a href=""><img style="opacity: 0.9;"src="http://i62.tinypic.com/k3qj53.jpg,http://i58.tinypic.com/2j2gjex.jpg,http://i58.tinypic.com/2j2gjex.jpg"alt="暂无图片数据"height="90"width="160"></a></div></div><div class="memo-right"><div style="opacity: 0.5;"class="memo-right-head"><a href="38">白头发桐人和黑头发桐人</a></div><div style="opacity: 0.5;"class="memo-right-desc">你更喜欢哪个?<span style="opacity: 0.5;"class="memo-time">2015-03-07 13:33:19</span></div><div style="opacity: 0.5;"class="memo-right-tags">刀剑神域,SAO,人渣诚,桐谷和人,重度网络游戏玩家</div></div></div></div>');
				$('.memo-top-box').append('<div class="memo-content"><div class="memo-box"><div class="memo-left"><div class="memo-left-img"><a href=""><img style="opacity: 0.9;"src="http://i62.tinypic.com/k3qj53.jpg,http://i58.tinypic.com/2j2gjex.jpg,http://i58.tinypic.com/2j2gjex.jpg"alt="暂无图片数据"height="90"width="160"></a></div></div><div class="memo-right"><div style="opacity: 0.5;"class="memo-right-head"><a href="38">白头发桐人和黑头发桐人</a></div><div style="opacity: 0.5;"class="memo-right-desc">你更喜欢哪个?<span style="opacity: 0.5;"class="memo-time">2015-03-07 13:33:19</span></div><div style="opacity: 0.5;"class="memo-right-tags">刀剑神域,SAO,人渣诚,桐谷和人,重度网络游戏玩家</div></div></div></div>');
				$('.memo-top-box').append('<div class="memo-content"><div class="memo-box"><div class="memo-left"><div class="memo-left-img"><a href=""><img style="opacity: 0.9;"src="http://i62.tinypic.com/k3qj53.jpg,http://i58.tinypic.com/2j2gjex.jpg,http://i58.tinypic.com/2j2gjex.jpg"alt="暂无图片数据"height="90"width="160"></a></div></div><div class="memo-right"><div style="opacity: 0.5;"class="memo-right-head"><a href="38">白头发桐人和黑头发桐人</a></div><div style="opacity: 0.5;"class="memo-right-desc">你更喜欢哪个?<span style="opacity: 0.5;"class="memo-time">2015-03-07 13:33:19</span></div><div style="opacity: 0.5;"class="memo-right-tags">刀剑神域,SAO,人渣诚,桐谷和人,重度网络游戏玩家</div></div></div></div>');
				$('.memo-top-box').append('<div class="memo-content"><div class="memo-box"><div class="memo-left"><div class="memo-left-img"><a href=""><img style="opacity: 0.9;"src="http://i62.tinypic.com/k3qj53.jpg,http://i58.tinypic.com/2j2gjex.jpg,http://i58.tinypic.com/2j2gjex.jpg"alt="暂无图片数据"height="90"width="160"></a></div></div><div class="memo-right"><div style="opacity: 0.5;"class="memo-right-head"><a href="38">白头发桐人和黑头发桐人</a></div><div style="opacity: 0.5;"class="memo-right-desc">你更喜欢哪个?<span style="opacity: 0.5;"class="memo-time">2015-03-07 13:33:19</span></div><div style="opacity: 0.5;"class="memo-right-tags">刀剑神域,SAO,人渣诚,桐谷和人,重度网络游戏玩家</div></div></div></div>');
				$('.memo-top-box').append('<div class="memo-content"><div class="memo-box"><div class="memo-left"><div class="memo-left-img"><a href=""><img style="opacity: 0.9;"src="http://i62.tinypic.com/k3qj53.jpg,http://i58.tinypic.com/2j2gjex.jpg,http://i58.tinypic.com/2j2gjex.jpg"alt="暂无图片数据"height="90"width="160"></a></div></div><div class="memo-right"><div style="opacity: 0.5;"class="memo-right-head"><a href="38">白头发桐人和黑头发桐人</a></div><div style="opacity: 0.5;"class="memo-right-desc">你更喜欢哪个?<span style="opacity: 0.5;"class="memo-time">2015-03-07 13:33:19</span></div><div style="opacity: 0.5;"class="memo-right-tags">刀剑神域,SAO,人渣诚,桐谷和人,重度网络游戏玩家</div></div></div></div>');
				$('.memo-top-box').append('<div class="memo-content"><div class="memo-box"><div class="memo-left"><div class="memo-left-img"><a href=""><img style="opacity: 0.9;"src="http://i62.tinypic.com/k3qj53.jpg,http://i58.tinypic.com/2j2gjex.jpg,http://i58.tinypic.com/2j2gjex.jpg"alt="暂无图片数据"height="90"width="160"></a></div></div><div class="memo-right"><div style="opacity: 0.5;"class="memo-right-head"><a href="38">白头发桐人和黑头发桐人</a></div><div style="opacity: 0.5;"class="memo-right-desc">你更喜欢哪个?<span style="opacity: 0.5;"class="memo-time">2015-03-07 13:33:19</span></div><div style="opacity: 0.5;"class="memo-right-tags">刀剑神域,SAO,人渣诚,桐谷和人,重度网络游戏玩家</div></div></div></div>');
				$('.memo-top-box').append('<div class="memo-content"><div class="memo-box"><div class="memo-left"><div class="memo-left-img"><a href=""><img style="opacity: 0.9;"src="http://i62.tinypic.com/k3qj53.jpg,http://i58.tinypic.com/2j2gjex.jpg,http://i58.tinypic.com/2j2gjex.jpg"alt="暂无图片数据"height="90"width="160"></a></div></div><div class="memo-right"><div style="opacity: 0.5;"class="memo-right-head"><a href="38">白头发桐人和黑头发桐人</a></div><div style="opacity: 0.5;"class="memo-right-desc">你更喜欢哪个?<span style="opacity: 0.5;"class="memo-time">2015-03-07 13:33:19</span></div><div style="opacity: 0.5;"class="memo-right-tags">刀剑神域,SAO,人渣诚,桐谷和人,重度网络游戏玩家</div></div></div></div>');
				$('.memo-top-box').append('<div class="memo-content"><div class="memo-box"><div class="memo-left"><div class="memo-left-img"><a href=""><img style="opacity: 0.9;"src="http://i62.tinypic.com/k3qj53.jpg,http://i58.tinypic.com/2j2gjex.jpg,http://i58.tinypic.com/2j2gjex.jpg"alt="暂无图片数据"height="90"width="160"></a></div></div><div class="memo-right"><div style="opacity: 0.5;"class="memo-right-head"><a href="38">白头发桐人和黑头发桐人</a></div><div style="opacity: 0.5;"class="memo-right-desc">你更喜欢哪个?<span style="opacity: 0.5;"class="memo-time">2015-03-07 13:33:19</span></div><div style="opacity: 0.5;"class="memo-right-tags">刀剑神域,SAO,人渣诚,桐谷和人,重度网络游戏玩家</div></div></div></div>');
				$('.memo-top-box').append('<div class="memo-content"><div class="memo-box"><div class="memo-left"><div class="memo-left-img"><a href=""><img style="opacity: 0.9;"src="http://i62.tinypic.com/k3qj53.jpg,http://i58.tinypic.com/2j2gjex.jpg,http://i58.tinypic.com/2j2gjex.jpg"alt="暂无图片数据"height="90"width="160"></a></div></div><div class="memo-right"><div style="opacity: 0.5;"class="memo-right-head"><a href="38">白头发桐人和黑头发桐人</a></div><div style="opacity: 0.5;"class="memo-right-desc">你更喜欢哪个?<span style="opacity: 0.5;"class="memo-time">2015-03-07 13:33:19</span></div><div style="opacity: 0.5;"class="memo-right-tags">刀剑神域,SAO,人渣诚,桐谷和人,重度网络游戏玩家</div></div></div></div>');
				$('.memo-top-box').append('<div class="memo-content"><div class="memo-box"><div class="memo-left"><div class="memo-left-img"><a href=""><img style="opacity: 0.9;"src="http://i62.tinypic.com/k3qj53.jpg,http://i58.tinypic.com/2j2gjex.jpg,http://i58.tinypic.com/2j2gjex.jpg"alt="暂无图片数据"height="90"width="160"></a></div></div><div class="memo-right"><div style="opacity: 0.5;"class="memo-right-head"><a href="38">白头发桐人和黑头发桐人</a></div><div style="opacity: 0.5;"class="memo-right-desc">你更喜欢哪个?<span style="opacity: 0.5;"class="memo-time">2015-03-07 13:33:19</span></div><div style="opacity: 0.5;"class="memo-right-tags">刀剑神域,SAO,人渣诚,桐谷和人,重度网络游戏玩家</div></div></div></div>');

				var searchResultHeight=$('.search_result').height();
				if(searchResultHeight>docHeight-headerHeight-footerheight){
					$('footer').css({
						'position':'relative',
						'margin-top':''
					});
				}
			});
		});
	</script>

<?php require('footer.php'); ?>	