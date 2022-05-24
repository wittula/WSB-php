<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		
		<title>C Patryk Wittbrodt 50933</title>
	</head>
	
	<body>
		<div class="container">
			<?php 
			session_start();
			$result = isset($_GET['result']);

			if ($result) {
				$alertType = $_SESSION['alertType'];
				$statusMsg = $_SESSION['message'];

				echo '<div class="alert alert-'.$alertType.' alert-dismissible fade show" role="alert">'.$statusMsg;
				echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
				echo '</div>';
			}

			?>

			<form action="upload.php" method="post" enctype="multipart/form-data" class="input-group">
    			<input type="file" class="form-control" id="inputGroupFile" aria-describedby="inputGroupFileAddon" aria-label="Upload" name="file">
    			<button type="submit" name="submit" class="btn btn-dark" id="inputGroupFileAddon">Wyślij</button>
			</form>
			<div class="form-text">Maksymalny rozmiar pliku: 1MB</div>
			
			<h1>Galeria</h1>

			<div class="gallery rounded">
				<?php

				include 'db_config.php';
				$query = $db->query("SELECT * FROM images ORDER BY uploaded_on DESC");

				if (mysqli_num_rows($query) == 0) { echo '<h4>Galeria jest pusta</h4>'; }
				
				while ($image = $query->fetch_array()) {
					echo '<a href="image.php?id='.$image['id'].'"><img src="'.$image['image'].'" class="img-thumbnail float-start"></a>';
				}

				?>
			</div>
		</div>
		
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	</body>
</html>