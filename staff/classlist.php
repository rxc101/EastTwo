<div class="container body-container">
<h2>Course List</h2>

<div class="well">
<h3>2016 Semester</h3>
<div class="list-group">	
	
  <a href="?action=course&courseID=" class="list-group-item">
    <h4 class="list-group-item-heading">CS 1234 - WEB</h4>
    <p class="list-group-item-text">Current Assignments: 1</p>
	<p class="list-group-item-text">Current Students: 15</p>
  </a>
  <span style="display:none" id="addCourseBox" class="list-group-item hoverMouse">
   <div class="row">
   <div class="col-sm-6"><input id="addCourseName" type="text" class="form-control" placeholder="Course Name"></div>
   <div class="col-sm-6"><button data-semesterID="1" id="saveAddCouse" class="btn btn-primary">Save</button> <button id="cancelAddCouse" class="btn btn-danger">Cancel</button></div>
   </div>
  </span>
  
  <span id="addCourse" href="" class="list-group-item hoverMouse">
    <h4 class="list-group-item-heading"><button class="btn btn-default pull-right "><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button> Add Course</h4>
  </span>
 
	
     
</div>
</div>

<div style="display:none"  id="addSemesterBox" class="well hoverMouse">
   <div class="row">
   <div class="col-sm-6"><input id="addSemesterName" type="text" class="form-control" placeholder="Semester Name"></div>
   <div class="col-sm-6"><button id="saveAddSemester" class="btn btn-primary">Save</button> <button id="cancelAddSemester" class="btn btn-danger">Cancel</button></div>
   </div>

</div>

<div id="addSemester" class="well hoverMouse">
<h3><button class="btn btn-default pull-right "><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>Add Semester</h3>

</div>


</div>

<script>
// second ajax spot
$(function() {
	// ADDING COURSE STUFF
	$("#addCourse").click(function(e){
		$(this).hide();
		$("#addCourseBox").show();
		
		
	});
	$("#cancelAddCouse").click(function(e){
		$("#addCourseBox").hide();
		$("#addCourse").show();
		$("#addCourseName").val("");
		
		
	});
	$("#saveAddCouse").click(function(e){
		//AJAX SAVE THAT
		//REFRESH PAGE
		alert("Saving - Refreshing Page");
		location.reload(); 
		
		
	});
	// END COURSE STUFF
	
	// ADD SEMESTER STUFF
	$("#addSemester").click(function(e){
		$(this).hide();
		$("#addSemesterBox").show();
		
		
	});
	$("#cancelAddSemester").click(function(e){
		$("#addSemesterBox").hide();
		$("#addSemester").show();
		$("#addSemesterName").val("");
		
		
	});
	$("#saveAddSemester").click(function(e){
		//AJAX SAVE THAT
		//REFRESH PAGE
		alert("Saving - Refreshing Page");
		location.reload(); 
		
		
	});
	// END ADD SEMESTER STUFF
});
</script>