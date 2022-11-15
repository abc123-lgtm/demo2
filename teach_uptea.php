<?php
    session_start();
    if((!isset($_SESSION['teacher_name'])) || (!isset($_SESSION['teacher_id']))){
        header("Location:login.html");
        exit;
    }
    error_reporting(E_ERROR); 
    mysql_query("set names 'utf8'");
?>
<!DOCTYPE html>
<head>
<title>学生成绩管理系统</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link rel="stylesheet" href="css/bootstrap.min.css" >
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/style-responsive.css" rel="stylesheet"/>
<link rel="stylesheet" href="css/font.css" type="text/css"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<link rel="stylesheet" href="css/monthly.css">
<script src="js/jquery2.0.3.min.js"></script>
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="index.html" class="logo">
        教师
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<div class="top-nav clearfix">
    <ul class="nav pull-right top-menu" >
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <li class="dropdown" >
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="images/2.png">
                <span class="username"><?php echo $_SESSION['teacher_name']; ?></span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="tea_xgmm.php"><i class="fa fa-cog"></i> 修改密码</a></li>
                <li><a href="index_teacher.php?action=logout"><i class="fa fa-key"></i> 注销</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="index_teacher.php">
                        <i class="fa fa-dashboard"></i>
                        <span>首页</span>
                    </a>
                </li>
                
                
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-th"></i>
                        <span>基本信息</span>
                    </a>
                    <ul class="sub">
                        <li><a href="teach_seltea.php">查看基本信息</a></li>
                        <li><a href="teach_uptea.php">修改基本信息</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-tasks"></i>
                        <span>我的课程</span>
                    </a>
                    <ul class="sub">
                        <li><a href="teach_jcou.php">已结课</a></li>
                        <li><a href="teach_wcou.php">未结课</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-envelope"></i>
                        <span>录入成绩</span>
                    </a>
                    <ul class="sub">
                        <li><a href="teach_inadd.php">在线录入</a></li>
                        
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class=" fa fa-bar-chart-o"></i>
                        <span>查询成绩</span>
                    </a>
                    <ul class="sub">
                        <li><a href="teach_selkh.php">按课号查询</a></li>
                    </ul>
                </li>
                <!--<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-glass"></i>
                        <span>查询信息</span>
                    </a>
                </li>-->
                
            </ul>            
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        
        <div class="form-w3layouts">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            修改基本信息
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                            <?php
                            error_reporting(E_ERROR);
                            $a=$_SESSION['teacher_id']; 
                            $conn=@mysql_connect("localhost","root","root");
                            mysql_select_db("stugrade",$conn);
                            $sql="select * from teacher where teach_id='$a'";
                            mysql_query("set names 'utf8'");
                            $res=mysql_query($sql,$conn);
                            $arr=mysql_fetch_array($res);
                            ?>
                                <form role="form" action="teach_uptea.php?action=update" method="post">
                                <div class="form-group">
                                    <label for="exampleInputText1">教师号</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="teach_id" value="<?php echo $arr['teach_id'];  ?>" readonly="readonly">
                                </div>
                                    <div class="form-group">
                                    <label for="exampleInputText1">姓名</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="<?php echo $arr['name'];  ?>"> 
                                </div>
                                   
                                <div class="form-group">
                                    <label for="exampleInputText1">性别</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1"  name="sex" value="<?php echo $arr['sex'];  ?>">
                                </div>
                                <div class="form-group" >
                                    <label for="exampleInputText1">系别&emsp;&emsp;&emsp;&emsp;</label>
                                        <select name="sdept">
                                        <option value="机电学院" <?php if($arr['sdept']=="机电学院"){echo 'selected';}  ?> >机电学院</option>
                                        <option value="通信学院" <?php if($arr['sdept']=="通信学院"){echo 'selected';}  ?> >通信学院</option>
                                        <option value="计算机学院" <?php if($arr['sdept']=="计算机学院"){echo 'selected';}  ?>> 计算机学院</option>
                                        <option value="艺术学院"> 艺术学院</option>
                                        <option value="外国语学院">外国语学院</option>
                                        <option value="商学院">商学院</option>
                                        <option value="材料学院">材料学院</option>
                                        <option value="数学学院">数学学院</option>
                                    </select>
                                </div>
                                <div class="form-group" >
                                    <label for="exampleInputText1">职位</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1"  name="position" value="<?php echo $arr['position'];  ?>">
                                </div>
                                    <div class="form-group" >
                                    <label for="exampleInputText1">学历</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1"  name="academic" value="<?php echo $arr['academic'];  ?>">
                                </div>
                                <button type="submit" class="btn btn-info">修改教师</button>
                                <button type="reset" class="btn btn-info">重置</button>
                            </form>
                            </div>
                        </div>
                    </section>
            </div>
        </div>
</section>
 <!-- footer -->
          <div class="footer">
            <div class="wthree-copyright">
              <p>© 2017 学生成绩管理系统.Design by Sunhu</a></p>
            </div>
          </div>
</section>
</section>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/jquery.scrollTo.js"></script>
<!-- morris JavaScript -->  
<script>
    $(document).ready(function() {
        //BOX BUTTON SHOW AND CLOSE
       jQuery('.small-graph-box').hover(function() {
          jQuery(this).find('.box-button').fadeIn('fast');
       }, function() {
          jQuery(this).find('.box-button').fadeOut('fast');
       });
       jQuery('.small-graph-box .box-close').click(function() {
          jQuery(this).closest('.small-graph-box').fadeOut(200);
          return false;
       });
        }
    </script>
</body>
</html>
<?php
    error_reporting(E_ERROR);
    if($_GET['action']=="update"){
        $teach_id=$_POST['teach_id'];
        $name=$_POST['name'];
        $sex=$_POST['sex'];
        $sdept=$_POST['sdept'];
        $position=$_POST['position'];
        $academic=$_POST['academic'];
        $conn=mysql_connect("localhost","root","root")or die("数据库连接失败");
        $db= mysql_select_db("stugrade",$conn);
        $sql="update teacher set name='$name',sex='$sex',sdept='$sdept',position='$position',academic='$academic' where teach_id='$teach_id'";
        //echo $sql;
        //exit();
        mysql_query("set names 'utf8'");
        $res=mysql_query($sql,$conn);
        if($res){
           echo "<script> alert('修改成功');</script>";
           echo "<script type='text/javascript'>"."location.href='"."teach_seltea.php"."'"."</script>";
        }
        else{
            echo "<script> alert('修改失败');</script>";
            echo "<script> history.go(-1);</script>";
        }
    }
?>



