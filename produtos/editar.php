<?php
$pageTitle = "Editar Produto";
require_once __DIR__ . "/../config.inc.php";

$id = (int)($_GET['id'] ?? 0);
$erro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = (int)($_POST['id'] ?? 0);
  $nome = trim($_POST['nome'] ?? '');
  $descricao = trim($_POST['descricao'] ?? '');
  $preco = (float)($_POST['preco'] ?? 0);
  $quantidade = (int)($_POST['quantidade'] ?? 0);

  if ($id <= 0 || $nome === '') {
    $erro = "Preencha os campos obrigatórios.";
  } else {
    $stmt = $conn->prepare("UPDATE produtos SET nome=?, descricao=?, preco=?, quantidade=? WHERE id=?");
    $stmt->bind_param("ssdii", $nome, $descricao, $preco, $quantidade, $id);
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
  $stmt = $conn->prepare("SELECT id, nome, descricao, preco, quantidade FROM produtos WHERE id=?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  $produto = $result->fetch_assoc();
  $stmt->close();
  if (!$produto) { header("Location: index.php"); exit; }
}

include __DIR__ . "/../includes/header.php";
if ($erro): ?><div class="alert error"><?= htmlspecialchars($erro) ?></div><?php endif; ?>
<form method="post">
  <input type="hidden" name="id" value="<?= (int)($produto['id'] ?? $id) ?>">
  <div class="form-row">
    <label>Nome</label>
    <input class="form-control" type="text" name="nome" value="<?= htmlspecialchars($produto['nome'] ?? '') ?>" required>
  </div>
  <div class="form-row">
    <label>Descrição</label>
    <textarea class="form-control" name="descricao" rows="4"><?= htmlspecialchars($produto['descricao'] ?? '') ?></textarea>
  </div>
  <div class="form-row">
    <label>Preço (R$)</label>
    <input class="form-control" type="number" step="0.01" min="0" name="preco" value="<?= htmlspecialchars((string)($produto['preco'] ?? 0)) ?>" required>
  </div>
  <div class="form-row">
    <label>Quantidade</label>
    <input class="form-control" type="number" step="1" min="0" name="quantidade" value="<?= htmlspecialchars((string)($produto['quantidade'] ?? 0)) ?>" required>
  </div>
  <button class="btn" type="submit">Atualizar</button>
  <a class="btn secondary" href="index.php">Cancelar</a>
</form>
<?php include __DIR__ . "/../includes/footer.php"; ?>
