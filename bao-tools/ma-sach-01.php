<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
define('INDEX_AUTH', '1');

// key to get full database access
define('DB_ACCESS', 'fa');

// main system configuration
require '../sysconfig.inc.php';

// IP based access limitation
require LIB.'ip_based_access.inc.php';

    //$sql_str = "SELECT item_code FROM item WHERE length(item_code) > 11";
    $sql_str = "SELECT item_code, item_id FROM item";
	$kq = $dbs->query($sql_str);
    $arr = array();     
	if ($kq->num_rows > 0)
    {
        
        while ($row = $kq->fetch_row()) {               
            $test = str_replace("K", "", str_replace("T", "", str_replace("C", "", str_replace("M", "", str_replace("D", "", str_replace(".", "", $row[0]))))));            
            array_push($arr, $test);
        }
        sort($arr);
        for ($i = 0 ; $i < count($arr) ; $i++)
        {
            echo $arr[$i] . "<br/>"; 
        }        
    }
?>
  