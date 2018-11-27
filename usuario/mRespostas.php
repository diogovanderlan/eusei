<?php
	//incluir o menu
include "menuUsuario.php";
?>
<div class="well container">
	<h1>Listar Resposta</h1>

	

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

$per = $_SESSION["usuario"]["id"];

$palavra = "";
if ( isset ( $_GET["palavra"] ) ) $palavra = trim ( $_GET["palavra"] );

$palavra = "%$palavra%";

			//buscar da resposta
$sql = "select r.*, u.nome, p.pergunta from resposta r join usuario u on (u.id = r.idUsuario) join pergunta p on (p.idPergunta = r.idPergunta) where r.idUsuario = $per ";
$consulta = $pdo->prepare($sql);
$consulta->bindParam(1, $palavra);
			//executar o sql
$consulta->execute();

			//conta as linhas de resultado
$conta = $consulta->rowCount();

echo "<p>Foram encontrados $conta 
cadastros:</p>";

?>

<table class="table table-bordered">
	<thead>
			<td>Pergunta</td>
			<td>Resposta</td>
			<td>Usuário</td>
			<td>Data</td>
			
			<td width="15%">Opções</td>
		</tr>
	</thead>
	<?php
			//mostrar os resultados da busca
	while ( $dados = $consulta->fetch( PDO::FETCH_OBJ ) ) {

				//separar os dados do banco de dados
		$id = $dados->id;
		$resposta = $dados->resposta;
		$nome = $dados->nome;
		$pergunta = $dados->pergunta;
		$data = $dados->data;
		
		$data = date('d/m/Y', strtotime($data));


		echo "<tr>
		<td>$pergunta</td>
		<td>$resposta</td>
		<td>$nome</td>
		<td>$data</td>
		<td>

		<a href=' editResposta.php?id=$id'
		class='btn btn-primary'>Editar Resposta
		<i class='glyphicon glyphicon-pencil'></i>";

	}

	?>
</table>

</div>
</body>
</html>