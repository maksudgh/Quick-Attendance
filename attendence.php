<?php session_start(); ?>
<html>
<head>
	<title>Attendence</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
        <a class="nav-link active" href="course.php">Take Attendence</a>
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


 
<div class="container-fluid" style="padding: 0px; margin: 0px;">
            <h2 class="text-center">Student Attendence</h2>
    </div>
	<?php 
	include("connection.php");
	if(isset($_SESSION['valid1'])){	
		$date=$_SESSION['date'];
	$course=$_SESSION['course'];
	$result1= mysqli_query($mysqli, "select count(status) as total from attendence WHERE status='P' and date='$date' and course='$course'")
	 or die("query is not executed");
	$row2 = mysqli_fetch_assoc($result1);
	echo"<h5 style=' margin: 40px 7px 0px 840px;'>Student Count: ".$row2['total']."</h5>";
	
	echo "</h1></center>";
	
	$result = mysqli_query($mysqli, "select * from attendence WHERE date='$date'and course='$course'")
		or die("Could not execute the select query.");
	foreach ($result as $key => $res) {
		$s_id[]=$res['s_id'];
		$name[]=$res['name'];
		$status[]=$res['status'];
	}
  echo "<br>";
	if (isset($_POST['submit']))
	{
		foreach ($s_id as $id){
			if(!empty($_POST['stats'][$id]))
			{
					$status1 = $_POST['stats'][$id];
					mysqli_query($mysqli, "UPDATE attendence SET status='$status1' where s_id='$id' and date='$date' and course='$course'")
					or die("Query problem");
			}
			else{	mysqli_query($mysqli, "UPDATE attendence SET status='A' where s_id='$id' and date='$date' and course='$course'")
			or die("Query error");}
		}
		
		/*foreach (array_combine($s_id, $status1) as $id => $stat){
			echo $stat;
		
		}*/
		header('Location: teacher_success.php');
	
	}	
	/*if(isset($_POST['submit']))
	{	mysqli_query($mysqli, "UPDATE codes SET code='$code', course='$course' WHERE date='$date'");
		header('Location: attendence.php');
	}*/
	else
?>

    <div class="container" style="padding-top: 25px;">
	<form name="form1" method="post" action="">
 <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Student Id</th>
      <th scope="col">Name</th>
      <th scope="col">Attendence</th>
    </tr>
  </thead>
  <tbody>
  <?php
  for($j = 0; $j < count($s_id); $j++) {
  echo'<tr>';
      echo"<td>".$s_id[$j]."</td>";
      echo"<td>".$name[$j]."</td>";
     echo "<td>";
	  if($status[$j]=='P')
	  { 
	  echo "<label class='checkbox-inline'><input name='stats[$s_id[$j]]' type='checkbox' value='P' checked></label>";}
	  if($status[$j]=='A'){  
	  echo "<label class='checkbox-inline'><input name='stats[$s_id[$j]]' type='checkbox' value='P' ></label>";}
	  echo'</td>';
    echo '</tr>';
	}?>
  </tbody>
</table>
                   <center> <button class="btn btn-success" id="show-add" name="submit">submit</button></center>
                </form>
  </div>
  
</div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

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
