<?php
include_once "library/inc.seslogin.php";
include "header.php";
include 'library/PHPExcel/IOFactory.php';
$_SESSION['SES_PAGE'] = "?page=Category";
?>
<!-- page content -->
<div class="right_col" role="main">
	<?php
	# Tombol cancel
	if (isset($_POST['btnCancel'])) {
		echo "<meta http-equiv='refresh' content='0; url=?page=Sales'>";
	}
	# Tombol Submit diklik
	if (isset($_POST['btnSubmit'])) {

		$pesanError = array();
		$iddoble = array();
		$target_dir = "uploads/files/";
		$inputFileName = $target_dir . 'master_category.xlsx';
		$countupdate = 0;
		$countinsert = 0;
		$bulkNumber = date_format(new DateTime(), "d F Y H:i");
		$myQry = "";
		$myQry2 = "";


		try {
			$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
		} catch (Exception $e) {
			$pesanError[] = "Error loading file " . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage();
		}


		$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
		$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet
		$highestColumm = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
		$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumm);

		if (count($pesanError) >= 1) {
			echo "&nbsp;<div class='alert alert-warning'>";
			$noPesan = 0;
			foreach ($pesanError as $indeks => $pesan_tampil) {
				$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";
			}
			echo "</div>";
		} else {

			//$mySql = "DELETE FROM master_category_archive WHERE 1=1";
			//$myQry = mysqli_query($koneksidb,$mySql) or die ("Eror hapus data".mysqli_error());

			$mySql  = "INSERT INTO master_category_archive (id, category_id, category_level_1, category_level_2, category_level_3, category_level_4,
		   category_level_5,category_level_6,category_bulkid, updated_by ,updated_date)
		   SELECT id, category_id, category_level_1, category_level_2, category_level_3, category_level_4, category_level_5, 
		   category_level_6, '" . $bulkNumber . "',updated_by, updated_date FROM master_category";
			$myQry = mysqli_query($koneksidb, $mySql) or die("Error query 1 " . mysqli_error($koneksidb));

			$mySql = "DELETE FROM master_category_temp WHERE 1=1";
			$myQry = mysqli_query($koneksidb, $mySql) or die("Eror hapus data" . mysqli_error($koneksidb));

			for ($i = 2; $i <= $arrayCount; $i++) {

				$dataID			= trim($allDataInSheet[$i]["B"]);
				$dataCategoryID	= trim($allDataInSheet[$i]["A"]);
				$dataCategory1	= trim($allDataInSheet[$i]["C"]);
				$dataCategory2	= trim($allDataInSheet[$i]["D"]);
				$dataCategory3	= trim($allDataInSheet[$i]["E"]);
				$dataCategory4	= trim($allDataInSheet[$i]["F"]);
				$dataCategory5	= trim($allDataInSheet[$i]["G"]);
				$dataCategory6	= trim($allDataInSheet[$i]["H"]);
				$ses_nama	= $_SESSION['SES_NAMA'];
				$countinsert++;

				$mySql3  	= "INSERT INTO master_category_temp (id, category_id, category_level_1, category_level_2, category_level_3, category_level_4,
			 		category_level_5,category_level_6,updated_by ,updated_date)
					VALUES ('$dataID','$dataCategoryID','$dataCategory1','$dataCategory2', '$dataCategory3', '$dataCategory4',
					'$dataCategory5','$dataCategory6','$ses_nama',now())";
				$myQry3 = mysqli_query($koneksidb, $mySql3) or die("Error query 2 " . mysqli_error($koneksidb));
			} // for


			if ($myQry3) {

				$mySql2	= "Select category_id, count(*) as total from master_category_temp group by category_id  having total > 1";
				$myQry2	= mysqli_query($koneksidb, $mySql2)  or die("Query ambil data salah : " . mysqli_error($koneksidb));
				$doubledata = 0;
				while ($myData2 = mysqli_fetch_array($myQry2)) {
					$alerttype = "alert-warning";
					$pesanError[] = "Duplikasi " . $myData2['total'] . " data untuk category id : " . $myData2['category_id'] . " !";
					$doubledata = $doubledata + $myData2['total'];
				}
				if ($doubledata == 0) {
					$mySql = "DELETE FROM master_category WHERE 1=1";
					$myQry = mysqli_query($koneksidb, $mySql) or die("Eror hapus data" . mysqli_error($koneksidb));

					$mySql4  = "INSERT INTO master_category (id, category_id, category_level_1, category_level_2, category_level_3, category_level_4,
		   category_level_5,category_level_6,updated_by ,updated_date)
		   SELECT id, category_id, category_level_1, category_level_2, category_level_3, category_level_4, category_level_5, 
		   category_level_6, updated_by, updated_date FROM master_category_temp";
					$myQry4 = mysqli_query($koneksidb, $mySql4) or die("Error query 3 " . mysqli_error($koneksidb));
					$alerttype = "alert-success";
					$pesanError[] = "Upload Kategori berhasil, Ada  " . $countinsert . " data yang di import. ";
				}
			} else {
				$alerttype = "alert-warning";
				$pesanError[] = "Maaf ! ada masalah pada saat upload data.";
			}



			echo "&nbsp;<div class='alert " . $alerttype . "'>";
			$noPesan = 0;
			foreach ($pesanError as $indeks => $pesan_tampil) {
				$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";
			}

			echo "</div>";
		} // if error







	}


	?>

	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Category <small></small></h3>
			</div>
			<div class="title_right">
				<div class="form-group pull-right">
					&nbsp;
				</div>
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Import Data <small></small></h2>
						<ul class="nav navbar-right panel_toolbox">
							<a href="<?php echo $_SESSION['SES_PAGE']; ?>" class="btn btn-default btn-sm" role="button"><i class="fa fa-chevron-circle-left fa-fw"></i> Back</a>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">

						<form action="upload_category.php" class="dropzone"></form>
						<div class="col-xs-12">

							<div class="ln_solid"></div>
							<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">

								<a href="?page=Category" class="btn btn-warning btn-sm" role="button"><i class="fa fa-undo fa-fw"></i> Cancel</a>
								<button type="submit" class="btn btn-primary btn-sm" name="btnSubmit"><i class="fa fa-play fa-fw"></i> Process</button>
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
<!-- /page content -->

<?php
include "footer.php";
?>