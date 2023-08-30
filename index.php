<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>

<body>
    <button><a href="index.php">Inicio</a></button>
    <button><a href="?page=cadastro">Novo Cadastro</a></button>
    <button><a href="?page=produtos">Produtos</a></button>
    <div class="container">
        <div class="row">
            <div class="col mt-5">
                <?php
                include("config.php");
                $page = isset($_REQUEST["page"]) ? $_REQUEST["page"] : "";

                switch ($page) {
                    case "cadastro":
                        include("Cadastro.php");
                        break;
                    case "produtos":
                        include("Produtos.php");
                        break;
                    case "save-product":
                        include("process.php");
                        break;
                    case "editar":
                        include("editar.php");
                        break;
                    default:
                        echo "<h1>Bem vindo</h1>";
                }
                ?>

            </div>
        </div>
    </div>

</body>

</html>