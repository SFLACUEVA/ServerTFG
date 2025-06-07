<?php

// http://localhost/guardar_dades_adaptat.php?id_sensor=1&valor=108&temps=2020-12-25+12%3A45%3A55

echo "Hello des de guardar_dades_adaptat.php\n";
echo "<BR \>";

require('basedades.inc');

$connectionString = basedades_connectar( $hostName, $userName, $passCode, $databaseName);

//$sql = "INSERT INTO mesures( id_mesura, id_sensor, valor ) VALUES('".$_REQUEST['id_mesura']."', '".$_REQUEST['id_sensor']."', '".$_REQUEST['valor']."');";

//echo "<BR \>";
//echo "variable request: ",var_dump($_REQUEST);
//echo "<BR \>";
//echo "<BR \>";
//echo "temps, valor: ", $_REQUEST['temps'], " ,  ",$_REQUEST['valor'];
//echo "<BR \>";

//$cols = implode(',', array_keys($_REQUEST));

foreach (array_keys($_REQUEST) as $key)
{
	$value=$_REQUEST[$key];
	if($value != "")
	{
//	  echo "columna: ", $key;
//	  echo "<BR \>";
	  isset($col) ? $col .= ',' : $col = '';
 	  $col .= $key;
//	  echo "columnes: ", $col;
//	  echo "<BR \>";

          isset($vals) ? $vals .= ',' : $vals = '';
          $vals .= '\''.$value.'\'';
//	  echo "VALUE: ",$value, "   -->   ", $vals;
//          echo "<BR \>";
	} 
	else { 
	  echo "No hi ha inclòs cap valor a : ", $key;
	  echo "<BR \>"; 
	}
}


//foreach (array_values($_REQUEST) as $value)
//{

//	isset($vals) ? $vals .= ',' : $vals = '';
//	$vals .= '\''.$value.'\'';

//	echo "VALUE:",$value, "   -->   ", $vals;
//	echo "<BR \>";
//}

$table = 'mesures';
$sql = 'INSERT INTO '.$table.' ('.$col.') VALUES ('.$vals.')';



echo "SQL:".$sql;
echo "<BR \>";

$result = basedades_insertar( $connectionString, $sql );

echo "result=".$result;
echo "<BR \>";
echo "<BR \>";

basedades_desconnectar( $connectionString );

echo "<a href='index.html'>TORNAR A LA PANTALLA PRINCIPAL</a>";

?>
