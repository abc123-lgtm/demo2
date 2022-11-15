<?php
session_start();
if ((!isset($_SESSION['teacher_name'])) || (!isset($_SESSION['teacher_id']))) {
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
    <script src="js/raphael-min.js"></script>
    <script src="js/morris.js"></script>
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
                            <li><a href="#"><i class="fa fa-cog"></i> 修改密码</a></li>
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
                <div class="table-agile-info">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            已结课课程
                        </div>
                        <div>
                            <table class="table" ui-jq="footable" ui-options='{
                                   "paging": {
                                   "enabled": true
                                   },
                                   "filtering": {
                                   "enabled": true
                                   },
                                   "sorting": {
                                   "enabled": true
                                   }}'>

                                <thead>
                                    <tr>
                                        <th data-breakpoints="xs">课程号</th>
                                        <th>课程名</th>
                                        <th>学分</th>
                                        <th>学年</th>
                                        <th>平时比例</th>
                                        <th>考试比例</th>
                                        <th>查看学生</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    error_reporting(E_ERROR);
                                    $A = $_SESSION['teacher_id'];
                                    $conn = @mysql_connect("localhost", "root", "root");
                                    mysql_select_db("stugrade", $conn);
                                    $sql = "select * from course where  teach_id='$A'  and  course_id in(select course_id from grade where flag='2')";
                                    //echo $sql;
                                    //exit();
                                    mysql_query("set names 'utf8'");
                                    $res = mysql_query($sql, $conn);
                                    while ($arr = mysql_fetch_assoc($res)) {
                                        echo "<tr data-expanded='true'>";
                                        echo "<td>" . $arr['course_id'] . "</td>";
                                        echo "<td>" . $arr['course_name'] . "</td>";
                                        echo "<td>" . $arr['credit'] . "</td>";
                                        echo "<td>" . $arr['xktime'] . "</td>";
                                        echo "<td>" . $arr['blps'] . "</td>";
                                        echo "<td>" . $arr['blks'] . "</td>";
                                        echo "<td><a href='teach_ckstu.php?flag=" . $arr['course_id'] . "'>查看</a></td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </section>
            <!-- footer -->
            <div class="footer">
                <div class="wthree-copyright">
                    <p>© 2017 学生成绩管理系统.Design by Sunhu</a></p>
                </div>
            </div>
            <!-- / footer -->
        </section>
        <!--main content end-->
    </section>
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/jquery.nicescroll.js"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    <script src="js/jquery.scrollTo.js"></script>
    <!-- morris JavaScript -->	
    <script>
        $(document).ready(function () {
            //BOX BUTTON SHOW AND CLOSE
            jQuery('.small-graph-box').hover(function () {
                jQuery(this).find('.box-button').fadeIn('fast');
            }, function () {
                jQuery(this).find('.box-button').fadeOut('fast');
            });
            jQuery('.small-graph-box .box-close').click(function () {
                jQuery(this).closest('.small-graph-box').fadeOut(200);
                return false;
            });
        });
    </script>
</body>
</html>
<?php
if ($_GET['action'] == "logout") {
    unset($_SESSION['teacher_name']);
    unset($_SESSION['teacher_id']);
    echo "<script> alert('注销成功');</script>";
    echo "<script type='text/javascript'>" . "location.href='" . "login.html" . "'" . "</script>";
}
?>

