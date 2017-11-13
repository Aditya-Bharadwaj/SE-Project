<?php
	session_start();
	$challenge_id = $_GET['challenge_id'];
	$json = 'recommender/questions/'.$challenge_id.".json";
	$challenge_data = file_get_contents($json,true);
	$challenge_data = json_decode($challenge_data);

	include_once('prob1/template.html');


?>

<body>
	<?php
	 echo '<div class="container-fluid"><h1 align = "center">'.$challenge_data->title.'</h1>'.'<hr/><h3>Problem:</h3><div class ="col-md-8">'.$challenge_data->text."</div></div>";?>
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<form action="prob1/check.php" method = "POST">
				<div class="form-group">
				<div class="scroll" id="submissions"></div>
				  <label for="comment">Code:</label>
				  <textarea class="form-control" rows="20" id="code" name = "code"></textarea>
				  
				  <button type="submit" class="btn btn-default">Submit</button>
				</div>
				</form>
			</div>
			<div class="col-md-2"></div>
		</div>
</body>

