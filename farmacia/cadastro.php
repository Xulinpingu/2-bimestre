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
            <input type="text" placeholder="Nome">

            <input type="text" placeholder="Fabricante">

            <input type="text" placeholder="Preço">

            <input type="text" placeholder="Estoque">

            <button class="btn">Adicionar<i class="ph ph-plus-circle"></i></button>
        </form>

        <button onclick="window.location.href='index.php'" class="voltar">Voltar<i class="ph ph-arrow-left"></i></button>
    </div>


    <?php include "includes/footer.php" ?>
</body>
</html>