<?php
	//incluir o menu
include "menu.php";

if ( !isset( $_SESSION["admin"]["id"] ) ) {
		//direcionar para o index
	header( "Location: index.php" );
}

	//incluir o arquivo para conectar no banco
include "../config/conecta.php";

?>

<div class="well container">
	<h1>Listar Pergunta</h1>

	<a href="pergunta.php" title="Cadastro de Pergunta" class="btn btn-success pull-right">
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

			//buscar da pergunta
$sql = "select p.*, c.categoria, u.nome from pergunta p join categoria c on (c.id = p.idcategoria ) join usuario u on (u.id = p.idUsuario) where pergunta like ? order by pergunta";
$consulta = $pdo->prepare($sql);
$consulta->bindParam(1, $palavra);
			//executar o sql
$consulta->execute();

			//conta as linhas de resultado
$conta = $consulta->rowCount();

echo "<p>Foram encontrados $conta 
cadastros:</p>";

?>

<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<td width="10%">ID</td>
			<td>Pergunta</td>
			<td>Categoria</td>
			<td>Data</td>
			<td>Usuário</td>
			<td width="30%">Opções</td>
		</tr>
	</thead>
	<?php
			//mostrar os resultados da busca
	while ( $dados = $consulta->fetch( PDO::FETCH_OBJ ) ) {

				//separar os dados do banco de dados
		$idPergunta = $dados->idPergunta;
		$pergunta = $dados->pergunta;
		$categoria = $dados->categoria;
		$data = $dados->data;
		$nome = $dados->nome;

		$data = date('d/m/Y', strtotime($data));

		echo "<tr>
		<td>$idPergunta</td>
		<td>$pergunta</td>
		<td>$categoria</td>
		<td>$data</td>
		<td>$nome</td>
		<td>
		<a href='pergunta.php?idPergunta=$idPergunta'
		class='btn btn-primary'>
		<i class='glyphicon glyphicon-pencil'></i>
		</a>

		<a href='denPergunta.php?idPergunta=$idPergunta'
		class='btn btn-warning'>
		<i class='glyphicon glyphicon-warning-sign'></i>
		</a>

		<a href='resposta.php?idPergunta=$idPergunta'
		class='btn btn-success'>
		<i class='glyphicon glyphicon-warning-sign'></i>
		</a>

		<a href='javascript:deletar($idPergunta)' 
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
				location.href = "excluirPergunta.php?id="+id;
			}
		}
	</script>

</body>
</html>