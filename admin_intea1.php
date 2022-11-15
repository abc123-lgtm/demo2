<?php
    session_start();
    error_reporting(E_ERROR); 
    $teacher_id=$_POST['teach_id'];
    $name=$_POST['name'];
    $sex=$_POST['sex'];
    $sdept=$_POST['sdept'];
    $position=$_POST['position'];
    $academic=$_POST['adademic'];
    $conn=mysql_connect("localhost","root","root")or die("数据库连接失败");
    $db= mysql_select_db("stugrade",$conn);
    $sql="insert into teacher values('$teacher_id','$name','$sex','$sdept','$position',' $academic','123')";
    mysql_query("set names 'utf8'");
    $result=mysql_query($sql,$conn);   //插入语句返回的是true or  false
    if($result){
        echo "<script>alert('添加成功！');window.location.href='./admin_addly.php';</script>";
    }
 else {
        echo "<script> alert('添加失败');</script>";
        echo "<script> history.go(-1);</script>"; 
}
    
