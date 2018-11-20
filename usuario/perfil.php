<?php
	//incluir o menu
include "menuUsuario.php";

	//incluir o arquivo para conectar no banco
include "../config/conecta.php";			 		

?>


<div class="container">
	<div class="perfil">
		<center>
			<h1>PERFIL</h1>
			<?php

			$per = $_SESSION["usuario"]["id"];

			$sql = "select * from usuario where id = $per";
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
			<a href='../visitante/usuarioU.php?id=$id'
			class='btn btn-primary'>
			<i class='glyphicon glyphicon-pencil'></i>
			Editar Perfil
			</a>";
			?>	
			
		</div>
	</div>
