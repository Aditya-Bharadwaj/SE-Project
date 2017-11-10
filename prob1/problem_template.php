<?php
	$challenge_id = $_GET['challenge_id'];
	$json = '../recommender/questions/'.$challenge_id.".json";
	$challenge_data = file_get_contents($json,true);
	$challenge_data = json_decode($challenge_data);

	include_once('template.html');


?>

<body>
	<?php
	 echo '<div class="container-fluid"><h1>'.$challenge_data->title.'</h1>'.'<hr/>'.$challenge_data->text."</div>";

	?>;
	<input type="textarea" name = "editor" id = "editor"></input>
	<script>
  	var editor = CodeMirror.fromTextArea(editor, {lineNumbers: true});
</script>
</body>

