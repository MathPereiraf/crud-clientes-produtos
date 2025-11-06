<?php
$pageTitle = "Novo Produto";
require_once __DIR__ . "/../config.inc.php";

$erro = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nome = trim($_POST['nome'] ?? '');
  $descricao = trim($_POST['descricao'] ?? '');
  $preco = (float)($_POST['preco'] ?? 0);
  $quantidade = (int)($_POST['quantidade'] ?? 0);

  if ($nome === '') {
    $erro = "Nome é obrigatório.";
  } else {
    $stmt = $conn->prepare("INSERT INTO produtos (nome, descricao, preco, quantidade) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssdi", $nome, $descricao, $preco, $quantidade);
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
    <label>Descrição</label>
    <textarea class="form-control" name="descricao" rows="4"></textarea>
  </div>
  <div class="form-row">
    <label>Preço (R$)</label>
    <input class="form-control" type="number" step="0.01" min="0" name="preco" required>
  </div>
  <div class="form-row">
    <label>Quantidade</label>
    <input class="form-control" type="number" step="1" min="0" name="quantidade" required>
  </div>
  <button class="btn" type="submit">Salvar</button>
  <a class="btn secondary" href="index.php">Cancelar</a>
</form>
<?php include __DIR__ . "/../includes/footer.php"; ?>
