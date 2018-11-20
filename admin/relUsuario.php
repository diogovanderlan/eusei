<?php
include "menu.php";

?>
<div class="container">
	<div class="well">
		<h1>Relatorio de Usuários</h1>

		<form name="form1" method="post" action="imprimirUsuario.php" class="form-inline rel">
			<label for="datai">Data Inicial:</label>
			<input type="text" name="datai" class="form-control" required data-mask="99/99/9999">

			<label for="dataf">Data Final:</label>
			<input type="text" name="dataf" class="form-control" required data-mask="99/99/9999">
			
			

			<button type="submit" class="btn btn-success">Buscar</button>
		</form>

	</div>
</div>