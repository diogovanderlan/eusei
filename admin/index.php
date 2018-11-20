<!DOCTYPE html>
<html>
<head>
	<title>Eu Sei</title>
	<meta charset="utf-8">

	<link rel="stylesheet" type="text/css" 
	href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" 
	href="../css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" 
	href="../css/admin.css">

	<script type="text/javascript"
	src="../js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript"
	src="../js/bootstrap.min.js"></script>
	<script type="text/javascript"
	src="../js/bootstrap-inputmask.min.js"></script>
	<script type="text/javascript"
	src="../js/jqBootstrapValidation.js"></script>
	<script type="text/javascript"
	src="../js/jquery.maskMoney.min.js"></script>

	<script>
		$(function () { 
  		//validação dos campos
  		$("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); 
  		
  	} );
  </script>
</head>
<body>

	<div id="login">
		<h1>Bem Vindo!</h1>
		<h2>Login</h2>

		<form name="login" method="post" action="verifica.php" novalidate>

			<div class="control-group">
				<label class="control-label">
					Login:
				</label>
				<div class="controls">
					<input type="text"
					name="login" required
					data-validation-required-message="Preencha o login"
					class="form-control">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">
					Senha:
				</label>
				<div class="controls">
					<input type="password" 
					name="senha" class="form-control"
					required data-validation-required-message="Preencha sua senha">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">Função</label>
				<div class="controls">
					<select name="funcao" class="form-control" required data-validation-required-message="selecione">
						<option value="adm">Administrador</option>
					
					</select>
				</div>
				
			</div>


			<button id="botao" type="submit" 
			class="btn btn-primary">
			<strong>Efetuar Login</strong>
		</button>
	</form>
</div>

</body>
</html>



