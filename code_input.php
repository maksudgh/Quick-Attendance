<?php session_start(); ?>
<html>
<head>
	<title>Input Code</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="login.php">Attendence</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="login.php">Login </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="student_logout.php" tabindex="-1" >Logout</a>
      </li>
    </ul>
  </div>
</nav>
</nav>


<?php
	include("connection.php");
	if(isset($_SESSION['valid'])){
	$s_id= $_GET['id'];
	$name= $_SESSION['name'];
	$result1 = mysqli_query($mysqli, "SELECT * FROM students where s_id='$s_id'")
					or die("Could not execute the select query1.");
	if(isset($_POST['submit'])) {
	$code = mysqli_real_escape_string($mysqli, $_POST['code']);
	$date = mysqli_real_escape_string($mysqli, $_POST['date']);
	$course = mysqli_real_escape_string($mysqli, $_POST['course']);
	$result = mysqli_query($mysqli, "SELECT * FROM codes where date='$date' and course='$course'")
					or die("Could not execute the select query.");
	$code1='';
	if ($course=='Select Course'){echo "Please select a course";}
	else{
	while($row = mysqli_fetch_array($result))
	{
		$code1=$row['code'];
		
	}
	if($code==$code1)
	{
		mysqli_query($mysqli, "UPDATE attendence SET status='P' where s_id='$s_id' and date='$date' and course='$course'");
		header("Location:student_success.php");
	}
	else 
		echo"
			<div class='alert alert-danger' role='alert'>
				input wrong code or course or date!
			</div>";
	}}
else
{	

/*<p><font size="+2">Input Code</font></p>
	<form name="form1" method="post" action="">
		<table width="75%" border="0">
			<tr>
				<td width="10%">code</td><br>
			</tr>
			
			<tr> 
				<td><input type="text" name="code" required></td>
			</tr><tr><td> &nbsp; </td></tr>
			<tr>
				<td><input name="date" type="date" required></td>
			</tr><tr><td> &nbsp;</td></tr>
			<tr>
				<td>
				<select name="course">
				<option> Select Course</option>
				<?php
					while($row = mysqli_fetch_array($result1))
					{
						echo "<option>$row[course]</option>"; 
						
					}?>
				</select>
				</td>
			</tr><tr><td> </td></tr>
			<tr> 
				<td>&nbsp;</td>
				<td><input type="submit" name="submit" value="Submit"></td>
			</tr>
		</table>
</form> */ } ?>
<div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-6 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body" style="background-color:ivory">
            <form class="form-signin" method="post" action="">
					<div class="form-group row">
					  <label for="example-text-input" class="col-2 col-form-label">Code</label>
					  <div class="col-10">
						<input class="form-control" type="text" value="" name="code" required>
					  </div>
					</div>
					
					<div class="form-group row">
					  <label for="example-date-input" class="col-2 col-form-label">Date</label>
					  <div class="col-10">
						<input class="form-control" type="date" value="" name="date" required>
					  </div>
					</div>
					
					<div class="form-group row">
					  <label for="example-date-input" class="col-2 col-form-label">Course</label>
					  <div class="col-10">
						<select class="form-control" name="course" >
						  <option> Select Course</option>
						  <?php
							while($row = mysqli_fetch_array($result1))
							{
								echo "<option>$row[course]</option>"; 
								
							}?>
						</select>
					  </div>
					</div>
					<br>
					<div class="text-center">
					<button class="btn btn-primary btn-success text-uppercase" style="width:200" name="submit" type="submit">Submit</button>
					</div>
			</div>
			</form>
          </div>
        </div>
      </div>
    </div>
  </div> 
	<?php 
	}
	else
	{
		echo"
			<div class='alert alert-danger' role='alert'>
				You have to <a href='login.php'>login</a> to access this page
			</div>";
	}
	?>
</body>
</html>
	
	