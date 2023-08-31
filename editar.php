<style>
    .text-area {
        width: 200px;
        height: 160px;
        padding: 10px;
        resize: none;
        font-size: 16px;
    }
</style>
<h1>Editar</h1>
<?php

$id = $_REQUEST["id"];
$sql = "SELECT * FROM `tb_products` WHERE `id` = $id";
$sql_variação = "SELECT * FROM `variação` WHERE `product_id` = $id";

$resVariação = $conn->query($sql_variação);
$res = $conn->query($sql);

$rowVariação = $resVariação->fetch_object();
$row = $res->fetch_object();


?>
<form action="?page=save-product" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="acao" value="update">
    <input type="hidden" name="id" value="<?php print $row->id ?>">
    <div>
        <label>Digite o nome do produto:</label><br>
        <input type="produto" name="nome" value="<?php print $row->nome_produto ?>">
    </div>
    <div>
        <label>Digite a descrição do produto:</label><br>
        <textarea class="text-area" name="descrição" type="descrição" placeholder="descrição."><?php print $row->descrição; ?></textarea>
    </div>
    <div>
        <label">Fotos:</label><br>
            <input type="file" name="photo_update">
    </div>
    <div>
        <br>
        <label>Variação cor:</label>
        <select name="Cor" id="cor">
            <option value="Cor (1 nível)">Cor (1 nível)</option>
            <option value="Cor (2 nível)">Cor (2 nível)</option>
            <option value="Cor (3 nível)">Cor (3 nível)</option>
            <option value="Cor (4 nível)">Cor (4 nível)</option>
            <option value="Cor (5 nível)">Cor (5 nível)</option>
        </select>
    </div>
    <div>
        <br>
        <label>Variação Tamanho:</label>
        <select name="Tamanho" id="Tamanho">
            <option value="Tamanho (1 nível)">Tamanho (1 nível)</option>
            <option value="Tamanho (2 nível)">Tamanho (2 nível)</option>
            <option value="Tamanho (3 nível)">Tamanho (3 nível)</option>
            <option value="Tamanho (4 nível)">Tamanho (4 nível)</option>
            <option value="Tamanho (5 nível)">Tamanho (5 nível)</option>
        </select>
    </div>
    <div>
        <br>
        <label for="numero">Estoque:</label>
        <input type="number" id="number" value="<?php print $row->estoque ?>" name="estoque" placeholder="quantidade disponivel">
        <br>
        <br>
        <label for="numeroDecimal">Preço:</label>
        <input type="number" id="number" name="preço" value="<?php print $row->preço ?>" step="any" placeholder="valor"><br><br>
        <label for="descrição">Descrição da variação:</label><br>
        <textarea class="text-area" name="descriçãoVariação" placeholder="descrição."><?php print $rowVariação->descrição_variação ?></textarea>
        <br><br><button type="submit">finalizar</button>
    </div>
</form>