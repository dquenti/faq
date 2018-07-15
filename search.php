<?php $filename = basename(__FILE__, '.php'); ?>
<?php if (isset($_GET["dtq"])) {
  $unwanted_array = array(    'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                              'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
                              'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
                              'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
                              'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y' );
  $dtq = $_GET["dtq"];
  $dtq = strtr( $dtq, $unwanted_array );
  } ?>
<?php
include ("controller.php");
header('Content-Type: text/html, charset=utf-8');
?>
<style>
.dataTables_wrapper .myfilter .dataTables_filter {
    float:left
}
.dataTables_wrapper .mylength .dataTables_length {
    float:right
}
</style>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Búsqueda</title>
  </head>
  <body class="container">
    <?php include ("header.php"); ?>
    <?php if (isset($_GET["deleted"])) {
      echo 'entrada eliminada correctamente';
    } ?>
    <!-- Buscar: <input type="text" name="" value="<?php if (isset($_GET["dtq"])) {echo $_GET["dtq"];} ?>" id="searchBox"> -->
    <form class="" action="search.php" method="GET">
      <label for="">Buscar: </label> <input type="text" id="" name="dtq" value='<?php if (isset($_GET["dtq"])) {echo $_GET["dtq"];} ?>'>
      <input type="submit" name="" value="Buscar">
    </form>
    <table id=searchResults class="display table table-responsive">
      <?php if (!isset ($_GET["q"]) ) {
        $data = searchResults($connection,"");
        if ($data == false) {
          echo "no hay resultados";
        }
        else if (count($data) == 1) {
          header('Location: view.php?action=viewEntry&id='. $data[0]["id"]);
        } else {
          echo '
          <thead>
            <th>Procemimiento / Examen</th>
            <th>Servicio</th>
            <th>Ubicación</th>
            <th>Toma de Hora</th>
            <th>observaciones</th>
            <th>Estado</th>
            <th>Código</th>
          </thead>';
          foreach ($data as $key) {
            echo '
            <tr>
              <td>
                <a href="view.php?action=viewEntry&id='.$key["id"].'">'.$key["procedimientoExamen"].'</a>
              </td>
              <td>
                '.$key["servicio"].'
              </td>
              <td>
                '.$key["ubicacion"].'
              </td>
              <td>
                '.$key["tomaHora"].'
              </td>
              <td>
                '.$key["observaciones"].'
              </td>
              <td>
                '.$key["state"].'
              </td>
              <td>
                '.$key["codigo"].'
              </td>
            </tr>
            ';
          }
          echo '
          </table>';
        }

      }
      else {
        echo 'Ingrese búsqueda';
      }
      ?>

  <?php include ("footer.php"); ?>
  </body>
  <script type="text/javascript">
  (function() {
  function removeAccents(data) {
    return data.replace(/έ/g, 'ε').replace(/ύ/g, 'υ').replace(/ό/g, 'ο').replace(/ώ/g, 'ω').replace(/ά/g, 'α').replace(/ί/g, 'ι').replace(/ή/g, 'η').replace(/\n/g, ' ').replace(/[çÇ]/g, 'c').replace(/[Ãã]/g, 'a').replace(/[Ẽẽ]/g, 'e').replace(/[ĨĨ]/g, 'i').replace(/[Õõ]/g, 'o').replace(/[Ũũ]/g, 'u').replace(/[áÁ]/g, 'a').replace(/[éÉ]/g, 'e').replace(/[íÍ]/g, 'i').replace(/[óÓ]/g, 'o').replace(/[úÚ]/g, 'u').replace(/[äÄ]/g, 'a').replace(/[ëË]/g, 'e').replace(/[ïÏ]/g, 'i').replace(/[öÖ]/g, 'o').replace(/[üÜ]/g, 'u').replace(/[àÀ]/g, 'a').replace(/[èÈ]/g, 'e').replace(/[ìÌ]/g, 'i').replace(/[òÒ]/g, 'o').replace(/[ùÙ]/g, 'u').replace(/[âÂ]/g, 'a').replace(/[êÊ]/g, 'e').replace(/[îÎ]/g, 'i').replace(/[ôÔ]/g, 'o').replace(/[ûÛ]/g, 'u').replace(/[Şş]/g, 's').replace(/ß/g, 'ss')
  }
  var searchType = jQuery.fn.DataTable.ext.type.search;
  searchType.string = function(data) {
    return !data ? '' : typeof data === 'string' ? removeAccents(data) : data;
  };
  searchType.html = function(data) {
    return !data ? '' : typeof data === 'string' ? removeAccents(data.replace(/<.*?>/g, '')) : data;
  };
}());

$(document).ready(function() {
  var table = $('#searchResults').DataTable({
    "oSearch": {"sSearch": "<?php echo $dtq; ?>"},
  "language": {
            "sProcessing":     "Procesando...",
"sLengthMenu":     "Mostrar _MENU_ registros",
"sZeroRecords":    "No se encontraron resultados",
"sEmptyTable":     "Ningún dato disponible en esta tabla",
"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
"sInfoPostFix":    "",
"sSearch":         "Buscar:",
"sUrl":            "",
"sInfoThousands":  ",",
"sLoadingRecords": "Cargando...",
"oPaginate": {
"sFirst":    "Primero",
"sLast":     "Último",
"sNext":     "Siguiente",
"sPrevious": "Anterior"
},
"oAria": {
"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
"sSortDescending": ": Activar para ordenar la columna de manera descendente"
}
        },
  dom:"tlp",
  "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
      if ( aData[5] == "NO SE REALIZA EN EL HOSPITAL" )
      {
          $('td', nRow).css('background-color', '#FFBBBB');
      }
      if (aData[5] == "NO SE REALIZA PARA TODOS LOS DIAGNÓSTICOS") {
        $('td', nRow).css('background-color', '#FFFFBB');
      }
      if (aData[5] == "NO CONFIRMADO") {
        $('td', nRow).css('background-color', '#FFBBFF');
      }

            }
});

  $('#searchBox').on('keyup', function() {
    table.search(jQuery.fn.DataTable.ext.type.search.string(this.value)).draw();
  });
});


  </script>
</html>
