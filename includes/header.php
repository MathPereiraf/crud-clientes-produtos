<?php
if (!isset($pageTitle)) { $pageTitle = 'CRUD'; }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo htmlspecialchars($pageTitle); ?></title>
  <link rel="stylesheet" href="/crud_clientes_produtos/public/style.css">
</head>
<body>
<div class="container">
  <header>
    <h1><?php echo htmlspecialchars($pageTitle); ?></h1>
  </header>
  <?php include __DIR__ . '/menu.php'; ?>
  <main>
