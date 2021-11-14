<?php session_start(); ?>
<html>
<head>
	<title>Random Code</title>
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
        <a class="nav-link" href="teacher_logout.php" tabindex="-1" >Logout</a>
      </li>
    </ul>
  </div>
</nav>
</nav>


<center>
	<?php 
	if(isset($_SESSION['valid1'])){
		$code=(rand(1000,10000));
	include("connection.php");	
	$date=$_SESSION['date'];
	$course=$_SESSION['course'];
	$result = mysqli_query($mysqli, "UPDATE codes SET code='$code', course='$course' WHERE date='$date'")
		or die("Could not execute the select query.");
	if(isset($_POST['submit']))
	{	mysqli_query($mysqli, "UPDATE codes SET code='$code', course='$course' WHERE date='$date'");
		header('Location: attendence.php');
	}
?>

	<div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-6 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body" style="background-color:ivory">
            <form class="form-signin" method="post" action="">
					<div class="text-center">
						<h1><?php echo $code;?></h1>
					</div>	
					<br>
					<br>
					<div class="text-center">
					<button class="btn btn-primary btn-success text-uppercase" style="width:200" name="submit" type="submit">Deactivate</button>
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