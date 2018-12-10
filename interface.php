<!doctype html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="assets/css/style.css">
		<title>Smarta Kartor prototyp</title>
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
		<h2>Instruktioner: </h2>
		<p>Detta testet går ut på att hitta vilka kategorier som hör ihop med vilka tjänster. När testet startar kommer du att få en tjänst och får sedan i uppgift att klicka på vilken kategori som denna tjänst tillhör. I en del av testet kommer kategorierna stå i textform och ha olika teman så som Underhållning eller Hälsa. I den andra delen av testet kommer kategorierna ej vara i text eller beröra något tema. Du kommer istället bli presenterad ett antal kartor som föreställer olika platser av olika storlekar så som en planritning av ett hem eller en karta över världen. Din uppgift blir då att fundera i linje med “Var hör denna tjänsten hemma”? Sedan ska du välja den karta som du tycker bäst passar ihop med den tjänsten som du har givits.</P>
			<p><a href="#" class="close">(close)</a></p>
		</div>
		<div class="container">
			<div>
				<h1>Hitta rätt kategori/karta för tjänsten!</h1>
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
