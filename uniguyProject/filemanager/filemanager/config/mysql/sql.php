<?php

require('config.php');

/**
* person
*/
class user{
	
	private $id;
	private $uid;
	private $name;
	private $password;
	private $lastLoginTime;
	private $starCount;
	private $downloadCount;
	private $privilege;
	private $group;
	private $userpath;

	function getId(){
		return $this->id;
	}

	function getGroup(){
		return $this->group;
	}

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
	
	private $id;
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

	function getId(){
		return $this->id;
	}

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

	private $id;
	private $donid;
	private $fid;
	private $downloadTime;
		
	function getId(){
		return $this->id;
	}

	function getDonid(){return $this->donid;}

	function getFid(){return $this->fid;}

	function getDownloadTime(){return $this->downloadTime;}

}

class fmStars{

	private $id;
	private $stid;
	private $uid;
	private $fid;
		
	function getId(){
		return $this->id;
	}

	function getStid(){return $this->stid;}

	function getUid(){return $this->uid;}

	function getFid(){return $this->fid;}

}


class fmComment{

	private $id;
	private $coid;
	private $fid;
	private $uid;
	private $content;
		
	function getId(){
		return $this->id;
	}

	function getCoid(){return $this->coid;}

	function getFid(){return $this->fid;}

	function getUid(){return $this->uid;}

	function getContent(){return $this->content;}

}

class fmWorkpoints{

	private $id;
	private $wpid;
	private $uid;
	private $fid;
	private $grade;
	
	function getId(){
		return $this->id;
	}	

	function getWpid(){return $this->wpid;}

	function getUid(){return $this->uid;}

	function getFid(){return $this->fid;}

	function getGrade(){return $this->grade;}

}

class fmGroup{

	private $id;
	private $gpid;
	private $groupname;
	private $parent;

	function getId(){return $this->id;}

	function getGpid(){return $this->gpid;}

	function getGroupName(){return $this->groupname;}

	function getParent(){return $this->parent;}

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
	public $fileDB="SELECT * FROM `fmdb_file` WHERE `uid`=?;";
	public $downloadDB="SELECT * FROM `fmdb_download` WHERE `uid`=?;";
	public $starsDB="SELECT * FROM `fmdb_stars` WHERE `uid`=?;";
	public $commentsDB="SELECT * FROM `fmdb_comments` WHERE `uid`=?;";
	public $workpointsDB="SELECT * FROM `fmdb_workpoints`;";

	//获得所有用户ID
	public $selectAllUid="SELECT `uid` FROM `fmdb_user`;";

	//星标文件数目及下载数目
	public $updateStarsCountDB="UPDATE `fmdb_user` SET `starCount` = `starCount`+1 WHERE `uid` = ?;";
	public $updateDownloadCountDB="UPDATE `fmdb_user` SET `downloadCount` = `downloadCount`+1 WHERE `uid` = ?;";

	//用户记录:留言记录/星标记录/下载记录/上传记录/评分
	public $commentsRecord="SELECT * FROM `fmdb_comments` WHERE `uid`=?;";
	public $starsRecord="SELECT * FROM `fmdb_stars` WHERE `uid`=?;";
	public $downloadRecord="SELECT * FROM `fmdb_download` WHERE `uid`=?;";
	public $uploadRecord='SELECT * FROM `fmdb_file` WHERE `uid`=?;';
	public $workpointsRecord="SELECT * FROM `fmdb_workpoints` WHERE `uid`=?;";

	//更新文件下载次数
	public $updateFileDownloadCount="UPDATE `fmdb_file` SET `downloadCount` = `downloadCount`+1 WHERE `fid`=?;";
	public $selectFileByFid='SELECT * FROM `fmdb_file` WHERE `fid`=?;';

	public $downloadCount="";
	public $uploadCount="";
	public $fileTotalDownloadCount="SELECT `downloadCount` FROM `fmdb_file` WHERE `fid`=?";

	//查看某文件对某用户是否是被删除的上传记录
	public $isDisplayed="SELECT `isDisplayed` FROM `fmdb_file` WHERE `fid`=? AND `uid`=?";
	public $isDisplayedA="SELECT `isDisplayed` FROM `fmdb_file` WHERE `path`=?";
	public $setNoDisplay="UPDATE `fmdb_file` SET `isDisplayed` = 0 WHERE `path` = ?";

	//最近N天文献
	public $latestDoc="";

 	//删除留言
	public $removeComments="DELETE FROM `fmdb_comments` WHERE `coid`=? and `uid`=?;";

	//取消星标
	public $removeStars="DELETE FROM `fmdb_stars` WHERE `stid`=? and `uid`=?;
			UPDATE `fmdb_user` SET `starCount` = `starCount`-1 WHERE `uid` = ?;";

	//删除下载记录
	public $removeDownloadRecord="DELETE FROM `fmdb_download` WHERE `donid`=?;
			UPDATE `fmdb_user` SET `downloadCount` = `downloadCount`-1 WHERE `uid` = ?;";

	//删除上传记录
	public $removeUploadRecord="UPDATE `fmdb_file` SET `isDisplayed` = '0' WHERE `fid`=? and `uid`=?;";

	//标志文件被删除
	public $removeFile="UPDATE `fmdb_file` SET `isDeleted` = '1' WHERE `path`=?";

	//更新一些文件数据
	public $updateFileDB="INSERT INTO `fmdb_file` (`fid`,`uid`, `path`, `fileExt`, `tag`, `isStard`, `isDeleted`, `downloadCount`,`isDisplayed`) 
			VALUES (uuid(),?,?,?,?,'0','0','0','1');";
	public $updateDownloadDB="INSERT INTO `fmdb_download` (`donid`,`fid`,`uid`,`downloadTime`) 
			VALUES (uuid(),?,?,CURRENT_TIMESTAMP);
			UPDATE `fmdb_user` SET `downloadCount` = `downloadCount`+1 WHERE `uid` = ?;
			UPDATE `fmdb_file` SET `downloadCount` = `downloadCount`+1 WHERE `uid` = ? AND `fid`=?;";
	public $updateUploadDB="INSERT INTO `fmdb_file` (`fid`, `uid`, `path`, `fileExt`, `tags`, `isStard`, `isDeleted`, `downloadCount`, `isDisplayed`, `group` ,`createTime`) 
			VALUES (uuid(), ?, ?, ?, ?, '0', '0', '0', '1', '0' , CURRENT_TIMESTAMP);";
	public $updateStarsDB="INSERT INTO `fmdb_stars` (`stid`,`uid`, `fid`) VALUES (uuid(),?, ?);";
	public $updateStarsUserDB="UPDATE `fmdb_user` SET `starCount` = `starCount`+1 WHERE `uid` = ?;";
	public $updateStarsFilesDB="UPDATE `fmdb_file` SET `isStard` = '1' WHERE `fid` = ? AND `uid` = ?;";

	public $updateCommentsDB="INSERT INTO `fmdb_comments` (`coid`,`fid`, `uid`, `content`) VALUES (uuid(),?,?,?);";
	public $updateWorkpointsDB="INSERT INTO `fmdb_workpoints` (`wpid`,`uid`, `fid`, `grade`) VALUES (uuid(),?,?,?);";

	//登录/改密
	public $loginIn="SELECT * FROM `fmdb_user` WHERE `name`=? AND `password`=SHA1(?)";
	public $alterPW="UPDATE `fmdb_user` SET `password`=SHA1(?) WHERE `uid`=? AND `password`=SHA1(?)";

	//更改权限
	public $alterPrivilege="UPDATE `fmdb_user` SET `privilege` = ? WHERE `uid` = ?;";

	//注册
	public $selectUser="SELECT `uid` FROM `fmdb_user` WHERE `name`=?";
	public $registerUser="INSERT INTO `fmdb_user` (`uid`,`name`, `password`, `starCount`, `downloadCount`, `privilege`, `group`,`userpath`, `lastLoginTime`) 
			VALUES (uuid(),?,SHA1(?),'0', '0', '0', '0', ?, CURRENT_TIMESTAMP);";
	//split page
	//public $pageCG="SELECT * FROM `fmdb_` ORDER BY `id` DESC LIMIT ";

	//检测文件是否已被标星	
	public $fileStard="SELECT `stid` FROM `fmdb_stars` WHERE `fid`=? AND `uid`=?;";

	//检测某用户是否已对某文件评分,如果已已经评过分则删除当前评分并且新增新纪录
	public $isRemarked="SELECT `wpid` FROM `fmdb_workpoints` WHERE `uid`=? AND `fid`=?;";

	//通过wpid删除评分
	public $removeRemark="DELETE FROM `fmdb_workpoints` WHERE `wpid`=?";

	//文件路径/拓展名/标签/相关
	public $updateFilePath="UPDATE `fmdb_file` SET `path`= ? WHERE `path`=?";
	public $updateFileExt="UPDATE `fmdb_file` SET `fileExt`= WHERE `fid`=?";
	public $updateFileTags="UPDATE `fmdb_file` SET `tags`= WHERE `fid`=?";

	//通过文件路径获取fid
	public $selectFidByPath="SELECT `fid` FROM `fmdb_file` WHERE `path`=?";

	public $getUserPrivilege="SELECT `privilege` FROM `fmdb_user` WHERE `uid`=?";

	public $obtainCommonUid="SELECT `uid` FROM `fmdb_user` WHERE `name`='common'";

	public $selectGroupName="SELECT `gpid` FROM `fmdb_group` WHERE `groupname`=?";
	public $addGroupName="INSERT INTO `fmdb_group` (`gpid`,`groupname`,`parent`) VALUES (uuid(),?,?)";
	public $AlterGroupName="UPDATE `fmdb_group` SET `groupname` = ? WHERE `groupname` = ?";
	public $deleteGroupName="DELETE FROM `fmdb_group` WHERE `groupname`=?";
	public $selectAllGroupName="SELECT * FROM `fmdb_group`";
	public $selectGroupNameParent="SELECT `parent` FROM `fmdb_group` WHERE `groupname`=?";
	public $getGPNameByGpid="SELECT `name` FROM `fmdb_group` WHERE `gpid`=?";

	public $selectFileGroup="SELECT `group` FROM `fmdb_file` WHERE `fid`=?";
	public $updateFileGroup="UPDATE `fmdb_file` SET `group`= ? WHERE `fid`=?";

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

	function changePassword($uid,$old,$new){
		return $this->submitQuery($this->alterPW,array($new,$uid,$old));
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

	function getUser($uid=null){
		if($uid!=null){
			return $this->fetchClassQuery($this->singleUserDB,array($uid),'user');
		}else{
			return $this->fetchClassQuery($this->userDB,array(),'user');
		}
	}

	function getAllUid(){
		return $this->fetchClassQuery($this->selectAllUid,array(),'');
	}

	function getPrivilege($uid){
		return $this->fetchOdd("SELECT `privilege` FROM `fmdb_user` WHERE `uid`=?",array($uid));
	}

	function getCommonUid(){
		return $this->fetchOdd($this->obtainCommonUid,array());
	}

}

/**
* user db
*/
class userDB extends userMgr{
	

}

/**
* file manager
*/
class fileMgr extends pdoOperation{
	
	function __construct($pdo){
		parent::$pdo=$pdo;
	}

	function getFileByUid(user $uid){
		return $this->fetchClassQuery($this->fileDB,array($uid->getUid()),'fmFile');
	}

	function getDownloadByUid(user $uid){
		return $this->fetchClassQuery($this->downloadDB,array($uid->getUid()),'fmDownload');
	}

	function getCommentByUid(user $uid){
		return $this->fetchClassQuery($this->commentsDB,array($uid->getUid()),'fmComment');
	}

	function getStarsByUid($uid){
		if($uid instanceof user){
			return $this->fetchClassQuery($this->starsDB,array($uid->getUid()),'fmStars');	
		}else{
			return $this->fetchClassQuery($this->starsDB,array($uid),'fmStars');
		}
	}

	function download($fid,$uid){
		return $this->submitQuery($this->updateDownloadDB,array($fid,$uid,$uid,$uid,$fid));
	}

	function getFidByPath($path){
		return $this->fetchOdd($this->selectFidByPath,array($path));
	}

	function upload($uid, $path, $fileExt, $tags){
		return $this->submitQuery($this->updateUploadDB,array($uid, $path, $fileExt, $tags));
	}

	function comment($fid,$uid,$content){
		return $this->submitQuery($this->updateCommentsDB,array($fid,$uid,$content));
	}

	function star($uid,$fid){
		$a=$this->submitQuery($this->updateStarsDB,array($uid,$fid));
		$b=$this->submitQuery($this->updateStarsUserDB,array($uid));
		$c=$this->submitQuery($this->updateStarsFilesDB,array($fid,$uid));
		return $a && $b && $c;
	}

	function remark($uid,$fid,$grade){
		$isRemark=$this->fetchOdd($this->isRemarked,array($uid,$fid));
		if(!$isRemark){
			return $this->submitQuery($this->updateWorkpointsDB,array($uid,$fid,$grade));
		}else{
			if($this->submitQuery($this->removeRemark,array($isRemark['wpid']))){
				return $this->submitQuery($this->updateWorkpointsDB,array($uid,$fid,$grade));
			}else{
				return false;
			}
		}
		return false;
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
		return $this->submitQuery($this->removeStars,array($stid,$uid,$uid));
	}

	function getTotalDownloadCount($fid){
		return $this->fetchOdd($this->fileTotalDownloadCount,array($fid));
	}

	function isDisplayed($fid,$uid){
		return $this->fetchOdd($this->isDisplayed,array($fid,$uid));
	}

	function isDisplayedA($fileName){
		return $this->fetchOdd($this->isDisplayedA,array($fileName));
	}

	function noDisplay($filePath){
		return $this->submitQuery($this->setNoDisplay,array($filePath));
	}

	function isFileStard($fid,$uid){
		return $this->fetchOdd($this->fileStard,array($fid,$uid));
	}

	function getDownloadCount(user $u){
		return $u->getDownloadCount();
	}

	function changePath($new,$old){
		return $this->submitQuery($this->updateFilePath,array($new,$old));
	}

	function changeFileExt($fid){
		return $this->submitQuery($this->updateFileExt,array($fid));
	}

	function changeFileTags($fid){
		return $this->submitQuery($this->updateFileTags,array($fid));
	}

	function removeFileA($path){
		return $this->submitQuery($this->removeFile,array($path));
	}

	function getFileGroup($fid){
		return $this->fetchOdd($this->selectFileGroup,array($fid));
	}

	function setFileGroup($fid,$group){
		return $this->submitQuery($this->updateFileGroup,array($group,$fid));
	}
}

class groupMgr extends pdoOperation{
	function __construct($pdo){
		parent::$pdo=$pdo;
	}

	function addName($name,$parent){
		if($this->nameIsExists($name)){
			$this->submitQuery($this->addGroupName,array($name,$parent));
		}else{
			return false;
		}
	}

	function alterName($name,$new){
		return $this->submitQuery($this->AlterGroupName,array($name,$new));
	}

	function deleteName($name){
		return $this->submitQuery($this->deleteGroupName,array($name));
	}

	function getGroupNameByGpid($gpid){
		return $this->fetchOdd($this->getGPNameByGpid,array($gpid));
	}

	function nameIsExists($name){
		return $this->fetchOdd($this->selectGroupName,array($name));
	}

	function getAllName(){
		return $this->fetchClassQuery($this->selectAllGroupName,array());
	}

	function getParent($name){
		return $this->fetchOdd($this->selectGroupNameParent,array($name));
	}
}


/*$pdo=new PDO("mysql:dbname=$dbname;host=$host",$user,$password);
$user=new userMgr($pdo);

for ($i=0; $i < 10; $i++) { 
	$user->register('ivy'.$i,'123456','2');
}*/

/*//
$foo=$user->login('ivy0','234567');
if($foo){
	echo 'correct';
	print_r($foo);
}else{
	echo 'failed';
}

echo $foo[0]->getUid();

$udb=new userDB($pdo);
print_r($udb->getUser($foo[0]->getUid()));

//$user->changePassword($foo[0]->getUid(),'123456','234567');

$fm=new fileMgr($pdo);

/*for ($i=0; $i < 10; $i++) { 
	//$uid, $path, $fileExt, $tags
	echo $foo[0]->getUid().'<br>';
	$fm->upload($foo[0]->getUid(),'a','v','b');
}*/
/*
$fileobj=$fm->getFileByUid($foo[0]);
//print_r($fileobj);

$fm->download($fileobj[2]->getFid(),$foo[0]->getUid());
$fm->comment($fileobj[2]->getFid(),$foo[0]->getUid(),'fucku');

if(!$fm->isFileStard($fileobj[2]->getFid(),$foo[0]->getUid())){
	$fm->star($foo[0]->gfetUid(),$fileobj[2]->getFid());
}else{
	echo '不能重复标星';
}

print_r($fm->isDisplayed($fileobj[2]->getFid(),$foo[0]->getUid()));
*/
//$fm->remark($foo[0]->getUid(),$fileobj[2]->getFid(),'2');

//print_r($fm->getComments($foo[0]->getUid()));
//print_r($fm->getStars($foo[0]->getUid()));
//print_r($fm->getRemark($foo[0]->getUid()));

//print_r($fm->getDownloadRecords($foo[0]->getUid()));
//print_r($fm->getTotalDownloadCount($fileobj[2]->getFid()));
//print_r($fm->getUploadRecords($foo[0]->getUid()));
//print_r($fm->getDownloadCount($foo[0]));

//$fm->removeUploadRecord($fileobj[2]->getFid(),$foo[0]->getUid());
//$dnl=$fm->getDownloadByUid($foo[0]);
//print_r($dnl);
//$fm->removeDownloadRecord($dnl[0]->getDonid(),$foo[0]->getUid());

//$cmt=$fm->getCommentByUid($foo[0]);
//print_r($cmt);
//$fm->deleteComments($cmt[0]->getCoid(),$foo[0]->getUid());

//$st=$fm->getStarsByUid($foo[0]);
//print_r($st);
//$fm->deleteStars($st[0]->getStid(),$foo[0]->getUid());

?>