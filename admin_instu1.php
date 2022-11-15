<?php
    session_start();
    error_reporting(E_ERROR); 
    $stuno=$_POST['stuno'];
    $name=$_POST['name'];
    $sex=$_POST['sex'];
    $sdept=$_POST['sdept'];
    $home=$_POST['home'];
    $rxtime=$_POST['rxtime'];
    $ps=$_POST['ps'];
    $conn=mysql_connect("localhost","root","root")or die("数据库连接失败");
    $db= mysql_select_db("stugrade",$conn);
    $sql="insert into student values('$stuno','$name','$sdept','$sex','$home','$rxtime','$ps','123')";
    mysql_query("set names 'utf8'");
    $result=mysql_query($sql,$conn);   //插入语句返回的是true or  false
    if($result){
        echo "<script>alert('添加成功！');window.location.href='./admin_addy.php';</script>";
    }
 else {
        echo "<script> alert('添加失败!');</script>";
        echo "<script> history.go(-1);</script>"; 
}
    
