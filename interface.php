<!doctype html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="assets/css/style.css">
		<title>Hitta tjänsten</title>
		<meta charset="utf-8" />
	</head>
	<body>
		<div class="overlay" id="overlay-load">
			<h1>Laddar ...</h1>
			<h1>Om denna text visas i mer än 10 sekunder, ladda då om hemsidan</h1>
		</div>
		<div class="overlay hidden" id="overlay-correct">
			<h1>Rätt svar</h1>
			<h1>Laddar in nästa tjänst…</h1>
		</div>
		<div class="overlay hidden" id="overlay-info">
		<h2>Instruktionener</h2>
		<p>I det här testet kommer du få para ihop tjänster med kategorier. En uppsättning tjänster kommer presenteras för dig. Din uppgift är att för varje tjänst klicka på den kategori där du tycker tjänster hör hemma. Testet består av två delar. I den första delen av testet kommer kategorierna bestå av namn, t.ex. 'underhållning' eller 'hälsa'. I den andra delen av testet kommer kategorierna bestå av kartor. Då ska du istället välja den karta du tycker passar bäst för tjänsten. Välj den kategori eller karta du tycker känns bäst. Vilken del av testet du börjar med är slumpmässigt. Testet går inte på tid. Lycka till!</p>
			<p><a href="#" class="close">(close)</a></p>
		</div>
		<div class="progress"></div>
		<div class="container">
			<div>
				<img class="app-image" src="">
				<h1 class="app-name"></h1>
				<p class="app-description"></p>
			</div>
			<div>
			<?php if ($_GET["version"] == "category") : ?>
				<h1>I vilken kategori förväntar du dig att hitta tjänsten?</h1>
				<button data-target-id="1">Handla</button>
				<button data-target-id="2">Hem/Vardag</button>
				<button data-target-id="3">Transport/Resor</button>
				<button data-target-id="4">Socialt</button>
				<button data-target-id="5">Träning & Hälsa</button>
				<button data-target-id="6">Underhållning</button>
			<?php elseif ($_GET["version"] == "map") : ?>
				<h1>På vilken karta tycker du tjänsten hör hemma?</h1>
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
		<p class="footer"><a href="#" class="info">Hjälp</a></p>

		<script
		  src="https://code.jquery.com/jquery-3.3.1.min.js"
		  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
		  crossorigin="anonymous"></script>
		<script type="text/javascript" src="assets/js/script.js"></script>
	</body>
</html>
