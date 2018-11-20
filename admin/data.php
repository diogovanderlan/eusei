<?php

if ( isset ( $_GET["data"] ) ) {

		//recuperar a data
	$data = trim ( $_GET["data"] );
		//normal 03/08/2017
		//$data = DateTime::createFromFormat( "d/m/Y", $data );
		//modificar o formato da data
		/*
		$novadata = $data->format("Y-m-d");
		echo $novadata;
		echo "Só o dia " . $data->format("d");
		echo "<br>Dia " . $data->format("D");
		*/
		
		/*
		$ano = $data->format("Y");
		$mes = $data->format("m");
		$dia = $data->format("d");*/



		if ( $data == "__/__/____" ) {

			echo "Preencha a data";

		} else {

			$data = explode("/",$data);

			//print_r ( $data );

			$dia = (int)$data[0];
			$mes = (int)$data[1];
			$ano = (int)$data[2];

			//echo "$dia/$mes/$ano $ano-$mes-$dia";

			if ( checkdate($mes, $dia, $ano) ) {
				echo "ok";
			} else {
				echo "Digite um data válida";
			}

		}

	} else {
		echo "Data inválida!";
	}

	date_default_timezone_set('America/Sao_Paulo');
	?>