<?php

class ashu_option_class{

	var $options;
	var $pageinfo;
	var $database_options;
	var $saved_optionname;
	
	//类的构建函数
	function ashu_option_class($options, $pageinfo) {
		$this->options = $options;
		$this->pageinfo = $pageinfo;
		$this->make_data_available(); //准备设置选项数据

		add_action( 'admin_menu', array(&$this, 'add_admin_menu') );
		
		if( isset($_GET['page']) && ($_GET['page'] == $this->pageinfo['filename']) ) {
			//加载css js
			add_action('admin_init', array(&$this, 'enqueue_head'));	
		}
	}
	
	function enqueue_head() {
		//加载的js路径
		wp_enqueue_script('ashu_options_js', get_bloginfo( 'stylesheet_directory' ).'/ashu_options.js'); 
		wp_enqueue_style('ashu_options_css', get_bloginfo( 'stylesheet_directory' ).'/ashu_options.css');
		// echo "<script>alert('".TEMJS_URI."')</script>";
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
	}
	
	//创建菜单项函数
	function add_admin_menu() {
		//添加顶级菜单项
		$top_level = "UniguyIT设置";
		if(!$this->pageinfo['child']) {
			add_menu_page($top_level, $top_level, 'edit_themes', $this->pageinfo['filename'], array(&$this, 'initialize'),'',6);
			define('TOP_LEVEL_BASEAME', $this->pageinfo['filename']);
		}else{
			add_submenu_page(TOP_LEVEL_BASEAME, $this->pageinfo['full_name'], $this->pageinfo['full_name'], 'edit_themes', $this->pageinfo['filename'], array(&$this, 'initialize'));
		}
	}
	
	function make_data_available() {
		global $ashu_option; //申明全局变量
		
		foreach ($this->options as $option) {
			if( isset($option['std']) ) {
				$ashu_option_std[$this->pageinfo['optionname']][$option['id']] = $option['std'];
			}
		}
		//选项组名称
		$this->saved_optionname = 'ashu_'.$this->pageinfo['optionname'];
		$ashu_option[$this->pageinfo['optionname']] = get_option($this->saved_optionname);
		
		//合并数组
		$ashu_option[$this->pageinfo['optionname']] = array_merge((array)$ashu_option_std[$this->pageinfo['optionname']], (array)$ashu_option[$this->pageinfo['optionname']]);
		
		//html实体转换
		$ashu_option[$this->pageinfo['optionname']] = $this->htmlspecialchars_deep($ashu_option[$this->pageinfo['optionname']]);
	
	}
	
	//使用递归将预定义html实体转换为字符
	function htmlspecialchars_deep($mixed, $quote_style = ENT_QUOTES, $charset = 'UTF-8') {
	    if (is_array($mixed) || is_object($mixed)) {
	        foreach($mixed as $key => $value) {
	            $mixed[$key] = $this->htmlspecialchars_deep($value, $quote_style, $charset);
	        }
	    }
	    elseif (is_string($mixed)) {
	        $mixed = htmlspecialchars_decode($mixed, $quote_style);
	    }
	    return $mixed;
	} 
	
	function initialize() {
		$this->get_save_options();
		$this->display();
	}
	
	//显示表单项函数
	function display() {	
		$saveoption = false;
		echo '<div class="wrap">';
		echo '<div class="icon32" id="icon-options-general"><br/></div>';
		echo '<h2>'.$this->pageinfo['full_name'].'</h2>';
		echo '<form method="post" action="">';
		
		//根据选项类型执行对应函数
		foreach ($this->options as $option) {
			if (method_exists($this, $option['type'])) {
				$this->$option['type']($option);
				$saveoption = true;
			}
		}
		if($saveoption) {
			echo '<p class="submit">';
			echo '<input type="hidden" value="1" name="save_my_options"/>';
			echo '<input type="submit" name="Submit" class="button-primary autowidth" value="保存设置" /></p>';
		}
		echo '</form></div>';
	}
	
	//更新数据
	function get_save_options() {
		$options = $newoptions  = get_option($this->saved_optionname);
		if ( isset( $_POST['save_my_options'] ) ) {
			echo '<div class="updated fade" id="message" style=""><p><strong>保存成功</strong></p></div>';
			$opion_count = 0;
			foreach ($_POST as $key => $value) {
				if( preg_match("/^(numbers_)/", $key, $result) ){
					$numbers = explode( ',', $value );
					$newoptions[$key] = $numbers;
				}elseif( preg_match("/^(tinymce_)/", $key, $result) ){
					$value = stripslashes($value);
					$newoptions[$key] = $value;
				}elseif( preg_match("/^(checkbox_)/", $key, $result) ){
					$newoptions[$key] = $value;
				}else{
					$value = stripslashes($value);
					$newoptions[$key] = htmlspecialchars($value, ENT_QUOTES,"UTF-8");
				}
			}
		}
			
		if ( $options != $newoptions ) {
			$options = $newoptions;
			update_option($this->saved_optionname, $options);
		}
		
		if($options) {
			foreach ($options as $key => $value) {
				$options[$key] = empty($options[$key]) ? false : $options[$key];
			}
		}
		
		$this->database_options = $options;
	}
	
	/************开头***************/
	function open($values) {
		if(!isset($values['desc'])) $values['desc'] = "";
		
		echo '<table class="widefat">';
		echo '<thead><tr><th colspan="2">'.$values['desc'].'&nbsp;</th></tr></thead>';
	}
	
	/***************结尾**************/
	function close($values) {
		echo '<tfoot><tr><th>&nbsp;</th><th>&nbsp;</th></tr></tfoot></table>';
	}

	/**********标题***********************/
	function title($values) {
		echo '<h3>'.$values['name'].'</h3>';
		if (isset($values['desc'])) echo '<p>'.$values['desc'].'</p>';
	}

	/*****************************文本域**********************************/
	function textarea($values) {
		if(isset($this->database_options[$values['id']]))
			$values['std'] = $this->database_options[$values['id']];

		echo '<tr valign="top" >';
		echo '<th scope="row" width="200px">'.$values['name'].'</th>';
		echo '<td>'.$values['desc'].'<br/>';
		echo '<textarea name="'.$values['id'].'" cols="60" rows="7" id="'.$values['id'].'" style="width: 80%; font-size: 12px;" class="code">';
		echo $values['std'].'</textarea><br/>';
	    echo '<br/></td>';
		echo '</tr>';
	}
	
	/*********************文本框**************************/
	function text($values) {	
		if(isset($this->database_options[$values['id']])) $values['std'] = $this->database_options[$values['id']];
		
		echo '<tr valign="top" >';
		echo '<th scope="row" width="200px">'.$values['name'].'</th>';
		echo '<td>'.$values['desc'].'<br/>';
		echo '<input type="text" size="'.$values['size'].'" value="'.$values['std'].'" id="'.$values['id'].'" name="'.$values['id'].'"/>';
	    echo '<br/><br/></td>';
		echo '</tr>';
	}
	

	/**************复选框*******************/
	function checkbox($values) {
		if(isset($this->database_options[$values['id']])) $values['std'] = $this->database_options[$values['id']];
		
		echo '<tr valign="top">';
		echo '<th scope="row" width="200px">'.$values['name'].'</th>';
		echo '<td>'.$values['desc'].'<br/>';
		
		foreach( $values['buttons'] as $key=>$value ) {
			$checked ="";
			if( is_array($values['std']) && in_array($key,$values['std'])) {
				$checked = 'checked = "checked"';
			}

			echo '<input '.$checked.' type="checkbox" class="kcheck" value="'.$key.'" name="'.$values['id'].'[]"/>'.$value;
		}

		
		echo '<label for="'.$values['id'].'">'.$values['desc'].'</label><br/>';
	    echo '<br/></td>';
		echo '</tr>';
	}

	/**********************单选框******************************/
	function radio($values) {
		if(isset($this->database_options[$values['id']])) $values['std'] = $this->database_options[$values['id']];
		
		echo '<tr valign="top" >';
		echo '<th scope="row" width="200px">'.$values['name'].'</th>';
		echo '<td>'.$values['desc'].'<br/>';
		
		foreach($values['buttons'] as $key=>$value) {	
			$checked ="";
			if(isset($values['std']) && ($values['std'] == $key)) {
				$checked = 'checked = "checked"';
			}
		
			echo '<p><input '.$checked.' type="radio" class="kcheck" value="'.$key.'" name="'.$values['id'].'"/>';
			echo '<label for="'.$values['id'].'">'.$value.'</label></p>';
		}
		
	    echo '<br/></td>';
		echo '</tr>';
	}
	/*****************数组***********************/
	function numbers_array($values){
		if(isset($this->database_options[$values['id']]))
			$values['std'] = $this->database_options[$values['id']];
		else
			$values['std']=array();

		$nums = implode( ',', $values['std'] );
		
		echo '<tr valign="top" >';
		echo '<th scope="row" width="200px">'.$values['name'].'</th>';
		echo '<td>'.$values['desc'].'<br/>';
		echo '<input type="text" size="'.$values['size'].'" value="'.$nums.'" id="'.$values['id'].'" name="'.$values['id'].'"/>';
	    echo '<br/><br/></td>';
		echo '</tr>';
	}

	/********************下拉框*********************/
	function dropdown($values) {	
		if(!isset($this->database_options[$values['id']]) && isset($values['std'])) $this->database_options[$values['id']] = $values['std'];
				
		echo '<tr valign="top" >';
		echo '<th scope="row" width="200px">'.$values['name'].'</th>';
		echo '<td>'.$values['desc'].'<br/>';
		
			if($values['subtype'] == 'page') {
				$select = 'Select page';
				$entries = get_pages('title_li=&orderby=name');
			}else if($values['subtype'] == 'sidebar'){
				global $wp_registered_sidebars;
				$select = 'Select a special sidebar';
				$entries = $wp_registered_sidebars;
			}else if($values['subtype'] == 'cat'){
				$select = 'Select category';
				$entries = get_categories('title_li=&orderby=name&hide_empty=0');
			}
			else
			{	
				$select = 'Select...';
				$entries = $values['subtype'];
			}
		
			echo '<select class="postform" id="'. $values['id'] .'" name="'. $values['id'] .'"> ';
			echo '<option value="">'.$select .'</option>  ';

			foreach ($entries as $key => $entry) {
				if($values['subtype'] == 'page')
				{
					$id = $entry->ID;
					$title = $entry->post_title;
				}else if($values['subtype'] == 'cat'){
					$id = $entry->term_id;
					$title = $entry->name;
				}else if($values['subtype'] == 'sidebar'){
					$id = $entry['id'];
					$title = $entry['name'];
				}
				else
				{
					$id = $key;	
					$title = $entry;		
				}

				if ($this->database_options[$values['id']] == $id )
				{
					$selected = "selected='selected'";	
				}
				else
				{
					$selected = "";		
				}
				
				echo"<option $selected value='". $id."'>". $title."</option>";
			}
		
		echo '</select>';
		 
	    echo '<br/><br/></td>';
		echo '</tr>';
	}
	
	/*******************上传*****************************/
	function upload($values) {	
		$prevImg = '';
		if(isset($this->database_options[$values['id']])) $values['std'] = $this->database_options[$values['id']];
		if($values['std'] != ''){$prevImg = '<img  src='.$values['std'].' alt="" />';}
		
		echo '<tr valign="top" >';
		echo '<th scope="row" width="200px">'.$values['name'].'</th>';
		echo '<td>';
		echo '<div class="preview_pic_optionspage" id="'.$values['id'].'_div">'.$prevImg.'</div>';
		echo $values['desc'].'<br/>';
		echo '<input type="text" size="60" value="'.$values['std'].'" name="'.$values['id'].'" class="upload_pic_input" />';
		echo '&nbsp;<a onclick="return false;" title="" class="k_hijack button thickbox" id="'.$values['id'].'" href="media-upload.php?type=image&amp;hijack_target='.$values['id'].'&amp;TB_iframe=true">插入图片</a>';
		
	    echo '<br/><br/></td>';
		echo '</tr>';
	}
	//编辑器
	function tinymce($values){
		if(isset($this->database_options[$values['id']]))
			$values['std'] = $this->database_options[$values['id']];

		echo '<tr valign="top" >';
		echo '<th scope="row" width="200px">'.$values['name'].'</th>';
		echo '<td>'.$values['desc'].'<br/>';
		wp_editor( $values['std'], $values['id'],$settings=array('tinymce'=>1,'media_buttons'=>0,) );
	    echo '<br/></td>';
		echo '</tr>';
	}
	//button
	function button($values){
		if(isset($this->database_options[$values['id']]))
			$values['std'] = $this->database_options[$values['id']];
		echo '<tr valign="top" >';
		echo '<th scope="row" width="200px">'.$values['name'].'</th>';
		echo '<td>'.$values['desc'].'<br/>';
		echo '<input type="button" onclick="'.$values['onclick'].'" id="'.$values['id'].'" class="button" value="'.$values['std'].'" />';
	    echo '<br/></td>';
		echo '</tr>';
	}

}
?>

<?php

/************************************PAGE INDEX******************************************/
  
$pageinfo = array('full_name' => 'UniguyIT选项', 'optionname'=>'ashu', 'child'=>false, 'filename' => basename(__FILE__));   
  
$options = array();
               
$options[] = array( "type" => "open");   
  
$options[] = array(    
                "name"=>"基本设置",   
                "desc"=>"这里可以设置一些基本信息",   
                "type" => "title");
                   
// $options[] = array(   
//                 "name"=>"文本框",   
//                 "id"=>"_ashu_text",   
//                 "std"=>"UniguyIT文本输入框",   
//                 "desc"=>"UniguyIT版权所有",   
//                 "size"=>"60",   
//                 "type"=>"text"  
//             );   
  
// $options[] = array(   
//                 "name"=>"页脚版权",
//                 "id"=>"uniguy_copy_right",   
//                 "std"=>"<p>上海<span class=\"help\">诸君信息科技</span>有限公司，保留业务与网站的最终解释权，<span class=\"help\">2008-2015</span></p><p>上海市 闵行区 <span class=\"help\">罗锦路55号C座210</span></p><p>QQ: <span class=\"help\">2208934488</span> , 微信: <span class=\"help\">uniguy</span> , 电邮: <span class=\"help\">service@uniguyit.com</span></p>",   
//                 "desc"=>"支持html,如果不懂html可只更改中文文字",   
//                 "size"=>"60",   
//                 "type"=>"textarea"  
//             );   
  
$options[] = array(   
            "name" => "网站Logo",   
            "desc" => "请上传一个图片或填写一个图片地址,建议大小:128*128",   
            "std"=>"http://localhost/wordpress/wp-content/themes/uniguy2/brand.png",   
            "id" => "site_logo",   
            "type" => "upload");

$options[] = array(   
            "name" => "首页背景图",   
            "desc" => "请上传一个图片或填写一个图片地址,建议大小:1440*1200",   
            "std"=>"http://localhost/wordpress/wp-content/themes/uniguy2/imgs/home.jpg",   
            "id" => "home_bg",   
            "type" => "upload");           
  
// $options[] = array(  "name" => "单选框",   
//             "desc" => "请选择",   
//             "id" => "_ashu_radio",   
//             "type" => "radio",   
//             "buttons" => array('Yes','No'),   
//             "std" => 1);   
  
// $options[] = array( "name" => "复选框",   
//             "desc" => "请选择",   
//             "id" => "checkbox_ashu",   //id必须以checkbox_开头
//             "std" => 1,  
// 			"buttons" => array('汽车','自行车','三轮车','公交车'), 			
//             "type" => "checkbox");   
               
// $options[] = array( "name" => "页面下拉框",   
//             "desc" => "请选择一个页面",   
//             "id" => "_ashu_page_select",   
//             "type" => "dropdown",   
//             "subtype" => 'page'   
//             );   
  
// $options[] = array( "name" => "分类下拉框",   
//             "desc" => "请选择大杂烩页面",   
//             "id" => "_ashu_cate_select",   
//             "type" => "dropdown",   
//             "subtype" => 'cat'   
//             );

// $options[] = array( "name" => "分类下拉框",   
//             "desc" => "请选择大杂烩页面",   
//             "id" => "_ashu_side_select",   
//             "type" => "dropdown",   
//             "subtype" => 'sidebar'   
//             );   
               
// $options[] = array( "name" => "下拉框",   
//             "desc" => "请选择",   
//             "id" => "_ashu_select",   
//             "type" => "dropdown",   
//             "subtype" => array(   
//                 '苹果'=>'apple',   
//                 '香蕉'=>'banana',   
//                 '桔子'=>'orange'   
//                 )   
//             );
			
$options[] = array(   
            "name" => "页脚版权",   
            "desc" => "这里可更改页脚的版权信息,建议使用文本模式进行编辑,否则会出现html标签错误",   
            "id" => "tinymce_uniguy_copy_right",   //id必须以 tinymce_开头
            "std"=>"<p>上海<span class=\"help\">诸君信息科技</span>有限公司，保留业务与网站的最终解释权，<span class=\"help\">2008-2015</span></p><p>上海市 闵行区 <span class=\"help\">罗锦路55号C座210</span></p><p>QQ: <span class=\"help\">2208934488</span> , 微信: <span class=\"help\">uniguy</span> , 电邮: <span class=\"help\">service@uniguyit.com</span></p>",   
            "type" => "tinymce"  
            );

// $options[] = array(   
//             "name" => "数组信息",   
//             "desc" => "请输入一组id，以英文分号隔开，例如 1,2,3",   
//             "id" => "numbers_ashu", //id必须以 numbers_开头
// 			"size"=>60,
//             "std" => "",
//             "type" => "numbers_array"  
//             ); 			
               
$options[] = array( "type" => "close");

/************************************PAGE SERVICE******************************************/
  
$options_page = new ashu_option_class($options, $pageinfo);

$subpageinfo = array('full_name' => '服务页面设置', 'optionname'=>'service', 'child'=>true, 'filename' => basename(__FILE__).'-case');   

$options = array();
               
$options[] = array( "type" => "open");   
  
$options[] = array(
                "name"=>"基本设置",   
                "desc"=>"这里可以设置一些基本信息",   
                "type" => "title");

$options[] = array(   
                "name"=>"大标题",   
                "id"=>"service_big_title",   
                "std"=>"我们的服务",   
                "desc"=>"显示在服务页面的大标题",   
                "size"=>"60",   
                "type"=>"text"  
            );

$options[] = array(   
                "name"=>"中标题",   
                "id"=>"service_medium_title",   
                "std"=>"每一点凝聚的强大，处处尽现",   
                "desc"=>"显示在服务页面的中标题",   
                "size"=>"60",   
                "type"=>"text"  
            );

$options[] = array(   
                "name"=>"详细描述",   
                "id"=>"service_small_title",   
                "std"=>"优雅的设计带来令人耳目一新的感觉，与此同时，又会让人倍感亲切。你日常所用的 app 增加了新的功能，而今愈加强大",   
                "desc"=>"显示在服务页面的详细描述",   
                "size"=>"60",   
                "type"=>"textarea"
            );

$options[] = array(   
            "name" => "服务页小图",   
            "desc" => "请上传一个图片或填写一个图片地址,建议大小:240*240",   
            "std"=>"http://images.apple.com/v/osx/c/images/overview/hero_icon_large.png",   
            "id" => "service_small_img",   
            "type" => "upload");

$options[] = array(   
            "name" => "首页背景图",   
            "desc" => "请上传一个图片或填写一个图片地址,建议大小:1440*1200",   
            "std"=>"http://images.apple.com/v/osx/c/images/overview/hero_large.jpg",   
            "id" => "service_bg",   
            "type" => "upload");

$options[] = array(   
                "name"=>"宣传板数量",   
                "id"=>"service_pa_count",   
                "std"=>"3",   
                "desc"=>"宣传板数量",   
                "size"=>"60",   
                "type"=>"text"  
            );

/*************宣传版面1**************/

$options[] = array( "name" => "宣传板1是否可视",   
            "desc" => "",   
            "id" => "checkbox_service_pa1_visibile",   //id必须以checkbox_开头
            "std" => 1,  
			"buttons" => array('可视'), 			
            "type" => "checkbox");

$options[] = array(   
                "name"=>"宣传版面1-大标题",   
                "id"=>"propaganda1_big_title",   
                "std"=>"蛤蛤蛤蛤蛤蛤蛤蛤",   
                "desc"=>"显示在宣传版面1的大标题",   
                "size"=>"60",   
                "type"=>"text"  
            );

$options[] = array(   
                "name"=>"宣传版面1-中标题",   
                "id"=>"propaganda1_medium_title",   
                "std"=>"蛤蛤蛤蛤,蛤蛤蛤蛤",   
                "desc"=>"显示在宣传版面1的中标题",   
                "size"=>"60",   
                "type"=>"text"  
            );

$options[] = array(   
                "name"=>"宣传版面1-详细描述",   
                "id"=>"propaganda1_small_desc",   
                "std"=>"
我们推出 OS X Yosemite 旨在提升 Mac 的使用体验。 为此，我们着眼于整个系统，对每个 app，每个功能，乃至每个像素逐一进行了完善。同时，我们将卓越的新功能构建于界面之中，让你所需的重要信息尽在指尖。如此一来，你的 Mac 有了焕然一新的外观，并依然拥有你所熟悉和喜爱的强大功能与简洁直观。",   
                "desc"=>"显示在宣传版面1的详细描述",   
                "size"=>"60",   
                "type"=>"textarea"  
            );

$options[] = array(   
                "name"=>"宣传版面1-链接标题",   
                "id"=>"propaganda1_small_href_title",   
                "std"=>"了解更多 >",   
                "desc"=>"显示在宣传版面1的链接标题",   
                "size"=>"60",   
                "type"=>"text"  
            );

$options[] = array(   
                "name"=>"宣传版面1-链接",   
                "id"=>"propaganda1_small_href",   
                "std"=>"http://ivydom.com",   
                "desc"=>"显示在宣传版面1的链接",   
                "size"=>"60",   
                "type"=>"text"  
            );

$options[] = array(   
            "name" => "宣传版面1-图片",   
            "desc" => "请上传一个图片或填写一个图片地址,建议大小:980*568",   
            "std"=>"http://images.apple.com/cn/osx/overview/images/design_large.png",   
            "id" => "propaganda1_small_img",   
            "type" => "upload");

/**************宣传版面2**************/

$options[] = array( "name" => "宣传板2是否可视",   
            "desc" => "",   
            "id" => "checkbox_service_pa2_visibile",   //id必须以checkbox_开头
            "std" => '1',  
			"buttons" => array('可视'), 			
            "type" => "checkbox");

$options[] = array(   
                "name"=>"宣传版面2-大标题",   
                "id"=>"propaganda2_big_title",   
                "std"=>"蛤蛤蛤蛤",   
                "desc"=>"显示在宣传版面2的大标题",   
                "size"=>"60",   
                "type"=>"text"  
            );

$options[] = array(   
                "name"=>"宣传版面2-中标题",   
                "id"=>"propaganda2_medium_title",   
                "std"=>"蛤蛤蛤蛤,蛤蛤蛤蛤",   
                "desc"=>"显示在宣传版面2的中标题",   
                "size"=>"60",   
                "type"=>"text"  
            );

$options[] = array(   
                "name"=>"宣传版面2-详细描述",   
                "id"=>"propaganda2_small_desc",   
                "std"=>"我们推出 OS X Yosemite 旨在提升 Mac 的使用体验。 为此，我们着眼于整个系统，对每个 app，每个功能，乃至每个像素逐一进行了完善。同时，我们将卓越的新功能构建于界面之中，让你所需的重要信息尽在指尖。如此一来，你的 Mac 有了焕然一新的外观，并依然拥有你所熟悉和喜爱的强大功能与简洁直观。",   
                "desc"=>"显示在宣传版面2的详细描述",   
                "size"=>"60",   
                "type"=>"textarea"  
            );

$options[] = array(   
                "name"=>"宣传版面2-链接标题",   
                "id"=>"propaganda2_small_href_title",   
                "std"=>"了解更多 >",   
                "desc"=>"显示在宣传版面2的链接标题",   
                "size"=>"60",   
                "type"=>"text"  
            );

$options[] = array(   
                "name"=>"宣传版面2-链接",   
                "id"=>"propaganda2_small_href",   
                "std"=>"http://ivydom.com",   
                "desc"=>"显示在宣传版面2的详细描述",   
                "size"=>"60",   
                "type"=>"text"  
            );

$options[] = array(   
            "name" => "宣传版面2-图片",   
            "desc" => "请上传一个图片或填写一个图片地址,建议大小:980*568",   
            "std"=>"http://images.apple.com/cn/osx/overview/images/mac_ios_large.png",   
            "id" => "propaganda2_small_img",   
            "type" => "upload");

/**************宣传版面3**************/

$options[] = array( "name" => "宣传板3是否可视",   
            "desc" => "",   
            "id" => "checkbox_service_pa3_visibile",   //id必须以checkbox_开头
            "std" => '1',  
			"buttons" => array('可视'), 			
            "type" => "checkbox");

$options[] = array(   
                "name"=>"宣传版面3-大标题",   
                "id"=>"propaganda3_big_title",   
                "std"=>"蛤蛤蛤蛤",   
                "desc"=>"显示在宣传版面3的大标题",   
                "size"=>"60",   
                "type"=>"text"  
            );

$options[] = array(   
                "name"=>"宣传版面3-中标题",   
                "id"=>"propaganda3_medium_title",   
                "std"=>"蛤蛤蛤蛤,蛤蛤蛤蛤",   
                "desc"=>"显示在宣传版面3的中标题",   
                "size"=>"60",   
                "type"=>"text"  
            );

$options[] = array(   
                "name"=>"宣传版面3-详细描述",   
                "id"=>"propaganda3_small_desc",   
                "std"=>"我们推出 OS X Yosemite 旨在提升 Mac 的使用体验。 为此，我们着眼于整个系统，对每个 app，每个功能，乃至每个像素逐一进行了完善。同时，我们将卓越的新功能构建于界面之中，让你所需的重要信息尽在指尖。如此一来，你的 Mac 有了焕然一新的外观，并依然拥有你所熟悉和喜爱的强大功能与简洁直观。",   
                "desc"=>"显示在宣传版面3的详细描述",   
                "size"=>"60",   
                "type"=>"textarea"  
            );

$options[] = array(   
                "name"=>"宣传版面3-链接标题",   
                "id"=>"propaganda3_small_href_title",   
                "std"=>"了解更多 >",   
                "desc"=>"显示在宣传版面3的链接标题",   
                "size"=>"60",   
                "type"=>"text"  
            );

$options[] = array(   
                "name"=>"宣传版面3-链接",   
                "id"=>"propaganda3_small_href",   
                "std"=>"http://ivydom.com",   
                "desc"=>"显示在宣传版面3的详细描述",   
                "size"=>"60",   
                "type"=>"text"  
            );

$options[] = array(   
            "name" => "宣传版面3-图片",   
            "desc" => "请上传一个图片或填写一个图片地址,建议大小:980*568",   
            "std"=>"http://images.apple.com/cn/osx/overview/images/apps_large.png",   
            "id" => "propaganda3_small_img",   
            "type" => "upload");

$options[] = array( "type" => "close");   

$options_page = new ashu_option_class($options, $subpageinfo);


$subpageinfo = array('full_name' => '添加服务宣传板', 'optionname'=>'service-add', 'child'=>true, 'filename' => basename(__FILE__).'-case-add');   

$options = array();
               
$options[] = array( "type" => "open");   
  
$options[] = array(
                "name"=>"基本设置",   
                "desc"=>"这里可以添加服务宣传板",   
                "type" => "title");

$options[] = array(   	
                "name"=>"新建的宣传板数量",   
                "id"=>"service_add_pa_count", 
                "std"=>"0",   
                "desc"=>"宣传板数量",   
                "size"=>"60",   
                "type"=>"text"  
            );

$options[] = array(   
                "name"=>"添加宣传板",
                "id"=>"service_add_pa",   
                "std"=>"添加宣传板",
                "desc"=>"点击按钮添加一个新的宣传板",   
                "size"=>"60",   
                "type"=>"button",
                "onclick"=>"addServicePropagate(this)"
            );

$options[] = array( "type" => "close");

$options_page = new ashu_option_class($options, $subpageinfo);

$serviceDataAdded=$ashu_option['service-add'];

/************************************PAGE CASE******************************************/

$servicepageinfo = array('full_name' => '案例页面设置', 'optionname'=>'case', 'child'=>true, 'filename' => basename(__FILE__).'-service');   
  
$options = array();
               
$options[] = array( "type" => "open");   
  
$options[] = array(
                "name"=>"基本设置",   
                "desc"=>"这里可以设置一些基本信息",   
                "type" => "title");

$options[] = array(   
                "name"=>"大标题",   
                "id"=>"case_big_title",   
                "std"=>"UniguyIT",   
                "desc"=>"显示在案例页面的大标题",   
                "size"=>"60",   
                "type"=>"text"  
            );

$options[] = array(   
                "name"=>"小标题",   
                "id"=>"case_medium_title",   
                "std"=>"Biger than bigger",   
                "desc"=>"显示在案例页面的中标题",   
                "size"=>"60",   
                "type"=>"text"  
            );

$options[] = array(   
            "name" => "案例图片",   
            "desc" => "请上传一个图片或填写一个图片地址,建议大小:960*220",   
            "std"=>"http://images.apple.com/v/watch/e/home/images/health_hero_large.jpg",   
            "id" => "case_main_img",   
            "type" => "upload");

$options[] = array(   
                "name"=>"链接1标题",   
                "id"=>"case_href1_title",   
                "std"=>"观看影片",   
                "desc"=>"案例页面中的第一个链接标题",   
                "size"=>"60",   
                "type"=>"text"
            );

$options[] = array(   
                "name"=>"链接1地址",   
                "id"=>"case_href1",   
                "std"=>"http://ivydom.com",   
                "desc"=>"案例页面中的第一个链接地址",   
                "size"=>"60",   
                "type"=>"text"
            );

$options[] = array(   
                "name"=>"链接2标题",   
                "id"=>"case_href2_title",   
                "std"=>"观看广告",   
                "desc"=>"案例页面中的第二个链接标题",   
                "size"=>"60",   
                "type"=>"text"
            );

$options[] = array(   
                "name"=>"链接2地址",   
                "id"=>"case_href2",   
                "std"=>"http://ivydom.com",   
                "desc"=>"案例页面中的第二个链接地址",   
                "size"=>"60",   
                "type"=>"text"
            );

$options[] = array(   
                "name"=>"链接3标题",   
                "id"=>"case_href3_title",   
                "std"=>"体验演讲",   
                "desc"=>"案例页面中的第三个链接标题",   
                "size"=>"60",   
                "type"=>"text"
            );

$options[] = array(   
                "name"=>"链接3地址",   
                "id"=>"case_href3",   
                "std"=>"http://ivydom.com",   
                "desc"=>"案例页面中的第三个链接地址",   
                "size"=>"60",   
                "type"=>"text"
            );

$options[] = array(   
            "name" => "案例页面主介绍",   
            "desc" => "案例页面的主介绍",   
            "id" => "tinymce_case_main_desc",   //id必须以 tinymce_开头
            "std"=>"iPhone&nbsp;6 之大，不只是简简单单地放大，而是方方面面都大有提升。它尺寸更大，却纤薄得不可思议；性能更强，却效能非凡。光滑圆润的金属机身，与全新 Retina HD 高清显示屏精准契合，浑然一体。而软硬件间的搭配，更是默契得宛如天作之合。无论以何种尺度衡量，这一切，都让 iPhone 新一代的至大之作，成为至为出众之作。",   
            "type" => "tinymce"  
            );

$options[] = array(   
                "name"=>"宣传板数量",   
                "id"=>"case_pa_count",   
                "std"=>"3",   
                "desc"=>"宣传板数量",   
                "size"=>"60",   
                "type"=>"text"  
            );

$options[] = array( "name" => "宣传板1是否可视",   
            "desc" => "",   
            "id" => "checkbox_case_pa1_visibile",   //id必须以checkbox_开头
            "std" => '1',  
			"buttons" => array('可视'), 			
            "type" => "checkbox");

$options[] = array(   
                "name"=>"宣传板1介绍",   
                "id"=>"case_pa_desc1",   
                "std"=>"蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤",   
                "desc"=>"案例页面中宣传板1的介绍",   
                "size"=>"60",   
                "type"=>"text"
            );

$options[] = array( "name" => "宣传板1图片位置",   
            "desc" => "请选择图片位置",   
            "id" => "case_pa_img1_pos", 
            "type" => "dropdown",
            "subtype" => array(   
                'left'=>'居左',   
                'top'=>'居上',
                'right'=>'居右',
                'bottom'=>'居下'
                )   
            );

$options[] = array(   
            "name" => "宣传板1图片",   
            "desc" => "请上传一个图片或填写一个图片地址,建议大小:146*428",   
            "std"=>"http://images.apple.com/v/iphone/compare/c/images/6plus_buy_medium.jpg",   
            "id" => "case_pa_img1",   
            "type" => "upload");

$options[] = array(   
                "name"=>"宣传板2标题",   
                "id"=>"case_pa_title2",   
                "std"=>"蛤蛤蛤蛤",   
                "desc"=>"案例页面中宣传板2的标题",   
                "size"=>"60",   
                "type"=>"text"
            );

$options[] = array( "name" => "宣传板2是否可视",   
            "desc" => "",   
            "id" => "checkbox_case_pa2_visibile",   //id必须以checkbox_开头
            "std" => '1',  
			"buttons" => array('可视'), 			
            "type" => "checkbox");

$options[] = array(   
                "name"=>"宣传板2介绍",   
                "id"=>"case_pa_desc2",   
                "std"=>"蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤",   
                "desc"=>"案例页面中宣传板2的介绍",   
                "size"=>"60",   
                "type"=>"text"
            );

$options[] = array( "name" => "宣传板2图片位置",   
            "desc" => "请选择图片位置",   
            "id" => "case_pa_img2_pos", 
            "type" => "dropdown",
            "subtype" => array(   
                'left'=>'居左',   
                'top'=>'居上',
                'right'=>'居右',
                'bottom'=>'居下'
                )   
            );

$options[] = array(   
            "name" => "宣传板2图片",   
            "desc" => "请上传一个图片或填写一个图片地址,建议大小:146*428",   
            "std"=>"http://images.apple.com/v/iphone/compare/c/images/6plus_buy_medium.jpg",   
            "id" => "case_pa_img2",   
            "type" => "upload");

$options[] = array( "name" => "宣传板3是否可视",   
            "desc" => "",   
            "id" => "checkbox_case_pa3_visibile",   //id必须以checkbox_开头
            "std" => '1',  
			"buttons" => array('可视'), 			
            "type" => "checkbox");

$options[] = array(   
                "name"=>"宣传板3标题",   
                "id"=>"case_pa_title3",   
                "std"=>"蛤蛤蛤蛤",   
                "desc"=>"案例页面中宣传板3的标题",   
                "size"=>"60",   
                "type"=>"text"
            );

$options[] = array(   
                "name"=>"宣传板3标题",   
                "id"=>"case_pa_title3",   
                "std"=>"蛤蛤蛤蛤",   
                "desc"=>"案例页面中宣传板3的标题",   
                "size"=>"60",   
                "type"=>"text"
            );

$options[] = array(
                "name"=>"宣传板3介绍",
                "id"=>"case_pa_desc3",
                "std"=>"蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤蛤",
                "desc"=>"案例页面中宣传板3的介绍",
                "size"=>"60",
                "type"=>"text"
            );

$options[] = array( "name" => "宣传板3图片位置",    
            "desc" => "请选择图片位置",   
            "id" => "case_pa_img3_pos", 
            "type" => "dropdown",
            "subtype" => array(   
                'left'=>'居左',   
                'top'=>'居上',
                'right'=>'居右',
                'bottom'=>'居下'  
                )   
            );


$options[] = array(   
            "name" => "宣传板3图片",   
            "desc" => "请上传一个图片或填写一个图片地址,建议大小:146*428",   
            "std"=>"http://images.apple.com/v/iphone/compare/c/images/6plus_buy_medium.jpg",   
            "id" => "case_pa_img3",   
            "type" => "upload");

$options[] = array(   
            "name" => "宣传板4图片1",   
            "desc" => "请上传一个图片或填写一个图片地址,建议大小:146*428",   
            "std"=>"http://images.apple.com/v/iphone/compare/c/images/6plus_buy_medium.jpg",   
            "id" => "case_pa_img41",   
            "type" => "upload");

$options[] = array(   
            "name" => "宣传板4图片2",   
            "desc" => "请上传一个图片或填写一个图片地址,建议大小:146*428",   
            "std"=>"http://images.apple.com/v/iphone/compare/c/images/6plus_buy_medium.jpg",   
            "id" => "case_pa_img42",   
            "type" => "upload");


$options[] = array( "type" => "close");   

$options_page = new ashu_option_class($options, $servicepageinfo);

$servicepageinfo = array('full_name' => '添加案例宣传板', 'optionname'=>'case-add', 'child'=>true, 'filename' => basename(__FILE__).'-service-add');   
  
$options = array();
               
$options[] = array( "type" => "open");   
  
$options[] = array(
                "name"=>"基本设置",   
                "desc"=>"这里可以设置一些基本信息",   
                "type" => "title");

$options[] = array(   
                "name"=>"新建的宣传板数量",   
                "id"=>"case_add_pa_count",   
                "std"=>"0",   
                "desc"=>"宣传板数量",   
                "size"=>"60",   
                "type"=>"text"  
            );

$options[] = array(   
                "name"=>"添加宣传板",   
                "id"=>"case_add_pa",   
                "std"=>"添加宣传板",
                "desc"=>"点击按钮添加一个新的宣传板",   
                "size"=>"60",   
                "type"=>"button",
                "onclick"=>"addPropagate(this)"
            );

$options[] = array( "type" => "close");   

$options_page = new ashu_option_class($options, $servicepageinfo);

$caseDataAdded=$ashu_option['case-add'];

?>

<?php
//开启/设置缩略图
add_theme_support('post-thumbnails');
set_post_thumbnail_size(640,200);

?>

<style type="text/css">
	.split{background: rgb(250,250,250);}

</style>

<script type="text/javascript">

	var currentPropageteCount="<?php echo $ashu_option['case']['case_pa_count']; ?>";

	var propagateExists='<?php echo json_encode($caseDataAdded); ?>';

	var servicePropagate='<?php echo json_encode($serviceDataAdded); ?>';

	var currentServicePropagateCount="<?php echo $ashu_option['service']['service_pa_count'];  ?>";
	var currentAServiceProTotalCount="<?php echo $ashu_option['service']['service_pa_count']+$ashu_option['service']['service_add_pa_count']; ?>";

	var container;

	var page;

	window.onload=function(){
		
		if(document.getElementById('case_add_pa')!=null){
			page='case'
			container=document.getElementById('case_add_pa').parentNode.parentNode.parentNode;
			document.getElementById('case_add_pa_count').setAttribute('value',"<?php echo $caseDataAdded['case_add_pa_count'] ?>");			
		}

		if(document.getElementById('service_add_pa')!=null){
			page='service';
			container=document.getElementById('service_add_pa').parentNode.parentNode.parentNode;			
		}

		hidePaCount();


		if(propagateExists!='' && page=='case'){
			var json=JSON.parse(propagateExists);
			var propagateCount=json['case_add_pa_count'];
			var propagateAddedStack={};
			var singleAdded={};
			var index=0;
			var count=0;
			for(var elem in json){
				if(elem=='Submit' || elem=='save_my_options' || elem=='case_add_pa_count' || elem=='case_add_pa'){
					continue;
				}
				if(count==4){
					count=0;
					index+=1;
					singleAdded={};
					singleAdded[elem]=json[elem];
					// continue;
				}else{
					propagateAddedStack[index]=singleAdded;
				}
				singleAdded[elem]=json[elem];
				count+=1;
			}

			for(elem in propagateAddedStack){
				var propagate=propagateAddedStack[elem];
				currentPropageteCount++;
				var visible=propagate['checkbox_case_pa'+currentPropageteCount+'_visibile'];
				visible=visible['0']=='true'?'true':'false';
				addPropagatePanel(container,propagate['case_pa_desc'+currentPropageteCount],propagate['case_pa_img'+currentPropageteCount],propagate['case_pa_img'+currentPropageteCount+'_pos'],visible);
			}
		}

		if(servicePropagate!='' && page=='service'){
			var json=JSON.parse(servicePropagate);
			var propagateCount=json['service_add_pa_count'];
			var propagateAddedStack={};
			var singleAdded={};
			var index=0;
			var count=0;
			for(var elem in json){
				if(elem=='Submit' || elem=='save_my_options' || elem=='service_add_pa_count' || elem=='service_add_pa'){
					continue;
				}
				if(count==7){
					count=0;
					index+=1;
					singleAdded={};
					singleAdded[elem]=json[elem];
					// continue;
				}else{
					propagateAddedStack[index]=singleAdded;
				}
				singleAdded[elem]=json[elem];
				count+=1;
			}

			var serviceIndex=currentAServiceProTotalCount;

			for(elem in propagateAddedStack){
				var propagate=propagateAddedStack[elem];
				serviceIndex++;
				var visible=propagate['checkbox_service_pa'+serviceIndex+'_visibile'];
				visible=visible['0']=='true'?'true':'false';
				//visible,title,subtitle,desc,ahrefTitle,ahref,img,split
				addServicePropagatePanel(visible,propagate['propaganda'+serviceIndex+'_big_title'],propagate['propaganda'+serviceIndex+'_medium_title'],propagate['propaganda'+serviceIndex+'_small_desc'],propagate['propaganda'+serviceIndex+'_small_href'],propagate['propaganda'+serviceIndex+'_small_href_title'],propagate['propaganda'+serviceIndex+'_small_img'],true);
			}
		}

	}

	function hidePaCount(){
		if(page=='case'){
			var paCount=document.getElementById('case_add_pa_count').parentNode.parentNode;
			paCount.style.display='none';
		}
		if(page=="service"){
			document.getElementById('service_add_pa_count').parentNode.parentNode.style.display='none';			
		}
	}

	var addPropagate=function(elem){
		var _this=elem;
		container=_this.parentNode.parentNode.parentNode;
		currentPropageteCount++;

		addPropagatePanel(container,'','','','true');
		document.getElementById('case_add_pa_count').setAttribute('value',parseInt(document.getElementById('case_add_pa_count').getAttribute('value'))+1);
	};

	var addServicePropagate=function(elem){
		var _this=elem;
		container=_this.parentNode.parentNode.parentNode;

		addServicePropagatePanel('','','','','','','',true);

		document.getElementById('service_add_pa_count').setAttribute('value',parseInt(document.getElementById('service_add_pa_count').getAttribute('value'))+1);
	}

	var addServicePropagatePanel=function(visible,title,subtitle,desc,ahrefTitle,ahref,img,split){

		split=split||false;
		var splitcol;
		if(split){splitcol=' class="split" ';}

		currentAServiceProTotalCount++;
		
		var _checkbox='<tr valign="top"><th scope="row" width="200px">当前是否可视</th><td><br><input checked="'+visible+'" class="kcheck" value="0" name="checkbox_service_pa'+currentAServiceProTotalCount+'_visibile[]" type="checkbox">可视<label for="checkbox_service_pa'+currentAServiceProTotalCount+'_visibile"></label><br><br></td></tr>';
		var title='<tr valign="top"><th scope="row" width="200px">当前宣传版面-大标题</th><td>显示在当前宣传版面的大标题<br><input size="60" value="'+title+'" id="propaganda'+currentAServiceProTotalCount+'_big_title" name="propaganda'+currentAServiceProTotalCount+'_big_title" type="text"><br><br></td></tr>';
		var midTitle='<tr valign="top"><th scope="row" width="200px">当前宣传版面-中标题</th><td>显示在当前宣传版面的中标题<br><input size="60" value="'+subtitle+'" id="propaganda'+currentAServiceProTotalCount+'_medium_title" name="propaganda'+currentAServiceProTotalCount+'_medium_title" type="text"><br><br></td></tr>';
		var desc='<tr valign="top"><th scope="row" width="200px">当前宣传版面-详细描述</th><td>显示在当前宣传版面的详细描述<br><textarea name="propaganda'+currentAServiceProTotalCount+'_small_desc" cols="60" rows="7" id="propaganda'+currentAServiceProTotalCount+'_small_desc" style="width: 80%; font-size: 12px;" class="code">'+desc+'</textarea><br><br></td></tr>';
		var ahrefTitle='<tr valign="top"><th scope="row" width="200px">当前宣传版面-链接标题</th><td>显示在当前宣传版面的链接标题<br><input size="60" value="'+ahrefTitle+'" id="propaganda'+currentAServiceProTotalCount+'_small_href_title" name="propaganda'+currentAServiceProTotalCount+'_small_href_title" type="text"><br><br></td></tr>';
		var aherf='<tr valign="top"><th scope="row" width="200px">当前宣传版面-链接</th><td>显示在当前宣传版面的链接<br><input size="60" value="'+ahref+'" id="propaganda'+currentAServiceProTotalCount+'_small_href" name="propaganda'+currentAServiceProTotalCount+'_small_href" type="text"><br><br></td></tr>';
		var img='<tr '+splitcol+' valign="top"><th scope="row" width="200px">当前宣传版面-图片</th><td><div class="preview_pic_optionspage" id="propaganda'+currentAServiceProTotalCount+'_small_img_div"><img src="'+img+'" alt=""></div>请上传一个图片或填写一个图片地址,建议大小:980*568<br><input size="60" value="'+img+'" name="propaganda'+currentAServiceProTotalCount+'_small_img" class="upload_pic_input" type="text">&nbsp;<a onclick="return false;" title="" class="k_hijack button thickbox" id="propaganda'+currentAServiceProTotalCount+'_small_img" href="media-upload.php?type=image&amp;hijack_target=propaganda'+currentAServiceProTotalCount+'_small_img&amp;TB_iframe=true">插入图片</a><br><br></td></tr>';

		var result=_checkbox+title+midTitle+desc+ahrefTitle+aherf+img;

		container.innerHTML=container.innerHTML+result;

	}

	var addPropagatePanel=function(container,desc,imgsrc,pos,visible){

		var str='<select class="postform" id="case_pa_img'+currentPropageteCount+'_pos" name="case_pa_img'+currentPropageteCount+'_pos"> <option value="">请选择</option>  <option value="left">居左</option><option value="top">居上</option><option value="right">居右</option><option value="bottom">居下</option></select>';

		switch(pos){
			case 'left':
				var str='<select class="postform" id="case_pa_img'+currentPropageteCount+'_pos" name="case_pa_img'+currentPropageteCount+'_pos"> <option value="">请选择</option>  <option selected="true" value="left">居左</option><option value="top">居上</option><option value="right">居右</option><option value="bottom">居下</option></select>';
				break;
			case 'right':
				var str='<select class="postform" id="case_pa_img'+currentPropageteCount+'_pos" name="case_pa_img'+currentPropageteCount+'_pos"> <option value="">请选择</option>  <option value="left">居左</option><option value="top">居上</option><option selected="true" value="right">居右</option><option value="bottom">居下</option></select>';			
				break;
			case 'top':
				var str='<select class="postform" id="case_pa_img'+currentPropageteCount+'_pos" name="case_pa_img'+currentPropageteCount+'_pos"> <option value="">请选择</option>  <option value="left">居左</option><option selected="true" value="top">居上</option><option value="right">居右</option><option value="bottom">居下</option></select>';
				break;
			case 'bottom':
				var str='<select class="postform" id="case_pa_img'+currentPropageteCount+'_pos" name="case_pa_img'+currentPropageteCount+'_pos"> <option value="">请选择</option>  <option value="left">居左</option><option value="top">居上</option><option value="right">居右</option><option selected="true" value="bottom">居下</option></select>';
				break;
			default:
				var str='<select class="postform" id="case_pa_img'+currentPropageteCount+'_pos" name="case_pa_img'+currentPropageteCount+'_pos"> <option value="">请选择</option>  <option value="left">居左</option><option value="top">居上</option><option value="right">居右</option><option value="bottom">居下</option></select>';
				break;
		}

		addElment(container,'新建宣传面板'+currentPropageteCount+'介绍','案例页面中宣传板'+currentPropageteCount+'的介绍','<input size="60" value="'+desc+'" id="case_pa_desc'+currentPropageteCount+'" name="case_pa_desc'+currentPropageteCount+'" type="text">');
		addElment(container,'新建宣传面板'+currentPropageteCount+'图片位置','请选择图片位置'+currentPropageteCount+'的介绍',str);
		addElment(container,'新建宣传面板'+currentPropageteCount+'图片','请上传一个图片或填写一个图片地址,建议大小:146*428'+currentPropageteCount+'的介绍','<div class="preview_pic_optionspage" id="case_pa_img'+currentPropageteCount+'_div"><img src="'+imgsrc+'"></div>请上传一个图片或填写一个图片地址,建议大小:146*428<br><input size="60" value="'+imgsrc+'" name="case_pa_img'+currentPropageteCount+'" class="upload_pic_input" type="text">&nbsp;<a onclick="return false;" title="" class="k_hijack button thickbox" id="case_pa_img'+currentPropageteCount+'" href="media-upload.php?type=image&amp;hijack_target=case_pa_img'+currentPropageteCount+'&amp;TB_iframe=true">插入图片</a>');
		addElment(container,'新建宣传面板'+currentPropageteCount+'是否可视','设置此宣传板是否可视','<input checked="'+visible+'" class="kcheck" value="0" name="checkbox_case_pa'+currentPropageteCount+'_visibile[]" type="checkbox">可视<label for="checkbox_case_pa'+currentPropageteCount+'_visibile"></label>',true);
	}

	function addElment(container,title,subtitle,element,isSplited){
		isSplited=isSplited||false;

		var newPropagatePanel=document.createElement('tr');
		newPropagatePanel.setAttribute('valign','top');

		var th=document.createElement('th');
		th.style.width='200px';
		th.setAttribute('scope','row');
		th.innerHTML=title;

		var td=document.createElement('td');

		td.innerHTML=subtitle+'<br><br>'+element+'<br><br>';

		container.appendChild(newPropagatePanel);
		newPropagatePanel.appendChild(th);
		newPropagatePanel.appendChild(td);
		if(isSplited){
			newPropagatePanel.setAttribute('class','split');
		}

	}

	// window.onload=hidePaCount;
	
</script>
