<?php

include "menu.php";
?>
<!DOCTYPE html>
<html>
<head>
  <title>EuSei</title>
  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script>
    $(function () { 
      //validação dos campos
      $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); 
    } );
  </script>
</head>
<body>
  <div class="container">
    <div class="color">
      <div class="row">
        <div class="col-md-3">
          <h2><strong>EUSEI</strong></h2> 
        </div>
        <div class="col-md-9">
          <h5 class="text-center">
            <strong>EuSei - Site de Perguntas e Respostas</strong>
            <br>
            <strong> www.eusei.com.br</strong>
          </h5>        
        </div>
      </div><!-- Cabeçalho -->

      <table class="table table-bordered">
        <thead bgcolor="#4169E1">
          <tr>
            <td>ID</td>
            <td>Usuario</td> 
            <td>Data de Cadastro</td>  
                   
          </tr>
        </thead>
        <?php 

        $datai = $_POST["datai"];
        $dataf = $_POST["dataf"];
        //formatar as datas
        $datai = formatardata($datai);
        $dataf = formatardata($dataf);

        //verificar se a data final e menor que a inicial
        if ( strtotime( $datai ) > strtotime ( $dataf ) ) {
          echo "<script>alert('A data inicial não pode ser maior que a data final');history.back();</script>";
        } else {
          $sql = "select * from usuario where dataCad >= ? and dataCad <= ? order by dataCad";

          $consulta = $pdo->prepare($sql);
          $consulta->bindParam(1, $datai);
          $consulta->bindParam(2, $dataf);
          $consulta->execute();

          $conta = $consulta->rowCount();

          echo "<h2>Foram encontrados $conta 
          cadastros:</h2>";

          while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
           $id = $dados->id;
           $nome = $dados->nome; 
           $dataCad = $dados->dataCad;   

           $dataCad = date('d/m/Y', strtotime($dataCad));

           echo "<tr>       
           <td>$id</td>
           <td>$nome</td>
           <td>$dataCad</td>            
           </tr>";
         }
       }


       ?>



     </body>
     </html>















