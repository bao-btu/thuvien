<?php

$aTacGia = array();
$aDich = array();
// Phan loai DICH
$phanLoaiDich = explode("(Dịch)",$tacGiaTam);
for($iD = 0 ; $iD < count($phanLoaiDich) ; $iD++)
{
	if(strlen($phanLoaiDich[$iD]) > 0)
	{
		if(strpos($phanLoaiDich[$iD], "(") && strpos($phanLoaiDich[$iD], ")") )
		{
			// Phan loai BIEN DICH
			$phanLoaiBienDich = explode("(Biên dịch)",$phanLoaiDich[$iD]);
			for($iBD = 0 ; $iBD < count($phanLoaiBienDich) ; $iBD++)
			{
				if(strlen($phanLoaiBienDich[$iBD]) > 0)
				{
					if(strpos($phanLoaiBienDich[$iBD], "(") && strpos($phanLoaiBienDich[$iBD], ")"))
					{
						//Phan loai BIEN KHAO
						$phanLoaiBienKhao = explode("(Biên khảo)", $phanLoaiBienDich[$iBD]);
						for($iBK = 0 ; $iBK < count($phanLoaiBienKhao) ; $iBK++)
						{
							if(strlen($phanLoaiBienKhao[$iBK]) > 0)
							{
								if(strpos($phanLoaiBienKhao[$iBK], "(") && strpos($phanLoaiBienKhao[$iBK], ")"))
								{
									//Phan loai BIEN SOAN
									$phanLoaiBienSoan = explode("(Biên soạn)", $phanLoaiBienKhao[$iBK]);
									for($iBS = 0 ; $iBS < count($phanLoaiBienSoan) ; $iBS++)
									{
										if(strlen($phanLoaiBienSoan[$iBS]) > 0)
										{
											if(strpos($phanLoaiBienSoan[$iBS], "(") && strpos($phanLoaiBienSoan[$iBS], ")"))
											{
												//Phan loai BIEN TAP
												$phanLoaiBienTap = explode("(Biên tập)", $phanLoaiBienSoan[$iBS]);
												for($iBT = 0 ; $iBT < count($phanLoaiBienTap) ; $iBT++)
												{
													if(strlen($phanLoaiBienTap[$iBT]) > 0)
													{
														if(strpos($phanLoaiBienTap[$iBT], "(") && strpos($phanLoaiBienTap[$iBT], ")") )
														{
															//Phan loai CHINH LY
															$phanLoaiChinhLy = explode("(Chỉnh lý)", $phanLoaiBienTap[$iBT]);
															for($iCL = 0 ; $iCL < count($phanLoaiChinhLy) ; $iCL++)
															{
																if(strlen($phanLoaiChinhLy[$iCL]) > 0)
																{
																	if(strpos($phanLoaiChinhLy[$iCL], "(") && strpos($phanLoaiChinhLy[$iCL], ")"))
																	{
																		//Phan loai CHU BIEN
																		$phanLoaiChuBien = explode("(Chủ biên)", $phanLoaiChinhLy[$iCL]);
																		for($iCB = 0 ; $iCB < count($phanLoaiChuBien) ; $iCB++)
																		{
																			if(strlen($phanLoaiChuBien[$iCB]) > 0)
																			{
																				if(strpos($phanLoaiChuBien[$iCB], "(") && strpos($phanLoaiChuBien[$iCB], ")") )
																				{
																					//Phan loai GIOI THIEU
																					$phanLoaiGioiThieu = explode("(Giới thiệu)", $phanLoaiChuBien[$iCB]);
																					for($iGT = 0 ; $iGT < count($phanLoaiGioiThieu) ; $iGT++)
																					{
																						if(strlen($phanLoaiGioiThieu[$iGT]) > 0)
																						{
																							if(strpos($phanLoaiGioiThieu[$iGT], "(") && strpos($phanLoaiGioiThieu[$iGT], ")") )
																							{
																								//Phan loai KHAO DINH
																								$phanLoaiKhaoDinh = explode("(Khảo đính)", $phanLoaiGioiThieu[$iGT]);
																								for($iKD = 0 ; $iKD < count($phanLoaiKhaoDinh) ; $iKD++)
																								{
																									if(strlen($phanLoaiKhaoDinh[$iKD]) > 0)
																									{
																										if(strpos($phanLoaiKhaoDinh[$iKD], "(") && strpos($phanLoaiKhaoDinh[$iKD], ")"))
																										{

																											//Phan loai SUU TAM

																											$phanLoaiSuuTam = explode("(Sưu tầm)", $phanLoaiKhaoDinh[$iKD]);
																											for($iST = 0 ; $iST < count($phanLoaiSuuTam) ; $iST++)
																											{
																												if(strlen($phanLoaiSuuTam[$iST]) > 0)
																												{
																													if(strpos($phanLoaiSuuTam[$iST], "(") && strpos($phanLoaiSuuTam[$iST], ")"))
																													{

																														//Phan loai TUYEN CHON
																														$phanLoaiTuyenChon = explode("(Tuyển chọn)", $phanLoaiSuuTam[$iST]);
																														for($iTC = 0 ; $iTC < count($phanLoaiTuyenChon) ; $iTC++)
																														{
																															if(strlen($phanLoaiTuyenChon[$iTC]) > 0)
																															{
																																if(strpos($phanLoaiTuyenChon[$iTC], "(") && strpos($phanLoaiTuyenChon[$iTC], ")"))
																																{
																																	//Phan loai TUYEN DICH
																																	$phanLoaiTuyenDich = explode("(Tuyển dịch)", $phanLoaiTuyenChon[$iTC]);
																																	for($iTD = 0 ; $iTD < count($phanLoaiTuyenDich) ; $iTD++)
																																	{
																																		if(strlen($phanLoaiTuyenDich[$iTD]) > 0)
																																		{
																																			if(strpos($phanLoaiTuyenDich[$iTD], "(") && strpos($phanLoaiTuyenDich[$iTD], ")"))
																																			{
																																				echo "Con xot";
																																			}
																																			else		// Xu ly : day la TUYEN DICH
																																			{
																																				phanLoaiTacGia($dbs, $phanLoaiTuyenDich, $iTD, $biblio_id, "16", $flag);
																																				//$aTuyenDich = phanLoaiTacGia($phanLoaiTuyenDich,$iTD);
																																				//importTungTacGia($biblio_id, $aTuyenDich, 16, $dbs);
																																			}
																																		}
																																	}
																																}
																																else		// Xu ly : day la TUYEN CHON
																																{
																																	phanLoaiTacGia($dbs, $phanLoaiTuyenChon, $iTC, $biblio_id, "15", $flag);
																																	//$aTuyenChon = phanLoaiTacGia($phanLoaiTuyenChon,$iTC);
																																	//importTungTacGia($biblio_id, $aTuyenChon, 15, $dbs);
																																}
																															}
																														}
																													}
																													else		// Xu ly : day la SUU TAM
																													{
																														phanLoaiTacGia($dbs, $phanLoaiSuuTam, $iST, $biblio_id, "14", $flag);
																														//$aSuuTam = phanLoaiTacGia($phanLoaiSuuTam,$iST);
																														//importTungTacGia($biblio_id, $aSuuTam, 14, $dbs);
																													}
																												}

																											}

																										}
																										else		// Xu ly : day la KHAO DINH
																										{
																											phanLoaiTacGia($dbs, $phanLoaiKhaoDinh, $iKD, $biblio_id, "13", $flag);
																											//$aKhaoDinh = phanLoaiTacGia($phanLoaiKhaoDinh,$iKD);
																											//importTungTacGia($biblio_id, $aKhaoDinh, 13, $dbs);
																										}

																									}
																								}
																							}
																							else		// Xu ly : day la GIOI THIEU
																							{
																								phanLoaiTacGia($dbs, $phanLoaiGioiThieu, $iGT, $biblio_id, "11", $flag);
																								//$aGioiThieu = phanLoaiTacGia($phanLoaiGioiThieu,$iGT);
																								//importTungTacGia($biblio_id, $aGioiThieu, 11, $dbs);
																							}
																						}
																					}
																				}
																				else		// Xu ly : day la CHU BIEN
																				{
																					//echo "<br/><br/>".$tenSach . "<br/>";
																					//var_dump($phanLoaiChuBien);
																					//echo "<br/>";
																					phanLoaiTacGia($dbs, $phanLoaiChuBien, $iCB, $biblio_id, "12", $flag);
																					//$aChuBien = phanLoaiTacGia($phanLoaiChuBien,$iCB);
																					//importTungTacGia($biblio_id, $aChuBien, 12, $dbs);
																				}
																			}
																		}
																	}
																	else		// Xu ly : day la CHINH LY
																	{
																		phanLoaiTacGia($dbs, $phanLoaiChinhLy, $iCL, $biblio_id, "10", $flag);
																		//$aChinhLy = phanLoaiTacGia($phanLoaiChinhLy,$iCL);
																		//importTungTacGia($biblio_id, $aChinhLy, 10, $dbs);
																	}
																}
															}
														}
														else		// Xu ly : day la BIEN TAP
														{
															phanLoaiTacGia($dbs, $phanLoaiBienTap, $iBT, $biblio_id, "3", $flag);
															//$aBienTap = phanLoaiTacGia($phanLoaiBienTap,$iBT);
															//importTungTacGia($biblio_id, $aBienTap, 3, $dbs);
														}
													}
												}
											}
											else		// Xu ly : day la BIEN SOAN
											{
												phanLoaiTacGia($dbs, $phanLoaiBienSoan, $iBS, $biblio_id, "7", $flag);
												//$aBienSoan = phanLoaiTacGia($phanLoaiBienSoan,$iBS);
												//importTungTacGia($biblio_id, $aBienSoan, 7, $dbs);
											}
										}
									}
								}
								else		// Xu ly : day la BIEN KHAO
								{
									phanLoaiTacGia($dbs, $phanLoaiBienKhao, $iBK, $biblio_id, "6", $flag);
									//$aBienKhao = phanLoaiTacGia($phanLoaiBienKhao,$iBK);
									//importTungTacGia($biblio_id, $aBienKhao, 6, $dbs);
								}
							}
						}
					}
					else		// Xu ly : day la BIEN DICH
					{
						phanLoaiTacGia($dbs, $phanLoaiBienDich, $iBD, $biblio_id, "5", $flag);
						//$aBienDich = phanLoaiTacGia($phanLoaiBienDich,$iBD);
						//importTungTacGia($biblio_id, $aBienDich, 5, $dbs);
					}
				}
			}
		}
		else		// Xu ly : day la DICH
		{
			if($flag)
			{				
				
				$arr = xoaCacKyTuThua(explode(",",$phanLoaiDich[$iD]));
				if(count($arr) > 0 )
				{
					for ($j = 0 ; $j < count($arr) ; $j++)
					{
						array_push($aTacGia,$arr[$j]);
					}
					importTungTacGia($biblio_id, $aTacGia, 2, $dbs);
				}

			}else
			{
				if(count($arr) > 0 )
				{
					$arr = xoaCacKyTuThua(explode(",",$phanLoaiDich[$iD]));
					for ($j = 0 ; $j < count($arr) ; $j++)
					{
						array_push($aDich,$arr[$j]);
					}
					importTungTacGia($biblio_id, $aDich, 4, $dbs);
				}
			}
		}
	}
}
?>