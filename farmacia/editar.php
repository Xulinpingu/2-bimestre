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

    <div>
    <form action="" method="$_POST">
        <label for="nome">Nome</label>
        <input type="text">

        <label for="fabricante">Frabricante</label>
        <input type="text">

        <label for="preco">Preço</label>
        <input type="text">

        <label for="estoque">Estoque</label>
        <input type="text">
        
        <button class="edit-btn">Editar<i class="ph ph-note-pencil"></i></button>
    </form>

        <button onclick="window.location.href='index.php'" class="voltar">Voltar</button>
    </div>


    <?php include "includes/footer.php" ?>
</body>
</html>