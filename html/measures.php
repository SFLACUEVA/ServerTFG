<?php   

try {      
    $f= $_REQUEST["f"];
    $t= $_REQUEST["t"];

    
    switch ($f) {
        case 't':
            $db = new SQLite3('/var/www/html/measures.db');
            $sel = 'SELECT Tabla FROM summary';
            $results = $db->query($sel);
            $res = "";
            while ($row = $results->fetchArray()) {
                $res = $res . $row[0]. '|';
            }
            $db->close();
            echo $res;
            break;

        case 'v':
            $db = new SQLite3('/var/www/html/measures.db');
            $sel = 'SELECT * FROM "'. $t .'";';
            $results = $db->query($sel);
            $res = "";
            while ($row = $results->fetchArray()) {

                for ($i = 0; $i < 4; $i++) {
                    if($i==3) {$res = $res . $row[$i]. '#';}
                    else {$res = $res . $row[$i]. '|';}
                }
            }
            $db->close();
            echo $res;
            break;

         case 's':
            $db = new SQLite3('/var/www/html/measures.db');
            $sel = 'SELECT * FROM summary WHERE Tabla="' . $t .'";' ;
            $results = $db->query($sel);
            $res = "";
            while ($row = $results->fetchArray()) {

                for ($i = 0; $i < 16; $i++) {
                    $res = $res . $row[$i];
                    if($i!=15) {$res = $res.'|';}
                }
            }
            $db->close();
            echo $res;
            break;
        
        
        default:
            # code...
            break;
    }

} 
catch (Exception $e) {
    echo $e->getMessage();
}

?>