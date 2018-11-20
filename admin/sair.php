<?php
	//iniciar a sessao
session_start();
	//apagar os dados da sessao
unset( $_SESSION["admin"] );
	//direcionar para o index.php
header( "Location: ../visitante/index.php" );