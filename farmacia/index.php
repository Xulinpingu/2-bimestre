<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FarmaPingu</title>
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
    
    <div class="search-bar">
        <i class="ph ph-magnifying-glass"></i>
        <input type="text">
        <button><i class="ph ph-tag"></i></button>
    </div>

    <div class="content">
        <div class="action-btns">
            <button onclick="window.location.href='cadastro.php'" class="btn">Adicionar<i class="ph ph-plus-circle"></i></button>
            <button onclick="window.location.href='editar.php'" class="btn">Editar <i class="ph ph-note-pencil"></i></button>
        </div>

        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Fabricante</th>
                        <th>Preço</th>
                        <th>Estoque</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="tbody">
                        
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

    <?php include "includes/footer.php" ?>
</body>

</html>