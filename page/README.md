# 分页类使用方法

## 拓展

- 另一种设置 url 地址的方法

```php
protected function getUrl(){
	//获取文件地址
	$path=$_SERVER['SCRIPT_NAME'];
	//获取主机名
	$host=$_SERVER['HTTP_HOST'];
	//获取端口号
	$port=$_SERVER['SERVER_PORT'];
	//获取协议
	$scheme=$_SERVER['REQUEST_SCHEME'];
	//获取参数
	$queryString=$_SERVER['QUERY_STRING'];
	if (strlen($queryString)) {
		//解析字符串返回数组
		parse_str($queryString,$array);
		unset($array['page']);

		$path=$path.'?'.http_build_query($array);
	}
	//拼接url地址
	$url=$scheme.'://'.$host.':'.$port.$path;
	//echo $url;
	//https://test.gxusb.com:443/page/demo.php?size=7&jsj=a
	return $url;
}
	//设置url 地址
	protected function setUrl($page){
		if (strstr($this->url,'?') ){
			return $this->url.'&page='.$page;
		}else{
			return $this->url.'?page='.$page;
		}
}
```