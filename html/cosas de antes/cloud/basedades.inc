<?php

$hostName = 'localhost';
$userName = 'adstruser';
$passCode = 'ADSTR2020euss';
$databaseName = 'adstrdb';


function basedades_connectar( $hostName, $userName, $passCode, $databaseName ) {

    $connectionString = mysqli_connect( $hostName, $userName, $passCode, $databaseName );
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    //mysqli_query(connectionString,"SET NAMES 'utf8'");
    return $connectionString;
}


function basedades_insertar( $conn, $sql ) {

	if (mysqli_query($conn, $sql)) {
	  echo "New record created successfully";
	} else {
	  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

    return mysqli_insert_id( $conn );
}

function basedades_desconnectar( $connectionString ) {
 	mysqli_close($connectionString);
}

?>

