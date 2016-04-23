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

function checkUserAccount($email, $password){
	//query users table

	$conn = connectToDB();
    session_start();
	//$email =  $_POST['Email'];
	//$password = $_POST['Password'];
	
	//sanitize string inputs
	
	$sql="SELECT * FROM Users WHERE Email='$email' AND Password='$password'";
    $result=$conn->query($sql);
    $count = 0;
    while($row = $result->fetch_assoc())
    {
    	$count += 1;
	}
	if($count == 1){

		//set session variables
		$_SESSION['userID'] = 1;
		$_SESSION['userType'] = 0;
		header('Location: index.php?action=home');

	}
	
	else{

		//incorrect login credentials, redirect to siginin
    	header('Location: index.php?loginfailed=1');
    }
}

function getStudentCourses(){
	$studentID = $_SESSION['userID'];
	// Get courses group by semester that the student is in 	
	// StudentCourses -> CourseAssignments -> CourseSubmissions -> Submissions -> Courses
	
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
		);
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
	
	return array(
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
		);
}

?>