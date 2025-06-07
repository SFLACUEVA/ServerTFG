<?php
// Array with names


// get the q parameter from URL

try{
$q = $_REQUEST["q"];

if ($q!=="0"){
	$result = "";
	if($q === "adios"){
		$result = "hola";
	} else {
		$result = "adios";
	}

echo $result;

}

$v = $_REQUEST["v"];

if ($v==="1"){

$out ="";
$db = new SQLite3('/home/pi/Desktop/Proyecto/IIoT/src/medir/DBSprint4');
$results = $db->query('SELECT * FROM mesures');


while ($row = $results->fetchArray()) {
	for ($i = 0; $i < 4; $i++)
	{
		if(gettype($row[$i]==="string")){
			$out = $out . $row[$i];
		} else {
			$out = $out . strval($row[$i]);
		}
		if($i===3){
			$out = $out . "#";
		} else {
			$out = $out . "|";
		}	
	}
}
$db->close();
$out=substr_replace($out,"", -1);
echo $out;

}





} catch (\Throwable $th)  {
	echo "ERROR\r\n";
	echo "$th\r\n";

	}
