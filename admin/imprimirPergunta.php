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
        <thead>
          <tr>
            <td>ID</td>
            <td>Pergunta</td> 
            <td>Categoria</td>          
            <td>Nome</td>            
            <td>Data</td>
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
          $sql = "select p.*, u.nome, c.categoria from pergunta p join categoria c on (c.id = p.idcategoria) join usuario u on (u.id = p.idUsuario) where p.data >= ? and p.data <= ? order by p.data";
         $consulta = $pdo->prepare($sql);
         $consulta->bindParam(1, $datai);
         $consulta->bindParam(2, $dataf);
         $consulta->execute(); 

         while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
          $idPergunta = $dados->idPergunta;
          $pergunta = $dados->pergunta;
          $categoria = $dados->categoria;
          $nome = $dados->nome;
          $data = $dados->data;

          $data = date('d/m/Y', strtotime($data));
          
          echo "<tr>       
          <td>$idPergunta</td>
          <td>$pergunta</td> 
          <td>$categoria</td>          
          <td>$nome</td>            
          <td>$data</td>
          </tr>";
        }
      }

      ?>



    </body>
    </html>















