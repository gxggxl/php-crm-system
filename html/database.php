<?php
/** 
*以下代码用于数据库操作类的封装
* 
* @author gxggxl<gxggxl@qq.com> 
* @version 1.0
* @since 2020
*/
 
class Mysql{
 
//数据库连接返回值
private $conn;
 
/**
* [构造函数，返回值给$conn]
* @param [string] $hostname [主机名]
* @param [string] $username[用户名]
* @param [string] $password[密码]
* @param [string] $dbname[数据库名]
* @param [string] $charset[字符集]
* @return [null]
*/
 
function __construct($hostname,$username,$password,$dbname,$charset='utf8'){
　　$conn = @mysql_connect($hostname,$username,$password);
　　if(!$conn){
　　　　echo '连接失败，请联系管理员';
　　　　exit;
　　}
　　$this->conn = $conn;
　　$res = mysql_select_db($dbname);
　　if(!$res){
　　echo '连接失败，请联系管理员';
　　exit;
　　}
　　mysql_set_charset($charset);
}
function __destruct(){
　　mysql_close();
}
/**
* [getAll 获取所有信息]
* @param [string] $sql [sql语句]
* @return [array] [返回二维数组]
*/
function getAll($sql){
　　$result = mysql_query($sql,$this->conn);
　　$data = array();
　　if($result && mysql_num_rows($result)>0){
　　　　while($row = mysql_fetch_assoc($result)){
　　　　$data[] = $row;
　　　　}
　　}
　　return $data;
}
/**
* [getOne 获取单条数据]
* @param [string] $sql [sql语句]
* @return [array] [返回一维数组]
*/
function getOne($sql){
　　$result = mysql_query($sql,$this->conn);
　　$data = array();
　　if($result && mysql_num_rows($result)>0){
　　　　$data = mysql_fetch_assoc($result);
　　}
　　return $data;
}
 
/**
* [insert 插入数据]
* @param [string] $table [表名]
* @param [string] $data [由字段名当键，属性当键值的一维数组]
* @return [type] [返回false或者插入数据的id]
*/
 
function insert($table,$data){
　　$str = '';
　　$str .="INSERT INTO `$table` ";
　　$str .="(`".implode("`,`",array_keys($data))."`) "; 
　　$str .=" VALUES ";
　　$str .= "('".implode("','",$data)."')";
　　$res = mysql_query($str,$this->conn);
　　if($res && mysql_affected_rows()>0){
　　　　　　return mysql_insert_id();
　　}else{
　　　　return false;
　　}
}
/**
* [update 更新数据库]
* @param [string] $table [表名]
* @param [array] $data [更新的数据，由字段名当键，属性当键值的一维数组]
* @param [string] $where [条件，‘字段名'=‘字段属性']
* @return [type] [更新成功返回影响的行数，更新失败返回false]
*/
function update($table,$data,$where){
　　$sql = 'UPDATE '.$table.' SET ';
　　foreach($data as $key => $value){
　　$sql .= "`{$key}`='{$value}',";
　　}
　　$sql = rtrim($sql,',');
　　$sql .= " WHERE $where";
　　$res = mysql_query($sql,$this->conn);
　　if($res && mysql_affected_rows()){
　　　　return mysql_affected_rows();
　　}else{
　　return false;
　　}
}
 
/**
* [delete 删除数据]
* @param [string] $table [表名]
* @param [string] $where [条件，‘字段名'=‘字段属性']
* @return [type] [成功返回影响的行数，失败返回false]
*/
function del($table,$where){
　　$sql = "DELETE FROM `{$table}` WHERE {$where}";
　　$res = mysql_query($sql,$this->conn);
　　if($res && mysql_affected_rows()){
　　　　return mysql_affected_rows();
　　}else{
　　return false;
　　}
}

}



// 实例化类
<?php
//包含数据库操作类文件
include 'mysql.class.php';
 
//设置传入参数
$hostname='localhost';
$username='root';
$password='123456';
$dbname='aisi';
$charset = 'utf8';
 
//实例化对象
$db = new Mysql($hostname,$username,$password,$dbname);
 
//获取一条数据
$sql = "SELECT count(as_article_id) as count FROM as_article where as_article_type_id=1";
$count = $db->getOne($sql);
 
//获取多条数据
$sql = "SELECT * FROM as_article where as_article_type_id=1 order by as_article_addtime desc limit $start,$limit";
$service = $db->getAll($sql);
 
//插入数据
$arr = array(
'as_article_title'=>'数据库操作类',
'as_article_author'=>'rex',
);
$res = $db->insert('as_article',$arr);
 
//更新数据
$arr = array(
'as_article_title'=>'实例化对象',
'as_article_author'=>'Lee',
);
$where = "as_article_id=1";
$res = $db->update('as_article',$arr,$where);
 
//删除数据
$where = "as_article_id=1";
$res = $db->del('as_article',$where);
 
?>