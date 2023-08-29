<style>
    .text-area {
        width: 200px;
        height: 160px;
        padding: 10px;
        resize: none;
        font-size: 16px;
    }
</style>
<h1>Cadastro</h1>
<form action="?page=save-product" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="acao" value="cadastrar">
    <div>
        <label>Digite o nome do produto:</label><br>
        <input type="produto" name="nome">
    </div>
    <div>
        <label>Digite a descrição do produto:</label><br>
        <textarea class="text-area" name="descrição" type="descrição" placeholder="descrição."></textarea>
    </div>
    <div>
        <label">Fotos:</label><br>
        <input type="file" name="photo">
        <button type="submit">finalizar</button>
    </div>
</form>