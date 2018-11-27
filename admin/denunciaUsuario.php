<?php
	//incluir o menu
include "menu.php";
?>
<div class="well container">
	<h1>Usuários Denunciados</h1>
<br>	


<table class="table table-bordered ">
	<thead>
		<tr>
			<td width="10%">ID</td>
			<td>Foto</td>
			<td>Nome</td>
			<td>Nascimento</td>
			<td>Data de Cadastro</td>
			<td>Email</td>
			<td>Tipo</td>
			<td>Ativo</td>
			<td>Login</td>

			<td width="15%">Opções</td>
		</tr>
	</thead>
	<?php
			//mostrar os resultados da busca
           if ( isset ($_GET["id"]) ) $idU = trim ( $_GET["id"] );
           $sql = "select * from usuario where id = $idU";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(1, $id);
            $consulta->execute();
        $dados = $consulta->fetch( PDO::FETCH_OBJ );
            
            

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






