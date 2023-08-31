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

                print "<script>location.href='?page=produtos';</script>";
            } else {
                print "<script>alert('Nenhuma foto enviada.')</script> ";
                print "<script>location.href='?page=produtos';</script>";
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
        $fotos = $_FILES["photo_update"];
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
        WHERE `product_id` =" . $_REQUEST["id"];

        $resVariação = $conn->query($sql_variação);

        $Destine = "www/produto/";
        //metodo para atualizar foto.
        $path = $Destine . $_REQUEST["id"];
        if (isset($_FILES["photo_update"]) && isset($_REQUEST["id"])) {

            $fileName = $_FILES["photo_update"]["name"];

            //varificando se existe foto anterior na pasta.
            if (!empty($fileName)) {

                $files = glob($path . '/*');
                foreach ($files as $file) {
                    if (is_file($file)) {
                        unlink($file);
                    }
                }

                //movendo foto nova para o diretorio.
                if (move_uploaded_file($_FILES["photo_update"]["tmp_name"], $path . "/" . $fileName)) {

                    print "<script>alert('Foto atualizada com sucesso.')</script>";
                    print "<script>location.href='?page=produtos';</script>";
                } else {
                    print "<script>alert('nenhuma foto enviada ou ID não fornecido')</script>";
                    print "<script>location.href='?page=produtos';</script>";
                }
            }
            print "<script>location.href='?page=produtos';</script>";
        }
        break;
    case 'delete':

        //deletando produto.
        $sql_variação = "DELETE FROM `variação` WHERE `product_id` =" . $_REQUEST["id"];
        $rest = $conn->query($sql_variação);
        $sql = "DELETE FROM `tb_products` WHERE `id` =" . $_REQUEST["id"];
        $resVariação = $conn->query($sql);

        $path = "www/produto/" . $_REQUEST["id"];

        //apagando diretorio da foto.
        $files = glob($path . "/*");
        if (is_dir($path)) {
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
            rmdir($path);

            if ($resVariação === true) {
                print "<script>alert('Excluído com sucesso.')</script>";
                print "<script>location.href='?page=produtos';</script>";
                print $error;
            } else {
                print "<script>alert('Não foi possível excluir.')</script>";
                print "<script>location.href='?page=produtos';</script>";
            }
        } else {
            print "<script>alert('Diretorio não encontrado.');</script>";
        }
        break;
}
