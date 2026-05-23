<?php
$urlAtual = $_SERVER['REQUEST_URI'];
$partesUrl = parse_url($urlAtual);

$search_placeholder = "";

if(isset($partesUrl['query'])) {
    $tag_url_partes = explode("=", $partesUrl['query']);
    $tag_url = $tag_url_partes[0];
    $search_placeholder = $tag_url;
}
else{
    header("Location: " . $_SERVER['REQUEST_URI'] . "?nome=");
    $search_placeholder = "nome";
}

?>

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
    <?php require_once "includes/header.php" ?>
    
    <div class="search-bar">
        <i class="ph ph-magnifying-glass"></i>
        <input type="text" placeholder="<?= $search_placeholder; ?>" id="search-input">
        <div class="dropdown">
            <button class="dropdownbtn"><i class="ph ph-tag"></i></button>
            <div class="dropdown-content">
                <button onclick="SearchByTag('id')">ID</button>
                <button onclick="SearchByTag('nome')">Nome</button>
                <button onclick="SearchByTag('fabricante')">Fabricante</button>
                <button onclick="SearchByTag('preco')">Preço</button>
                <button onclick="SearchByTag('estoque')">Estoque</button>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="action-btns">
            <button onclick="window.location.href='cadastro.php'" class="btn">Adicionar<i class="ph ph-plus-circle"></i></button>
        </div>

        <?php 
            if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] === 'delete') {
                $id_produto = $_GET['id'];
                include "excluir.php";
            }
        ?>

        <?php
            include "config/conexao.php";

            if (isset($_GET['action'])) {
                $sql = "SELECT * FROM produtos ORDER BY id ASC";
                $stmt = $pdo->prepare($sql);
            } elseif (isset($partesUrl['query'])) {
                parse_str($partesUrl['query'], $queryParams);
                $firstKey = key($queryParams);
                $firstVal = reset($queryParams);

                $allowedCols = ['id','nome','fabricante','preco','estoque'];
                if (in_array($firstKey, $allowedCols)) {

                    if ($firstVal === '') {

                        $sql = "SELECT * FROM produtos ORDER BY id ASC";
                        $stmt = $pdo->prepare($sql);

                    } elseif (in_array($firstKey, ['nome', 'fabricante'])) {

                        $sql = "SELECT * FROM produtos WHERE $firstKey LIKE :valor ORDER BY id ASC";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindValue(':valor', "%$firstVal%", PDO::PARAM_STR);

                    } else {

                        $sql = "SELECT * FROM produtos WHERE $firstKey = :valor ORDER BY id ASC";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindValue(':valor', $firstVal);
                    }
                }
            } else {
                $sql = "SELECT * FROM produtos ORDER BY id ASC";
                $stmt = $pdo->prepare($sql);
            }

            $stmt->execute();
            $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <div class="cards">
            <?php
                if ($produtos) {
                    foreach ($produtos as $produto) {
            ?>
                <section class="product-card">
                    <div class="product-details">
                        <div class="product-field">
                            <span class="field-label">ID</span>
                            <span class="field-value"><?php echo htmlspecialchars($produto['id']); ?></span>
                        </div>
                        <div class="product-field">
                            <span class="field-label">Nome</span>
                            <span class="field-value"><?php echo htmlspecialchars($produto['nome']); ?></span>
                        </div>
                        <div class="product-field">
                            <span class="field-label">Fabricante</span>
                            <span class="field-value"><?php echo htmlspecialchars($produto['fabricante']); ?></span>
                        </div>
                        <div class="product-field">
                            <span class="field-label">Preço</span>
                            <span class="field-value">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></span>
                        </div>
                        <div class="product-field">
                            <span class="field-label">Estoque</span>
                            <span class="field-value"><?php echo htmlspecialchars($produto['estoque']); ?> unidades</span>
                        </div>
                    </div>
                    <div class="card-actions">
                        <button class="btn" type="button" onclick="showDelete(<?php echo $produto['id']; ?>)"><i id="lixo" class="ph ph-trash"></i></button>
                        <button class="btn" type="button" onclick="window.location.href='editar.php?id=<?php echo $produto['id']; ?>'"><i id="lapis" class="ph ph-note-pencil"></i></button>
                    </div>
                </section>
            <?php
                    }
                } else {
                    echo '<p class="no-products">Nenhum produto encontrado.</p>';
                }
            ?>
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
                <tbody class="table-body">
                    <?php
                        if ($produtos) {
                            foreach ($produtos as $produto) {
                                echo "<tr class='tbody'>";
                                echo "<td data-label='ID'>" . $produto['id'] . "</td>";
                                echo "<td data-label='Nome'>" . $produto['nome'] . "</td>";
                                echo "<td data-label='Fabricante'>" . $produto['fabricante'] . "</td>";
                                echo "<td data-label='Preço'>R$ " . number_format($produto['preco'], 2, ',', '.') . "</td>";
                                echo "<td data-label='Estoque'>" . $produto['estoque'] . "</td>";
                                echo "<td data-label='Ações'><div class=\"actions\"><button class='delete-icon' onclick=\"showDelete(" . $produto['id'] . ")\"><i class='ph ph-trash'></i></button> <button class='edit-icon' onclick=\"window.location.href='editar.php?id=" . $produto['id'] . "'\"><i class='ph ph-note-pencil'></i></button></div></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr class='tbody'><td colspan='6'>Nenhum produto encontrado.</td></tr>";
                        }
                    ?>
                </tbody>
            </table>

        </div>

    </div>

    <script>
        const search_input = document.getElementById('search-input');

        const allowedCols = ['id','nome','fabricante','preco','estoque'];

        const url = new URL(window.location.href);
        const params = new URLSearchParams(url.search);

        const activeTag = (
            search_input.placeholder &&
            allowedCols.includes(search_input.placeholder)
        )
        ? search_input.placeholder
        : 'nome';

        const existing =
            params.get(activeTag) ||
            params.get('query') ||
            '';

        if (existing) {
            search_input.value = decodeURIComponent(existing);
        }

        let timeout = null;

        search_input.addEventListener('input', function(event) {

            clearTimeout(timeout);

            timeout = setTimeout(() => {

                const valorAtual = event.target.value;

                ['id','nome','fabricante','preco','estoque','query']
                    .forEach(k => params.delete(k));

                params.set(activeTag, valorAtual);

                url.search = params.toString();

                window.location.href = url.toString();

            }, 500);

        });

        function SearchByTag(url_tag) {

            const u = new URL(window.location.href);

            ['id','nome','fabricante','preco','estoque','query']
                .forEach(k => u.searchParams.delete(k));

            u.searchParams.set(url_tag, '');

            window.location.href = u.toString();
        }

        function showDelete(id) {
            window.location.href = '?id=' + id + '&action=delete';
        }
    </script>

    <?php require_once "includes/footer.php" ?>
</body>

</html>
