<?php
	//incluir o menu
include "menu.php";

$pergunta =  $resposta = "";

if ( !isset( $_SESSION["admin"]["id"] ) ) {
		//direcionar para o index
	header( "Location: index.php" );
}

	//incluir o arquivo para conectar no banco
include "../config/conecta.php";

?>

<div class="well container">
	<div class="clearfix"></div>

	<?php

	$palavra = "";
	if ( isset ( $_GET["palavra"] ) ) $palavra = trim ( $_GET["palavra"] );

	$palavra = "%$palavra%";

			//buscar da pergunta
	$sql = "select * from pergunta where pergunta like ? order by pergunta";
	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(1, $palavra);
			//executar o sql
	$consulta->execute();

			//conta as linhas de resultado
	$conta = $consulta->rowCount();

	?>

	<div class="container" style="font-family: Tahoma; text-align: center; margin-right: 10px; ">

		<h1>Permissões</h1>

		<form name="formcadastro" method="post" action="pergunta.php" novalidate>
			

			<table class="table">
				<thead>
					<tr>
						<td width="10%">ID</td>
						<td>Pergunta</td>
						<td>Categoria</td>
						<td width="30%">Opções</td>
					</tr>
				</thead>
				<?php
			//mostrar os resultados da busca
				while ( $dados = $consulta->fetch( PDO::FETCH_OBJ ) ) {

				//separar os dados do banco de dados
					$id = $dados->id;
					$pergunta = $dados->pergunta;
					$idcategoria = $dados->idcategoria;

					echo "<tr>
					
					<td>$id</td>
					<td>$pergunta</td>
					<td>$idcategoria</td>
					<td>
					<a href='listarPergunta.php?id=$id'
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


