<?php session_start(); ?>
<html>
<head>
	<title>Take Attendence</title>
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
        <a class="nav-link" href="course.php">Take Attendence</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="view_attendence.php">View Attendence</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php" tabindex="-1" >Logout</a>
      </li>
    </ul>
  </div>
</nav>
</nav>


<?php
	include("connection.php");
	if(isset($_SESSION['valid1'])){
	$teacher= $_SESSION['id'];
	$result = mysqli_query($mysqli, "SELECT * FROM courses WHERE a_teacher='$teacher'")
					or die("Could not execute the select query.");
	if(isset($_POST['submit']))
	{
		$date = mysqli_real_escape_string($mysqli, $_POST['date']);
		$course = mysqli_real_escape_string($mysqli, $_POST['course']);
		if ($course=='Select Course'){echo "Please select a course";}
		else
		{
		$_SESSION['date']=$date;
		$_SESSION['course']=$course;
		$result1=mysqli_query($mysqli, "SELECT * FROM codes WHERE date='$date' and course='$course'");
		$result2 = mysqli_query($mysqli, "SELECT * FROM students WHERE course='$course'")
					or die("Could not execute the select query.");
					
		while($row1 = mysqli_fetch_array($result1))
		{	if($course==$row1['course'] && $date==$row1['date'])
			{
				header('Location: random_code.php');	
			}
		}
		mysqli_query($mysqli, "INSERT INTO codes(date, course, code) VALUES('$date', '$course', '')")
			or die("Could not execute the insert query.");
			while($row2 = mysqli_fetch_array($result2))
				{
					$s_id=$row2['s_id'];
					$name=$row2['name'];
					mysqli_query($mysqli, "INSERT INTO attendence VALUES('','$s_id', '$name', 'A', '$date', '$course')")
						or die("Could not execute the select query.");
				}	
			
		header('Location: random_code.php');	
		}
		}
	?>
	<div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-6 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body" style="background-color:ivory">
            <form class="form-signin" method="post" action="">
					
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
							while($row = mysqli_fetch_array($result))
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
  }?>
  </body>
  </html>