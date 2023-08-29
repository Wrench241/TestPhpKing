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

        // Criando uma nova pasta numerada.
        $novaPasta = $Destine . ($ContarPastas + 1);
        mkdir($novaPasta, 0777, true);

        // Movendo o arquivo para a nova pasta.
        if (move_uploaded_file($fotos["tmp_name"], $novaPasta . '/' . $fotos["name"])) {
            echo "Foto enviada com sucesso. ";
        } else {
            echo "Foto não foi enviada. ";
        }

        //informações do produto.
        $sql = "INSERT INTO `tb-products`
        (nome_produto, descrição) VALUES ('{$nome}','{$descrição}')";

        //informações da variação.
        $sql_variação = "INSERT INTO `variação`
        (variação_tamanho,variação_cor,descrição_variação) VALUES ('{$tamanho}','{$cor}','{$descriçãoVariação}')";

        if($conn->query($sql) === true && $conn->query($sql_variação) === true){
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
