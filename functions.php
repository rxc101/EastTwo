<?php
function isLoggedIn(){
	if(isset($_SESSION['userID'])){
		return true;
	}else{
		return false;
	}
}
function isStudent(){
	if(isset($_SESSION['userType'])){
		if($_SESSION['userType'] == 0) return true;
	}
	return false;
}

function connectToDB()
{
	include 'dbLogin.php';
	$conn = new mysqli($hn, $un, $pw, $db);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	return $conn;
}

function addUser()
{
	$conn = connectToDB();

	$accountType = $_POST['accountType'];
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$pass = $_POST['password'];
	$email = $_POST['email'];

	$sql="INSERT INTO users (Email, AccountType, Password, FirstName, LastName) VALUES ('$email', '$accountType', '$pass', '$firstName', '$lastName')";

	if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

$conn->close();

}

function checkUserAccount($email, $password){
	//query users table

	$conn = connectToDB();
	
	//sanitize string inputs
	
	$sql="SELECT * FROM users WHERE Email='$email' AND Password='$password'";
    $result=$conn->query($sql);
    $count = 0;
    while($row = $result->fetch_assoc())
    {
    	$count += 1;
    	$accountType = $row["AccountType"];
    	$userID = $row["Id"];
    	$userEmail = $row["Email"];
	}
	if($count == 1){

		//set session variables
		$_SESSION['userID'] = $userID;
		$_SESSION['userType'] = $accountType;
		$_SESSION['userName'] = $userEmail;
		header('Location: index.php?action=home');

	}
	
	else{
		//incorrect login credentials, redirect to siginin
    	header('Location: index.php?loginfailed=1');
    }
    $conn->close();
}

function getStudentCourses(){
	$studentID = $_SESSION['userID'];
	// Get courses group by semester that the student is in 	
	// StudentCourses -> CourseAssignments -> CourseSubmissions -> Submissions -> Courses
	$conn = connectToDB();
	
	// DOUBLE query, oh well
	
	$sql1 = 'SELECT * FROM semesters';
	$result=$conn->query($sql1);
    $semesterCount = 0;
	$data = null;
    while($row = $result->fetch_assoc()){
		// EACH SEMESTER
		$data[$semesterCount]['semesterID'] = $row['ID'];
		$data[$semesterCount]['semseterName'] = $row['Name'];
		$data[$semesterCount]['courses'] = null;
		
		$sql2 = 'SELECT c.ID,c.Name FROM studentcourses sc, semesters s, courses c ';
		$sql2.= 'WHERE c.ID=sc.CourseID AND sc.StudentID='.$studentID.' AND s.ID='.$row['ID'].' AND sc.SemesterID='. $row['ID'];
		
		$result2=$conn->query($sql2);
		$count2 = 0;
		while($row2 = $result2->fetch_assoc()){
			$data[$semesterCount]['courses'][$count2]['courseID'] = $row2['ID'];
			$data[$semesterCount]['courses'][$count2]['courseName'] = $row2['Name'];
			$data[$semesterCount]['courses'][$count2]['dueAss'] = 2;
			$data[$semesterCount]['courses'][$count2]['lateAss'] = 2;
			$count2++;
		}
		
		$semesterCount++;
	}
	
	return $data;
	
	/*
	return array(
				0 => array( 
					'semseterName' =>'Spring 2016',
					'courses' => array(							
										0=> array(
												'courseID' => 0,
												'courseName' => 'Course 4556 Math',
												'dueAss' => 2,
												'lateAss' =>0
												),
										1=> array(
												'courseID' => 1,
												'courseName' => 'Course 123 History',
												'dueAss' => 0,
												'lateAss' =>3
												)
									)
						),
				1 => array( 
					'semseterName' =>'Fall 2015',
					'courses' => array(							
										0=> array(
												'courseID' => 2,
												'courseName' => 'Course 4556 Math',
												'dueAss' => 2,
												'lateAss' =>0
												)
									)
						)
		);*/
}

function getStudentCourseAssignments($courseID){
	// Get assignments 	
	//  CourseAssignments -> CourseSubmissions -> Submissions -> Courses
	
	return array(
				'courseName' =>'Course 4556 Math',
				'assignments' => 	array(
										0 => array(
													'assID' => 0,
													'assignmentName' => 'Algims',
													'dueDate' => '1/5/2016 5:15PM',
													'submitted' => true
												),
										1 => array(
													'assID' => 1,
													'assignmentName' => 'Dumb Web Project',
													'dueDate' => '4/20/2016 4:20PM',
													'submitted' => false
												)
										
									)
				);
}

function getStaffCourseAssignments($courseID){
	$conn = connectToDB();
	
	$sql = 'SELECT c.ID, c.Name as CourseName, a.Name FROM assignments a, courseassignments ca, courses c ';
	$sql.= 'WHERE ca.ID='.$courseID .' AND a.ID=ca.AssignmentID AND c.ID=ca.CourseID';
	$result=$conn->query($sql);
	$assCount = 0;
	$data = null;
    while($row = $result->fetch_assoc()){
		$data['courseName'] = $row['CourseName'];
		$data['assignments'][$assCount]['assID'] = $row['ID'];
		$data['assignments'][$assCount]['assignmentName'] = $row['Name'];
		
		$data['assignments'][$assCount]['needsGraded'] = 1;
		$data['assignments'][$assCount]['completed'] = false;
		$assCount++;
	}
	
	return $data;
	
	/*return array(
				'courseName' =>'Course 4556 Math',
				'assignments' => 	array(
										0 => array(
													'assID' => 0,
													'assignmentName' => 'Algims',
													'needsGraded' => 5,
													'completed' => true
												),
										1 => array(
													'assID' => 1,
													'assignmentName' => 'Dumb Web Project',
													'needsGraded' => 0,
													'completed' => false
												)
										
									)
				);*/
}

function getStaffStudentSubmission($assID){
	// This will be an grouping by studentID their submissions
	
	$conn = connectToDB();
	// THIS SQL will also have basic assignmetn dtails
	$studentsSQL = 'SELECT *,ass.ID as asID,u.ID as stuID,a.Name as assName,ass.SubID as linkSubID FROM assignmentsubmissions ass, assignments a, users u ';
	$studentsSQL.= 'WHERE ass.AssID='.$assID.' AND a.ID=AssID AND u.ID=ass.StudentID ';
	$studentsSQL.= 'AND u.ID IN(SELECT scc.StudentID FROM studentcourses scc,courseassignments ca WHERE ca.AssignmentID=ass.AssID AND ca.CourseID = scc.CourseID ) GROUP BY u.ID';
	
	$result=$conn->query($studentsSQL);
	$stuCount = 0;
	$data = null;
	
    while($row = $result->fetch_assoc()){
		$data['assignmentName'] = $row['assName'];
		$data['assignmentMax'] = $row['MaxPoints'];
		$data['dueDate'] ='due date...';
		
		$data['students'][$stuCount]['studentID'] = $row['stuID'];
		$data['students'][$stuCount]['studentName'] = $row['Email'];
		
		$subSQL = 'SELECT *,s.ID as subID FROM submissions s, assignmentsubmissions ass WHERE ass.StudentID='.$row['stuID'].' AND ass.AssID='.$assID.' AND s.ID=ass.SubID';
		$result2=$conn->query($subSQL);
		$subCount=0;
		while($row2 = $result2->fetch_assoc()){
			$data['students'][$stuCount]['submissions'][$subCount]['submissionID'] = $row2['subID'];
			$data['students'][$stuCount]['submissions'][$subCount]['comments'] = $row2['comments'];
			$data['students'][$stuCount]['submissions'][$subCount]['feedback'] = $row2['feedback'];
			$data['students'][$stuCount]['submissions'][$subCount]['submissionDate'] = 'Submission: '.$row2['subID'];
			$data['students'][$stuCount]['submissions'][$subCount]['graded'] = $row2['graded'];
			$data['students'][$stuCount]['submissions'][$subCount]['file'] = $row2['fileloc'];
			
			$subCount++;
		}
		
		$stuCount++;
	}
	
	return $data;
	/*
	return array(
				'assignmentName' =>'Algims Part 1',
				'assignmentMax' => 100,
				'dueDate' => '4/20/2016 4:20PM',
				'students' => array(
									0=> array(
												'studentID'=>0,
												'studentName'=>'Max',
												'submissions' => 	array(
																		0 => array(
																					'submissionID' => 0,
																					'comments' => 'I tried doing better but couldnt',
																					'feedback' => 'toobad',
																					'submissionDate' => '1/5/2016 7:15PM',
																					'graded' => 33,
																					
																				),
																		1 => array(
																					'submissionID' => 1,
																					'comments' => 'IDK WHAT IM DOING',
																					'feedback' => null,
																					'submissionDate' => '1/5/2016 6:15PM',
																					'graded' => null
																				),
																		2 => array(
																					'submissionID' => 3,
																					'comments' => '',
																					'feedback' => null,
																					'submissionDate' => '1/5/2016 5:15PM',
																					'graded' => null
																				)
																		
																	)
											),
								1=> array(
												'studentID'=>0,
												'studentName'=>'Sue Zie',
												'submissions' => 	array(
																		0 => array(
																					'submissionID' => 4,
																					'comments' => 'I tried doing better but couldnt',
																					'feedback' => 'toobad',
																					'submissionDate' => '1/5/2016 7:15PM',
																					'graded' => null,
																					
																				),
																		1 => array(
																					'submissionID' => 5,
																					'comments' => 'IDK WHAT IM DOING',
																					'feedback' => null,
																					'submissionDate' => '1/5/2016 6:15PM',
																					'graded' => null
																				),
																		2 => array(
																					'submissionID' => 6,
																					'comments' => '',
																					'feedback' => null,
																					'submissionDate' => '1/5/2016 5:15PM',
																					'graded' => null
																				)
																		
																	)
											)
								)
				);*/
	
}

function getStudentAssignmentSubmissions($assID){
	// get submissions for assignment
	return array(
				'assignmentName' =>'Algims Part 1',
				'assignmentMax' => 100,
				'dueDate' => '4/20/2016 4:20PM',
				'submissions' => 	array(
										0 => array(
													'submissionID' => 0,
													'comments' => 'I tried doing better but couldnt',
													'feedback' => 'toobad',
													'submissionDate' => '1/5/2016 7:15PM',
													'graded' => 25,
													
												),
										1 => array(
													'submissionID' => 1,
													'comments' => 'IDK WHAT IM DOING',
													'feedback' => null,
													'submissionDate' => '1/5/2016 6:15PM',
													'graded' => null
												),
										2 => array(
													'submissionID' => 3,
													'comments' => '',
													'feedback' => null,
													'submissionDate' => '1/5/2016 5:15PM',
													'graded' => null
												)
										
									)
				);
}

function getStaffCourses(){
	$staffID = $_SESSION['userID'];
	// This will get all the courses that a teacher is a member of StaffCourses
	// StudentCourses - > StaffCourses -> CourseSubmissions -> Submissions -> Courses
	
	$conn = connectToDB();
	
	// DOUBLE query, oh well
	
	$sql1 = 'SELECT * FROM semesters';
	$result=$conn->query($sql1);
    $semesterCount = 0;
	$data = null;
    while($row = $result->fetch_assoc()){
		// EACH SEMESTER
		$data[$semesterCount]['semesterID'] = $row['ID'];
		$data[$semesterCount]['semseterName'] = $row['Name'];
		$data[$semesterCount]['courses'] = null;
		
		$sql2 = 'SELECT c.ID,c.Name FROM staffcourses sc, semesters s, courses c ';
		$sql2.= 'WHERE c.ID=sc.CourseID AND sc.StaffID='.$staffID.' AND s.ID='.$row['ID'].' AND sc.SemesterID='. $row['ID'];
		
		$result2=$conn->query($sql2);
		$count2 = 0;
		while($row2 = $result2->fetch_assoc()){
			$data[$semesterCount]['courses'][$count2]['courseID'] = $row2['ID'];
			$data[$semesterCount]['courses'][$count2]['courseName'] = $row2['Name'];
			$data[$semesterCount]['courses'][$count2]['students'] = 2;
			$data[$semesterCount]['courses'][$count2]['assignments'] = 2;
			$count2++;
		}
		
		$semesterCount++;
	}
	
	return $data;
	
	
	
	
	/*return array(
				0 => array( 
					'semesterID' => 0,
					'semseterName' =>'Spring 2016',
					'courses' => array(							
										0=> array(
												'courseID' => 0,
												'courseName' => 'Course 4556 Math',
												'students' => 2,
												'assignments' =>0
												),
										1=> array(
												'courseID' => 1,
												'courseName' => 'Course 123 History',
												'students' => 25,
												'assignments' =>2
												)
									)
						),
				1 => array(
					'semesterID' => 1,
					'semseterName' =>'Fall 2015',
					'courses' => array(							
										0=> array(
												'courseID' => 2,
												'courseName' => 'Course 4556 Math',
												'students' => 3,
												'assignments' =>2
												)
									)
						)
		);*/
}
function getStudentsNotInCourse($courseID){
	$conn = connectToDB();
	
	$userCount = 0;
	$data = null;
	
	$sql = 'SELECT u.ID, u.Email FROM users u ';
	$sql.= 'WHERE u.AccountType=0 AND u.ID NOT IN (SELECT sc.StudentID FROM studentcourses sc WHERE sc.CourseID='.$courseID.' ) ';
	
	$result=$conn->query($sql);
    while($row = $result->fetch_assoc()){
		$data[$userCount]['studentID'] = $row['ID'];
		$data[$userCount]['studentName'] = $row['Email'];	
		$userCount++;
	}
	
	return $data;
	
	/*
	return array(
				0 => array(
						'studentID' => 1,
						'studentName' => 'billyBob'
					),
				1 => array(
					'studentID' => 2,
					'studentName' => 'Suzie Smith'
				)
	);
	*/
}

function getStudentsInCourse($courseID){
	$conn = connectToDB();
	
	$userCount = 0;
	$data = null;
	
	$sql = 'SELECT u.ID, u.Email FROM users u ';
	$sql.= 'WHERE u.AccountType=0 AND u.ID IN (SELECT sc.StudentID FROM studentcourses sc WHERE sc.CourseID='.$courseID.' ) ';
	
	$result=$conn->query($sql);
    while($row = $result->fetch_assoc()){
		$data[$userCount]['studentID'] = $row['ID'];
		$data[$userCount]['studentName'] = $row['Email'];	
		$userCount++;
	}
	
	return $data;
	
		/*return array(
				2 => array(
						'studentID' => 1,
						'studentName' => 'Ryan sad'
					),
				3 => array(
					'studentID' => 2,
					'studentName' => 'dae fraa'
				)
	);*/
}

?>