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
      <li><a href="home.html">Home</a></li>
      <li><a href="compete.html">compete</a></li>
      <li class = "active"><a href="practice.html" >practice</a></li>
    </ul>
	<ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
	</ul>
	  </div>
	</nav>
	<div class = "container-fluid">
	
	<?php

	extract($_POST);

	//echo "$code";
	$file = fopen("submitted.py","w+") or die("Unable to open file!");
	fwrite($file,$code);
	$fop = fopen("expectedProb1.txt","r");
	$correct = true;	
	//exec("python submitted.py 2>&1",$res,$err);
	$python = 'C:\\Python27\\python.exe';
	$pyscript = 'C:\\xampp\\htdocs\\miniProj\\prob1\\subp.py';
	$cmd = "$python $pyscript > output.txt";
	
	echo $cmd;
	`$cmd`;
	
	$res = [0,1,2];
	?>
	<div class="row">
		  <div class="col-md-2"></div>
		  <div class="col-md-8">
			<div class = "well well-lg"> <b>output</b> <br>
			<?php
				for($i=0;$i<sizeof($res);$i++)
				{
					$line = fgets($fop);
					if((int)$line != (int)$res[$i])
					{
						$correct = false;
					}
					echo "$res[$i] <br>";
				}
				echo "<br>";
			?>
			</div> 
			<div class = "well well-lg"> 
			<?php
				if($correct == true)
				{
					echo "CORRECT";
					$file_data = "User1 "."Correct";
					$file_data .= file_get_contents('submissions.txt');
					file_put_contents('submissions.txt', $file_data);

				}
				else
				{
					echo "FAIL";
				}
			?>
			</div>
		  </div>
		  <div class="col-md-2"></div>
	</div>	
	</div>
  </body>
</html>  

	
