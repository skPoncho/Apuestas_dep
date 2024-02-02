
<?php

include_once('./Classes/Catalogo.class.php');
$catalogo = new Catalogo();

 ?>
<html >
<head>
	<title>Tipo apuesta</title>

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
					<form class="form-horizontal"  id="Inserta_tipo"  onsubmit="return validar()">

						<br>
						<div class="row">
							<div class="col-2"></div>
							<div class="col-md-6 col-sm-6 col-xs-6  control-label">Tipo apuesta</div>
						</div>
						<br>
						<div class="form-group form-group-sm">
							<label class="col-md-2 col-sm-2 col-xs-2  control-label" for="nombre">*Descripción:</label>
							<div class="col-md-4 col-sm-4 col-xs-4"><input type="text" class="form-control"  id="descripcion" name="descripcion"  value="" required="required"/></div>
						</div>


						<div class="form-group form-group-sm">
							 <div class="col-md-2 col-sm-2 col-xs-2">
							 </div>
							 <div class="col-md-6 col-sm-6 col-xs-6">
								 <button type="submit" class="btn btn-default btn-xs" id="guardar">Guardar</button>
							 </div>
						</div>
            <div class="form-group form-group-sm">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <table class="table table-striped table-bordered" id="tipos_tabla" style="width:100%;margin-bottom: 0px !important;">
                <thead>
                  <th>Id</th>
                  <th>Apuesta</th>
                </thead>
                <tbody>
                  <?php $result = $catalogo->obtenerLista(" SELECT * from  tipoapuesta a ");

                      while ($row = mysqli_fetch_array($result)){
                        echo "<tr>";

                          echo "<td>".$row['IdTipoApuesta']."</td>";
                          echo "<td>".$row['Descripcion']."</td>";


                        echo "</tr>";
                      } ?>
                </tbody>
              </table>
            </div>
            </div>

					</form>




					</div>

</body>
<script type="text/javascript">

$(document).ready(function () {

      var table = $('#tipos_tabla').DataTable({
        "aLengthMenu": [
                    [5, 10, 20],
                    [5, 10, 20] // change per page values here
                ],
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
        },
        "order": [
            [1, "asc"]
        ],

        "scrollX": "0px",
        "responsive": false,
        "pageLength": 5,
        "scrollY": "370px",
        "scrollCollapse": true,
        "paging": true
        //"ordering": false
      });

  });


$( "#guardar" ).click(function( event ) {
  var descripcion = $('#descripcion').val();

  $.post("Inserta_tipo.php", {
          descripcion: descripcion

      }, function(data) {
        console.log("trae : "+data);
        if(data.indexOf("error") >= 0){
            alert("Ocurrio un error");
        }else{

          $("#cerrar_nuevoasunto").click();
        }

      });
});
function validar(){

    if (document.getElementById("tipo_apuesta").value != "" )
    {

      return true;
    }
    else
    {
      alert("Revisa tus datos");
      return false;
    }
  }


</script>

</html>
