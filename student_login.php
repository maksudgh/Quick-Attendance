<?php session_start(); ?>
<html>
<head>
	<title>Student Login</title>
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
        <a class="nav-link" href="stuent_logout.php" tabindex="-1" >Logout</a>
      </li>
    </ul>
  </div>
</nav>
</nav>


<?php
include("connection.php");

if(isset($_POST['submit'])) {
	$email = mysqli_real_escape_string($mysqli, $_POST['email']);
	$pass = mysqli_real_escape_string($mysqli, $_POST['password']);

	if($email == "" || $pass == "") {
		echo "Either email or password field is empty.";
		echo "<br/>";
		echo "<a href='login.php'>Go back</a>";
	} else {
		$result = mysqli_query($mysqli, "SELECT * FROM students WHERE email='$email' AND password='$pass'")
					or die("Could not execute the select query.");
		
		$row = mysqli_fetch_assoc($result);
		
		if(is_array($row) && !empty($row)) {
			$validuser = $row['email'];
			$_SESSION['valid'] = $validuser;
			$s_id = $row['s_id'];
			$_SESSION['name'] = $row['name'];
			//$_SESSION['id'] = $row['username'];
		} else {
			echo"
			<div class='alert alert-danger' role='alert'>
				Invalid username or password
			</div>";
			echo "<br/>";
			echo "<a href='student_login.php'><h5>Go back</h5></a>";
		}

		if(isset($_SESSION['valid'])) {
				header('Location: code_input.php?id='.$s_id);	
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
}
?>
</body>
</html>
