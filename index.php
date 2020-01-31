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
	<title>Sistema encuestas</title>

	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style_nav.css" rel="stylesheet">

	<style>
		.content {
			margin-top: 80px;
		}
	</style>

</head>
<body>
	<nav class="navbar navbar-default">
	</nav>
	<div class="container">
		<div class="content">
			<h2>Lista de encuestas</h2>
			<a href="add.php" class="btn btn-primary">Registrar encuesta</a>
			<hr />

			<?php
			if(isset($_GET['accion']) == 'delete'){
				$id = mysqli_real_escape_string($con,(strip_tags($_GET["id"],ENT_QUOTES)));
				$cek = mysqli_query($con, "SELECT * FROM encuestas WHERE id='$id'");
				if(mysqli_num_rows($cek) == 0){
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se encontraron datos.</div>';
				}else{
					$delete = mysqli_query($con, "DELETE FROM encuestas WHERE id='$id'");
					if($delete){
						echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Datos eliminado correctamente.</div>';
					}else{
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Error, no se pudo eliminar los datos.</div>';
					}
				}
			}
			?>
			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tr>
					<th>No documento</th>
					<th>Email</th>
					<th>Comentarios</th>
					<th>Marca favorita de PC</th>
					<th>Fecha respuesta</th>
					<th>Acciones</th>
				</tr>
				<?php
				$sql = mysqli_query($con, "SELECT * FROM encuestas WHERE usuario_id = '".$_SESSION['id']."' ORDER BY id DESC");
				if(mysqli_num_rows($sql) == 0){
					echo '<tr><td colspan="8">No hay datos.</td></tr>';
				}else{
					while($row = mysqli_fetch_assoc($sql)){?>
						<tr>
							<td><?php echo $row['numero_documento'] ?></td>
							<td><?php echo $row['email'] ?></td>
							<td><?php echo $row['comentarios'] ?></td>
							<td><?php echo $row['marca_pc'] ?></td>
							<td><?php echo $row['fecha_respuesta'] ?></td>
							<td>
								<a href="index.php?accion=delete&id=<?php echo $row['id']?>" title="Eliminar" onclick="return confirm('Esta seguro de borrar los datos <?php echo $row['nombres']?>?')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
							</td>
						</tr>
					<?php }
				}
				?>
			</table>
			</div>
		</div>
	</div>
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
