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


	$source = 'books.xml';

	$xmlstr = file_get_contents($source);
	$xmlcont = new SimpleXMLElement($xmlstr);
	$count = 0 ;
	$countBieuGhi = 0;
 	foreach($xmlcont as $url) 
 	{
		
		// Nhom 1 truong		
		$tenSach = docDuLieuMotTruong($url, "Tag_2");
		$boSungTenSach = docDuLieuMotTruong($url, "Tag_3");
		$lanTaiBan = docDuLieuMotTruong($url, "Tag_4");
		$namXuatBan = docDuLieuMotTruong($url, "Tag_10");
		$tungThu = docDuLieuMotTruong($url, "Tag_12");
		$phuChu = docDuLieuMotTruong($url, "Tag_15");
		$dacDiem = docDuLieuMotTruong($url, "Tag_19");
		$tomTat = docDuLieuMotTruong($url, "Tag_21");
		$tap = docDuLieuMotTruong($url, "Tag_22");		
		$tenSachDich = docDuLieuMotTruong($url, "Tag_28");
		$tenSachSongSong = docDuLieuMotTruong($url, "Tag_29");
		$monLoai = docDuLieuMotTruong($url, "Tag_161");
		$maHoa = docDuLieuMotTruong($url, "Tag_181");
		$ngayNhap = docDuLieuMotTruong($url, "Tag_191");
		
		if ($tap != "")
		{		
			$tenSach = $tenSach . " - " . $tap;
		}
        if ($boSungTenSach != "")
        {
            $tenSach = $tenSach . " : " . $boSungTenSach;
        }
		
		// Nhom 1 truong co 2 truong con
		$trangKho = xuLyDuLieuHaiTruong1($url, "Tag_11", "Tag_11_a", "Tag_11_b");
		$nhaXuatBan = xuLyDuLieuHaiTruong($url, "Tag_9", "Tag_9_a", "Tag_9_b");
		$noiXuatBan = xuLyDuLieuHaiTruong($url, "Tag_8", "Tag_8_a", "Tag_8_b");
											
		
		//In phich bo sung
		$inPhichBoSung = trim($url->Tag_24->Tag_24_g);
		if ($inPhichBoSung != "" && $inPhichBoSung[strlen($inPhichBoSung)-1] == ".")
		{
			$inPhichBoSung =  substr($inPhichBoSung,0,-1);
		}
		

		

		// Gia tien
		$i = count($url->Tag_14);
		$giaTien = "";
		for ($j=0 ; $j < $i ; $j++)
		{
			$giaTienTam = trim($url->Tag_14[$j]);
			if ($giaTienTam != "" && $giaTienTam[strlen($giaTienTam)-1] == ".")
			{
				$giaTienTam =  substr($giaTienTam,0,-1);
			}
			if(strlen($giaTienTam) > 3) 
			{
				$giaTien = str_replace("đ", "", str_replace(".", "", $giaTienTam));
				//$giaTien = $giaTienTam;
			}
		}
		
		
		
		//Ko co : isbn_issn
		$tenSach = trim(str_replace(array('\''), ' ',$tenSach)); 
		$gmd_id = utility::getID($dbs, 'mst_gmd', 'gmd_id', 'gmd_name', "Sách chữ", $gmd_id_cache);
		$gmd_id = $gmd_id ? trim(str_replace(array('\''), ' ',$gmd_id)) : 0;		
		$publisher_id = utility::getID($dbs, 'mst_publisher', 'publisher_id', 'publisher_name', $nhaXuatBan, $publ_id_cache);		
			
		$language_id = utility::getID($dbs, 'mst_language', 'language_id', 'language_name', "Tiếng Việt", $lang_id_cache);
		$language_id = $language_id ? trim(str_replace(array('\''), ' ',$language_id)) : "vi";
		$publish_place_id = utility::getID($dbs, 'mst_place', 'place_id', 'place_name', $noiXuatBan, $place_id_cache);
		$publish_place_id = $publish_place_id ? trim(str_replace(array('\''), ' ',$publish_place_id)) : 0;
		
        
        $monLoai = $monLoai ? trim(str_replace(array('\''), ' ',$monLoai)) : "NULL";
        $publisher_id = $publisher_id ? trim(str_replace(array('\''), ' ',$publisher_id)) : "NULL";
        $namXuatBan = $namXuatBan ? trim(str_replace(array('\''), ' ',$namXuatBan)) : "NULL";
        $lanTaiBan = $lanTaiBan ? trim(str_replace(array('\''), ' ',$lanTaiBan)) : "NULL";
		$tomTat = $tomTat ? trim(str_replace(array('\''), ' ',$tomTat)) : "NULL";		
        $trangKho = $trangKho ? trim(str_replace(array('\''), ' ',$trangKho)) : "NULL";         // collation
		$tungThu = $tungThu ? trim(str_replace(array('\''), ' ',$tungThu)) : "NULL";
		$maHoa = $maHoa ? trim(str_replace(array('\''), ' ',$maHoa)) : "NULL";
		if (strlen($tomTat) < 5) $tomTat = "NULL";
		// get current datetime
    	$curr_datetime = date('Y-m-d H:i:s');
    	$curr_datetime = '\''.$curr_datetime.'\'';
		         
        $sql_str = "INSERT IGNORE INTO biblio (title, gmd_id";        
        $sql_end = "VALUES ('$tenSach', $gmd_id"; 
        
        if ($lanTaiBan != "NULL") {
            $sql_str .= ", edition";        
            $sql_end .= ", '$lanTaiBan'";
        }

        if ($publisher_id != "NULL") {
            $sql_str .= ", publisher_id";        
            $sql_end .= ", '$publisher_id'";
        }

        if ($namXuatBan != "NULL") {
            $sql_str .= ", publish_year";        
            $sql_end .= ", '$namXuatBan'";
        }
        
        if ($trangKho != "NULL") {
            $sql_str .= ", collation";        
            $sql_end .= ", '$trangKho'";
        }
        
        if ($tungThu != "NULL") {
            $sql_str .= ", series_title";        
            $sql_end .= ", '$tungThu'";
        }
        
        if ($maHoa != "NULL") {
            $sql_str .= ", call_number";        
            $sql_end .= ", '$maHoa'";
        } 
        
        if ($language_id != "NULL") {
            $sql_str .= ", language_id";        
            $sql_end .= ", '$language_id'";
        }
        
        if ($publish_place_id != "NULL") {
            $sql_str .= ", publish_place_id";        
            $sql_end .= ", '$publish_place_id'";
        } 
        
        if ($monLoai != "NULL") {
            $sql_str .= ", classification";        
            $sql_end .= ", '$monLoai'";
        } 
        
        if ($tomTat != "NULL") {
            $sql_str .= ", notes";        
            $sql_end .= ", '$tomTat'";
        }
        
        $sql_str .= ", input_date, last_update) ";        
        $sql_end .= ", $curr_datetime, $curr_datetime)";                      
		
        $sql_str .= $sql_end; 
        //echo "<br/><br/>" . $sql_str . "<br/><br/>";
        /*
        $sql_str = "INSERT IGNORE INTO biblio (title, gmd_id, edition, publisher_id, publish_year, collation, series_title, call_number, language_id, publish_place_id, classification, notes, input_date, last_update)
                      VALUES ('$tenSach', $gmd_id, '$lanTaiBan', $publisher_id, '$namXuatBan', '$trangKho', '$tungThu', '$maHoa', '$language_id', $publish_place_id, '$monLoai', '$tomTat', $curr_datetime, $curr_datetime)";
		*/
        
		// send query
        $dbs->query($sql_str);
        $biblio_id = $dbs->insert_id;
		
		if (!$dbs->error) {
			// set authors
			// Nhom tac gia			
			
			$nguoiDichHieuDinh =trim($url->Tag_6);
			if ($nguoiDichHieuDinh != "" && $nguoiDichHieuDinh[strlen($nguoiDichHieuDinh)-1] == ".")
			{
				$nguoiDichHieuDinh =  substr($nguoiDichHieuDinh,0,-1);
			}
			
			
			$flag = false;
			$tacGiaTam = $nguoiDichHieuDinh;		
			include 'loc-tac-gia.php';
			
			$khuVucTacGia = trim($url->Tag_7);
			if ($khuVucTacGia != "" && $khuVucTacGia[strlen($khuVucTacGia)-1] == ".")
			{
				$khuVucTacGia =  substr($khuVucTacGia,0,-1);
			}
			
			$tacGiaTam = $khuVucTacGia;
			$flag = true;
			include 'loc-tac-gia.php';
            
			
			// Tu khoa
			$i = count($url->Tag_20);
			$arrTuKhoa = array();
			for ($j=0 ; $j < $i ; $j++)
			{
				 $tuKhoa = trim($url->Tag_20[$j]);
				 if ($tuKhoa != "" && $tuKhoa[strlen($tuKhoa)-1] == ".")
				{
					$tuKhoa =  substr($tuKhoa,0,-1);
				}
				 $arrTuKhoa[$j] = $tuKhoa;
			}
			importTuKhoa($biblio_id, $arrTuKhoa, 2, $dbs);
			
			
			
			
			
			
			// Kho Doc
			$i = count($url->Tag_27);
			
			for ($j=0 ; $j < $i ; $j++)
			{
			     $arrKhoDoc = array();
			     $khoDoc = str_replace("/", ".", str_replace(" ", ".", str_replace(",", "", str_replace(".", "" , str_replace("Đ", "D" , trim($url->Tag_27[$j]))))));				
				 if ($khoDoc != "" && $khoDoc[strlen($khoDoc)-1] == ".")
				{
					$khoDoc =  substr($khoDoc,0,-1);
				}
				if (strlen($khoDoc) > 15)
				{				                        
					$arrKhoDoc = themMaTaiLieu($khoDoc);				
                    importBieuGhiTheoMang($biblio_id, $arrKhoDoc, $giaTien, $curr_datetime, "PD", "MD", $dbs);
				}        				                  
                else
                {
                    importBieuGhi($biblio_id, $khoDoc, $giaTien, $curr_datetime, "PD", "MD", $dbs);   
                }
			     
			}		
			
            
   
			// Kho Muon
			$i = count($url->Tag_271);		
			
			for ($j=0 ; $j < $i ; $j++)
			{
			     $arrMuon = array();
				$khoMuon = str_replace("/", ".", str_replace(" ", ".", str_replace(",", "", str_replace(".", "" , str_replace("Đ", "D" , trim($url->Tag_271[$j]))))));
				//$khoMuon = str_replace("/", ".", str_replace(" ", ".", str_replace(".", "" , trim($url->Tag_271[$j]))));
				if ($khoMuon != "" && $khoMuon[strlen($khoMuon)-1] == ".")
				{
					$khoMuon =  substr($khoMuon,0,-1);
				}
				if (strlen($khoMuon) > 15)
				{				                        
					$arrMuon = themMaTaiLieu($khoMuon);
                    importBieuGhiTheoMang($biblio_id, $arrMuon, $giaTien, $curr_datetime, "PM", "CTM", $dbs);				
				}                				 
                 else {
                    importBieuGhi($biblio_id, $khoMuon, $giaTien, $curr_datetime, "PM", "CTM", $dbs);
                 }
			     
			}		
			
            
            
			// Kho Co so 3
			$i = count($url->Tag_272);
			$arrCS3 = array();
			for ($j=0 ; $j < $i ; $j++)
			{
			     $khoCS3 = str_replace("/", ".", str_replace(" ", ".", str_replace(",", "", str_replace(".", "" , str_replace("Đ", "D" , trim($url->Tag_272[$j]))))));
				//$khoCS3 = str_replace("/", ".", str_replace(" ", ".", str_replace(".", "" , trim($url->Tag_272[$j]))));
				if ($khoCS3 != "" && $khoCS3[strlen($khoCS3)-1] == ".")
				{
					$khoCS3 =  substr($khoCS3,0,-1);
				}
                if (strlen($khoCS3) > 15)
				{				                        
					$arrCS3 = themMaTaiLieu($khoCS3);				
                    importBieuGhiTheoMang($biblio_id, $arrCS3, $giaTien, $curr_datetime, "CS3","CTM", $dbs);
				}                				 
                else {
			         importBieuGhi($biblio_id, $khoCS3, $giaTien, $curr_datetime, "CS3", "CTM", $dbs);
                 }                 
			}           												
         }   
		 else
		 {
			 echo "Loi Bio  - $biblio_id<br/>";
			 //echo  $sql_str . "<br/><br/>";
		 }
		 $count++;
	}

?>
  