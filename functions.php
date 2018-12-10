<?php
include("db.php");

function get_random_app($exclude_array = array()) {
	$app_list = json_decode(file_get_contents("assets/json/applist.json"), true);
	
	shuffle($app_list);
	
	foreach ($app_list as $app) {
		if (!in_array($app["id"], $exclude_array)) {
			global $link;
			$return_array = $app;
			
			$result = mysqli_query($link, "
				SELECT COUNT(`id`) as 'count', `target_id`, `target_type`
				  FROM `lucs_fu_entries`
				 WHERE `target_type` = 'map'
				 	&& `attempt` = 1
				 	&& `app_id` = " . mysqli_real_escape_string($link, $app["id"]) . "
				 GROUP BY `target_id`, `target_type`
				 ORDER BY `count` DESC
				 LIMIT 1
			");
			
			if ($result) {
				$data = $result->fetch_array();
				
				$return_array["correctTargetId"]["map"] = $data["target_id"];
			}
			
			$result = mysqli_query($link, "
				SELECT COUNT(`id`) as 'count', `target_id`, `target_type`
				  FROM `lucs_fu_entries`
				 WHERE `target_type` = 'category'
				 	&& `attempt` = 1
				 	&& `app_id` = " . mysqli_real_escape_string($link, $app["id"]) . "
				 GROUP BY `target_id`, `target_type`
				 ORDER BY `count` DESC
				 LIMIT 1
			");
			
			if ($result) {
				$data = $result->fetch_array();
				
				$return_array["correctTargetId"]["category"] = $data["target_id"];
			}
			
			return $return_array;
		}
	}
}

function save_entry($entry_data) {
	
	if (
		!isset($entry_data["session_id"]) ||
		!isset($entry_data["app_id"]) ||
		!isset($entry_data["target_id"]) ||
		!isset($entry_data["target_type"]) ||
		!isset($entry_data["attempt"]) ||
		!isset($entry_data["time_spent"]) ||
		!isset($entry_data["is_correct"]) ||
		!isset($entry_data["is_training"])
	) {
		return array("error" => "missing argument");
	}
	
	global $link;

	$result = mysqli_query(
		$link,
		"INSERT INTO `lucs_fu_entries` (
			`session_id`,
			`app_id`,
			`target_id`,
			`target_type`,
			`attempt`,
			`time_spent`,
			`is_correct`,
			`is_training`
		) values (
			'" . mysqli_real_escape_string($link, $entry_data["session_id"]) . "',
			'" . mysqli_real_escape_string($link, $entry_data["app_id"]) . "',
			'" . mysqli_real_escape_string($link, $entry_data["target_id"]) . "',
			'" . mysqli_real_escape_string($link, $entry_data["target_type"]) . "',
			'" . mysqli_real_escape_string($link, $entry_data["attempt"]) . "',
			'" . mysqli_real_escape_string($link, $entry_data["time_spent"]) . "',
			'" . mysqli_real_escape_string($link, $entry_data["is_correct"]) . "',
			'" . mysqli_real_escape_string($link, $entry_data["is_training"]) . "'
		)"
	);
	
	if ($result) {
		return true;
	} else {
		return array("error" => "db misconfiguration");
	}
}

function api($get_data = array()) {
	if (isset($get_data["function"])) {
		switch($get_data["function"]) {
			case "get_random_app":
				if (isset($get_data["exclude"])) {
					$exclude = explode(",", urldecode($get_data["exclude"]));
				} else {
					$exclude = array();
				}
				return get_random_app($exclude);
				break;
			
			case "save_entry":
				return save_entry(array(
					"session_id" => $get_data["session_id"],
					"app_id" => $get_data["app_id"],
					"target_id" => $get_data["target_id"],
					"target_type" => $get_data["target_type"],
					"attempt" => $get_data["attempt"],
					"time_spent" => $get_data["time_spent"],
					"is_correct" => $get_data["is_correct"],
					"is_training" => $get_data["is_training"]
				));
				break;
			default:
				return false;
				break;
		}
	} else {
		return false;
	}
}
?>
<?php /*
<pre>
<?php //print_r(get_random_app()); ?>
</pre>

<pre>
<?php //print_r(save_entry()); ?>
</pre>
*/ ?>



/*testkommentar*/