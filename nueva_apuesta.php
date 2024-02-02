
<?php

include_once('./Classes/Catalogo.class.php');
$catalogo = new Catalogo();

 ?>
<html >
<head>
	<title>Opinion</title>

    <!-- Meta Data =========== -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <link rel="stylesheet" type="text/css" href="./css/index.css" />
  <link rel="stylesheet" type="text/css" href="./css/estilos.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
  <link href="./css/bootstrap-select.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="./js/bootstrap-select.js"></script>
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/highcharts-3d.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  <script src="./js/bootstrap/bootstrapValidator.js"></script>

</head>

<body >
				<br>
				<div>
					<form class="form-horizontal"  id="Inserta_Opinion"  onsubmit="return validar()">

						<br>
						<div class="row">
							<div class="col-2"></div>
							<div class="col-md-2 col-sm-2 col-xs-2  control-label">Apuesta</div>
						</div>
						<br>
						<div class="form-group form-group-sm">
							<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="nombre">*Fecha:</label>
							<div class="col-md-4 col-sm-4 col-xs-4"><input type="date" class="form-control"  id="Fecha" name="Fecha"  value="" required="required"/></div>
						</div>
						<br>
						<div class="form-group form-group-sm">
							<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="apaterno">*Tipo apuesta:</label>
              <div class="col-md-4 col-sm-4 col-xs-4" style="padding: 0px;">
                  <select id="tipo_apuesta" class="form-control" name="tipo_apuesta"  >
                    <option value="0">Seleccione una opción</option>
                    <?php
                    $resul_tp = $catalogo->obtenerLista("SELECT  * FROM tipoapuesta ");

                    while ($row_tp = mysqli_fetch_array($resul_tp)){

                      echo "<option value='".$row_tp['IdTipoApuesta']."' >".$row_tp['Descripcion']."</option>";
                    }

                     ?>

                  </select>
              </div>
						</div>
						<br>
            <div class="form-group form-group-sm">
							<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="amaterno">Stake:</label>
							<div class="col-md-4 col-sm-4 col-xs-4"><input type="number" class="form-control" step="0.01" id="stake" name="stake" value=""/></div>
						</div>
						<br>
						<div class="form-group form-group-sm">
							<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="amaterno">Momio:</label>
							<div class="col-md-4 col-sm-4 col-xs-4"><input type="number" class="form-control" step="0.01" id="momio" name="momio" value=""/></div>
						</div>
						<br>
						<div class="form-group form-group-sm">
							<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="correo">*Monto:</label>
							<div class="col-md-4 col-sm-4 col-xs-4"><input type="number" class="form-control" step="0.01" name="monto" id="monto"  required="required"/></div>
						</div>
						<br>
						<div class="form-group form-group-sm">
							<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="comentarios" id="d">*Cobro:</label>
							<div class="col-md-4 col-sm-4 col-xs-4"><input  type="number" class="form-control" step="0.01" name="cobro"  id="cobro" onkeyup="calcula()" required="required"/></div>
						</div>
						<br>
            <div class="form-group form-group-sm">
							<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="comentarios" >*Ganancia:</label>
							<div class="col-md-4 col-sm-4 col-xs-4"><input  type="number" class="form-control" name="ganancia" step="0.01" id="ganancia" required="required"/></div>
						</div>
						<br>
            <div class="form-group form-group-sm">
							<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="comentarios">*Liga:</label>
							<div class="col-md-4 col-sm-4 col-xs-4"><input  type="text" class="form-control" name="liga"  id="liga" required="required"/></div>
						</div>
						<br>
            <div class="form-group form-group-sm">
							<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="comentarios" >Comentario:</label>
							<div class="col-md-4 col-sm-4 col-xs-4"><input  type="text" class="form-control" name="comentarios"  id="comentarios" /></div>
						</div>
						<br>

						<div class="form-group form-group-sm">
							 <div class="col-md-2 col-sm-2 col-xs-2">
							 </div>
							 <div class="col-md-6 col-sm-6 col-xs-6">
								 <button type="submit" class="btn btn-default btn-xs" id="guardar">Guardar</button>
							 </div>
						</div>
					</form>
					</div>

</body>
<script type="text/javascript">
$( "#guardar" ).click(function( event ) {
  var fecha = $('#Fecha').val();
  var tipo_apuesta = $('#tipo_apuesta').val();
  var stake = $('#stake').val();
  var momio = $('#momio').val();
  var monto = $('#monto').val();
  var cobro = $('#cobro').val();
  var ganancia = $('#ganancia').val();
  var liga = $('#liga').val();
  var comentario = $('#comentarios').val();
  $.post("Inserta_apuesta.php", {
          Fecha: fecha,
          tipo_apuesta: tipo_apuesta,
          stake:stake,
          momio: momio,
          monto: monto,
          cobro: cobro,
          ganancia : ganancia,
          liga:liga,
          comentarios:comentario

      }, function(data) {
        console.log("trae  : "+data);
        if(data.indexOf("error") >= 0){
            alert("Ocurrio un error");
        }else{

          $("#cerrar_nuevoasunto").click();
        }

      });
});
function validar(){

    if (document.getElementById("tipo_apuesta").value != "" && document.getElementById("monto").value != "" &&document.getElementById("cobro").value != "" )
    {

      return true;
    }
    else
    {
      alert("Revisa tus datos");
      return false;
    }
  }

  function calcula(){
    var monto = $("#monto").val();
    var cobro = $("#cobro").val();

    var diferencia =  cobro -  monto;
    $("#ganancia").val(diferencia);
  }


</script>

</html>
