<?php
$_SESSION['SES_TITLE'] = "Document Approval";
include_once "library/inc.seslogin.php";
include "header.php";
$_SESSION['SES_PAGE'] = "?page=Document-Approval";
$position = $_SESSION['SES_POSITION'];
?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Document Approval<small></small></h3>
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
            <div class="col-xs-12">
              <ul class="nav navbar-right panel_toolbox">
                <a href="<?php echo $_SESSION['SES_PAGE']; ?>" class="btn btn-default btn-sm" role="button"><i class="fa fa-chevron-circle-left fa-fw"></i> Back</a>
              </ul>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="x_content table-responsive">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Doc. ID</th>
                  <th>Ver.</th>
                  <th>Date</th>
                  <th>Title</th>
                  <th>Status</th>
                  <th>Review</th>
                </tr>
              </thead>
              <tbody>

                <?php
                $ses_nama  = $_SESSION['SES_NAMA'];

                $mySql   = "SELECT * FROM view_document WHERE document_status='Created' or document_status='Updated' or document_status='Request Delete'
									UNION
									SELECT * FROM view_document WHERE document_status='Reviewed'  ORDER BY document_date desc ";

                $myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error($koneksidb));
                $nomor  = 0;
                while ($myData = mysqli_fetch_array($myQry)) {
                  $nomor++;
                  $Code = $myData['document_id'];
                  $Version = $myData['document_version'];
                ?>

                  <tr>
                    <td><?php echo $nomor; ?></td>
                    <td><a href="?page=Document-View&id=<?php echo $Code; ?>&v=<?php echo $Version; ?>" alt="View Data"><u><?php echo $myData['document_id']; ?></u></a></td>
                    <td><a href="?page=Document-Version&id=<?php echo $Code;  ?>" alt="View Data"><u><?php echo $myData['document_version']; ?></u></a></td>
                    <td><?php echo $myData['document_date']; ?></td>
                    <td><?php echo $myData['document_title_id']; ?></td>
                    <td><?php echo $myData['document_status']; ?></td>


                    <?php if ($position == 'Super Admin') { ?>
                      <td><a href="?page=Document-Approval-Add&status=Reviewedd&id=<?php echo $Code; ?>&v=<?php echo $Version; ?>" target='_self' alt='Approved' class="btn btn-primary btn-sm"><i class='fa fa-check fa-fw'></i> Review</a>
                      </td>
                    <?php } else { ?>
                      <td></td>
                    <?php } ?>




                  </tr>
                <?php } ?>
              </tbody>
            </table>

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