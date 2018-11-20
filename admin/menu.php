<?php
	//iniciar a sessao
session_start();

if ( !isset( $_SESSION["admin"]["id"] ) ) {
		//direcionar para o index
  header( "Location: index.php" );
}

	//incluir o arquivo para conectar no banco
include "../config/conecta.php";

  //funcao para formatar datas 
function formatardata($data) {
    // 29/09/2017 -> 2017-09-29
  $data = explode( "/", $data );
  $data = $data[2]."-".$data[1]."-".$data[0];
  return $data;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Eu sei</title>
	<meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" 
  href="../css/bootstrap.min.css">
  
  <link rel="stylesheet" type="text/css" 
  href="../css/admin.css">
  

  <link rel="stylesheet" type="text/css" href="../css/summernote.css">
  <link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.min.css">

  <script type="text/javascript"
  src="../js/jquery-1.9.1.min.js"></script>
  <script type="text/javascript"
  src="../js/bootstrap.min.js"></script>
  <script type="text/javascript"
  src="../js/bootstrap-inputmask.min.js"></script>
  <script type="text/javascript"
  src="../js/jqBootstrapValidation.js"></script>

  <script type="text/javascript" src="../js/summernote.min.js"></script>
  <script type="text/javascript" src="../lang/summernote-pt-BR.js"></script>
  <script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
  <script defer src="../css/font/all.js"></script>

  <script>
  	$(function () {
      //validação dos campos
      $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); 
    } );
  </script>
</head>
<body>

  <div id="mascara">
    <img src="imagens/load.gif">
    Aguarde, carregando...
  </div>

  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
     
      <div class="navbar-header">
        <a class="navbar-brand" href="home.php">Eu Sei</a>
      </div>

      <div class="collapse navbar-collapse" id="menu">
        <ul class="nav navbar-nav navbar-right">
         <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cadastros <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li>
              <a href="usuario.php">Usuário</a>
            </li>
            <li>
              <a href="categoria.php">Categoria</a>
            </li>
            <li>
              <a href="pergunta.php">Pergunta</a>
            </li>         
            <li>
              <a href="resposta.php">Resposta</a>
            </li>       
            <li>
              <a href="denPergunta.php">Denúnciar Pergunta</a>
            </li>
            <li>
              <a href="denResposta.php">Denúnciar Resposta</a>
            </li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sala <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li>
              <a href="perguntas.php">Suas Perguntas</a>
            </li>
            
            
          </ul>
        </li>

         <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Denuncias <span class="caret"></span></a>
          <ul class="dropdown-menu">
           <li>
            <a href="registroDenRes.php">Respostas</a>
          </li>
          <li>
            <a href="registroDenuncia.php">Perguntas</a>
          </li>
          
        </ul>
      </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Listas <span class="caret"></span></a>
          <ul class="dropdown-menu">
           <li>
            <a href="listarUsuario.php">Usuario</a>
          </li>
          <li>
            <a href="listarCategoria.php">categoria</a>
          </li>
          <li>
            <a href="listarPergunta.php">Pergunta</a>
          </li>
          <li>
            <a href="listarResposta.php">Resposta</a>
          </li>
          

        </ul>
      </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Relatórios <span class="caret"></span></a>
          <ul class="dropdown-menu">
           <li>
            <a href="relPerguntas.php">Perguntas</a>
          </li>
          <li>
            <a href="relUsuario.php">Usuarios</a>
          </li>
          <li>
            <a href="relRespostas.php">Respostas</a>
          </li>
          <li>
            <a href="relDenunciaPergunta.php"> Denuncia Pergunta</a>
          </li>
        </ul>
      </li>
      <li>
       <a href="sair.php" id="sair">
         Olá <?php echo $_SESSION["admin"]["login"];?>
       - Sair</a>
     </li>
     <!-- <li>
       <a href="sair.php" class="">

       </a>
     </li> -->
   </ul>
 </div>
</div>
</nav>







