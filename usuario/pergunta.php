<?php

include "menuUsuario.php";

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
					<label name="idUsuario">Usuário: </label>
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
							<label for="pergunta">
							Pergunta:</label>
							<div class="controls">
								<input type="text" 
								name="pergunta"
								class="form-control"
								required
								data-validation-required-message="Preencha a Pergunta"
								value="<?=$pergunta;?>">
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