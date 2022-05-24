<?php
session_start();
include 'db_config.php';
$statusMsg = '';
$alertType = '';

if (isset($_POST["submit"]) && !empty($_FILES["file"]["name"])) {
    $fileName = basename($_FILES["file"]["name"]);
    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $fileSize = $_FILES['file']['size'];

    $allowTypes = array('jpg','png','jpeg');

    if (in_array($fileType, $allowTypes)) {

        if ($fileSize < 1048576) {

            $image_base64 = base64_encode(file_get_contents($_FILES["file"]["tmp_name"]));
            $image = 'data:image/'.$fileType.';base64,'.$image_base64;

            $insert = $db->query("INSERT INTO images(name, image, uploaded_on) VALUES('".$fileName."', '".$image."', NOW())");

            if ($insert) {
                $alertType = "success";
                $statusMsg = "Plik ".$fileName. " został pomyślnie zapisany w bazie danych.";
            } else {
                $alertType = "warning";
                $statusMsg = "Zapisanie pliku nie powiodło się.";
            }

        } else {
            $alertType = "warning";
            $statusMsg = "Plik nie może ważyć więcej niż 1MB!";
        }

    } else {
        $alertType = "warning";
        $statusMsg = 'Obsługiwane rozszerzenia plików to .jpg, .jpeg oraz .png.';
    }
} else {
    $alertType = "warning";
    $statusMsg = 'Nie załączono żadnego pliku!';
}

if ($statusMsg != '' && $alertType != '') {
    $_SESSION['alertType'] = $alertType;
    $_SESSION['message'] = $statusMsg;

    header('Location: index.php?result');
}

?>