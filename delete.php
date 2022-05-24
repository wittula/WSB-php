<?php
	session_start();
	include 'db_config.php';

	$imgID = $_GET['id'];

	if (!isset($imgID)) {
		header('Location: index.php');
	}

	$query = $db->query("DELETE FROM images WHERE id=".$imgID);

	if ($query) {
		$_SESSION['alertType'] = "success";
    	$_SESSION['message'] = "Obraz został usunięty z bazy danych.";
	} else {
		$_SESSION['alertType'] = "warning";
    	$_SESSION['message'] = "Nie udało się usunąć obrazu.";
	}

	header('Location: index.php?result');
?>