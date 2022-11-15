<?php
    session_start();
    error_reporting(E_ERROR); 
    $course_id=$_POST['course_id'];
    $name=$_POST['name'];
    $credit=$_POST['credit'];
    $xktime=$_POST['xktime'];
    $blps=$_POST['blps'];
    $blks=$_POST['blks'];
    $teach_id=$_POST['teach_id'];
    $conn=mysql_connect("localhost","root","root")or die("数据库连接失败");
    $db= mysql_select_db("stugrade",$conn);
    $sql="insert into course values('$course_id','$name','$credit','$teach_id','$xktime','$blps','$blks')";
    mysql_query("set names 'utf8'");
    $result=mysql_query($sql,$conn);   //插入语句返回的是true or  false
    if($result){
        echo "<script>alert('添加成功！');window.location.href='./admin_addcy.php';</script>";
    }
 else {
        echo "<script> alert('添加失败');</script>";
        echo "<script> history.go(-1);</script>"; 
}
    
