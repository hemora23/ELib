<?php
include_once "library/inc.seslogin.php";
include "header.php";
$_SESSION['SES_PAGE'] = "?page=Search";
$LANG = $_SESSION['SES_LANG'];
?>
<div class="right_col" role="main">

	<?php
	# Tombol cancel
	if (isset($_POST['btnCancel'])) {
		echo "<meta http-equiv='refresh' content='0; url=?page=Search'>";
	}
	# Tombol Submit diklik
	if (isset($_POST['btnSubmit'])) {
		# VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
		$pesanError = array();




		# BACA DATA DALAM FORM, masukkan datake variabel

		$txtSearch = $_POST['txtSearch'];
		if (strlen($txtSearch) < 4) {
			if ($lang == 'id') {
				$pesanError[] =  "Minimal untuk pencarian adalah 4 huruf";
			} else {
				$pesanError[] =  "Minimum letters for search is 4 letters";
			}
		}



		# JIKA ADA PESAN ERROR DARI VALIDASI
		if (count($pesanError) >= 1) {
			echo "&nbsp;<div class='alert alert-warning'>";
			$noPesan = 0;
			foreach ($pesanError as $indeks => $pesan_tampil) {
				$noPesan++;
				echo "&nbsp;&nbsp;$pesan_tampil<br>";
			}
			echo "</div>";
		} else {
			# SIMPAN DATA KE DATABASE. 

			$ses_nama	= $_SESSION['SES_NAMA'];
			$mySql  	= "select * from document";
			$myQry = mysqli_query($koneksidb, $mySql) or die("Error query  " . mysqli_error());
			if ($myQry) {
				echo "<meta http-equiv='refresh' content='0; url=?page=Search&id=" . $txtSearch . "'>";
			}
			exit;
		}
	} // Penutup Tombol Submit


	# MASUKKAN DATA KE VARIABEL



	?>
	<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
		<div class="page-title">
			<!-- page-title -->
			<div class="title_left">
				<h3><?php echo _SEARCH . ' ' . _DOCUMENT; ?></h3>
			</div>
			<div class="title_right">
				<div class="form-group pull-right top_search">
					<h6><a href="?page=Main"><i class="fa fa-home"></i> <?php echo _HOME ?></i></a></a> / <?php echo _SEARCH; ?></h6>
				</div>
			</div>
		</div><!-- /page-title -->
		<div class="clearfix"></div>

		<div class="row">
			<!-- row -->
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<!-- x_panel -->

					<div class="x_title">
						<!-- x_title -->
						<h2>&nbsp;</h2>
						<ul class="nav navbar-right">
							<a href="<?php echo $_SESSION['SES_PAGE']; ?>" class="btn btn-default btn-sm" role="button"><i class="fa fa-chevron-circle-left fa-fw"></i> <?php echo _BACK; ?></a>
						</ul>
						<div class="clearfix"></div>
					</div><!-- /x_title -->

					<div class="x_content ">
						<!-- x_content -->

						<div class="col-xs-12">
							<div class="input-group">
								<input name="txtSearch" type="text" class="form-control" required="required">
								<span class="input-group-btn">
									<button name="btnSubmit" type="submit" class="btn btn-primary"><i class="fa fa-search fa-fw"></i> <?php echo _SEARCH . ' ' . _DOCUMENT; ?></button>
								</span>
							</div>
							<div class="ln_solid"></div>
						</div>

					</div>
					<div class="col-xs-12">
						<?php
						if (isset($_GET['id'])) {
							$id		= $_GET['id'];
							$idquery		= str_replace(' ', '', $_GET['id']);
						?>
							<table id="datatable-responsive-x" class="table table-striped table-bordered dt-responsive nowrap table-hover" cellspacing="0" width="100%">
								<thead>
									<tr>

										<th>
											<?php
											echo "<b>" . _SEARCHRESULT . " '" . $id . "'</b>";
											?>
										</th>
									</tr>
								</thead>
								<tbody>

									<?php

									$mySql 	= "SELECT document_id,document_version, document_title_id,document_description_id,document_description_id_2,document_title_en,document_description_en,document_description_en_2,document_year,document_rack,document_publisher,document_author,
									category_level_1, category_level_2, category_level_3,category_level_4, category_level_5, category_level_6  
									FROM view_search WHERE concat(document_keyword,document_year,document_rack,document_publisher,document_author,document_title_id_2,document_title_en_2, document_description_id, 
									document_description_en,document_content) like '%$idquery%' 
								GROUP BY document_id, document_title_id,document_description_id,document_title_en,document_description_en,
								category_level_1, category_level_2, category_level_3,
								category_level_4, category_level_5, category_level_6 order by document_id";
									$myQry 	= mysqli_query($koneksidb, $mySql)  or die("Query  salah : " . mysqli_error());
									$nomor  = 0;
									while ($myData = mysqli_fetch_array($myQry)) {
										$nomor++;
										$Kode = $myData['document_id'];

										$Title = str_ireplace($id, "<b style='background-color:#FFFF00'>" . $id . "</b>", $myData['document_title_' . $lang]);
										$Year  = str_ireplace($id, "<b style='background-color:#FFFF00'>" . $id . "</b>", $myData['document_year']);
										$Rack  = str_ireplace($id, "<b style='background-color:#FFFF00'>" . $id . "</b>", $myData['document_rack']);
										$Publisher  = str_ireplace($id, "<b style='background-color:#FFFF00'>" . $id . "</b>", $myData['document_publisher']);
										$Author  = str_ireplace($id, "<b style='background-color:#FFFF00'>" . $id . "</b>", $myData['document_author']);
										$Desc  =  ($myData['document_description_' . $lang . '_2']);
										$dataCategory1 = $myData['category_level_1'];
										if ($myData['category_level_2'] != '') {
											$dataCategory2 = ' / ' . $myData['category_level_2'];
										} else {
											$dataCategory2 = '';
										};
										if ($myData['category_level_3'] != '') {
											$dataCategory3 = ' / ' . $myData['category_level_3'];
										} else {
											$dataCategory3 = '';
										};
										if ($myData['category_level_4'] != '') {
											$dataCategory4 = ' / ' . $myData['category_level_4'];
										} else {
											$dataCategory4 = '';
										};
										if ($myData['category_level_5'] != '') {
											$dataCategory5 = ' / ' . $myData['category_level_5'];
										} else {
											$dataCategory5 = '';
										};
										if ($myData['category_level_6'] != '') {
											$dataCategory6 = ' / ' . $myData['category_level_6'];
										} else {
											$dataCategory6 = '';
										};
										$Category = $dataCategory1 . $dataCategory2 . $dataCategory3 . $dataCategory4 . $dataCategory5 . $dataCategory6;
									?>

										<tr>
											<td>
												<p><?php echo $Category; ?></p>
												<h2><b><a href="?page=Document-Detail&id=<?php echo $Kode; ?>"><?php echo $Title; ?></a></b></h2>
												<!-- <h2><b><a href="?page=Document-Detail&id=<?php echo $Kode; ?>"><?php echo $Author; ?></a></b></h2>
												<h2><b><a href="?page=Document-Detail&id=<?php echo $Kode; ?>"><?php echo $Publisher; ?></a></b></h2>
												<h2><b><a href="?page=Document-Detail&id=<?php echo $Kode; ?>"><?php echo $Year; ?></a></b></h2>
												<h2><b><a href="?page=Document-Detail&id=<?php echo $Kode; ?>"><?php echo $Desc; ?></a></b></h2> -->
												<p><?php echo _AUTHOR ?> : <?php echo $Author ?></p>
												<p><?php echo _PUBLISHER ?> : <?php echo $Publisher ?></p>
												<p><?php echo _YEAR ?> : <?php echo $Year ?></p>
												<?php if ($Desc != '') { ?>
													<p><?php echo _DESC ?> : <?php echo $Desc ?></p>
												<?php } ?>
												<table id="datatable-responsive-x" class="table  table-bordered dt-responsive nowrap " cellspacing="0" width="100%">
													<tbody>
														<?php

														$mySql2 	= "SELECT v.document_id, v.document_version,v.document_file_title, v.document_year, v.document_description_en FROM view_search v, document_files f WHERE v.document_id=f.document_id 
							and v.document_version=f.document_version and v.document_content like '%$idquery%' and v.document_id='$Kode'
											group by v.document_id, v.document_version,v.document_file_title order by f.document_order";
														$myQry2 	= mysqli_query($koneksidb, $mySql2)  or die("Query  salah : " . mysqli_error());



														while ($myData2 = mysqli_fetch_array($myQry2)) {
															$file_title =	$myData2['document_file_title'];
															// if ($LANG == 'id') {
															// 	$file_desc = $myData2['document_description_id'];
															// } else {
															// 	$file_desc = $myData2['document_description_en'];
															// }



														?>

															<tr>
																<td width="2%"><img src="images/pdf.png" height="20" longdesc="#"></td>
																<td width="20%">
																	<a href="?page=Document-Detail-PDF&id=<?php echo $myData2['document_id']; ?>&v=<?php echo $myData2['document_version']; ?>&doc=<?php echo $myData2['document_file_title']; ?>"><?php echo $file_title; ?></a>

																</td>
																<td>
																	<?php
																	$mySql3 	= "SELECT document_id, document_version, document_page,document_file_title FROM view_search WHERE document_content like '%$idquery%' and document_id='$Kode' and document_file_title='$file_title' group by document_id, document_version, document_page,document_file_title";
																	$myQry3 	= mysqli_query($koneksidb, $mySql3)  or die("Query  salah : " . mysqli_error());
																	while ($myData3 = mysqli_fetch_array($myQry3)) { ?>
																		<a href="?page=Document-Detail-PDF&id=<?php echo $myData3['document_id']; ?>&v=<?php echo $myData3['document_version']; ?>&doc=<?php echo $myData3['document_file_title']; ?>&hal=<?php echo $myData3['document_page']; ?>"><?php echo _PAGE . ' ' . $myData3['document_page']; ?></a>,&nbsp;
																	<?php
																	}
																	?>
																</td>
															</tr>
														<?php
														}
														?>
													</tbody>
												</table>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>

						<?php } ?>
					</div>
				</div><!-- /x_content -->

			</div><!-- /x_panel -->
		</div>
</div><!-- /row -->
</div>
<!-- /page content -->
</form>
<?php
include "footer.php";
?>