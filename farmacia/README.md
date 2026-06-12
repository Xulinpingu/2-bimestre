# 💊 FarmaPingu — Sistema de Gerenciamento de Farmácia

Sistema web para gerenciamento de produtos de uma farmácia, com cadastro, listagem, edição e exclusão de itens do estoque.

---

## 📋 Índice

- [Sobre o Projeto](#sobre-o-projeto)
- [Tecnologias Utilizadas](#tecnologias-utilizadas)
- [Estrutura de Arquivos](#estrutura-de-arquivos)
- [Banco de Dados](#banco-de-dados)
- [Funcionalidades](#funcionalidades)
- [Como Executar](#como-executar)

---

## Sobre o Projeto

O **FarmaPingu** é uma aplicação web desenvolvida em PHP com banco de dados MySQL que permite gerenciar o estoque de produtos de uma farmácia. O sistema oferece uma interface com visualização em cards e tabela, busca dinâmica por diferentes campos e operações completas de CRUD.

---

## Tecnologias Utilizadas

| Tecnologia | Uso |
|---|---|
| PHP | Back-end e lógica da aplicação |
| MySQL | Banco de dados relacional |
| PDO | Conexão segura com o banco de dados |
| HTML5 / CSS3 | Estrutura e estilo da interface |
| JavaScript | Busca dinâmica e interações do front-end |
| Phosphor Icons | Ícones da interface |

---

## Estrutura de Arquivos

```
farmacia/
├── index.php              # Página principal — listagem e busca de produtos
├── cadastro.php           # Formulário de cadastro de novo produto
├── editar.php             # Formulário de edição de produto existente
├── excluir.php            # Lógica e modal de confirmação de exclusão
├── database.sql           # Script SQL para criação do banco de dados
│
├── config/
│   └── conexao.php        # Configuração da conexão com o banco (PDO)
│
├── css/
│   └── style.css          # Estilos globais da aplicação
│
├── includes/
│   ├── header.php         # Cabeçalho reutilizável (logo + título)
│   └── footer.php         # Rodapé reutilizável
│
└── imagens/
    ├── logo.png            # Logo padrão
    └── logo_farmapingu.png # Logo principal do sistema
```

---

## Banco de Dados

### Criação

O arquivo `database.sql` cria automaticamente o banco e a tabela necessária:

```sql
CREATE DATABASE IF NOT EXISTS farmacia_db;
USE farmacia_db;
```

### Tabela `produtos`

| Coluna | Tipo | Descrição |
|---|---|---|
| `id` | INT (PK, AUTO_INCREMENT) | Identificador único do produto |
| `nome` | VARCHAR(100) | Nome do produto |
| `fabricante` | VARCHAR(100) | Nome do fabricante |
| `preco` | DECIMAL(10,2) | Preço unitário |
| `estoque` | INT | Quantidade em estoque |

### Conexão (`config/conexao.php`)

A conexão utiliza **PDO** com charset UTF-8. As credenciais padrão são:

```
Host:     localhost
Banco:    farmacia_db
Usuário:  root
Senha:    (vazia)
```

> ⚠️ Em ambiente de produção, altere as credenciais e utilize variáveis de ambiente.

---

## Funcionalidades

### 📄 Listagem de Produtos (`index.php`)

- Exibe todos os produtos em **dois modos de visualização**: cards e tabela.
- **Busca dinâmica em tempo real** com debounce de 500ms — sem necessidade de apertar Enter.
- **Filtro por campo** via dropdown: é possível buscar por ID, Nome, Fabricante, Preço ou Estoque.
- Busca por texto usa `LIKE` (campos `nome` e `fabricante`) e igualdade exata para os demais campos.
- Botões de **editar** e **excluir** em cada produto.

A busca usa debounce para evitar uma requisição a cada tecla digitada, esperando 500ms de inatividade:

```js
search_input.addEventListener('input', function(event) {
    clearTimeout(timeout);

    timeout = setTimeout(() => {
        const valorAtual = event.target.value;

        params.set(activeTag, valorAtual);
        url.search = params.toString();
        window.location.href = url.toString();

    }, 500);
});
```

O filtro por campo atualiza a URL com a tag selecionada, mantendo a busca consistente ao navegar:

```js
function SearchByTag(url_tag) {
    const u = new URL(window.location.href);
    ['id','nome','fabricante','preco','estoque','query']
        .forEach(k => u.searchParams.delete(k));
    u.searchParams.set(url_tag, '');
    window.location.href = u.toString();
}
```

### ➕ Cadastro de Produto (`cadastro.php`)

- Formulário com os campos: Nome, Fabricante, Preço e Estoque.
- Validação no back-end: todos os campos são obrigatórios.
- Preço aceita vírgula ou ponto como separador decimal.
- Estoque aceita apenas valores inteiros não negativos.
- Exibe mensagem de **sucesso** ou **erro** após o envio.
- Inserção no banco via prepared statement:

```php
$sql = "INSERT INTO produtos (nome, fabricante, preco, estoque)
        VALUES (:nome, :fabricante, :preco, :estoque)";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':nome'       => $nomeNovo,
    ':fabricante' => $fabriNovo,
    ':preco'      => $precoNovo,
    ':estoque'    => $estoqueNovo
]);
```

### ✏️ Edição de Produto (`editar.php`)

- Recebe o `id` do produto via `GET` e carrega os dados atuais no formulário.
- Redireciona para `index.php` se o produto não for encontrado.
- Mesmas validações do cadastro.
- Atualiza o registro via prepared statement (`UPDATE produtos`).
- Exibe mensagem de **sucesso** ou **erro** após salvar.

### 🗑️ Exclusão de Produto (`excluir.php`)

- Acionado a partir do botão de lixeira na listagem.
- Exibe um **modal de confirmação** com overlay, mostrando o ID e nome do produto.
- Requer que o usuário digite `DELETE` no campo de confirmação para prosseguir — protegendo contra exclusões acidentais.
- Executa a exclusão via prepared statement:

```php
if (isset($_POST['deletar']) && $_POST['deletar'] === 'DELETE') {
    $sql = "DELETE FROM produtos WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    header("Location: index.php");
}
```

---

## Como Executar

### Pré-requisitos

- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Servidor web (Apache/Nginx) ou XAMPP/WAMP/Laragon

### Passo a passo

1. **Clone ou copie** a pasta `farmacia/` para o diretório raiz do seu servidor (ex: `htdocs` no XAMPP).

2. **Crie o banco de dados** importando o script SQL:

   ```bash
   mysql -u root -p < farmacia/database.sql
   ```

   Ou importe `database.sql` pelo **phpMyAdmin**.

3. **Verifique as credenciais** em `config/conexao.php` e ajuste se necessário.

4. **Acesse no navegador:**

   ```
   http://localhost/farmacia/
   ```

---

## Segurança

- Todas as queries utilizam **prepared statements** com PDO, prevenindo SQL Injection.
- Saídas HTML usam `htmlspecialchars()`, prevenindo XSS.
- A exclusão exige confirmação explícita digitando `DELETE`.
- Colunas de busca são validadas em uma whitelist antes de serem usadas na query.
