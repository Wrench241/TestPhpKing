<?php
switch ($_REQUEST["acao"]) {
    case 'cadastrar':
        
        $nome = $_POST["nome"];
        $descrição = $_POST["descrição"];
        $fotos = $_FILES["photo"];

        $Destine = "www/produto/";

        // Escaneando pastas para contar quantas já existem
        $ScanDir = scandir($Destine);
        $ContarPastas = 0;

        foreach ($ScanDir as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }

            if (is_dir($Destine . $item)) {
                $ContarPastas++;
            }
        }

        // Criando uma nova pasta numerada
        $novaPasta = $Destine . ($ContarPastas + 1);
        mkdir($novaPasta, 0777, true);

        // Movendo o arquivo para a nova pasta
        if (move_uploaded_file($fotos["tmp_name"], $novaPasta . '/' . $fotos["name"])) {
            echo "Cadastro enviado com sucesso";
        } else {
            echo "Cadastro não foi enviado";
        }
        
        $sql = "INSERT INTO `tb-products`
        
        (nome_produto, descrição) VALUES ('{$nome}','{$descrição}')";

        $res = $conn->query($sql);
        
        break;
    case 'update':

        break;
    case 'delete':
        
        break;
}
