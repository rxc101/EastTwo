<div class="container body-container">
<div class="row">
	<div class="col-md-6">
		<h2>Add New User</h2>
		<div class="well">
			 <form class="form-horizontal" role="form" id="addUserForm" action="index.php?action=createUser" method="POST">
			 <div class="form-group">
			    <label class="control-label col-sm-2" for="pwd">First Name:</label>
			    <div class="col-sm-10">
			      <input type="text" name="firstName" class="form-control" id="pwd" placeholder="Enter first name">
			    </div>
			  </div>
			   <div class="form-group">
			    <label class="control-label col-sm-2" for="pwd">Last Name:</label>
			    <div class="col-sm-10">
			      <input type="text" name="lastName" class="form-control" id="pwd" placeholder="Enter last name">
			    </div>
			  </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="email">Email:</label>
			    <div class="col-sm-10">
			      <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-2" for="pwd">Password:</label>
			    <div class="col-sm-10">
			      <input type="password" name="password" class="form-control" id="pwd" placeholder="Enter password">
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-2" for="pwd">Confirm Password:</label>
			    <div class="col-sm-10">
			      <input type="password" name="confirmPassword" class="form-control" id="confpwd" placeholder="Enter password">
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-2" for="pwd">Account Type:</label>
			    <div class="col-sm-10">
			      <select name="accountType">
			      	<option value=0 selected>0 - Student</option>
			      	<option value=1>1 - Staff</option>
			      </select>
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-default">Submit</button>
			    </div>
			  </div>
            </form>		
			</div>
		</div>
	</div>
</div>
<!--
<script>

$('#addUserForm').submit(function() {
    // get all the inputs into an array.
    var $inputs = $('#addUserForm :input');

    // get an associative array of the values
    var values = {};
    $inputs.each(function() {
        values[this.name] = $(this).val();
    });

    console.log (values[pwd]);

});

	//var pwd = $('#pwd').val();
	//var confpwd = $('#confpwd').val();

</script>
-->