
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
                    <li><a href="mostrarEvento.php"><i class="fa fa-tasks"></i> Mostrar Eventos</a></li>
					<li class="active"><a href="mostrarUsuariosEventos.php"><i class="fa fa-tasks"></i> Mostrar Invitados</a></li> 
                </ul>
                
            </div>
        </nav>

         <hr />
        <div class="container">
    <h3>Tablas con los usuarios y eventos</h3>
    <hr>
	
    
	<?php
				
					include_once("ficherosPhp/doodle.php");
					
					$userObject = new Usuarios();
					$res_Usuarios = $userObject->getArrUsuarios();
					$filas = count($res_Usuarios);
					
					for($i=0;$i<$filas;$i++){
						
						$id_user = $res_Usuarios[$i]["id_usuario"];
						$nombre_user = $res_Usuarios[$i]["nombre_usuario"];
						$res_eventos_usuario = $userObject->getEventosUsuario($id_user);
						$filas_eventos = count($res_eventos_usuario);
						echo
								'<div class="row">
								<div class="panel panel-primary filterable">
									<div class="panel-heading">
									<h3 class="panel-title">Eventos de '.$nombre_user.'</h3>
						
									</div>
										<table class="table">
											<thead>
												<tr class="filters">
													<th><input type="text" class="form-control" placeholder='.$nombre_user.' disabled></th>
													<th><input type="text" class="form-control" placeholder="Descripción Evento" disabled></th>
													<th><input type="text" class="form-control" placeholder="Fecha Evento" disabled></th>
												</tr>
											</thead>
												<tbody>';
												
													for($j=0;$j<$filas_eventos;$j++){
							
														$event_description = $res_eventos_usuario[$j]["descripcion"];
														$event_date = $res_eventos_usuario[$j]["fecha"];
														echo
							
															'<tr>
																<td width="15%">				</td>
																<td width="60%">'.$event_description.'</td>
																<td width="25%">'.$event_date.'</td>
		 
															</tr>';
													}
						echo
											'</tbody>
										</table>
									</div>
								</div>';
						
						
					}
	?>
</div>

</body>
</html>
