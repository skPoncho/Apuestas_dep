<?php

include_once('./Classes/Catalogo.class.php');
$catalogo = new Catalogo();
    $Year = date("Y");
    $Fecha = "";
    $idact_entregable = "";
    $tipo_apuesta = "";
    $idanio_entregable = "";
    $insumos = "";
    $stake  = "";

  	if (isset($_POST['Fecha']) ){ $Fecha = $_POST['Fecha'];}
    if (isset($_POST['tipo_apuesta']) ){ $tipo_apuesta = $_POST['tipo_apuesta'];}
    if (isset($_POST['momio']) ){ $momio = $_POST['momio'];}
    if (isset($_POST['monto']) ){ $monto = $_POST['monto'];}
    if (isset($_POST['cobro']) ){ $cobro = $_POST['cobro'];}
    if (isset($_POST['ganancia']) ){ $ganancia = $_POST['ganancia'];}
    if (isset($_POST['liga']) ){ $liga = $_POST['liga'];}
    if (isset($_POST['comentarios']) ){ $comentario = $_POST['comentarios'];}
    if (isset($_POST['stake']) ){ $stake = $_POST['stake'];}


    if($tipo_apuesta != "" && $Fecha != "" ){

      //  echo "hola";

            $insert = "INSERT INTO apuestas
            (Fecha, Tipo_Apuesta, Stake,Momio, Monto, Cobro, Ganancia, Liga,Comentario)
            VALUES ('".$Fecha."', ".$tipo_apuesta.",".$stake.", ".$momio.", ".$monto.", ".$cobro.",".$ganancia.",'".$liga."','".$comentario."' );";
            echo "insert : ".$insert;
            $ID_NUEVO = $catalogo->insertarRegistro($insert);
          //  echo "resultado : ".$ID_NUEVO;







        if($ID_NUEVO > 0){
          echo 'Exito al guardar';
        }else{
          echo "ocurrio un error al insertar";
        }

    }else{
      echo "Hubo un error con los datos";
    }
 ?>
