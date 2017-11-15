<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
  <body>
	<nav class="navbar navbar-inverse">
	<div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">HungryCoders</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="http://localhost/SE-Project/index.php">Home</a></li>
      <li><a href="http://localhost/SE-Project/practice.html">compete</a></li>
      <li><a href="http://localhost/SE-cticecte.html" >practice</a></li>
      <li class = "active"><a href="http://localhost/SE-Project/forum/disc.php" >Discussion</a></li>
    </ul>
	<ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
	</ul>
	  </div>
	</nav>
	<div class = "container-fluid">

		<form method="post" action="posts.php">
		<div class="col-xs-6 col-md-offset-3">
			<?php
				if(isset($_GET['topic_title']))
				{
					echo "<input hidden id='topic_title' name='topic_title' value=".$_GET['topic_title']." />";
				}
			?>
			<label >Name:</label>
			<input class="form-control" id="logged_in" name ="logged_in" ></input>
			<label >Message:</label>
			<textarea class="form-control" rows="20" id="message" name = "message"></textarea>
			<br>
			<button type="submit" class="btn btn-default">Submit</button>
		</div>
		</form>

	</div>
  </body>
</html>  
