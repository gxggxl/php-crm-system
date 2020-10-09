<?php

class Page{
	//成员属性
	private $page = 1;//当前页
	private $maxRows = 0;//总条数
	private $pageSize = 0;//每页显示多少条
	private $maxPage = 0;//总页数
	private $url = null;//当前页面的URL地址
	private $uelParam = '';//当前页面的参数
	//成员方法
	function __construct($maxRows,$pageSize = 5){
		//进行初始化赋值操作
		$this->maxRows = $maxRows;
		$this->pageSize = $pageSize;
		//定义当前页
		$this->page = isset($_GET['page'])?$_GET['page']:1;
		//获取当前页面的URL地址
		$this->url = $_SERVER['PHP_SELF'];
		//获取总页数
		$this->getMaxPage();
		//验证当前页的值
		$this->checkPage();
		//调用URL参数
		$this->urlParam();
	}
	//过滤当前URL地址中的参数信息
	private function urlParam(){
		foreach ($_GET as $key => $value) {
			//判断参数值和参数名是否有效
			if($value !='' && $key != 'page'){
				$this->urlParam .= '&'.$key.'='.$value;
			}
		}
		// echo $this->urlParam;
	}
	//[getMaxPage 计算总页数]
	private function getMaxPage(){
		$this->maxPage = ceil($this->maxRows/$this->pageSize);
	}
	//验证当前页
	private function checkPage(){
		if($this->page>$this->maxPage){
			$this->page = $this->maxPage;
		}
		if($this->page < 1){
			$this->page = 1;
		}
	}
	//输出页码
	public function showPage(){
		$str='';
		$str.= '当前页'.$this->page.'/'.$this->maxPage.'页，共'.$this->maxRows.'条&nbsp;&nbsp;';
		$str.='<a href="'.$this->url.'?page=1'.$this->urlParam.'">首页</a>&nbsp;&nbsp;';
		$str.='<a href="'.$this->url.'?page='.($this->page-1).$this->urlParam.'">上一页</a>&nbsp;&nbsp;';
		$str.='<a href="'.$this->url.'?page='.($this->page+1).$this->urlParam.'">下一页</a>&nbsp;&nbsp;';
		$str.='<a href="'.$this->url.'?page='.$this->maxPage.$this->urlParam.'">尾页</a>&nbsp;&nbsp;';
		return $str;
	}
	//返回分页的limit条件
	public function limit(){
		$num = ($this->page - 1) * $this->pageSize;
		$limit = $num.','.$this->pageSize;
		return $limit;
	}
}