<?php
	//Incluyo el fichero php donde está el método createUser()
	include_once("doodle.php");
		//Recojo los valores del formulario guardados en $POST
        $nombre=$_POST['nombre'];
        $psswd=$_POST['password'];
        $psswdrep=$_POST['passwordrep'];
		//Si las contraseñas coinciden se procede a llamar al método que inserta el usuario
        if ($psswd==$psswdrep){
			//Creamos un objeto para llamar al método del otro php
			$userObject = new Usuarios();
			//El método devuelve un boolean, dependiendo de si ha sido creado o no se manda un mensaje informativo
			$creado = $userObject->createUser($nombre,$psswd);
			if($creado){
				header('location:../crearUsuarioExito.html');
			}else{
				header('location:../CrearUsuarioError.html');
			}
				
		}
		else{
			header('location:../CrearUsuarioError.html');
			
		}
?>