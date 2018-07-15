<?php $filename = basename(__FILE__, '.php'); ?>
<?php include ("controller.php") ?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body class="container">
    <?php include ("header.php"); ?>
    <?php if (!isset($_SESSION['user']) || ($_SESSION['user_type'] != 1)) {header('Location: index.php');} ?>
    <?php if (isset ($_GET["added"]) && $_GET["added"] == "true") {
      echo "Entrada Agegada Correctamente";
    } ?>
    <form class="" action="add.php" method="GET">
      <label for="">Procedimiento / Examen: </label> <input type="text" name="procedimientoExamen" value=""><br>
      <label for="">Servicio: </label> <input type="text" name="servicio" value=""><br>
      <label for="">Ubicación: </label> <input type="text" name="ubicacion" value=""><br>
      <label for="">Toma de Hora: </label> <input type="text" name="tomaHora" value=""><br>
      <label for="">observaciones: </label> <input type="text" name="observaciones" value=""><br>
      <label for="">Estado: </label>
      <select class="" name="state">
        <option value="1">Correcto</option>
        <option value="2">No Confirmado</option>
        <option value="3">No se Realiza en el Hospital</option>
        <option value="4">No se Realiza para Todos los Diagnósticos</option>
      <label for="">Código: </label> <input type="text" name="codigo" value=""><br>
      </select><br>
      <input type="hidden" name="added" value="true">
      <input type="hidden" name="action" value="addEntry">
      <input type="submit" name="" value="Agregar">
    </form>
  <?php include ("footer.php"); ?>
  </body>
</html>
