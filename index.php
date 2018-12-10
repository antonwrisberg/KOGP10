<!doctype html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="assets/css/style.css">
		<title>Smarta Kartor prototyp</title>
		<meta charset="utf-8" />
	</head>
	<body>
		<div class="intro-text">
			<h1>Välkommen!</h1>
			<h2>Introduktion: </h2>
			<p>Detta testet går ut på att hitta vilka kategorier som hör ihop med vilka tjänster. När testet startar kommer du att få en tjänst och får sedan i uppgift att klicka på vilken kategori som denna tjänst tillhör. I en del av testet kommer kategorierna stå i textform och ha olika teman så som Underhållning eller Hälsa. I den andra delen av testet kommer kategorierna ej vara i text eller beröra något tema. Du kommer istället bli presenterad ett antal kartor som föreställer olika platser av olika storlekar så som en planritning av ett hem eller en karta över världen. Din uppgift blir då att fundera i linje med “Var hör denna tjänsten hemma”? Sedan ska du välja den karta som du tycker bäst passar ihop med den tjänsten som du har givits. Lycka till!</p>
			<p>Tryck här för att påbörja testet: <a href="interface.php?session_id=<?php echo uniqid(); ?>&version=<?php echo (rand(0,1) == 1 ? "category" : "map"); ?>&cycle=initial">Start</a></p>
		</div>
	</body>
</html>
