<div class="delete-box">
    <div class="delete-h">  
        <h1><i class="ph ph-warning"></i>  Cuidado!</h1>
        <button onclick="window.location.href='index.php'"><i class="ph ph-x"></i></button>
    </div>
    <form action="" method="post"> 
        <label for="deletar">Digite DELETE para confirmar a exclusão do item <?php
            if (isset($_GET['id'])) {
                include "config/conexao.php";
                $id = $_GET['id'];
                $sql = "SELECT id, nome FROM produtos WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$id]);
                $produto = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($produto) {
                    echo $produto['id'] . " - " . $produto['nome'];
                }
            }
        ?></label>
        <input type="text" name="deletar">
        
        <button class="delete-btn">Excluir <i class="ph ph-trash"></i></button>
    </form> 
</div>

<?php
    if (isset($_POST['deletar']) && $_POST['deletar'] === 'DELETE') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            include "config/conexao.php";
            $sql = "DELETE FROM produtos WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);

            header("Location: index.php");
        }
    }
    else if (isset($_POST['deletar']) && $_POST['deletar'] !== 'DELETE') {
        echo "<script>alert('Digite DELETE para confirmar a exclusão.');</script>";
    }
?>