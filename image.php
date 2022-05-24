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
			include 'db_config.php';

			$imgID = $_GET['id'];

			if (!isset($imgID)) {
				header('Location: index.php');
			}

			$query = $db->query("SELECT * FROM images WHERE id=".$imgID);

			if (mysqli_num_rows($query) == 0) { header('Location: index.php'); }

			while ($image = $query->fetch_array()) {

				$imgSrc = $image['image'];
				$imgName = $image['name'];
				$imgDate = $image['uploaded_on'];
			}

			?>

			<div class="preview text-center">
				<img class="img-fluid rounded" src="<?php echo $imgSrc ?>">
			</div>

			<h1>Informacje</h1>

			<dl class="row">
  				<dt class="col-sm-2">Nazwa:</dt>
					<dd class="col-sm-10"><?php echo $imgName ?></dd>

				<dt class="col-sm-2">Data zapisania:</dt>
					<dd class="col-sm-10"><?php echo $imgDate ?></dd>
			</dl>

			<div class="preview text-center">
				<a href="index.php" type="button" class="btn btn-primary">Powrót</a>

				<button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Usuń</button>
			</div>
			
			<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="deleteModalLabel">Usuwanie obrazu z bazy</h5>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Nie"></button>
			      </div>
			      <div class="modal-body">
			        <p>Czy na pewno chcesz usunąć obraz z bazy? Tej operacji nie można cofnąć!</p>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Nie</button>
			        <a href="delete.php?id=<?php echo $imgID ?>" type="button" class="btn btn-danger">Tak - usuń</a>
			      </div>
			    </div>
			  </div>
			</div>

		</div>
		
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	</body>
</html>

