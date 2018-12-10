<?php
header('Content-Type: application/json');
include("functions.php");
echo json_encode(api($_GET));
?>