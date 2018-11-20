<?php //Verifica se nao existe sessao iniciada
	if ( session_start() == null   ){
		
		//Inicia a sessao
		session_start();

	} else if (  $_SESSION["admin"]["id"]  )  {
		//na sessao admin fazer inserção do menu correspondente ao tipo de usuario
		
			//Se nao tiver LOGADO
			include "menu.php";

			
			
			
			
	 } else if ( $_SESSION["usuario"]["id"] )  {
			
			include "menuUsuario.php";
			
			
		}
		else if ( $_SESSION["especialista"]["id"] ) {
			include "menuEspecialista";
			
		} else {
			
			include "../visitante/menu.php";
		}
	


	?>




			


