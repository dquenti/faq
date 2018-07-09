<?php include ("controller.php"); ?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php include ("header.php"); ?>
    <h1><?php echo $entry["procedimientoExamen"]; ?></h1>
    <h2>Servicio</h2>
    <?php echo $entry["servicio"]; ?>
    <h2>Ubicación</h2>
    <?php echo $entry["ubicacion"]; ?>
    <h2>Toma de Hora</h2>
    <?php echo $entry["tomaHora"]; ?>
    <h2>Observaciones</h2>
    <?php echo $entry["observaciones"]; ?>
    <h2>Comentarios</h2>
    <ul>
    <?php if ($comments == false) {
      echo 'sin comentarios';
    } else {
      foreach ($comments as $comment) {
        echo '<li>'.$comment["datetime"].': '.$comment["comment"].'</li>';
      }
    }
    ?>
    </ul>
    <h3>Agregar Comentario</h3>
    <form class="" action="view.php" method="get">
      <input type="text" name="addComment" value="">
      <input type="hidden" name="action" value="viewEntry">
      <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
      <input type="submit" name="" value="Comentar">
    </form>
    <p><a href="edit.php?action=editEntry&id=<?php echo $entry["id"]; ?>">Editar</a></p>
    <?php include ("footer.php"); ?>
  </body>
</html>