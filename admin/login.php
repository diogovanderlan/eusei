<?php
include "../config/conecta.php";
if ( isset ( $_GET["login"] ) ) {

		//recuperar o login
	$login = trim ( $_GET["login"] );
	$id = trim ( $_GET["id"] );
	
	if ( empty ( $login ) ) {

		echo "Preencha o login";

	} else {

		if ( empty ( $id ) ) {

			$sql = "select * from usuario where login = ? limit 1";
			$consulta = $pdo->prepare($sql);
				//passar o parametro
			$consulta->bindParam(1,$login);
				//executar o sql
			$consulta->execute();

		} else {

			$sql = "select * from usuario where login = ? and id <> ? limit 1";
			$consulta = $pdo->prepare($sql);
				//passar o parametro
			$consulta->bindParam(1,$login);
			$consulta->bindParam(2,$id);
				//executar o sql
			$consulta->execute();

		}
		

		$dados = $consulta->fetch(PDO::FETCH_OBJ);

		if ( !empty ( $dados->login ) ) {
			echo "Login já está sendo utilizado por outro usuário";
		} else {
			echo "ok";
		}


	}

} else {
	echo "Data inválida!";
}