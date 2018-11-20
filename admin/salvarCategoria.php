<?php

include "menu.php";

if ( $_POST ) {

		//recuperar os dados do formulário
		//print_r( $_POST );
	$id = trim( $_POST["id"] );
	$categoria = trim( $_POST["categoria"] );

		//verificar se o campo esta em branco
	if ( empty( $categoria ) ) {
			//mensagem com o javascript
		echo "<script>alert('Preencha a categoria');history.back();</script>";
	} else {

			//verificar se o registro já existe
		$sql = "select * from categoria
		where categoria = ? 
		and id <> ? limit 1";
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(1, $categoria);
		$consulta->bindParam(2, $id);
		$consulta->execute();
		$dados = $consulta->fetch(PDO::FETCH_OBJ);

		if ( !empty( $dados->categoria ) ) {
				//já existe um registro cadastrado
			echo "<script>alert('Já existe um cadastro com esta categoria');history.back();</script>";
			exit;

		}

			//verificar se o id esta vazio - insert
		if ( empty ( $id ) ) {
				//gravar no banco de dados
			$sql = "insert into categoria (id, categoria)
			values (NULL, ? )";
			$consulta = $pdo->prepare($sql);
				//passar o parametro
			$consulta->bindParam(1, $categoria);
		} else {
				//dar update
			$sql = "update categoria 
			set categoria = ? 
			where id = ? 
			limit 1";
			$consulta = $pdo->prepare( $sql );
			$consulta->bindParam( 1, $categoria );
			$consulta->bindParam( 2, $id );

		}

			//verificar se executou corretamente
		if ( $consulta->execute() ) {

			echo "<script>alert('Registro Salvo');location.href='listarCategoria.php';</script>";

		} else {

			echo "<script>alert('Erro ao Salvar');history.back();</script>";

		}
	}
} else {

		//mensagem de erro ao acessar diretamente o arquivo
	echo "<div class='alert alert-danger container'>
	ERRO: tentativa inválida</div>";

}

?>

</body>
</html>