<?php
	//incluir o menu
include "menu.php";

	//incluir o arquivo para conectar no banco
include "../config/conecta.php";			 		

?>


<div class="container">
	<div class="perfil">
		<center>
			<h1 style="text-align: center; margin-top: 20px;"><strong>Bem Vindo ao EUSEI!</strong></h1>
			<p style="text-align: center; margin-top: 20px;">Um Site de Pergunta e Respostas, feito para todas as Pessoas com Curiosidades, Duvidas e que estejam em busca de Conhecimento sobre diversos assuntos.</p>

		<a href="usuarioU.php" id="bot" type="submit" 
			class="btn btn-success pull-right">
			<i class="glyphicon glyphicon-user"></i>
			<strong>Cadastre - Se</strong>
		</a>


		<a href="../usuario/index.php" id="bot" type="submit" 
		class="btn btn-success pull-right">
		<i class="glyphicon glyphicon-log-in"></i>
		<strong>Faça o Login</strong>
	</a>


</div>
</div>
