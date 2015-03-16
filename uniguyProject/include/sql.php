<?php

require('config.php');

/**
* person
*/
class user{
	
	private $uid;
	private $name;
	private $password;
	private $lastLoginTime;
	private $starCount;
	private $downloadCount;
	private $privilege;
	private $userpath;

	function getDownloadCount(){
		return $this->downloadCount;
	}

	function getPrivilege(){
		return $this->privilege;
	}

	function getUserPath(){
		return $this->userpath;
	}

	function getLastLoginTime(){
		return $this->lastLoginTime;
	}

	function getStarCount(){
		return $this->starCount;
	}

	function getUid(){
		return $this->uid;
	}

	function getName(){
		return $this->name;
	}

	function getPassword(){
		return $this->password;
	}

}

/**
* fm file
*/
class fmFile{
	
	private $fid;
	private $uid;
	private $path;
	private $fileExt;
	private $tags;
	private $isStard;
	private $isDeleted;
	private $downloadCount;
	private $isDisplayed;
	private $fileTime;

	function isDisplayed(){
		return $this->isDisplayed;
	}

	function getFileTime(){
		return $this->fileTime;
	}

	function getFid(){
		return $this->fid;
	}

	function getUid(){
		return $this->uid;
	}

	function getPath(){
		return $this->path;
	}

	function getFileExt(){
		return $this->fileExt;
	}

	function isStard(){
		return $this->isStard;
	}

	function isDeleted(){
		return $this->isDeleted;
	}

	function downloadCount(){
		return $this->downloadCount;
	}

}

class fmDownload{

	private $donid;
	private $fid;
	private $downloadTime;
	
	function getDonid(){return $this->donid;}

	function getFid(){return $this->fid;}

	function getDownloadTime(){return $this->downloadTime;}

}

class fmStars{

	private $stid;
	private $uid;
	private $fid;
	
	function getStid(){return $this->stid;}

	function getUid(){return $this->uid;}

	function getFid(){return $this->fid;}

}


class fmComment{

	private $coid;
	private $fid;
	private $uid;
	private $content;
	
	function getCoid(){return $this->coid;}

	function getFid(){return $this->fid;}

	function getUid(){return $this->uid;}

	function getContent(){return $this->content;}

}

class fmWorkpoints{

	private $wpid;
	private $uid;
	private $fid;
	private $grade;
	
	function getWpid(){return $this->wpid;}

	function getUid(){return $this->uid;}

	function getFid(){return $this->fid;}

	function getGrade(){return $this->grade;}

}

/**
* class pdoOperation
* 用于封装查询语句时的必须查询过程
* @submitQuery()使用pdo的预处理语句进行查询,比较安全
* @fetchClassQuery()返回对应数据库的class
* @fetchOdd()返回单个值
*/
class pdoOperation{

	//基础数据库记录
	public $userDB="SELECT * FROM `fmdb_user`;";
	public $singleUserDB="SELECT * FROM `fmdb_user` WHERE `uid`=?";
	public $fileDB="SELECT * FROM `fmdb_file`;";
	public $downloadDB="SELECT * FROM `fmdb_download`;";
	public $starsDB="SELECT * FROM `fmdb_stars`;";
	public $commentsDB="SELECT * FROM `fmdb_comment`;";
	public $workpointsDB="SELECT * FROM `fmdb_workpoints`;";

	//星标文件数目及下载数目
	public $updateStarsCountDB="UPDATE `fmdb_user` SET `starCount` = `starCount`+1 WHERE `uid` = ?;";
	public $updateDownloadCountDB="UPDATE `fmdb_user` SET `downloadCount` = `downloadCount`+1 WHERE `uid` = ?;";

	//用户记录:留言记录/星标记录/下载记录/上传记录/评分
	public $commentsRecord="SELECT * FROM `fmdb_comments` WHERE `uid`=?;";
	public $starsRecord="SELECT * FROM `fmdb_stars` WHERE `uid`=?;";
	public $downloadRecord="SELECT * FROM `fmdb_download` WHERE `uid`=?;";
	public $uploadRecord='SELECT * FROM `fmdb_file` WHERE `uid`=?;';
	public $workpointsRecord="SELECT `fid`, `grade` FROM `fmdb_workpoints` WHERE `uid`=?;";

	//更新文件下载次数
	public $updateFileDownloadCount="UPDATE `fmdb_file` SET `downloadCount` = `downloadCount`+1 WHERE `fid`=?;";
	public $selectFileByFid='SELECT * FROM `fmdb_file` WHERE `fid`=?;';

	//最近N天文献
	public $latestDoc="";

	//删除留言
	public $removeComments="DELETE FROM `fmdb_comments` WHERE `coid`=? and `uid`=?;";

	//取消星标
	public $removeStars="DELETE FROM `fmdb_stars` WHERE `stid`=? and `uid`=?;
			UPDATE `fmdb_user` SET `starCount` = `starCount`-1 WHERE `uid` = ?;";

	//删除下载记录
	public $removeDownloadRecord="DELETE FROM `fmdb_download` WHERE `donid`=? and `uid`=?;
			UPDATE `fmdb_user` SET `downloadCount` = `downloadCount`-1 WHERE `uid` = ?;";

	//删除上传记录
	public $removeUploadRecord="UPDATE `fmdb_file` SET `isDisplayed` = '0' WHERE `fid`=? and `uid`=?;";

	//更新一些文件数据
	public $updateFileDB="INSERT INTO `fmdb_file` (`uid`, `path`, `fileExt`, `tag`, `isStard`, `isDeleted`, `downloadCount`,`isDisplayed`) 
			VALUES (?,?,?,?,'0','0','0','1');";
	public $updateDownloadDB="INSERT INTO `fmdb_download` (`fid`,`uid`,`downloadTime`) 
			VALUES (?,?,CURRENT_TIMESTAMP);
			UPDATE `fmdb_user` SET `downloadCount` = `downloadCount`+1 WHERE `uid` = ?;";
	public $updateUploadDB="INSERT INTO `fmdb_file` (`uid`, `path`, `fileExt`, `tags`, `isStard`, `isDeleted`, `downloadCount`, `isDisplayed`, `createTime`) 
			VALUES (?, ?, ?, ?, '0', '0', '0', '1', CURRENT_TIMESTAMP);";
	public $updateStarsDB="INSERT INTO `fmdb_stars` (`uid`, `fid`) VALUES (?, ?);
			UPDATE `fmdb_user` SET `starCount` = `starCount`+1 WHERE `uid` = ?;";
	public $updateCommentsDB="INSERT INTO `fmdb_comments` (`fid`, `uid`, `content`) VALUES (?,?,?);";
	public $updateWorkpointsDB="INSERT INTO `fmdb_workpoints` (`uid`, `fid`, `grade`) VALUES (?,?,?);";

	//登录/改密
	public $loginIn="SELECT * FROM `fmdb_user` WHERE `name`=? AND `password`=SHA1(?)";
	public $alterPW="UPDATE `fmdb_user` SET `password`=SHA1(?) WHERE `name`=? AND `password`=SHA1(?)";

	//更改权限
	public $alterPrivilege="UPDATE `fmdb_user` SET `privilege` = ? WHERE `uid` = ?;";

	//注册
	public $selectUser="SELECT `uid` FROM `fmdb_user` WHERE `name`=?";
	public $registerUser="INSERT INTO `fmdb_user` (`name`, `password`, `starCount`, `downloadCount`, `privilege`, `userpath`, `lastLoginTime`) 
			VALUES (?,SHA1(?),'0', '0', '0', ?, CURRENT_TIMESTAMP);";
	//split page
	//public $pageCG="SELECT * FROM `fmdb_` ORDER BY `id` DESC LIMIT ";

	protected static $pdo;

	private $fetchMode=PDO::FETCH_CLASS;
	private $fetchModeChanged=false;
	
	function __construct($pdo){
		self::$pdo=$pdo;
		self::$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); //禁用prepared statements的仿真效果
	}

	function setInnerFetchMode($mode){
		$this->fetchMode=$mode;
		$this->fetchModeChanged=true;
	}

	function submitQuery($sql,$arr){
		if(!(is_array($arr))){
			return false;
		}
		$stmt=self::$pdo->prepare($sql);
		$result=$stmt->execute($arr);
		return $result;
	}

	function fetchClassQuery($sql,$arr='',$className=''){
		if(!(is_array($arr))){
			return false;
		}
		$stmt=self::$pdo->prepare($sql);
		$res=$stmt->execute($arr);

		if($this->fetchModeChanged){
			$stmt->setFetchMode($this->fetchMode);
		}else{
			$stmt->setFetchMode($this->fetchMode,$className);
		}
		
		if ($res) {
			if($draft=$stmt->fetchAll()) {
				return $draft;
			}else{
				return false;}
		}else{
			return false;}
	}

	function fetchOdd($sql,$arr){
		if(!(is_array($arr))){
			return false;
		}
		$stmt=self::$pdo->prepare($sql);

		if($stmt){
			$stmt->execute($arr);
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			return $row;
		}else{return false;}
	}
}

/**
* user management,用户登录/注册,修改密码
*/
class userMgr extends pdoOperation{
		
	function __construct($pdo){
		parent::$pdo=$pdo;
	}

	function login($name,$pw){
		return $this->fetchClassQuery($this->loginIn,array($name,$pw),'user');
	}

	function changePassword($name,$old,$new){
		return $this->submitQuery($this->alterPW,array($new,$name,$old));
	}

	function register($name,$pw,$userpath){
		$uid=$this->fetchOdd($this->selectUser,array($name));
		if($uid){
			return -1;//用户名重复
		}else{
			return $this->submitQuery($this->registerUser,array($name,$pw,$userpath));
		}
	}

	function changePrivilege($uid,$p){
		return $this->submitQuery($this->alterPrivilege,array($p,$uid));
	}

}

/**
* user db
*/
class userDB extends userMgr{
	
	function getUser($uid=null){
		if($uid!=null){
			return $this->fetchClassQuery($this->singleUserDB,array($uid),'user');
		}else{
			return $this->fetchClassQuery($this->userDB,array(),'user');
		}
	}
}

/**
* file manager
*/
class fileMgr extends pdoOperation{
	
	function __construct($pdo){
		parent:$pdo=$pdo;
	}

	function download($fid,$uid){
		return $this->submitQuery($this->updateDownloadDB,array($fid,$uid));
	}

	function upload($uid, $path, $fileExt, $tags){
		return $this->submitQuery($this->updateUploadDB,array($uid, $path, $fileExt, $tags));
	}

	function comment($fid,$uid,$content){
		return $this->submitQuery($this->updateCommentsDB,array($fid,$uid,$content));
	}

	function star($uid,$fid){
		return $this->submitQuery($this->updateStarsDB,array($uid,$fid,$uid));
	}

	function remark($uid,$fid,$grade){
		return $this->submitQuery($this->updateWorkpointsDB,array($uid,$fid,$grade));
	}

	function getComments($uid){
		return $this->fetchClassQuery($this->commentsRecord,array($uid),'fmComment');
	}

	function getStars($uid){
		return $this->fetchClassQuery($this->starsRecord,array($uid),'fmStars');
	}

	function getRemark($uid){
		return $this->fetchClassQuery($this->workpointsRecord,array($uid),'fmWorkpoints');
	}

	function getDownloadRecords($uid){
		return $this->fetchClassQuery($this->downloadRecord,array($uid),'fmDownload');
	}

	function getUploadRecords($uid){
		return $this->fetchClassQuery($this->uploadRecord,array($uid),'fmFile');
	}

	function removeUploadRecord($fid,$uid){
		return $this->submitQuery($this->removeUploadRecord,array($fid,$uid));
	}

	function removeDownloadRecord($donid,$uid){
		return $this->submitQuery($this->removeDownloadRecord,array($donid,$uid));
	}

	function deleteComments($coid,$uid){
		return $this->submitQuery($this->removeComments,array($coid,$uid));
	}

	function deleteStars($stid,$uid){
		return $this->submitQuery($this->removeStars,array($stid,$uid));
	}

	function getDownloadCount(){

	}

	function getTotalDownloadCount(){

	}

	function getUploadCount(){

	}

	function getCommentsCount(){

	}

}

$pdo=new PDO("mysql:dbname=$dbname;host=$host",$user,$password);
$user=new userMgr($pdo);

$user->register('ivyd','123456','2');
$foo=$user->login('ivy','234567');
if($foo){
	echo 'correct';
	print_r($foo);
}else{
	echo 'failed';
}

$udb=new userDB($pdo);
print_r($udb->getUser(1));

//echo $foo->getUid();
//echo $foo->getName();

//$user->changePassword('ivy','123456','234567');
?>