/**
	@project My Exams Scheduler
	@name Scheduler Support Class
	@author Meonc Studio: Cloudy Young, Valentina Awesome, Jimschenchen
**/


/**
	use strict
**/
"use strict";


/**
	@note prototype function parseCondition() for conditions generally, SQL
**/
String.prototype.parseCondition = function(obj = 'each'){
	return this.replace(/(\s*)(\(*)(\s*)/g, "$2").replace(/(\s*)(\)*)(\s*)/g, "$2").replace(/\`(\s*)(\=*)(\s*)[\'\"](.*?)[\'\"]/g, "` == '$4'").replace(/\`(\s*)\!(\=*)(\s*)[\'\"](.*?)[\'\"]/g, "` != '$4'").replace(/\'(\s*)(\)*)(\s*)AND(\s*)(\(*)(\s*)\`/g, "'$2 && $5`").replace(/\'(\s*)(\)*)(\s*)OR(\s*)(\(*)(\s*)\`/g, "'$2 || $5`").replace(/(\`)(\s*)([^\s]*)(\s*)(\`)/g, "$1$3$5").replace(/\`(.*?)\`/g, obj + ".$1()");
}




var examination = {
	
	examList: new Array(0),

	add: function(e){
		if(arguments.length == 0){
			examList.push(new Examination(examList.length + 1));
		}else if(arguments.length == 1 && e instanceof Examination){
			examList.push(e);
		}else if(arguments.length == 1 && typeof(e) == 'string'){
			var newExam = new Examination(examList.length + 1);
			newExam.title(e);
			examList.push(newExam);
		}else{
			return;
		}
		return examList[examList.length - 1];
	},

	find: function(condition){
		var ret = examList.filter(function (each){
			return eval(condition.parseCondition());
		});
		return ret;
	},

	remove: function(arr){
		var ret = new Array(0);
		for(var each in arr){
			for(var exm in examList){
				if(arr[each] == examList[exm]){
					ret.push(examList[exm]);
					examList[exm] = undefined;
				}
			}
		}
		return ret;
	},

	/**
		@name checkList
		@param Array
		@return 2D Array
		@note check list informations
	**/
	checkList: function(list){
		var ret = {"qual_lines": [], "unqual_lines": [], "qual_lines_num": 0, "unqual_lines_num": 0};
		for(var t = 0; t < list.length; t ++){
			var s_sn = list[t].hasOwnProperty('STS_Student Number');
			var s_fn = list[t].hasOwnProperty('STS_First Name');
			var s_ln = list[t].hasOwnProperty('STS_Last Name');
			var t_fn = list[t].hasOwnProperty('TCH_First Name');
			var t_ln = list[t].hasOwnProperty('TCH_Last Name');
			var ct = list[t].hasOwnProperty('COZ_Title');
			var b = list[t].hasOwnProperty('COZ_Block');

			if(s_sn && s_fn && s_ln && t_fn && t_ln && ct && b){
				ret.qual_lines.push(t);
			}else{
				ret.unqual_lines.push(t);
			}
		}
		ret.qual_lines_num = ret.qual_lines.length;
		ret.unqual_lines_num = ret.unqual_lines.length;
		return ret;
	},

	
}

var student = {

	/**
		@name validityStudentNumber
		@param Student number
		@return boolean
		@note check if a string is a valid student number
	**/
	validityStudentNumber: function(stsNo){
		return isNaN(parseInt(stsNo,10)) == false && stsNo.length >= 8 && stsNo.length <= 10;
	},

}


function Examination(e){
	
	var eid = e;
	var campus = '';
	var title = '';
	var type = '';
	var year = '';
	var term = '';
	var startDate = '';
	var endDate = '';

	var studentList = new Array(0);
	var courseList = new Array(0);
	var teacherList = new Array(0);
	


	/**
		BASIC GETTER & SETTER OF EXAMINATION
	**/
	
	this.eid = function(){
		return eid;
	}
	
	this.campus = function(c = campus){
		campus = c;
		return campus;
	}
	
	this.title = function(t = title){
		title = t;
		return title;
	}
	
	this.type = function(t = type){
		type = t;
		return type;
	}
	
	this.year = function(y = year){
		year = y;
		return year;
	}
	
	this.term = function(t = term){
		term = t;
		return term;
	}
	
	this.startDate = function(s = startDate){
		startDate = s;
		return startDate;
	}
	
	this.endDate = function(e = endDate){
		endDate = e;
		return endDate;
	}


	/**
		STUDENT ATTRIBUTES & METHODS
	**/

	this.student = function(){
		return studentList;
	}



	/**
		@name add
		@param None/Student object/Student number
		@return Student object
		@note  add a student to studentList
	**/
	this.student.add = function(sts){
		if(arguments.length == 0){
			studentList.push(new Student(studentList.length + 1));
		}else if(arguments.length == 1 && sts instanceof Student){
			studentList.push(sts);
		}else if(arguments.length == 1 && student.validityStudentNumber(sts) == true){
			var newSts = new Student(studentList.length + 1);
			newSts.studentNumber(sts);
			studentList.push(newSts);
		}else{
			return;
		}
		return studentList[studentList.length - 1];
	}

	/**
		@name find
		@param String SQL condition
		@return Array
		@note find students match the condition
	**/
	this.student.find = function(condition){
		var ret = studentList.filter(function (each){
			return eval(condition.parseCondition());
		});
		return ret;
	}

	

	/**
		@name exportList
		@param None
		@return Array
		@note parse data into 2D array
	**/
	this.student.exportList = function(){
		var ret = new Array(0);
		studentList.forEach(function(sts){
			if(sts != null) ret.push(sts.exportStudent());
		});
		return ret;
	}

	/**
		@name importList
		@param Array
		@return None
		@note parse 2D Array into data
	**/
	this.student.importList = function(arr){
		studentList = new Array();
		for(var each in arr){
			studentList[arr[each].sid - 1] = new Student(arr[each].sid);
			studentList[arr[each].sid - 1].importStudent(arr[each]);
		}
	}

	/**
		@name remove
		@param Array
		@return Array
		@note remove matched array in StudentList
	**/
	this.student.remove = function(arr){
		var ret = new Array(0);
		for(var each in arr){
			for(var sts in studentList){
				if(arr[each] == studentList[sts]){
					ret.push(studentList[sts]);
					studentList[sts] = undefined;
				}
			}
		}
		return ret;
	}

	/**
		@name parseList
		@param Array
		@return Array
		@note parse json string to studentList object
	**/
	this.student.parseList = function(list){
		var arr = new Array(0);
		for(var t = 0; t < list.length; t ++){
			var sid = t + 1;
			var sn = (list[t].hasOwnProperty('STS_Student Number')) ? list[t]['STS_Student Number'].trim() : '';
			var fn = (list[t].hasOwnProperty('STS_First Name')) ? list[t]['STS_First Name'].trim() : '';
			var mn = (list[t].hasOwnProperty('STS_Middle Name')) ? list[t]['STS_Middle Name'].trim() : '';
			var ln = (list[t].hasOwnProperty('STS_Last Name')) ? list[t]['STS_Last Name'].trim() : '';
			arr.push({"sid": sid, "studentNumber": sn, "firstName": fn, "middleName": mn, "lastName": ln});
		}
		return arr;
	}

	


	/**
		COURSE ATTRIBUTES & METHODS
	**/

	this.course = function(){
		return courseList;
	}

	/**
		@name add
		@param Course object
		@return Course
		@note add course
	**/
	this.course.add = function(coz){
		if(arguments.length == 0){
			courseList.push(new Course());
		}else if(arguments.length == 1 && coz instanceof Course){
			courseList.push(coz);
		}else if(arguments.length == 1 && typeof(coz) == 'string'){
			var newCoz = new Course();
			newCoz.title(coz);
			courseList.push(newCoz);
		}else{
			return;
		}
		return courseList[courseList.length - 1];
	}
	
	/**
		@name find
		@param String SQL condition
		@return Array
		@note find course match the condition
	**/
	this.course.find = function(condition){
		var ret = courseList.filter(function (each){
			return eval(condition.parseCondition());
		});
		return ret;
	}
	
	/**
		@name remove
		@param Array
		@return Array
		@note remove matched array in CourseList
	**/
	this.course.remove = function(arr){
		var ret = new Array(0);
		for(var each in arr){
			for(var coz in courseList){
				if(arr[each] == courseList[coz]){
					ret.push(courseList[coz]);
					courseList[coz] = undefined;
				}
			}
		}
		return ret;
	}

	/**
		@name parseList
		@param Array
		@return Array
		@note parse json string to courseList object
	**/
	this.course.parseList = function(list){
		var arr = new Array(0);
		for(var t = 0; t < list.length; t ++){
			var cid = t + 1;
			var ti = (list[t].hasOwnProperty('COZ_Title')) ? list[t]['COZ_Title'].trim() : '';
			var b = (list[t].hasOwnProperty('COZ_Block')) ? list[t]['COZ_Block'].trim() : '';
			arr.push({"cid": cid, "title": ti, "block": b});
		}
		return arr;
	}

	/**
		@name exportList
		@param None
		@return Array
		@note parse data into 2D array
	**/
	this.course.exportList = function(){
		var ret = new Array(0);
		courseList.forEach(function(coz){
			if(coz != null) ret.push(coz.exportCourse());
		});
		return ret;
	}
	
	/**
		@name importList
		@param Array
		@return None
		@note parse 2D Array into data
	**/
	this.course.importList = function(arr){
		courseList = new Array();
		for(var each in arr){
			courseList[arr[each].cid - 1] = new Course(arr[each].cid);
			courseList[arr[each].cid - 1].importCourse(arr[each]);
		}
	}


	/**
		COURSE ATTRIBUTES & METHODS
	**/

	this.teacher = function(){
		return teacherList;
	}

	/**
		@name add
		@param None/Teacher object/Teacher number
		@return Student object
		@note  add a student to teacherList
	**/
	this.teacher.add = function(tch){
		if(arguments.length == 0){
			teacherList.push(new Teacher());
		}else if(arguments.length == 1 && tch instanceof Teacher){
			teacherList.push(tch);
		}else{
			return;
		}
		return teacherList[teacherList.length - 1];
	}
	
	/**
		@name find
		@param String SQL condition
		@return Array
		@note find students match the condition
	**/
	this.teacher.find = function(condition){
		var ret = teacherList.filter(function (each){
			return eval(condition.parseCondition());
		});
		return ret;
	}
	
	/**
		@name exportList
		@param None
		@return Array
		@note parse data into 2D array
	**/
	this.teacher.exportList = function(){
		var ret = new Array(0);
		teacherList.forEach(function(tch){
			if(tch != null) ret.push(tch.exportTeacher());
		});
		return ret;
	}
	
	/**
		@name importList
		@param Array
		@return None
		@note parse 2D Array into data
	**/
	this.teacher.importList = function(arr){
		teacherList = new Array();
		for(var each in arr){
			teacherList[arr[each].tid - 1] = new Teacher(arr[each].tid);
			teacherList[arr[each].tid - 1].importTeacher(arr[each]);
		}
	}
	
	/**
		@name remove
		@param Array
		@return Array
		@note remove matched array in TeacherList
	**/
	this.teacher.remove = function(arr){
		var ret = new Array(0);
		for(var each in arr){
			for(var tch in teacherList){
				if(arr[each] == teacherList[tch]){
					ret.push(teacherList[tch]);
					teacherList[tch] = undefined;
				}
			}
		}
		return ret;
	}

	/**
		@name parseList
		@param Array
		@return Array
		@note parse json string to teacherList object
	**/
	this.teacher.parseList = function(list){
		var arr = new Array(0);
		for(var t = 0; t < list.length; t ++){
			var tid = t + 1;
			var fn = (list[t].hasOwnProperty('TCH_First Name')) ? list[t]['TCH_First Name'].trim() : '';
			var mn = (list[t].hasOwnProperty('TCH_Middle Name')) ? list[t]['TCH_Middle Name'].trim() : '';
			var ln = (list[t].hasOwnProperty('TCH_Last Name')) ? list[t]['TCH_Last Name'].trim() : '';
			arr.push({"tid": tid, "firstName": fn, "middleName": mn, "lastName": ln});
		}
		return arr;
	}


	

}

Examination.prototype.parseExamination = function(list){

	//Check qualified lines
	var arr = examination.checkList(list);
	var l = new Array(0);
	for(var t = 0; t < arr.qual_lines_num; t ++){
		l.push(list[arr.qual_lines[t]]);
	}

	//Collect all courses
	var cozAll = new Array(0);
	for(var t = 0; t < l.length; t ++){
		var coz = {"COZ_Title": l[t]['COZ_Title'], "COZ_Block": l[t]['COZ_Block'], "TCH_First Name": l[t]['TCH_First Name'], "TCH_Middle Name": l[t]['TCH_Middle Name'], "TCH_Last Name": l[t]['TCH_Last Name']};
		if(JSON.stringify(cozAll).indexOf(JSON.stringify(coz)) == -1){
			cozAll.push(coz);
		}
	}

	console.log(cozAll);

	//Relate 3
	var stsParse = this.student.parseList(l);
	var cozParse = this.course.parseList(cozAll);

	var stsList = new Array(0);
	var tchList = new Array(0);
	var cozList = new Array(0);

	for(var t = 0; t < cozAll.length; t ++){
		//create new course
		var coz = new Course(t + 1);
		var cozList = new Array(cozAll[t]);
		coz.importCourse(this.course.parseList(cozList)[0]);

		//according to course, create teahcer
		var tch = new Teacher(t + 1);
		var tchList = new Array(cozAll[t]);
		tch.importTeacher(this.teacher.parseList(tchList)[0]);
		this.teacher.add(tch);
		coz.addTeachers(tch);

		//according to course and teacher, find all students
		for(var t2 = 0; t2 < l.length; t2 ++){
			if(l[t2]['COZ_Title'] == cozAll[t]['COZ_Title'] && l[t2]['COZ_Block'] == cozAll[t]['COZ_Block'] && l[t2]['TCH_First Name'] == cozAll[t]['TCH_First Name'] && l[t2]['TCH_Middle Name'] == cozAll[t]['TCH_Middle Name'] && l[t2]['TCH_Last Name'] == cozAll[t]['TCH_Last Name']){
				var sts = new Student(t2 + 1);
				sts.importStudent(stsParse[t2]);
				this.student.add(sts);
				coz.addStudents(sts);
			}
		}
		this.course.add(coz);
	}
}

Examination.prototype.importExamination = function(exam){
	this.importExam(exam['exm']);
	this.student.importList(exam['sts']);
	this.teacher.importList(exam['tch']);
	this.course.importList(exam['coz']);
	this.importRelateList(exam['rlt']);
}

Examination.prototype.exportExamination = function(){
	var arr = new Array(0);
	arr['exm'] = this.exportExam();
	arr['sts'] = this.student.exportList();
	arr['tch'] = this.teacher.exportList();
	arr['coz'] = this.course.exportList();
	arr['rlt'] = this.exportRelateList();
	return arr;
}

Examination.prototype.importExam = function(list){
	this.title(list['title']);
	this.type(list['type']);
	this.campus(list['campus']);
	this.term(list['term']);
	this.year(list['year']);
	this.startDate(list['startDate']);
	this.endDate(list['endDate']);
}

Examination.prototype.exportExam = function(){
	return {"title": this.title(), "type": this.type(), "campus": this.campus(), "term": this.term(), "year": this.year(), "startDate": this.startDate(), "endDate": this.endDate()};
}

Examination.prototype.parseRelateList = function(relate){
	for(var t = 0; t < relate.length; t ++){
		var coz = this.course.find(" `cid` = '" + relate[t].cid + "' ");
		var sts = this.student.find(" `sid` = '" + relate[t].sid + "' ");
		var tch = this.teacher.find(" `tid` = '" + relate[t].tid + "' ");
		if(coz.length >= 1 && sts.length >= 1 && tch.length >= 1){
			coz[0].addStudents(sts[0]);
			coz[0].addTeachers(tch[0]);
		}
	}
}

Examination.prototype.importRelateList = function(relate){
	for(var t = 0; t < relate.length; t ++){
		var cid = relate[t]['cid'];
		var coz = this.course.find(" `cid` = '" + cid + "' ");
		if(coz.length >= 1){
			for(var t2 = 0; t2 < relate[t]['sts'].length; t2 ++){
				var sts = this.student.find(" `sid` = '" + relate[t]['sts'][t2] + "' ");
				if(sts.length >= 1) coz[0].addStudents(sts[0]);
			}
			for(var t2 = 0; t2 < relate[t]['tch'].length; t2 ++){
				var tch = this.teacher.find(" `tid` = '" + relate[t]['tch'][t2] + "' ");
				if(tch.length >= 1) coz[0].addTeachers(tch[0]);
			}
		}
	}
}

Examination.prototype.exportRelateList = function(){
	var arr = new Array(0);
	for(var t = 0; t < this.course().length; t ++){
		arr.push({"cid": this.course()[t].cid(), "sts": this.course()[t].exportStudentsRelate(), "tch": this.course()[t].exportTeachersRelate()});
	}
	return arr;
}






/**
	@ STUDENT OBJECT
**/
function Student(s){
	
	//attributes
	var sid = s;
	var firstName = '';
	var middleName = '';
	var lastName = '';
	var studentNumber = '';
	
	/**
		@name sid
		@param None
		@return Int
		@note get sid
	**/
	this.sid = function(){
		return sid;
	},
	
	/**
		@name firstName
		@param None/First name
		@return String
		@note change or fetch first name
	**/
	this.firstName = function(fn = firstName){
		firstName = fn;
		return firstName;
	}
	
	/**
		@name middleName
		@param None/Middle name
		@return String
		@note change or fetch middle name
	**/
	this.middleName = function(mn = middleName){
		middleName = mn;
		return middleName;
	}
	
	/**
		@name lastName
		@param None/Last name
		@return String
		@note change or fetch last name
	**/
	this.lastName = function(ln = lastName){
		lastName = ln;
		return lastName;
	}
	
	/**
		@name studentNumber
		@param None/Student number
		@return String
		@note change or fetch student number
	**/
	this.studentNumber = function(stsNo = studentNumber){
		studentNumber = stsNo;
		return studentNumber;
	}
	
}

/**
	@name fullName
	@param None/Split string
	@return String
	@note fetch firstname + middlename + lastname
**/
Student.prototype.fullName = function(split = ' '){
	var name = '';
	if(this.firstName() != '') name += this.firstName() + split;
	if(this.middleName() != '') name += this.middleName() + split;
	if(this.lastName() != '') name += this.lastName();
	return name.trim();
}

/**
	@name importStudent
	@param Array
	@return None
	@note parse 2D array into data
**/
Student.prototype.importStudent = function(arr){
	this.studentNumber(arr.studentNumber.trim());
	this.firstName(arr.firstName.trim());
	this.middleName(arr.middleName.trim());
	this.lastName(arr.lastName.trim());
}


/**
	@name exportStudent
	@param None
	@return Array
	@note parse data into 2D array
**/
Student.prototype.exportStudent = function(){
	return {"sid": this.sid(), "studentNumber": this.studentNumber().trim(), "firstName": this.firstName().trim(), "middleName": this.middleName().trim(), "lastName": this.lastName().trim()};
}

/**
	@ COURSE OBJECT
**/
function Course(c){
	
	var cid = c;
	var title = '';
	var block = '';
	var teachers = new Array(0);
	var students = new Array(0);
	
	this.addStudents = function(sts){
		students.push(sts);
	}
	
	this.removeStudents = function(arr){
		var ret = new Array(0);
		for(var each in arr){
			for(var sts in this.students){
				if(arr[each] == this.students[sts]){
					ret.push(this.students[sts]);
					this.students.splice(sts, 1);
				}
			}
		}
		return ret;
	}
	
	this.findStudents = function(condition){
		var ret = this.students.filter(function (each){
			return eval(condition.parseCondition());
		});
		return ret;
	}

	/**
		@name exportsStudentsRelate
		@param none
		@notes Only exports students sid as relateList
	**/
	this.exportStudentsRelate = function(){
		var ret = new Array(0);
		for(var t = 0; t < students.length; t ++){
			ret.push(students[t].sid());
		}
		return ret;
	}

	/**
		@name exportsStudents
		@param none
		@notes Exports student whole object
	**/
	this.exportStudents = function(){
		var ret = new Array(0);
		for(var t = 0; t < students.length; t ++){
			ret.push(students[t].exportStudent());
		}
		return ret;
	}
	
	this.addTeachers = function(tch){
		teachers.push(tch);
	}
	
	this.removeTeachers = function(arr){
		var ret = new Array(0);
		for(var each in arr){
			for(var tch in this.teachers){
				if(arr[each] == this.teachers[tch]){
					ret.push(this.teachers[tch]);
					this.teachers.splice(tch, 1);
				}
			}
		}
		return ret;
	}
	
	this.findTeachers = function(condition){
		var ret = this.teachers.filter(function (each){
			return eval(condition.parseCondition());
		});
		return ret;
	}

	/**
		@name exportTeachersRelate
		@param none
		@notes Only exports teachers sid as relateList
	**/
	this.exportTeachersRelate = function(){
		var ret = new Array(0);
		for(var t = 0; t < teachers.length; t ++){
			ret.push(teachers[t].tid());
		}
		return ret;
	}

	/**
		@name exportTeachers
		@param none
		@notes Exports teacher whole object
	**/
	this.exportTeachers = function(){
		var ret = new Array(0);
		for(var t = 0; t < teachers.length; t ++){
			ret.push(teachers[t].exportTeacher());
		}
		return ret;
	}

	this.cid = function(){
		return cid;
	}
	
	this.title = function(t = title){
		title = t;
		return title;
	}
	
	this.block = function(b = block){
		block = b;
		return block;
	}
	
}

/**
	@name importCourse
	@param Array
	@return None
	@note parse 2D array into data
**/
Course.prototype.importCourse = function(arr){
	this.title(arr.title.trim());
	this.block(arr.block.trim());
}


/**
	@name exportCourse
	@param None
	@return Array
	@note parse data into 2D array
**/
Course.prototype.exportCourse = function(){
	return {"cid": this.cid(), "title": this.title().trim(), "block": this.block().trim()};
}

/**
	@ TEACHER OBJECT
**/
function Teacher(t){
	
	var tid = t;
	var firstName = '';
	var middleName = '';
	var lastName = '';
	
	/**
		@name tid
		@param None
		@return Int
		@note get tid
	**/
	this.tid = function(){
		return tid;
	},
	
	/**
		@name firstName
		@param None/First name
		@return String
		@note change or fetch first name
	**/
	this.firstName = function(fn = firstName){
		firstName = fn;
		return firstName;
	}
	
	/**
		@name middleName
		@param None/Middle name
		@return String
		@note change or fetch middle name
	**/
	this.middleName = function(mn = middleName){
		middleName = mn;
		return middleName;
	}
	
	/**
		@name lastName
		@param None/Last name
		@return String
		@note change or fetch last name
	**/
	this.lastName = function(ln = lastName){
		lastName = ln;
		return lastName;
	}
	
	
}

Teacher.prototype.fullName = function(split = ' '){
	var name = '';
	if(this.firstName().trim() != '') name += this.firstName() + split;
	if(this.middleName().trim() != '') name += this.middleName() + split;
	if(this.lastName().trim() != '') name += this.lastName();
	return name;
}


/**
	@name importTeacher
	@param Array
	@return None
	@note parse 2D array into data
**/
Teacher.prototype.importTeacher = function(arr){
	this.firstName(arr.firstName.trim());
	this.middleName(arr.middleName.trim());
	this.lastName(arr.lastName.trim());
}

Teacher.prototype.exportTeacher = function(){
	return {"tid": this.tid(), "firstName": this.firstName(), "middleName": this.middleName(), "lastName": this.lastName()};
}


/**
	@name fullName
	@param None/Split string
	@return String
	@note fetch firstname + middlename + lastname
**/
Teacher.prototype.fullName = function(split = ' '){
	var name = '';
	if(this.firstName() != '') name += this.firstName() + split;
	if(this.middleName() != '') name += this.middleName() + split;
	if(this.lastName() != '') name += this.lastName();
	return name.trim();
}
