<?php
	session_start();
	include_once('template.html');
?>
<body>
<?php
	if(!isset($_SESSION['customerId']))
	{
		
		header("Location:Login/login.html");
		
	}
	else
	{
		//echo "welcome ".$_SESSION['customerId'];
		//$userId = '37e9044ec1cde46f';
		//echo $output;
		$userId = $_SESSION['customerId'];		
		//echo $output;
		
		$userId = '37e9044ec1cde46f';
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
</body>
</html>