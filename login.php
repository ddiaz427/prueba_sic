<?php
session_start();
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
        <div class="row">
            <div class="col-md-offset-4 col-md-4">
                <?php if(isset($_SESSION['mensaje_error'])){?>
                    <div class="alert alert-danger"><?php echo $_SESSION['mensaje_error'] ?></div>
                    <?php unset($_SESSION['mensaje_error'])?>
                <?php } ?>
                <h2 class="text-center">Por favor ingreses sus datos de acceso</h2>
                <form action="check-login.php" method="post">                           	
                    <div class="form-group">									
                        <input type="text" class="form-control" name="nombre_usuario" placeholder="Usuario" required>        
                    </div>							
                    <div class="form-group">        
                        <input type="password" class="form-control" name="contrasena" placeholder="Contraseña" required>       
                    </div>								    
                    <button type="submit" class="btn btn-success btn-block">Ingresar</button>
                </form>
            </div>
        </div>
    </div>
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
