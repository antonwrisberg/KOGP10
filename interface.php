<!doctype html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="assets/css/style.css">
		<title>F&U HiFi ProtoType</title>
		<meta charset="utf-8" />
	</head>
	<body>
		<div class="overlay" id="overlay-load">
			<h1>Loading …</h1>
			<h1>If this page persists, you may have been through all of the apps. <a href="index.php">Click here</a> to start over.</h1>
			<h1>If you are unsure whether you have not been through all apps, try reloading the page.</h1>
		</div>
		<div class="overlay hidden" id="overlay-correct">
			<h1>Correct</h1>
			<h1>Loading next app…</h1>
		</div>
		<div class="overlay hidden" id="overlay-info">
			<h1>Help / Instructions</h1>
			<p>Instructions go here …</p>
			<p><a href="#" class="close">(close)</a></p>
		</div>
		<div class="container">
			<div>
				<h1>Find the app</h1>
				<img class="app-image" src="">
				<h1 class="app-name"></h1>
				<p class="app-description"></p>
			</div>
			<div>
			<?php if ($_GET["version"] == "category") : ?>
				<h1>In what category do you expect to find the app?</h1>
				<button data-target-id="1">Handla</button>
				<button data-target-id="2">Hem/Vardag</button>
				<button data-target-id="3">Transport/Resor</button>
				<button data-target-id="4">Socialt</button>
				<button data-target-id="5">Träning & Hälsa</button>
				<button data-target-id="6">Underhållning</button>
			<?php elseif ($_GET["version"] == "map") : ?>
				<h1>Where does the app live?</h1>
				<button data-target-id="1">
					<img src="assets/img/layer0.png">
				</button>
				<button data-target-id="2">
					<img src="assets/img/layer1.png">
				</button>
				<button data-target-id="3">
					<img src="assets/img/layer2.png">
				</button>
				<button data-target-id="4">
					<img src="assets/img/layer3.png">
				</button>
				<button data-target-id="5">
					<img src="assets/img/layer4.png">
				</button>
				<button data-target-id="6">
					<img src="assets/img/layer5.png">
				</button>
			<?php endif; ?>
			</div>
		</div>
		<p class="footer"><a href="#" class="info">Help / instructions</a></p>

		<script
		  src="https://code.jquery.com/jquery-3.3.1.min.js"
		  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
		  crossorigin="anonymous"></script>
		<script type="text/javascript" src="assets/js/script.js"></script>
	</body>
</html>
