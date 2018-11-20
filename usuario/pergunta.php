<?php

include "menuUsuario.php";

// if ( !isset( $_SESSION["admin"]["id"] ) ) {
// 		//direcionar para o index
// 	header( "Location: index.php" );
// }

	//incluir o arquivo para conectar no banco
include "../config/conecta.php";

$idPergunta = $pergunta = $data = $idUsuario = $idcategoria = "";

	//verificar se esta editando
if ( isset ( $_GET["idPergunta"] ) ) {

		//recuperar o id por get
	$idPergunta = trim( $_GET["idPergunta"] );
		//selecionar no banco de dados 
	$sql = "select * from pergunta where idPergunta = ? limit 1";
		//prepare
	$consulta = $pdo->prepare( $sql );
		//passar parametro
	$consulta->bindParam(1, $idPergunta);
		//execute
	$consulta->execute();
		//separar os dados
	$dados = $consulta->fetch(PDO::FETCH_OBJ);

	$idPergunta = $dados->idPergunta;
	$pergunta = $dados->pergunta;
	$data = $dados->data;
	$idUsuario = $dados->idUsuario;
	$idcategoria = $dados->idcategoria;
}
$data = date_default_timezone_set('America/Sao_Paulo'); 
$data = date("d/m/Y");
?>

<div class="container">
	<div class="well">
		<a href="pergunta.php" class="btn btn-success pull-right">
			<i class="glyphicon glyphicon-paste"></i>
			Novo cadastro
		</a>
		<a href="listarPergunta.php" class="btn btn-primary pull-right">
			<i class="glyphicon glyphicon-list"></i>
			Listar Pergunta
		</a>
		<div class="clearfix"></div>
		
		<form name="formcadastro" method="post" action="salvarPergunta.php" novalidate>

			<h1>Pergunta</h1>

			
			<label for="idPergunta">ID</label>
			<div class="controls">
				<input type="text" readonly 
				name="idPergunta" class="form-control"
				value="<?=$idPergunta;?>">
			</div>				

			<div class="row">	
				<div class="col-md-6">
					<label class="control-label">Usuário:</label>
					<div class="controls">
						<input type="text" name="idusuario"
						class="form-control input1" readonly
						value="<?=$_SESSION["usuario"]["id"];?>">
						
						<input type="text" readonly class="form-control input2"
						value="<?=$_SESSION["usuario"]["nome"];?>">
					</div> <!-- controls -->
				</div> <!-- col-md -->
			</div>

			<div class="row">		 		
				<div class="controls">
					<div class="col-md-11">
						<div class="control-group">
							<label name="pergunta"> pergunta: </label>
							<div class="controls">
								<textarea name="pergunta" class="form-control" rows="5" value="<?=$pergunta;?> + ?"></textarea>
							</div>		 		
						</div>
					</div>

					<div class="col-md-4">
						<div class="control-group">
							<label class="control-label">Data</label>
							<div class="controls">
								<input type="text" name="data" 
								id="data" 
								class="form-control" readonly
								value="<?=$data;?>">
							</div>
						</div> 
					</div> 


					<div class="col-md-4">
						<div class="control-group">
							<label name="idcategoria">Selecione a Categoria</label>
							<div class="controls">
								<select name="idcategoria"
								class="form-control"
								required id="idcategoria"
								data-validation-required-message="Selecione uma Categoria">
								<option value="">
									Selecione uma Categoria
								</option>
								<?php
								$sql = "select * from categoria order by categoria";
								$consulta = $pdo->prepare($sql);
								$consulta->execute();

								while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
									$id = $dados->id;
									$categoria = $dados->categoria;

									echo "<option value='$id'>$categoria</option>"; 						
								}
								?>
							</select>
							<script type="text/javascript">
								$("#idcategoria").val('<?=$idcategoria;?>');
							</script>
						</div>
					</div>
					<div class="clearfix"></div>
					<button type="submit" class="btn btn-success">Salvar Pergunta</button>

					

					<div>
						
					</div>		 	
				</div>
				
			</div>
		</div>