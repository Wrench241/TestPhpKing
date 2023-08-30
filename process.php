<?php
switch ($_REQUEST["acao"]) {
    case 'cadastrar':

        $nome = $_POST["nome"];
        $descrição = $_POST["descrição"];
        $fotos = $_FILES["photo"];
        $cor = $_POST["Cor"];
        $tamanho = $_POST["Tamanho"];
        $preco = $_POST["preço"];
        $estoque = $_POST["estoque"];
        $descriçãoVariação = $_POST["descriçãoVariação"];

        $Destine = "www/produto/";


        //função gerador de SKU.
        function generateSKU($nome, $descrição, $cor, $tamanho)
        {

            $nomeSub = str_replace(' ', '', $nome);
            $nameAbreviation = strtoupper(substr($nomeSub, 0, 4));

            $descriSub = str_replace(' ', '', $descrição);
            $descriAbreviation = strtoupper(substr($descriSub, 0, 4));

            $tamanhoSub = str_replace(' ', '', $tamanho);
            $tamanho = strtoupper(substr($tamanhoSub, 6, 6));

            $corSub = str_replace(' ', '', $cor);
            $corAbreviation = strtoupper(substr($corSub, 2, 6));

            $sku = str_replace('(', '', $nameAbreviation . '-' . $tamanho . '-' . $corAbreviation . '-' . $descriAbreviation);

            return $sku;
        }

        //Codigo SKU.
        $SKU = generateSKU($nome, $descrição, $cor, $tamanho);


        //Escaneando pastas para contar quantas já existem.
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
        (nome_produto, descrição, preço, estoque, SKU) VALUES ('{$nome}','{$descrição}','{$preco}','$estoque','{$SKU}')";


        if ($conn->query($sql) === true) {
            $lastID = $conn->insert_id;

            //informações da variação.
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
                echo "Foto não foi enviada. ";
            }

            echo "Cadastro inserido. ";
        } else {
            echo "Cadastro não inserido. " . $conn->error;
        }
    

        break;
    case 'update':

        //atualizando dados.
        $nome = $_POST["nome"];
        $descrição = $_POST["descrição"];
        $fotos = $_FILES["photo"];
        $cor = $_POST["Cor"];
        $tamanho = $_POST["Tamanho"];
        $preco = $_POST["preço"];
        $estoque = $_POST["estoque"];
        $descriçãoVariação = $_POST["descriçãoVariação"];

        $sql = "UPDATE `tb_products` SET
        `nome_produto` = '{$nome}',
        `descrição` = '{$descrição}',
        `preço` = '{$preco}',
        `estoque` = '{$estoque}'
        WHERE `id` =" . $_REQUEST["id"];

        $res = $conn->query($sql);

        $sql_variação = "UPDATE `variação` SET
        `descrição_variação` = '{$descriçãoVariação}',
        `variação_tamanho` = '{$tamanho}',
        `variação_cor` = '{$cor}'
        WHERE `product_id` =". $_REQUEST["id"];
        
        $resVariação = $conn->query($sql_variação);

        break;
    case 'delete':

        break;
}