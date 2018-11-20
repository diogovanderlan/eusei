<?php
	//iniciar a sessao
	//session_start();

	if ( !isset( $_SESSION["usuario"]["id"] ) ) {
		//direcionar para o index
		header( "Location: indexUsuario.php" );
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
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" 
      data-target="#menu" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="indexUsuario.php"><img src="../admin/imagens/123.png"></a>
    </div>

    <div class="collapse navbar-collapse" id="menu">
      <ul class="nav navbar-nav navbar-right">
        <li>
          <a href="sairUsuario.php">
          Olá <?php echo $_SESSION["usuario"]["login"];?>
          - Sair</a>
        </li>
      </ul>
    </div>
  </div>
</nav>






