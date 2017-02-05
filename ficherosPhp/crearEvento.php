<?php

	include_once("doodle.php");
		
        $descripcion=$_POST['descripcion'];
        $fecha=$_POST['fechaevento'];
		$creadoEvento = false;
		$userObject = new Usuarios();
		if(isset($_POST['checkbox'])){
			$checkboxUsers = $_POST['checkbox'];
			$creadoEvento = $userObject->nuevoEvento($descripcion,$fecha,$checkboxUsers);
		}		
		
		if($creadoEvento){
			header('location:../crearEventoExito.php');
		}
		else{
			header('location:../crearEventoError.php');
		}
	?>