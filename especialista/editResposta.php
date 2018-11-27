<?php

include "menuEspecialista.php";



$id = $resposta = $idUsuario = $data = "";

	 //verificar se esta editando
if (isset ( $_GET["id"] ) ) {
	
        //recuperar o id por get
	$id = trim( $_GET["id"] );
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

	$id = $dados->id;
	$resposta = $dados->resposta;


}
$data = date_default_timezone_set('America/Sao_Paulo'); 
$data = date("d/m/Y");
?>

<div class="container">
	<div class="well">
		<div class="clearfix"></div>

		<form name="formcadastro" method="post" action="salvarResposta.php" novalidate>

			<h1>Resposta</h1>

			<div class="hidden">
			<label for="id">ID</label>
			<div class="controls">
				<input type="text" readonly 
				name="id" class="form-control"
				value="<?=$id;?>">
			</div>	


			<div class="row">	
				<div class="col-md-6">
					<label >Usuário:</label>
					<div class="controls">

						<input type="text" name="idUsuario"
						class="form-control input1" readonly
						value="<?=$_SESSION["especialista"]["id"];?>">
					</div> <!-- controls -->
				</div> <!-- col-md -->
			</div>
		</div>

			<?php

			$idPer = "select * from respostar where idPergunta = resposta";
			$consulta = $pdo->prepare($sql);
			$dado = $consulta->fetch(PDO::FETCH_OBJ);
			$idPergunta = $dados->idPergunta;


			$sql = "select p.*, r.*, u.nome, c.categoria from pergunta p join usuario u on (u.id = p.idusuario) join categoria c on (c.id = p.idcategoria) join resposta r on (r.idPergunta = p.idPergunta) where r.idPergunta = $idPergunta limit 1";

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
					<div class="col-md-4">
						<label for="data">Data: </label>
						<input type="text" 
						name="data" class="form-control input" readonly
						required value="<?=$data;?>"
						data-validation-required-message="Preencha o dataCad"
						data-mask="99/99/9999">
					</div>
				</div>


				<div class="row">
				<div class="col-md-4">
					<label>Usuário: </label>
					<input type="text" readonly class="form-control input"
					value="<?=$_SESSION["especialista"]["nome"];?>">
				</div>
				</div>	
			</div>
					<br>

				<div class="row">		 		
					<div class="controls">
						<div class="col-md-11">
							<div class="control-group">
								<label for="resposta">
								Resposta:</label>
								<div class="controls">
									<input type="text" 
									name="resposta"
									class="form-control"
									required
									data-validation-required-message="Preencha a Resposta"
									value="<?=$resposta;?>">
								</div>
							</div>
							<br>

							<button type="submit" class="btn btn-success">Salvar Resposta</button>


						</div>
					</div>
				</div>
				<div class="clearfix"></div>		 	
			</div>

		</div>
	</div>