<?php

include_once "library/inc.seslogin.php";
include "header.php";
$id	    = isset($_GET['id']) ?  $_GET['id'] : ''; 
$id2	= isset($_GET['id2']) ?  urldecode($_GET['id2']) : ''; 
$id3	= isset($_GET['id3']) ?  urldecode($_GET['id3']) : ''; 
$id4	= isset($_GET['id4']) ?  urldecode($_GET['id4']) : ''; 

switch ($id) {
    case "1":
        $title='Top 10 Visitor';
        $columntitle='Visitor';
        $columntitle2='Login Date';
        $columntitle3='Media';
        break;
    case "2":
        $title="Top 10 Documents";
        $columntitle='Document';
        $columntitle2='Reader';
        $columntitle3='Reading Date';
        break;
    case "3":
        $title="Top 10 Reader";
        $columntitle='Reader';
        $columntitle2='Document';
        $columntitle3='Reading Date';
        break;
    case "4":
        $title="Total Visitors (Monthly)";
        $columntitle='Visitor';
        $columntitle2='Login Date';
        $columntitle3='Media';
        break;
    case "5":
        $title="Total Documents Read (Monthly)";
        $columntitle='Document';
        $columntitle2='Reader';
        $columntitle3='Reading Date';
        break;
    case "6":
        $title="Total Visitors (Daily)";
        $columntitle='Visitor';
        $columntitle2='Login Date';
        $columntitle3='Media';
        break;
    default:
        $title='Top 10 Visitor';
        $columntitle='Visitor';
        $columntitle2='Login Date';
        $columntitle3='Media';
}
?>

<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><?php echo $title; ?><small></small></h3>
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
                    <h2>Data <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                     <a href="<?php echo $_SESSION['SES_BACK']; ?>" class="btn btn-default btn-sm" role="button"><i class="fa fa-chevron-circle-left fa-fw"></i> Back</a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="row">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <a href="?page=Dashboard-Detail-Print&id=<?php echo $id; ?>&id2=<?php echo urlencode($id2); ?>&id3=<?php echo urlencode($id3); ?>&id4=<?php echo urlencode($id4); ?>" class="btn btn-info btn-sm"  width="100%" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-file-pdf-o fa-fw"></i>&nbsp;&nbsp;PDF&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a> 
                        </div>
                    </div>        
                  </div> 
                  <div class="x_content table-responsive">                    
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th><?php echo $columntitle; ?></th> 
                                            <th><?php echo $columntitle2; ?></th>
                                            <th><?php echo $columntitle3; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php
                                    switch ($id) {
                                        case "1":
                                            $mySql 	= "select user_fullname as title, log_date as title2, log_apps as title3 from view_log_user where user_fullname='".$id2."' order by log_date desc ";
                                            break;
                                        case "2":
                                            $mySql 	= "select document_title_id as title, user_fullname as title2, log_date as title3 from view_log_document where document_title_id='".$id2."' order by log_date desc";
                                            break;
                                        case "3":
                                            $mySql 	= "select user_fullname as title, document_title_id as title2, log_date as title3 from view_log_document where user_fullname='".$id2."' order by log_date desc";
                                            break;
                                        case "4":
                                            $mySql 	= "select user_fullname as title, log_date as title2, log_apps as title3 from view_log_user where MONTHNAME(log_date) ='".$id2."' and YEAR(log_date)='".$id4."' and log_apps='".$id3."'  order by log_date desc";
                                            break;
                                        case "5":
                                            $mySql 	= "select document_title_id as title, user_fullname as title2, log_date as title3 from view_log_document where MONTHNAME(log_date) ='".$id2."' and YEAR(log_date)='".$id3."' order by log_date desc";
                                            break;
                                        case "6":
                                            $mySql	= "select user_fullname as title, log_date as title2, log_apps as title3 from view_log_user where  date(log_date)='".$id2."' order by log_date desc ";
                                            break;
                                        default:
                                        $mySql 	= "select user_fullname as title, log_date as title2, log_apps as title3 from view_log_user where user_fullname='".$id2."' order by log_date desc ";
                                    }
                                    $myQry 	= mysqli_query($koneksidb,$mySql)  or die ("Error query ".mysqli_error());
									$nomor  = 0; 
									while ($myData = mysqli_fetch_array($myQry)) {
										$nomor++;
										$Code = $myData['title'];
									?>
                                    
                                        <tr>
                                            <td><?php echo $nomor; ?></td>                                            
                                            <td><?php echo $myData['title']; ?></td>
                                            <td><?php echo $myData['title2']; ?></td>
                                            <td><?php echo $myData['title3']; ?></td>
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


