<!DOCTYPE html>
<html>
<head>
  <title>Eu sei</title>
  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" 
  href="../css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" 
  href="../css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" 
  href="../css/admin.css">
  

  <link rel="stylesheet" type="text/css" href="../css/summernote.css">
  <link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.min.css">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="http://forum.azyrusthemes.com/css/custom.css" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="http://forum.azyrusthemes.com/font-awesome-4.0.3/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="estilo.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="http://forum.azyrusthemes.com/rs-plugin/css/settings.css" media="screen" />

  <script type="text/javascript"
  src="../js/jquery-1.9.1.min.js"></script>
  <script type="text/javascript"
  src="../js/bootstrap.min.js"></script>
  <script type="text/javascript"
  src="../js/bootstrap-inputmask.min.js"></script>
  <script type="text/javascript"
  src="../js/jqBootstrapValidation.js"></script>
  <script type="text/javascript"
  src="../js/jquery.maskMoney.min.js"></script>

  <script type="text/javascript" src="../js/summernote.min.js"></script>
  <script type="text/javascript" src="../lang/summernote-pt-BR.js"></script>
  <script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
  <script defer src="../css/font/all.js"></script>
  <script type="text/javascript" src="../css/pooper.min.js"></script>

  <script>
    $(function () { 
      //validação dos campos
      $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); 
    } );
  </script>
</head> 
<body>  
  
 <div class="well container">
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

          <div class="avatar pull-left dropdown">
            <a data-toggle="dropdown" href="#"><img src="imagens/a.jpg" alt="" /></a> <b class="caret"></b>
            <ul class="dropdown-menu" role="menu">
              <li role="presentation"><a role="menuitem" tabindex="-1" href="perfil.php">Meu Perfil</a></li>
              <li role="presentation"><a role="menuitem" tabindex="-2" href="#">Caixa de Mensagem</a></li>
            </ul>
          </div>                            
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>


  
  <div class="col-lg-4 col-md-4">

    <!--Categorias -->
    <div class="sidebarblock">
      <h3>Categorias</h3>
      <div class="divline"></div>
      <div class="blocktxt">
        <ul class="cats">
          <li><a href="#">Tecnologia</a></li>
          <li><a href="#">Marketing </a></li>
          <li><a href="#">Processos Gerenciais </a></li>
          <li><a href="#">Cinema </a></li>
          <li><a href="#">Jogos </a></li>
          <li><a href="#">Politica</a></li>
          <li><a href="#">Esportes </a></li>
        </ul>
      </div>
    </div>

    

    <!-- Noticias-->
    <div class="sidebarblock">

      <h3>Os Melhores Do Mês</h3>

      <div class="divline"></div>
      <div class="avatar">
        <div class="blocktxt">
          <img src="imagens/a.jpg" alt="" />                                  
          <a href="#">Diogo - 100 pts</a>
        </div>

        <div class="divline"></div>
        <div class="avatar">
          <div class="blocktxt">
            <img src="imagens/a.jpg" alt="" />                                  
            <a href="#">Diogo - 100 pts</a>
          </div>

          <div class="divline"></div>
          <div class="avatar">
            <div class="blocktxt">
              <img src="imagens/a.jpg" alt="" />                                  
              <a href="#">Diogo - 100 pts</a>
            </div>

            <div class="divline"></div>
            <div class="avatar">
              <div class="blocktxt">
                <img src="imagens/a.jpg" alt="" />                                  
                <a href="#">Diogo - 100 pts</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-xs-12">
        <div class="pull-left"><a href="#" class="prevnext"><i class="fa fa-angle-left"></i></a></div>
        <div class="pull-left">
          <ul class="paginationforum">
            <li class="hidden-xs"><a href="#">1</a></li>
          </ul>
        </div>
        <div class="pull-left"><a href="#" class="prevnext last"><i class="fa fa-angle-right"></i></a></div>
        <div class="clearfix"></div>
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
</div>
