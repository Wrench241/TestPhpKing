<h1>produtos</h1>
<style>
   
    .editar{
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
    .excluir{
        background-color: red;
            color: #fff;
            padding: 9px 18px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
    }
    .excluir:hover{
        background-color: darkred;
    }
    .editar:hover{
        background-color: #0056b3;
    }
    td {
        text-align: center;
        font-weight: bold;

  
        
    }
    table {
        width: 80%;
    }
</style>
<?php
//verifica se é mobile e redireciona para outra pagina responsiva.
$agent = $_SERVER["HTTP_USER_AGENT"];
if(strpos($agent, "Mobile") !== false || strpos($agent, "Android") !== false){
    print "<script>window.location.href='?page=mobile';</script>";
}

    $sql = "SELECT * FROM tb_products";
$res = $conn->query($sql);
$column = $res->num_rows;

if ($column == 0) {
    print "<h1>nenhum produto encontrado.</h1>";
} else {
    print "<table cellspacing='10';>";
    print "<tr>";
    print "<th>Foto</th>";
    print "<th>Nome do produto</th>";
    print "<th>Descrição</th>";
    print "<th>Preço</th>";
    print "<th>Estoque</th>";
    print "<th>Sku</th>";
    print "<th>Ação</th>";
    print "</tr>";
    while ($row = $res->fetch_object()) {
        print "<tr>";
        print "<td>";

        $Destine = "www/produto/" . $row->id . "/";

        if (is_dir($Destine)) {
            //buscando fotos do produto.
            $imagens = scandir($Destine);
            foreach ($imagens as $imagem) {
                if ($imagem != '.' && $imagem != '..') {
                    echo "<img src='" . $Destine . $imagem . "' alt='Imagen Id' height='130px' width='130px'>";
                }
            }
        }
        print "<td>" . $row->nome_produto;
        print "<td>" . $row->descrição;
        print "<td style='width: -35px;'>R$ "  . $row->preço;
        print "<td>" . $row->estoque;
        print "<td><pre>" . $row->SKU;
        print "<td><button class='editar' onclick=\"location.href='?page=editar&id=".$row->id."';\">editar</button>
        <button class='excluir' onclick=\"if(confirm('Deseja excluir este produto?')){location.href='?page=save-product&acao=delete&id=".$row->id."';}else{false;}\">excluir</button>";
        print "</tr>";
    }
    print "</table>";
}
?>
