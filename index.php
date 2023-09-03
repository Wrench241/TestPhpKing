<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f0f0;
            display: absolute;
            justify-content: first baseline;
            align-items: first baseline;
            height: 100vh;
            margin: 0;
        }

        a {
            color: #f0f0f0;
            font-family: 'Roboto', sans-serif;
            font-weight: bold;
            text-decoration: none;
        }

        .menu-toggle {
            cursor: pointer;
            font-size: 24px;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
        }

        .slide-menu {
            position: fixed;
            width: 0;
            height: 100%;
            background-color: #333;
            overflow-y: hidden;
            transition: 0.5s;
        }

        .slide-menu ul {
            list-style-type: none;
            padding: 0;
        }

        .slide-menu li {
            padding: 15px;
        }

        .slide-menu a {
            color: white;
            text-decoration: none;
            transition: 0.3s;
        }

        .slide-menu a:hover {
            color: #007BFF;
        }

        .content {
            margin-left: 0;
            transition: 0.5s;
            padding: 20px;
        }

        .button-menu {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
        }

        .button-menu:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="menu-toggle">
        <button class="button-menu" onclick="toggleMenu()">☰</button>
        <h1 style="text-align: center;">Teste Php</h1>

    </div>
    <nav class="slide-menu">
        <button><a href="#">X</a></button>
        <button><a href="index.php">Inicio</a></button>
        <button><a href="?page=cadastro">Novo Cadastro</a></button>
        <button><a href="?page=produtos">Produtos</a></button>
    </nav>
    <div class="content">
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
    <script>
        function toggleMenu() {
            const slideMenu = document.querySelector('.slide-menu');
            const content = document.querySelector('.content');
            if (slideMenu.style.wigth === '250px') {
                slideMenu.style.wigth = '0';
                content.style.marginLeft = '0';
            } else {
                slideMenu.style.wigth = '250px';
                content.style.marginLeft = '170px';
            }
        }
    </script>

</body>

</html>