
var coursesAll;
var teacheramount = new Array(0,0,0,0,0,0,0);
var teacherAll;
var blockamount = new Array(0,0,0,0,0,0,0);
var blockAll;
var id;
var courseid = 1;
var cid = new Array(0,0,0,0,0,0,0);
var child = 0;
var courseamount = 0;
var cover;
var coverIndex;

var year;
var semester;
var exam_name;


function setYSN(y, s, n){
	
	year = y;
	semester = s;
	exam_name = n;
	
}


function setAllCourse2Detail(){
	
	
	for(t = 0; t < coursesAll.length; t++){
		
		document.getElementById("course-detail-" + (t+1) + "-title1").innerHTML = coursesAll[t].innerHTML.toUpperCase();
		document.getElementById("course-detail-" + (t+1) + "-title2").innerHTML = coursesAll[t].innerHTML.toUpperCase();
		
	}
	
	NextStep();
	
	
}

function getAllCourses(){
	
	var object = {func: 'getAllCourses'};
	
	getPageContent("request.php", object, function(res){
		
		//console.log("a" + res);
		
		document.getElementById("courseList").innerHTML = res;
		
		courseamount = 0;
		document.getElementById("courseamount").innerHTML = "";
		
	});
	
}

function NextStep(){
	
	if(courseid == courseamount && child == 2){
		showDiv("course-time-loading");
		submitAll();
		return;
	}
	
	//====
	
	if(child + 1 > 2){
		
		courseid ++;
		child = 1;
		
	}else{
		
		child ++;
		
	}
	
	//console.log(courseid + "," + child);
	
	StepShowDiv(0);
	
}

function PreviousStep(){
	
	if(courseid == 1 && child == 1){
		child = 0;
		showDiv("course-select");
		return;
	}
	
	//====
	
	if(child - 1 < 1){
		
		courseid --;
		child = 2;
		
	}else{
		
		child --;
		
	}
	
	
	//console.log(courseid + "," + child);
	
	StepShowDiv(1);
	
}

function StepShowDiv(direct){
	
	
	coverIndex = layer.load(1, {shade: 0.00001});
	
	lockButton();
	document.getElementById("course-detail-" + courseid + "-next1").innerHTML = '<i class="fa fa-cog fa-spin fa-lg"></i>';
	document.getElementById("course-detail-" + courseid + "-next2").innerHTML = '<i class="fa fa-cog fa-spin fa-lg"></i>';
	if(courseid > 1){
		document.getElementById("course-detail-" + (courseid-1) + "-next1").innerHTML = '<i class="fa fa-cog fa-spin fa-lg"></i>';
		document.getElementById("course-detail-" + (courseid-1) + "-next2").innerHTML = '<i class="fa fa-cog fa-spin fa-lg"></i>';
	}
	
	if(child == 1 && direct == 0){
		
		getPageContent("request.php", {func: 'checkTeacher', course: coursesAll[courseid - 1].name, id: courseid}, function(res){
			
			
			teacheramount[courseid - 1] = 0;
			document.getElementById("course-detail-" + courseid + "-teacher-amount").innerHTML = "";
			
			document.getElementById("course-detail-" + courseid + "-teacher-select").innerHTML = res;
			
			if(res.indexOf("ROSTER") != -1){
				teacherPress("course-detail-" + courseid + "-teacher-0");
				NextStep();
				return;
			}
			
			showDiv('course-detail-' + courseid + '-teacher');
			
			document.getElementById("course-detail-" + courseid + "-next1").innerHTML = '<i class="fa fa-chevron-right fa-lg"></i>';
			document.getElementById("course-detail-" + courseid + "-next2").innerHTML = '<i class="fa fa-chevron-right fa-lg"></i>';
			if(courseid != 1){
				document.getElementById("course-detail-" + (courseid-1) + "-next1").innerHTML = '<i class="fa fa-chevron-right fa-lg"></i>';
				document.getElementById("course-detail-" + (courseid-1) + "-next2").innerHTML = '<i class="fa fa-chevron-right fa-lg"></i>';
			}
			document.getElementById("course-next").innerHTML = '<i class="fa fa-chevron-right fa-lg"></i>';
			
			layer.close(coverIndex);
			
		});
		
	}else if(child == 2 && direct == 0){
		
		getPageContent("request.php", {func: 'checkBlock', course: coursesAll[courseid - 1].name, id: courseid , teacher: teacherAll[courseid - 1].name}, function(res){
			
			blockamount[courseid - 1] = 0;
			document.getElementById("course-detail-" + courseid + "-block-amount").innerHTML = "";
			
			
			document.getElementById("course-detail-" + courseid + "-block-select").innerHTML = res;
			
			if(res.indexOf("ROSTER") != -1){
				blockPress("course-detail-" + courseid + "-block-0");
				NextStep();
				return;
			}
			
			showDiv('course-detail-' + courseid + '-block');
			
			document.getElementById("course-detail-" + courseid + "-next1").innerHTML = '<i class="fa fa-chevron-right fa-lg"></i>';
			document.getElementById("course-detail-" + courseid + "-next2").innerHTML = '<i class="fa fa-chevron-right fa-lg"></i>';
			if(courseid != 1){
				document.getElementById("course-detail-" + (courseid-1) + "-next1").innerHTML = '<i class="fa fa-chevron-right fa-lg"></i>';
				document.getElementById("course-detail-" + (courseid-1) + "-next2").innerHTML = '<i class="fa fa-chevron-right fa-lg"></i>';
			}
			document.getElementById("course-next").innerHTML = '<i class="fa fa-chevron-right fa-lg"></i>';
			
			layer.close(coverIndex);
			
		});
		
	}else if(child == 1 && direct == 1){
		
		if(teacherAll[courseid - 1].name.indexOf("ROSTER") != -1){
			//console.log(teacherAll[courseid - 1].name);
			PreviousStep();
			return;
		}
		
		showDiv('course-detail-' + courseid + '-teacher');
		
		document.getElementById("course-detail-" + courseid + "-next1").innerHTML = '<i class="fa fa-chevron-right fa-lg"></i>';
		document.getElementById("course-detail-" + courseid + "-next2").innerHTML = '<i class="fa fa-chevron-right fa-lg"></i>';
		if(courseid != 1){
			document.getElementById("course-detail-" + (courseid-1) + "-next1").innerHTML = '<i class="fa fa-chevron-right fa-lg"></i>';
			document.getElementById("course-detail-" + (courseid-1) + "-next2").innerHTML = '<i class="fa fa-chevron-right fa-lg"></i>';
		}
		document.getElementById("course-next").innerHTML = '<i class="fa fa-chevron-right fa-lg"></i>';
		
		layer.close(coverIndex);
		
		
	}else if(child == 2 && direct == 1){
		
		if(blockAll[courseid - 1].name.indexOf("ROSTER") != -1){
			//console.log(blockAll[courseid - 1]);
			PreviousStep();
			return;
		}
		
		showDiv('course-detail-' + courseid + '-block');
		
		document.getElementById("course-detail-" + courseid + "-next1").innerHTML = '<i class="fa fa-chevron-right fa-lg"></i>';
		document.getElementById("course-detail-" + courseid + "-next2").innerHTML = '<i class="fa fa-chevron-right fa-lg"></i>';
		if(courseid != 1){
			document.getElementById("course-detail-" + (courseid-1) + "-next1").innerHTML = '<i class="fa fa-chevron-right fa-lg"></i>';
			document.getElementById("course-detail-" + (courseid-1) + "-next2").innerHTML = '<i class="fa fa-chevron-right fa-lg"></i>';
		}
		document.getElementById("course-next").innerHTML = '<i class="fa fa-chevron-right fa-lg"></i>';

		layer.close(coverIndex);
		
	}

	
}


function lockButton(){
	
	if(courseid != 1 && child != 0){
		
		//console.log("course-detail-" + (courseid - 1) + "-next1");
		
		document.getElementById("course-detail-" + (courseid - 1) + "-next1").disabled = "disabled";
		document.getElementById("course-detail-" + (courseid - 1) + "-next2").disabled = "disabled";
		
	}else{
		
		document.getElementById("course-next").disabled = "disabled";
		
	}
	
	document.getElementById("course-detail-" + (courseid) + "-next1").disabled = "disabled";
	document.getElementById("course-detail-" + (courseid) + "-next2").disabled = "disabled";
	
	
	
}

function unlockButton(){
	
	
	if(courseid != 1 && child != 0){
		
		//console.log("course-detail-" + (courseid - 1) + "-next1");
		
		document.getElementById("course-detail-" + (courseid - 1) + "-next1").disabled = "";
		document.getElementById("course-detail-" + (courseid - 1) + "-next2").disabled = "";
		
	}else{
		
		document.getElementById("course-next").disabled = "";
		
	}
	
	document.getElementById("course-detail-" + (courseid) + "-next1").disabled = "";
	document.getElementById("course-detail-" + (courseid) + "-next2").disabled = "";
	
	
}


function coursePress(id){
	
	color = document.getElementById(id).className;
	
	if(color == "layui-btn layui-btn-primary layui-btn-radius layui-btn-big sign-course"){
		
		if(courseamount + 1 > 7){
			layer.msg('Maximum 7 courses');
			return;
		}
		
		document.getElementById(id).setAttribute("class", "layui-btn layui-btn-primary-on layui-btn-radius layui-btn-big sign-course");
		courseamount++;
		
	}else{
		
		document.getElementById(id).setAttribute("class", "layui-btn layui-btn-primary layui-btn-radius layui-btn-big sign-course");
		courseamount--;
		
	}
	
	coursesAll = document.getElementsByClassName("layui-btn layui-btn-primary-on layui-btn-radius layui-btn-big sign-course");
	
	if(courseamount == 1){
		
		document.getElementById("courseamount").innerHTML = "<i class='fa fa-hand-paper-o'></i> <b>" + courseamount + "</b> course is selected";
		document.getElementById("course-next").disabled = "";
		
	}else if(courseamount == 0){
		
		document.getElementById("courseamount").innerHTML = "";
		document.getElementById("course-next").disabled = "disabled";
		
	}else{
	
		document.getElementById("courseamount").innerHTML = "<i class='fa fa-hand-paper-o'></i> <b>" + courseamount + "</b> courses are selected";
		document.getElementById("course-next").disabled = "";
	
	}
}

function blockPress(id){
	
	color = document.getElementById(id).className;
	
	if(color == "layui-btn layui-btn-primary layui-btn-radius layui-btn-big sign-block"){
		
		if(blockamount[courseid - 1] + 1 > 1){
			layer.msg('Maximum 1 Block');
			return;
		}
		
		document.getElementById(id).setAttribute("class", "layui-btn layui-btn-primary-on layui-btn-radius layui-btn-big sign-block");
		blockamount[courseid - 1]++;
		
	}else{
		document.getElementById(id).setAttribute("class", "layui-btn layui-btn-primary layui-btn-radius layui-btn-big sign-block");
		blockamount[courseid - 1]--;
	}
	
	blockAll = document.getElementsByClassName("layui-btn layui-btn-primary-on layui-btn-radius layui-btn-big sign-block");
	
	if(blockamount[courseid - 1] > 0){
		document.getElementById("course-detail-" + courseid + "-block-amount").innerHTML = "<i class='fa fa-hand-paper-o'></i> <b>Block " + document.getElementById(id).name + "</b> is selected";
		document.getElementById("course-detail-" + courseid + "-next2").disabled = '';
	}else{
		document.getElementById("course-detail-" + courseid + "-block-amount").innerHTML = "";
		document.getElementById("course-detail-" + courseid + "-next2").disabled = 'disabled';
	}
	
	//console.log(blockamount[courseid - 1]);
	
	
}

function teacherPress(id){
	
	color = document.getElementById(id).className;
	
	if(color == "layui-btn layui-btn-primary layui-btn-radius layui-btn-big sign-teacher"){
		
		if(teacheramount[courseid - 1] + 1 > 1){
			layer.msg('Maximum 1 Teacher');
			return;
		}
		
		document.getElementById(id).setAttribute("class", "layui-btn layui-btn-primary-on layui-btn-radius layui-btn-big sign-teacher");
		teacheramount[courseid - 1]++;
		
	}else{
		document.getElementById(id).setAttribute("class", "layui-btn layui-btn-primary layui-btn-radius layui-btn-big sign-teacher");
		teacheramount[courseid - 1]--;
	}
	
	teacherAll = document.getElementsByClassName("layui-btn layui-btn-primary-on layui-btn-radius layui-btn-big sign-teacher");
	
	if(teacheramount[courseid - 1] > 0){
		document.getElementById("course-detail-" + courseid + "-teacher-amount").innerHTML = "<i class='fa fa-hand-paper-o'></i> <b>" + document.getElementById(id).name + "</b> is selected";
		document.getElementById("course-detail-" + courseid + "-next1").disabled = '';
	}else{
		document.getElementById("course-detail-" + courseid + "-teacher-amount").innerHTML = "";
		document.getElementById("course-detail-" + courseid + "-next1").disabled = 'disabled';
	}
	
	//console.log(teacheramount[courseid - 1]);
	
}

function submitAll(){
	
	//==重置courseid和child，下次使用
	courseid = 1;
	child = 0;
	
	var object = {func: 'submit2', course1: '', course2: '', course3: '', course4: '', course5: '', course6: '', course7: '', teacher1: '', teacher2: '', teacher3: '', teacher4: '', teacher5: '', teacher6: '', teacher7: '', block1: '', block2: '', block3: '', block4: '', block5: '', block6: '', block7: ''};
	
	if(coursesAll.length >= 1){
		object.course1 = coursesAll[0].name;
		object.teacher1 = teacherAll[0].name;
		object.block1 = blockAll[0].name;
	}
	if(coursesAll.length >= 2){
		object.course2 = coursesAll[1].name;
		object.teacher2 = teacherAll[1].name;
		object.block2 = blockAll[1].name;
	}
	if(coursesAll.length >= 3){
		object.course3 = coursesAll[2].name;
		object.teacher3 = teacherAll[2].name;
		object.block3 = blockAll[2].name;
	}
	if(coursesAll.length >= 4){
		object.course4 = coursesAll[3].name;
		object.teacher4 = teacherAll[3].name;
		object.block4 = blockAll[3].name;
	}
	if(coursesAll.length >= 5){
		object.course5 = coursesAll[4].name;
		object.teacher5 = teacherAll[4].name;
		object.block5 = blockAll[4].name;
	}
	if(coursesAll.length >= 6){
		object.course6 = coursesAll[5].name;
		object.teacher6 = teacherAll[5].name;
		object.block6 = blockAll[5].name;
	}
	if(coursesAll.length >= 7){
		object.course7 = coursesAll[6].name;
		object.teacher7 = teacherAll[6].name;
		object.block7 = blockAll[6].name;
	}
	
	//console.log(object);
	
	layer.closeAll();
	
	getPageContent("request.php", object, function(res){
		
		//console.log(res);
		
		document.getElementById("course-timeline-content").innerHTML = res;
		
		showDiv("course-timeline");
		
	});
	
	
}


function submitUserAll(studentNumber){
	
	showDiv('course-time-loading');
	layer.closeAll();
	
	getPageContent("request.php", {func: "submit2", method: "user", studentNumber: studentNumber}, function(res){
		
		
		//console.log(res);
		
		document.getElementById("course-timeline-content").innerHTML = res;
		
		showDiv("course-timeline");
		
	});
	
}



//JS版POST数据
function post(url,data,response) {
    var req = new XMLHttpRequest();
    var fd = new FormData();
    //回调
    req.onreadystatechange = function () {
    	//console.log(req.status);
        if (req.readyState == 4) {
        	if(req.status == 200){
				//alert(req.responseText);
				response(JSON.parse(req.responseText));
			}else{
				throw new Error(req.responseText);
			}
        }
    };
	
  	//构建表单
	for(var key in data){
		fd.append(key, data[key])
	}
    
	req.open("post", url, true);

	req.send(fd);
}


//直接拉取页面数据：没有JSON.parse()
function getPageContent(url,data,response) {
    var req = new XMLHttpRequest();
    var fd = new FormData();
    req.onreadystatechange = function () {
    	//console.log(req.status);
        if (req.readyState == 4) {
        	if(req.status == 200){
				response(req.responseText);
			}else{
				throw new Error(req.responseText);
			}
        }
    };
	
	//构建表单
	for(var key in data){
		fd.append(key, data[key])
	}

	req.open("post", url, true);
	req.send(fd);
}


