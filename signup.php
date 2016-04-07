<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>East2.0</title>

    <!-- Bootstrap core CSS -->
    <link href="support/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="support/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="styles/signin.css" rel="stylesheet">

  </head>

  <body>

<div class="container">
  <h2>Sign Up</h2>
  <form role="form">
    <div class="form-group">
      <label for="email">Complete Pitt Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" required>
    </div>
    <div class="form-group">
      <label for="firstname">First Name:</label>
      <input type="text" class="form-control" id="firstname" placeholder="Enter password" required>
    </div>
    <div class="form-group">
      <label for="lastname">Last Name:</label>
      <input type="text" class="form-control" id="lastname" placeholder="Enter password" required>
    </div>
    <div class="form-group">
      <label for="sid">Student Id:</label>
      <input type="text" class="form-control" id="sid" placeholder="Enter password" maxlength="7" required>
    </div>
    <div class="form-group">
      <label for="grad">Expected Graduation Class:</label>
      <select id="grad" class="form-control" required>
        <option value="2016" selected="selected">2016</option>
        <option value="2017">2017</option>
        <option value="2018">2018</option>
        <option value="2019">2019</option>
        <option value="2020">2020</option>
        <option value="2021">2021</option>
        </select>
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" required>
    </div>
    <div class="form-group">
      <label for="confirmpwd">Password Again:</label>
      <input type="password" class="form-control" id="confirmpwd" placeholder="Confirm password" required>
    </div>

    <button type="submit" class="btn btn-lg btn-primary">Submit</button>
  </form>
</div>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="support/assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
