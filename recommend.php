
<!DOCTYPE html>
<html lang="en">
<head>
  <title>CodeManch</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
    
  .carousel-inner img {
      width: 100%; /* Set width to 100% */
      margin: auto;
      min-height:200px;
  }

  /* Hide the carousel text when the screen is less than 600 pixels wide */
  @media (max-width: 600px) {
    .carousel-caption {
      display: none; 
    }
  }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
	<div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">CodeManch</a>
    </div>
    <ul class="nav navbar-nav">
      <li class = "active"><a href="index.html">Home</a></li>
      <li><a href="compete.html">compete</a></li>
      <li><a href="practice.html" >practice</a></li>
    </ul>
	<ul class="nav navbar-nav navbar-right">
      
      <li><a href="Login/login.html"><span class="glyphicon glyphicon-log-in"></span> Login/SignUp</a></li>
	  
	</ul>
	<ul class="nav navbar-nav navbar-right">
      
      <li><a href="UserProfile/userprofile.html"><span class="glyphicon glyphicon-log-in"></span> Profile</a></li>
	  
	</ul>
	  </div>
</nav>

</body>
<?php
	session_start();
	if(!isset($_SESSION['customerId']))
	{
		header("Location:Login/login.html");
	}
	else
	{
		//echo "welcome ".$_SESSION['customerId'];
		$userId = 'cbeb36c24dcbc5c1';
		$st = file_get_contents('recommender/all_recommendations.json');
		$json = json_decode($st, true);
		//echo '<pre>' . print_r($json, true) . '</pre>';
		//userId = $_SESSION['customerId'];
		echo "<h1 class='display-1'>Recommendations for you</h1>";
		echo "<div class = 'container-fluid'>
		<div class='row'> 
		<div class='col-md-2'></div>
		  <div class='col-md-8'>";
		foreach ($json[$userId] as $field => $value) {
			//echo $value . "<br>";
			$st = file_get_contents('recommender/questions/'.$value.'.json');
			$json = json_decode($st, true);
			echo "<div class='col-md-6'>";
			$link = 'problem_template.php?challenge_id='.$value;
			echo "<div class = 'well well-lg'> ".$json['title']." <br> ".$json['domain']." <br> ".$json['subdomain']."<br> <button type='button' class='btn btn-default'> <a href = ".$link.">Solve problem</a></button>
			</div>";
			echo "</div>";
			//echo $json['title'];
			//echo '<br>';
		}
		echo "</div><div class='col-md-2'></div></div></div>";
	}
	//echo "hello";
?>

</html>