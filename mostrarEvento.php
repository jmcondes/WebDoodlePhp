
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doodle</title>

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/local.css" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>   

      <style>

        div {
            padding-bottom:20px;
        }

    </style>
</head>
<body>

    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.html">Back to Home</a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li><a href="home.html"><i class="fa fa-tasks"></i> Home</a></li>
                    <li><a href="crearUsuario.html"><i class="fa fa-list-ol"></i> Crear Usuario</a></li>
                    <li><a href="crearEvento.php"><i class="fa fa-list-ol"></i> Crear Evento</a></li>
                    <li class="active"><a href="mostrarEvento.php"><i class="fa fa-tasks"></i> Mostrar Eventos</a></li>
					<li><a href="mostrarUsuariosEventos.php"><i class="fa fa-tasks"></i> Mostrar Invitados</a></li> 
                </ul>
                
            </div>
        </nav>

         <hr />
        <div class="container">
    <h3>Tabla con los eventos existentes</h3>
    <hr>
    <div class="row">
        <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h3 class="panel-title">Eventos</h3>
                
            </div>
            <table class="table">
                <thead>
                    <tr class="filters">
                        <th><input type="text" class="form-control" placeholder="#" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Descripción" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Fecha" disabled></th>
                    </tr>
                </thead>
                <tbody>
					<?php
				
					include_once("ficherosPhp/doodle.php");
					
					$userObject = new Usuarios();
							   
					$res = $userObject->getEventos();
					while($fila = mysqli_fetch_assoc($res)){
						$idEvento = $fila["id_evento"];
						$descripcion = $fila["descripcion"];
						$fecha = $fila["fecha"];
						echo "<tr>
								<td width='15%'>".$idEvento."</td>
								<td width='60%'>".$descripcion."</td>
								<td width='25%'>".$fecha."</td>
 
							</tr>";
					}                 
					?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
