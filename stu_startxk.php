<?php
    session_start();
    if((!isset($_SESSION['stu_name'])) || (!isset($_SESSION['stu_id']))){
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
        学生
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->
<div class="nav notify-row" id="top_menu">
  
</div>
<div class="top-nav clearfix">
    <ul class="nav pull-right top-menu" >
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <li class="dropdown" >
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="images/2.png">
                <span class="username"><?php echo $_SESSION['stu_name']; ?></span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="stu_xgmm.php"><i class="fa fa-cog"></i> 修改密码</a></li>
                <li><a href="index_stu.php?action=logout"><i class="fa fa-key"></i> 注销</a></li>
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
                    <a class="active" href="index_stu.php">
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
                        <li><a href="stu_selstu.php">查看基本信息</a></li>
                        <li><a href="stu_upstu.php">修改基本信息</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-tasks"></i>
                        <span>选课信息</span>
                    </a>
                    <ul class="sub">
                        <li><a href="stu_startxk.php">开始选课</a></li>
                        <li><a href="stu_yxkc.php">已选课程/退课</a></li>
                     
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-envelope"></i>
                        <span>成绩查询</span>
                    </a>
                    <ul class="sub">
                        <li><a href="stu_selcj.php">成绩查询</a></li>
                        <li><a href="stu_selxfj.php">学分绩查询</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-glass"></i>
                        <span>统计信息</span>
                    </a>
                    <ul class="sub">
                        <li><a href="stu_yqdxf.php">已取得学分</a></li>
                    </ul>
                </li>
            </ul>            </div>
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
       选课
    </div>
    <div>
        <form action='stu_startxk.php'  method='post' >
          请选择学年&nbsp;
          <select name="val">
                <option value="2015-2016_1">2015-2016第一学期</option>
                <option value="2015-2016_2">2015-2016第二学期</option>
                <option value="2016-2017_1">2016-2017第一学期</option>
                <option value="2016-2017_2">2016-2017第二学期</option>
                <option value="2017-2018_1">2017-2018第一学期</option>
                <option value="2017-2018_2">2017-2018第二学期</option>
                <option value="2018-2019_1">2018-2019第一学期</option>
                <option value="2018-2019_2">2018-2019第二学期</option>
            </select>
             &nbsp;
              <button type="submit" class="btn btn-info" name="selxn" >查询</button>
      </form>
        <form action='stu_xkcl.php'  method='post' >
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
            <th>教师</th>
            <th>选课</th>
          </tr>
        </thead>
        <tbody>
        
        <?php
             error_reporting(E_ERROR);
             $val=$_POST['val'];
             $A=$_SESSION['stu_id'];
             $conn=@mysql_connect("localhost","root","root");
             mysql_select_db("stugrade",$conn);
             if(!$val){
                 $sql="select course.*,teacher.* from course,teacher  where  course.teach_id=teacher.teach_id and course.course_id !=all(select course_id from grade where stuno='$A')";
             } else {
$sql="select course.*,teacher.* from course,teacher  where  course.teach_id=teacher.teach_id and course.xktime='$val' and course.course_id !=all(select course_id from grade where stuno='$A')";                 
}

             mysql_query("set names 'utf8'");
             $res=mysql_query($sql,$conn);
             while($arr=mysql_fetch_assoc($res)){
             echo "<tr data-expanded='true'>";
             echo  "<td>".$arr['course_id']."</td>";
             echo  "<td>".$arr['course_name']."</td>";
             echo  "<td>".$arr['credit']."</td>";
             echo  "<td>".$arr['xktime']."</td>";
             echo  "<td>".$arr['name']."</td>";
             echo  "<td><input type='checkbox' name='chk[]' value='".$arr['course_id']."' /></td>";
             echo  "</tr>"; 
             }   
        ?>
        </tbody>
      </table>
            <center>
                <button type="submit" class="btn btn-info" name="selkc" >选课</button>&emsp;&emsp;
            <button type="reset" class="btn btn-info">重置</button>
            </center>
        </form>
    </div>
  </div>
</div>

</section>
<!--main content end-->
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
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
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
	</script>
<!-- calendar -->
	<script type="text/javascript" src="js/monthly.js"></script>
	<script type="text/javascript">
		$(window).load( function() {

			$('#mycalendar').monthly({
				mode: 'event',
				
			});

			$('#mycalendar2').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});

		switch(window.location.protocol) {
		case 'http:':
		case 'https:':
		// running on a server, should be good.
		break;
		}

		});
	</script>
</body>
</html>
