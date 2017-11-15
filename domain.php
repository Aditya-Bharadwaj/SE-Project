<?php
	session_start();
	include_once('template.html');
?>
<body>
<?php
	$domain_name = $_GET['domain_name'];
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "codemanch";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	$sql = "SELECT CID FROM challenges WHERE domain='$domain_name'";
	$result = $conn->query($sql);
	$data = array();
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$data[] = $row["CID"];
		}
	}
	echo "<h1 class='display-1'>$domain_name</h1>";
	echo "<div class = 'container-fluid'>
	<div class='row'> 
	<div class='col-md-2'></div>
	<div class='col-md-8'>";
	for ($i=0;$i<sizeof($data);$i++) {
		$value = $data[$i];
		$st = file_get_contents('recommender/questions/'.$value.'.json');
		$json = json_decode($st, true);
		echo "<div class='col-md-6'>";
		$link = 'problem_template.php?challenge_id='.$value;
		echo "<div class = 'well well-lg'> ".$json['title']." <br> ".$json['domain']." <br> ".$json['subdomain']."<br> <button type='button' class='btn btn-default'> <a href = ".$link.">Solve problem</a></button>
		</div>";
		echo "</div>";
	}
	echo "</div><div class='col-md-2'></div></div></div>";
	$conn->close();
?>
</body>
</html>