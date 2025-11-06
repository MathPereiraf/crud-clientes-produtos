<?php
require_once __DIR__ . "/../config.inc.php";
$id = (int)($_GET['id'] ?? 0);
if ($id > 0) {
  $stmt = $conn->prepare("DELETE FROM clientes WHERE id=?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $stmt->close();
}
header("Location: index.php");
exit;
