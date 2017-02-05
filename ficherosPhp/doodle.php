<?php
class Usuarios{

    public $id_user = null;
    //Función que crea y devuelve un objeto de conexión a la base de datos y chequea el estado de la misma.
    function conectarBD(){
            $server = "localhost";
            $usuario = "root";
            $pass = "root";
            $BD = "actividad_3_2";
            //variable que guarda la conexión de la base de datos
            $conexion = mysqli_connect($server, $usuario, $pass, $BD);
			mysqli_query($conexion,"SET NAMES 'utf8'");
            //Comprobamos si la conexión ha tenido exito
            if(!$conexion){
               echo 'Ha sucedido un error inesperado en la conexion de la base de datos<br>';
            }
            //devolvemos el objeto de conexión para usarlo en las consultas
            return $conexion;
    }
    /*Desconectar la conexion a la base de datos*/
    function desconectarBD($conexion){
            //Cierra la conexión y guarda el estado de la operación en una variable
            $close = mysqli_close($conexion);
            //Comprobamos si se ha cerrado la conexión correctamente
            if(!$close){
               echo 'Ha sucedido un error inexperado en la desconexion de la base de datos<br>';
            }
            //devuelve el estado del cierre de conexión
            return $close;
    }

    //Devuelve un array multidimensional con el resultado de la consulta
    function getArraySQL($sql){
        //Creamos la conexión
        $conexion = $this->conectarBD();
        //generamos la consulta
        if(!$result = mysqli_query($conexion, $sql)) die();

        $rawdata = array();
        //guardamos en un array multidimensional todos los datos de la consulta
        $i=0;
        while($row = mysqli_fetch_array($result))
        {
            //guardamos en rawdata todos los vectores/filas que nos devuelve la consulta
            $rawdata[$i] = $row;
            $i++;
        }
        //Cerramos la base de datos
        $this->desconectarBD($conexion);
        //devolvemos rawdata
        return $rawdata;
    }
    //inserta en la base de datos un nuevo registro en la tabla usuarios
    function createUser($nombre,$password){
		$creadoUsuario = false;
        //creamos la conexión
        $conexion = $this->conectarBD();
        //Escribimos la sentencia sql necesaria respetando los tipos de datos
        $sql = "insert into usuarios (nombre_usuario,password_usuario)
        values ('".$nombre."','".$password."')";
        //hacemos la consulta y la comprobamos
        $consulta = mysqli_query($conexion,$sql);
        if(!$consulta){
            echo "No se ha podido insertar un nuevo usuario en la base de datos<br><br>".mysqli_error($conexion);
        }
		else{
			$creadoUsuario = true;
		}
        //Desconectamos la base de datos
        $this->desconectarBD($conexion);
        //devolvemos el resultado de la consulta (true o false)
        return $creadoUsuario;
    }
	
	function nuevoEvento($descripcion,$fecha,$checkboxUsers){
		$conexion = $this->conectarBD();
		$creadoEvento = true;
		$eventid = 0;
		$sql = "INSERT INTO eventos (descripcion,fecha)
        values ('".$descripcion."','".$fecha."')";
        //hacemos la consulta y la comprobamos
        $consulta = mysqli_query($conexion,$sql);
        if(!$consulta){
            echo "No se ha podido insertar un nuevo usuario en la base de datos<br><br>".mysqli_error($conexion);
        }
		else{
			$eventid = mysqli_insert_id($conexion);
		}
		if(is_array($checkboxUsers)){
			while(list($key,$value) = each($_POST['checkbox'])) {

				$nombreUsuario = $value;
				$invitado = $this->invitarUsuario($nombreUsuario, $eventid);
				if(!$invitado){
					$creadoEvento = false;
				}
			}		
		}
		$this->desconectarBD($conexion);
		
		return $creadoEvento;
	}
	
	function invitarUsuario($nombreUsuario,$eventid){
		$conexion = $this->conectarBD();
		$invitado = true;
		$sql = "SELECT id_usuario FROM usuarios WHERE nombre_usuario = '".$nombreUsuario."';";
		$arrTemp = $this->getArraySQL($sql);
		$idUsuario = $arrTemp[0][0];
		$sql_insert = "INSERT INTO usuarios_eventos (id_evento, id_usuario, estado) VALUES(".$eventid.",".$idUsuario.",'No Apuntado');";
		$consulta = mysqli_query($conexion,$sql_insert);
        if(!$consulta){
            echo "No se ha podido invitar al usuario<br><br>".mysqli_error($conexion);
			$invitado = false;
        }
		return $invitado;
	}
    //obtiene toda la informacion de la base de datos
    function getAllInfo(){
        //Creamos la consulta
        $sql = "SELECT * FROM usuarios;";
        //obtenemos el array con toda la información
        return $this->getArraySQL($sql);
    }
    //obtiene el nombre del usuario cuyo ID user es el que se le asigna al objeto de la clase
    function getNombre(){
        //Creamos la consulta
        $sql = "SELECT nombre FROM usuarios WHERE id_usuario = ".$this->id_user.";";
        //obtenemos el array
        $data = $this->getArraySQL($sql);
        //obtenemos el primer elemento, ya que así no tenemos que extraerlo posteriormente
        return $data[0][0];
    }
    //obtiene los apellidos del usuario cuyo ID user es el que se le asigna al objeto de la clase
    function getPassword(){
        //Creamos la consulta
        $sql = "SELECT password FROM usuarios WHERE id_usuario = ".$this->id_user.";";
        //obtenemos el array
        $data = $this->getArraySQL($sql);
        //obtenemos el primer elemento, ya que así no tenemos que extraerlo posteriormente
        return $data[0][0];
    }
	
	function getUsuarios(){
		$conexion = $this->conectarBD();
		$sql = "SELECT nombre_usuario FROM usuarios;";
		$res = mysqli_query($conexion,$sql);
		return $res;
	}
	
	function getArrUsuarios(){
		$conexion = $this->conectarBD();
		$sql = "SELECT * FROM usuarios;";
		return $this->getArraySQL($sql);		
	}
	
	function getEventos(){
		$conexion = $this->conectarBD();
		$sql = "SELECT * FROM eventos;";
		$res = mysqli_query($conexion,$sql);
		return $res;
	}
	
	function getEventosUsuario($id_us){
		$conexion = $this->conectarBD();
		$sql = "SELECT * FROM eventos WHERE id_evento IN(SELECT id_evento FROM usuarios_eventos WHERE id_usuario =".$id_us.");";
		return $this->getArraySQL($sql);
	}

    // Comprueba si existe el usuario en la BBDD
    function checkUser($usuario, $password){
        $conexion = $this->conectarBD();
		$userRegistered = false;

        $sql = "SELECT id_usuario FROM usuarios WHERE nombre_usuario = '".$usuario."' and password_usuario = '".$password."' ;";

        $result = mysqli_query($conexion, $sql);

        if($row=mysqli_fetch_array($result, MYSQL_ASSOC)){   
          $this->id_user = $row['id_usuario'];
		  $userRegistered = true;
        }       
        //Desconectamos la base de datos
        $this->desconectarBD($conexion);
        return $userRegistered;
    }

    // obtiene el id del evento
    function getArrEvents(){
        $conn = $this->conectarBD();       
        $i=0;
        $arrEvents = null;       
        $sql = "SELECT * FROM eventos WHERE id_evento IN
						(SELECT id_evento FROM usuarios_eventos 
							WHERE id_usuario= ".$this->id_user." and fecha >= CURDATE());";
		$result = mysqli_query($conn, $sql);
		while($row=mysqli_fetch_array($result, MYSQL_ASSOC)){                       
			$arrEvents [$i]= array('id' =>  $row['id_evento'], 'description' => $row['descripcion'], 'date' => $row['fecha']);
			$i++;
        }

        $this->desconectarBD($conn);
        return  $arrEvents;
    }
	
	function registrarOpcion($id, $eventid, $option){
		$conn = $this->conectarBD();
		$registrado = false;
		$opt = "";
		switch($option){
			case "1":
				$opt = "Apuntado";
				break;
			case "0":
				$opt = "No Apuntado";
				break;
			case "2":
				$opt = "Duda";
				break;
		}
		$sql = "UPDATE usuarios_eventos SET estado = '".$opt."' WHERE id_evento = ".$eventid." AND id_usuario = ".$id.";";
		if(mysqli_query($conn, $sql)){
			$registrado = true;
		}
		return $registrado;
	}
	
	function getArrRespuesta($jsonencode){
		$jsonlogin = true;
		$jsontemp = $jsonencode[0];
		while($elem = current($jsontemp) && $jsonlogin){
			if(key($jsontemp)=='userid'){
				$jsonlogin = false;
			}
			next($jsontemp);
		}
		$arrResponse = null;
		if($jsonlogin){
			if($this->checkUser($jsonencode[0]->user,$jsonencode[0]->password)){
				$res = "ok";
				$mens = "conexion correcta";
				$arrResponse = array('response' => $res, 'userid' => $this->id_user, 'message' => $mens, 'events' => $this->getArrEvents() );
			}
			else{
				$res = "error";
				$mens = "error";
				$event = null;
				$arrResponse = array('response' => $res, 'userid' => $this->id_user, 'message' => $mens, 'events' => $event );
			}
		}
		else{
			if($this->registrarOpcion($jsonencode[0]->userid, $jsonencode[0]->eventid, $jsonencode[0]->option)){
				$res = "ok";
				$mens = "Opción registrada correctamente";
				$arrResponse = array('response' => $res, 'message' => $mens);
			}
			else{
				$res = "error";
				$mens = "La opción no se ha podido registrar";
				$arrResponse = array('response' => $res, 'message' => $mens);
			}
		}
		return $arrResponse;
	}
}

//Para hacer un ejemplo de funcionamiento vamos a realizar los siguientes pasos:
//
//1º Vamos a crear un objeto de la clase Usuarios
//2º Vamos a crear un nuevo usuario en la base de datos
//3º Vamos a obtener su Nombre, Apellido y email del usuario que acabamos de insertar en la base de datos

//--Creamos un objeto de la clase Usuarios
//$userObj = new Usuarios();
// //Insertamos un nuevo usuario en la base de datos
// $userObject->createUser("","");
// //Obtenemos los datos del usuario que acabamos de mostrar, como es el primer
// //elemento de la base de datos vamos a suponer que tiene como ID el número 1
// //En caso de que no fuese así deberiamos crearnos una función para obtener
// //el último id, esta función la dejo como ejercicio para aquellos que quiera practicar
// $userObject->id_user=1;
// //Obtenemos el nombre y lo mostramos por pantalla
// echo $userObject->getNombre()."<br>";
// //Obtenemos los apellidos y lo mostramos por pantalla
// echo $userObject->getPassword()."<br>";
?>
