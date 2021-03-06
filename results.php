<?php include("db.php"); ?>

<!doctype html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="assets/css/style.css">
		<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
		<title>Smarta Kartor prototyp</title>
		<meta charset="utf-8" />
	</head>
	<body>
<?php
		$result = mysqli_query($link, "
		SELECT 'first_attempt' as 'count_type', COUNT(`id`) as 'count', `target_type`
			FROM `lucs_fu_entries`
		 WHERE `session_id` = '" . mysqli_real_escape_string($link, $_GET["session_id"]) . "'
				&& `is_correct` = 1
				&& `attempt` = 1
		 GROUP BY `target_type`
		UNION
		SELECT 'total' as 'count_type', COUNT(`id`) as 'count', `target_type`
			FROM `lucs_fu_entries`
		 WHERE `session_id` = '" . mysqli_real_escape_string($link, $_GET["session_id"]) . "'
				&& `is_correct` = 1
		 GROUP BY `target_type`
		UNION
		SELECT 'avg_attempt' as 'count_type', ROUND(AVG(`attempt`), 1) as 'count', `target_type`
			FROM `lucs_fu_entries`
		 WHERE `session_id` = '" . mysqli_real_escape_string($link, $_GET["session_id"]) . "'
				&& `is_correct` = 1
		 GROUP BY `target_type`
		UNION
		SELECT 'time_spent' as 'count_type', ROUND(AVG(`time_spent`), 1) as 'count', `target_type`
			FROM `lucs_fu_entries`
		 WHERE `session_id` = '" . mysqli_real_escape_string($link, $_GET["session_id"]) . "'
				&& `is_correct` = 1
		 GROUP BY `target_type`
		");

		if ($result && $result->num_rows > 0) :

			$result_array = array();

			while($data = $result->fetch_array()) {
				$result_array[$data["count_type"]][$data["target_type"]] = $data["count"];
			}
?>
		<h1>Statistik för din omgång:</h1>
        <table>
            <tr>
                <th>Mätpunkt</th>
                <th>Kategorier</th>
                <th>Kartor</th>
            </tr>
            <tr>
                <td>Andel rätt på första försöket</td>
                <td><?php echo round($result_array["first_attempt"]["category"] / $result_array["total"]["category"] * 100, 2); ?>%</td>
                <td><?php echo round($result_array["first_attempt"]["map"] / $result_array["total"]["map"] * 100, 2); ?>%</td>
            </tr>
            <tr>
                <td>Tid spenderad (avg sekund pr tjänst)</td>
                <td><?php echo round($result_array["time_spent"]["category"] / 1000, 2); ?></td>
                <td><?php echo round($result_array["time_spent"]["map"] / 1000, 2); ?></td>
            </tr>
        </table>
<?php else : ?>
	<h1>Wrong or no session id</h1>
	<p>(… or something else went wrong?!)</p>
<?php endif; ?>

<p><a class="start-button" href="index.php">Ny testperson</a></p>

<h1>Generell statistik för testet:</h1>
        <table class="bigtable">
					<thead>
					<tr>
						<th rowspan="2">Tjänst</th>
						<th colspan="2">Rätt på första försöket</th>
						<th colspan="2">Försök för rätt</th>
						<th colspan="2">Tid för rätt</th>
					</tr>
					<tr>
						<td><em>Kateg.</em></td>
						<td><em>Kartor</em></td>
						<td><em>Kateg.</em></td>
						<td><em>Kartor</em></td>
						<td><em>Kateg.</em></td>
						<td><em>Kartor</em></td>
          </tr>
				</thead>
				<tbody>

<?php
$app_list = json_decode(file_get_contents("assets/json/applist.json"), true);

$sum = array(
	"count" => 0,
	"first_attempt" => array(
		"category" => 0,
		"map" => 0
	),
	"total" => array(
		"category" => 0,
		"map" => 0
	),
	"avg_attempt" => array(
		"category" => 0,
		"map" => 0
	),
	"time_spent" => array(
		"category" => 0,
		"map" => 0
	)
);

foreach ($app_list as $app) :
	$result = mysqli_query($link, "
	SELECT 'first_attempt' as 'count_type', COUNT(`id`) as 'count', `target_type`
		FROM `lucs_fu_entries`
	 WHERE `app_id` = '" . mysqli_real_escape_string($link, $app["id"]) . "'
			&& `is_correct` = 1
			&& `attempt` = 1
			&& `is_training` <> 1
	 GROUP BY `target_type`
UNION
  SELECT 'total' as 'count_type', COUNT(`id`) as 'count', `target_type`
		FROM `lucs_fu_entries`
	 WHERE `app_id` = '" . mysqli_real_escape_string($link, $app["id"]) . "'
			&& `is_correct` = 1
			&& `is_training` <> 1
	 GROUP BY `target_type`
UNION
  SELECT 'avg_attempt' as 'count_type', ROUND(AVG(`attempt`), 1) as 'count', `target_type`
		FROM `lucs_fu_entries`
	 WHERE `app_id` = '" . mysqli_real_escape_string($link, $app["id"]) . "'
			&& `is_correct` = 1
			&& `is_training` <> 1
	 GROUP BY `target_type`
UNION
  SELECT 'time_spent' as 'count_type', ROUND(AVG(`time_spent`), 1) as 'count', `target_type`
		FROM `lucs_fu_entries`
	 WHERE `app_id` = '" . mysqli_real_escape_string($link, $app["id"]) . "'
      && `is_correct` = 1
			&& `is_training` <> 1
	 GROUP BY `target_type`
	");

	if ($result) {
		$result_array = array();

		while($data = $result->fetch_array()) {
			$result_array["id"] = $app["id"];
			$result_array[$data["count_type"]][$data["target_type"]] = $data["count"];
		}

		if (!isset($result_array["first_attempt"]["category"])) {
			$result_array["first_attempt"]["category"] = 0;
		}

		if (!isset($result_array["first_attempt"]["map"])) {
			$result_array["first_attempt"]["map"] = 0;
		}

		$sum["count"] ++;
		$sum["first_attempt"]["category"] += (isset($result_array["first_attempt"]["category"]) ? $result_array["first_attempt"]["category"] : 0);
		$sum["first_attempt"]["map"] += (isset($result_array["first_attempt"]["map"]) ? $result_array["first_attempt"]["map"] : 0);
		$sum["total"]["category"] += (isset($result_array["total"]["category"]) ? $result_array["total"]["category"] : 0);
		$sum["total"]["map"] += (isset($result_array["total"]["map"]) ? $result_array["total"]["map"] : 0);
		$sum["avg_attempt"]["category"] += (isset($result_array["avg_attempt"]["category"]) ? $result_array["avg_attempt"]["category"] : 0);
		$sum["avg_attempt"]["map"] += (isset($result_array["avg_attempt"]["map"]) ? $result_array["avg_attempt"]["map"] : 0);
		$sum["time_spent"]["category"] += (isset($result_array["time_spent"]["category"]) ? $result_array["time_spent"]["category"] : 0);
		$sum["time_spent"]["map"] += (isset($result_array["time_spent"]["map"]) ? $result_array["time_spent"]["map"] : 0);
	}
?>
            <tr>
							<td><?php echo $app["name"]; ?></td>
              <td><?php echo (isset($result_array["total"]["category"]) ? round($result_array["first_attempt"]["category"] / $result_array["total"]["category"] * 100, 2) . "%" : "N/A"); ?></td>
							<td><?php echo (isset($result_array["total"]["map"]) ? round($result_array["first_attempt"]["map"] / $result_array["total"]["map"] * 100, 2) . "%" : "N/A"); ?></td>
							<td><?php echo (isset($result_array["avg_attempt"]["category"]) ? $result_array["avg_attempt"]["category"] : "N/A"); ?></td>
							<td><?php echo (isset($result_array["avg_attempt"]["map"]) ? $result_array["avg_attempt"]["map"] : "N/A"); ?></td>
							<td><?php echo (isset($result_array["time_spent"]["category"]) ? round($result_array["time_spent"]["category"] / 1000, 1) : "N/A"); ?></td>
							<td><?php echo (isset($result_array["time_spent"]["map"]) ? round($result_array["time_spent"]["map"] / 1000, 1) : "N/A"); ?></td>
            </tr>
<?php endforeach; ?>
<tr style="font-style:italic;font-weight:bold;opacity:.6">
	<td>Genomsnitt</td>
	<td><?php echo round($sum["first_attempt"]["category"] / $sum["total"]["category"] * 100, 2) . "%"; ?></td>
	<td><?php echo round($sum["first_attempt"]["map"] / $sum["total"]["map"] * 100, 2) . "%"; ?></td>
	<td><?php echo round($sum["avg_attempt"]["category"] / $sum["count"], 1); ?></td>
	<td><?php echo round($sum["avg_attempt"]["map"] / $sum["count"], 1); ?></td>
	<td><?php echo round($sum["time_spent"]["category"] / $sum["count"] / 1000, 0); ?></td>
	<td><?php echo round($sum["time_spent"]["map"] / $sum["count"] / 1000, 0); ?></td>
</tr>
					</tbody>
        </table>

<?php

$result = mysqli_query($link, "
SELECT `session_id`, `timestamp`, `time_spent`, `target_type`
	FROM `lucs_fu_entries`
 WHERE `is_correct` = 1
    && `is_training` <> 1
 ORDER
 		BY `session_id`, `timestamp`
");

if ($result && $result->num_rows > 0) :

	$result_array = array();

	while($data = $result->fetch_array()) {
		$result_array[$data['session_id']][$data['target_type']][] = $data['time_spent']; //array($data['timestamp'], $data['time_spent']);
	}
endif;

$stats = array();

foreach($result_array as $session_id) :
	foreach ($session_id as $target_type => $records) :
		foreach ($records as $index => $value) :
			$stats[$target_type][$index]['count'] ++;
			$stats[$target_type][$index]['sum'] += $value;
		endforeach;
	endforeach;
endforeach;

$data_points = array();

foreach ($stats as $target_type => $records) :
	foreach ($records as $index => $values) :
		if ($index < 7) :
			$data_points[$target_type][] = array("label" => ($index + 1), "y" => round(($values["sum"] / $values["count"]) / 1000, 2));
		endif;
	endforeach;
endforeach;
?>

<br />
<br />
<h1>Lärandeeffekt:</h1>
			<div id="chartContainer" style="height: 370px; width: 100%;"></div>

		<script
		  src="https://code.jquery.com/jquery-3.3.1.min.js"
		  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
		  crossorigin="anonymous"></script>
		<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript">
$(document).ready(function(){
	$('.bigtable').DataTable({
		paging: false,
		searching: false,
		info: false
	});
});
		</script>
		<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
		<script>
		window.onload = function () {

		var chart = new CanvasJS.Chart("chartContainer", {
			animationEnabled: true,
			exportEnabled: true,
			theme: "light1", // "light1", "light2", "dark1", "dark2"
			data: [{
				type: "column",
				name: "Kartor",
				showInLegend: true,
				dataPoints: <?php echo json_encode($data_points["map"], JSON_NUMERIC_CHECK); ?>
			},{
				type: "column",
				name: "Kategorier",
				showInLegend: true,
				dataPoints: <?php echo json_encode($data_points["category"], JSON_NUMERIC_CHECK); ?>
			}],
			axisX:{
				title: "Testnummer"
			},
			axisY:{
				title: "Tid för rätt (s)"
			}
		});
		chart.render();

		}
		</script>
	</body>
</html>
