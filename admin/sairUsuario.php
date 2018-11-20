<?php
	//iniciar a sessao
	session_start();
	//apagar os dados da sessao
	unset( $_SESSION["usuario"] );
	//direcionar para o home.php
	header( "Location: ../visitante/index.php" );