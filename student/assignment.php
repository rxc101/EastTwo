<div class="container body-container">
<h2>Submissions</h2>
<div class="well">
<h3><?=$page['studentAssSubmissions']['assignmentName']?></h3>
<p class="list-group-item-text">Due: <?=$page['studentAssSubmissions']['dueDate']?></p>

<div class="list-group">
<?php foreach($page['studentAssSubmissions']['submissions'] as $submission){ ?>
  <a class="list-group-item <?=($submission['graded']?'':'')?>">
    <h4 class="list-group-item-heading"><?=$submission['submissionDate']?> Submission</h4>
    <p class="list-group-item-text">Comments: <?=$submission['comments']?></p>
	<p class="list-group-item-text">FeedBack: <?=$submission['feedback']?></p>
	<p class="list-group-item-text"><strong>Grade: <?=$submission['graded']?>/100</strong></p>
  </a>
 <?php }?>
</div>

</div>

<div class="well">
<h3>Submission Area</h3>
<!-- 
THIS Submission area will be a good place to put our required AJAX stuff..
-->

  <div class="form-group">
    <label for="submissionComments">Comments</label>
    <textarea class="form-control" rows="3"></textarea>
  </div>
  <div class="form-group">
    <label for="upLoadButton">Upload File</label><br>
      <span class="btn btn-default btn-file">
        Browse Files <input type="file">
    </span>
  </div>
  <div class="form-group">
  <button id="submitAssignment" class="btn btn-primary"> Submit Assignment </button>
  </div>


</div>
</div>

<script>
// Later I will make this update a file and post to a function to create a new submission
$(function() {
	$("#submitAssignment").click(function(e){
		
		alert("We going to do stuff now");
	});
});
</script>