<?php 
header("Content-type: text/html; charset=utf-8");
session_start();
//登录  
if(!isset($_POST['submit'])){
	if(!isset($_GET['action'])){
		
    exit('非法访问!');
	}else{
		//注销登录  
		if($_GET['action'] == "logout"){
		    session_unset("userid");
		    session_unset("username");
		    echo '注销成功！点击此处 <a href="html/login.html">登录</a>';
		    exit;  
		}  
	}
}else{
	
	$username = htmlspecialchars($_POST['username']);  
	$password = MD5($_POST['password']);
	
	//包含数据库连接文件  
	include('conn.php');  
	//检测用户名及密码是否正确  
	$check_query = mysql_query("select userid from user_list where username='$username' and password='$password' limit 1");  
	if($result = mysql_fetch_array($check_query)){  
	    //登录成功  
	    session_start();  
	    $_SESSION['username'] = $username;  
	    $_SESSION['userid'] = $result['userid'];
	    header("location:index.php");
	    echo $username,' 欢迎你！进入 <a href="my.php">用户中心</a><br />';  
	    echo '点击此处 <a href="login.php?action=logout">注销</a> 登录！<br />';  
	    exit;  
	} else {  
	    exit('登录失败！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');  
	}  
	   
	
}


   
?>