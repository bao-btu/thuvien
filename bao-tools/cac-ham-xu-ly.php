<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php		

// Ham doc du lieu co 1 truong duy nhat
function docDuLieuMotTruong($url, $truongDuLieu)
{
	$tam = trim($url->$truongDuLieu);
	if ($tam != "" && $tam[strlen($tam)-1] == ".")
	{
		$tam =  substr($tam,0,-1);
	}
	return $tam;
}

// Ham xu ly du lieu co 2 truong con
function xuLyDuLieuHaiTruong($url, $truongDL, $truongDL1, $truongDL2)
{	
	$tam = "";
	$tam1 = trim($url->$truongDL->$truongDL1);
	if ($tam1 != "" && ($tam1[strlen($tam1)-1] == "." ))
	{
		$tam1 =  substr($tam1,0,-1);
	}
	
	$tam2 = trim($url->$truongDL->$truongDL2);
	if ($tam2 != "" && ($tam2[strlen($tam2)-1] == "." ))
	{
		$tam2 =  substr($tam2,0,-1);
	}
		
	if ($tam2 != "")
	{
		if($tam1 != "")
			$tam = $tam1 . ", " . $tam2;
		else
			$tam = $tam2;	
	}
	else
	{
		$tam = $tam1;
	}
	return $tam;
}

function xuLyDuLieuHaiTruong1($url, $truongDL, $truongDL1, $truongDL2)
{	
	$tam = "";
	$tam1 = trim($url->$truongDL->$truongDL1);
	if ($tam1 != "" && ($tam1[strlen($tam1)-1] == "." ))
	{
		$tam1 =  substr($tam1,0,-1);
	}
	
	$tam2 = trim($url->$truongDL->$truongDL2);
	if ($tam2 != "" && ($tam2[strlen($tam2)-1] == "." ))
	{
		$tam2 =  substr($tam2,0,-1);
	}
		
	if ($tam2 != "")
	{
		if($tam1 != "")
			$tam = $tam1 . "; " . $tam2;
		else
			$tam = $tam2;	
	}
	else
	{
		$tam = $tam1;
	}
	return $tam;
}


// Ham xoa cac ky tu thua
function xoaCacKyTuThua($arr)
{
	$chiSo = 0;
	$arrTam = array();
	for($i = 0 ; $i < count($arr) ; $i++)
	{
		$arr[$i] = str_replace(";", "", $arr[$i]);
		$arr[$i] = str_replace(".", "", $arr[$i]);
		$arr[$i] = trim($arr[$i]);
		if(strlen($arr[$i]) > 2)
		{
			$arrTam[$chiSo] = $arr[$i];
			$chiSo++;
		}
	}
	return $arrTam;
}


function themMaTaiLieu($arrArray)
{
	$tam = $arrArray;    
	
	$tam =  str_replace(";", "",
            str_replace("---", ".",
            str_replace(".=.", ".",
            str_replace(".-", ".", 
			str_replace("-.", ".", 
			str_replace("--.", ".", 
			str_replace(".--", ".", 
			str_replace(".-.", ".", 
			str_replace(".--.", ".", $tam)))))))));
	//echo $tam . "<br/>";	
	$arrPhu = explode(".",$tam);
	$countPhu = count($arrPhu);
	
    $tu = 0;
    $den = 0;
    $ma = "";
    $kq = false;
    if(strlen($arrPhu[0]) == 1 )
    {
        $ma = $arrPhu[0];
        if(strlen($arrPhu[1]) > 2)
        {
            $tu = $arrPhu[1];
        }
        
        if(strlen($arrPhu[2]) > 2 && $kq == false)
        {
            $den = $arrPhu[2];
            $kq = true;
        }
        elseif(strlen($arrPhu[3]) > 2 && $kq == false)
        {
            $den = $arrPhu[3];
            $kq = true;
        }
        elseif(strlen($arrPhu[4]) > 2 && $kq == false)
        {
            $den = $arrPhu[4];
            $kq == true;
        }
        
    }else {
        if(strlen($arrPhu[0]) > 2)
        {
            $maTam = substr($arrPhu[0], 0, 1 );
            if ($maTam == "D" || $maTam == "M" || $maTam == "C")
            {
                $ma = $maTam;
                $tu = substr($arrPhu[0], 1, strlen($arrPhu[0])-1 );
                if(strlen($arrPhu[1]) > 2 && $kq == false)
                {
                    $den = $arrPhu[1];
                    $kq = true;
                }
                elseif(strlen($arrPhu[2]) > 2 && $kq == false)
                {
                    $den = $arrPhu[2];
                    $kq = true;
                }
                elseif(strlen($arrPhu[3]) > 2 && $kq == false)
                {
                    $den = $arrPhu[3];
                    $kq = true;
                } 
                elseif(strlen($arrPhu[4]) > 2 && $kq == false)
                {
                    $den = $arrPhu[4];
                    $kq = true;
                }               
            }else {
                $co = false;
                $tu = $arrPhu[0];
                if($arrPhu[1] == "D" || $arrPhu[1] == "M" || $arrPhu[1] == "C") 
                {
                    $ma = $arrPhu[1];
                    $co = true;
                }else if ($arrPhu[2] == "D" || $arrPhu[2] == "M" || $arrPhu[2] == "C") {
                    $ma = $arrPhu[2];
                    $co = true;
                }
                if(strlen($arrPhu[1]) > 2)
                {
                    if($co)
                    {
                        $den = $arrPhu[1];   
                    }else {
                        $maTam1 = substr($arrPhu[1], 0, 1 );
                        if ($maTam1 == "D" || $maTam1 == "M" || $maTam1 == "C")
                        {
                            $ma = $maTam1;
                            $den = substr($arrPhu[1], 1, strlen($arrPhu[1])-1 );
                        }
                    }                    
                }
                if(strlen($arrPhu[2]) > 2)
                {
                    if($co)
                    {
                        $den = $arrPhu[2];   
                    }else {
                        $maTam1 = substr($arrPhu[2], 0, 1 );
                        if ($maTam1 == "D" || $maTam1 == "M" || $maTam1 == "C")
                        {
                            $ma = $maTam1;
                            $den = substr($arrPhu[2], 1, strlen($arrPhu[2])-1 );
                        }
                    }
                }
                if(strlen($arrPhu[3]) > 2)
                {
                    if($co)
                    {
                        $den = $arrPhu[3];   
                    }else {
                        $maTam1 = substr($arrPhu[3], 0, 1 );
                        if ($maTam1 == "D" || $maTam1 == "M" || $maTam1 == "C")
                        {
                            $ma = $maTam1;
                            $den = substr($arrPhu[3], 1, strlen($arrPhu[3])-1 );
                        }
                    }
                }
                
                
            }
        }
    }
        
    $chiSo = 0;
	$arrKetQua = array();		
    
	for($chiSoMang = $tu; $chiSoMang <= $den ; $chiSoMang++)
	{
		$arrKetQua[$chiSo] = $ma . "." . $chiSoMang . ".TK";
		$chiSo++;
	}
		
	return $arrKetQua;
}


// Ham import tung tac gia trong mang vao csdl
function importTungTacGia($biblio_id, $arr, $level, $dbs)
{
	$author_id_cache = array();
	for($i = 0 ; $i < count($arr) ; $i++)
	{
		$author_id = utility::getID($dbs, 'mst_author', 'author_id', 'author_name', $arr[$i], $author_id_cache);
		$biblio_author_sql = 'INSERT IGNORE INTO biblio_author (biblio_id, author_id, level) VALUES ('.$biblio_id.','. $author_id.', ' . $level . ')';				
		$dbs->query($biblio_author_sql);
	}
}


// Ham import tung tu khoa vao csdl
function importTuKhoa($biblio_id, $arr, $level, $dbs)
{
	$subject_id_cache = array();
	for($i = 0 ; $i < count($arr) ; $i++)
	{
		$subject = trim(str_replace(array('>', '<'), '', $arr[$i]));
		$subject_id = utility::getID($dbs, 'mst_topic', 'topic_id', 'topic', $arr[$i], $subject_id_cache);
						  		
		$biblio_subject_sql = 'INSERT IGNORE INTO biblio_topic (biblio_id, topic_id, level) VALUES ('.$biblio_id.','. $subject_id.', ' . $level . ')';
		$dbs->query($biblio_subject_sql);
	}
}


//Ham phan loai tac gia theo cac chuc danh va dong thoi import vao csdl
function phanLoaiTacGia($dbs, $arrA, $chiSo, $biblio_id, $maChucDanh, $flag)
{
	$arrKQ = array();
	$arrDich = array();
	$arrTG = array();
	
	if($chiSo == 0)												// Phan tac gia theo chuc danh dang xet
	{
		$arr = xoaCacKyTuThua(explode(",",$arrA[$chiSo]));
		for ($j = 0 ; $j < count($arr) ; $j++)
		{
			array_push($arrKQ,$arr[$j]);
		}
	}else														// Cac chuc danh Dich hay Tac gia (ngoai chuc danh chinh dang xet)
	{
		if($flag)												// La Tac gia
		{
			$arr = xoaCacKyTuThua(explode(",",$arrA[$chiSo]));
			for ($j = 0 ; $j < count($arr) ; $j++)
			{
				array_push($arrTG,$arr[$j]);
			}										
		}else													// La Dich
		{
			$arr = xoaCacKyTuThua(explode(",",$arrA[$chiSo]));
			for ($j = 0 ; $j < count($arr) ; $j++)
			{
				array_push($arrDich,$arr[$j]);
			}
		}			
	}
	
	// Tien hanh import cac tac gia vao CSDL
	if(count($arrKQ) > 0)
	{
		importTungTacGia($biblio_id, $arrKQ, $maChucDanh, $dbs);
	}
	if(count($arrDich) > 0)
	{
		importTungTacGia($biblio_id, $arrDich, "4", $dbs);
	}
	if(count($arrTG) > 0)
	{
		importTungTacGia($biblio_id, $arrTG, "2", $dbs);
	}
}

function kiemTraTonTaiBieuGhi($maBieuGhi, $dbs)
{
	$sql_str = "SELECT * FROM item WHERE item_code = '$maBieuGhi'";
	$kq = $dbs->query($sql_str);
	if ($kq->num_rows > 0) 
		return true;
	else
		return false;
}

// Ham import tung bieu ghi vao CSDL
function importBieuGhiTheoMang($biblio_id, $arr, $giaTien, $curr_datetime, $maKho, $maItem, $dbs)
{
	$row = 0;
	
	
	for($i = 0 ; $i < count($arr) ; $i++)
	{		
		if(kiemTraTonTaiBieuGhi($arr[$i], $dbs) == false)
		{			
            $arr[$i] = strtoupper(trim($arr[$i]));
            if ($arr[$i] != "")
            {                            
			if($giaTien != "")
			{
				$sql_str = "INSERT INTO item (item_code, coll_type_id, location_id, item_status_id, source, price, price_currency, input_date, last_update, biblio_id) VALUES ('".$arr[$i]."', 2 , '".$maKho."', '".$maItem."', 1, ".$giaTien.", 'VND', ". $curr_datetime ." , " .$curr_datetime .", ". $biblio_id .")";
			}else
			{
				$sql_str = "INSERT INTO item (item_code, coll_type_id, location_id, item_status_id, source, input_date, last_update, biblio_id) VALUES ('".$arr[$i]."', 2 , '".$maKho."', '".$maItem."', 1, ". $curr_datetime ." , " .$curr_datetime .", ". $biblio_id .")";
			}
			//echo $sql_str;
			$dbs->query($sql_str);
			if ($dbs->errno && $dbs->errno == 1062) {
				echo "Loi : " . $biblio_id . " - " . $arr[$i] . "<br/>";
				//echo $sql_str . "<br/><br/>";
			}
            }
            //echo "Dc : " . $arr[$i] . "<br/>";
		}
		else
		{			
			echo "Ko : " .$arr[$i] . "<br/>";
		}
	}
}

// Ham import tung bieu ghi vao CSDL
function importBieuGhi($biblio_id, $arr, $giaTien, $curr_datetime, $maKho, $maItem, $dbs)
{	
		if(kiemTraTonTaiBieuGhi($arr, $dbs) == false)
		{			
            $arr = strtoupper(trim($arr));
            if ($arr != "")
            {                            
    			if($giaTien != "")
    			{
    				$sql_str = "INSERT INTO item (item_code, coll_type_id, location_id, item_status_id, source, price, price_currency, input_date, last_update, biblio_id) VALUES ('".$arr."', 2 , '".$maKho."', '".$maItem."', 1, ".$giaTien.", 'VND', ". $curr_datetime ." , " .$curr_datetime .", ". $biblio_id .")";
    			}else
    			{
    				$sql_str = "INSERT INTO item (item_code, coll_type_id, location_id, item_status_id, source, input_date, last_update, biblio_id) VALUES ('".$arr."', 2 , '".$maKho."', '".$maItem."', 1, ". $curr_datetime ." , " .$curr_datetime .", ". $biblio_id .")";
    			}
			//echo $sql_str;
			$dbs->query($sql_str);
			if ($dbs->errno && $dbs->errno == 1062) {
				echo "Loi : " . $biblio_id . " - " . $arr . "<br/>";
				//echo $sql_str . "<br/><br/>";
			}
            }
            //echo "Dc : " . $arr[$i] . "<br/>";
		}
		else
		{			
			echo "Ko : " .$arr . "<br/>";
		}	
}




// Ham kiem tra trung ten sach
function kiemTraTonTaiTenSach($tenSach, $dbs)
{
	$sql = "SELECT * FROM biblio WHERE title = '$tenSach'";
	$kq = $dbs->query($sql);
	if ($kq->num_rows > 0) 
		return true;
	else
		return false;
}
?>