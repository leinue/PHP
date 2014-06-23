<?php
global $con;

function connect_mysql($localhost,$account,$password)//return -1 ->failed
{
  	$con=mysql_connect($localhost,$account,$password);
	if(!$con){
		die(mysql_error());
		return -1;
	}
	return $con;
}

function create_mysql($db)//return 1->succeed;
{
	if(mysql_query("CREATE DATABASE ".$db,$con)){
		return 1;
		}
		else{return mysql_error();}
	mysql_close($con);
}

function create_table($db,$table_name,$table_item)
//FORMATION
/*CREATE TABLE table_name
(
column_name1 data_type,
column_name2 data_type,
column_name3 data_type,
.......
)*/
//FORMATION
{
	mysql_select_db($db,$con);
	$sql_create_table="CREATE TABLE ".$table_name."(".$table_item.")";
	mysql_query($sql_create_table,$con);
	mysql_close($con);
}

function insert_into_mysql($db,$table_name,$colum,$value)//return 1 ->succeed
/*INSERT INTO table_name (column1, column2,...)
VALUES (value1, value2,....)*/
{
	mysql_select_db($db, $con);
	$resule=mysql_query("INSERT INTO ".$table_name."(".$colum.") VALUES (".$value.")",$con);
	if(!result)
	{
	return -1;
    die(mysql_error());
	}
	else{return 1;}
	mysql_close($con);
}

function mysql_select($db,$table_name)//return -1 -> failed
{
	mysql_select_db($db, $con);
	$result = mysql_query("SELECT * FROM ".$table_name);
	if($row = mysql_fetch_array($result))
    {return $row;}else{return -1;}
	mysql_close($con);
}

function mysql_where($db,$table_name,$column_operator_value)//return -1 -> failed
/*e.t. $column_operator_value= FirstName="Peter"*/
{
	mysql_select_db($db, $con);
    $result = mysql_query("SELECT * FROM ".$table_name." WHERE ".$column_operator_value);
    if($row = mysql_fetch_array($result)){return $row;}else{return -1;}
	mysql_close($con);
}

function mysql_order_by($db,$table_name,$bywhat,$desc)//return -1 -> failed
/*SELECT column_name(s)
FROM table_name
ORDER BY column_name1, column_name2*/
{
    mysql_select_db($db, $con);
	$sql="SELECT * FROM ".$table_name." ORDER BY ".$bywaht;
	
	if($desc=0)//升序
		$result = mysql_query($sql);
	else
		$result = mysql_query($sql." DESC");	//降序
		
    if($row = mysql_fetch_array($result)){return $row;}else{return -1;}
	mysql_close($con);
}

function mysql_update($db,$sql)//return -1 -> failed
//sql=UPDATE Persons SET Age = '36' WHERE FirstName = 'Peter' AND LastName = 'Griffin'
{
	mysql_select_db($db, $con);
    $result = mysql_query($sql);
	if($row = mysql_fetch_array($result)){return $row;}else{return -1;}
	mysql_close($con);
}

function mysql_delete($db,$sql)//return -1 -> failed
//$sql="DELETE FROM Persons WHERE LastName='Griffin'";
{
	mysql_select_db($db, $con);
	$result = mysql_query($sql);
	if($row = mysql_fetch_array($result)){return $row;}else{return -1;}
	mysql_close($con);
}

php?>