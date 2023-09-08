<h1>produtos</h1>
<style>
    .editar {
        background-color: #007bff;
        color: #fff;
        padding: 10px 15px;
        border: none;
        margin-left: -3px;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
    }

    .excluir {
        background-color: red;
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
    }

    .excluir:hover {
        background-color: darkred;
    }

    .editar:hover {
        background-color: #0056b3;
    }

    td {
        text-align: center;
    }

    .div-location {
        margin-left: 170px;
        margin-top: 170px;
    }

    .product-row {
        height: 200px;
        width: 100%;
        margin-bottom: 20px;
        text-align: top;
    }

    .product-row button {
        margin-top: 4px;
    }
    .product-row img {
        margin-right: 250px;
    }
    .location-text{
        height: 200px;
        width: 55%;
        margin-left: 162px;
        margin-top: -214px;
    }
    p {
        font-weight: bold;
        font-size: 14px;
        line-height: 9px;
    }
    .div-father{
        margin-bottom: 70px;

    }
</style>

<?php

$sql = "SELECT * FROM tb_products";
$res = $conn->query($sql);
$column = $res->num_rows;

if ($column == 0) {
    print "<h1>nenhum produto encontrado.</h1>";
} else {

    while ($row = $res->fetch_object()) {
        echo "<div class='div-father'>";
        echo "<div class='product-row'>";
        $Destine = "www/produto/" . $row->id . "/";

        if (is_dir($Destine)) {
            //buscando fotos do produto.
            $imagens = scandir($Destine);
            foreach ($imagens as $imagem) {
                if ($imagem != '.' && $imagem != '..') {
                    echo "<img src='" . $Destine . $imagem . "' alt='Imagen Id' height='140px' width='140px'>";
                }
            }
        }
        echo "<br>";
        echo "<button class='editar' onclick=\"location.href='?page=editar&id=" . $row->id . "';\">editar</button>";
        echo "<button class='excluir' onclick=\"if(confirm('Deseja excluir este produto?')){location.href='?page=save-product&acao=delete&id=" . $row->id . "';}else{false;}\">excluir</button>";
        echo "<div class='location-text'>";
        echo "<h2>" . $row->nome_produto . "</h2>";
        echo "<p>Descrição:<br><p style='font-size: 8pt;'>" . $row->descrição . "</p></p>";
        echo "<p>Preço: " . $row->preço . "</p>";
        echo "<p>Estoque: " . $row->estoque . "</p>";
        echo "<p>Sku: " . $row->SKU . "</p>";
        echo "<br><br>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
}
?>