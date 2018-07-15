<?php
header('Content-Type: text/html; charset=utf-8');
include ("model.php");
include ("credentials.php");

$connection = connectMySQL($server,$user,$password,$db);

function listAll($connection) {
  $result = selectEntries($connection);
  $data = array();
  while ($row = $result->fetch_assoc())
  {
      $data[] = $row;

  }
  return $data;
}

function searchResults($connection,$searchQuery) {
  $searchResult = searchEntries($connection,$searchQuery);
  if ($searchResult->num_rows > 0) {
    while ($row = $searchResult->fetch_assoc())
    {
        $data[] = $row;

    }
    return $data;
  }
  else {
    return false;
  }
}

function commentsToArray() {
  global $connection;
  global $comments;
  $commentsResult = listAllComments($connection);
  if ($commentsResult->num_rows > 0) {
    while ($row = $commentsResult->fetch_assoc())
    {
        $comments[] = $row;

    }
    return $comments;
  }
}

if (isset($_GET["action"]) || isset($_GET["action2"]) || isset($_POST["action"])) {
  if (isset($_GET["action"]) && ($_GET["action"] == "addEntry")) {
    addEntry($_GET["procedimientoExamen"],$_GET["servicio"],$_GET["ubicacion"],$_GET["tomaHora"],$_GET["observaciones"],$connection,$_GET["state"],$_GET["codigo"]);

  }
  if (isset($_POST["action"]) && $_POST["action"] == "addUser") {
    addUser($_POST["user"],$_POST["name"],crypt($_POST["password"],"hcuch"),$_POST["type"],$connection);
  }
  if (isset($_GET["action"]) && $_GET["action"] == "editEntry") {
    if (isset ($_GET["procedimientoExamen"])) {
      editEntry($_GET["id"],$_GET["procedimientoExamen"],$_GET["servicio"],$_GET["ubicacion"],$_GET["tomaHora"],$_GET["observaciones"],$connection,$_GET["state"]);
    }
    if (isset ($_GET["id"])) {
      $result = viewEntry($_GET["id"],$connection);
      $entry = $result->fetch_assoc();
    }
  }
  if (isset($_GET["addComment"])) {
    addComment($_GET["id"],$_GET["addComment"],$connection,$_GET["user_id"]);
  }
  if (isset($_GET["action2"]) && $_GET["action2"] == "deleteComment") {
    deleteComment($_GET["comment_id"],$connection);
  }
  if (isset($_GET["action"]) && ($_GET["action"] == "viewEntry")) {
    $result = viewEntry($_GET["id"],$connection);
    $entry = $result->fetch_assoc();
    $commentsResult = listComments($_GET["id"],$connection);
    if ($commentsResult->num_rows > 0) {
      while ($row = $commentsResult->fetch_assoc())
      {
          $comments[] = $row;

      }
    }
    else {
      $comments = false;
    }
  }
  if (isset($_GET["action"]) && $_GET["action"] == "logout") {
    session_start();
    session_unset();
    session_destroy();
  }
  if (isset($_GET["action"]) && $_GET["action"] == "changePassword") {
    changePassword ($_GET["id"],crypt($_GET["newPassword"],"hcuch"),$connection);
  }
  if (isset($_GET["action"]) && $_GET["action"] == "deleteEntry") {
    deleteEntry($_GET["id"],$connection);
  }
}

 ?>
