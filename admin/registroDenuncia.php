<?php

include "menu.php";

if ( !isset( $_SESSION["admin"]["id"] ) ) {
		//direcionar para o index
	header( "Location: index.php" );
}

	//incluir o arquivo para conectar no banco
include "../config/conecta.php";

?>


<div class="well container">
	<h1>Registros de Denuncias</h1>

	

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

			//buscar da resposta
			//$sql = "select * from denunciarpergunta";

$sql = "select d.*, u.nome, p.pergunta from denunciarpergunta d join usuario u on (u.id = d.idUsuario) join pergunta p on (p.idPergunta = d.idPergunta) where titulo like ? order by titulo";
$consulta = $pdo->prepare($sql);
$consulta->bindParam(1, $palavra);
			//executar o sql
$consulta->execute();

			//conta as linhas de resultado
$conta = $consulta->rowCount();

echo "<p>Foram encontrados $conta 
cadastros:</p>";

?>

<table class="table table-bordered ">
	<thead>
		<tr>
			<td width="10%">ID</td>
			<td>usuario</td>
			<td>titulo</td>
			
			<td>Descrição</td>
			<td>Pergunta</td>
			<td>Usuário</td>
			<td>Data</td>
			<td width="30%">Opções</td>
		</tr>
	</thead>
	<?php
			//mostrar os resultados da busca
	while ( $dados = $consulta->fetch( PDO::FETCH_OBJ ) ) {

				//separar os dados do banco de dados
		$id = $dados->id;
		$idUsuario = $dados->idUsuario;
		$titulo = $dados->titulo;
		$descricao = $dados->descricao;
		$pergunta = $dados->pergunta;
		$nome = $dados->nome;
		$data = $dados->data;                                               
		
		$data = date("d/m/Y");

		echo "<tr>
		<td>$id</td>
		<td>$idUsuario</td>
		<td>$titulo</td>
		<td>$descricao</td>
		<td>$pergunta</td>
		<td>$nome</td>
		<td>$data</td>
		<td>
		<a href='denunciaUsuario.php?id=$idUsuario'
		class='btn btn-success'>
		<i class='glyphicon glyphicon-ok'></i>
		</a>

		<a href='javascript:deletar($id)' 
		class='btn btn-danger'>
		<i class='glyphicon glyphicon-remove'></i>
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
				location.href = "excluirDenuncia.php?id="+id;
			}
		}
	</script>

</body>
</html>
