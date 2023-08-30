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
        <input type="number" id="number" name="estoque" placeholder="quantidade disponivel">
        <br>
        <br>
        <label for="numeroDecimal">Preço:</label>
        <input type="number" id="number" name="preço" step="any" placeholder="valor"><br><br>
        <label for="descrição">Descrição da variação:</label><br>
        <textarea class="text-area" name="descriçãoVariação" placeholder="descrição."></textarea>
        <br><br><button type="submit">finalizar</button>
    </div>
</form>