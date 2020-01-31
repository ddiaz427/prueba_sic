<?php
session_start();
if(!$_SESSION['loggedin']){
	header("Location: login.php");
}
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Nueva encuesta</title>

	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-datepicker.css" rel="stylesheet">
	<link href="css/style_nav.css" rel="stylesheet">
</head>
<body>
	<nav class="navbar navbar-default">
	</nav>
	<div class="container">
		<div class="content">
			<h2>Nueva encuesta</h2>
			<hr />

			<?php
			if(isset($_POST['add'])){
				$numero_documento		     = mysqli_real_escape_string($con,(strip_tags($_POST["numero_documento"],ENT_QUOTES)));
				$email	 = mysqli_real_escape_string($con,(strip_tags($_POST["email"],ENT_QUOTES)));
				$comentarios	 = mysqli_real_escape_string($con,(strip_tags($_POST["comentarios"],ENT_QUOTES)));
				$marca_pc_id	     = mysqli_real_escape_string($con,(strip_tags($_POST["marca_pc_id"],ENT_QUOTES)));
				
				$insert = mysqli_query($con, "INSERT INTO encuestas( numero_documento, email, comentarios, marca_pc_id, fecha_respuesta, usuario_id)
													VALUES('$numero_documento', '$email', '$comentarios', '$marca_pc_id', NOW(), ".$_SESSION['id'].")") or die(mysqli_error());
				if($insert){
					echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>La encuesta se ha enviado con éxito.</div>';
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudo guardar los datos !</div>';
				}
				

			}
			?>

			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">No documento</label>
					<div class="col-sm-4">
						<input type="number" name="numero_documento" class="form-control" placeholder="" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Email</label>
					<div class="col-sm-4">
						<input type="email" name="email" class="form-control" placeholder="" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Comentarios</label>
					<div class="col-sm-3">
						<textarea name="comentarios" class="form-control" placeholder=""></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Estado</label>
					<div class="col-sm-3">
						<select name="marca_pc_id" class="form-control" required>
							<option value=""> Seleccione una marca </option>
							<?php 
							$sql = mysqli_query($con, "SELECT * FROM marcas_pc  ORDER BY descripcion ASC");
							while($row = mysqli_fetch_assoc($sql)){?>
							<option value="<?php echo $row['id']?>"><?php echo $row['descripcion']?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-primary" value="Guardar datos">
						<a href="index.php" class="btn btn-sm btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>

	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
