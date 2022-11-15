<?php
        session_start();
        error_reporting(E_ERROR);
        $stuno=$_SESSION['stu_id'];
        $flag=0;
        //echo $sql;
        //exit();
        $conn=mysql_connect("localhost","root","root");
        mysql_select_db("stugrade",$conn);
        mysql_query("set names 'utf8'");
        foreach ($_POST['chk'] as $val){
            $sql="insert into grade(course_id,stuno,flag) values('$val','$stuno','$flag')";
            $res=mysql_query($sql,$conn);
        }
        if($res){
            echo "<script> alert('选课成功');</script>";
           echo "<script type='text/javascript'>"."location.href='"."stu_startxk.php"."'"."</script>";
        }
        else{
            echo "<script> alert('选课失败');</script>";
            echo "<script> history.go(-1);</script>";
        }
        ?>