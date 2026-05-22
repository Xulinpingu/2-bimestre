<?php
include "config/conexao.php";

$mensagemErro = null;
$sucesso = false;

// Verifica se id foi passado
if (!isset($_GET['id']) || empty($_GET['id'])) {
  header('Location: index.php');
  exit;
}

$id = intval($_GET['id']);

// Buscar produto existente
$sql = "SELECT * FROM produtos WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
  header('Location: index.php');
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nome = $_POST['nome'] ?? null;
  $fabricante = $_POST['fabricante'] ?? null;
  $preco = $_POST['preco'] ?? null;
  $estoque = $_POST['estoque'] ?? null;

  if (!empty($nome) && !empty($fabricante) && !empty($preco) && $estoque !== null) {
    try {
      $sql = "UPDATE produtos SET nome = :nome, fabricante = :fabricante, preco = :preco, estoque = :estoque WHERE id = :id";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([
        ':nome' => $nome,
        ':fabricante' => $fabricante,
        ':preco' => $preco,
        ':estoque' => $estoque,
        ':id' => $id
      ]);

      $sucesso = true;
      // Atualiza $produto para preencher o form com novos valores
      $produto['nome'] = $nome;
      $produto['fabricante'] = $fabricante;
      $produto['preco'] = $preco;
      $produto['estoque'] = $estoque;
    } catch (PDOException $e) {
      $mensagemErro = 'Erro ao atualizar: ' . $e->getMessage();
    }
  } else {
    $mensagemErro = 'Preencha todos os campos corretamente.';
  }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar</title>
  <link rel="stylesheet" href="css/style.css"/>
  <link rel="icon" href="Imagens/logo.png" type="image/x-icon">

  <link
    rel="stylesheet"
    type="text/css"
    href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css"
  />
  <link
    rel="stylesheet"
    type="text/css"
    href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/fill/style.css"
  />
</head>
<body>
  <?php include "includes/header.php" ?>

  <div class="formdiv">
    <form class="form" action="" method="post">

      <label>Nome:</label>
      <input type="text" name="nome" placeholder="Nome" value="<?php echo htmlspecialchars($produto['nome']); ?>">

      <label>Fabricante:</label>
      <input type="text" name="fabricante" placeholder="Fabricante" value="<?php echo htmlspecialchars($produto['fabricante']); ?>">

      <label>Preço:</label>
      <input type="text" name="preco" placeholder="Preço" value="<?php echo htmlspecialchars($produto['preco']); ?>">

      <label>Estoque:</label>
      <input type="text" name="estoque" placeholder="Estoque" value="<?php echo htmlspecialchars($produto['estoque']); ?>">
            
      <button class="btn">Salvar alterações<i class="ph ph-note-pencil"></i></button>
    </form>

    <button onclick="window.location.href='index.php'" class="voltar">Voltar<i class="ph ph-arrow-left"></i></button>
  </div>


  <!-- Mensagens -->
  <?php if ($sucesso) { ?>
    <div class="mensagem sucesso">Produto atualizado com sucesso!</div>
  <?php } ?>

  <?php if ($mensagemErro) { ?>
    <div class="mensagem erro"><?php echo $mensagemErro; ?></div>
  <?php } ?>

  <?php include "includes/footer.php" ?>
</body>
</html>