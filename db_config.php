<?php

$dbHost     = "";
$dbUsername = "";
$dbPassword = "";
$dbName     = "";

$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$createSQL = "CREATE TABLE IF NOT EXISTS `images` (
	`id` int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`name` varchar(200) NOT NULL,
	`image` longtext NOT NULL,
	`uploaded_on` datetime NOT NULL
)";

$db->query($createSQL);

?>