
<?php
	//incluir o menu
include "menu.php";

	//incluir o arquivo para conectar no banco
include "../config/conecta.php";			 		

?>


<div class="container">
	<div class="perfil">
		<center>
			<h1>PERFIL</h1>
			<?php
			if ( isset ($_GET["id"]) ) $id = trim ( $_GET["id"] );

			$sql = "select * from usuario where id = $id";
			$consulta = $pdo->prepare($sql);
			$consulta->execute();

			while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
				$id = $dados->id;
				$nome = $dados->nome; 
				$imagem = $dados->imagem;
				$email = $dados->email;
				$login = $dados->login;

				$imagem = $imagem . "p.jpg";
				$img = "<img src='../fotos/$imagem'";
				
			}
			




			?>
			<?php echo" <img src='../fotos/$imagem' id='fto'>"; ?>
			<p>Nome:  <?=$nome;?></p>
			<p>Email: <?=$email;?></p>
			<p>Login: <?=$login;?></p>	

			<?php 
			echo "
			<a href='perguntas1.php?id=$id'
			class='btn btn-primary'>
			<i class='glyphicon glyphicon-eye-open'></i>
			Ver Perguntas
			</a>";
			?>	
			
		</div>
	</div>
