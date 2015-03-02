		<footer>
			<div class="container-fluid col-md-offset-1">
				<div class="row">
					<div class="col-md-3 col-md-offset-1">
						<address>
  							<strong class="footer-menu"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>, Inc.</strong><br>
  							<p class="text-muted footer-menu">上海 <strong><abbr title="Phone">P:</abbr> (123) 456-7890</strong></p>
						</address>
					</div>
					<div class="col-md-4 col-md-offset-3">
						<address>
  							<p class="text-muted footer-menu"><a href="#">诸君资讯</a> | <a href="#">工作机会</a> | <a href="#">联系我们</a></p>
  							<p class="text-muted footer-menu">京公安网安备 11010500896 京ICP备10214630</p>
						</address>
					</div>
					
				</div>
			</div>
		</footer>
	</div>
	</div>
	<script src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script>
  	  
		$(document).ready(function(){

			$('.explore-search').on('click',function(){
				$('.case-search-form').slideToggle('normal',function(){
					$('.case-second-menu').toggleClass('case-second-menu-border');
				});
				
			});

		});
	</script>
	</body>
</html>