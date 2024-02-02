<?php

include_once('./Classes/Catalogo.class.php');
$catalogo = new Catalogo();
    $descripcion = "";

  	if (isset($_POST['descripcion']) ){ $descripcion = $_POST['descripcion'];}



    if($descripcion != "" ){

      //  echo "hola";

            $insert = "INSERT INTO tipoapuesta
            (Descripcion)
            VALUES ('".$descripcion."');";
            //echo "insert : ".$insert;
            $ID_NUEVO = $catalogo->insertarRegistro($insert);
        if($ID_NUEVO > 0){
          echo 'Exito al guardar';
        }else{
          echo "ocurrio un error al insertar";
        }

    }else{
      echo "Hubo un error con los datos";
    }
 ?>
