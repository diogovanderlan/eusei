<?php

include "menuEspecialista.php";



$id = $resposta = $idPergunta = $idUsuario = $data = "";

	 //verificar se esta editando
if (isset ( $_GET["id"] ) ) {
	
        //recuperar o id por get
	$idPergunta = trim( $_GET["id"] );
        //selecionar no banco de dados
	$sql = "select * from resposta where id = ? limit 1";
        //prepare
	$consulta = $pdo->prepare( $sql );
        //passar parametro
	$consulta->bindParam(1, $id );
        //execute
	$consulta->execute();
        //separar os dados
	$dados = $consulta->fetch(PDO::FETCH_OBJ);
}
$data = date_default_timezone_set('America/Sao_Paulo'); 
$data = date("d/m/Y");
?>

<div class="container">
	<div class="well">
		<a href="resposta.php" class="btn btn-success pull-right">
			<i class="glyphicon glyphicon-paste"></i>
			Novo cadastro
		</a>
		<a href="listarResposta.php" class="btn btn-primary pull-right">
			<i class="glyphicon glyphicon-list"></i>
			Listar Resposta
		</a>
		<div class="clearfix"></div>
		
		<form name="formcadastro" method="post" action="salvarResposta.php" novalidate>

			<h1>Resposta</h1>

			
			<label for="id">ID</label>
			<div class="controls">
				<input type="text" readonly 
				name="id" class="form-control"
				value="<?=$id;?>">
			</div>			
			
			<label for="idPergunta">ID Pergunta</label>
			<div class="controls">
				<input type="text" readonly
				name="idPergunta" class="form-control"
				value="<?=$idPergunta;?>">
			</div>			


			<div class="row" hiden>	
				<div class="col-md-6">
					<label class="control-label">Usuário:</label>
					<div class="controls">
						<input type="text" name="idUsuario"
						class="form-control input1" readonly
						value="<?=$_SESSION["especialista"]["id"];?>">
						
						<input type="text" readonly class="form-control input2"
						value="<?=$_SESSION["especialista"]["nome"];?>">
					</div> <!-- controls -->
				</div> <!-- col-md -->
			</div>

			<div class="control-group">
				<label for="data">Data</label>
				<div class="controls">
					<input type="text" 
					name="data"
					class="form-control" readonly
					required value="<?=$data;?>"
					data-validation-required-message="Preencha o dataCad"
					data-mask="99/99/9999">
				</div>
			</div>		

			<main>                                     
				<?php
                                            //$sql = "select * from pergunta order by data desc";
				$sql = "select p.*, u.nome, c.categoria from pergunta p join usuario u on (u.id = p.idusuario) join categoria c on (c.id = p.idcategoria) where p.idPergunta = $idPergunta";
				$consulta = $pdo->prepare($sql);
				$consulta->execute(); 

				while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
					$idPergunta = $dados->idPergunta;
					$pergunta = $dados->pergunta;  
					$nome = $dados->nome;
					$data = $dados->data;
					$categoria = $dados->categoria;

					$data = date('d/m/Y', strtotime($data));
					?>
					<div class="post" style="background: #F2F2F2">
						<div class="wrap-ut pull-left">
							<div class="userinfo pull-left">
							</div>

							<div class="posttext pull-left" id="menu">
								<p><strong>Usuário:</strong> <?=$nome;?></p>
								<h3><?=$pergunta;?></h3>
								<p><strong>Categoria:</strong> <?=$categoria;?></p>
								<p><strong>Data:</strong> <?=$data;?> </p>
							</div>

							<div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
						</div><?php } ?>
					</main>				
	

			<div class="row">		 		
				<div class="controls">
					<div class="col-md-11">
						<div class="control-group">
							<label name="resposta"> resposta: </label>
							<div class="controls">
								<textarea name="resposta" class="form-control" rows="5" value="<?=$resposta;?>"></textarea>
							</div>

							<button type="submit" class="btn btn-success">Salvar Resposta</button>


						</div>
					</div>
				</div>
				<div class="clearfix"></div>		 	
			</div>
			
		</div>
	</div>