<?php
	//incluir o menu
include "menu.php";
?>
<div class="well container">
	<h1>Usuários Cadastrados</h1>

	<a href="usuario.php" title="Cadastro de Classes" class="btn btn-success pull-right">
		<i class="glyphicon glyphicon-file"></i>
		Novo Usuário
	</a>

	<div class="clearfix"></div>

	<form name="formpesquisa" method="get"
	class="form-inline text-center">
	<label for="palavra"> Buscar Usuários:
		<input type="text" name="palavra"
		required placeholder="Digite um Nome"
		class="form-control">
	</label>
	<button type="submit" class="btn btn-success">
		<i class="glyphicon glyphicon-search">
		</i>
	</button>
</form>

<?php
$palavra = "";
			//verificar se esta realizando
			//substituir o $palavra por $_GET["palavra"]
if ( isset ( $_GET["palavra"] ) ) {
	$palavra = trim ( $_GET["palavra"] );
}

			//adicionar as %
$palavra = "%$palavra%";

			//buscar da categoria
$sql = "select * from usuario";
$consulta = $pdo->prepare($sql);
			//passar o parametro
$consulta->bindParam(1,$palavra);
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
			<td>Foto</td>
			<td>Nome</td>
			<td>Nascimento</td>
			<td>Data de Cadastro</td>
			<td>Email</td>
			<td>tipo</td>
			<td>Login</td>

			<td width="15%">Opções</td>
		</tr>
	</thead>
	<?php
			//mostrar os resultados da busca
	while ( $dados = $consulta->fetch( PDO::FETCH_OBJ ) ) {

				//separar os dados do banco de dados
		$id = $dados->id;
		$imagem = $dados->imagem;
		$nome = $dados->nome;
		$dataNasc = $dados->dataNasc;
		$dataCad = $dados->dataCad;
		$email = $dados->email;
		$tipo = $dados->tipo;
		$login = $dados->login;

		$dataNasc = date('d/m/Y', strtotime($dataNasc));
		$dataCad = date('d/m/Y', strtotime($dataCad));

		$imagem = $imagem . "p.jpg";
		$img = "<img src='../fotos/$imagem' width='100'>";

		echo "<tr>
		<td>$id</td>
		<td>$img</td>
		<td>$nome</td>
		<td>$dataNasc</td>
		<td>$dataCad</td>
		<td>$email</td>
		<td>$tipo</td>
		<td>$login</td>
		<td>
		<a href='usuario.php?id=$id'
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
				location.href = "excluirUsuario.php?id="+id;
			}
		}
	</script>

</body>
</html>






