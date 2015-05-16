<?php require('header.php'); ?>

	<section>
		<div class="introduction-home">
			<div style="background:url(images/support.jpg) repeat center center / cover transparent!important;" class="cg"></div>
		</div>
			<div class="cont">
				
				<div style="background-color: #F17B73;height:270px;" class="cont_box">
					<a class="link_home" href=""></a>
					<h1 class="title_home">Works</h1>
					<p class="descr_home">Works Medical Sport Center è il nuovo centro polivalente specializzato in diagnostica, fisioterapia,</p>
			    </div>
			   
			   	<div style="background-color: #77BCAF;height:270px;" class="cont_box cont_box_color" id="works_c">
					<a class="link_home" href=""></a>
					<img class="img_home" src="images/azienda_home.png" height="100" width="100">  
					<h2 class="descr_home2"><span>Works</span><br>Phylosophy &amp; Structure<br><br>View more information</h2>
				</div>
				
				<div style="height: 270px;background-color:#445E9F" class="cont_box cont_box_color" id="facebook_c">
					<a class="link_home" href="" target="_blank"></a>
					<img class="img_home" src="images/facebook_home.png" height="100" width="100">
					<h2 class="descr_home2"><span>Facebook</span><br>Like Us<br><br>Visit us on Facebook</h2>
			   </div>

			</div>
		</div>
	</section>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$('footer').css('margin-top',$('.cont_box').height());
			console.log($('.cont_box').height());
		});
	</script>

<?php require('footer.php'); ?>
