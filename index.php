<!doctype html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="assets/css/style.css">
		<title>F&U HiFi ProtoType</title>
		<meta charset="utf-8" />
	</head>
	<body>
		<h1>Welcome!<br />Choose version:</h1>
		<p><a href="interface.php?session_id=<?php echo uniqid(); ?>&version=map">Karta</a></p>
		<p><a href="interface.php?session_id=<?php echo uniqid(); ?>&version=category">Kategorier</a> <br />(Note: For now, only "categories" works)</p>
	</body>
</html>