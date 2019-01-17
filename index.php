<!doctype html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="assets/css/style.css">
		<title>Lär oss kategorisera smartare!</title>
		<meta charset="utf-8" />
	</head>
	<body>
		<div class="intro-text">
			<h1>Välkommen!</h1>
			<h2>Introduktion</h2>
			<p>I det här testet kommer du få para ihop tjänster med kategorier. En uppsättning tjänster kommer presenteras för dig. Din uppgift är att för varje tjänst klicka på den kategori där du tycker tjänster hör hemma. Testet består av två delar. I den första delen av testet kommer kategorierna bestå av namn, t.ex. 'underhållning' eller 'hälsa'. I den andra delen av testet kommer kategorierna bestå av kartor. Då ska du istället välja den karta du tycker passar bäst för tjänsten. Välj den kategori eller karta du tycker känns bäst. Om ditt alternativ markeras rött, välj det alternativ som känns näst bäst. Fortsätt tills knappen blir grön. Vilken del av testet du börjar med är slumpmässigt. Testet går inte på tid. Lycka till!</p>
			<!-- <p><a class="start-button" href="interface.php?session_id=<?php echo uniqid(); ?>&length=5&version=<?php echo (rand(0,1) == 1 ? "category" : "map"); ?>&cycle=initial">Starta kort test</a></p>
			<p><a class="start-button" href="interface.php?session_id=<?php echo uniqid(); ?>&length=20&version=<?php echo (rand(0,1) == 1 ? "category" : "map"); ?>&cycle=initial">Starta hela testet</a></p> -->
			<p><a class="start-button" href="interface.php?session_id=<?php echo uniqid(); ?>&length=7&version=<?php echo (rand(0,1) == 1 ? "category" : "map"); ?>&cycle=initial">Starta testet</a></p>
		</div>
	</body>
</html>
