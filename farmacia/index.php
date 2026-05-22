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
            </table>

            <div class="table-body">
                <table>
                    <tbody>
                        <?php
                            include "config/conexao.php";

                            if (isset($partesUrl['query'])) {
                                $tag_url_final = end($tag_url_partes);
                                $sql = "SELECT * FROM produtos WHERE $tag_url LIKE :valor ORDER BY id ASC";
                                $stmt = $pdo->prepare($sql);
                                $stmt->bindValue(':valor', "%$tag_url_final%", PDO::PARAM_STR);
                            } else {
                                $sql = "SELECT * FROM produtos ORDER BY id ASC";
                                $stmt = $pdo->prepare($sql);
                            }

                            $stmt->execute();
                            $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            if ($produtos) {
                                foreach ($produtos as $produto) {
                                    echo "<tr class='tbody'>";
                                    echo "<td>" . $produto['id'] . "</td>";
                                    echo "<td>" . $produto['nome'] . "</td>";
                                    echo "<td>" . $produto['fabricante'] . "</td>";
                                    echo "<td>R$ " . number_format($produto['preco'], 2, ',', '.') . "</td>";
                                    echo "<td>" . $produto['estoque'] . "</td>";
                                    echo "<td><button class='delete-icon' onclick=\"showDelete(" . $produto['id'] . ")\"><i class='ph ph-trash'></i></button></td>";
                                    echo "<td><button class='edit-icon' onclick=\"window.location.href='editar.php'\"><i class='ph ph-note-pencil'></i></button></td>";
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

    </div>

    <script>
        const search_input = document.getElementById('search-input');

        // Preencher o campo de pesquisa com o valor atual da URL
        const urlParams = new URLSearchParams(window.location.search);
        const query = urlParams.get('query');
        if (query) {
            search_input.value = decodeURIComponent(query);
        }

        // Adicionar evento para realizar a pesquisa apenas quando o valor mudar
        let lastSearchValue = search_input.value; // Armazena o último valor pesquisado
        search_input.addEventListener('input', function(event) {
            const valorAtual = event.target.value;

            // Só realiza a pesquisa se o valor for alterado
            if (valorAtual !== lastSearchValue) {
                lastSearchValue = valorAtual;
                const url = new URL(window.location.href);
                url.searchParams.set('query', encodeURIComponent(valorAtual));
                window.location.href = url.toString();
            }
        });

        function showDelete(id) {
            window.location.href = '?id=' + id + '&action=delete';
        }

        function SearchByTag(url_tag) {
            window.location.href = '?' + url_tag + '=';
        }


    </script>

    <?php require_once "includes/footer.php" ?>
</body>

</html>

