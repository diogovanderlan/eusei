<?php
include "menu.php";


$pergunta =  $resposta = "";

if ( !isset( $_SESSION["admin"]["id"] ) ) {
        //direcionar para o index
    header( "Location: index.php" );
}

    //incluir o arquivo para conectar no banco
include "../config/conecta.php";
?>


<div class="well container">
    <div class="clearfix"></div>
    <?php
    $palavra = "";
    if ( isset ( $_GET["palavra"] ) ) $palavra = trim ( $_GET["palavra"] );

    $palavra = "%$palavra%";

            //buscar da pergunta
    $sql = "select * from pergunta where pergunta like ? order by pergunta";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(1, $palavra);
            //executar o sql
    $consulta->execute();

            //conta as linhas de resultado
    $conta = $consulta->rowCount();
    ?>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Eu sei</title>


        
        <link href="../css/admin.css" rel="stylesheet">

    </head> 
    <body>  
        <div class="banner">
            <img src="imagens/logo.png" />            
        </div>
        <!-- //Slider -->

        <div class="headernav">
            <div class="container">
                <div class="row">
                    <div class="col-lg-1 col-xs-3 col-sm-2 col-md-2"></div>
                    <div class="col-lg-4 search hidden-xs hidden-sm col-md-3">
                        <div class="wrap">

                            <form action="formpesquisa" method="post" class="form">
                                <div class="pull-left txt"><input type="text" class="form-control" placeholder="Buscar Pergunta"></div>
                                <div class="pull-right"><button class="btn btn-default" type="button"><i class="fas fa-search"></i></button></div>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                              <div class="col-lg-4 col-xs-12 col-sm-5 col-md-4 avt">
                            <div class="stnt pull-left">                            
                                <form action="pergunta.php" method="post" class="form">
                                    <button class="btn btn-danger">Faça uma Pergunta</button>
                                </form>
                            </div>
                            <div class="env pull-left"><i class="fa fa-envelope"></i></div>

                            <?php

                            $per = $_SESSION["admin"]["id"];

                            $sql = "select * from usuario where id = $per";
                            $consulta = $pdo->prepare($sql);
                            $consulta->execute();

                            while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
                              $id = $dados->id;
                              $nome = $dados->nome; 
                              $imagem = $dados->imagem;
                              $email = $dados->email;
                              $login = $dados->login;

                              $imagem = $imagem . "p.jpg";
                              $img = "<img src='../fotos/$imagem'";
                              
                          }

                          ?>

                          <div class="avatar pull-left dropdown">
                            <a href="perfil.php">
                                <?php
                                echo" <img src='../fotos/$imagem' id='psy'>";                               
                                ?>
                            </a>
                        </div>                            
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <br>                                        
            
            <div class="container">

                <main>
                    <?php
                    if ( isset ($_GET["id"]) ) $idPergunta = trim ( $_GET["id"] );
                    $sql2 = "select p.*, u.nome, c.categoria from pergunta p join usuario u on u.id = p.idUsuario join categoria c on c.id = p.idcategoria where idPergunta = ? ";
                    $consulta2 = $pdo->prepare($sql2);
                    $consulta2->bindParam(1, $idPergunta );
                    $consulta2->execute();

                    while ( $dados2 = $consulta2->fetch(PDO::FETCH_OBJ) ) {
                        $idPergunta = $dados2->idPergunta;
                        $pergunta = $dados2->pergunta;
                        $nome = $dados2->nome;
                        $categoria = $dados2->categoria;
                        $data = $dados2->data;

                        $data = date('d/m/Y', strtotime($data));

                        ?>                                  
                        <div class="post">
                            <div class="wrap-ut pull-left">
                                <div class="userinfo pull-left">
                                </div>
                                
                                <div class="posttext pull-left" id="menu">
                                   <p>Nome: <?=$nome;?></p>
                                   <h1><?=$pergunta;?></h1> 
                                   <p>Categoria: <?=$categoria;?></p>
                                   <p>Data: <?=$data;?></p>

                               </div>             

                               <div class="clearfix"></div>


                           </div>                              
                           <div class="postinfobot">

                            <div class="clearfix"></div>

                        </div>
                    </div><!-- POST -->
                <?php } ?>
                
                <div class="col-lg-8 col-md-8">
                    <main>

                        <h3>Respostas</h3>
                        <?php 
                        if ( isset ($_GET["id"]) ) $id = trim ( $_GET["id"] );
                        
                        $sql1 = "select r.id, r.resposta, r.data, u.nome from resposta r join usuario u on u.id = r.idUsuario where idPergunta = ?  and u.ativo = 'sim'";
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
                            <div class="post">
                                <div class="wrap-ut pull-left">
                                    <div class="userinfo pull-left">
                                    </div>
                                    
                                    <div class="posttext pull-left" id="menu">
                                        <p>Usuario: <?=$nome;?></p>
                                        <h3><?=$resposta;?></h3>
                                        <p>Data: <?=$data;?></p>             
                                         
                                         <?php
                                                $sql = "select * from curtidas where idResposta = $idResposta and curtida = 1";

                                                $cont = $pdo->prepare($sql);

                                                        //executar o sql
                                                $cont->execute();

                                                        //conta as linhas de resultado
                                                $conta = $cont->rowCount();

                                                ?>

                                        <a href="curtir.php?id=<?=$idResposta;?>" class='btn btn-success' alt="curtir">(<?=$conta;?>) Gostei </a>

                                        <?php
                                                $sql = "select * from curtidas where idResposta = $idResposta and curtida = 2";

                                                $cont = $pdo->prepare($sql);

                                                        //executar o sql
                                                $cont->execute();

                                                        //conta as linhas de resultado
                                                $conta = $cont->rowCount();

                                                ?>

                                        <a href="curtir2.php?id=<?=$idResposta;?>" class='btn btn-danger' alt="descurtir"> (<?=$conta;?>) Não Gostei</a>   

                                        <a href='denResposta.php?id=<?=$idResposta;?>' class='btn btn-warning'>Denunciar</a>  

                                    </div>             
                                    

                                    <div class="clearfix"></div>
                                </div>                              
                                <div class="postinfobot">                                                
                                    <div class="clearfix"></div>
                                </div>
                            </div><!-- POST -->

                        <?php } ?>

                        
                        
                    </main>

                    <div class="hidden">
                        <form name="formcadastro" method="post" action="salvarResposta.php" novalidate>



                            <label for="idPergunta">ID Pergunta</label>
                            <div class="controls">
                                <input type="text" readonly
                                name="idPergunta" class="form-control"
                                value="<?=$idPergunta;?>">
                            </div>          


                            <div class="row">   
                                <div class="col-md-6">
                                    <label class="control-label">Usuário:</label>
                                    <div class="controls">
                                        <input type="text" name="idUsuario"
                                        class="form-control input1" readonly
                                        value="<?=$_SESSION["admin"]["id"];?>">

                                        <input type="text" readonly class="form-control input2"
                                        value="<?=$_SESSION["admin"]["nome"];?>">
                                    </div> <!-- controls -->
                                </div> <!-- col-md -->
                            </div>

                            <div class="control-group">
                                <label for="data">Data</label>
                                <div class="controls">
                                    <input type="text" 
                                    name="data"
                                    class="form-control" readonly
                                    required value="<?=$data;?>"
                                    data-validation-required-message="Preencha o dataCad"
                                    data-mask="99/99/9999">
                                </div>
                            </div>         

                        </div> 
                        
                        <div class="controls">
                            <div class="col-md-11">
                                <div class="control-group">
                                    <label name="resposta"> resposta: </label>
                                    <div class="controls">
                                        <textarea name="resposta" class="form-control" rows="5" value="<?=$resposta;?>"></textarea>
                                    </div>
                                    <br>

                                    <button type="submit" class="btn btn-success">Salvar Resposta</button>


                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>  
                    </div>                                  




                    <br><br><br>
                    <div class="col-lg-4 col-md-4">
                        <!--Categorias -->
                        <div class="sidebarblock">
                            <h3>Categorias</h3>
                            <?php 
                            $sql = "select * from categoria order by categoria";
                            $consulta = $pdo->prepare($sql);
                            $consulta->execute();
                            while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
                             $id = $dados->id;
                             $categoria = $dados->categoria;
                             ?>


                             <div class="blocktxt">
                                <ul class="cats">
                                    <li><a href="home2.php?idcategoria=<?=$id;?>"><?=$categoria;?> 
                                    <span class="badge pull-right" id="nse"> 
                                        <div class="postinfo pull-left">
                                            <div class="comments">
                                                <div class="commentbg">
                                                    <?php

                                                    $sql = "select * from pergunta where idcategoria = $id  ";

                                                    $cont = $pdo->prepare($sql);

                                                        //executar o sql
                                                    $cont->execute();

                                                        //conta as linhas de resultado
                                                    $conta = $cont->rowCount();

                                                    echo "<p> $conta </p>";

                                                    ?>
                                                    <div class="mark"></div>
                                                </div>                                            
                                            </div>                                                                           
                                        </div>
                                        <div class="clearfix"></div>
                                    </span></a></li>


                                </ul>
                            </div>
                        <?php } ?>
                    </div>                        

                    <!-- Noticias-->
                    <div class="sidebarblock">

                        <h3>Os Melhores Do Mês</h3>

                        <div class="sidebarblock">
                            <?php 
                            $sql = "select * from usuario";
                            $consulta = $pdo->prepare($sql);
                            $consulta->execute();
                            while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
                             $id = $dados->id;
                             $nome = $dados->nome;
                             ?>
                             <div class="divline"></div>
                             <div class="blocktxt">
                                <ul class="cats">
                                    <li><a href="perfil2.php?id=<?=$id;?>"><?=$nome;?> <span class="badge pull-right"  id="nse">
                                     <div class="postinfo pull-left">
                                        <div class="comments">
                                            <div class="commentbg">
                                                <?php

                                                $sql = "select * from resposta where idusuario = $id  ";

                                                $cont = $pdo->prepare($sql);

                                                        //executar o sql
                                                $cont->execute();

                                                        //conta as linhas de resultado
                                                $conta = $cont->rowCount();

                                                echo "<p> $conta Pts </p>";

                                                ?>
                                                <div class="mark"></div>
                                            </div>                                            
                                        </div>                                                                           
                                    </div>
                                    <div class="clearfix"></div>
                                </span></a></li>


                            </ul>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>


</section>
<footer>
    <div class="container">
        <div class="row">                      
            <div class="col-lg-8 col-xs-9 col-sm-5" style="text-align: center;">Copyrights 2018, eusei.com.br</div>
            <div class="col-lg-3 col-xs-12 col-sm-5 sociconcent">
                <ul class="socialicons">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                    <li><a href="#"><i class="fa fa-cloud"></i></a></li>
                    <li><a href="#"><i class="fa fa-rss"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
</div>

<!-- get jQuery from the google apis -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.js"></script>


<!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
<script type="text/javascript" src="rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
<script type="text/javascript" src="rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

<script src="js/bootstrap.min.js"></script>

</body>
</html>
