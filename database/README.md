# README

## 使用外部数据库信息

构造方法初始化数据:数据较多，应该使用数组来传递数据，关联数组，而且绝大部分的开发者本意是用来测试，所以基本都是本地，因此可以给默认数据

```php
$dbinfo = array(
	'host' => 'localhost',
	'port' => '3306 ',
	'user' => 'root',
	'password' => '123456',
	'dbname' => 'test',
	'charset' => 'utf8'
)
```

```php
// # *必填，数据库名称
// define("DBNAME", "test");
// # *必填，数据库主机名
// define("HOSTNAME", "localhost");
// # *必填，数据库用户名
// define("USERNAME", "root");
// # *必填，数据库密码
// define("PASSWORD", "");
// # 默认，数据库端口
// define("PORT", "3306");
// # 默认，编码格式
// define("CHARSET", "utf8");

```
## 数据库操作类使用方法

```php
// 实例化数据库对象
$db = new Sql($dbinfo);

// var_dump($db->connect());
// var_dump($db->charset());

// 检查数据库语句 并打印
var_dump($db->check('select * from user'));

// 读取所有数据 并打印，循环取出所有记录:形成二维数组，返回数组
$res = $db->read_all('desc user');
var_dump($res);

// 数据库写操作，需要传入数据库语句。
//执行成功，应该获取受影响的行数，如果为false就返回false
$res1 = $db->write("insert into user values ('','admin','123456','$tiem')");
var_dump($res1);
// 获取自增长ID的方法
echo '自增长ID为'.$db->insert_id();

// 输出错误信息
echo $db->errno,$s2->error;

```

## 小结

- 1、类的封装是以功能驱动为前提,相关操作存放到一个类中。
- 2、一个类通常是一个独立的文件,文件名与类名相同(方便后期维护和自动加载)
- 3、类中如果有数据需要管理，设定属性。
- 4、类中如果有功能需要实现(数据加工)，设定方法。
- 5、一个功能通常使用一个方法实现，方法的颗粒度应该尽可能小(方便复用)
- 6、应该尽可能增加类对成员的控制：即能私有尽可能私有。
- 7、类中需要实现的功能应该由具体的业务来实现支撑。
  -	实用类:只考虑当前业务，不考虑全面性(代码少,应用范围小)
  -	工具类:全面综合考虑，尽可能多的封装可能存在的业务(代码多,应用范围广)