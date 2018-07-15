<?php include ("controller.php") ?>
<?php $filename = basename(__FILE__, '.php'); ?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo $entry["procedimientoExamen"]; ?></title>
  </head>
  <body class="container">
    <?php include ("header.php"); ?>
    <?php if (!isset($_SESSION['user']) || ($_SESSION['user_type'] != 1)) {header('Location: index.php');} ?>
    <?php if (isset ($_GET["modified"]) && $_GET["modified"] == "true") {
      echo "Entrada Modificada Correctamente";
    } ?>
    <form class="" action="edit.php" method="GET">
      <label for="">Procedimiento / Examen: </label> <input type="text" name="procedimientoExamen" value="<?php echo $entry["procedimientoExamen"]; ?>"><br>
      <label for="">Servicio: </label> <input type="text" name="servicio" value="<?php echo $entry["servicio"]; ?>"><br>
      <label for="">Ubicación: </label> <input type="text" name="ubicacion" value="<?php echo $entry["ubicacion"]; ?>"><br>
      <label for="">Toma de Hora: </label> <input type="text" name="tomaHora" value="<?php echo $entry["tomaHora"]; ?>"><br>
      <label for="">Observaciones: </label> <input type="text" name="observaciones" value="<?php echo $entry["observaciones"]; ?>"><br>
      <label for="">Código: </label> <input type="text" name="codigo" value="<?php echo $entry["codigo"]; ?>"><br>
      <label for="">Estado: </label>
      <select class="" name="state">
        <option value="1">Correcto</option>
        <option value="2">No Confirmado</option>
        <option value="3">No se Realiza en el Hospital</option>
        <option value="4">No se Realiza para Todos los Diagnósticos</option>
      </select><br>
      <input type="hidden" name="modified" value="true">
      <input type="hidden" name="id" value="<?php echo $entry["id"]; ?>">
      <input type="hidden" name="action" value="editEntry">
      <input type="submit" name="" value="Modificar">
    </form>
    <a href="search.php?action=deleteEntry&deleted=tue&id=<?php echo $entry["id"]; ?>">Eliminar</a>
  <?php include ("footer.php"); ?>
  </body>
</html>
