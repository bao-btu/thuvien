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


$number_q = $dbs->query('SELECT item_code
		   FROM item
		   WHERE biblio_id = 361');
	var_dump($number_q); 
?>
  