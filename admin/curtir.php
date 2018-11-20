<?php 

include "menu.php";
$idUsuario = $_SESSION["admin"]["id"];

if ( $_GET ) {

		
	$idResposta = trim( $_GET["id"] );
    $idUsuario = $_SESSION["admin"]["id"];

    $sql1 = "select * from descurtida where idUsuario like ? and idResposta like ? ";
    $consulta1 = $pdo->prepare( $sql1 );
    $consulta1->bindParam(1, $idUsuario );
    $consulta1->bindParam(2, $idResposta );
   
    $consulta1->execute();
    $dados = $consulta1->fetch(PDO::FETCH_OBJ);

    if ( empty ($dados->$idUsuario)) {
        //verificar se ja esta curtida com msmo usuario
        $sql = "select * from curtidas where idUsuario = ? idResposta = ? limit 1";
        $consulta = $pdo->prepare( $sql );
        $consulta->bindParam( 1, $idUsuario);
        $consulta->bindParam( 2, $idResposta);
        $consulta->execute();
        $dados = $consulta->fetch(PDO::FETCH_OBJ);	

	if ( empty ( $dados->$idUsuario ) ) {
			//se tiver vazio vai inserir !
		$sql = "insert into curtidas (idUsuario, idResposta) values (?, ?)";
		$consulta = $pdo->prepare( $sql );
		$consulta->bindParam( 1, $idUsuario );
        $consulta->bindParam( 2, $idResposta );
        //se ja tiver curtido 
	} else {
		echo "<script>alert('Voce ja curtiu!!');history.back();</script>";
	} 
        
    } else {
        //se na tabela descurtida tiver algo desseste usuario sera apagado
        $sql = "delete from descurtidas where idUsuario = ? and idResposta = ? limit 1";
        $consulta = $pdo->prepare( $sql );
        $consulta->bindParam(1, $idUsuario);
        $consulta->bindParam(2, $idResposta);
	    $consulta->execute();
        $dados = $consulta->fetch(PDO::FETCH_OBJ);


        if ( empty ($dados->$idUsuario)) {
            //verificar se ja esta curtida com msmo usuario
            $sql = "select * from curtidas where idUsuario = ? idResposta = ? limit 1";
            $consulta = $pdo->prepare( $sql );
            $consulta->bindParam( 1, $idUsuario);
            $consulta->bindParam( 2, $idResposta);
            $consulta->execute();
            $dados = $consulta->fetch(PDO::FETCH_OBJ);	
    
        if ( empty ( $dados->$idUsuario ) ) {
                //se tiver vazio vai inserir !
            $sql = "insert into curtidas (idUsuario, idResposta) values (?, ?)";
            $consulta = $pdo->prepare( $sql );
            $consulta->bindParam( 1, $idUsuario );
            $consulta->bindParam( 2, $idResposta );
            //se ja tiver curtido 
        } else {
            echo "<script>alert('Voce ja curtiu!!');history.back();</script>";
        }	
	}

	if ( $consulta->execute() ) {
		echo "<script>alert('Curtida Salva');history.back();';</script>";
		
	} else {
		echo "<script>alert('erro');history.back();</script>";
	}

  }
 }