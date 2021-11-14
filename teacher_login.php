<?php 
session_start();
include("connection.php");
 ?>
<html>
<head>
	<title>Teacher Login</title>
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
        <a class="nav-link" href="view_attendence.php">View Attendence</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="teacher_logout.php" tabindex="-1" >Logout</a>
      </li>
    </ul>
  </div>
</nav>
</nav>
  
<?php
if(isset($_POST['submit'])) {
	$email = mysqli_real_escape_string($mysqli, $_POST['email']);
	$pass = mysqli_real_escape_string($mysqli, $_POST['password']);

	if($email == "" || $pass == "") {
		echo "Either email or password field is empty.";
		echo "<br/>";
		echo "<a href='login.php'>Go back</a>";
	} else {
		$result = mysqli_query($mysqli, "SELECT * FROM teacher WHERE email='$email' AND password='$pass'")
					or die("Could not execute the select query.");
		
		$row = mysqli_fetch_assoc($result);
		
		if(is_array($row) && !empty($row)) {
			$validuser = $row['email'];
			$_SESSION['valid1'] = $validuser;
			$_SESSION['id'] = $row['id'];
			//$_SESSION['id'] = $row['username'];
		} else {
			echo"
			<div class='alert alert-danger' role='alert'>
				Invalid username or password
			</div>";
			echo "<br/>";
			echo "<a href='teacher_login.php'><h5>Go back</h5></a>";
		}

		if(isset($_SESSION['valid1'])) {
				header('Location: course.php');	
		}
	}
} else {
?>
<div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Sign In</h5>
            <form class="form-signin" method="post" action="">
              <div class="form-label-group" >
                <input type="text" name="email" class="form-control" placeholder="Email address" required autofocus>
                <label for="inputEmail">Email address</label>
              </div>

              <div class="form-label-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <label for="inputPassword">Password</label>
              </div>

              <button class="btn btn-lg btn-primary btn-block text-uppercase" name="submit" type="submit">Sign in</button>
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php
/*<p><font size="+2">Login</font></p>
	<form name="form1" method="post" action="">
		<table width="75%" border="0">
			<tr> 
				<td width="10%">Email</td>
				<td><input type="text" name="email"></td>
			</tr>
			<tr> 
				<td>Password</td>
				<td><input type="password" name="password"></td>
			</tr>
			<tr> 
				<td>&nbsp;</td>
				<td><input type="submit" name="submit" value="Submit"></td>
			</tr>
		</table>
</form>*/
}
?>
</body>
</html>
