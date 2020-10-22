<?php
/**
 * @author   ：gxggxl
 * @BlogURL  : https://gxusb.com
 * @DateTime : 2020/10/10 16:33
 */

class Page
{
    //成员属性
    private $page;//当前页
    private $maxRows;//总条数
    private $pageSize;//每页显示多少条
    private $maxPage = 0;//总页数
    private $url;//当前页面的URL地址
    private $urlParam = '';//当前页面的参数

    //成员方法
    public function __construct($maxRows, $pageSize = 5) {
        //进行初始化赋值操作
        $this->maxRows = $maxRows;
        $this->pageSize = $pageSize;
        //定义当前页
        $this->page = isset($_GET['page']) ? $_GET['page'] : 1;
        //获取当前页面的URL地址
        $this->url = $_SERVER['PHP_SELF'];
        //获取总页数
        $this->getMaxPage();
        //验证当前页的值
        $this->checkPage();
        //调用URL参数
        $this->urlParam();
    }

    // getMaxPage 计算总页数
    private function getMaxPage() {
        //判断除数
        if ($this->pageSize < 1) {
	        $this->pageSize = 1;
        }
        $this->maxPage = @ceil($this->maxRows / $this->pageSize);
    }

    //验证当前页
    private function checkPage() {
        if ($this->page > $this->maxPage) {
	        $this->page = $this->maxPage;
        }
        if ($this->page < 1) {
	        $this->page = 1;
        }
        if ($this->pageSize > $this->maxRows) {
	        $this->pageSize = $this->maxRows;
        }
        if ($this->pageSize < 1) {
	        $this->pageSize = 1;
        }
    }

    //过滤当前URL地址中的参数信息
    private function urlParam() {
        foreach ($_GET as $key => $value) {
            //判断参数值和参数名是否有效
            if ($value !== '' && $key !== 'page') {
                $this->urlParam .= '&' . $key . '=' . $value;
            }
        }
        // echo $this->urlParam;
    }

    /**
     * 输出页码
     * @return string
     */
    public function showPage() {
        $str = '';
        $str .= '当前第' . $this->page . '页/共' . $this->maxPage . '页，共' . $this->maxRows . '条记录&nbsp;&nbsp;';
        $str .= '<a href="' . $this->url . '?page=1' . $this->urlParam . '">首页</a>&nbsp;&nbsp;';
        $str .= '<a href="' . $this->url . '?page=' . ($this->page - 1) . $this->urlParam . '">上一页</a>&nbsp;&nbsp;';
        $str .= '<a href="' . $this->url . '?page=' . ($this->page + 1) . $this->urlParam . '">下一页</a>&nbsp;&nbsp;';
        $str .= '<a href="' . $this->url . '?page=' . $this->maxPage . $this->urlParam . '">尾页</a>&nbsp;&nbsp;';
        return $str;
    }

    /**
     * 返回分页的limit条件
     * @return string
     */
    public function limit() {
        $num = ($this->page - 1) * $this->pageSize;
        return $num . ',' . $this->pageSize;
    }
}
