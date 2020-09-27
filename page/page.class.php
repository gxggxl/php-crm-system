<?php
/*
 * @Author       : gxggxl
 * @E-mail       : gxggxl@qq.com
 * @Date         : 2020-09-27 14:40:37
 * @LastEditTime : 2020-09-27 20:11:21
 * @FilePath     : /php-crm-system/page/page.class.php
 */

class Page{
	// 数据表中总条数
	private $total;
	// 每页显示的行数
	private $listRows;
	// 每页显示记录数
	private $limit;
	// 页面URL
	private $uri;
	// 页数
	private $pageNum;
	// 分页显示配置
	private $config=array('header'=>"记录","prev"=>"上一页","next"=>"下一页","first"=>"首页","last"=>"末页");
	/* 
	 * $total
	 * $listRows
	 */
	public function __construct($total,$listRows=5){
		$this->total=$total;
		$this->listRows=$listRows;
		$this->uri=$this->getUri();
		$this->page=!empty($_GET["page"]) ? $_GET["page"]:1;
		$this->pageNum=ceil($this->total/$this->listRows);//向上取整
		$this->limit=$this->setLimit();
		echo "<pre>";
		print_r($this);
		echo "</pre>";
	} 
	private function setLimit(){
		return "LIMIT ".($this->page-1)*$this->listRows.", {$this->listRows}";
	}
	
	private function getUri(){
		$url=$_SERVER["REQUEST_URI"].(strpos($_SERVER["REQUEST_URI"],'?')?'':"?");
		// echo $url;
		// var_dump(strpos($_SERVER["REQUEST_URI"],'?'));
		// boolean false 没查到"?"
		// int
		$parse=parse_url($url);

		if(isset($parse["query"])){
			parse_str($parse["query"],$parms);
			unset($parms["page"]);
			// del "page=xx"
			$url = $parse['path'].'?'.http_build_query($parms);
			// echo http_build_query($parms);
			//print_r($parms);
		}
		return $url;
		// echo "<pre>";
		// print_r($_SERVER);
		// echo "</pre>";
	}
	
	public function __get($args){
		if($args=="limit"){
			return $this->limit;
		}
		else{
			return null;
		}
	}

	private function pStart(){
		if($this->total==0){
			return 0;
		}
		else{
			return ($this->page-1)*$this->listRows+1;
		}
	}

	private function pEnd(){
		return min($this->page*$this->listRows,$this->total);
	}
	

	function fpage(){
		// return '分页信息';
		$html.="&nbsp;&nbsp;共有<b>{$this->total}</b>{$this->config["header"]}&nbsp;&nbsp;";
		$html.="&nbsp;&nbsp;每页显示<b>".($this->pEnd()-$this->pStart()+1)."</b>条，本页<b>{$this->pStart()}-{$this->PEnd()}</b>条&nbsp;&nbsp;";
		$html.="&nbsp;&nbsp;<b>{$this->page}/{$this->pageNum}</b>页&nbsp;&nbsp;";
		return $html;
	}
}

?>

