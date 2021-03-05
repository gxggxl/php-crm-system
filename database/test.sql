-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2021-03-05 20:00:44
-- 服务器版本： 8.0.23
-- PHP 版本： 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `crm_gxusb_com`
--

-- --------------------------------------------------------

--
-- 表的结构 `crm_config`
--
-- 创建时间： 2021-03-05 11:37:45
--

CREATE TABLE `crm_config` (
                              `c_date` varchar(255) NOT NULL COMMENT '建站时间',
                              `icp` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- 表的结构 `crm_users`
--
-- 创建时间： 2021-03-05 11:37:45
-- 最后更新： 2021-03-05 11:56:13
--

CREATE TABLE `crm_users` (
                             `uid` int NOT NULL COMMENT '用户ID',
                             `username` varchar(64) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL COMMENT '用户名',
                             `password` varchar(128) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL COMMENT '密码',
                             `sex` varchar(16) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL COMMENT '性别',
                             `email` varchar(128) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL COMMENT '邮箱',
                             `phone_num` varchar(64) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL COMMENT '手机号码',
                             `create_time` varchar(32) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL COMMENT '注册时间',
                             `ip` varchar(255) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL COMMENT '注册IP地址'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci COMMENT='用户表';

--
-- 转存表中的数据 `crm_users`
--

INSERT INTO `crm_users` (`uid`, `username`, `password`, `sex`, `email`, `phone_num`, `create_time`, `ip`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '男', 'admin@gxusb.com', '10086110000', '1600853499', '127.0.0.1'),
(2, 'user', 'e10adc3949ba59abbe56e057f20f883e', '女', 'user@gxusb.com', '10086110000', '1600853606', '127.0.0.1'),
(3, '123456', 'e10adc3949ba59abbe56e057f20f883e', '保密', '123456@qq.com', '12345069454', '1601005377', '127.0.0.1'),
(4, 'gxggxl', '25d55ad283aa400af464c76d713c07ad', '男', 'gxggxl@qq.com', '10000100861', '1601060681', '127.0.0.1'),
(5, 'user1', 'e807f1fcf82d132f9bb018ca6738a19f', '女', 'user1@gxusb.com', '12345678900', '1601211185', '127.0.0.1'),
(6, 'user2', 'e807f1fcf82d132f9bb018ca6738a19f', '男', 'user2@gxusb.com', '12345678901', '1601211245', '127.0.0.1'),
(7, 'user3', 'e807f1fcf82d132f9bb018ca6738a19f', '保密', 'user3@gxusb.com', '12345678902', '1601211264', '127.0.0.1'),
(8, 'user4', 'e807f1fcf82d132f9bb018ca6738a19f', '保密', 'user4@gxusb.com', '12345678903', '1601211280', '127.0.0.1'),
(9, 'user5', 'e807f1fcf82d132f9bb018ca6738a19f', '女', 'user5@gxusb.com', '12345678904', '1601211299', '127.0.0.1'),
(10, 'user6', 'e807f1fcf82d132f9bb018ca6738a19f', '男', 'user6@gxusb.com', '12345678905', '1601211408', '127.0.0.1'),
(11, 'user7', 'e807f1fcf82d132f9bb018ca6738a19f', '女', 'user7@gxusb.com', '12345678906', '1601212203', '127.0.0.1'),
(12, 'user8', 'e807f1fcf82d132f9bb018ca6738a19f', '女', 'user8@gxusb.com', '12345678907', '1601212218', '127.0.0.1'),
(13, 'user9', '97a6461e48e7d96ce886952c4ad2b86d', '女', 'user9@gxusb.com', '12345678908', '1601212236', '127.0.0.1'),
(14, 'user10', 'b060ab7eebaae5b4224dbaa7fa0a66ce', '女', 'user10@gxusb.com', '12345678909', '1601212253', '127.0.0.1'),
(15, 'user11', 'c44a471bd78cc6c2fea32b9fe028d30a', '女', 'user11@gxusb.com', '10086110001', '1601265245', '127.0.0.1'),
(16, 'user12', '335217937a0e54819b953424afca61c5', '女', 'skksk@llsspld.cp', '12345678911', '1601267789', '127.0.0.1'),
(17, 'user13', 'e635d8e5db5e6d02895c9691f97a6f6b', '男', 'as@aks.xss', '11218339392', '1601268560', '127.0.0.1'),
(18, 'user14', 'd41d8cd98f00b204e9800998ecf8427e', '保密', '', '', '1602323965', '127.0.0.1'),
(19, 'user15', 'd41d8cd98f00b204e9800998ecf8427e', '保密', '', '', '1602323973', '127.0.0.1'),
(20, 'user16', 'd41d8cd98f00b204e9800998ecf8427e', '保密', '', '', '1602323974', '127.0.0.1'),
(21, 'vmuser12704', 'e10adc3949ba59abbe56e057f20f883e', '女', 'gxggxl@qq.comq', '12345678918', '1602324638', '127.0.0.1'),
(22, 'alalda', 'e807f1fcf82d132f9bb018ca6738a19f', '女', 'user1@gxusb.coma', '12345678916', '1602324777', '127.0.0.1'),
(23, 'aaldka', 'e807f1fcf82d132f9bb018ca6738a19f', '男', 'admin@gxusb.coma', '12345678914', '1602331010', '127.0.0.1'),
(24, 'ajsjsajkdj', '03cfd9e012bd7460440a45c7f8df61c5', '女', 'gxggxl@qq.coma', '', '1602752602', '127.0.0.1'),
(25, 'gxggxl@qq.com', 'e807f1fcf82d132f9bb018ca6738a19f', '男', 'admin@gxusb.comaaa', '', '1602752981', '127.0.0.1'),
(26, 'user17', 'd41d8cd98f00b204e9800998ecf8427e', '保密', '', '', '1602754305', '127.0.0.1'),
(27, 'user18', 'd41d8cd98f00b204e9800998ecf8427e', '保密', '', '', '1602754346', '127.0.0.1'),
(28, 'user19', 'd41d8cd98f00b204e9800998ecf8427e', '保密', '', '', '1602754348', '127.0.0.1'),
(29, 'ssssssssss', 'e807f1fcf82d132f9bb018ca6738a19f', '男', 'admin@gxusb.comss', '', '1602754431', '127.0.0.1'),
(30, 'ssssssssssa', 'e807f1fcf82d132f9bb018ca6738a19f', '男', 'admin@gxusb.comssa', '', '1602754562', '127.0.0.1'),
(31, 'ssssssssssaa', 'e807f1fcf82d132f9bb018ca6738a19f', '男', 'admin@gxusb.comssaa', '', '1602754647', '127.0.0.1'),
(32, 'gxusbasxd', 'e807f1fcf82d132f9bb018ca6738a19f', '男', 'admin@gxusb.comaadxa', '12434857251', '1602754687', '127.0.0.1');

--
-- 转储表的索引
--

--
-- 表的索引 `crm_users`
--
ALTER TABLE `crm_users`
    ADD PRIMARY KEY (`uid`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `crm_users`
--
ALTER TABLE `crm_users`
    MODIFY `uid` int NOT NULL AUTO_INCREMENT COMMENT '用户ID', AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
