<?php
	//Incluyo el fichero php donde está el método createUser()
	include_once("doodle.php");
		//Recojo los valores del formulario guardados en $POST
        $nombre=$_POST['nombre'];
        $psswd=$_POST['password'];
		
		//Creamos un objeto para llamar al método del otro php
		$userObject = new Usuarios();
		//El método devuelve un boolean, dependiendo de si ha sido creado o no se manda un mensaje informativo
		$exists = $userObject->checkUser($nombre,$psswd);
		if($exists){
			header('location:../home.html');
		}else{
			header('location:../loginAlerta.html');
		}
?>