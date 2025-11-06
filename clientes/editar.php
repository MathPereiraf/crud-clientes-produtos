<?php
$pageTitle = "Editar Cliente";
require_once __DIR__ . "/../config.inc.php";

$id = (int)($_GET['id'] ?? 0);
$erro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = (int)($_POST['id'] ?? 0);
  $nome = trim($_POST['nome'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $telefone = trim($_POST['telefone'] ?? '');

  if ($id <= 0 || $nome === '' || $email === '') {
    $erro = "Preencha os campos obrigatórios.";
  } else {
    $stmt = $conn->prepare("UPDATE clientes SET nome=?, email=?, telefone=? WHERE id=?");
    $stmt->bind_param("sssi", $nome, $email, $telefone, $id);
    if ($stmt->execute()) {
      header("Location: index.php?ok=1");
      exit;
    } else {
      $erro = "Erro ao atualizar.";
    }
    $stmt->close();
  }
} else {
  if ($id <= 0) { header("Location: index.php"); exit; }
  $stmt = $conn->prepare("SELECT id, nome, email, telefone FROM clientes WHERE id=?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  $cliente = $result->fetch_assoc();
  $stmt->close();
  if (!$cliente) { header("Location: index.php"); exit; }
}

include __DIR__ . "/../includes/header.php";
if ($erro): ?><div class="alert error"><?= htmlspecialchars($erro) ?></div><?php endif; ?>
<form method="post">
  <input type="hidden" name="id" value="<?= (int)($cliente['id'] ?? $id) ?>">
  <div class="form-row">
    <label>Nome</label>
    <input class="form-control" type="text" name="nome" value="<?= htmlspecialchars($cliente['nome'] ?? '') ?>" required>
  </div>
  <div class="form-row">
    <label>E-mail</label>
    <input class="form-control" type="email" name="email" value="<?= htmlspecialchars($cliente['email'] ?? '') ?>" required>
  </div>
  <div class="form-row">
    <label>Telefone</label>
    <input class="form-control" type="text" name="telefone" value="<?= htmlspecialchars($cliente['telefone'] ?? '') ?>">
  </div>
  <button class="btn" type="submit">Atualizar</button>
  <a class="btn secondary" href="index.php">Cancelar</a>
</form>
<?php include __DIR__ . "/../includes/footer.php"; ?>
