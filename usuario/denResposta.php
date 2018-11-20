<?php
    //incluir o menu
include "menuUsuario.php"; 

$id = $titulo = $descricao = $idResposta = $idUsuario = $data = "";

    //verificar se esta editando
if (isset ( $_GET["id"] ) ) {

        //recuperar o id por get
    $idResposta = trim( $_GET["id"] );
        //selecionar no banco de dados
    $sql = "select * from denunciarresposta where id = ? limit 1";
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
        
        <form name="formcadastro" method="post" action="salvarDenRes.php" novalidate>

            <h1>Denunciar Resposta</h1>
            <label for="id" hidden  >ID</label>
            <div class="controls" >
                <input type="text" class="hidden" readonly name="id" class="form-control" value="<?=$id;?>">


                <label for="idResposta" class="hidden">ID Resposta</label>
                <div class="controls">
                    <input type="text" name="idResposta" readonly
                    class="form-control hidden" value="<?=$idResposta;?>">
                </div>    

                <label for="idUsuario" hidden>ID Usuario</label>
                <div class="controls hidden">
                    <input type="text" readonly 
                    name="idUsuario" class="form-control hidden"
                    value="<?=$_SESSION["usuario"]["id"];?> ">
                </div> 
            </div> 

            <main>
                <?php

                $sql1 = "select r.id, r.resposta, r.data, u.nome from resposta r join usuario u on u.id = r.idUsuario where r.id = $idResposta";
                $consulta1 = $pdo->prepare($sql1);
                $consulta1->bindParam(1, $id);
                $consulta1->execute();

                while ( $dados1 = $consulta1->fetch(PDO::FETCH_OBJ) ) {
                    $idResposta = $dados1->id;
                    $resposta = $dados1->resposta;
                    $nome = $dados1->nome;
                    $data = $dados1->data;


                    $data = date('d/m/Y', strtotime($data));

                    ?> 
                    <div class="row">
                        <div class="col-md-11">                                         
                         <div class="post" style="background: #F2F2F2">
                            <div class="wrap-ut pull-left">
                                <div class="userinfo pull-left">
                                </div>

                                <div class="posttext pull-left" id="menu">
                                    <p>Usuario: <?=$nome;?></p>
                                    <h3><?=$resposta;?></h3>
                                    <p>Data: <?=$data;?></p> 


                                </div>             


                                <div class="clearfix"></div>
                            </div>                              
                            <div class="postinfobot">                                                
                                <div class="clearfix"></div>
                            </div>
                        </div><!-- POST -->
                    </div>
                </div>

            <?php } ?>



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

            <div class="clearfix"></div>
            <button type="submit" class="btn btn-success">Salvar Denuncia</button>



            <div>

            </div>            
        </div>

    </div>
</div>