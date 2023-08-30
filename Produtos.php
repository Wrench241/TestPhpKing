<h1>produtos</h1>
<?php
$sql = "SELECT * FROM tb_products";
$res = $conn->query($sql);
$column = $res->num_rows;

if ($column == 0) {
    print "<h1>nenhum produto encontrado.</h1>";
} else {
    print "<table>";
    print "<tr>";
    print "<th>foto</th>";
    print "<th>sku</th>";
    print "<th>nome do produto</th>";
    print "<th>descrição</th>";
    print "<th>preço</th>";
    print "<th>estoque</th>";
    print "<th>ação</th>";
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
                    echo "<img src='" . $Destine . $imagem . "' alt='Imagen Id' height='200px' width='200px'>";
                }
            }
        }
        print "<td>" . $row->SKU;
        print "<td>" . $row->nome_produto;
        print "<td>" . $row->descrição;
        print "<td>" . $row->preço;
        print "<td>" . $row->estoque;
        print "<td><button onclick=\"location.href='?page=editar&id=".$row->id."';\">editar</button>
        <button>excluir</button>";
        print "</tr>";
    }
    print "</table>";
}
?>