<?php

//error_reporting(E_ALL); 
ini_set('display_errors', '1'); 
ini_set('error_log', dirname(__FILE__) . '/error_log.txt'); //将出错信息输出到一个文本文件 

require('database.php');


//==============VIEW==============
$sql = 'select * from ml_wh_examination_data WHERE did = 1 ';
$result = mysqli_query($GLOBALS['conn'], $sql);

$results = array();
	
while ($row = mysqli_fetch_assoc($result)){
	$results[] = $row;
}

$view = number_format($results[0]['value'] + 1);

$sql = 'update ml_wh_examination_data set value = value + 1 WHERE did = 1';
$result = mysqli_query($GLOBALS['conn'], $sql);

//============LIKE================

$sql = 'select * from ml_wh_examination_data WHERE did = 2 ';
$result = mysqli_query($GLOBALS['conn'], $sql);

$results = array();
	
while ($row = mysqli_fetch_assoc($result)){
	$results[] = $row;
}

$like = number_format($results[0]['value'] + 1);

$sql = 'update ml_wh_examination_data set value = value + 1 WHERE did = 2';
$result = mysqli_query($GLOBALS['conn'], $sql);

$version = 1.5;

if(empty($_REQUEST['sn'])){


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>My Exams&trade; - Cloudy Young</title>

<link rel="shortcut icon" type="image/ico" href="https://gz.bcebos.com/v1/myexams/cyoung.me.svg" />
<meta name="msapplication-TileImage" content="https://gz.bcebos.com/v1/myexams/cyoung.me.svg"/>

<link href="https://gz.bcebos.com/v1/myexams/css/font-awesome.min.css?<?php echo $version ?>" rel="stylesheet">
<link rel="stylesheet" href="https://gz.bcebos.com/v1/myexams/layui-v2.2.6/css/layui_MyExams_adapt.css?<?php echo $version ?>">
<link rel="stylesheet" href="https://gz.bcebos.com/v1/myexams/css/layui.css?<?php echo $version ?>">
<link rel="stylesheet" href="https://gz.bcebos.com/v1/myexams/myexams.css?<?php echo $version ?>">


<link href='https://gz.bcebos.com/v1/myexams/css/font.css?<?php echo $version ?>' rel='stylesheet' type='text/css' />
<link href='https://cdn.webfont.youziku.com/webfonts/nomal/102775/46972/5ad6efcdf629d91254ccbd29.css' rel='stylesheet' type='text/css' />

<style>
body{
	font-family:'MyriadSetPro-Thin';
}
</style>


</head>
<body>

<div class="header" style="overflow: hidden;">
<ul>
	<li class="header-ul-li header-title">
		<i class="fa fa-hand-peace-o"></i> MY EXAMS&trade;
	</li>
	<li class="header-ul-li" style="text-align: right;">
		<a href="javascript: exit();"><p id="user"></p></a>
	</li>
	
	<!--
	<a href="#">
		<li class="header-ul-li header-ul-li-selected">
			Home
		</li>
	</a>
	-->
</ul>
</div>

<!-----------------INTRO---------------->

<div id="intro" style="display: none;">

<div class="insider-content">

<img src="https://gz.bcebos.com/v1/myexams/images/banner.png" class="banner"></img>


This project is powered by <br>
<a class="layui-btn layui-btn-primary layui-btn-radius layui-btn-big" href="http://www.cyoung.me" target="_blank">Cloudy Young</a>

<br>
Managed by <br>
<a class="layui-btn layui-btn-primary layui-btn-radius layui-btn-big" href="http://meonc.studio" target="_blank">Meonc Studio</a>

<hr>
Updating Record & Feedback<br>
<a class="layui-btn layui-btn-primary layui-btn-radius layui-btn-big" href="javascript: updatingRecord();">Updating Record</a>
<a class="layui-btn layui-btn-primary layui-btn-radius layui-btn-big" href="javascript: feedback();">Problem Report</a>


</div>

<div class="bottom-bar">

	<button class="bar-ul-li" onclick="javascript: showDiv('course-select'); getStudentNumber();">
		<i class="fa fa-chevron-right fa-lg"></i>
	</button>
	
	<p class="bar-ul-li-left" id="page-view">
		<i class="fa fa-eye fa-lg"></i> <?php echo $view ?> views
	</p>


</div>

</div>




<!-----------------COURSES SELECTION---------------->

<div id="course-select" style="display: none;">

<div class="insider-content">

<div class="insider-title">Maple Leaf International School</div>
<p class="layui-btn layui-btn-danger">Wuhan</p>
<p class="layui-btn layui-btn-danger" id="examFullName" onclick="javascript: getSelectExams();">...</p>

<div style="padding-top: 30px;"></div>

<div id="courseList" style="margin-left: 10px; margin-right: 10px;"></div>

</div>

<div class="bottom-bar">

	<button class="bar-ul-li" id="course-next" disabled='disabled' onclick="setAllCourse2Detail();">
		<i class="fa fa-chevron-right fa-lg"></i>
	</button>
	
	<button class="layui-btn-danger bar-ul-li" id="close" onclick="showDiv('intro');">
		<i class="fa fa-close fa-lg"></i>
	</button>
	
	<p class="bar-ul-li-left" id="courseamount">
	</p>


</div>

</div>


<!-----------------COURSES DETAIL---------------->

<?php

	
for($t = 0; $t < 7; $t++){
	
	$current = $t + 1;
	

		
		$pre1 = "PreviousStep()";
		$nex1 = "NextStep()";
		
		$pre2 = "PreviousStep()";
		$nex2 = "NextStep()";
		
	
?>

<!-----------------COURSES DETAIL <?php echo $t + 1 ?>---------------->

<div id="course-detail-<?php echo $t + 1 ?>-teacher" style="display: none;">

<div class="insider-content">
	<div class="insider-title" id="course-detail-<?php echo $t + 1 ?>-title1"></div>
	<p class="layui-btn layui-btn-warm">Teacher</p>
	
	<div class="insider-content" id="course-detail-<?php echo $t + 1 ?>-teacher-select"></div>
	
</div>

<div class="bottom-bar">
	<button class="bar-ul-li" id="course-detail-<?php echo $t + 1 ?>-next1" onclick="javascript: <?php echo $nex1 ?>" disabled="disabled">
		<i class="fa fa-chevron-right fa-lg"></i>
	</button>
	<button class="layui-btn-warm bar-ul-li" onclick="javascript: <?php echo $pre1 ?>">
		<i class="fa fa-chevron-left fa-lg"></i>
	</button>
	
	<p class="bar-ul-li-left" id="course-detail-<?php echo $t + 1 ?>-teacher-amount">
	</p>
	
</div>

</div>

<div id="course-detail-<?php echo $t + 1 ?>-block" style="display: none;">

<div class="insider-content">
	<div class="insider-title" id="course-detail-<?php echo $t + 1 ?>-title2"></div>
	<p class="layui-btn layui-btn-warm">Block</p>
	
	<div class="insider-content" id="course-detail-<?php echo $t + 1 ?>-block-select"></div>
	
</div>

<div class="bottom-bar">
	<button class="bar-ul-li" id="course-detail-<?php echo $t + 1 ?>-next2" onclick="javascript: <?php echo $nex2 ?>" disabled="disabled">
		<i class="fa fa-chevron-right fa-lg"></i>
	</button>
	<button class="layui-btn-warm bar-ul-li" onclick="javascript: <?php echo $pre2 ?>">
		<i class="fa fa-chevron-left fa-lg"></i>
	</button>
	
	<p class="bar-ul-li-left" id="course-detail-<?php echo $t + 1 ?>-block-amount">
	</p>
	
</div>

</div>

<?php

}

?>

<div id="course-time-loading" style="display: none;">

<div class="insider-content">


<div class="insider-title">
<i class="fa fa-circle-o-notch fa-spin fa-2x"></i>
<br>
Generating...
</div>


</div>

<div class="bottom-bar">
	<button class="bar-ul-li" onclick="javascript: " disabled="disabled">
		<i class="fa fa-cog fa-spin fa-lg"></i>
	</button>
	<button class="layui-btn-warm bar-ul-li" onclick="javascript: PreviousStep();" disabled="disabled">
		<i class="fa fa-chevron-left fa-lg"></i>
	</button>
	
</div>

</div>

<div id="course-timeline" style="display: none;">

<div class="insider-content">

<div class="insider-title">
<i class="fa fa-check fa-5x"></i>
<br>
Congratulations!
</div>


<blockquote class="layui-elem-quote layui-elem-quote-error" style="color: #ff5050">
<i class="fa fa-info-circle"></i> Conflict Exams are in <button class="layui-btn layui-btn-danger-on layui-btn-radius layui-btn-small sign-timeline">RED TITLE</button>
</blockquote>

<div id="course-timeline-content"></div>

</div>

<div class="bottom-bar">
	<button class="bar-ul-li" onclick="javascript: showDiv('course-finish');">
		<i class="fa fa-chevron-right fa-lg"></i>
	</button>
	<button class="layui-btn-warm bar-ul-li" onclick="javascript: showLink();">
		<i class="fa fa-share-alt fa-lg"></i>
	</button>
	
</div>

</div>

<div id="course-finish" style="display: none;">

<div class="insider-content">
<div class="insider-title-red">Like Us</div>

<div class="container">
	<section class="content">
		<ol class="grid">
			<li class="grid__item">
				<button class="icobutton icobutton--heart like"><span class="fa fa-heart fa-2x"></span><br><span class="icobutton__text icobutton__text--side"><?php echo $like ?></span></button>
			</li>
		</ol>
	</section>
</div>

<hr>

<div class="insider-title">Share</div>

<?php

$random = md5(rand(10000,99999) . 'MY EXAMS' . time() . 'CLOUDYYOUNG' . time() . '20170704');

$qzone = 'https://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=' . urlencode('https://www.cyoung.me/My Exams?r='. $random) . '&title=My+Exams+-+Cloudy+Young&pics=' . urlencode('http://www.cyoung.me/emlog/favicon.ico') . '&summary=Examinations%20Inquiry%20of%20Maple%20Leaf%20International%20School%20-%20Wuhan';

$qfriend = 'http://connect.qq.com/widget/shareqq/index.html?url=' . urlencode('https://www.cyoung.me/My Exams?r='. $random) . '&showcount=0&desc=My+Exams+-+Cloudy+Young&summary=My+Exams+-+Cloudy+Young&title=My+Exams+-+Cloudy+Young&site=Cloudy Young&pics=' . urlencode('http://www.cyoung.me/emlog/favicon.ico') . '&summary=Examinations%20Inquiry%20of%20Maple%20Leaf%20International%20School%20-%20Wuhan';

?>


<ol>
	<li class="grid__item share">
		<a href="<?php echo $qzone ?>" target="_blank"><i class="fa fa-qq fa-2x"></i><br>QZone</a>&nbsp &nbsp
		<a href="<?php echo $qfriend ?>" target="_blank"><i class="fa fa-qq fa-2x"></i><br>QQ</a>
	</li>
</ol>

<hr>

Problem Report<br>
<a class="layui-btn layui-btn-primary layui-btn-radius layui-btn-big" href="javascript: feedback();" target="_blank">Problem Report</a>


<div class="bottom-bar" class="grid__item share">
	<button class="layui-btn-danger bar-ul-li" id="close" onclick="showDiv('intro');">
		<i class="fa fa-close fa-lg"></i>
	</button>
</div>

</div>
<script type="text/javascript" src="https://gz.bcebos.com/v1/myexams/function.js?<?php echo $version ?>"></script>
<script src="https://gz.bcebos.com/v1/myexams/js/dest/layui.js?<?php echo $version ?>"></script>
<script src="https://gz.bcebos.com/v1/myexams/js/dest/layui.all.js?<?php echo $version ?>"></script>
<script src="https://gz.bcebos.com/v1/myexams/js/jquery-3.2.1.min.js?<?php echo $version ?>"></script>
<script src="https://gz.bcebos.com/v1/myexams/js/like.js?<?php echo $version ?>"></script>
<script src="https://gz.bcebos.com/v1/myexams/js/mo.min.js?<?php echo $version ?>"></script>


<script type="text/javascript">

var height;
var width;
var height_bulletin;
var width_bulletin;
var studentNumber="";

if(screen.width <= 762){
	height = '100%';
	width = '100%';
	height_bulletin = '100%';
	width_bulletin = '90%';
}else{
	height = '80%';
	width = '95%';
	height_bulletin = '50%';
	width_bulletin = '430px';
}

showDiv('intro');

<?php

//============UPDATING================

$sql = 'select * from ml_wh_examination_data WHERE did = 3 ';
$result = mysqli_query($GLOBALS['conn'], $sql);

$results = array();
	
while ($row = mysqli_fetch_assoc($result)){
	$results[] = $row;
}

$updating = $results[0]['value'];




if($updating == 'true'){
	
	if(!empty($_REQUEST['key'])){
		if($_REQUEST['key'] == 'CLOUDYYOUNG'){
			$up = false;
		}else{
			$up = true;
		}
	}else{
		$up = true;
	}
	
}else{
	
	$up = false;
	
}


if($up == true){
	
	$sql = 'select * from ml_wh_examination_data WHERE did = 4 ';
	$result = mysqli_query($GLOBALS['conn'], $sql);

	$results = array();
		
	while ($row = mysqli_fetch_assoc($result)){
		$results[] = $row;
	}

	$bulletin_updating = $results[0]['value'];
		
?>
layer.load(2, {shade: 0.3});


//示范一个公告层
layer.open({
  type: 1
  ,title: false //不显示标题栏
  ,closeBtn: false
  ,area: width_bulletin
  ,shade: 0
  ,id: 'LAY_layuipro' //设定一个id，防止重复弹出
  ,resize: false
  ,btn: ['Confirm']
  ,btnAlign: 'c'
  ,moveType: 1 //拖拽模式，0或者1
  ,content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300; font-size: 18px;"><?php echo $bulletin_updating ?></div>'
  ,success: function(layero){
    var btn = layero.find('.layui-layer-btn');
  }
});
 

<?

	
}else{
	
	$sql = 'select * from ml_wh_examination_data WHERE did = 5 ';
	$result = mysqli_query($GLOBALS['conn'], $sql);

	$results = array();
		
	while ($row = mysqli_fetch_assoc($result)){
		$results[] = $row;
	}

	$bulletin = $results[0]['value'];
	
	if(!empty($bulletin)){
	
?>


//示范一个公告层
layer.open({
  type: 1
  ,title: false //不显示标题栏
  ,closeBtn: false
  ,area: width_bulletin
  ,shade: 0.3
  ,id: 'LAY_layuipro' //设定一个id，防止重复弹出
  ,resize: false
  ,btn: ['Confirm']
  ,btnAlign: 'c'
  ,moveType: 1 //拖拽模式，0或者1
  ,content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300; font-size: 18px;"><?php echo $bulletin ?></div>'
  ,success: function(layero){
    var btn = layero.find('.layui-layer-btn');
  }
});

<?

	}
	
	
?>

layer.msg('<b>Welcome to My Exams&trade;, mapleleafers!</b><br>  — Cloudy Young');

<?php

}

?>



getAllCourses();
getExamFullName();

post('request.php', {func: 'getLocalStudentNumber'}, function(res){
	
	if(res.code == 0){
		studentNumber = res.studentNumber;
		document.getElementById('user').innerHTML = '<i class="fa fa-user-circle-o"></i> ' + studentNumber;
	}
	
});



function showLink(){
	
layer.prompt({
	formType: 0,
	value: 'https://www.cyoung.me/My Exams?sn=' + studentNumber,
	title: 'Copy My Link',
	closeBtn: 0,
	btn: ['Done'],
}, function(value, index, elem){
	
	layer.close(index);
	
});
	
}

function getExamFullName(){
	
	getPageContent('request.php', {func: 'getExamFullName'}, function(res){
		
		document.getElementById('examFullName').innerHTML = res;
		
	});
	
}

function exit(){
	layer.confirm('Do you want to log out?', {
						title: 'Hi, ' + studentNumber,
						btn: ['Confirm', 'Dismiss'],//asking for read the record
						closeBtn: 0,
				}, function(index){//confirm
						 
						post('request.php', {func: 'exitLogin'}, function(res){
							if(res.code != 0){
								layer.msg('Some errors occur, fail.');
							}else{
								layer.msg("You successfully log out.");
								document.getElementById('user').innerHTML = "";
								showDiv('intro');
								studentNumber = "";
							}
							layer.close(index);
						});
						  
					
				}, function(index){//dismiss
					layer.close(index);
			});
			
}

function getStudentNumber(){
	
	var coverIndex = layer.load(1, {shade: 0.000001});
	
	post('request.php', {func: 'getLocalStudentNumber'}, function(res){
		
		if(res.code == 0){
			studentNumber = res.studentNumber;
			document.getElementById('user').innerHTML = '<i class="fa fa-user-circle-o"></i> ' + studentNumber;
			
			post('request.php', {func: 'saveStudentNumber', studentNumber: studentNumber}, function(res){
				
				if(res.code == 1){
					layer.confirm('Your examination schedule is recorded. <br>You can review it from the last change<br>(' + res.time + ').', {
								title: 'Hi, ' + studentNumber,
								btn: ['Review', 'Dismiss'],//asking for read the record
								closeBtn: 0,
						}, function(index){//review
								 
								submitUserAll(studentNumber);
								//showDiv('course-timeline');
								  
							layer.close(index);
						}, function(index){//reselect
							layer.close(index);
					});
				}
				
				layer.close(coverIndex);
				
			});
			return;
		}else{
			document.getElementById('user').innerHTML = '';
			
			layer.prompt({
				formType: 0,
				value: '',
				title: 'Your Student Number',
				closeBtn: 0,
				btn: ['OK'],
			}, function(value, index, elem){
				//alert(value); //得到value
				
				if(value.length != 8 && value.length != 10){
					layer.msg('Invalid Student Number');
					return;
				}
				
				studentNumber = value;
				
				post('request.php', {func: 'saveStudentNumber', studentNumber: value}, function(res){
					
					document.getElementById('user').innerHTML = '<i class="fa fa-user-circle-o"></i> ' + value;
					
					if(res.code == 2){
						
						layer.close(index);
						layer.close(coverIndex);
						
					}else if(res.code == 1){
						
						layer.close(index);
						layer.confirm('Your examination schedule is recorded. <br>You can review it from the last change<br>(' + res.time + ').', {
							title: 'Hi, ' + value,
							btn: ['Review', 'Dismiss'],//asking for read the record
							closeBtn: 0,
						}, function(index){//review
						  
						  submitUserAll(studentNumber);
						 // showDiv('course-timeline');
						  
						  layer.close(index);
						}, function(index){//reselect
						  layer.close(index);
						});       
						
						
					}
					
					layer.close(coverIndex);
					
				});
				
			});
		}
		
		
	});


	
}

function getSelectExams(){
	
	return;
	
	
	getPageContent('request.php', {func: 'getSelectExams'}, function(res){
		
		layer.open({
		  type: 1,
		  area: ['500px', '350px'],
		  title: 'Select Exams',
		  content: res,
		  success: function(layero, index){
			console.log(layero, index);
		  }
		});
	});
	
}

function updatingRecord(){

	layer.open({
        type: 2,
		title: 'Updating Record',
        content: 'request.php?func=updatingrecord',
        area: [height, width],
        maxmin: true,
    })
}

function feedback(){

	layer.open({
        type: 2,
		title: 'Feedback',
        content: 'request.php?func=feedbackform',
        area: [height, width],
        maxmin: true,
    })
}

function hideAll(){
	
	document.getElementById('intro').style.display = 'none';
	document.getElementById('course-select').style.display = 'none';
	document.getElementById('course-time-loading').style.display = 'none';
	document.getElementById('course-timeline').style.display = 'none';
	document.getElementById('course-finish').style.display = 'none';
	
	<?php
	
	for($t = 0; $t < 7; $t++){
		
	?>
document.getElementById('course-detail-<?php echo $t + 1 ?>-teacher').style.display = 'none';
	document.getElementById('course-detail-<?php echo $t + 1 ?>-block').style.display = 'none';
		
	<?php
		
	}
	
	?>
}

function showDiv(id){
	hideAll();
	if(id == 'course-timeline'){
		getAllCourses();
	}
	
	//document.getElementById(id).style.display = 'block';
	$("#" + id).fadeIn(250);
}

</script>
</body>

<p id="selectExams" class="layui-btn layui-btn-danger" style="margin: 10px;" onclick="javascript: setYSN('1,2,3')">0</p>



</html>

<?php

}else{
	
	
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>My Exams&trade; - Cloudy Young</title>

<link rel="shortcut icon" type="image/ico" href="https://gz.bcebos.com/v1/myexams/cyoung.me.svg" />
<meta name="msapplication-TileImage" content="https://gz.bcebos.com/v1/myexams/cyoung.me.svg"/>

<link rel="stylesheet" href="https://gz.bcebos.com/v1/myexams/css/layui.css?<?php echo $version ?>">
<link rel="stylesheet" href="https://gz.bcebos.com/v1/myexams/myexams.css?<?php echo $version ?>">
<link href="https://gz.bcebos.com/v1/myexams/css/font-awesome.min.css?<?php echo $version ?>" rel="stylesheet">

<link href='https://gz.bcebos.com/v1/myexams/css/font.css?<?php echo $version ?>' rel='stylesheet' type='text/css' />


</head>
<body>

<div class="header">
<ul>
	<a href="javascript: " style="overflow: hidden;">
		<li class="header-ul-li header-title">
			<i class="fa fa-hand-peace-o"></i> My Exams&trade;
		</li>
		<li class="header-ul-li" style="text-align: right;">
			<a href="javascript: "><p id="user"><i class="fa fa-user-circle-o"></i> <?php echo $_REQUEST['sn'] ?></p></a>
		</li>
	</a>
	
	<!--
	<a href="#">
		<li class="header-ul-li header-ul-li-selected">
			Home
		</li>
	</a>
	-->
</ul>
</div>


<div id="course-timeline" style="display: none;">

<div class="insider-content">

<div class="insider-title">
<i class="fa fa-user-circle-o fa-5x"></i>
<br>
<?php echo $_REQUEST['sn'] ?>
<p style="color: grey; font-size: 20px; line-height: 10px;" id="lastChange"></p>
</div>


<blockquote class="layui-elem-quote layui-elem-quote-error" style="color: #ff5050">
<i class="fa fa-info-circle"></i> Conflict Exams are in <button class="layui-btn layui-btn-danger-on layui-btn-radius layui-btn-small sign-timeline">RED TITLE</button>
</blockquote>

<div id="course-timeline-content"></div>

</div>

<div class="bottom-bar">
	<button class="bar-ul-li layui-btn-danger" onclick="javascript: window.open('?r20171103')">
		<i class="fa fa-close fa-lg"></i>
	</button>
	
</div>

</div>

<script type="text/javascript" src="https://gz.bcebos.com/v1/myexams/function.js?<?php echo $version ?>"></script>
<script src="https://gz.bcebos.com/v1/myexams/js/dest/layui.js?<?php echo $version ?>"></script>
<script src="https://gz.bcebos.com/v1/myexams/js/dest/layui.all.js?<?php echo $version ?>"></script>
<script src="https://gz.bcebos.com/v1/myexams/js/jquery-3.2.1.min.js?<?php echo $version ?>"></script>
<script src="https://gz.bcebos.com/v1/myexams/js/like.js?<?php echo $version ?>"></script>
<script src="https://gz.bcebos.com/v1/myexams/js/mo.min.js?<?php echo $version ?>"></script>
<script>

getStudentNumber();


function showDiv(id){
	$("#" + id).fadeIn(250);
}

function getStudentNumber(){
	
	post('request.php', {func: 'saveStudentNumber', studentNumber: "<?php echo $_REQUEST['sn'] ?>", method: "user"}, function(res){
		if(res.code == 1){
			
			document.getElementById('lastChange').innerHTML = 'Last change: ' + res.time;
			
			submitUserAll(<?php echo $_REQUEST['sn'] ?>);
			
		}else if(res.code == 3 || res.code == 2){
			
			window.location = "?20180103";
			
		}
		
	});


	
}


</script>

</body>

</html>

<?

}


?>