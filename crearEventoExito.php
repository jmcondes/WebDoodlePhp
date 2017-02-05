
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
                    <li class="active"><a href="crearEvento.php"><i class="fa fa-list-ol"></i> Crear Evento</a></li>
					<li><a href="mostrarEvento.php"><i class="fa fa-tasks"></i> Mostrar Eventos</a></li>
					<li><a href="mostrarUsuariosEventos.php"><i class="fa fa-tasks"></i> Mostrar Invitados</a></li> 
                </ul>
                
            </div>
        </nav>

       <div>
	   <div class="row text-center">
            <h2>Crea un Nuevo Evento</h2>
        </div>
	   <form action="ficherosPhp/crearEvento.php" method="post" enctype="multipart/form-data" name="creareventos">
        <div>
			<label class="col-md-2">

			</label>
			<div class="col-md-9">
				<div class="alert alert-dismissable alert-success">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Enhorabuena!</strong> Se ha creado el evento satisfactoriamente.
				</div>
			</div>
		</div>	
        <div>
            <label for="descripcion" class="col-md-2">
                Descripción del Evento:
            </label>
 
			<div class="col-md-9">
                            <textarea class="form-control" rows="3" name="descripcion" placeholder="Introduzca una breve descripción del evento"></textarea>
                        </div>
            <div class="col-md-1">
                <i class="fa fa-lock fa-2x"></i>
            </div>
        </div>        
        <div>
            <label for="fechaevento" class="col-md-2">
                Fecha del Evento:
            </label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="lastname" name="fechaevento" placeholder="Introduce la fecha del evento">
            </div>
             <div class="col-md-1">
                <i class="fa fa-lock fa-2x"></i>
            </div>
        </div>
		<div>
            <label class="col-md-2">
				Invitar Usuarios:
			</label>
			<div class="col-md-3">
			<?php
				
				include_once("ficherosPhp/doodle.php");
																
				$userObject = new Usuarios();
							   
				$res = $userObject->getUsuarios();
				while($fila = mysqli_fetch_assoc($res)){
					$nombre = $fila["nombre_usuario"];
					echo "<div class='checkbox'>
							<label>
								<input name='checkbox[]' type='checkbox' id='checkbox' value='".$nombre."'>"
								.$nombre.
							"</label>
						</div>";
				
				}
			?>          
				<div class="row">
					<button type="submit" class="btn btn-info">
						Crear Evento
					</button>
				</div>
			</div>			
		</div>	
		</form>
    </div>	
    </div>

</body>
</html>
