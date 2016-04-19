<?php
require_once "functions.php";
$action = (isset($_GET['action'])!=null?$_GET['action']:"home");

session_start();
// Just for testing
$_SESSION['userID'] = 1;
$_SESSION['userType'] = 1; // = 0 Student, = 1 Staff

// session_unset(); // Uncomment to view login page

if(!isLoggedIn()){
			// Display Login Form
			$page['title'] = "Login";
			require_once 'header.php';
			require_once 'login.php';
			require_once 'footer.php';
} else {
	switch ($action) {
		case "home":	
			if(isStudent()){
				$page['title'] = "Student - Class List";
				$page['studentCourseList'] = getStudentCourses();
				
				require_once 'header.php';				
				require_once 'student/classlist.php';
			} else {
				$page['title'] = "Facalty - Class List";
				require_once 'header.php';
				require_once 'staff/classlist.php';
			}	
			
			require_once 'footer.php';
			break;  
		
		case "course":
			if(isStudent()){
				$page['title'] = "Student - Assignment List";	
				$courseID = $_GET['courseID'];
				$page['studentCourseAssignments'] = getStudentCourseAssignments($courseID);
				
				require_once 'header.php';				
				require_once 'student/assignlist.php';
			} else {
				$page['title'] = "Facalty - Assignment List";
				require_once 'header.php';
				echo "Facalty Page";
			}			
			
		break;
		
		case "assignment":	
				if(isStudent()){
					$page['title'] = "Student - Assignment";
					$assID = $_GET['assignmentID'];
					$page['studentAssSubmissions'] = getStudentAssignmentSubmissions($assID);
					require_once 'header.php';
					require_once 'student/assignment.php';
				} else {
					$page['title'] = "Facalty - Assignment";
					require_once 'header.php';
					echo "Facalty Page";
				}			
			
		break;


		default:
			echo "You Must Be Lost!";
	}
}

