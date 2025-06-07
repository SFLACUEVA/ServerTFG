 <?php
require('basedades.inc');

echo "<a href='index.html'>TORNAR A LA PANTALLA PRINCIPAL</a>";
echo "<BR \>";
echo "<BR \>";

// Create connection
$conn = basedades_connectar( $hostName, $userName, $passCode, $databaseName);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$limit=isset($_REQUEST['limit'])?$_REQUEST['limit']:0;
if($limit) {
	$sql = "SELECT id_mesura, id_sensor, valor, temps FROM mesures ORDER BY id_mesura DESC LIMIT ".$limit;
}
else  {
	$sql = "SELECT id_mesura, id_sensor, valor, temps FROM mesures ORDER BY id_mesura DESC";
}
//$sql = "SELECT id_mesura, id_sensor, valor FROM mesures";
echo "SQL:[".$sql."]";
echo "<BR \>";
echo "<BR \>";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

	// output data of each row
	echo "<TABLE border=1>";

	echo "<TR>";
	echo "<TH>id_mesura</TH>";
	echo "<TH>id_sensor</TH>";
	echo "<TH>valor</TH>";
	echo "<TH>temps</TH>";
	echo "</TR>";

	while($row = mysqli_fetch_assoc($result)) {
		echo "<TR>";
		echo "<TD>".$row['id_mesura']."</TD>";
		echo "<TD>".$row['id_sensor']."</TD>";
		echo "<TD>".$row['valor']."</TD>";
		echo "<TD>".$row['temps']."</TD>";
		echo "</TR>";
	}
	echo "</TABLE>";

} 
else {
	echo "0 results";
	echo "<BR \>";
}

mysqli_close($conn);
?> 
