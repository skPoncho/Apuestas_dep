<?php

include_once('./Classes/Catalogo.class.php');
$catalogo = new Catalogo();

$Aplicacion="Apuestas ";


?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' /> -->
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

    <title>::.Asuntos.::</title>
</head>
<body>
  <div class="well well-sm" style="margin-bottom:0px;background-color: #25c418 !important;">
     <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Indicadores</a>
   </div>

  <?php
  $cons = " select (SELECT COUNT(*) total FROM apuestas ap1  ) as total ,
            (SELECT COUNT(*) total FROM apuestas ap2 WHERE ap2.Ganancia > 0) as total_ganados,
            (SELECT COUNT(*) total FROM apuestas ap2 WHERE ap2.Ganancia = 0) as total_nulo,
            (SELECT round(AVG(ap3.Momio),2) total FROM apuestas ap3 ) as cuota ";
  $resu= $catalogo->obtenerLista($cons);
  while ($rs = mysqli_fetch_array($resu)){
    $total_ = $rs['total'];
    $total_ganadas = $rs['total_ganados'];
    $total_nulo = $rs['total_nulo'];
    $total_ -= $total_nulo;
    $mom_prom = $rs['cuota'];
  }

  $perdidas = $total_ - $total_ganadas;
  $porcentaje_ganadas = ($total_ganadas * 100 ) / $total_;
  $porcentaje_ganadas = round($porcentaje_ganadas,2);

  $result = $catalogo->obtenerLista("  SELECT  par.Valor
                                       FROM parametros par
                                       where par.Descripcion = 'Bank'  ");
      while ($row = mysqli_fetch_array($result)){
        $bank = $row['Valor'];
      }
      $ben_stk1 = ($bank/10) * $mom_prom;
      $cant_ap_gan = $bank / $ben_stk1;
      $por_necesario  = round(($cant_ap_gan*100)/10,2);

   ?>
<div class="container-fluid">
  <div class="row">
    <div class="row">
      <div class="col-md-3 col-sm-3 col-xs-3 text-center"><h5>Apuestas : <b><?php echo $total_; ?></b> &nbsp;&nbsp;&nbsp; Gan:  <b style="color: rgb(91, 199, 69);"><?php echo $total_ganadas; ?>
      </b>  &nbsp;&nbsp;&nbsp; Per:  <b style="color: rgb(242, 50, 50);"><?php echo $perdidas; ?></b>
    </b>  &nbsp;&nbsp;&nbsp; Nulo:  <b ><?php echo $total_nulo; ?></b>
      <b>Victoria: % <?php echo $porcentaje_ganadas; ?></b><br>
      <b>Cuota prom: <?php echo $mom_prom; ?></b>&nbsp;&nbsp;&nbsp;
      <b> Porcentaje necesario : %<?php echo $por_necesario; ?> *con stake 1 plano</b>
     </h5></div>
      <div class="col-md-5 col-sm-5 col-xs-5 text-center" style="font-size: 21px;">Apuestas  <button type="button" class="btn btn-sm rounded-0 mr-1 btnNew " onclick="Nueva_apuesta();">Agregar <i style="font-size:18px;" class="fa fa-plus-square"></i></button></div>
      <div class="col-md-4 col-sm-4 col-xs-4"><button type="button" class="btn btn-sm rounded-0 mr-1 btnNew " onclick="Nuevo_tipo();">Nuevo tipo <i style="font-size:18px;" class="fa fa-plus-square"></i></button></div>

    </div>
    <legend id="AnioTitulo" style="text-align: center;margin-bottom:5px;"></legend>
  <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12" >


                    </div>
            </div>

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <center style="font-size : 13px;">Picks</center>
              <table class="table table-striped table-bordered" id="tabla_apuestas" style="width:100%;margin-bottom: 0px !important;font-size: .7em;">
                <thead>
                  <th>Fecha</th>
                  <th>Apuesta</th>
                  <th>Stake</th>
                  <th>Momio</th>
                  <th>Monto</th>
                  <th>Cobro</th>
                  <th>Ganancia</th>
                  <th>Liga</th>
                  <th>Comentario</th>
                </thead>
                <tbody>
                  <?php
                  $ganancia = 0;
                  $result = $catalogo->obtenerLista(" SELECT ap.* , tp.Descripcion  from  apuestas ap  JOIN tipoapuesta tp on tp.IdTipoApuesta = ap.Tipo_Apuesta ");

                      while ($row = mysqli_fetch_array($result)){
                        echo "<tr>";
                        $color = "";
                        if($row['Ganancia'] > 0 )
                          $color = 'style="background-color:#15ba12;color:white;"';
                          if($row['Ganancia'] < 0 )
                            $color = 'style="background-color:#cf2626;color:white;"';

                          echo "<td>".$row['Fecha']."</td>";
                          echo "<td>".$row['Descripcion']."</td>";
                          echo "<td>".$row['Stake']."</td>";
                          echo "<td>".$row['Momio']."</td>";
                          echo "<td> $ ".$row['Monto']."</td>";
                          echo "<td> $ ".$row['Cobro']."</td>";
                          echo "<td $color > $ ".$row['Ganancia']."</td>";
                          echo "<td>".$row['Liga']."</td>";
                          echo "<td>".$row['Comentario']."</td>";
                          $ganancia += $row['Ganancia'];
                        echo "</tr>";
                      }
                   ?>

                </tbody>
              </table>
            </div>
          </div>





        <br>
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6">
              <?php
              $result = $catalogo->obtenerLista("  select (SELECT MIN(ap1.Ganancia) total FROM apuestas ap1  ) as minimo ,
                        (SELECT MAX(ap2.Ganancia) FROM apuestas ap2 ) as maximo ");

                  while ($row = mysqli_fetch_array($result)){
                    $m_g = $row['maximo'];
                    $p_ap = $row['minimo'];
                  }
                  $ganador_liga = 0;
                  $perdedora_liga = 0;
                  $result = $catalogo->obtenerLista("  SELECT  count(ap.IdApuesta) AS total,ap.Liga,
                                                      (SELECT COUNT(ap1.IdApuesta) FROM apuestas ap1 WHERE ap1.Liga = ap.Liga AND ap1.Ganancia > 0) AS ganadoras,
                                                      (SELECT COUNT(ap1.IdApuesta) FROM apuestas ap1 WHERE ap1.Liga = ap.Liga AND ap1.Ganancia < 0) AS perdedoras,
                                                      (SELECT COUNT(ap1.IdApuesta) FROM apuestas ap1 WHERE ap1.Liga = ap.Liga AND ap1.Ganancia = 0) AS nula
                                                       FROM apuestas ap
                                                       GROUP BY ap.Liga ");
                      while ($row = mysqli_fetch_array($result)){
                        if($row['ganadoras'] > $ganador_liga){
                          $ganador_liga = $row['ganadoras'];
                          $liga_ganadora = $row['Liga']." $ganador_liga , ganadas de :  ".$row['total'] ;
                        }


                        if($row['perdedoras'] > $perdedora_liga){
                          $perdedora_liga = $row['perdedoras'];
                          $liga_perdedora = $row['Liga']." $perdedora_liga , perdidas de :  ".$row['total'];
                        }


                      }


               ?>
              <label class="col-md-12 col-sm-12 col-xs-12  control-label" for="d"><i class="fa fa-money" aria-hidden="true"></i> Bank inicial :<b> $ <?php echo $bank; ?></b></label><br>
              <label class="col-md-12 col-sm-12 col-xs-12  control-label" for="d"><i class="fa fa-money" aria-hidden="true"></i> Bank actual :<b> $ <?php echo $bank+$ganancia; ?></b></label><br>
              <label class="col-md-12 col-sm-12 col-xs-12  control-label" for="d" style="color:green;"><i class="fa fa-money" aria-hidden="true"></i> Beneficio :<b>  <?php echo -10+round(($bank+$ganancia)/($bank/10),1)." U "; ?> &nbsp;&nbsp;&nbsp; ,  <?php echo round(($ganancia*100) / $bank,2); ?> %  </b></label><br>
              <label class="col-md-12 col-sm-12 col-xs-12  control-label" for="d"><i class="fa fa-money" aria-hidden="true"></i> Ganancias :<b> $ <?php echo $ganancia; ?></b></label><br>
              <label class="col-md-12 col-sm-12 col-xs-12  control-label" for="d" style="color:green;"><i class="fa fa-money" aria-hidden="true"></i> Mayor ganancia :<b> $ <?php echo $m_g; ?></b></label><br>
              <label class="col-md-12 col-sm-12 col-xs-12  control-label" for="d" style="color:red;"><i class="fa fa-money" aria-hidden="true"></i> Peor apuesta :<b> $ <?php echo $p_ap; ?></b></label><br>
              <label class="col-md-12 col-sm-12 col-xs-12  control-label" for="d" ><i class="fa fa-money" aria-hidden="true"></i> Mejor liga :<b>  <?php echo $liga_ganadora; ?></b></label><br>
              <label class="col-md-12 col-sm-12 col-xs-12  control-label" for="d" ><i class="fa fa-money" aria-hidden="true"></i> Peor liga :<b>  <?php echo $liga_perdedora; ?></b></label><br>
              <label class="col-md-12 col-sm-12 col-xs-12  control-label" for="d" ><i class="fa fa-money" aria-hidden="true"></i> Stakes <b>  0.5 : <?php echo round($bank/20,1); ?>  , 1: <?php echo round($bank/10,1); ?>
                ,  2: <?php echo round($bank/10,1)*2; ?> , 3: <?php echo round($bank/10,1)*3; ?> , 5:  <?php echo round($bank/10,1)*5; ?>  </b></label><br>

            </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
              <table class="table table-striped table-bordered" id="tabla_dias" style="width:100%;margin-bottom: 0px !important;font-size: .7em;">
                <thead>
                  <th>Fecha</th>
                  <th>No apuestas</th>
                  <th>Monto</th>
                  <th>Cobro</th>
                  <th>Ganancia</th>
                </thead>
                <tbody>
                  <?php
                  $ganancia = 0;
                  $result = $catalogo->obtenerLista(" SELECT ap.Fecha,count(ap.IdApuesta) as numapuestas,SUM(ap.Monto) AS montos ,SUM(ap.Cobro) AS cobros,SUM(ap.Ganancia) AS ganancias from  apuestas ap  JOIN tipoapuesta tp on tp.IdTipoApuesta = ap.Tipo_Apuesta GROUP BY ap.Fecha ");

                      while ($row = mysqli_fetch_array($result)){
                        echo "<tr>";
                        $color = "";
                        if($row['ganancias'] > 0 )
                          $color = 'style="background-color:#15ba12;color:white;"';
                          if($row['ganancias'] < 0 )
                            $color = 'style="background-color:#cf2626;color:white;"';

                          echo "<td>".$row['Fecha']."</td>";
                          echo "<td>".$row['numapuestas']."</td>";
                          echo "<td> $ ".$row['montos']."</td>";
                          echo "<td> $ ".round($row['cobros'],2)."</td>";
                          echo "<td $color > $ ".round($row['ganancias'],2)."</td>";
                        echo "</tr>";
                      }
                   ?>

                </tbody>
              </table>
            </div>

          </div>
          <br>
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-6">

              </div>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <table class="table table-striped table-bordered" id="tabla_tiposapuestas" style="width:100%;margin-bottom: 0px !important;font-size: .7em;">
                  <thead>
                    <th>Tipo de apuesta</th>
                    <th>Numero apuestas</th>
                    <th>Ganadoras</th>
                    <th>Perdedoras</th>
                    <th>Winrate</th>
                    <th>Ganancias</th>
                  </thead>
                  <tbody>
                    <?php
                    $ganancia = 0;
                    $result = $catalogo->obtenerLista("  SELECT ap.Fecha,count(ap.IdApuesta) as numapuestas,tp.Descripcion ,
                                                       (SELECT COUNT(ap1.IdApuesta) FROM apuestas ap1 WHERE ap1.Tipo_Apuesta = ap.Tipo_Apuesta AND ap1.Ganancia > 0) AS ganadoras,
                                                        (SELECT COUNT(ap2.IdApuesta) FROM apuestas ap2 WHERE ap2.Tipo_Apuesta = ap.Tipo_Apuesta AND ap2.Ganancia < 0) AS perdedoras,
                                                        SUM(ap.Ganancia) AS ganancias from  apuestas ap
                                                       JOIN tipoapuesta tp on tp.IdTipoApuesta = ap.Tipo_Apuesta
                                                       GROUP BY ap.Tipo_Apuesta ");

                        while ($row = mysqli_fetch_array($result)){
                          echo "<tr>";
                          $color = "";
                          if($row['ganancias'] > 0 )
                            $color = 'style="background-color:#15ba12;color:white;"';
                            if($row['ganancias'] < 0 )
                              $color = 'style="background-color:#cf2626;color:white;"';
                              $porcentaje = round(($row['ganadoras']*100)/$row['numapuestas'],2);
                            echo "<td>".$row['Descripcion']."</td>";
                            echo "<td>".$row['numapuestas']."</td>";
                            echo "<td>".$row['ganadoras']."</td>";
                            echo "<td>".$row['perdedoras']."</td>";
                            echo "<td> % ".$porcentaje."</td>";
                            echo "<td> $ ".round($row['ganancias'],2)."</td>";
                          echo "</tr>";
                        }
                     ?>

                  </tbody>
                </table>
              </div>

            </div>

  </div>

  <!-- <div class="col-md-5 col-sm-5 col-xs-5">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12"  >
        <figure class="highcharts-figure"></figure>
        <div id="containerss" ></div>

      </div>
    </div>
    <div class="row" id="env_rec_inv">
      <div class="col-md-12 col-sm-12 col-xs-12"  >
        <figure class="highcharts-figure"></figure>
        <div id="containers2"></div>

      </div>
    </div>
    <div class="row" style="display : none;" id="grafica_invitados">
      <div class="col-md-12 col-sm-12 col-xs-12"  >
        <figure class="highcharts-figure"></figure>
        <div id="containers3"></div>

       <button type="button" name="button" onclick="regresa_grafica()">Regresar a gráfica principal</button>
      </div>
    </div>
  </div> -->



  <div style="top: 64px;" class="modal fade" id="modal_nuevoapuesta" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content" style="left: -62px;width: 624px;">
        <div class="modal-header h" style="padding: 7px 5px;">
          <button type="button" class="close" data-dismiss="modal" id="cerrar_nuevoasunto" onclick="window.location.reload(true);">&times;</button>
          <center>
            <span style="color:white;" id="titulo"></span>
          </center>
           <a style="color:white;text-decoration:none;" class="resul"></a>
        </div>

        <div class="modal-body detalle" style="padding: 5px 5px;">

        </div>

      </div>
      </div>
  </div>



</div>
</div>





</body>
<?php
// $grafica1 =array();
// $grafica2 =array();
// $grafica3 =array();
// $totalarea =  $total_enviados + $total_recibidos ;
// array_push($grafica1,"{ name: ' No invitado ', y: $total_ne_nr_ni ,key: 'otrareas'   , color : '#3f98d1'},");
// array_push($grafica1,"{ name: ' Invitados ', y: $total_invarea ,key: 'invitados_area'   , color : '#ded18b'},"); //#8bbdde
// array_push($grafica1,"{ name: ' $nombre  (enviados+recibidos)', y: $totalarea ,key: 'area'   , color : '#1d476e'},");
//
//
// array_push($grafica2,"{ name: ' Enviados ', y: $total_enviados ,key: 'enviados'   , color : '#d9d4d4'},");
// array_push($grafica2,"{ name: ' Recibidos ', y: $total_recibidos ,key: 'recibidos'   , color : '#91e64f'},");
// array_push($grafica2,"{ name: ' Invitados ', y: $total_invarea ,key: 'invitados'   , color : '#ded18b'},");
//
// $resu= $catalogo->obtenerLista("SELECT    con.idOrigen,ca.Nombre, count(con.idConversacion) total
//                            FROM k_conversacion con
//                            JOIN k_conversacionArea conva ON con.idConversacion = conva.idConversacion AND conva.idArea NOT IN (con.idOrigen,con.idDestino)
//                            JOIN c_area ca ON ca.Id_Area = con.idOrigen
//                           WHERE con.estatus NOT IN(3,4) AND  conva.idArea = $idejearea
//                           GROUP BY con.idOrigen");
// while ($r = mysqli_fetch_array($resu)){
//   array_push($grafica3,"{ name: ' ".$r['Nombre']." ', y: ".$r['total']." ,key: ''  },");
// }
 ?>
<script>

$(document).ready(function () {

    var form = "#formIntervalo";
    var controller = "Controller_intervalo.php";

      var table = $('#tabla_apuestas').DataTable({
        "aLengthMenu": [
                    [5, 10, 100],
                    [5, 10, 100] // change per page values here
                ],
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
        },
        "order": [
            [2, "asc"]
        ],

        "scrollX": "0px",
        "responsive": false,
        "pageLength": 5,
        "scrollY": "370px",
        "scrollCollapse": true,
        "paging": true
        //"ordering": false
      });
      var table = $('#tabla_dias').DataTable({
        "aLengthMenu": [
                    [5, 10, 100],
                    [5, 10, 100] // change per page values here
                ],
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
        },
        "order": [
            [0, "asc"]
        ],

        "scrollX": "0px",
        "responsive": false,
        "pageLength": 5,
        "scrollY": "370px",
        "scrollCollapse": true,
        "paging": true
        //"ordering": false
      });
      var table = $('#tabla_tiposapuestas').DataTable({
        "aLengthMenu": [
                    [5, 10, 100],
                    [5, 10, 100] // change per page values here
                ],
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
        },
        "order": [
            [0, "asc"]
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



$("#modal_nuevoasunto").draggable({
    handle: ".modal-header"
});

// Highcharts.chart('containerss', {
//   chart: {
//       plotBackgroundColor: null,
//       plotBorderWidth: null,
//       plotShadow: false,
//       type: 'pie'
//   },
//   title: {
//       text: 'Asuntos SIE'
//   },
//   accessibility: {
//       point: {
//           valueSuffix: '%'
//       }
//   },
//   plotOptions: {
//       pie: {
//           allowPointSelect: true,
//           cursor: 'pointer',
//           point: {
//             events: {
//
//             }
//           },
//           dataLabels: {
//               enabled: false
//           },
//           showInLegend: true
//       }
//   },
//   series: [{
//       name: '',
//       colorByPoint: true,
//       data: [
//         <?php
//           foreach ($grafica1 as $clave => $valor) {
//             echo  $valor;
//           }
//         ?>
//       ]
//   }]
// });
//
// Highcharts.chart('containers3', {
//   chart: {
//       type: 'pie',
//   },
//   title: {
//       text: nombrearea+'  es invitado por ',
//   },
//   series: [{
//       name: '',
//       data: [
//         <?php
//           foreach ($grafica3 as $clave => $valor) {
//             echo  $valor;
//           }
//         ?>
//       ]
//   }]
// });


function Nueva_apuesta(){


 $(".h").css('background-color',"#4d4d57");
 $("#modal_nuevoapuesta").modal({backdrop: false});
 let titulo = "Nueva apuesta";

 $("#titulo").html(titulo);

 $.post("nueva_apuesta.php",{}, function(data) {
   $(".detalle").html('');
   $(".detalle").html(data);
 });

}

function Nuevo_tipo(){
  $(".h").css('background-color',"#4d4d57");
  $("#modal_nuevoapuesta").modal({backdrop: false});
  let titulo = "Nuevo tipo apuesta";

  $("#titulo").html(titulo);

  $.post("nuevo_tipo.php",{}, function(data) {
    $(".detalle").html('');
    $(".detalle").html(data);
  });
}






</script>

</html>
