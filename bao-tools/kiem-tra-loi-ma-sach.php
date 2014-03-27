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
        $dem1 = 0;
        while ($row = $kq->fetch_row()) {   
            /*
            if (substr($row[0], 1, 1) != ".")
            {
                if(substr($row[0], 0, 1) == "D" || substr($row[0], 0, 1) == "C" || substr($row[0], 0, 1) == "M")
                {
                    echo $row[0] . " - " . $row[1] . "<br/>";                    			
                }
            }
            */
            $arrTam = explode(".",$row[0]);
            
            if (strlen($arrTam[1]) > 2){
                //echo $arrTam[1] . "<br/>";
                $dem++;    
            }
            else {
                //echo $row[0] . "<br/>";
                $maMoi = '';
                if($arrTam[0] == 'D' || $arrTam[0] == 'M' || $arrTam[0] == 'C')
                {
                  $maMoi = $arrTam[0] . "." . $arrTam[1] . "" . $arrTam[2] . ".TK";                   
                }                                 
                elseif (strlen($arrTam[0]) > 1 )
                {
                    $maMoi = str_replace("M", "M.", str_replace("C", "C.", str_replace("D", "D.", $arrTam[0]))) . ".TK";
                }
                $sql_str = "UPDATE item SET item_code='".$maMoi."' WHERE item_id=" .$row[1]. "";
                $dbs->query($sql_str);
                echo $row[1] . " - " . $row[0] . " - " . $maMoi . "<br/>";
            }            
            
        }
        
        $te = $kq->num_rows - $dem;
        echo "<br/>" . $kq->num_rows . " - " . $dem . " - " . $te . "<br/>";
        //$query = $kq->fetch_row();
        //var_dump($query);
        /*
        for($i = 0 ; $i < $kq->num_rows ; $i++)
        {                 
            if ( substr($kq[$i], 1, 1) != ".")
            {
                echo $kq[$i] . "<br/>";
            }         
        }
        */        
    }
?>
  