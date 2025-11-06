<?php
$pageTitle = "Produtos";
require_once __DIR__ . "/../config.inc.php";
include __DIR__ . "/../includes/header.php";

$sql = "SELECT id, nome, descricao, preco, quantidade, criado_em FROM produtos ORDER BY id DESC";
$result = $conn->query($sql);
?>
<div class="toolbar">
  <a class="btn" href="novo.php">Novo Produto</a>
</div>
<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>Descrição</th>
      <th>Preço (R$)</th>
      <th>Qtd</th>
      <th>Criado em</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= (int)$row['id'] ?></td>
      <td><?= htmlspecialchars($row['nome']) ?></td>
      <td><?= htmlspecialchars($row['descricao']) ?></td>
      <td><?= number_format((float)$row['preco'], 2, ',', '.') ?></td>
      <td><?= (int)$row['quantidade'] ?></td>
      <td><?= htmlspecialchars($row['criado_em']) ?></td>
      <td class="actions">
        <a href="editar.php?id=<?= (int)$row['id'] ?>">Editar</a>
        <a href="excluir.php?id=<?= (int)$row['id'] ?>" onclick="return confirm('Excluir este produto?')">Excluir</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </tbody>
</table>
<?php include __DIR__ . "/../includes/footer.php"; ?>
