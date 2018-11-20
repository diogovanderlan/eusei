<?php 

include "menu.php";

if ( $_POST ) {
        //recuperar os dados do formulario
    $id = trim( $_POST["id"]);
    $titulo = trim( $_POST["titulo"] );
    $descricao = trim( $_POST["descricao"] );
    $idResposta = trim( $_POST["idResposta"] );
    $idUsuario = trim( $_POST["idUsuario"] );
    $data = trim( $_POST["data"] );

    $data = formatardata( $data );

    if ( empty( $id ) ) {
            //gravar no banco de dados
        $sql = "insert into denunciarresposta (id, titulo, descricao, idResposta, idUsuario, data) values (NULL, ?, ?, ?, ?, ?)";
        $consulta = $pdo->prepare( $sql );
        $consulta->bindParam( 1, $titulo );
        $consulta->bindParam( 2, $descricao );
        $consulta->bindParam( 3, $idResposta );
        $consulta->bindParam( 4, $idUsuario );
        $consulta->bindParam( 5, $data );
        
    } else {

        $sql = "update denunciarresposta set idResposta = ?, idUsuario = ?, data = ?, titulo = ?, descricao = ? where id = ? limit 1";
        $consulta = $pdo->prepare( $sql );
        $consulta->bindParam( 1, $titulo );
        $consulta->bindParam( 2, $descricao );
        $consulta->bindParam( 3, $idResposta );
        $consulta->bindParam( 4, $idUsuario );
        $consulta->bindParam( 5, $data );
        $consulta->bindParam( 6, $id );
    } 

    if ($consulta->execute() ) {
     echo "<script>alert('Denuncia Registrada!');location.href='registroDenRes.php';</script>";
 } else {
    echo "<script>alert('Erro ao Denunciar');history.back();</script>";
}
}

?>