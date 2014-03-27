<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
define('INDEX_AUTH', '1');

// key to get full database access
define('DB_ACCESS', 'fa');

// main system configuration
require '../sysconfig.inc.php';
include 'cac-ham-xu-ly.php';

// IP based access limitation
require LIB.'ip_based_access.inc.php';

    //$sql_str = "SELECT item_code FROM item WHERE length(item_code) > 11";
    $sql_str = "SELECT item_code, item_id FROM item";
	$kq = $dbs->query($sql_str);     
	if ($kq->num_rows > 0)
    {
        $dem = 0;
        $arrMang = array();
        while ($row = $kq->fetch_row()) {   
            $arrTam = explode(".",$row[0]);
            
            if (strlen($arrTam[1]) > 2){
                array_push($arrMang,$arrTam[1]);
                //$dem++;    
            }            
        }                
        asort($arrMang);
        /*        
        foreach ($arrMang as $key => $val) {
            echo "$val<br/>";
        }
        */
        
        for ($i = 1286 ; $i < 29938 ; $i++)
        {
            if (!in_array($i, $arrMang)) {
                echo $i . "<br/>";
                $dem++;
            }
        }
        
        echo "AAA" . $dem . "AAA";
                                      
    }
?>
  