<?php
    //incluir o menu
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
        <div class="col-lg-8 col-md-8">
            <!-- POST -->
            <main>                                     
                <?php 

                if ( isset ( $_GET["idcategoria"] ) ) $idcat = trim ( $_GET["idcategoria"] );
                                            //$sql = "select * from pergunta order by data desc";
                $sql = "select p.*, u.nome, c.categoria from pergunta p join usuario u on (u.id = p.idusuario) join categoria c on (c.id = p.idcategoria) where p.idcategoria = $idcat";
                $consulta = $pdo->prepare($sql);
                $consulta->execute(); 

                while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
                    $id = $dados->idPergunta;
                    $pergunta = $dados->pergunta;  
                    $nome = $dados->nome;
                    $data = $dados->data;
                    $categoria = $dados->categoria;

                    $data = date('d/m/Y', strtotime($data));
                    ?>
                    <div class="post">
                        <div class="wrap-ut pull-left">
                            <div class="userinfo pull-left">
                            </div>
                            
                            <div class="posttext pull-left" id="menu">
                               <p><strong>Quem Perguntou:</strong> <?=$nome;?></p>
                                <h3>Pergunta: <strong><?=$pergunta;?></strong></h3>
                                <p><strong>Categoria:</strong> <?=$categoria;?></p>
                                <p><strong>Data:</strong> <?=$data;?> </p>
                               <a href="resposta.php?id=<?=$id;?>" class="btn btn-success">
                                Responder
                            </a>
                            <a href="respostas.php?id=<?=$id;?>" class="btn btn-success">
                                Ver Respostas
                            </a>
                            <a href="denPergunta.php?id=<?=$id;?>" class="btn btn-warning">
                                Denunciar
                            </a>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                    <div class="postinfo pull-left" id="nse">
                        <div class="comments">
                            <div class="commentbg">
                                <?php

                                $sql = "select * from resposta where idPergunta = $id";
                                
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
                    </div><?php } ?>
                </main>

            </div>

            <div class="col-lg-4 col-md-4">
                <!--Categorias -->
                <div class="sidebarblock">
                    <h3><strong>Categorias</strong></h3>
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

                <h3><strong>Os Melhores Do Mês</strong></h3>

                <div class="sidebarblock">
                    <?php 
                     $sql = "select u.*, r.idUsuario, count(r.resposta) from usuario u join resposta r on (r.idUsuario = u.id) where r.idUsuario = u.id group by u.nome  and u.ativo = 'sim' order by r.idUsuario ASC";
                    $consulta = $pdo->prepare($sql);
                    $consulta->execute();
                    while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
                       $id = $dados->id;
                       $nome = $dados->nome;
                       ?>
                       <div class="divline"></div>
                       <div class="blocktxt">
                        <ul class="cats">
                            <li><a href="perfil2.php?id=<?=$id;?>"><?=$nome;?> <span class="badge pull-right" id="nse">
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


