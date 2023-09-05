<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TestPhp</title>
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
            display: flex;
            align-items: center;
            cursor: pointer;
            font-size: 24px;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 0px;
            font-size: 16px;
            transition: background-color 0.3s;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
        }

        .slide-menu {
            position: fixed;
            width: 0;
            height: 100%;
            background-color: #007bff;
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


        .content {
            margin-left: 0;
            transition: 0.5s;
            padding: 20px;
        }

        .button-menu {
            background-color: #007bff;
            margin-right: -45px;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            font-size: 21px;
            cursor: pointer;
            transition: background-color 0.3s;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
        }

        .button-menu:hover {
            background-color: #0056b3;
        }

        .responsive-heading {
            flex: 1;
            margin: 0;
            font-size: 2em;
            max-width: 100%;
        }

        .border-white {
            border: 1px solid white;
        }
        .side-nav-content{
            color: white;
            width: 230px;
            margin-left: 10px;
            margin-right: 10px;
            margin-top: 10px;
        }

        .nav-list {
            list-style: none;
            height: 100%;
            padding: 0%;
            margin-bottom: 0%;
            
        }

        .nav-list-item {
            display: flex;
            align-items: center;
            height: 30px;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
        }
        .nav-list-item:hover {
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            
        }
        
        .nav-list-item a {
            text-decoration: none;
            color: white;
           
        }

        .nav-list-item span {
            width: 120px;
            text-align: capitalize;
            
        }
        .title{
            width: 100%;
            margin-left: 12%;
            align-items: center;
            text-align: center;
        }
        .title h1{
            font-size: 14pt;
            margin-right: 15%;
            
        }
    </style>
</head>

<body>
    <div class="menu-toggle">
        <button class="button-menu" onclick="toggleMenu()">☰</button>
        <div class="title">
        <h1>TestPhp</h1>
        </div>
    </div>
    <nav class="slide-menu">
    <div class="side-nav-content">
        <ul class="nav-list">
            <li class="nav-list-item">
                <span>
                    <a href="index.php">inicio</a>
                </span>
            </li>
            <br>
            <li class="nav-list-item">
                <span>
                    <a href="?page=cadastro">Novo Cadastro</a>
                </span>
            </li>
            <br>
            <li class="nav-list-item">
                <span>
                    <a href="?page=produtos">Produtos</a>
                </span>
            </li>
        </ul>
        </div>
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
            if (slideMenu.style.width === '250px') {
                slideMenu.style.width = '0';
                content.style.marginLeft = '0';
            } else {
                slideMenu.style.width = '250px';
                content.style.marginLeft = '140px';
            }
        }
    </script>

</body>

</html>