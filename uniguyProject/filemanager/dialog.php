<?php
error_reporting(0);
include 'config/config.php';
if(isset($_GET['uid'])){
	$uuid=$_GET['uid'];
}
if(isset($_GET['akey'])){
	$commonDir=$_GET['akey'];
}

$_SESSION['uuid']=$uuid;

//现在每页已有的文件数
if(!isset($_SESSION['current_file_count'])){
	$_SESSION['current_file_count']=20;	
}

// $_SESSION['current_file_count']=20;
// echo "<script>alert('{$_SESSION['current_file_count']}')</script>";
//每次加载的文件递增数
if(!isset($_SESSION['file_load_step'])){
	$_SESSION['file_load_step']=10;	
}

//connect to mysql
$pdo=new PDO("mysql:dbname=$dbname;host=$host",'doc','doc');
$user=new userMgr($pdo);
$fm=new fileMgr($pdo);

$userPrivilege=$user->getPrivilege($uuid);

$userPrivilege=$userPrivilege['privilege'];

if($userPrivilege==='0' || !$userPrivilege){
	$delete_files		= FALSE;
	$create_folders		= FALSE;
	$delete_folders		= FALSE;

	$rename_files		= FALSE;
	$rename_folders		= FALSE;

	$copy_cut_files		= FALSE; // for copy/cut files
	$copy_cut_dirs		= FALSE; // for copy/cut directories

	$preview_text_files	= TRUE; // eg.: txt, log etc.
	$edit_text_files 	= FALSE; // eg.: txt, log etc.

	$upload_files		= FALSE;

	$_SESSION['user_privilege']=0;
}else if($userPrivilege==='1'){
	$delete_files		= TRUE;
	$create_folders		= TRUE;
	$delete_folders		= TRUE;

	$rename_files		= TRUE;
	$rename_folders		= TRUE;

	$copy_cut_files		= TRUE; // for copy/cut files
	$copy_cut_dirs		= TRUE; // for copy/cut directories

	$preview_text_files	= TRUE; // eg.: txt, log etc.
	$edit_text_files 	= TRUE; // eg.: txt, log etc.

	$upload_files		= TRUE;

	$_SESSION['user_privilege']=1;
}

if (USE_ACCESS_KEYS == TRUE){
	if (!isset($_GET['akey'], $access_keys) || empty($access_keys)){
		die('Access Denied!');
	}

	$_GET['akey'] = strip_tags(preg_replace( "/[^a-zA-Z0-9\._-]/", '', $_GET['akey']));

	if (!in_array($_GET['akey'], $access_keys)){
		die('Access Denied!');
	}
}

$_SESSION['RF']["verify"] = "RESPONSIVEfilemanager";

if(isset($_POST['submit'])){

	include 'upload.php';

}
else {
include 'include/utils.php';

if (isset($_GET['fldr'])
    && !empty($_GET['fldr'])
    && strpos($_GET['fldr'],'../') === FALSE
    && strpos($_GET['fldr'],'./') === FALSE)
{
    $subdir = urldecode(trim(strip_tags($_GET['fldr']),"/") ."/");
    $_SESSION['RF']["filter"]='';
}
else { $subdir = ''; }

if($subdir == "")
{
   if(!empty($_COOKIE['last_position'])
	&& strpos($_COOKIE['last_position'],'.') === FALSE)
	$subdir= trim($_COOKIE['last_position']);
}

//remember last position
setcookie('last_position',$subdir,time() + (86400 * 7));
$responsec = file_get_contents("http://121.40.200.70:9000/api/putcookies?last_position=".$_COOKIE['last_position']."&PHPSESSID=".$_COOKIE['PHPSESSID']."&akey=".$_SESSION['RF']['subfolder']);
if ($subdir == "/") { $subdir = ""; }

// If hidden folders are specified
if(count($hidden_folders)){
	// If hidden folder appears in the path specified in URL parameter "fldr"
	$dirs = explode('/', $subdir);
	foreach($dirs as $dir){
		if($dir !== '' && in_array($dir, $hidden_folders)){
			// Ignore the path
			$subdir = ""; 
			break;
		}
	}
}

/***
 *SUB-DIR CODE
 ***/

if (!isset($_SESSION['RF']["subfolder"])) 
{ 
	$_SESSION['RF']["subfolder"] = '';
}

$_SESSION['RF']['subfolder']=$commonDir;

//print_r($_SESSION['RF']['subfolder']);

$rfm_subfolder = '';

if (!empty($_SESSION['RF']["subfolder"]) && strpos($_SESSION['RF']["subfolder"],'../') === FALSE
   && strpos($_SESSION['RF']["subfolder"],'./') === FALSE && strpos($_SESSION['RF']["subfolder"],"/") !== 0
   && strpos($_SESSION['RF']["subfolder"],'.') === FALSE)
{
	$rfm_subfolder = $_SESSION['RF']['subfolder'];
}
   
if ($rfm_subfolder != "" && $rfm_subfolder[strlen($rfm_subfolder)-1] != "/") { $rfm_subfolder .= "/"; }

//echo "=====";
//print_r($rfm_subfolder);
//echo "=====";

//echo $current_path.$rfm_subfolder.$subdir;


if (!file_exists($current_path.$rfm_subfolder.$subdir))
{
    $subdir = '';
    if (!file_exists($current_path.$rfm_subfolder.$subdir))
    {
		$rfm_subfolder = "";
    }
}

//echo $current_path.$rfm_subfolder.$subdir;

if (trim($rfm_subfolder) == "")
{
    $cur_dir 	 = $upload_dir . $subdir;
    $cur_path 	 = $current_path . $subdir;
    $thumbs_path = $thumbs_base_path;
    $parent 	 = $subdir;
} 
else
{
    $cur_dir 	 = $upload_dir . $rfm_subfolder.$subdir;
    $cur_path 	 = $current_path . $rfm_subfolder.$subdir;
    $thumbs_path = $thumbs_base_path. $rfm_subfolder;
    $parent 	 = $rfm_subfolder.$subdir;
}

$cycle = TRUE;
$max_cycles = 50;
$i = 0;
while($cycle && $i < $max_cycles){
    $i++;
    if ($parent=="./") $parent="";   

    if (file_exists($current_path.$parent."config.php"))
    {
		require_once $current_path.$parent."config.php";
		$cycle = FALSE;
    }
    
    if ($parent == "") $cycle = FALSE;
    else $parent = fix_dirname($parent)."/";
}

//echo $thumbs_path.$subdir;

if (!is_dir($thumbs_path.$subdir))
{
    create_folder(FALSE, $thumbs_path.$subdir);
}

if (isset($_GET['popup'])) 
{
	$popup = strip_tags($_GET['popup']);
}
else $popup=0;

//Sanitize popup
$popup=!!$popup;

if (isset($_GET['crossdomain'])) 
{
   $crossdomain = strip_tags($_GET['crossdomain']);
}
else $crossdomain=0;

//Sanitize crossdomain
$crossdomain=!!$crossdomain;

//view type
if(!isset($_SESSION['RF']["view_type"]))
{ 
	$view = $default_view; 
	$_SESSION['RF']["view_type"] = $view; 
}

$VlaueFldr=$_GET['fldr'];
if($_SESSION['RF']["subfolder"]=='328eb3c3-d632-11e4-9a8c-00163e002b11'){
	if($VlaueFldr=='/'){
		$_SESSION['RF']["view_type"]=0;
	}else{
		if(strrpos($VlaueFldr, '/')==strlen($VlaueFldr)-1){
			$_SESSION['RF']['view_type']=1;
		}else{
			$_SESSION['RF']['view_type']=0;
		}
	}
}

if (isset($_GET['view']))
{
	$view = fix_get_params($_GET['view']); 
	$_SESSION['RF']["view_type"] = $view; 
}

$view = $_SESSION['RF']["view_type"];

//filter
$filter = "";
if(isset($_SESSION['RF']["filter"]))
{ 
	$filter = $_SESSION['RF']["filter"];
}

if(isset($_GET["filter"])) 
{
	$filter = fix_get_params($_GET["filter"]);
}

if (!isset($_SESSION['RF']['sort_by'])) 
{
	$_SESSION['RF']['sort_by'] = 'date';
}

if (isset($_GET["sort_by"])) 
{
	$sort_by = $_SESSION['RF']['sort_by'] = fix_get_params($_GET["sort_by"]);
}
else $sort_by = $_SESSION['RF']['sort_by'];


if (!isset($_SESSION['RF']['descending'])) 
{
	$_SESSION['RF']['descending'] = TRUE;
}

$_SESSION['RF']['descending'] = TRUE;

if (isset($_GET["descending"])) 
{
	$descending = $_SESSION['RF']['descending'] = fix_get_params($_GET["descending"])==="false";
}
else $descending = $_SESSION['RF']['descending'];
$boolarray = Array(false => 'false', true => 'true');

$return_relative_url = isset($_GET['relative_url']) && $_GET['relative_url'] == "1" ? true : false;

// language
if (!isset($_SESSION['RF']['language']) 
	|| file_exists($_SESSION['RF']['language_file']) === FALSE 
	|| !is_readable($_SESSION['RF']['language_file'])) 
{
	$lang = $default_language;

	if (isset($_GET['lang']) && $_GET['lang'] != 'undefined' && $_GET['lang']!='') 
	{
   		$lang = fix_get_params($_GET['lang']);
    	$lang = trim($lang);
	}

	$language_file = 'lang/'.$default_language.'.php'; 
	if ($lang != $default_language) 
	{
    	$path_parts = pathinfo($lang);

	    if (is_readable('lang/' .$path_parts['basename']. '.php'))
	    { 
	        $language_file = 'lang/' .$path_parts['basename']. '.php';
	    }
	    else 
	    {
	    	echo "<script>console.log('The ".$lang." language file is not readable! Falling back...');</script>";
	    }
	}

	// add lang file to session for easy include
	$_SESSION['RF']['language'] = $lang;
	$_SESSION['RF']['language_file'] = $language_file;
}
else 
{
	$lang = $_SESSION['RF']['language'];
	$language_file = $_SESSION['RF']['language_file']; 
}

require_once $language_file;

if (!isset($_GET['type'])) $_GET['type'] = 0;
if (!isset($_GET['field_id'])) $_GET['field_id'] = '';

$field_id = isset($_GET['field_id']) ? fix_get_params($_GET['field_id']) : '';
$type_param = fix_get_params($_GET['type']);

$get_params = http_build_query(array(
    'type'      => $type_param,
    'lang'      => $lang,
    'popup'     => $popup,
    'crossdomain' => $crossdomain,
    'field_id'  => $field_id,
    'relative_url' => $return_relative_url,
    'akey' 		=> (isset($_GET['akey']) && $_GET['akey'] != '' ? $_GET['akey'] : 'key'),
    'uid'		=> $uuid,
    'fldr'      => '',
));


?>

<!DOCTYPE html>
<html xmlns="https://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="robots" content="noindex,nofollow">
  <title>华润双鹤文献系统</title>
  <link rel="shortcut icon" href="img/ico/favicon.ico">
  <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />
  <link href="css/bootstrap-lightbox.min.css" rel="stylesheet" type="text/css" />
  <link href="css/style.css" rel="stylesheet" type="text/css" />
	<link href="css/dropzone.min.css" type="text/css" rel="stylesheet" />
	<?php
	$sprite_lang_file = 'img/spritemap_'.$lang.'.png';
	$sprite_lang_file2 = 'img/spritemap@2x_'.$lang.'.png';
	
	if ( ! file_exists($sprite_lang_file) || ! file_exists($sprite_lang_file2)){
		//fallback
		$sprite_lang_file = 'img/spritemap_en_EN.png';
		$sprite_lang_file2 = 'img/spritemap@2x_en_EN.png';
		if ( ! file_exists($sprite_lang_file) || ! file_exists($sprite_lang_file2)){
			// we are in deep ****
			echo '<script>console.log("Error: Spritemap not found!");</script>';
			// exit();
		}
	}
	?>
	<style>
		.dropzone .dz-default.dz-message,
		.dropzone .dz-preview .dz-error-mark,
		.dropzone-previews .dz-preview .dz-error-mark,
		.dropzone .dz-preview .dz-success-mark,
		.dropzone-previews .dz-preview .dz-success-mark,
		.dropzone .dz-preview .dz-progress .dz-upload,
		.dropzone-previews .dz-preview .dz-progress .dz-upload {
			background-image: url(<?php echo $sprite_lang_file; ?>);
		}

		@media all and (-webkit-min-device-pixel-ratio:1.5),(min--moz-device-pixel-ratio:1.5),(-o-min-device-pixel-ratio:1.5/1),(min-device-pixel-ratio:1.5),(min-resolution:138dpi),(min-resolution:1.5dppx) {
		  	.dropzone .dz-default.dz-message,
		  	.dropzone .dz-preview .dz-error-mark,
			.dropzone-previews .dz-preview .dz-error-mark,
			.dropzone .dz-preview .dz-success-mark,
			.dropzone-previews .dz-preview .dz-success-mark,
			.dropzone .dz-preview .dz-progress .dz-upload,
  			.dropzone-previews .dz-preview .dz-progress .dz-upload {
		    	background-image: url(<?php echo $sprite_lang_file; ?>);
		    }
		}
	
		body{
			font-family: "宋体"!important;
		}

	</style>
	<link href="css/jquery.contextMenu.min.css" rel="stylesheet" type="text/css" />	
	<link href="css/bootstrap-modal.min.css" rel="stylesheet" type="text/css" />
	<link href="jPlayer/skin/blue.monday/jplayer.blue.monday.css" rel="stylesheet" type="text/css">
	<!--[if lt IE 8]><style>
	.img-container span, .img-container-mini span {
	    display: inline-block;
	    height: 100%;
	}
	</style><![endif]-->
	<script type="text/javascript" src="../cdn/jquery/1.9.1/jquery.min.js"></script>
	<script type="text/javascript">
	if (typeof jQuery === 'undefined')
	{
	  document.write(unescape("%3Cscript src='js/jquery.js' type='text/javascript'%3E%3C/script%3E"));
	}
	</script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-lightbox.min.js"></script>
	<script type="text/javascript" src="js/dropzone.min.js"></script>
	<script type="text/javascript" src="js/jquery.touchSwipe.min.js"></script>
	<script type="text/javascript" src="js/modernizr.custom.js"></script>
	<script type="text/javascript" src="js/bootbox.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-modal.min.js"></script>   
	<script type="text/javascript" src="js/bootstrap-modalmanager.min.js"></script>
	<script type="text/javascript" src="jPlayer/jquery.jplayer.min.js"></script>
	<script type="text/javascript" src="js/ZeroClipboard.min.js"></script>
	<?php
	if ($aviary_active){
	if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) { ?>
	    <script type="text/javascript" src="../cdn/feather.js"></script>
	<?php }else{ ?>
	    <script type="text/javascript" src="../cdn/big/feather.js "></script>
	<?php }} ?>
	
	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="../cdn/html5shiv/3.6.2/html5shiv.js"></script>
	<![endif]-->
	<script src="js/jquery.ui.position.min.js" type="text/javascript"></script>
	<script src="js/jquery-ui-1.10.4.custom.js" type="text/javascript"></script>
	<script src="js/jquery.ui.touch-punch.min.js" type="text/javascript"></script>
	<script src="js/jquery.contextMenu.min.js" type="text/javascript"></script>    
	
	<script>
	    var ext_img=new Array('<?php echo implode("','", $ext_img)?>');
	    var allowed_ext=new Array('<?php echo implode("','", $ext)?>');
	    var image_editor=<?php echo $aviary_active?"true":"false"; ?>;
	    //dropzone config
	    Dropzone.options.myAwesomeDropzone = {
		    dictInvalidFileType: "<?php echo lang_Error_extension;?>",
		    dictFileTooBig: "<?php echo lang_Error_Upload; ?>",
		    dictResponseError: "SERVER ERROR",
		    paramName: "file", // The name that will be used to transfer the file
		    maxFilesize: <?php echo $MaxSizeUpload; ?>, // MB
		    url: "upload.php",
		    accept: function(file, done) {
			    var extension=file.name.split('.').pop();
			    extension=extension.toLowerCase();
			    if ($.inArray(extension, allowed_ext) > -1) {
					done();
					$.get("get_new_upload_dir.php", function(title){
						var title=title.split('/');
						title=title[title.length-1];
						title=title.split('.');
						var newtitle='';
						for (var i = 0; i < title.length-1; i++) {
							newtitle+=title[i];
						};
						displaySigninForm(newtitle);
					});
			    }
			    else { 
			    	done("<?php echo lang_Error_extension;?>"); 
				}
		    }
	    };
	    if (image_editor) {
	    var featherEditor = new Aviary.Feather({
		<?php
	        foreach ($aviary_defaults_config as $aopt_key => $aopt_val) {
	       ?>
		   <?php echo $aopt_key; ?>: <?php echo json_encode($aopt_val); ?>,
		  <?php } ?>
	      onSave: function(imageID, newURL) {
			    show_animation();
			    var img = document.getElementById(imageID);
			    img.src = newURL;
			    $.ajax({
						type: "POST",
						url: "ajax_calls.php?action=save_img",
						data: { url: newURL, path:$('#sub_folder').val()+$('#fldr_value').val(), name:$('#aviary_img').data('name') }
			    }).done(function( msg ) {			
						featherEditor.close();
						d = new Date();
						$("figure[data-name='"+$('#aviary_img').data('name')+"']").find('img').each(function(){
						  $(this).attr('src',$(this).attr('src')+"?"+d.getTime());
						});
						$("figure[data-name='"+$('#aviary_img').data('name')+"']").find('figcaption a.preview').each(function(){
						  $(this).attr('data-url',$(this).data('url')+"?"+d.getTime());
				    });
						hide_animation();
			    });
			    return false;
	      },
	      onError: function(errorObj) {
		   		bootbox.alert(errorObj.message);
		   		hide_animation();
	      }
	    
	   });
	    }
	</script>
	<script type="text/javascript" src="js/include.js"></script>
</head>
<body>
	<input type="hidden" id="popup" value="<?php echo $popup; ?>" />
	<input type="hidden" id="crossdomain" value="<?php echo $crossdomain; ?>" />
	<input type="hidden" id="view" value="<?php echo $view; ?>" />
  	<input type="hidden" id="subdir" value="<?php echo $subdir; ?>" />
  	<input type="hidden" id="cur_dir" value="<?php echo $cur_dir; ?>" />
	<input type="hidden" id="cur_dir_thumb" value="<?php echo $thumbs_path.$subdir; ?>" />
	<input type="hidden" id="insert_folder_name" value="<?php echo lang_Insert_Folder_Name; ?>" />
	<input type="hidden" id="new_folder" value="<?php echo lang_New_Folder; ?>" />
	<input type="hidden" id="ok" value="<?php echo lang_OK; ?>" />
	<input type="hidden" id="cancel" value="<?php echo lang_Cancel; ?>" />
	<input type="hidden" id="rename" value="<?php echo lang_Rename; ?>" />
	<input type="hidden" id="lang_duplicate" value="<?php echo lang_Duplicate; ?>" />
	<input type="hidden" id="duplicate" value="<?php if($duplicate_files) echo 1; else echo 0; ?>" />
	<input type="hidden" id="base_url" value="<?php echo $base_url?>"/>
	<input type="hidden" id="base_url_true" value="<?php echo base_url(); ?>"/>
	<input type="hidden" id="fldr_value" value="<?php echo $subdir; ?>"/>
	<input type="hidden" id="sub_folder" value="<?php echo $rfm_subfolder.$subdir; ?>"/>
  <input type="hidden" id="return_relative_url" value="<?php echo $return_relative_url == true ? 1 : 0;?>"/>
  <input type="hidden" id="lazy_loading_file_number_threshold" value="<?php echo $lazy_loading_file_number_threshold?>"/>
	<input type="hidden" id="file_number_limit_js" value="<?php echo $file_number_limit_js; ?>" />
	<input type="hidden" id="sort_by" value="<?php echo $sort_by; ?>" />
	<input type="hidden" id="descending" value="<?php echo $descending?1:0; ?>" />
	<input type="hidden" id="current_url" value="<?php echo str_replace(array('&filter='.$filter),array(''),$base_url.$_SERVER['REQUEST_URI']); ?>" />
	<input type="hidden" id="lang_show_url" value="<?php echo lang_Show_url; ?>" />
	<input type="hidden" id="copy_cut_files_allowed" value="<?php if($copy_cut_files) echo 1; else echo 0; ?>" />
	<input type="hidden" id="copy_cut_dirs_allowed" value="<?php if($copy_cut_dirs) echo 1; else echo 0; ?>" />
	<input type="hidden" id="copy_cut_max_size" value="<?php echo $copy_cut_max_size; ?>" />
	<input type="hidden" id="copy_cut_max_count" value="<?php echo $copy_cut_max_count; ?>" />
	<input type="hidden" id="lang_star" value="<?php echo lang_star; ?>" />
	<input type="hidden" id="lang_copy" value="<?php echo lang_Copy; ?>" />
	<input type="hidden" id="lang_cut" value="<?php echo lang_Cut; ?>" />
	<input type="hidden" id="lang_paste" value="<?php echo lang_Paste; ?>" />
	<input type="hidden" id="lang_paste_here" value="<?php echo lang_Paste_Here; ?>" />
	<input type="hidden" id="lang_paste_confirm" value="<?php echo lang_Paste_Confirm; ?>" />
	<input type="hidden" id="lang_files_on_clipboard" value="<?php echo lang_Files_ON_Clipboard; ?>" />
	<input type="hidden" id="clipboard" value="<?php echo ((isset($_SESSION['RF']['clipboard']['path']) && trim($_SESSION['RF']['clipboard']['path']) != null) ? 1 : 0); ?>" />
	<input type="hidden" id="lang_clear_clipboard_confirm" value="<?php echo lang_Clear_Clipboard_Confirm; ?>" />
	<input type="hidden" id="lang_file_permission" value="<?php echo lang_File_Permission; ?>" />
	<input type="hidden" id="chmod_files_allowed" value="<?php if($chmod_files) echo 1; else echo 0; ?>" />
	<input type="hidden" id="chmod_dirs_allowed" value="<?php if($chmod_dirs) echo 1; else echo 0; ?>" />
	<input type="hidden" id="lang_lang_change" value="<?php echo lang_Lang_Change; ?>" />
	<input type="hidden" id="edit_text_files_allowed" value="<?php if($edit_text_files) echo 1; else echo 0; ?>" />
	<input type="hidden" id="lang_edit_file" value="<?php echo lang_Edit_File; ?>" />
	<input type="hidden" id="lang_new_file" value="<?php echo lang_New_File; ?>" />
	<input type="hidden" id="lang_filename" value="<?php echo lang_Filename; ?>" />
	<input type="hidden" id="lang_file_info" value="<?php echo fix_strtoupper(lang_File_info); ?>" />
	<input type="hidden" id="lang_edit_image" value="<?php echo lang_Edit_image; ?>" />
	<input type="hidden" id="lang_extract" value="<?php echo lang_Extract; ?>" />
	<input type="hidden" id="transliteration" value="<?php echo $transliteration?"true":"false"; ?>" />
	<input type="hidden" id="convert_spaces" value="<?php echo $convert_spaces?"true":"false"; ?>" />
    <input type="hidden" id="replace_with" value="<?php echo $convert_spaces? $replace_with : ""; ?>" />
    <input type="hidden" id="uuid" value="<?php echo $_SESSION['RF']['subfolder']; ?>" />
<?php if($upload_files){ ?>

<!-- uploader div start -->

<style type="text/css">

	.login-panel{
		position: fixed;
		width: 100%;
		height: 100%;
		background: rgba(0,0,0,0.5);
		top: 0;
		left: 0;
		z-index: 65535;
	}

	.login-box{
		position: fixed;
		z-index: 65535;
		width: 650px;
		background: rgb(250,250,250);
		border-radius: 4px;
		padding: 10px;
	}

	.login_box_title{
		width: 100%;
		text-align: center;
		color: #333;
	}

	.login_box_content{
		display: table;
		width: 100%;
	}

	.login_box_content ul{
		display: table-row;
	}

	.login_box_content ul li{
		display: table-cell;
		width: 50%;
		padding: 20px;
	}

	.login_box_content input{
		height: 30px;
	}

	.login_box_content ul li:first-child{
		border-right: 1px solid rgb(226,226,226);
	}

	.login_box_register{
		color: #666;
		margin-bottom: 10px;
	}

	.login_box_input input{
		margin-bottom: 14px;
	}

	.login_box_close{
		float: right;
		margin-top: -60px;
		cursor: pointer;
	}

</style>

<div class="uploader">
    <div class="text-center">
    	<button class="btn btn-inverse close-uploader"><i class="icon-backward icon-white"></i> <?php echo lang_Return_Files_List?></button>
    </div>
	<div class="space10"></div><div class="space10"></div>
	<div class="tabbable upload-tabbable"> <!-- Only required for left/right tabs -->
		<?php if($java_upload){ ?>
	    <ul class="nav nav-tabs">
			<li class="active"><a href="#tab1" data-toggle="tab"><?php echo lang_Upload_base; ?></a></li>
			<li><a href="#tab2" id="uploader-btn" data-toggle="tab"><?php echo lang_Upload_java; ?></a></li>
	    </ul>
	    <div class="tab-content">
			<div class="tab-pane active" id="tab1">
		    	<?php } ?>
				<form action="dialog.php" method="post" enctype="multipart/form-data" id="myAwesomeDropzone" class="dropzone">
				    <input type="hidden" name="path" value="<?php echo $cur_path?>"/>
				    <input type="hidden" name="path_thumb" value="<?php echo $thumbs_path.$subdir?>"/>
				    <div class="fallback">
					<?php echo lang_Upload_file?>:<br/>
					<input name="file" type="file" />
					<input type="hidden" name="fldr" value="<?php echo $subdir; ?>"/>
					<input type="hidden" name="view" value="<?php echo $view; ?>"/>
					<input type="hidden" name="type" value="<?php echo $type_param; ?>"/>
					<input type="hidden" name="field_id" value="<?php echo $field_id; ?>"/>
          <input type="hidden" name="relative_url" value="<?php echo $return_relative_url; ?>"/>
					<input type="hidden" name="popup" value="<?php echo $popup; ?>"/>
					<input type="hidden" name="lang" value="<?php echo $lang; ?>"/>
					<input type="hidden" name="filter" value="<?php echo $filter; ?>"/>
					<input type="submit" name="submit" value="<?php echo lang_OK?>" />
				</form>
			</div>
		    <div class="upload-help"><?php echo lang_Upload_base_help; ?></div>
			<?php if($java_upload){ ?>
			</div>
			<div class="tab-pane" id="tab2">
		    	<div id="iframe-container"></div>
		    	<div class="upload-help"><?php echo lang_Upload_java_help; ?></div>
			<?php } ?>
			</div>
	    </div>
	</div>
	
</div>

<script>

	function displaySigninForm(title){
		var form='<div class="login-panel"></div><div style="top:0" class="login-box"><div class="login_box_title"><h2>完善信息</h2><div style="visibility:hidden" class="login_box_close"><img width="24" height="24" src="images/close.svg"></div></div><div class="login_box_content"><ul><li><!--<div class="login_box_register">标题</div>--><div class="login_box_input"><!--<input class="the_input light_blue" id="upload_title" value="'+title+'" placeholder="请输入标题" style="width:92%" type="text">--> <input style="visibility:hidden" type="checkBox"><div class="login_box_register">作者</div><input class="the_input light_blue" id="upload_author" placeholder="请输入作者名" style="width:92%" type="text"><div class="login_box_register">标签</div><input class="the_input light_blue" id="upload_tags" placeholder="请输入标签,用英文状态下逗号分割" style="width:92%" type="text"><div style="margin-top:-8px;margin-bottom:6px"></div></div></li><li><div class="login_box_register">请输入描述信息</div><div class="login_box_input"><textarea id="upload_description" style="width:100%" rows="6"></textarea><input type="button" class="the_btn light_blue white blue_border" style="float:right" onclick="submitFileInfo(this)" value="确定"></div></li></ul></div></div>';
		$('body').append(form);
		$('.login-box').css('top',($(window).height()-$('.login-box').height())/2-30)
					   .css('left',($(document).width()-$('.login-box').width())/2);
	}

	$('.login-panel,.login_box_close').on('click',function(){
		$('.login-panel').css('opacity','0');
		$('.login-box').css('opacity','0');
		$('.login-panel').fadeOut();
		$('.login-box').fadeOut(180);
	});

	function submitFileInfo(obj){
		var _title=$('#upload_title').val();
		var _author=$('#upload_author').val();
		var _tags=$('#upload_tags').val();
		var _description=$('#upload_description').val();
		var _path='';
		$.get("get_new_upload_dir.php", function(result){
    		_path=result;

    		var _title=result.split('/');
			_title=_title[_title.length-1];
			_title=_title.split('.');
			var newtitle='';
			for (var i = 0; i < _title.length-1; i++) {
				newtitle+=_title[i];
			};

			_title=newtitle;

			if(_title!='' && _author!='' && _tags!='' && _description!='' && _path!=''){
				$.post("submitfileinfo.php",{
				    title:_title,
				    author:_author,
				    tags:_tags,
				    description:_description,
				    path:_path
				},function(data,status){
					alert(data);
					$('.login-panel').css('opacity','0');
					$('.login-box').css('opacity','0');
					$('.login-panel').fadeOut();
					$('.login-box').fadeOut(180);
				});	
			}else{
				alert("请完整填写信息");
				return false;
			}
  		});
	}

</script>

<!-- uploader div start -->

<?php } ?>		
          <div class="container-fluid">
          
<?php
	    
$class_ext = '';
$src = '';

if ($_GET['type']==1) 	 $apply = 'apply_img';
elseif($_GET['type']==2) $apply = 'apply_link';
elseif($_GET['type']==0 && $_GET['field_id']=='') $apply = 'apply_none';
elseif($_GET['type']==3) $apply = 'apply_video';
else $apply = 'apply';

$files = scandir($current_path.$rfm_subfolder.$subdir);
// print_r($files);
$n_files=count($files);

//php sorting
$sorted=array();
$current_folder=array();
$prev_folder=array();
foreach($files as $k=>$file){
    if($file==".") $current_folder=array('file'=>$file);
    elseif($file=="..") $prev_folder=array('file'=>$file);
    elseif(is_dir($current_path.$rfm_subfolder.$subdir.$file)){
	$date=filemtime($current_path.$rfm_subfolder.$subdir. $file);
	if($show_folder_size){
		$size=foldersize($current_path.$rfm_subfolder.$subdir. $file);
	} else {
		$size=0;
	}
	$file_ext=lang_Type_dir;
	$sorted[$k]=array('file'=>$file,'file_lcase'=>strtolower($file),'date'=>$date,'size'=>$size,'extension'=>$file_ext,'extension_lcase'=>strtolower($file_ext));
    }else{
	$file_path=$current_path.$rfm_subfolder.$subdir.$file;
	$date=filemtime($file_path);
	$size=filesize($file_path);
	$file_ext = substr(strrchr($file,'.'),1);
	$sorted[$k]=array('file'=>$file,'file_lcase'=>strtolower($file),'date'=>$date,'size'=>$size,'extension'=>$file_ext,'extension_lcase'=>strtolower($file_ext));
    }
}

// Should lazy loading be enabled
$lazy_loading_enabled= ($lazy_loading_file_number_threshold == 0 || $lazy_loading_file_number_threshold != -1 && $n_files > $lazy_loading_file_number_threshold) ? true : false;

function filenameSort($x, $y) {
    return $x['file_lcase'] <  $y['file_lcase'];
}
function dateSort($x, $y) {
    return $x['date'] <  $y['date'];
}
function sizeSort($x, $y) {
    return $x['size'] <  $y['size'];
}
function extensionSort($x, $y) {
    return $x['extension_lcase'] <  $y['extension_lcase'];
}

switch($sort_by){
	case 'date':
		usort($sorted, 'dateSort');
		break;
	case 'size':
		usort($sorted, 'sizeSort');
		break;
	case 'extension':
		usort($sorted, 'extensionSort');
		break;
	default:
		usort($sorted, 'filenameSort');
		break;  
}

if(!$descending){
    $sorted=array_reverse($sorted);
}

$files=array_merge(array($prev_folder),array($current_folder),$sorted);
?>          
<!-- header div start -->
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
	    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	    </button>
	    <div class="brand"><?php echo lang_Toolbar; ?> -></div>
	    <div class="nav-collapse collapse">
		<div class="filters">
		    <div class="row-fluid">
			<div class="span4 half">
				  <span class="mobile-inline-visible"><?php echo lang_Operations; ?>:</span>
			    <?php if($upload_files){ ?>
						    <button class="tip btn upload-btn" title="<?php echo  lang_Upload_file; ?>"><i class="rficon-upload"></i></button> 
			    <?php } ?>
			    <?php if($create_text_files){ ?>
						    <!-- <button class="tip btn create-file-btn" title="<?php echo  lang_New_File; ?>"><i class="icon-plus"></i><i class="icon-file"></i></button>  -->
			    <?php } ?>
			    <?php if($create_folders){ ?>
						    <button class="tip btn new-folder" title="<?php echo  lang_New_Folder?>"><i class="icon-plus"></i><i class="icon-folder-open"></i></button> 
			    <?php } ?>
			    <?php if($copy_cut_files || $copy_cut_dirs){ ?>
				    <!-- <button class="tip btn paste-here-btn" title="<?php echo lang_Paste_Here; ?>"><i class="rficon-clipboard-apply"></i></button> 
				    <button class="tip btn clear-clipboard-btn" title="<?php echo lang_Clear_Clipboard; ?>"><i class="rficon-clipboard-clear"></i></button>  -->
				<?php } ?>
			</div>
			<!--<div class="span2 half view-controller">
				  <span class="mobile-inline-visible"><?php echo lang_View; ?>:</span>
			    <button class="btn tip<?php if($view==0) echo " btn-inverse"; ?>" id="view0" data-value="0" title="<?php echo lang_View_boxes; ?>"><i class="icon-th <?php if($view==0) echo "icon-white"; ?>"></i></button>
			    <button class="btn tip<?php if($view==1) echo " btn-inverse"; ?>" id="view1" data-value="1" title="<?php echo lang_View_list; ?>"><i class="icon-align-justify <?php if($view==1) echo "icon-white"; ?>"></i></button>
			    <button class="btn tip<?php if($view==2) echo " btn-inverse"; ?>" id="view2" data-value="2" title="<?php echo lang_View_columns_list; ?>"><i class="icon-fire <?php if($view==2) echo "icon-white"; ?>"></i></button>
			</div>-->
			<!--<div class="span6 half types"> 
				<span><?php echo lang_Filters; ?>:</span>
			    <?php if($_GET['type']!=1 && $_GET['type']!=3){ ?>
			    <input id="select-type-1" name="radio-sort" type="radio" data-item="ff-item-type-1" checked="checked"  class="hide"  />
			    <label id="ff-item-type-1" title="<?php echo lang_Files; ?>" for="select-type-1" class="tip btn ff-label-type-1"><i class="icon-file"></i></label>
			    <input id="select-type-2" name="radio-sort" type="radio" data-item="ff-item-type-2" class="hide"  />
			    <label id="ff-item-type-2" title="<?php echo lang_Images; ?>" for="select-type-2" class="tip btn ff-label-type-2"><i class="icon-picture"></i></label>
			    <input id="select-type-3" name="radio-sort" type="radio" data-item="ff-item-type-3" class="hide"  />
			    <label id="ff-item-type-3" title="<?php echo lang_Archives; ?>" for="select-type-3" class="tip btn ff-label-type-3"><i class="icon-inbox"></i></label>
			    <input id="select-type-4" name="radio-sort" type="radio" data-item="ff-item-type-4" class="hide"  />
			    <label id="ff-item-type-4" title="<?php echo lang_Videos; ?>" for="select-type-4" class="tip btn ff-label-type-4"><i class="icon-film"></i></label>
			    <input id="select-type-5" name="radio-sort" type="radio" data-item="ff-item-type-5" class="hide"  />
			    <label id="ff-item-type-5" title="<?php echo lang_Music; ?>" for="select-type-5" class="tip btn ff-label-type-5"><i class="icon-music"></i></label>
			    <?php } ?>
			    <input accesskey="f" type="text" class="filter-input <?php echo (($_GET['type']!=1 && $_GET['type']!=3) ? '' : 'filter-input-notype'); ?>" id="filter-input" name="filter" placeholder="<?php echo fix_strtolower(lang_Text_filter); ?>..." value="<?php echo $filter; ?>"/><?php if($n_files>$file_number_limit_js){ ?><label id="filter" class="btn"><i class="icon-play"></i></label><?php } ?>
			    
			    <input id="select-type-all" name="radio-sort" type="radio" data-item="ff-item-type-all" class="hide"  />
			     <label id="ff-item-type-all" title="<?php echo lang_All; ?>" <?php if($_GET['type']==1 || $_GET['type']==3){ ?>style="visibility: hidden;" <?php } ?> data-item="ff-item-type-all" for="select-type-all" style="margin-rigth:0px;" class="tip btn btn-inverse ff-label-type-all"><i class="icon-align-justify icon-white"></i></label>
			    
			</div>-->
			<div style="position:absolute;top:6px;font-size:13px;left:100px;color:rgb(119,119,119)"><a href="">滚动条消失?请点这里</a></div>
			<div style="position:absolute;right:-6px;top:6px;"><span>本文献仅限于学习交流</span></div>
		    </div>
		</div>
	    </div>
	</div>
    </div>
</div>
<!-- header div end -->

    <!-- breadcrumb div start -->
    
    <div class="row-fluid">
	<?php	
	$link="dialog.php?".$get_params;
	?>
	<ul class="breadcrumb">	
	<li class="pull-left"><a href="<?php echo $link?>/"><i class="icon-home"></i></a></li>
	<li><span class="divider">/</span></li>
	<?php
	$bc=explode("/",$subdir);
	$tmp_path='';
	if(!empty($bc))
	foreach($bc as $k=>$b){ 
		$tmp_path.=$b."/";
		if($k==count($bc)-2){
	?> <li class="active"><?php echo $b?></li><?php
		}elseif($b!=""){ ?>
		<li><a href="<?php echo $link.$tmp_path?>"><?php echo $b?></a></li><li><span class="divider"><?php echo "/"; ?></span></li>
	<?php }
	}
	?>
	<!--<li class="pull-right"><a class="btn-small" href="javascript:void('')" id="info"><i class="icon-question-sign"></i></a></li>-->
	<li class="pull-right"><a class="btn-small" href="javascript:void('')" id="change_lang_btn"><i class="icon-globe"></i></a></li>
	<li class="pull-right"><a id="refresh" class="btn-small" href="dialog.php?<?php echo $get_params.$subdir."&".uniqid() ?>"><i class="icon-refresh"></i></a></li>
	
	<li class="pull-right">
	    <div class="btn-group">
		<a class="btn dropdown-toggle sorting-btn" data-toggle="dropdown" href="#">
		  <i class="icon-signal"></i> 
		  <span class="caret"></span>
		</a>
		<ul class="dropdown-menu pull-left sorting">
		    <li class="text-center"><strong><?php echo lang_Sorting ?></strong></li>
		<li><a class="sorter sort-name <?php if($sort_by=="name"){ echo ($descending)?"descending":"ascending"; } ?>" href="javascript:void('')" data-sort="name"><?php echo lang_Filename; ?></a></li>
		<li><a class="sorter sort-date <?php if($sort_by=="date"){ echo ($descending)?"descending":"ascending"; } ?>" href="javascript:void('')" data-sort="date"><?php echo lang_Date; ?></a></li>
		<li><a class="sorter sort-size <?php if($sort_by=="size"){ echo ($descending)?"descending":"ascending"; } ?>" href="javascript:void('')" data-sort="size"><?php echo lang_Size; ?></a></li>
		<li><a class="sorter sort-extension <?php if($sort_by=="extension"){ echo ($descending)?"descending":"ascending"; } ?>" href="javascript:void('')" data-sort="extension"><?php echo lang_Type; ?></a></li>
		</ul>
	      </div>
	</li>
	</ul>
    </div>
    <!-- breadcrumb div end -->
    <div class="row-fluid ff-container">
	<div class="span12">	    
	    <?php if(@opendir($current_path.$rfm_subfolder.$subdir)===FALSE){ ?>
	    <br/>
	    <div class="alert alert-error">There is an error! The upload folder there isn't. Check your config.php file. </div> 
	    <?php }else{ ?>
	    <h4 id="help"><?php echo lang_Swipe_help; ?></h4>
	    <?php if(isset($folder_message)){ ?>
		<div class="alert alert-block"><?php echo $folder_message; ?></div>
	    <?php } ?>
	    <?php if($show_sorting_bar){ ?>
	    <!-- sorter -->
	    <div class="sorter-container <?php echo "list-view".$view; ?>">
		<div class="file-name"><a class="sorter sort-name <?php if($sort_by=="name"){ echo ($descending)?"descending":"ascending"; } ?>" href="javascript:void('')" data-sort="name"><?php echo lang_Filename; ?></a></div>
		<div class="file-date"><a class="sorter sort-date <?php if($sort_by=="date"){ echo ($descending)?"descending":"ascending"; } ?>" href="javascript:void('')" data-sort="date"><?php echo lang_Date; ?></a></div>
		<div class="file-size"><a class="sorter sort-size <?php if($sort_by=="size"){ echo ($descending)?"descending":"ascending"; } ?>" href="javascript:void('')" data-sort="size"><?php echo lang_Size; ?></a></div>
		<!-- <div class='img-dimension'><?php echo lang_Dimension; ?></div> -->
		<div class='file-extension'><a class="sorter sort-extension <?php if($sort_by=="extension"){ echo ($descending)?"descending":"ascending"; } ?>" href="javascript:void('')" data-sort="extension"><?php echo lang_Type; ?></a></div>
		<div class='file-operations'><?php echo lang_Operations; ?></div>
	    </div>
	    <?php } ?>
	    
	    <input type="hidden" id="file_number" value="<?php echo $n_files; ?>" />
	    <!--ul class="thumbnails ff-items"-->
	    <ul class="grid cs-style-2 <?php echo "list-view".$view; ?>" id="main-item-container">
		<?php
		$fileIndex=-1;
		$jplayer_ext=array("mp4","flv","webmv","webma","webm","m4a","m4v","ogv","oga","mp3","midi","mid","ogg","wav");
		foreach ($files as $file_array) {
			$fileIndex+=1;
			if($fileIndex>=$_SESSION['current_file_count']+$_SESSION['file_load_step']){
				break;
			}
		  $file=$file_array['file'];
			if($file == '.' || (isset($file_array['extension']) && $file_array['extension']!=lang_Type_dir) || ($file == '..' && $subdir == '') || in_array($file, $hidden_folders) || ($filter!='' && $n_files>$file_number_limit_js && $file!=".." && strpos($file,$filter)===false))
			  continue;
			$new_name=fix_filename($file,$transliteration);
			if($file!='..' && $file!=$new_name){
			    //rename
			    rename_folder($current_path.$subdir.$file,$new_name,$transliteration);
			    $file=$new_name;
			}
			//add in thumbs folder if not exist 
			if (!file_exists($thumbs_path.$subdir.$file)) create_folder(false,$thumbs_path.$subdir.$file);
			$class_ext = 3;			
			if($file=='..' && trim($subdir) != '' ){
		    $src = explode("/",$subdir);
		    unset($src[count($src)-2]);
		    $src=implode("/",$src);
		    if($src=='') $src="/";
				}
				elseif ($file!='..') {
				    $src = $subdir . $file."/";
				}
			
			?>
			<?php
				$r=$fm->isDisplayedA("../sorce/".$_SESSION['RF']['subfolder']."/".$file);
				if($r===0){
					$isShouldBeDisplayed="display:none";
				}else{$isShouldBeDisplayed='';}
			?>
			    <li data-name="<?php echo $file ?>" style="<?php echo $isShouldBeDisplayed; ?>" class="<?php if($file=='..') echo 'back'; else echo 'dir'; ?>" <?php if(($filter!='' && strpos($file,$filter)===false)) echo ' style="display:none;"'; ?>><?php 
			    $file_prevent_rename = false;
			    $file_prevent_delete = false;
			    if (isset($filePermissions[$file])) {
				$file_prevent_rename = isset($filePermissions[$file]['prevent_rename']) && $filePermissions[$file]['prevent_rename'];
				$file_prevent_delete = isset($filePermissions[$file]['prevent_delete']) && $filePermissions[$file]['prevent_delete'];
			    }
			    ?><figure data-name="<?php echo $file ?>" class="<?php if($file=="..") {echo "back-";} ?>directory" data-type="<?php if($file!=".."){ echo "dir"; } ?>">
			    <?php if($file==".."){ ?>
			    <?php
			    ?>
			    	<input type="hidden" class="path" value="<?php echo str_replace('.','',dirname($rfm_subfolder.$subdir)); ?>"/>
			    	<input type="hidden" class="path_thumb" value="<?php echo dirname($thumbs_path.$subdir)."/"; ?>"/>
			    <?php }else{
			    } ?>
				  <a class="folder-link" href="dialog.php?<?php echo $get_params.rawurlencode($src)."&".uniqid(); ?>">
					  <div class="img-precontainer">
							<div class="img-container directory"><span></span>
							<img class="directory-img" src="img/<?php echo $icon_theme; ?>/folder<?php if($file==".."){ echo "_back"; }?>.png" />
							</div>
					  </div>
				    <div class="img-precontainer-mini directory">
							<div class="img-container-mini">
						    <span></span>
						    <img class="directory-img"  src="img/<?php echo $icon_theme; ?>/folder<?php if($file==".."){ echo "_back"; }?>.png" />
							</div>
				    </div>
			<?php if($file==".."){ ?>
				    <div class="box no-effect">
					<h4><?php echo lang_Back ?></h4>
				    </div>
				    </a>
				    
			<?php }else{ ?>
				    </a>
				    <div class="box">
					<h4 class="<?php if($ellipsis_title_after_first_row){ echo "ellipsis"; } ?>"><a class="folder-link" data-file="<?php echo $file ?>" href="dialog.php?<?php echo $get_params.rawurlencode($src)."&".uniqid() ?>"><?php echo $file; ?></a></h4>
				    </div>
				    <input type="hidden" class="name" value="<?php echo $file_array['file_lcase'];  ?>"/>
				    <input type="hidden" class="date" value="<?php echo $file_array['date']; ?>"/>
				    <input type="hidden" class="size" value="<?php echo $file_array['size'];  ?>"/>
				    <input type="hidden" class="extension" value="<?php echo lang_Type_dir; ?>"/>
				    <div class="file-date"><?php echo date(lang_Date_type,$file_array['date'])?></div>
				    <?php if($show_folder_size){ ?><div class="file-size"><?php echo makeSize($file_array['size'])?></div><?php } ?>
				    <div class='file-extension'><?php echo lang_Type_dir; ?></div>
				    <figcaption>
					    <a href="javascript:void('')" class="tip-left edit-button rename-file-paths <?php if($rename_folders && !$file_prevent_rename) echo "rename-folder"; ?>" title="<?php echo lang_Rename?>" data-path="<?php echo $rfm_subfolder.$subdir.$file; ?>" data-thumb="<?php echo $thumbs_path.$subdir.$file; ?>">
					    <i class="icon-pencil <?php if(!$rename_folders || $file_prevent_rename) echo 'icon-white'; ?>"></i></a>
					    <a href="javascript:void('')" class="tip-left erase-button <?php if($delete_folders && !$file_prevent_delete) echo "delete-folder"; ?>" title="<?php echo lang_Erase?>" data-confirm="<?php echo lang_Confirm_Folder_del; ?>" data-path="<?php echo $rfm_subfolder.$subdir.$file; ?>"  data-thumb="<?php echo $thumbs_path.$subdir .$file; ?>">
					    <i class="icon-trash <?php if(!$delete_folders || $file_prevent_delete) echo 'icon-white'; ?>"></i>
					    </a>
				    </figcaption>
			<?php } ?>
			    </figure>
			</li>
			<?php
		    }
			
			$fileIndex=-1;
            $files_prevent_duplicate = array();
		    foreach ($files as $nu=>$file_array) {
		   	$fileIndex+=1;
			if($fileIndex>=$_SESSION['current_file_count']+$_SESSION['file_load_step']){
				break;
			}
			$file=$file_array['file'];
		    
			    if($file == '.' || $file == '..' || is_dir($current_path.$rfm_subfolder.$subdir.$file) || in_array($file, $hidden_files) || !in_array(fix_strtolower($file_array['extension']), $ext) || ($filter!='' && $n_files>$file_number_limit_js && strpos($file,$filter)===false))
				    continue;
			    
			    $file_path=$current_path.$rfm_subfolder.$subdir.$file;
			    //check if file have illegal caracter
			    
			    $filename=substr($file, 0, '-' . (strlen($file_array['extension']) + 1));
			    
			    if($file!=fix_filename($file,$transliteration)){
				$file1=fix_filename($file,$transliteration);
				$file_path1=($current_path.$rfm_subfolder.$subdir.$file1);
				if(file_exists($file_path1)){
				    $i = 1;
				    $info=pathinfo($file1);
				    while(file_exists($current_path.$rfm_subfolder.$subdir.$info['filename'].".[".$i."].".$info['extension'])) {
					    $i++;
				    }
				    $file1=$info['filename'].".[".$i."].".$info['extension'];
				    $file_path1=($current_path.$rfm_subfolder.$subdir.$file1);
				}
				
				$filename=substr($file1, 0, '-' . (strlen($file_array['extension']) + 1));
				rename_file($file_path,fix_filename($filename,$transliteration),$transliteration);
				$file=$file1;
				$file_array['extension']=fix_filename($file_array['extension'],$transliteration);
				$file_path=$file_path1;
			    }
			    
			    $is_img=false;
			    $is_video=false;
			    $is_audio=false;
			    $show_original=false;
			    $show_original_mini=false;
			    $mini_src="";
			    $src_thumb="";
			    $extension_lower=fix_strtolower($file_array['extension']);
			    if(in_array($extension_lower, $ext_img)){
				$src = $base_url . $cur_dir . rawurlencode($file);
				$mini_src = $src_thumb = $thumbs_path.$subdir. $file;
				//add in thumbs folder if not exist
				if(!file_exists($src_thumb)){
			    try {
			    	if(!create_img($file_path, $src_thumb, 122, 91)){
							$src_thumb=$mini_src="";
						}else{
							new_thumbnails_creation($current_path.$rfm_subfolder.$subdir,$file_path,$file,$current_path,'','','','','','','',$fixed_image_creation,$fixed_path_from_filemanager,$fixed_image_creation_name_to_prepend,$fixed_image_creation_to_append,$fixed_image_creation_width,$fixed_image_creation_height,$fixed_image_creation_option);
						}
			    } catch (Exception $e) {
						$src_thumb=$mini_src="";
			    }
				}
				$is_img=true;
				//check if is smaller than thumb
				list($img_width, $img_height, $img_type, $attr)=@getimagesize($file_path);
				if($img_width<122 && $img_height<91){ 
					$src_thumb=$current_path.$rfm_subfolder.$subdir.$file;
					$show_original=true;
				}
				
				if($img_width<45 && $img_height<38){
				    $mini_src=$current_path.$rfm_subfolder.$subdir.$file;
				    $show_original_mini=true;
				}
			    }
			    $is_icon_thumb=false;
			    $is_icon_thumb_mini=false;
			    $no_thumb=false;
			    if($src_thumb==""){
				$no_thumb=true;
				if(file_exists('img/'.$icon_theme.'/'.$extension_lower.".jpg")){
					$src_thumb ='img/'.$icon_theme.'/'.$extension_lower.".jpg";
				}else{
					$src_thumb = "img/".$icon_theme."/default.jpg";
				}
				$is_icon_thumb=true;
			    }
			    if($mini_src==""){
				$is_icon_thumb_mini=false;
			    }
			    
			    $class_ext=0;
			    if (in_array($extension_lower, $ext_video)) {
				    $class_ext = 4;
				    $is_video=true;
			    }elseif (in_array($extension_lower, $ext_img)) {
				    $class_ext = 2;
			    }elseif (in_array($extension_lower, $ext_music)) {
				    $class_ext = 5;
				    $is_audio=true;
			    }elseif (in_array($extension_lower, $ext_misc)) {
				    $class_ext = 3;
			    }else{
				    $class_ext = 1;
			    }
			    if((!($_GET['type']==1 && !$is_img) && !(($_GET['type']==3 && !$is_video) && ($_GET['type']==3 && !$is_audio))) && $class_ext>0){
?>
		    <li  class="ff-item-type-<?php echo $class_ext; ?> file"  data-name="<?php echo $file; ?>" <?php if(($filter!='' && strpos($file,$filter)===false)) echo ' style="display:none;"'; ?>><?php
		    $file_prevent_rename = false;
		    $file_prevent_delete = false;
		    if (isset($filePermissions[$file])) {
			if (isset($filePermissions[$file]['prevent_duplicate']) && $filePermissions[$file]['prevent_duplicate']) {
			    $files_prevent_duplicate[] = $file;
			}
			$file_prevent_rename = isset($filePermissions[$file]['prevent_rename']) && $filePermissions[$file]['prevent_rename'];
			$file_prevent_delete = isset($filePermissions[$file]['prevent_delete']) && $filePermissions[$file]['prevent_delete'];
		    }
            ?>		<figure data-name="<?php echo $file ?>" data-type="<?php if($is_img){ echo "img"; }else{ echo "file"; } ?>">
				<a href="javascript:void('')" class="link" data-file="<?php echo $file; ?>" data-field_id="<?php echo $field_id; ?>" data-function="<?php echo $apply; ?>">
				<div class="img-precontainer">
				    <?php if($is_icon_thumb){ ?><div class="filetype"><?php echo $extension_lower ?></div><?php } ?>
				    <div class="img-container">
					    <span></span>
					    <img class="<?php echo $show_original ? "original" : "" ?><?php echo $is_icon_thumb ? " icon" : "" ?><?php echo $lazy_loading_enabled ? " lazy-loaded" : ""?>" <?php echo $lazy_loading_enabled ? "data-original" : "src"?>="<?php echo $src_thumb; ?>">
				    </div>
				</div>
				<div class="img-precontainer-mini <?php if($is_img) echo 'original-thumb' ?>">
				    <div class="filetype <?php echo $extension_lower ?> <?php if(in_array($extension_lower, $editable_text_file_exts)) echo 'edit-text-file-allowed' ?> <?php if(!$is_icon_thumb){ echo "hide"; }?>"><?php echo $extension_lower ?></div>
				    <div class="img-container-mini">
					<span></span>
					<?php if($mini_src!=""){ ?>
					<img class="<?php echo $show_original_mini ? "original" : "" ?><?php echo $is_icon_thumb_mini ? " icon" : "" ?><?php echo $lazy_loading_enabled ? " lazy-loaded" : ""?>" <?php echo $lazy_loading_enabled ? "data-original" : "src"?>="<?php echo $mini_src; ?>">
					<?php } ?>
				    </div>
				</div>
				<?php if($is_icon_thumb){ ?>
				<div class="cover"></div>
				<?php } ?>
				</a>	
				<div class="box">				
				<h4 class="<?php if($ellipsis_title_after_first_row){ echo "ellipsis"; } ?>"><a href="javascript:void('')" class="link" data-file="<?php echo $file; ?>" data-field_id="<?php echo $field_id; ?>" data-function="<?php echo $apply; ?>">
				<?php echo $filename; ?></a> </h4>
				</div>
				<input type="hidden" class="date" value="<?php echo $file_array['date']; ?>"/>
				<input type="hidden" class="size" value="<?php echo $file_array['size'] ?>"/>
				<input type="hidden" class="extension" value="<?php echo $extension_lower; ?>"/>
				<input type="hidden" class="name" value="<?php echo $file_array['file_lcase']; ?>"/>
				<div class="file-date"><?php echo date(lang_Date_type,$file_array['date'])?></div>
				<div class="file-size"><?php echo makeSize($file_array['size'])?></div>
				<!-- <div class='img-dimension'><?php if($is_img){ echo $img_width."x".$img_height; } ?></div> -->
				<div class='file-extension'><?php echo $extension_lower; ?></div>
				<figcaption id="#fucklistalter">
				    <form action="force_download.php" method="post" class="download-form" id="form<?php echo $nu; ?>">
					<input type="hidden" name="path" value="<?php echo $rfm_subfolder.$subdir?>"/>
					<input type="hidden" class="name_download" name="name" value="<?php echo $file?>"/>
				    <a title="<?php echo lang_Download?>" class="tip-right" href="javascript:void('')" onclick="$('#form<?php echo $nu; ?>').submit();"><i class="icon-download"></i></a>
				    <?php if($is_img && $src_thumb!=""){ ?>
				    <a style="display:none;" class="tip-right preview" title="<?php echo lang_Preview?>" data-url="<?php echo $src;?>" data-toggle="lightbox" href="#previewLightbox"><i class=" icon-eye-open"></i></a>
				    <?php }elseif(($is_video || $is_audio) && in_array($extension_lower,$jplayer_ext)){ ?>
				    <a style="display:none;" class="tip-right modalAV <?php if($is_audio){ echo "audio"; }else{ echo "video"; } ?>"
					title="<?php echo lang_Preview?>" data-url="ajax_calls.php?action=media_preview&title=<?php echo $filename; ?>&file=<?php echo $current_path.$rfm_subfolder.$subdir.$file; ?>"
					href="javascript:void('');" ><i class=" icon-eye-open"></i></a>
						<?php }elseif($preview_text_files && in_array($extension_lower,$previewable_text_file_exts)){ ?>
					    <a style="display:none;" class="tip-right file-preview-btn" title="<?php echo lang_Preview?>" data-url="ajax_calls.php?action=get_file&sub_action=preview&preview_mode=text&title=<?php echo $filename; ?>&file=<?php echo $current_path.$rfm_subfolder.$subdir.$file; ?>"
						href="javascript:void('');" ><i class=" icon-eye-open"></i></a>
						<?php }elseif($googledoc_enabled && in_array($extension_lower,$googledoc_file_exts)){ ?>
					    <a style="display:none;" class="tip-right file-preview-btn" title="<?php echo lang_Preview?>" data-url="ajax_calls.php?action=get_file&sub_action=preview&preview_mode=google&title=<?php echo $filename; ?>&file=<?php echo $current_path.$rfm_subfolder.$subdir.$file; ?>"
						href="docs.google.com;" ><i class=" icon-eye-open"></i></a>	

						<?php }elseif($viewerjs_enabled && in_array($extension_lower,$viewerjs_file_exts)){ ?>
					    <a style="display:none;" class="tip-right file-preview-btn" title="<?php echo lang_Preview?>" data-url="ajax_calls.php?action=get_file&sub_action=preview&preview_mode=viewerjs&title=<?php echo $filename; ?>&file=<?php echo $current_path.$rfm_subfolder.$subdir.$file; ?>"
						href="docs.google.com;" ><i class=" icon-eye-open"></i></a>	    
						
				    <?php }else{ ?>
				    <a style="display:none;" class="preview disabled"><i class="icon-eye-open icon-white"></i></a>
				    <?php } ?>
				    <?php

           	 			$fid=$fm->getFidByPath($current_path.$rfm_subfolder.$subdir.$file);
           	 			$starFlag=$fm->isFileStard($fid['fid'],$_SESSION['uuid']);
           	 			
				    ?>
				    <a href="javascript:void('')" id="<?php echo $fid['fid']; ?>" onclick="starFile(this,'<?php if($starFlag){echo '取消标星';}else{echo '标星';} ?>')" class="tip-left star-button star-file" title="<?php if($starFlag){echo '取消标星';}else{echo '标星';} ?>" data-path="<?php echo $rfm_subfolder.$subdir .$file; ?>" data-thumb="<?php echo $thumbs_path.$subdir .$file; ?>">
 				    <i class="icon-star icon-<?php if($starFlag){echo 'blue';}else{echo 'white';} ?>"></i></a>

				    <a href="javascript:void('')" class="tip-left edit-button rename-file-paths <?php if($rename_files && !$file_prevent_rename) echo "rename-file"; ?>" title="<?php echo lang_Rename?>" data-path="<?php echo $rfm_subfolder.$subdir .$file; ?>" data-thumb="<?php echo $thumbs_path.$subdir .$file; ?>">
 				    <i class="icon-pencil <?php if(!$rename_files || $file_prevent_rename) echo 'icon-white'; ?>"></i></a>

				    <a href="javascript:void('')" class="tip-left erase-button <?php if($delete_files && !$file_prevent_delete) echo "delete-file"; ?>" title="<?php echo lang_Erase?>" data-confirm="<?php echo lang_Confirm_del; ?>" data-path="<?php echo $rfm_subfolder.$subdir.$file; ?>" data-thumb="<?php echo $thumbs_path.$subdir .$file; ?>">
 				    <i class="icon-trash <?php if(!$delete_files || $file_prevent_delete) echo 'icon-white'; ?>"></i></a>
				    
				    </form>
				</figcaption>
			</figure>			
		</li>
			<?php
			}
		    }
	?></div>
	    </ul>
	    <style type="text/css">
			.load-more-div{
				width: 100%;
				text-align: center;
				border-top: 1px solid rgb(170,170,170);
				border-bottom: 1px solid rgb(170,170,170);
				background: rgb(255,255,255);
				/*margin-top: 20px;*/
				/*margin-bottom: 10px;*/
				margin-top: -1px;
				line-height: 2.4;
			}

			.load-more-div:hover{
				cursor: pointer;
				background: rgb(224,224,224);
			}
	
			.load-more-select select{
				margin-top: 10px;
			}

	    </style>
	    <?php

	    	function getDirFileCount($dir){
	    		return count(scandir($dir))-2;
	    	}

	    	if($_SESSION['RF']["subfolder"]='328eb3c3-d632-11e4-9a8c-00163e002b11' && $_SESSION['RF']['view_type']==0){
				
			}else{
				echo "<div class=\"load-more-div load-more-prev\">上一页</div>";
				echo "<div class=\"load-more-div load-more-select\"><select style=\"width:80px\" id=\"page-nav\">";
				$AllPages=getDirFileCount($current_path.$rfm_subfolder.$subdir);
				$AllPages=ceil($AllPages/20);
				if($AllPages>1){
					for ($i=1; $i <= $AllPages; $i++) { 
						echo "<option value=\"$i\">$i</option>";
					}
				}
				echo "</select></div>";
				echo "<div class=\"load-more-div load-more-next\">下一页</div>";
			}
	    ?>
	    <script type="text/javascript">
	    	
	    	$('.load-more-next').click(function(){
	    		var current=$('.load-more-select option:selected').val();
	    		$.get('ajax/addfileloadcount.php?page='+(parseInt(current)+1),function(){
	    			localStorage.fromLoadMore="true";
	    			location.reload();
	    		});
	    	});

	    	$('.load-more-prev').click(function(){
	    		var current=$('.load-more-select option:selected').val();
	    		$.get('ajax/addfileloadcount.php?page='+(parseInt(current)-1),function(){
	    			localStorage.fromLoadMore="true";
	    			location.reload();
	    		});
	    	});

	    	$('.load-more-select #page-nav').change(function(){
	    		var toPage=$(this).children('option:selected').val();
	    		$.get('ajax/addfileloadcount.php?page='+toPage,function(data){
	    			localStorage.fromLoadMore="true";
	    			location.reload();
	    		});
	    	});

	    	$('.load-more-select select option').each(function(e){
	    		if(e+1==parseInt(<?php echo $_SESSION['current_file_count']; ?>)/10){
	    			$(this).attr('selected','selected');
	    		}
	    	});

/*	    	window.onbeforeunload = function(){   
              	var n = window.event.screenX - window.screenLeft;   
              	var b = n > document.documentElement.scrollWidth-20;   
              	if(b && window.event.clientY < 0 || window.event.altKey){  
                    window.event.returnValue = "$.get('ajax/unsetSession.php')"; 
              	}
       		}
*/
       		$(window).unload(function(){
				if(localStorage.fromLoadMore=='false' || localStorage.fromLoadMore=='undefined'){
					$.get('ajax/unsetSession.php');
				}
				localStorage.fromLoadMore='false';
			}); 
	    </script>
	    <?php } ?>
	</div>
    </div>
</div>
<script>
    var files_prevent_duplicate = new Array();
    <?php
    foreach ($files_prevent_duplicate as $key => $value): ?>
        files_prevent_duplicate[<?php echo $key;?>] = '<?php echo $value; ?>';
    <?php endforeach; ?>


function getExplorer() {
	var explorer = window.navigator.userAgent ;
	//ie 
	if (explorer.indexOf("MSIE") >= 0) {
		return 'ie';
	}
	//firefox 
	else if (explorer.indexOf("Firefox") >= 0) {
		return 'ff';
	}
	//Chrome
	else if(explorer.indexOf("Chrome") >= 0){
		return 'chrome';
	}
	//Opera
	else if(explorer.indexOf("Opera") >= 0){
		return 'opera';
	}
	//Safari
	else if(explorer.indexOf("Safari") >= 0){
		return 'safari';
	}
}

var ex=getExplorer();
if(ex=='chrome'){
	$('.list-view1.grid figcaption').css('padding','0px').css('padding-top','8px');
}
</script>

    <!-- lightbox div start -->    
    <div id="previewLightbox" class="lightbox hide fade"  tabindex="-1" role="dialog" aria-hidden="true">
	    <div class='lightbox-content'>
		    <img id="full-img" src="">
	    </div>    
    </div>
    <!-- lightbox div end -->

    <!-- loading div start -->  
    <div id="loading_container" style="display:none;">
	    <div id="loading" style="background-color:#000; position:fixed; width:100%; height:100%; top:0px; left:0px;z-index:100000"></div>
	    <img id="loading_animation" src="img/storing_animation.gif" alt="loading" style="z-index:10001; margin-left:-32px; margin-top:-32px; position:fixed; left:50%; top:50%"/>
    </div>
    <!-- loading div end -->
    
    <!-- player div start -->
    <div class="modal hide fade" id="previewAV">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?php echo lang_Preview; ?></h3>
      </div>
      <div style="display:none" class="modal-body">
      	<div class="row-fluid body-preview">
				</div>
      </div>
      
    </div>
    <!-- player div end -->
    <img id='aviary_img' src='' class="hide"/>

    <?php if ($lazy_loading_enabled) { ?>
        <script src="js/jquery.lazyload.min.js" type="text/javascript"></script>
        <script src="js/jquery.scrollstop.min.js" type="text/javascript"></script>

        <script>
        	$(function(){
        		$(".lazy-loaded").lazyload({
				    event: 'scrollstop'
				});
        	});

        	function starFile(obj,current){
        		var _this=$(obj);

        		$.ajax({
        			type: "POST",
        			url: "execute.php?action=star_file", 
        			data:{
        				path_thumb:_this.attr('data-thumb'),
        				path:_this.attr('data-path')
        			},
        			context: document.body, 
        			success: function(data){
        				alert(data);
      			}});
        	}
        </script>
    <?php } ?>
    <script type="text/javascript">
	   	// $.get('ajax/unsetSession.php');
	   	localStorage.viewClick=0;
    </script>
</body>
</html>
<?php } ?>
