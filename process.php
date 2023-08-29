<?php
switch ($_REQUEST["acao"]) {
    case 'cadastrar':

        $nome = $_POST["nome"];
        $descrição = $_POST["descrição"];
        $fotos = $_FILES["photo"];
        $cor = $_POST["Tamanho"];
        $tamanho = $_POST["Cor"];
        $preco = $_POST["preço"];
        $estoque = $_POST["estoque"];
        $descriçãoVariação = $_POST["descriçãoVariação"];

        $Destine = "www/produto/";

        // Escaneando pastas para contar quantas já existem.
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


        //informações do produto.
        $sql = "INSERT INTO `tb_products`
        (nome_produto, descrição, preço, estoque) VALUES ('{$nome}','{$descrição}','{$preco}','$estoque')";

        //informações da variação.

        if ($conn->query($sql) === true) {
            $lastID = $conn->insert_id;

            $sql_variação = "INSERT INTO `variação`
            (descrição_variação, variação_tamanho, variação_cor, product_id) VALUES ('{$descriçãoVariação}','{$tamanho}','{$cor}','{$lastID}')";

            $conn->query($sql_variação);

            $novaPasta = $Destine . $lastID;

            if (!is_dir($novaPasta)) {
                // Criando uma nova pasta com ulitmo ID.
                mkdir($novaPasta, 0777, true);
            }

            // Movendo o arquivo para a nova pasta.
            if (move_uploaded_file($fotos["tmp_name"], $Destine . $lastID . '/' . $fotos["name"])) {
                echo "Foto enviada com sucesso. ";
            } else {
                echo "Foto não foi enviada. " . print $novaPasta;
            }

            echo "Cadastro inserido. ";
        } else {
            echo "Cadastro não inserido. " . $conn->error;
        }


        break;
    case 'update':

        break;
    case 'delete':

        break;
}
