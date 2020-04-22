<?php

//error_reporting(E_ALL); 
ini_set('display_errors', '1'); 
ini_set('error_log', dirname(__FILE__) . '/error_log.txt'); //将出错信息输出到一个文本文件 

require('database.php');


$version = 1.2;


$func = $_REQUEST['func'];

if($func == "checkTeacher"){
	
	$course = $_REQUEST['course'];
	$id = $_REQUEST['id'];
	
	$y = getYear();
	$s = getSemester();
	$n = getExamName();
	
	$sql = 'select teacher from ml_wh_examination_roomassignment WHERE course = "' . $course . '" AND year = "' . $y . '" AND semester = "' . $s . '" AND exam_name = "' . $n . '"';
	$result = mysqli_query($GLOBALS['conn'], $sql);
	
	$results = array();
	
	while ($row = mysqli_fetch_assoc($result)){
		$results[] = $row;
	}
	
	
	$teachers = array();


	for($t = 0; $t < count($results); $t++){
		
		$teachers[$t] = $results[$t]['teacher'];
		
	}

	$teachers = array_unique($teachers);
	$teachers = array_values($teachers);

	sort($teachers);
	
	if(count($teachers)== 0){
		array_push($teachers, "ROSTER");
	}
	

	for($t = 0; $t < count($teachers); $t++){
		
?>

		<button id="course-detail-<?php echo $id ?>-teacher-<?php echo $t ?>" class="layui-btn layui-btn-primary layui-btn-radius layui-btn-big sign-teacher" onclick="teacherPress(this.id);" name="<?php echo $teachers[$t] ?>"><?php echo $teachers[$t] ?></button>

<?php
		
	}

	
}else if($func == "checkBlock"){
	
	$course = $_REQUEST['course'];
	$teacher = $_REQUEST['teacher'];
	$id = $_REQUEST['id'];
	
	$y = getYear();
	$s = getSemester();
	$n = getExamName();
	
	$sql = 'select block from ml_wh_examination_roomassignment WHERE course = "' . $course . '" AND teacher = "' . $teacher . '"  AND year = "' . $y . '" AND semester = "' . $s . '" AND exam_name = "' . $n . '"';
	$result = mysqli_query($GLOBALS['conn'], $sql);
	
	$results = array();
	
	while ($row = mysqli_fetch_assoc($result)){
		$results[] = $row;
	}
	
	
	$block = array();


	for($t = 0; $t < count($results); $t++){
		
		$block[$t] = $results[$t]['block'];
		
	}

	$block = array_unique($block);
	$block = array_values($block);

	sort($block);
	
	if(count($block)== 1 && $block[0] == ""){//针对所有E-Exams不分teacher和Block的情况
		$block[0] = "ROSTER";
	}
	
	for($t = 0; $t < count($block); $t++){
		
?>

		<button id="course-detail-<?php echo $id ?>-block-<?php echo $t ?>" class="layui-btn layui-btn-primary layui-btn-radius layui-btn-big sign-block" onclick="blockPress(this.id);" name="<?php echo $block[$t] ?>">Block <?php echo $block[$t] ?></button>

<?php
		
	}
	
}else if($func == "submit"){
	
	$course = array("", "", "", "", "", "", "");
	$teacher = array("", "", "", "", "", "", "");
	$block = array("", "", "", "", "", "", "");
	
	for($t = 0; $t < 7; $t++){
		
		$course[$t] = $_REQUEST["course" . ($t+1)];
		$teacher[$t] = $_REQUEST["teacher" . ($t+1)];
		$block[$t] = $_REQUEST["block" . ($t+1)];
		
	}
	
	$text = '';
	
	$weekarray = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
	
	$y = getYear();
	$s = getSemester();
	$n = getExamName();
	
	for($t = 0; $t < 7; $t++){
		
		if($course[$t] != ""){
				
			$text = $text . "<hr>";
			
			if($course[$t] == "E-Exam: Communications 12" || $course[$t] == "E-Exam: English 12"){
				
				$sql = 'select * from ml_wh_examination_roomassignment WHERE course = "' . $course[$t] . '"  AND year = "' . $y . '" AND semester = "' . $s . '" AND exam_name = "' . $n . '"';
				
				$result = mysqli_query($GLOBALS['conn'], $sql);
				
				$results = array();
				
				while ($row = mysqli_fetch_assoc($result)){
					$results[] = $row;
				}
				
				$classroom = $results[0]['exam_room'];
				for($t1 = 1; $t1 < count($results) - 1; $t1++){
					
					$classroom = $classroom . ", A" . $results[$t1]['exam_room'];
					
				}
				
				$text = $text . '<h4>' . $results[0]['course'] . '[' . $results[0]['cid'] . ']</h4>Teacher: ' . '-' . '<br>Block: ' . '-' . '<br>Exam Rm: <b>A' . $classroom . '</b><br>Exam Date: <b>' . $results[0]['exam_date'] . ' - ' .  $weekarray[date("w",strtotime($results[0]['exam_date']))] . '</b><br>Start Time: <b>' . $results[0]['start_time'] . '</b><br>End Time: <b>' . $results[0]['end_time'] . '</b><br>Regular Rm: ' . '-' . '';
				
				
			}else if(strripos($course[$t], 'Mandarin') == 0 || strripos($course[$t], 'Chinese Social Studies') == 0){
				
				$sql = 'select * from ml_wh_examination_roomassignment WHERE course = "' . $course[$t] . '" AND teacher = "' . $teacher[$t] . '" AND block = "' . $block[$t] . '"  AND year = "' . $y . '" AND semester = "' . $s . '" AND exam_name = "' . $n . '"';
				
				$result = mysqli_query($GLOBALS['conn'], $sql);
				
				$results = array();
				
				while ($row = mysqli_fetch_assoc($result)){
					$results[] = $row;
				}
				
				for($t1 = 0; $t1 < count($results); $t1++){
					
					$text = $text . '<h4>' . $results[$t1]['course'] . '[' . $results[$t1]['cid'] . ']</h4>Teacher: ' . $results[$t1]['teacher'] . '<br>Block: ' . $results[$t1]['block'] . '<br>Day: <b>' . $results[$t1]['day'] . '</b><br>Exam Rm: <b>A' . $results[$t1]['exam_room'] . '</b><br>Exam Date: <b>' . $results[$t1]['exam_date'] . ' - ' .  $weekarray[date("w",strtotime($results[0]['exam_date']))] .  '</b><br>Start Time: <b>' . $results[$t1]['start_time'] . '</b><br>End Time: <b>' . $results[$t1]['end_time'] . '</b><br>Regular Rm: ' . $results[$t1]['regular_classroom'] . '';
					
				}
				
			}else{
				
				$sql = 'select * from ml_wh_examination_roomassignment WHERE course = "' . $course[$t] . '" AND teacher = "' . $teacher[$t] . '" AND block = "' . $block[$t] . '"  AND year = "' . $y . '" AND semester = "' . $s . '" AND exam_name = "' . $n . '"';
				
				
				$result = mysqli_query($GLOBALS['conn'], $sql);
				
				$results = array();
				
				while ($row = mysqli_fetch_assoc($result)){
					$results[] = $row;
				}
				
				$text = $text .  '<h4>' . $results[0]['course'] . '[' . $results[0]['cid'] . ']</h4>Teacher: ' . $results[0]['teacher'] . '<br>Block: ' . $results[0]['block'] . '<br>Exam Rm: <b>A' . $results[0]['exam_room'] . '</b><br>Exam Date: <b>' . $results[0]['exam_date'] . ' - ' .  $weekarray[date("w",strtotime($results[0]['exam_date']))] . '</b><br>Start Time: <b>' . $results[0]['start_time'] . '</b><br>End Time: <b>' . $results[0]['end_time'] . '</b><br>Regular Rm: ' . $results[0]['regular_classroom'] . '';
				
		}
			
		}
			
	}
	
	echo $text;
	
}else if($func == 'submit2'){
	
	
	//========SUBMIT 2.0===========
	
	$y = getYear();
	$s = getSemester();
	$n = getExamName();
	$cid = '';
	$weekarray = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
	
	if(!empty($_REQUEST['method'])){
		$method = $_REQUEST['method'];
	}else{
		$method = '';
	}
	
	if($method == ""){
		
		$course = array("", "", "", "", "", "", "");
		$teacher = array("", "", "", "", "", "", "");
		$block = array("", "", "", "", "", "", "");
		
		
		
		for($t = 0; $t < 7; $t++){
			
			$course[$t] = $_REQUEST["course" . ($t+1)];
			$teacher[$t] = $_REQUEST["teacher" . ($t+1)];
			$block[$t] = $_REQUEST["block" . ($t+1)];
			
		}
	}else if($method == "user"){
		
		//查找user对应的课程
		$studentNumber = $_REQUEST['studentNumber'];
		
		$sql = 'select * from ml_wh_examination_user WHERE studentNumber = "' . $studentNumber . '" AND year = "' . $y . '" AND semester = "' . $s . '" AND exam_name = "' . $n . '"';
		$result = mysqli_query($GLOBALS['conn'], $sql);
		
		$results = array();
		
		while ($row = mysqli_fetch_assoc($result)){
			$results[] = $row;
		}
		
		if(empty($results)){
			echo '';
			die;
		}
		
		$cid = explode(",", $results[0]['courseList']);
		
	}
	//======提前查一下CONFLICT考试时间=======
	
	$y = getYear();
	$s = getSemester();
	$n = getExamName();
	
	$sql = 'select * from ml_wh_examination_roomassignment WHERE course = "Conflict Exams" AND year = "' . $y . '" AND semester = "' . $s . '" AND exam_name = "' . $n . '"';
	$result = mysqli_query($GLOBALS['conn'], $sql);
	
	$results = array();
	
	while ($row = mysqli_fetch_assoc($result)){
		$results[] = $row;
	}
	
	if(empty($results)){
?>

<blockquote class="layui-elem-quote layui-elem-quote-error" style="color: #ff5050">
<i class="fa fa-info-circle"></i> Conflict Exam room assignment is missing. The exam schedule cannot be generated. Please report to administrator.
</blockquote>

<?php
		die;
	}
	
	$conflictExam = $results[0];//如果没有Conflict的话会报错，理应会设有的
	
	
	if($method == ""){
		//=====开始正经的查======
		$courseR = array();
		
		for($t = 0; $t < 7; $t++){
			
			if(!empty($course[$t])){
			
				if(checkProvincialExam($course[$t])){//E-EXAM
					
					$sql = 'select * from ml_wh_examination_roomassignment WHERE course = "' . $course[$t] . '"  AND year = "' . $y . '" AND semester = "' . $s . '" AND exam_name = "' . $n . '"';
					
					$result = mysqli_query($GLOBALS['conn'], $sql);
					
					$results = array();
					
					while ($row = mysqli_fetch_assoc($result)){
						$results[] = $row;
					}
					
					if(count($results) > 0){
						
						$classroom = "";
						
						for($t1 = 0; $t1 < count($results); $t1++){
						
							$classroom = $classroom . "A" . $results[$t1]['exam_room'];
							
							if($t1 != count($results) - 1){
								$classroom = $classroom . ", ";
							}
							
						}
						
						$results[0]['exam_room'] = $classroom;
						
						array_push($courseR, $results[0]);
					}
					
				}else if(strstr($course[$t],"Mandarin") != "" || strstr($course[$t],"Chinese Social Studies") != ""){
					
					$sql = 'select * from ml_wh_examination_roomassignment WHERE course = "' . $course[$t] . '" AND teacher = "' . $teacher[$t] . '" AND block = "' . $block[$t] . '"  AND year = "' . $y . '" AND semester = "' . $s . '" AND exam_name = "' . $n . '"';
					
					$result = mysqli_query($GLOBALS['conn'], $sql);
					
					$results = array();
					
					while ($row = mysqli_fetch_assoc($result)){
						$results[] = $row;
					}
					
					
					if(count($results) > 1){//大于1因为会有2条数据
						
						$results[0]['regular_classroom'] = $results[0]['regular_classroom'] . ", " . $results[1]['regular_classroom'];
						$results[0]['exam_room'] = "A" . $results[0]['exam_room'] . ", A" . $results[1]['exam_room'];
						
						array_push($courseR, $results[0]);
						
					}else if(count($results) > 0){
						
						$results[0]['exam_room'] = "A" . $results[0]['exam_room'];
						array_push($courseR, $results[0]);
						
					}
					
				}else{
					
					
					$sql = 'select * from ml_wh_examination_roomassignment WHERE course = "' . $course[$t] . '" AND teacher = "' . $teacher[$t] . '" AND block = "' . $block[$t] . '"  AND year = "' . $y . '" AND semester = "' . $s . '" AND exam_name = "' . $n . '"';
					
					$result = mysqli_query($GLOBALS['conn'], $sql);
				
					$results = array();
					
					while ($row = mysqli_fetch_assoc($result)){
						$results[] = $row;
					}
					
					if(count($results) > 0){
						$results[0]['exam_room'] = "A" . $results[0]['exam_room'];
						array_push($courseR, $results[0]);
					}
					
				}
				
				$courseR[$t]['conflict'] = "0";//CONFLICT的状态，0为正常1为冲突
			
			}
			
			
		}
		
	}else if($method == "user"){
		
	//=====开始正经的查 - METHOD2======
	$courseR = array();
	
		for($t = 0; $t < count($cid); $t++){
			
				
				$sql = 'select * from ml_wh_examination_roomassignment WHERE cid = "' . $cid[$t] . '"  AND year = "' . $y . '" AND semester = "' . $s . '" AND exam_name = "' . $n . '"';
					
				$result = mysqli_query($GLOBALS['conn'], $sql);
					
				$results = array();
					
				while ($row = mysqli_fetch_assoc($result)){
					$results[] = $row;
				}
				
			
				if(checkProvincialExam($results[0]['course'])){//E-EXAM
					
					
					$sql = 'select * from ml_wh_examination_roomassignment WHERE course = "' . $results[0]['course'] . '"  AND year = "' . $y . '" AND semester = "' . $s . '" AND exam_name = "' . $n . '"';
					
					$result = mysqli_query($GLOBALS['conn'], $sql);
					
					$results = array();
					
					while ($row = mysqli_fetch_assoc($result)){
						$results[] = $row;
					}
					
					if(count($results) > 0){
						
						$classroom = "";
						
						for($t1 = 0; $t1 < count($results); $t1++){
						
							$classroom = $classroom . "A" . $results[$t1]['exam_room'];
							
							if($t1 != count($results) - 1){
								$classroom = $classroom . ", ";
							}
							
						}
						
						$results[0]['exam_room'] = $classroom;
						
						array_push($courseR, $results[0]);
					}
					
				}else if(strstr($results[0]['course'],"Mandarin") != "" || strstr($results[0]['course'],"Chinese Social Studies") != ""){
					
					$sql = 'select * from ml_wh_examination_roomassignment WHERE course = "' .$results[0]['course'] . '" AND teacher = "' . $results[0]['teacher'] . '" AND block = "' . $results[0]['block'] . '"  AND year = "' . $y . '" AND semester = "' . $s . '" AND exam_name = "' . $n . '"';
					
					$result = mysqli_query($GLOBALS['conn'], $sql);
					
					$results = array();
					
					while ($row = mysqli_fetch_assoc($result)){
						$results[] = $row;
					}
					
					
					if(count($results) > 1){//大于1因为会有2条数据
						
						$results[0]['regular_classroom'] = $results[0]['regular_classroom'] . ", " . $results[1]['regular_classroom'];
						$results[0]['exam_room'] = "A" . $results[0]['exam_room'] . ", A" . $results[1]['exam_room'];
						
						array_push($courseR, $results[0]);
						
					}else if(count($results) > 0){
						
						$results[0]['exam_room'] = "A" . $results[0]['exam_room'];
						array_push($courseR, $results[0]);
						
					}
					
				}else{
					
					$sql = 'select * from ml_wh_examination_roomassignment WHERE course = "' . $results[0]['course'] . '" AND teacher = "' . $results[0]['teacher'] . '" AND block = "' . $results[0]['block'] . '"  AND year = "' . $y . '" AND semester = "' . $s . '" AND exam_name = "' . $n . '"';
					
					$result = mysqli_query($GLOBALS['conn'], $sql);
				
					$results = array();
					
					while ($row = mysqli_fetch_assoc($result)){
						$results[] = $row;
					}
					
					if(count($results) > 0){
						$results[0]['exam_room'] = "A" . $results[0]['exam_room'];
						array_push($courseR, $results[0]);
					}
					
				}
				
				$courseR[$t]['conflict'] = "0";//CONFLICT的状态，0为正常1为冲突
			
			
			
			
		}
	
	}
	
	//========所以这里到底怎么检查CONFLICT啊啊啊===========
	
	
	//echo JSON_encode($conflictExam);
	
	$datec = array();
	
	for($tc = 0; $tc < count($courseR); $tc++){
		
		array_push($datec, $courseR[$tc]['exam_date']);
		
	}

	$datec = array_unique($datec);
	$datec = array_values($datec);
	
	$current = 0;
	$examc = 0;
	
	for($tc = 0; $tc < count($datec); $tc++){
		
		$currentdate = $datec[$tc];
		
		for($current = 8; $current < 16; $current++){
			
			$examc = 0;
			
			for($tc1 = 0; $tc1 < count($courseR); $tc1++){
				
				if($courseR[$tc1]['exam_date'] == $currentdate){//ONLY WHEN CURRENT DATE
					
					$start_time = $courseR[$tc1]['start_time'];
					$end_time = $courseR[$tc1]['end_time'];
					
					if($start_time == $current){
						$examc ++;
					}else if($start_time < $current && $end_time > $current){
						$examc ++;
					}
					
					if($examc > 1){
						//conflict考试改成conflict时间
						$courseR[$tc1]['start_time'] = $conflictExam['start_time'];
						$courseR[$tc1]['end_time'] = $conflictExam['end_time'];
						$courseR[$tc1]['exam_date'] = $conflictExam['exam_date'];
						$courseR[$tc1]['conflict'] = "1";
						$courseR[$tc1]['reject'] = $courseR[$tc - 1]['course'];
					}
					
				}
				
			}
			
		}
		
	}
	
	//echo JSON_encode($courseR);
	//查好了……
	
	
	//给每个课程增加timestamp
	
	for($t = 0; $t < count($courseR); $t++){
		
		$courseR[$t]['timestamp'] = strtotime($courseR[$t]['exam_date'] . ' ' . $courseR[$t]['start_time']);
		
	}
	
	
	//根据TIMESTAMP排序，因为TIMESTAMP越小，考试时间越早，按时间顺序从早到晚
	
	$sort = array(
        'direction' => 'SORT_ASC', //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序  
        'field'     => 'timestamp',       //排序字段  
	);
	$arrSort = array();
	foreach($courseR AS $uniqid => $row){
		foreach($row AS $key=>$value){
			$arrSort[$key][$uniqid] = $value;
		}
	}
	if($sort['direction']){
		array_multisort($arrSort[$sort['field']], constant($sort['direction']), $courseR);
	}
	
	
	//========取出cid数组并保存========
	
	if($method == ""){
	
		$cl = '';
		
		for($t = 0; $t < count($courseR); $t++){
			
			$cl .= $courseR[$t]['cid'];
			if($t < count($courseR) - 1){
				$cl .= ',';
			}
			
		}
	
		$studentNumber = $_COOKIE['sn'];
		$courseList = $cl;
		
		
		
		$y = getYear();
		$s = getSemester();
		$n = getExamName();
		
		$sql = "SELECT * FROM `ml_wh_examination_user` WHERE `studentNumber` = $studentNumber AND `year` = '$y' AND `exam_name` = '$n' AND `semester` = '$s'";
		$result = mysqli_query($GLOBALS['conn'], $sql);
		
		$results = array();
		while ($row = mysqli_fetch_assoc($result)){
			$results[] = $row;
		}
		
		if(!empty($results)){
			
			$sql = "UPDATE `ml_wh_examination_user` SET `courseList`='$courseList' WHERE `year`='$y' AND `exam_name`='$n' AND `semester`='$s' AND `studentNumber`='$studentNumber'   ";
			$result = mysqli_query($GLOBALS['conn'], $sql);
			
		}else{
		
			$sql = "INSERT INTO `ml_wh_examination_user`(`year`, `exam_name`, `semester`, `studentNumber`, `courseList`) VALUES ('$y','$n','$s','$studentNumber','$courseList')";
			$result = mysqli_query($GLOBALS['conn'], $sql);
		
		}
	
	}
	
	
	
	//========写成text的格式=======
	
	
	$text = "";
	
	for($t = 0; $t < count($courseR); $t++){
		
		$text = $text . "<hr>";
		
		if($courseR[$t]['conflict'] == "1"){
			$buttonClass="layui-btn layui-btn-danger-on layui-btn-radius layui-btn-big sign-timeline";
			$blockQuoteClass="layui-elem-quote-error";
			$rejectShown = '<span style="color: #ff5050;">Conflict Course: <b>' . $courseR[$t]['reject'] . '</b></span><br>';
		}else{
			$buttonClass="layui-btn layui-btn-primary-on layui-btn-radius layui-btn-big sign-timeline";
			$blockQuoteClass="layui-elem-quote";
			$rejectShown = '';
		}
		
		if($courseR[$t]['teacher'] == "ROSTER" || $courseR[$t]['block'] == "ROSTER"){//E-EXAM
			
			$text = $text . '<h4><button class="' . $buttonClass . '">' . $courseR[$t]['course'] . ' [' . $courseR[$t]['cid'] . ']</button></h4><blockquote class="' . $blockQuoteClass . '">' . $rejectShown .  'Exam Rm: <b>' . $courseR[$t]['exam_room'] . '</b><br>Exam Date: <b>' . $courseR[$t]['exam_date'] . ' ' .  $weekarray[date("w",strtotime($courseR[$t]['exam_date']))] . '</b><br>Start Time: <b>' . $courseR[$t]['start_time'] . '</b><br>End Time: <b>' . $courseR[$t]['end_time'] . '</b></blockquote>';
			
		}else if(strstr($courseR[$t]['course'],"Mandarin") != "" || strstr($courseR[$t]['course'],"Chinese Social Studies") != "" || $courseR[$t]['day'] != '1,2'){
			
			$text = $text .  '<h4><button class="' . $buttonClass . '">' . $courseR[$t]['course'] . ' [' . $courseR[$t]['cid'] . ']</button></h4><blockquote class="' . $blockQuoteClass . '">' . $rejectShown . 'Teacher: ' . $courseR[$t]['teacher'] . '<br>Block: ' . $courseR[$t]['block'] . '<br>Exam Rm: <b>' . $courseR[$t]['exam_room'] . '</b><br>Exam Date: <b>' . $courseR[$t]['exam_date'] . ' ' .  $weekarray[date("w",strtotime($courseR[$t]['exam_date']))] . '</b><br>Start Time: <b>' . $courseR[$t]['start_time'] . '</b><br>End Time: <b>' . $courseR[$t]['end_time'] . '</b><br>Regular Rm: ' . $courseR[$t]['regular_classroom'] . '</blockquote>';
			
		}else{
			
			$text = $text .  '<h4><button class="' . $buttonClass . '">' . $courseR[$t]['course'] . ' [' . $courseR[$t]['cid'] . ']</button></h4><blockquote class="' . $blockQuoteClass . '">' . $rejectShown . 'Teacher: ' . $courseR[$t]['teacher'] . '<br>Block: ' . $courseR[$t]['block'] . '<br>Exam Rm: <b>' . $courseR[$t]['exam_room'] . '</b><br>Exam Date: <b>' . $courseR[$t]['exam_date'] . ' ' .  $weekarray[date("w",strtotime($courseR[$t]['exam_date']))] . '</b><br>Start Time: <b>' . $courseR[$t]['start_time'] . '</b><br>End Time: <b>' . $courseR[$t]['end_time'] . '</b><br>Regular Rm: ' . $courseR[$t]['regular_classroom'] . '</blockquote>';
			
		}
		
	}
	
	//=========TIMETABLE==========
	
	$table = "";
	
?>

<hr>

<h4><button class="layui-btn layui-btn-primary-on layui-btn-radius layui-btn-big sign-timetable">Timetable</button></h4>

<div style="text-align: center; overflow-x:scroll;">

<table class="layui-table">
  <colgroup>
    <col width="12%">
    <col width="8%">
	<col width="8%">
	<col width="8%">
	<col width="8%">
	<col width="8%">
	<col width="8%">
	<col width="8%">
	<col width="8%">
	<col width="8%">
	<col width="8%">
	<col width="8%">
  </colgroup>
  <thead>
    <tr>
      <th style="text-align: center;">Date/Time</th>
      <th>8:00</th>
	  <th>9:00</th>
	  <th>10:00</th>
	  <th>11:00</th>
	  <th>12:00</th>
	  <th>13:00</th>
	  <th>14:00</th>
	  <th>15:00</th>
	  <th>16:00</th>
    </tr> 
  </thead>
  <tbody>

<?php

$date = '';

$hour = 0;//unit: h
$last = 0;//unit: h
$current = 8;

for($tt = 0; $tt < count($courseR); $tt++){
	
	if($courseR[$tt]['exam_date'] != $date){
		
		$date = $courseR[$tt]['exam_date'];
		
?>
 <tr>
      <td style="background-color: #f3f3f3;"><b><?php echo $date ?><br><?php echo $weekarray[date("w",strtotime($date))] ?></b></td>
<?php	
	
		
		$current = 8;
		
	}
	
	$hour = date("H", strtotime($courseR[$tt]['start_time']));
	$last = date("H", strtotime($courseR[$tt]['end_time'])) - date("H", strtotime($courseR[$tt]['start_time']));
	
	for($t1 = $current; $t1 < 17; $t1++){
		
		if($t1 == $hour){
			
			if($courseR[$tt]['timestamp'] < time()){//Finished Exams
			
?>
		
		<td colspan="<?php echo $last ?>" style="color: #777; font-weight: bold; background-color: #f3f3f3;"><?php echo $courseR[$tt]['course'] ?><br><?php echo $courseR[$tt]['exam_room'] ?></td>

<?php
			
			}else if($courseR[$tt]['conflict'] == '1'){//Conflict Exams
			
?>

		<td colspan="<?php echo $last ?>" style="color: #fff; font-weight: bold; background-color: #ff5050;"><?php echo $courseR[$tt]['course'] ?><br><?php echo $courseR[$tt]['exam_room'] ?></td>
	
<?php
			
			}else{//Otherwise

?>

		<td colspan="<?php echo $last ?>" style="color: #fff; font-weight: bold; background-color: #00b0f0;"><?php echo $courseR[$tt]['course'] ?><br><?php echo $courseR[$tt]['exam_room'] ?></td>
	
<?php
				
			}
			
			$current = $current + $last;
			
			break;
			
			
			
		}else{
			
			$current ++;
			
			echo '<td></td>';
			
		}
		
	}
	
	if($tt + 1 == count($courseR) || $courseR[$tt+1]['exam_date'] != $date){
		
		if($current < 17){
			
			for($t2 = 0; $t2 < 17 - $current; $t2++){

				echo '<td></td>';
				
			}
			
		}
		
		echo '</tr>';
		
	}
	
}


?>

  </tbody>
</table>
</div>

<?php

	echo $text;
	
	
}else if($func == "getAllCourses"){
	
	
//========================COURSE========================

	$y = getYear();
	$s = getSemester();
	$n = getExamName();

	$sql = "SELECT * FROM `ml_wh_examination_roomassignment` WHERE year=$y AND semester='$s' AND exam_name='$n'";
	
	//echo $sql;


$result = mysqli_query($GLOBALS['conn'], $sql);

$results = array();
	
while ($row = mysqli_fetch_assoc($result)){
	$results[] = $row;
}

//echo json_encode($results);

$course = array();


for($t = 0; $t < count($results); $t++){
	$course[$t] = $results[$t]['course'];
}

$course = array_unique($course);
$course = array_values($course);

sort($course);



$select = '';

for($t = 0; $t < count($course); $t++){
	if($course[$t] != 'Conflict Exams'){
		
		$n = $course[$t];
		$n = str_replace('E-Exam: ','' ,$n);
		$n = str_replace('E-Exam ','' ,$n);
		$n = str_replace('E-Exam','' ,$n);
		
		$select = $select . '<button id="' . $t . '" class="layui-btn layui-btn-primary layui-btn-radius layui-btn-big sign-course" onclick="coursePress(' . $t . ');" name="' . $course[$t] . '">' . $n . '</button>';
		
	}
}

echo $select;
	
}else if($func == "updatingrecord"){
	
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

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
	<a href="#">
		<li class="header-ul-li header-title">
			<i class="fa fa-arrow-circle-o-up"></i> UPDATING
		</li>
	</a>
	<li class="header-ul-li">
		Version 2.12(20171103F)
	</li>
</ul>
</div>

<div class="insider-content">

Thank you for visiting this page and support this project.<br>
System Updating: 2017/11/03 · Database Updating: 2017/11/02

<hr>


<div class="insider-title">Bug Fixing and New Function - 2017/11/03</div>

<div class="insider-content-left">

1. Provincial Exam: Communications 12
<blockquote class="layui-elem-quote">
It required to choose teacher and block, and it will not go to the following steps.<br>
We removed the teacher and block choosing step, due to the random exam room.<br>
</blockquote>

2. Exam Saving
<blockquote class="layui-elem-quote">
If you are done the inquiry of exams, we will automatically save your exam data.<br>
For the next time, you can directly view your exam table from the last time again.
</blockquote>

</div>

Cloudy Young

<hr>


<div class="insider-title">New Domain - 2017/11/02</div>

<div class="insider-content-left">

1. We move the MyExams website to V. CLUB's domain.
<blockquote class="layui-elem-quote">
The functions are still available on new domain.<br>
The reason for this is because V. CLUB's domain is in https, and it has more protection when visiting, and the page has less chance to be intercepted.<br>
You can still visit the original project to enjoy the design(<a href="http:www.cyoung.me/myexams" target="_blank">http:www.cyoung.me/myexams</a>), but it will no longer update the database.
</blockquote>

2. Manager finding
<blockquote class="layui-elem-quote">
Due to the school work in Grade 12, Cloudy is still finding a person who can manage this project. If you are interested, and have ability to program HTML ,JS, CSS and PHP, please contact me by sending email to i@cyoung.me.
</blockquote>

</div>

Cloudy Young

<hr>

<div class="insider-title">New Function - 2017/07/05</div>

<div class="insider-content-left">

1. Like Us & Share function
<blockquote class="layui-elem-quote">
You can 'like us' by pressing the heart or share this page. We will appreciate.
</blockquote>

2. View
<blockquote class="layui-elem-quote">
You see pageview at the left bottom of first slide.
</blockquote>

</div>

Cloudy Young

<hr>

<div class="insider-title">New Function - 2017/07/01</div>

<div class="insider-content-left">

1. Conflict Exams Checking
<blockquote class="layui-elem-quote">
<i class="fa fa-info-circle"></i> The subjects which need Conflict Exams are in <button class="layui-btn layui-btn-danger-on layui-btn-radius layui-btn-small sign-timeline">RED TITLE</button>
</blockquote>

</div>

Cloudy Young


<hr>

<div class="insider-title">New Function - 2017/06/30</div>

<div class="insider-content-left">

1. Timetable
<blockquote class="layui-elem-quote">
Note: User can check their exam info through a display of timetable, example:

<div style="text-align: center; overflow-x:scroll;">

<table class="layui-table">
  <colgroup>
    <col width="12%">
    <col width="8%">
	<col width="8%">
	<col width="8%">
	<col width="8%">
	<col width="8%">
	<col width="8%">
	<col width="8%">
	<col width="8%">
	<col width="8%">
	<col width="8%">
	<col width="8%">
  </colgroup>
  <thead>
    <tr>
      <th>Date/Time</th>
      <th>8:00</th>
	  <th>9:00</th>
	  <th>10:00</th>
	  <th>11:00</th>
	  <th>12:00</th>
	  <th>13:00</th>
	  <th>14:00</th>
	  <th>15:00</th>

    </tr> 
  </thead>
  <tbody>

 <tr>
      <td>2017-06-22<br>Thursday</td>

		<td colspan="2">Social Studies 11<br>A403</td>

<td></td><td></td><td></td><td></td><td></td><td></td></tr> <tr>
      <td>2017-06-23<br>Friday</td>
<td></td><td></td><td></td>
		<td colspan="2">Mandarin 11<br>A505, A506</td>

<td></td><td></td><td></td></tr> <tr>
      <td>2017-06-24<br>Saturday</td>

		<td colspan="2">Chinese Social Studies 11: Politics<br>A505</td>

<td></td><td></td><td></td><td></td><td></td><td></td></tr>
  </tbody>
</table>
</div>

</blockquote>

</div>

Cloudy Young

<hr>

<div class="insider-title">New Function - 2017/06/29</div>

<div class="insider-content-left">

1. Feedback Center
<blockquote class="layui-elem-quote">
Note: Through Feedback Center, user can give us a feedback, and improve this project.
</blockquote>

2. Submit
<blockquote class="layui-elem-quote">
Note: A new Submit function is varied on request.php
</blockquote>

</div>

Cloudy Young

<hr>

<div class="insider-title">Important Updating - 2017/06/28</div>

<div class="insider-content-left">

1. User Interface
<blockquote class="layui-elem-quote layui-elem-quote-error">
Problem: Lots of mapleleafers think this page is so simple and ugly...even it gets a new font...
</blockquote>
<blockquote class="layui-elem-quote">
Solving: Brand brand new My-Exams is comming! See? Enjoy it!
</blockquote>

2. New Selecting Method
<blockquote class="layui-elem-quote layui-elem-quote-error">
Problem: No problem actually...
</blockquote>
<blockquote class="layui-elem-quote">
Solving: Selecting all your courses first, then select teachers and blocks for each course. Submit after finishing previous steps. You will see a outline for your examinations information.
</blockquote>

3. Manager Appointment
<blockquote class="layui-elem-quote layui-elem-quote-error">
Problem: Cloudy has less time to update database.
</blockquote>
<blockquote class="layui-elem-quote">
Solving: Jerry, Xie Bohan will help on this project.
</blockquote>

</div>

Cloudy Young

<hr>

<div class="insider-title">Important Fixing - 2017/06/20</div>

<div class="insider-content-left">
1. E-Exam
<blockquote class="layui-elem-quote layui-elem-quote-error">
Problem: When selecting E-Exam, it requests you to select teacher and block as well, and only displays the first Exam Rm.
</blockquote>
<blockquote class="layui-elem-quote">
Solving: When selecting E-Exam, all the available Exam Rm will be displayed without providing teacher and block.
</blockquote>

2. Chinese Courses' Day
<blockquote class="layui-elem-quote layui-elem-quote-error">
Problem: Chinese courses (including: Mandarin 10, Mandarin 11, Mandarin 12, Chinese Social Studies 10, Chinese Social Studies 11, Chinese Social Studies 11: Politics, Chinese Social Studies 12) are not show up the Exam Rm of Day 1 class and Day 2 class, but default Exam Rm for global.
</blockquote>
<blockquote class="layui-elem-quote">
Solving: Chinese courses will show up Day 1 Exam Rm and Day 2 Exam Rm at the same time.
</blockquote>

3. Beautifying
<blockquote class="layui-elem-quote layui-elem-quote-error">
Problem: So ugly... :(
</blockquote>
<blockquote class="layui-elem-quote">
Solving: A new font called MyriadSetPro.
</blockquote>

4. Week Day
<blockquote class="layui-elem-quote layui-elem-quote-error">
Problem: No week day, only a date.
</blockquote>
<blockquote class="layui-elem-quote">
Solving: Showing up with Monday, Tuesday, Wednesday, etc.
</blockquote>

5. E-Exam
<blockquote class="layui-elem-quote layui-elem-quote-error">
Problem: The preparation time is 08:00:00, and the actual start time is 09:00:00.
</blockquote>
<blockquote class="layui-elem-quote">
Solving: The start time is corrected.
</blockquote>

</div>

Cloudy Young

</div>


<div class="bottom-bar">
	<a href="request.php?func=feedbackform">
		<button class="bar-ul-li">
			<i class="fa fa-wrench"></i> PROBLEMS
		</button>
	</a>
	
</div>

</body>
</html>

<?php
	
}else if($func == "feedbackform"){
	
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

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
	<a href="#">
		<li class="header-ul-li header-title">
			<i class="fa fa-comments"></i> FEEDBACK
		</li>
	</a>

</ul>
</div>

<div class="insider-content" id="form" style="display: none;">

<div class="insider-title">Feedback Form</div>

<div class="insider-content-left">

<form class="layui-form layui-form-pane1">
	
	<div class="layui-form-item">
      <label class="layui-form-label">Type</label>
      <div class="layui-input-block" id="block">
        <select name="block" id="type" lay-verify="required|title">
          <option value="">Feedback Type</option>
            <option value="Proposal">Proposal</option>
            <option value="Complaint">Complaint</option>
			<option value="Bug / Error">Bug / Error</option>
        </select>
      </div>
    </div>

	
	<div class="layui-form-item layui-form-text">
    <label class="layui-form-label">Content</label>
    <div class="layui-input-block">
      <textarea type="text" id="content" name="content" lay-verify="required|comment" required placeholder="Hi Cloudy, I..." class="layui-textarea"></textarea>
    </div>
  </div>
	
	<div class="layui-form-item">
    <label class="layui-form-label">Name</label>
    <div class="layui-input-block">
      <input type="text" id="name" name="name" lay-verify="required|title" required placeholder="What is your name?" autocomplete="off" class="layui-input">
    </div>
	</div>
	
	<div class="layui-form-item">
    <label class="layui-form-label">Email</label>
    <div class="layui-input-block">
      <input type="email" id="email" name="email" lay-verify="email" required autocomplete="off" placeholder="How to contact you?" class="layui-input">
    </div>
	</div>
	
	<div class="layui-form-item">
    <label class="layui-form-label">Website</label>
    <div class="layui-input-block">
      <input type="text" id="website" name="website" autocomplete="off" placeholder="Do you have a website?" value="http://" class="layui-input">
    </div>
	</div>
	
	
</form>

</div>

<div class="bottom-bar">
	<a href="javascript: submit();" target="_blank">
		<button id="submit" class="bar-ul-li">
			<i class="fa fa-check"></i> SUBMIT
		</button>
	</a>
	
</div>

</div>

<div class="insider-content" id="finish" style="display: none;">

<div class="insider-title">
<i class="fa fa-check fa-5x"></i>
<br>
Thank you for your feedback!
</div>

We'll process your feedback in time.<br>
Any questions? Contact Cloudy! E-mail: i@cyoung.me

<div class="bottom-bar">

	
</div>

</div>


<script type="text/javascript" src="function.js"></script>
<script src="js/dest/layui.js"></script>
<script src="js/module/layer.js"></script>
<script src="js/dest/layui.all.js"></script>
<script src="js/jquery-3.2.1.min.js"></script>

<script type="text/javascript">

showDiv("form");

function submit(){
	
	document.getElementById("submit").innerHTML = '<i class="fa fa-cog fa-spin fa-lg"></i> LOADING';
	document.getElementById("submit").disabled = 'disabled';
	
	var name = document.getElementById("name").value;
	var website = document.getElementById("website").value;
	var content = document.getElementById("content").value;
	var email = document.getElementById("email").value;
	
	var type_ = document.getElementById("type");
	var type = type_.options[type_.selectedIndex].value;
	
	post("request.php?func=feedbacksubmit", {name: name, website: website, content: content, email: email, type: type}, function(res){
		
		if(res.code != 0){
			layer.msg(res.message);
			document.getElementById("submit").innerHTML = '<i class="fa fa-check"></i> SUBMIT';
			document.getElementById("submit").disabled = '';
			return;
		}
		
		showDiv("finish");
		
	});
	
}

function showDiv(id){
	hideAll();
	$("#" + id).fadeIn(250);
}

function hideAll(){
	
	document.getElementById('form').style.display = 'none';
	document.getElementById('finish').style.display = 'none';
	
}

</script>

</body>
</html>

<?php
	
}else if($func == "feedbacksubmit"){
	
	if(empty($_REQUEST['type'])){
		echo '{"code": -5, "message": "Field TYPE should be filled"}';
		return;
	}
	
	if(empty($_REQUEST['name'])){
		echo '{"code": -2, "message": "Field NAME should be filled"}';
		return;
	}
	
	if(empty($_REQUEST['email'])){
		echo '{"code": -3, "message": "Field EMAIL should be filled"}';
		return;
	}
	
	if(empty($_REQUEST['content'])){
		echo '{"code": -4, "message": "Field CONTENT should be filled"}';
		return;
	}
	
	if(!empty($_REQUEST['website'])){
		$website = $_REQUEST['website'];
	}else{
		$website = '';
	}
	
	$name = $_REQUEST['name'];
	$email = $_REQUEST['email'];
	
	$content = "[" . $_REQUEST['type'] . '] ' . $_REQUEST['content'];
	
	$IP = $_SERVER["REMOTE_ADDR"]; 
	
	if(!empty($studentNumber)){
		$studentNumber = $_COOKIE['studentNumber'];
	}else{
		$studentNumber = "";
	}
	
	$time = time();
	
	$sql = "INSERT INTO `ml_wh_examination_feedback`(`studentNumber`, `time`, `content`, `name`, `email`, `website`, `ip`) VALUES ('$studentNumber','$time','$content','$name','$email','$website','$IP')";	
	$result = mysqli_query($GLOBALS['conn'], $sql);
	
	
	if(!$result){
		echo '{"code": -1, "message": "unknown error"}';
		return;
	}
	
	echo '{"code": 0, "message": "succeed"}';
	
}else if($func == "like"){
	
	$sql = 'update ml_wh_examination_data set value = value + 1 WHERE did = 2';
	$result = mysqli_query($GLOBALS['conn'], $sql);
	
	if(!$result){
		
		echo '{"code": -1, "message": "fail"}';
		return;
		
	}
	
	$sql = 'select * from ml_wh_examination_data WHERE did = 2 ';
	$result = mysqli_query($GLOBALS['conn'], $sql);

	$results = array();
		
	while ($row = mysqli_fetch_assoc($result)){
		$results[] = $row;
	}
	
	$like = $results[0]['value'];
	
	$sentence = Array("Thank you for your support!","Thank you for your support!","A smile is the most charming part of a person forever.","Be confident with yourself and stop worrying what other people think. Do what's best for your future happiness!","Wish you can be exellent in the exam!","Don't try so hard, the best things come when you least expect them to.","Don’t let the past steal your present.","Dream most deep place, only then the smile is not tired.","Don’t be so hard on yourself.","Define your life with the actions you take, the love you give and the memories you make.","Every story has an ending. But in life, every ending is a new beginning","Everbody will make mistakes, that‘s why they put erasers on the end of pencils.","Everybody dies, but not everybody lives","Everything happens for a reason.","Every day may not be good...but there's something good in every day.","Every hour of lost time is a chance of future misfortune.","Follow your heart, but be quiet for a while first. Learn to trust your heart.","First I need your hand ,then forever can begin.","Grow old along with me, the best is yet to be.","Give so much time to improving yourself that you won't have time to criticize others.","However long the night, the dawn will break.","Happiness can be found even in the darkest of times.","I have been thinking I'm not good enough.I'm not perfect,but I'm complete.","If you want a happy life, tie it to a goal, not to people or things.","I don't know where I am going, but I am on my way.","I Am on my way to Near Near future, where You are there.","It is our choices that show what we truly are, far more than our abilities","I never wanted to be your whole life. Just your favorite part.","I’m not weird. I’m limited edition.");
	
	
	echo '{"code": 0, "message": "' . $sentence[rand(0, count($sentence) - 1)] . '", "like": "' . number_format($like) . '"}';
	
}else if($func == 'submitTable'){
	
	$key = $_REQUEST['key'];
	if($key != "CYCY"){
		echo '{"code": -1, "message": "wrong key!"}';
		die();
	}
	
	$table = $_REQUEST['table'];
	
	$line = explode("\n", $table);
	
	
	for($t = 0; $t < count($line); $t++){
		
		$part = explode('	', $line[$t]);
		
		if(count($part) >= 10){
			
			
			$course = $part[0];
			$exam_date = date('Y-m-d', strtotime($part[1]));
			$start_time = $part[2];
			$end_time = $part[3];
			$exam_room = $part[4];
			
			$teacher = $part[5];
			$regular_classroom  = $part[6];
			
			$enrollment = $part[11];
			$block = $part[7];
			$day = $part[8];
			$section = $part[10];
		
		}
		
		$y = getYear();
		$s = getSemester();
		$n = getExamName();
		
		$sql = "insert into ml_wh_examination_roomassignment (year, semester, exam_name, course, teacher, day, block, section, regular_classroom, exam_room, exam_date, start_time, end_time, enrollment) values('$y', '$s', '$n', '$course', '$teacher', '$day', '$block', '$section', '$regular_classroom', '$exam_room', '$exam_date', '$start_time', '$end_time', '$enrollment')";
		
		//echo $sql;
		
		$result = mysqli_query($GLOBALS['conn'], $sql);
		
		
		
	}
	
	echo '{"code": 0, "message": "succeed!"}';
	
	
}else if($func == 'saveStudentNumber'){
	
	$studentNumber = $_REQUEST['studentNumber'];
	
	if(!empty($_REQUEST['method']) && $_REQUEST['method'] == 'user'){
		
	}else{
		setcookie('sn', $studentNumber,time() + 360000);
	}
	
	$y = getYear();
	$s = getSemester();
	$n = getExamName();
	
	
	$sql = 'select * from ml_wh_examination_user WHERE studentNumber = "' . $studentNumber . '" AND year = "' . $y . '" AND semester = "' . $s . '" AND exam_name = "' . $n . '"';
	$result = mysqli_query($GLOBALS['conn'], $sql);
	
	$results = array();
	
	while ($row = mysqli_fetch_assoc($result)){
		$results[] = $row;
	}
	
	if(!empty($results)){
		
		if($results[0]['courseList'] != ""){
			echo '{"code": 1, "message": "You have records", "time": "' . $results[0]['time'] . '"}';
		}else{
			echo '{"code": 3, "message": "You have only reg"}';
		}
	}else{
		
		$sql = "insert into ml_wh_examination_user (cid, year, semester, exam_name, courseList, studentNumber, qq) values('', '$y', '$s', '$n', '', '$studentNumber', '')";
		$result = mysqli_query($GLOBALS['conn'], $sql);
		
		echo '{"code": 2, "message": "You need to create"}';
	}
	
}else if($func == 'getLocalStudentNumber'){
	
	if(!empty($_COOKIE['sn'])){
		echo '{"code": 0, "message": "succeed." , "studentNumber": "' . $_COOKIE['sn'] . '"}';
	}else{
		echo '{"code": -1, "message": "succeed."}';
	}
}else if($func == 'getExamFullName'){
	
	$y = getYear();
	$s = getSemester();
	$n = getExamName();
	
	echo $y . ' ' . $s . ' ' . $n;
	
}else if($func == 'exitLogin'){
	
	setcookie('sn', '', 0);
	echo '{"code": 0}';

}else if($func == 'getSelectExams'){
	
	getSelectExams();
	
}else if($func == 'loginAdminAccount'){
	
	$un = $_REQUEST['un'];
	$pw = $_REQUEST['pw'];
	
	$sql = "SELECT * FROM ml_exam_scheduler_admin WHERE username = '$un'";
	$result = mysqli_query($GLOBALS['conn'], $sql);
	
	
	$results = array();
	
	while ($row = mysqli_fetch_assoc($result)){
		$results[] = $row;
	}
	
	if(empty($results) || $results[0]['password'] != md5($pw)){
		
		echo '{"code": -1, "message": "Incorrect account."}';
		die();
		
	}
	
	$token = md5(rand(10000, 99999) . rand(10000, 99999) . time() . time() . time() . rand(10000, 99999));
	
	setcookie('an', $token, time() + 360000);
	
	$sql = "update ml_exam_scheduler_admin set token = '$token'  WHERE username = '$un'";
	$result = mysqli_query($GLOBALS['conn'], $sql);
	
	echo '{"code": 0, "message": "Success."}';
	
	
	
}else if($func == 'createNewExam'){
	
	
	if(checkAdminLogin() === false){
		echo '{"code": -1, "message": "Invalid request."}';
		die();
	}
	
	$an = checkAdminLogin();
	
	$title = $_REQUEST['title'];
	$campus = $_REQUEST['campus'];
	$term = $_REQUEST['term'];
	$year = $_REQUEST['year'];
	$type = $_REQUEST['type'];
	$start_date = $_REQUEST['start_date'];
	$end_date = $_REQUEST['end_date'];
	
	$sql = "INSERT INTO `ml_exam_scheduler_saved_exam_list`(`title`, `campus`, `year`, `term`, `type`, `start_date`, `end_date`) VALUES ('$title','$campus','$year','$term','$type','$start_date','$end_date')";
	$result = mysqli_query($GLOBALS['conn'], $sql);
	
	if(!$result){
		echo '{"code": -1, "message": "Error."}';
		die();
	}else{
		echo '{"code": 0, "message": "Succeed"}';
	}
	
	

}else if($func == 'accessStsListLibrary'){
	
	if(checkAdminLogin() === false){
		echo '{"code": -1, "message": "Invalid request."}';
		die();
	}
	
	$an = checkAdminLogin();
	
	$sql = "SELECT * FROM ml_exam_scheduler_student_list_library ORDER BY `lid` DESC";
	$result = mysqli_query($GLOBALS['conn'], $sql);
	
	$results = array();
	
	while ($row = mysqli_fetch_assoc($result)){
		$results[] = $row;
	}
	
	
	$eid = $_REQUEST['eid'];
	
	
	
	?>
	
	
<div class="" id="stsListUpload" style="padding: 50px; font-size: 20px;">
	
	<div id="stsListUpload-S1" style="padding: 0 20%; text-align: center;">
		<div style="padding-top: 2%">
			<div>
				<img src="https://gz.bcebos.com/v1/myexams/images/MicrosoftOfficeExcelIcon.png" style="width: 60px;" />
				<p class="sts-list-library-upload-text">Import <b>XLS</b> / <b>XLSX</b> / <b>XLSB</b> or <b>CSV</b> file</p>
			</div>
			<hr>
			<div>
				<p class="sts-list-library-upload-text">Excel File Column Structure</p>
				<img src="https://gz.bcebos.com/v1/myexams/images/importStsList.png" style="width: 100%;" />
				<p class="sts-list-library-upload-text"><br></p>
			</div>
			<a id="stsListUpload-S1-next" class="layui-btn sts-list-library-upload-btn"><i class="fa fa-arrow-right"></i>&nbsp;&nbsp;Next Step</a>
		</div>
	</div>
	
	<div id="stsListUpload-S2" style="padding: 0 20%; text-align: center;">
			
		<div style="padding-top: 0%">
			<!--UPLOAD-->
				<p class="sts-list-library-upload-text">Import Excel File</p>
				<div class="layui-form-item">
					<label class="layui-form-label">List Name</label>
					<div class="layui-input-block">
						<input type="text" id="stsListUpload-S2-title" required  lay-verify="required" placeholder="Untitled Student List" autocomplete="off" class="layui-input">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">Excel File</label>
					<div class="layui-input-block" style="text-align: left;">
						<input type="file" id="selectfiles" class="" style="display: none;" accept=".xls,.xlsx,.xlsb,.csv" />
						<a id="stsListUpload-S2-select" class="layui-btn sts-list-library-upload-btn" style="width: 100%;"><i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;&nbsp;Browse Excel File</a>
					</div>
				</div>
				<div id="stsListUpload-S2-table"></div>
				<div>
					<a id="stsListUpload-S2-pre" class="layui-btn sts-list-library-upload-btn"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;&nbsp;Cancel</a>
					<a id="stsListUpload-S2-next" class="layui-btn sts-list-library-upload-btn"><i class="fa fa-arrow-right"></i>&nbsp;&nbsp;&nbsp;Submit</a>
				</div>
			</div>
	</div>
	
	<div id="stsListUpload-S3" style="padding: 0 20%; text-align: center;">
		<div style="padding-top: 20%;">
			<p class="sts-list-library-upload-text">Importing Student List</p>
			<div style="padding: 5%">
				<div class="layui-progress" lay-showPercent="yes" lay-filter="sts-list-library-upload-progress">
				  <div class="layui-progress-bar" lay-percent="50%"></div>
				</div>
			</div>
			<div>
				<a id="stsListUpload-S3-next" class="layui-btn sts-list-library-upload-btn"><i class="fa fa-check"></i>&nbsp;&nbsp;&nbsp;Finished</a>
			</div>
		</div>
	</div>
	
	
</div>


<script src="https://gz.bcebos.com/v1/myexams/js/cpexcel.js"></script>
<script src="https://gz.bcebos.com/v1/myexams/js/jszip.js"></script>
<script src="https://gz.bcebos.com/v1/myexams/js/xlsx.js"></script>
<script>
	
var rABS = true; // true: readAsBinaryString ; false: readAsArrayBuffer
var isFile = false;
var jsonbook;
$('#stsListUpload-S3-next').hide();

function renderTable(){
	var table = layui.table;
		table.init('stsListUpload-S2-table-table', {
			height: 220
			,page: {theme: '#39825a', layout: ['prev', 'page', 'next']}
			,limit: 1000
			,limits: [500, 1000, 5000]
			,text: {
				none: 'Empty'
			}
			,size: 'sm'
	});
	
}

renderTable();

function handleFile(e) {
  var files = e.target.files, f = files[0];
  var reader = new FileReader();
  reader.onload = function(e) {
    var data = e.target.result;
    if(!rABS) data = new Uint8Array(data);
    var workbook = XLSX.read(data, {type: rABS ? 'binary' : 'array'});
	//console.log(workbook);
	jsonbook = JSON.stringify(XLSX.utils.sheet_to_json(workbook.Sheets[workbook.SheetNames[0]]));
	//console.log(jsonbook);
	
	$('#stsListUpload-S2-select').html('<i class="fa fa-check"></i>&nbsp;&nbsp;' + f['name']);
	$('#stsListUpload-S2-select').wordLimit();
	$('#stsListUpload-S2-table').html(XLSX.utils.sheet_to_html(workbook.Sheets[workbook.SheetNames[0]]));
	$('#stsListUpload-S2-table table').attr('lay-filter', 'stsListUpload-S2-table-table');
	$('#stsListUpload-S2-table table').attr('id', 'stsListUpload-S2-table-table');
	//$('#stsListUpload-S2-table table').attr('class', 'layui-table');
	//$('#stsListUpload-S2-table table').attr('lay-data', "{height: 315, id: 'stsListUpload-S2-table-table'}");
	$('#stsListUpload-S2-table table tbody').before('<thead><tr><th lay-data="{field:\'student_number\', width: 140, sort: true}">Student Number</th><th lay-data="{field:\'first_name\', width: 100}">First Name</th><th lay-data="{field:\'last_name\', width: 100, sort: true}">Last Name</th><th lay-data="{field:\'course_id\', width: 170, sort: true}">Course ID</th><th lay-data="{field:\'course_title\', width: 170, sort: true}">Course Title</th><th lay-data="{field:\'teacher\', width: 170, sort: true}">Teacher</th></tr></thead>');
	
	isFile = true;
	//console.log($('#stsListUpload-S2-table').html());
	
	$('#stsListUpload-S2-table').show(function(){
		renderTable();
	});
	
	
	
    /* DO SOMETHING WITH workbook HERE */
  };
  if(rABS) reader.readAsBinaryString(f); else reader.readAsArrayBuffer(f);
  
}

selectfiles.addEventListener('change', handleFile, false);

$('#stsListUpload-S1-next').click(function(){
	isFile = false;
	$('#stsListUpload-S2-select').html('<i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;&nbsp;Browse Excel File');
	$('#stsListUpload-S2-table').html('<table lay-filter="stsListUpload-S2-table-table" class="layui-table"><thead><tr><th lay-data="{field:\'student_number\', width: 140, sort: true}">Student Number</th><th lay-data="{field:\'first_name\', width: 100}">First Name</th><th lay-data="{field:\'last_name\', width: 100, sort: true}">Last Name</th><th lay-data="{field:\'course_id\', width: 170, sort: true}">Course ID</th><th lay-data="{field:\'course_title\', width: 170, sort: true}">Course Title</th><th lay-data="{field:\'teacher\', width: 170, sort: true}">Teacher</th></tr></thead></table>');
	$('#stsListUpload-S2-table').show(function(){
		renderTable();
	});
});


$('#stsListUpload-S2-select').click(function(){
	document.getElementById('selectfiles').click();
});

$('#stsListUpload-S2-next').click(function(){
	if(!isFile){
		layer.msg("Please import excel file");
	}else if($('#stsListUpload-S2-title').val().trim() == ''){
		layer.msg("Please name the list");
	}else{
		showDivStsListFrame(3);
		$.ajax({
			type: "POST",
			url: "request.php",
			data: {func: 'submitNewStsListByAdmin', title: $('#stsListUpload-S2-title').val().trim(), data: jsonbook},
			//processData : false, //必须false才会自动加上正确的Content-Type
			dataType: 'json',
			//contentType : false ,//必须false才会避开jQuery对 formdata 的默认处理 
			xhr: function(){
				var xhr = $.ajaxSettings.xhr();
				if(onprogress && xhr.upload) {
					xhr.upload.addEventListener("progress", onprogress, false);
					return xhr;
				}
			},
			success: function(res) {
				if(res.code != 0){
					layer.msg(res.message);
				}else{
					$('#stsListUpload-S3-next').fadeIn(250);
					layui.use('element', function(){
						var element = layui.element;
						element.progress('sts-list-library-upload-progress', '100%');
					});
				}
				layer.close(index)
			}
		});
		
		function onprogress(evt){
			var loaded = evt.loaded;         //已经上传大小情况
			var tot = evt.total;           //附件总大小
			var per = Math.floor(100*loaded/tot);   //已经上传的百分比
			console.log(per);
			layui.use('element', function(){
				var element = layui.element;
				element.progress('sts-list-library-upload-progress', per * 0.9 + '%');
			});
		}


		
	}
});

</script>

<script>
		
$('#stsListUpload').hide();

function showDivStsListFrame(step){
	
	$('#stsListUpload-S1').hide();
	$('#stsListUpload-S2').hide();
	$('#stsListUpload-S3').hide();
	
	$("#stsListUpload-S" + step).fadeIn(250);
}

$('#stsListUpload-S1-next').click(function(){
	
	showDivStsListFrame(2);
});

$('#stsListUpload-S2-pre').click(function(){
	$('#stsListUpload-S2-table').html('');
	showDivStsListFrame(1);
});


$('#newStsList').click(function(){
	layui.use('layer', function(){
		var layer = layui.layer;
		layer.open({
			type: 1,
			content: $('#stsListUpload'),
			title: 'New Student List',
			area: ['80%', '80%'],
			success: function(layero, index){
				$('#stsListUpload').show();
				showDivStsListFrame(1);
				$('#stsListUpload-S1-name').val('');
			},
			end: function(layero, index){
				$('#stsListUpload').hide();
			},
		});
	});
});

$('#stsListUpload-S3-next').click(function(){
	
	layui.use('layer', function(){
		layer.closeAll();
	});
	
	accessStsListLibrary();
	
});

</script>


<script>
	
	var stsListLibrary = '';
	
	$('#sts-list-library-num').html('<?php echo count($results) ?>');
	
	function clearSelectionOfStsListLibrary(){
		<?php
			for($t = 0; $t < count($results); $t ++){
		?>
		$('#sts-list-library-id-<?php echo $results[$t]['lid'] ?>').removeClass("sts-list-library-card-selected layui-btn-primary-on").addClass("sts-list-library-card layui-btn-primary");
		<?php
			}
		?>
	}
	
</script>
	
	<button class="layui-btn layui-btn-primary layui-btn-big sts-list-library-card layui-btn-primary" id="newStsList">
		<div class="" style="font-size: 30px;"><i class="fa fa-plus"></i></div>
	</button>
	
	
	<?php
	
	
	for($t = 0; $t < count($results); $t ++){
		
		$lid = $results[$t]['lid'];
		
		
		$sql = "SELECT COUNT(did) FROM ml_exam_scheduler_student_list_data WHERE lid = '$lid' ";
		$result2 = mysqli_query($GLOBALS['conn'], $sql);
		$results2 = array();
		while ($row = mysqli_fetch_assoc($result2)){
			$results2[] = $row;
		}
		//var_dump($results2);
		$stsNum = $results2[0]['COUNT(did)'];
		
		
		?>
		
		<button class="layui-btn layui-btn-primary layui-btn-big sts-list-library-card layui-btn-primary" id="sts-list-library-id-<?php echo $results[$t]['lid'] ?>">
			<script>
				$('#sts-list-library-id-<?php echo $results[$t]['lid'] ?>').click(function(){
					if($('#sts-list-library-id-<?php echo $results[$t]['lid'] ?>').attr("class").indexOf("sts-list-library-card layui-btn-primary") != -1){
						clearSelectionOfStsListLibrary();
						stsListLibrary = '<?php echo $results[$t]['lid'] ?>';
					}
					$('#sts-list-library-id-<?php echo $results[$t]['lid'] ?>').toggleClass("sts-list-library-card layui-btn-primary").toggleClass("sts-list-library-card-selected layui-btn-primary-on");
				});
			</script>
			<div class="sts-list-library-card-selected-icon"></div>
			<div class="sts-list-library-card-title" style="font-size: 24px; line-height: 18px;"><?php echo unlock($results[$t]['title']) ?><br><span class="layui-badge" style="font-size: 10px;">#<?php echo $results[$t]['identifier'] ?></span></div>
			<!--<hr>-->
			<div class="sts-list-library-card-content" style="line-height: 26px; margin-top: 0px;">
				<p><i class="fa fa-user-circle-o"></i> <?php echo $stsNum ?><br>
				<span class="sts-list-library-card-description"><i class="fa fa-clock-o"></i> <?php echo date('M d, Y',strtotime($results[$t]['time'])) ?></span></p>
			</div>
		</button>
		
	<?php
		
	}
	
	

	
	
	
}else if($func == 'submitNewStsListByAdmin'){
	
	if(checkAdminLogin() === false){
		echo '{"code": -1, "message": "Invalid request."}';
		die();
	}
	
	$an = checkAdminLogin();
	
	$title = $_REQUEST['title'];
	
	$data_ = $_REQUEST['data'];
	$data = JSON_decode($data_, true);
	
	
	
	$title = lock($title);
	$identifier = substr(md5($title), 0, 4);
	
	$sql = "INSERT INTO `ml_exam_scheduler_student_list_library`(`title`, `identifier`) VALUES ('$title','$identifier')";
	$result = mysqli_query($GLOBALS['conn'], $sql);
	$lid = mysqli_insert_id($GLOBALS['conn']);
	
	
	
	$sql = "INSERT INTO `ml_exam_scheduler_student_list_data`(`lid`, `student_number`, `first_name`, `last_name`, `course_id`, `course_title`, `teacher`) VALUES ";
	
	
	for($t = 0; $t < count($data); $t ++){
		
		$sn = lock($data[$t]['Student Number']);
		$fn = lock($data[$t]['First Name']);
		$ln = lock($data[$t]['Last Name']);
		$ci = lock($data[$t]['Course ID']);
		$ct = lock($data[$t]['Course Title']);
		$tch = lock($data[$t]['Teacher']);
		
		
		$sql .= "('$lid','$sn','$fn','$ln','$ci','$ct','$tch')";
		if($t != count($data) - 1){
			$sql .= ',';
		}else{
			$sql .= ';';
		}
		
		
	}
	
	$result = mysqli_query($GLOBALS['conn'], $sql);
	
	
	echo '{"code": 0}';
	
	
	
}else if($func == 'exitAdminLogin'){
	
	setcookie('an', '', 0);
	echo '{"code": 0, "message": "You successfully log out."}';
	
}else if($func == 'submitNewExamByAdmin'){
	
	$title = lock($_REQUEST['title']);
	$campus = $_REQUEST['campus'];
	$term = $_REQUEST['term'];
	$year = $_REQUEST['year'];
	$type = $_REQUEST['type'];
	$start_date = $_REQUEST['start_date'];
	$end_date = $_REQUEST['end_date'];
	$time = date('Y-m-d H:i:s', time());
	
	$identifier = substr(md5($title), 0, 4);
	
	$sql = "INSERT INTO `ml_exam_scheduler_saved_exam_list`(`title`, `campus`, `year`, `term`, `type`, `start_date`, `end_date`, `time`, `sts_list_lid`, `identifier`) VALUES ('$title','$campus','$year','$term','$type','$start_date','$end_date','$time','','$identifier')";
	$result = mysqli_query($GLOBALS['conn'], $sql);
	
	$eid = mysqli_insert_id($GLOBALS['conn']);
	
	echo '{"code": 0, "message": "created", "eid": "' . $eid . '"}';
	
	
}else if($func == 'getSavedExamListByAdmin'){
	
	$sql = "SELECT * FROM ml_exam_scheduler_saved_exam_list ORDER BY `eid` DESC ";
	$result = mysqli_query($GLOBALS['conn'], $sql);
	$results = array();
	while ($row = mysqli_fetch_assoc($result)){
		$results[] = $row;
	}
	
	
	if(empty($results)){
		echo 'Empty';
	}
	
	?>
	<script>
	
	var savedExamEid = '';
	
	function clearSelectionOfSavedExam(){
	<?php
	for($t = 0; $t < count($results); $t ++){
	?>
		$('#saved-exam-id-<?php echo $results[$t]['eid'] ?>').removeClass("sts-list-library-card-selected layui-btn-primary-on").addClass("sts-list-library-card layui-btn-primary");
	<?php
	}
	?>
	}
	</script>
	<?php
	
	
	for($t = 0; $t < count($results); $t ++){
		
		
		if($results[$t]['sts_list_lid'] != 0){
			$lid = $results[$t]['sts_list_lid'];
			$sql = "SELECT COUNT(did) FROM `ml_exam_scheduler_student_list_data` WHERE lid = '$lid' ";
			$result2 = mysqli_query($GLOBALS['conn'], $sql);
			$results2 = array();
			while ($row = mysqli_fetch_assoc($result2)){
				$results2[] = $row;
			}
			$stsNum = $results2[0]['COUNT(lid)'];
		}else{
			$stsNum = 'Empty';
		}
		
		?>
		
		<button class="layui-btn layui-btn-primary layui-btn-big sts-list-library-card layui-btn-primary" id="saved-exam-id-<?php echo $results[$t]['eid'] ?>">
			<script>
				$('#saved-exam-id-<?php echo $results[$t]['eid'] ?>').click(function(){
					if($('#saved-exam-id-<?php echo $results[$t]['eid'] ?>').attr("class").indexOf("sts-list-library-card layui-btn-primary") != -1){
						clearSelectionOfSavedExam();
						$('#saved_exam_next').removeAttr('disabled');
					}else{
						$('#saved_exam_next').attr('disabled', 'disabled');
					}
					$('#saved-exam-id-<?php echo $results[$t]['eid'] ?>').toggleClass("sts-list-library-card layui-btn-primary").toggleClass("sts-list-library-card-selected layui-btn-primary-on");
					savedExamEid = '<?php echo $results[$t]['eid'] ?>';
				});
			</script>
			<div class="sts-list-library-card-selected-icon"></div>
			<div class="sts-list-library-card-title" style="font-size: 24px; line-height: 18px;"><?php echo unlock($results[$t]['title']) ?><br><span class="layui-badge" style="font-size: 10px;">#<?php echo $results[$t]['identifier'] ?></span></div>
			
			<div class="sts-list-library-card-content" style="line-height: 26px; margin-top: 0px;">
				<p><i class="fa fa-user-circle-o"></i> <?php echo $stsNum ?><br>
				<span class="sts-list-library-card-description"><i class="fa fa-clock-o"></i> <?php echo date('M d, Y',strtotime($results[$t]['time'])) ?></span></p>
			</div>
		</button>
		
	<?php
		
	}
	
	
	
}else if($func == 'getOneSavedExamByAdmin'){
	
	$eid = $_REQUEST['eid'];
	
	$sql = "SELECT * FROM ml_exam_scheduler_saved_exam_list  WHERE `eid` = '$eid' ";
	$result = mysqli_query($GLOBALS['conn'], $sql);
	$results = array();
	while ($row = mysqli_fetch_assoc($result)){
		$results[] = $row;
	}
	
	if($results[0]['sts_list_lid'] != 0){
		
		//sts list title
		$lid = $results[0]['sts_list_lid'];
		$sql = "SELECT * FROM ml_exam_scheduler_student_list_library  WHERE `lid` = '$lid' ";
		$result2 = mysqli_query($GLOBALS['conn'], $sql);
		$results2 = array();
		while ($row = mysqli_fetch_assoc($result2)){
			$results2[] = $row;
		}
		
		//sts list number
		$sql = "SELECT COUNT(did) FROM ml_exam_scheduler_student_list_data WHERE lid = '$lid' ";
		$result3 = mysqli_query($GLOBALS['conn'], $sql);
		$results3 = array();
		while ($row = mysqli_fetch_assoc($result3)){
			$results3[] = $row;
		}
		
		
	}
	
	
	?>
	
<div class="insider-title" style="line-height: 24px;">
	<?php echo unlock($results[0]['title']) ?><br>
	<span class="layui-badge">#<?php echo $results[0]['identifier'] ?></span>
</div>


<div class="insider-content-left insider-content" style="max-width: 60%; margin: 0 auto; text-align: center; padding-top: 10px;">
	<div class="layui-row">
			<div class="layui-col-md7" style="padding: 5px;">
				<blockquote class="layui-elem-quote" style="padding: 20px;">
					<div style="color: #00b0f0; font-size: 26px; padding: 5px;">Basic Information</div>
					<div class="myexams-card-content" style="line-height: 24px; color: #333; padding: 10px;">
						<table class="layui-table" lay-skin="row">
						  <tbody>
							<tr>
							  <td>Campus</td>
							  <td><?php echo $results[0]['campus'] ?></td>
							</tr>
							<tr>
							  <td>Year & Term</td>
							  <td><?php echo $results[0]['year'] ?> <?php echo $results[0]['term'] ?></td>
							</tr>
							<tr>
							  <td>Type</td>
							  <td><?php echo $results[0]['type'] ?></td>
							</tr>
							<tr>
							  <td>Dates</td>
							  <td><?php echo date('Y/m/d', strtotime($results[0]['start_date'])) ?> ~ <?php echo date('Y/m/d', strtotime($results[0]['end_date'])) ?></td>
							</tr>
						  </tbody>
						</table>
					</div>
				</blockquote>
			</div>
			<div class="layui-col-md5" style="padding: 5px;">
				<blockquote class="layui-elem-quote" style="padding: 20px;">
					<div style="color: #00b0f0; font-size: 26px; padding: 5px;">Student List</div>
						<div class="myexams-card-content" style="line-height: 24px; color: #333; padding: 10px;">
						<?php
						if($results[0]['sts_list_lid'] != 0){
						?>
						<button class="layui-btn layui-btn-primary layui-btn-big sts-list-library-card layui-btn-primary">
							<div class="sts-list-library-card-selected-icon"></div>
							<div class="sts-list-library-card-title" style="font-size: 24px; line-height: 18px;"><?php echo unlock($results2[0]['title']) ?><br><span class="layui-badge" style="font-size: 10px;">#<?php echo $results2[0]['identifier'] ?></span></div>
							<!--<hr>-->
							<div class="sts-list-library-card-content" style="line-height: 26px; margin-top: 0px;">
								<p><i class="fa fa-user-circle-o"></i> <?php echo $results3[0]['COUNT(did)'] ?><br>
								<span class="sts-list-library-card-description"><i class="fa fa-clock-o"></i><?php echo date('M d, Y', strtotime($results2[0]['time'])) ?></span></p>
							</div>
						</button>
						<?
						}else{
						?>
						<button class="layui-btn layui-btn-primary layui-btn-big sts-list-library-card layui-btn-primary" id="savedExam_newStsList">
							<div class="" style="font-size: 30px;"><i class="fa fa-plus"></i></div>
						</button>
						<?php
						}
						?>
					</div>
				</blockquote>
			</div>
		</div>
	</div>
	
	<?php
	
}

?>
<?php


function getYear(){
	
	return date('Y');
	
}

function getSemester(){
	
	if(date('m') <= 7 || date('m') >= 1){
		$s = 'Spring';
	}else if(date('m') >= 8 && date('m') <= 12){
		$s = 'Fall';
	}
	return $s;
	
}

function getExamName(){
	
	$s = '';
	if(date('m') >= 9 && date('m') <= 11){
		$s = 'Mid-term';
	}else if(date('m') >= 12 || date('m') <= 2){
		$s = 'Final';
	}else if(date('m') >= 3 && date('m') <= 5){
		$s = 'Mid-term';
	}else if(date('m') >= 6 && date('m') <= 8){
		$s = 'Final';
	}
	return $s;
	
}

function getSelectExams(){
	
	$sql = 'select * from ml_wh_examination_roomassignment';
	$result = mysqli_query($GLOBALS['conn'], $sql);
	
	$results = array();
	
	while ($row = mysqli_fetch_assoc($result)){
		$results[] = $row;
	}
	
	
	$ysn = array();
	for($t = 0; $t < count($results); $t++){
		$ysn[$t] = $results[$t]['year'] . ' ' . $results[$t]['semester'] . ' ' . $results[$t]['exam_name'];
	}
	$ysn = array_unique($ysn);
	$ysn = array_values($ysn);
	sort($ysn);
	
	
	
	
?>
	

<script>

//注意：parent 是 JS 自带的全局对象，可用于操作父页面
var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
</script>

<div style="text-align: center; margin: 10px;">
<?php

	for($t = 0; $t < count($ysn); $t++){

?>

<!--<p class="layui-btn layui-btn-danger" style="margin: 10px;" onclick="javascript: setYSN(<?php echo YSNSplitApart($ysn[$t]) ?>)"><?php echo $ysn[$t] ?></p>-->

<p class="layui-btn layui-btn-danger" style="margin: 10px;" onclick="javascript: parent.layer.close(index);"><?php echo $ysn[$t] ?></p>



<?php

	}

?>
</div>


	
<?php
	
}

function YSNSplitApart($t){
	
	$str = explode(" ",$t);
	
	return $str[0] . ',' . $str[1] . ',' . $str[2];
	
}


function checkAdminLogin(){

$token = '';
@$token = $_COOKIE['an'];

if(empty($token)){
	return false;
}

$sql = "SELECT * FROM ml_exam_scheduler_admin WHERE token = '$token'";
$result = mysqli_query($GLOBALS['conn'], $sql);

$results = array();
	
while ($row = mysqli_fetch_assoc($result)){
	$results[] = $row;
}

$an = '';
@$an = $results[0]['username'];

if(empty($an)){
	return false;
}else{
	return $an;
}
	
}


//For AliCloud® OSS Service

function gmt_iso8601($time) {
	
	$dtStr = date("c", $time);
	$mydatetime = new DateTime($dtStr);
	$expiration = $mydatetime->format(DateTime::ISO8601);
	$pos = strpos($expiration, '+');
	$expiration = substr($expiration, 0, $pos);
	return $expiration."Z";
	
}

//For AliCloud® OSS Service

function trimQuotationMark($str){
	
	$str2 = $str;
	$str2 = str_replace('"', "", $str2);
	$str2 = str_replace('"', "", $str2);
	
	return $str2;
	
}


function checkProvincialExam($str){
	
	if(strpos(strtoupper($str),"PROVINC") !== false || strpos(strtoupper($str),"E-EXAM") !== false){
		return true;
	}
	
	return false;
	
	
}

//Encrypt
function lock($txt,$key='CLOUDYYOUNG'){
	$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-=+";
	$nh = rand(0,64);
	$ch = $chars[$nh];
	$mdKey = md5($key.$ch);
	$mdKey = substr($mdKey,$nh%8, $nh%8+7);
	$txt = base64_encode($txt);
	$tmp = '';
	$i=0;$j=0;$k = 0;
	for ($i=0; $i<strlen($txt); $i++) {
	$k = $k == strlen($mdKey) ? 0 : $k;
	$j = ($nh+strpos($chars,$txt[$i])+ord($mdKey[$k++]))%64;
	$tmp .= $chars[$j];
	}
	return urlencode($ch.$tmp);
}

//Decrypt
function unlock($txt,$key='CLOUDYYOUNG'){
	$txt = urldecode($txt);
	$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-=+";
	$ch = $txt[0];
	$nh = strpos($chars,$ch);
	$mdKey = md5($key.$ch);
	$mdKey = substr($mdKey,$nh%8, $nh%8+7);
	$txt = substr($txt,1);
	$tmp = '';
	$i=0;$j=0; $k = 0;
	for ($i=0; $i<strlen($txt); $i++) {
	$k = $k == strlen($mdKey) ? 0 : $k;
	$j = strpos($chars,$txt[$i])-$nh - ord($mdKey[$k++]);
	while ($j<0) $j+=64;
	$tmp .= $chars[$j];
	}
	return base64_decode($tmp);
}




?>