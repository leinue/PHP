<?php
//开启/设置缩略图
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size(640,200);

//添加主题选项
function TopMenu(){
    add_menu_page( 'title标题', 'UniguyIT选项', 'edit_themes', 'uniguy-option','display_function','',6);  
}
  
function display_function(){
    echo '<h1>UniguyIT选项</h1>'; 
?>
	<form method="post" name="uniguy_form" id="uni_form" action="options.php">
	    <h2>页脚设置</h2>
	    <p>
		    <label>
		    <textarea name="uniguy_copy_right" value="<?php echo get_option('uniguy_copy_right'); ?>" style="width:80%;height:150px"></textarea>
		    请输入文字,支持html
		    </label>
	    </p>
	    <?php wp_nonce_field('update-options'); ?>   
	    <input type="hidden" name="action" value="update" />   
	    <input type="hidden" name="page_options" value="uniguy_copy_right" />
	    <p class="submit">
	        <input type="submit" class="button button-primary" name="option_save" value="<?php _e('保存设置'); ?>" />
	    </p>
    </form>

<?php
}

add_action('admin_menu', 'TopMenu');

//添加子菜单项代码
add_action('admin_menu', 'add_my_custom_service_page');   
  
function add_my_custom_service_page() {
    add_submenu_page( 'uniguy-option', '子菜单', '服务页面设置', 'edit_themes', 'uniguy-service-page', 'my_service_page_display' );    
}   
  
function my_service_page_display() {   
    echo '<h3>服务页面设置</h3>';
}

//添加子菜单项案例代码
add_action('admin_menu', 'add_my_custom_case_page');   
  
function add_my_custom_case_page() {
    add_submenu_page( 'uniguy-option', '子菜单', '案例页面设置', 'edit_themes', 'ungiuy-case-page', 'my_service_case_display' );    
}   
  
function my_service_case_display() {   
    echo '<h3>案例页面设置</h3>';
}

?>