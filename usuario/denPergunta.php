<?php

include "menuUsuario.php";

$id = $titulo = $descricao = $idPergunta = $idUsuario = $data = "";

    //verificar se está editando
if (isset ( $_GET["id"] ) ) {
        //recuperar o id por get
    $idPergunta = trim( $_GET["id"] );
        //selecionar no banco de dados
    $sql = "select * from denunciapergunta where id = ? limit 1";
        //prepare
    $consulta = $pdo->prepare( $sql );
        //passar parametro
    $consulta->bindParam(1, $id );
        //execute
    $consulta->execute();
        //separar os dados
    $dados = $consulta->fetch(PDO::FETCH_OBJ);
}
$data = date_default_timezone_set('America/Sao_Paulo'); 
$data = date("d/m/Y");

?>

<div class="container">
    <div class="well">
        <div class="clearfix"></div>

        <form name="formcadastro" method="post" action="salvarDenuncia.php" novalidate>

            <h1>Denúnciar</h1>
            <div class="hidden">
                <label for="id">ID</label>
                <div class="controls">
                    <input type="text" 
                    name="id" readonly 
                    class="form-control" 
                    value="<?=$id;?>">
                </div>

                <label for="idPergunta">ID Pergunta</label>
                <div class="controls">
                    <input type="text" name="idPergunta" readonly
                    class="form-control" value="<?=$idPergunta;?>">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="idUsuario">Usuário:</label>
                        <div class="controls">
                            <input type="text" name="idUsuario"
                            class="form-control input1" readonly
                            value="<?=$_SESSION["usuario"]["id"];?>">
                        </div>
                    </div>
                </div>
            </div>          

            <main>                                     
                <?php
                                            //$sql = "select * from pergunta order by data desc";
                $sql = "select p.*, u.nome, c.categoria from pergunta p join usuario u on (u.id = p.idusuario) join categoria c on (c.id = p.idcategoria) where p.idPergunta = $idPergunta";
                $consulta = $pdo->prepare($sql);
                $consulta->execute(); 

                while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
                    $idPergunta = $dados->idPergunta;
                    $pergunta = $dados->pergunta;  
                    $nome = $dados->nome;
                    $data = $dados->data;
                    $categoria = $dados->categoria;

                    $data = date('d/m/Y', strtotime($data));
                    ?>
                    <div class="post" style="background: #F2F2F2">
                        <div class="wrap-ut pull-left">
                            <div class="userinfo pull-left">
                            </div>

                            <div class="posttext pull-left" id="menu">
                                <p><strong>Quem Denúnciou:</strong> <?=$nome;?></p>
                                <h3>Pergunta:<strong><?=$pergunta;?></strong></h3>
                                <p><strong>Categoria:</strong> <?=$categoria;?></p>
                                <p><strong>Data:</strong> <?=$data;?> </p>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                        </div><?php } ?>
                    </main>      

                <div class="row">
                    <div class="controls">
                        <div class="col-md-4">
                            <label for="data">Data: </label>
                            <input type="text" 
                            name="data" class="form-control input" readonly
                            required value="<?=$data;?>"
                            data-validation-required-message="Preencha o dataCad"
                            data-mask="99/99/9999">
                        </div>
                    </div>


                    <div class="col-md-4">
                        <label>Usuário: </label>
                        <input type="text" readonly class="form-control input"
                        value="<?=$_SESSION["usuario"]["nome"];?>">
                    </div> 
                    </div> 



                    <div class="row">
                        <div class="controls">
                            <div class="col-md-11">
                                <div class="control-group">
                                    <label name="titulo">Titulo: </label>
                                    <div class="controls">
                                        <textarea name="titulo" class="form-control" rows="2" value="<?=$titulo;?>"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="controls">
                            <div class="col-md-11">
                                <div class="control-group">
                                    <label name="descricao">Descrição: </label>
                                    <div class="controls">
                                        <textarea name="descricao" class="form-control" rows="5" value="<?=$descricao;?>"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>

                    <button type="submit" class="btn btn-success">Salvar Denuncia</button>






