		$(document).ready(function(){
			$('li.menuHeader').css("opacity",'0.9');
			$('.random-area').css("opacity",'0.9');

			$('.tabContent:gt(0)').hide();
			$('.depot-type > li:eq(0)').addClass('active');
			$('.depot-type > li').click(showHideTabs);
			$('.depot-type > li').live('click',showHideTabs);

			$('.random-area').live('click',getData);
			$('.display-answer').live('click',displayAnswer);

			$('li.menuHeader').hover(
				function(){
					$(this).stop().animate({opacity:1},'slow');
				},
				function(){
					$(this).stop().animate({opacity:0.5},'slow');
				}
			);

			$('ul.menuItem').hide();
			$('li.menuHeader').hover(
				function(){
					$('ul',this).slideDown('fast');
				},
				function(){
					$('ul',this).slideUp('fast');
				}
			);

			function showHideTabs(){
				var allLI=$('.depot-type > li').removeClass('active');
				$(this).addClass('active');

				var index=allLI.index(this);
				$('.tabContent:visible').hide();
				$('.tabContent:eq('+index+')').show();
				$('.flag').html(index);
			}

			var flag='';
			var isSingle=true;
			var source='';
			var tmp='';

			function getData(){
				flag=$('.flag').text();
				if(flag=='0'){isSingle=true;}
				if(flag=='1'){isSingle=false;}
				var url='';
				if(isSingle){
					url='analysis.php?method=single';
				}else{
					url='analysis.php?method=multi';
				}
				console.log(url);
				$.get(
					url,
					{},
					function(data){
						console.log(data);
						source=data;

						var str= new Array();
						var alphaB=new Array('A','B','C','D');
						var i=0;

						str=data.split("<br />");
						for(i=0;i<=4;i++){
							var reg=new RegExp(alphaB[i],"g"); //创建正则RegExp对象
							tmp=str[1].replace(reg," ");
							if(tmp!=str[1]){
								break;
							}
						}
						tmp="<br />"+tmp+"<br />"+str[2]+"<br />"+str[3]+"<br />"+str[4]+"<br />"+str[5];
						if(isSingle){
							$('.single').html(tmp);
						}else{
							tmp=str[1];
							for(i=0;i<=4;i++){
								var reg=new RegExp(alphaB[i],"g"); 
								tmp=tmp.replace(reg," ");
								console.log(tmp);
							}
							tmp="<br />"+tmp+"<br />"+str[2]+"<br />"+str[3]+"<br />"+str[4]+"<br />"+str[5];
							$('.multi').html(tmp);
						}
					}
				);
				return false;
			}

			function displayAnswer(){
				if(isSingle){
					$('.single').html(source);
				}else{
					$('.multi').html(source);
				}
			}
		});