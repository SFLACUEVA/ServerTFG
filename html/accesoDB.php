
<?php
//SPDX-License-Identifier: GPL-2.0-or-later

// Array with names


// get the q parameter from URL

try {


	$p1 = $_REQUEST["m"];
	$p2 = $_REQUEST["t"];
	$p3 = $_REQUEST["c"];
	//$magnitud,$tipo,$cantidad
	$sqlcomanda = consultar($p1, $p2, $p3);
	
	//echo "\r\n";


	//echo "Abriendo base de datos\r\n";
	$db = new SQLite3('/var/www/html/DBSprint4');
	//echo "Consultando base de datos\r\n";
	//$results = $db->query($sqlcomanda);

	$results = $db->query($sqlcomanda);

	$respuesta = "";

	while ($row = $results->fetchArray()) {
		if ($p2 == "t") {
			for ($i = 0; $i < 4; $i++) {
				if (gettype($row[$i] === "string")) {
					$respuesta = $respuesta . $row[$i];
				} else {
					$respuesta = $respuesta . strval($row[$i]);
				}
				if ($i === 3) {
					$respuesta = $respuesta . "#";
				} else {
					$respuesta = $respuesta . "|";
				}
			}
		} else {
			$respuesta = $row[0];
		}
	}

	#echo "Cerrando base de datos\r\n";
	$db->close();
	if ($p2 == "t") {
		$respuesta = substr_replace($respuesta, "", -1);
	}
	//echo $sqlcomanda . "\n\r";
	echo $respuesta;
} catch (\Throwable $th) {
	echo "ERROR\r\n";
	echo "$th\r\n";
}
#SELECT * FROM mesures WHERE id_sensor = 1 ORDER BY temps DESC LIMIT 5;
function consultar($magnitud, $tipo, $cantidad)
{
	#magnitud temp,hum,co2,ppm,all

	#tipo
	#u -> max
	#l -> low
	#a -> avg
	#s -> start
	#f -> finish
	#t -> table

	$start = "SELECT ";
	$consulta = "";
	$mid = " FROM mesures WHERE id_sensor = ";

	switch ($tipo) {
		case "u":
			$consulta = "MAX(valor)";
			break;

		case "l":
			$consulta = "MIN(valor)";
			break;

		case "a":
			$consulta = "AVG(valor)";
			break;

		case "s":
			$consulta = "MIN(temps)";
			break;

		case "f":
			$consulta = "MAX(temps)";
			break;

		case "t":
			$consulta = "*";
			break;

		default:
			return "DESCONOCIDO\r\n";
	}


	$id_sens = "201;";
	switch ($magnitud) {
		case "t":
			$id_sens = "201";
			break;

		case "h":
			$id_sens = "202";
			break;

		case "c":
			$id_sens = "204";
			break;

		case "p":
			$id_sens = "205";
			break;


		default:
			return "DESCONOCIDO\r\n";
	}
	#SELECT * FROM(SELECT * FROM mesures WHERE id_sensor = 1 ORDER BY temps DESC LIMIT 5) ORDER BY temps ASC;
	$limite ="";
	if($cantidad != "-1"){
		$limite = " LIMIT " . $cantidad;
	}


	



	if ($tipo == "t") {

		return "SELECT * FROM(" . $start . $consulta . $mid . $id_sens . " ORDER BY temps DESC" . $limite . ") ORDER BY temps ASC;";
	} {
		return $start . $consulta . $mid . $id_sens . ";";
	}
}
