<?php

include_once("Conexion.class.php");

/**
 * Description of Catalogo
 *
 * @author MAGG
 */
class Catalogo {

    private $empresa;
    private $log;
    private $tipo;
    private $tabla;
    private $accion;

    public function multiQuery($consultas) {
        $array_consultas = split(";", $consultas);
        $conexion = new Conexion();
        if (isset($this->empresa)) {
            $conexion->setEmpresa($this->empresa);
        }
        $conexion->Conectar();
        $resultado = "1";
        foreach ($array_consultas as $consulta) {
            if ($consulta == "") {
                continue;
            }
            echo "Ejecutando: $consulta ...<br/>";
            $resultado = $conexion->Ejecutar($consulta);
            echo "Respuesta: $resultado<br/><br/>";
            if ($resultado != "1") {
                break;
            }
            /* Guardamos los queries que se ejecutan (INSERT, DELETE y UPDATE) */
            $this->preparaLog($consulta);

            if ($this->log) {//Si se va a registrar un log
                if (isset($_COOKIE['idUsuario'])) {
                    $usuario = $_COOKIE['idUsuario'];
                } else {
                    /* Obtenemos el usuario que se pone por default segun los parametros globales */
                    $usuario = "1";
                    $conexion->Conectar(); //Como parametros cierra la conexion, se tiene que volver a abrir
                }
                $sesion = "";
                if(isset($_COOKIE['IdSession'])){
                    $sesion = $_COOKIE['IdSession'];
                }
                $consulta = "INSERT INTO c_log(IdQuery, Consulta, Fecha, IdUsuario, Tipo, Sesion) VALUES(0,'" . str_replace("'", "´", $consulta) . "',NOW(),$usuario,'$this->tipo','$sesion');";
                $conexion->Ejecutar($consulta);
            }
        }
        $conexion->Desconectar();
        return $resultado;
    }

    public function obtenerLista($consulta) {

        //echo "Entra en obtenerLista: ".$consulta;
        $conexion = new Conexion();
        /*if (isset($this->empresa)) {
            $conexion->setEmpresa($this->empresa);
            echo "<BR>NO ENTRA CONEXION: <BR>";
        }*/
        //echo "<BR>NO ENTRA CONEXION: <BR>";
        $conexion->Conectar();
        $query = $conexion->Ejecutar($consulta);
        /* Guardamos los queries que se ejecutan (INSERT, DELETE y UPDATE) */
        /*$this->preparaLog($consulta);

        if ($this->log) {//Si se va a registrar un log
            if (isset($_COOKIE['idUsuario'])) {
                $usuario = $_COOKIE['idUsuario'];
            } else {*/
                /* Obtenemos el usuario que se pone por default segun los parametros globales */
               /* $usuario = "1";
                $conexion->Conectar(); //Como parametros cierra la conexion, se tiene que volver a abrir
            }
            $sesion = "";
            if(isset($_COOKIE['IdSession'])){
                $sesion = $_COOKIE['IdSession'];
            }
            $consulta = "INSERT INTO c_log(IdQuery, Consulta, Fecha, IdUsuario, Tipo, Sesion) VALUES(0,'" . str_replace("'", "´", $consulta) . "',NOW(),$usuario,'$this->tipo','$sesion');";
            $conexion->Ejecutar($consulta);
        }*/
        //var_dump($query);
        $conexion->Desconectar();
        return $query;
    }

    public function ejecutaConsultaActualizacion($consulta, $tabla, $where) {
        //$estado = $this->obtenerEstadoAnterior($tabla, $where);
        //$estado2 = $this->obtieneDatosAnteriores($tabla, $where);
        $conexion = new Conexion();
        //if (isset($this->empresa)) {
            //$conexion->setEmpresa($this->empresa);
        //}

        $conexion->Conectar();
        $query = $conexion->Ejecutar($consulta);
        //echo $query;
        //if($query != "0"){
            /* Guardamos los queries que se ejecutan (INSERT, DELETE y UPDATE) */
            //$this->preparaLog($consulta);

            //if ($this->log) {//Si se va a registrar un log
                //if (isset($_COOKIE['idUsuario'])) {
                    //$usuario = $_COOKIE['idUsuario'];
                //} else {
                    /* Obtenemos el usuario que se pone por default segun los parametros globales */
                    //$usuario = "1";
                    //$conexion->Conectar(); //Como parametros cierra la conexion, se tiene que volver a abrir
                //}
                //$sesion = "";
                //if(isset($_COOKIE['IdSession'])){
                    //$sesion = $_COOKIE['IdSession'];
                //}
//                $consulta = "INSERT INTO c_log(IdQuery, Consulta, Fecha, IdUsuario, Tipo, Sesion) VALUES(0,'" . str_replace("'", "´", $consulta) . "',NOW(),$usuario,'$this->tipo','$sesion');";
//                $conexion->Ejecutar($consulta);
//                $idLog = mysql_insert_id();
                //$whereExploded = explode("=", $where);
                //$aux = "";
                /*if(isset($whereExploded[1])){
                       $aux = trim($whereExploded[1]," ");
                }
                $idLog = $this->insertaRegistroLog($consulta, $usuario, $where, $aux,$estado);
                $conexion->Conectar();
                $conexion->Ejecutar("INSERT INTO c_loganterior(IdEstadoAnterior, IdQuery, EstadoAnterior,DatosAnteriores) VALUES(0,$idLog,'$estado','$estado2');");
            }
        }*/
        $conexion->Desconectar();
        return $query;
    }




    public function insertarRegistro($consulta) {
        $conexion = new Conexion();
        /*if (isset($this->empresa)) {
            $conexion->setEmpresa($this->empresa);
        }*/
		$conexion->Conectar();
        //echo "<br>Entra insertar Registro ".$consulta."<br>";

        $id = $conexion->EjecutarInsert($consulta);
        //echo $id;
        //$id = mysqli_insert_id($link);
        //if($id!=NULL && $id!=0){
            /* Guardamos los queries que se ejecutan (INSERT, DELETE y UPDATE) */
            //$this->preparaLog($consulta);

            /*if ($this->log) {//Si se va a registrar un log
                if (isset($_COOKIE['idUsuario'])) {
                    $usuario = $_COOKIE['idUsuario'];
                } else {
                    /* Obtenemos el usuario que se pone por default segun los parametros globales */
                   /* $usuario = "1";
                    $conexion->Conectar(); //Como parametros cierra la conexion, se tiene que volver a abrir
                }
                $this->insertaRegistroLog($consulta, $usuario, "", $id,"");
            }  */
        //}
        $conexion->Desconectar();
		//echo 'id'.$id;
        return $id;
    }
	 public function insertarRegistroDos($consulta) {
        $conexion = new Conexion();
        /*if (isset($this->empresa)) {
            $conexion->setEmpresa($this->empresa);
        }*/
		$conexion->Conectar();
        echo "<br>Entra insertar Registro ".$consulta."<br>";
		$link=$conexion->getDB();
         $conexion->Ejecutar1($link,$consulta);
        $id = mysqli_insert_id($link);
        //if($id!=NULL && $id!=0){
            /* Guardamos los queries que se ejecutan (INSERT, DELETE y UPDATE) */
            //$this->preparaLog($consulta);

            /*if ($this->log) {//Si se va a registrar un log
                if (isset($_COOKIE['idUsuario'])) {
                    $usuario = $_COOKIE['idUsuario'];
                } else {
                    /* Obtenemos el usuario que se pone por default segun los parametros globales */
                   /* $usuario = "1";
                    $conexion->Conectar(); //Como parametros cierra la conexion, se tiene que volver a abrir
                }
                $this->insertaRegistroLog($consulta, $usuario, "", $id,"");
            }  */
        //}
        $conexion->Desconectar();
		echo 'id'.$id;
        return $id;
    }



    function satinizar_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = str_replace("'", "´", $data);
        return $data;
    }

    /* backup the db OR just a table */

    public function ejecutaConsultaActualizacionRegresandoFilas($consulta, $tabla, $where) {
        $estado = $this->obtenerEstadoAnterior($tabla, $where);
        $estado2 = $this->obtieneDatosAnteriores($tabla, $where);
        $conexion = new Conexion();
        if (isset($this->empresa)) {
            $conexion->setEmpresa($this->empresa);
        }

        $conexion->Conectar();
        $query = $conexion->EjecutarRegresandoFilasAfectadas($consulta);
        if($query != -1){
            /* Guardamos los queries que se ejecutan (INSERT, DELETE y UPDATE) */
            $this->preparaLog($consulta);
            if ($this->log && $query != 0) {//Si se va a registrar un log y hubo actualización
                if (isset($_COOKIE['idUsuario'])) {
                    $usuario = $_COOKIE['idUsuario'];
                } else {
                    /* Obtenemos el usuario que se pone por default segun los parametros globales */
                    $usuario = "1";
                    $conexion->Conectar(); //Como parametros cierra la conexion, se tiene que volver a abrir
                }
                $sesion = "";
                if(isset($_COOKIE['IdSession'])){
                    $sesion = $_COOKIE['IdSession'];
                }
//                $consulta = "INSERT INTO c_log(IdQuery, Consulta, Fecha, IdUsuario, Tipo, Sesion) VALUES(0,'" . str_replace("'", "´", $consulta) . "',NOW(),$usuario,'$this->tipo','$sesion');";
//                $conexion->Ejecutar($consulta);
//                $idLog = mysql_insert_id();
                $whereExploded = explode("=", $where);
                $aux = "";
                if(isset($whereExploded[1])){
                       $aux = trim($whereExploded[1]," ");
                }
                $idLog = $this->insertaRegistroLog($consulta, $usuario, $where, $aux,$estado);
                $conexion->Conectar();
                $conexion->Ejecutar("INSERT INTO c_loganterior(IdEstadoAnterior, IdQuery, EstadoAnterior,DatosAnteriores) VALUES(0,$idLog,'$estado','$estado2');");
            }
        }
        $conexion->Desconectar();
        return $query;
    }

    public function getEmpresa() {
        return $this->empresa;
    }

    public function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }

}

?>
