<?php
consulta();

function consulta(){
	try{
		
	echo "Abriendo base de datos\r\n";
	$db = new SQLite3('/var/www/html/DBSprint4');
	echo "Consultando base de datos\r\n";
	$results = $db->query('SELECT * FROM mesures');

while ($row = $results->fetchArray()) {
	for ($i = 0; $i < 4; $i++)
	{
		echo "$row[$i] ";
		
	}
	echo "\r\n";
}
	echo "Cerrando base de datos\r\n";
	$db->close();

	} catch (\Throwable $th)  {
	echo "ERROR\r\n";
	echo "$th\r\n";

	}
}

?>
