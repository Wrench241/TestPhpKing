<?php

define('USER', 'root');
define('PASS', 'tt333');
define('HOST', 'localhost');
define('BASE', 'produtos');

$conn = new mysqli(HOST, USER, PASS, BASE);

$table01 = "tb_products";
$table02 = "variação";

$sql01 = "SHOW TABLES LIKE '$table01'";
$sql02 = "SHOW TABLES LIKE '$table02'";

$res01 = $conn->query($sql01);
$res02 = $conn->query($sql02);

if ($res01->num_rows > 0 && $res02->num_rows > 0) {
} else {
    echo "criando relação de tabelas.";

    $table_products = "
    CREATE TABLE $table01 (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome_produto VARCHAR(80) NOT NULL,
        SKU VARCHAR(80) UNIQUE NOT NULL,
        descrição TEXT,
        preço DECIMAL(10, 2) NOT NULL,
        estoque INT NOT NULL
    );";

    $table_variação = "
    CREATE TABLE $table02 (
        id INT AUTO_INCREMENT PRIMARY KEY,
        descrição_variação VARCHAR(200) NOT NULL,
        variação_tamanho VARCHAR(20),
        variação_cor VARCHAR(20),
        product_id INT NOT NULL,
        FOREIGN KEY (product_id) REFERENCES $table01(id)
    );
    ";

    $res = $conn->multi_query($table_products . $table_variação);

    if ($res) {
        echo "tabelas criadas.";
        print "<script>window.location.href='?page=index.php';</script>";
    } else {
        echo "algo de errado não esta certo.";
    }
}
