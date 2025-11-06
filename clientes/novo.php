<?php
$pageTitle = "Novo Cliente";
require_once __DIR__ . "/../config.inc.php";

$erro = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nome = trim($_POST['nome'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $telefone = trim($_POST['telefone'] ?? '');

  if ($nome === '' || $email === '') {
    $erro = "Nome e e-mail são obrigatórios.";
  } else {
    $stmt = $conn->prepare("INSERT INTO clientes (nome, email, telefone) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $email, $telefone);
    if ($stmt->execute()) {
      header("Location: index.php?ok=1");
      exit;
    } else {
      $erro = "Erro ao salvar.";
    }
    $stmt->close();
  }
}

include __DIR__ . "/../includes/header.php";
if ($erro): ?><div class="alert error"><?= htmlspecialchars($erro) ?></div><?php endif; ?>
<form method="post">
  <div class="form-row">
    <label>Nome</label>
    <input class="form-control" type="text" name="nome" required>
  </div>
  <div class="form-row">
    <label>E-mail</label>
    <input class="form-control" type="email" name="email" required>
  </div>
  <div class="form-row">
    <label>Telefone</label>
    <input class="form-control" type="text" name="telefone">
  </div>
  <button class="btn" type="submit">Salvar</button>
  <a class="btn secondary" href="index.php">Cancelar</a>
</form>
<?php include __DIR__ . "/../includes/footer.php"; ?>
