<?php
include "menu.php";

if ( $_POST ) {
        //recuperar os dados do formulario

    $id = trim( $_POST["id"] );
    $titulo = trim( $_POST["titulo"] );
    $descricao = trim( $_POST["descricao"] );
    $idPergunta = trim( $_POST["idPergunta"] );
    $idUsuario = trim( $_POST["idUsuario"] );
    $data = trim( $_POST["data"] );    

    $data = formatardata( $data );

    if ( empty( $id ) ) {
            //gravar no banco de dados
        $sql = "insert into denunciarpergunta (id, titulo, descricao, idPergunta, idUsuario, data) values (NULL, ?, ?, ?, ?, ?)";
        $consulta = $pdo->prepare( $sql );
        $consulta->bindParam( 1, $titulo );
        $consulta->bindParam( 2, $descricao);
        $consulta->bindParam( 3, $idPergunta);
        $consulta->bindParam( 4, $idUsuario );
        $consulta->bindParam( 5, $data );

    } else {

        $sql = "update denunciarpergunta set idPergunta = ?, idUsuario = ?, data = ?, titulo = ?, descricao = ? where id = ? limit 1";
        $consulta = $pdo->prepare( $sql );
        $consulta->bindParam( 1, $titulo );
        $consulta->bindParam( 2, $descricao );
        $consulta->bindParam( 3, $idPergunta );
        $consulta->bindParam( 4, $idUsuario );
        $consulta->bindParam( 5, $data );
        $consulta->bindParam( 6, $id );
    }

    if ( $consulta->execute() ) {
        echo "<script>alert('Denuncia Registrada!');location.href='registroDenuncia.php';</script>";
    } else {
        echo "<script>alert('Erro ao Denunciar');history.back();</script>";
    }
}

?>