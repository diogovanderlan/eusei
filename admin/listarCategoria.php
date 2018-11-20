<?php
	//incluir o menu
include "menu.php";
?>
<div class="well container">
	<h1>Lista de Categorias</h1>

	<a href="categoria.php" title="Cadastro de Categoria" class="btn btn-success pull-right">
		<i class="glyphicon glyphicon-file"></i>
		Novo Cadastro
	</a>

	<div class="clearfix"></div>

	<form name="formpesquisa" method="get"
	class="form-inline text-center">
	<label for="palavra">Palavra-chave:
		<input type="text" name="palavra"
		required placeholder="Digite uma palavra"
		class="form-control">
	</label>
	<button type="submit" class="btn btn-success">
		<i class="glyphicon glyphicon-search">
		</i>
	</button>
</form>

<?php

$palavra = "";
if ( isset ( $_GET["palavra"] ) ) $palavra = trim ( $_GET["palavra"] );

$palavra = "%$palavra%";

			//buscar da categoria
$sql = "select * from categoria where categoria like ? order by categoria";
$consulta = $pdo->prepare($sql);
$consulta->bindParam(1, $palavra);
			//executar o sql
$consulta->execute();

			//conta as linhas de resultado
$conta = $consulta->rowCount();

echo "<p>Foram encontrados $conta
cadastros:</p>";

?>

<table class="table table-striped">
	<thead>
		<tr>
			<td width="10%">ID</td>
			<td>Categoria</td>
			<td width="15%">Opções</td>
		</tr>
	</thead>
	<?php
			//mostrar os resultados da busca
	while ( $dados = $consulta->fetch( PDO::FETCH_OBJ ) ) {

				//separar os dados do banco de dados
		$id = $dados->id;
		$categoria = $dados->categoria;

		echo "<tr>
		<td>$id</td>
		<td>$categoria</td>
		<td>
		<a href='categoria.php?id=$id'
		class='btn btn-primary'>
		<i class='glyphicon glyphicon-pencil'></i>
		</a>

		<a href='javascript:deletar($id)' 
		class='btn btn-danger'>
		<i class='glyphicon glyphicon-trash'></i>
		</a>
		</td>
		</tr>";

	}

	?>
</table>

</div>
<script type="text/javascript">
		//funcao para perguntar se quer deletar
		function deletar(id) {
			if ( confirm("Deseja mesmo excluir?") ) {
				//enviar o id para uma página
				location.href = "excluirCategoria.php?id="+id;
			}
		}
	</script>

</body>
</html>






