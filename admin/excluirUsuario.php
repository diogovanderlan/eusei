<?php

include "menu.php";

$id = "";
	//recuperar o id enviado por GET
if ( isset ( $_GET["id"] ) ) {
	$id = trim ( $_GET["id"] );
}

$sql = "delete from usuario
where id = ? limit 1";
$consulta = $pdo->prepare($sql);
$consulta->bindParam(1, $id);
	//verificar se executou corretamente
if ( $consulta->execute() ) {
		//enviar para a listagem
	echo "<script>location.href='listarUsuario.php';</script>";
} else {
		//deu erro avisar
	echo "<script>alert('Erro ao excluir registro!');history.back();</script>";
}

