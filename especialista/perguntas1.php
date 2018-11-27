<?php
	//incluir o menu
include "menuEspecialista.php";

	//incluir o arquivo para conectar no banco
include "../config/conecta.php";

?>

<div class="well container">
	<div class="clearfix"></div>
	<h1 style="color: #000">Suas Perguntas</h1>

	<?php

	if ( isset ($_GET["id"]) ) $idU = trim ( $_GET["id"] );

			//buscar da pergunta
	$sql = "select p.*, c.categoria, u.nome from pergunta p join categoria c on (c.id = p.idcategoria ) join usuario u on (u.id = p.idUsuario) where idUsuario = $idU ";
	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(1, $palavra);
			//executar o sql
	$consulta->execute();
	while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
		$id = $dados->idPergunta;
		$pergunta = $dados->pergunta;  
		$nome = $dados->nome;
		$data = $dados->data;
		$categoria = $dados->categoria;

		$data = date('d/m/Y', strtotime($data));
		?>
		<br>
		<div class="post" style="background: #F2F2F2">
			<div class="wrap-ut pull-left">
				<div class="userinfo pull-left">
				</div>

				<div class="posttext pull-left" id="menu">
					<p><strong>Usuário:</strong> <?=$nome;?></p>
					<h3><?=$pergunta;?></h3>
					<p><strong>Categoria:</strong> <?=$categoria;?></p>
					<p><strong>Data:</strong> <?=$data;?> </p>

					<a href="resposta.php?id=<?=$id;?>" class="btn btn-success">
						Responder
					</a>
					<a href="respostas.php?id=<?=$id;?>" class="btn btn-success">
						Ver Respostas
					</a>
					<a href="denPergunta.php?id=<?=$id;?>" class="btn btn-warning">
						Denunciar
					</a>

				</div>

				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
			</div><?php } ?>		
		</main> 

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