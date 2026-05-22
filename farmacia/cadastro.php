<?php
  include "config/conexao.php";


  $sucesso = false;
  $mensagemErro = null;

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      $nomeNovo = $_POST['nome'] ?? null;
      $fabriNovo = $_POST['fabricante'] ?? null;
      $precoNovo = $_POST['preco'] ?? null;
      $estoqueNovo = $_POST['estoque'] ?? null;


      if (!empty($nomeNovo) && !empty($fabriNovo) && !empty($precoNovo) && !empty($estoqueNovo)) {
          try {
              $sql = "INSERT INTO produtos (nome, fabricante, preco, estoque)
                      VALUES (:nome, :fabricante, :preco, :estoque)";

              $stmt = $pdo->prepare($sql);

              $stmt->execute([
                  ':nome' => $nomeNovo,
                  ':fabricante' => $fabriNovo,
                  ':preco' => $precoNovo,
                  ':estoque' => $estoqueNovo
              ]);
              header("Location: cadastro.php?sucesso=1");
              exit;
          } catch (PDOException $e) {
              $mensagemErro = "Erro ao adicionar o produto: " . $e->getMessage();
          }
      } else {
          $mensagemErro = "Preencha todos os campos!";
      }
  }

  if (isset($_GET['sucesso']) && $_GET['sucesso'] == 1) {
      $sucesso = true;
  }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar</title>
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
            <input type="text" name="nome" placeholder="Nome">

            <label>Fabricante:</label>
            <input type="text" name="fabricante" placeholder="Fabricante">

            <label>Preço:</label>
            <input type="text" name="preco" placeholder="Preço">

            <label>Estoque:</label>
            <input type="text" name="estoque" placeholder="Estoque">

            <button class="btn">Adicionar<i class="ph ph-plus-circle"></i></button>
        </form>

        <button onclick="window.location.href='index.php'" class="voltar">Voltar<i class="ph ph-arrow-left"></i></button>
    </div>

    <!-- Mensagem de sucesso -->
    <?php if ($sucesso == true) { ?>
        <div class="mensagem sucesso">Produto adicionado com sucesso!</div>
    <?php } ?>

    <!-- Mensagem de erro -->
    <?php if ($mensagemErro) { ?>
        <div class="mensagem erro"><?php echo $mensagemErro; ?></div>
    <?php } ?>

    <?php include "includes/footer.php" ?>
</body>
</html>