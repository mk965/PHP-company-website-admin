<?php
    $conn = mysql_connect("localhost","root","root") or die("数据库链接错误".mysql_error());  
    mysql_select_db("aiyidi",$conn) or die("数据库访问错误".mysql_error());  
    mysql_query("set names utf-8");  
?>