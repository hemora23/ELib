<?php

include_once "library/inc.seslogin.php";
include "header.php";
$id	= isset($_GET['id']) ?  preg_replace("/[^a-zA-Z0-9]/", "", $_GET['id']) : ''; 
$_SESSION['SES_BACK']="?page=Dashboard-Table&id=".$id;
switch ($id) {
    case "1":
        $title='Top 10 Visitor';
        $columntitle='Visitor';
        $canvas = "bar-chart-horizontal";
        break;
    case "2":
        $title="Top 10 Documents";
        $columntitle='Document';
        $canvas = "bar-chart-horizontal-2";
        break;
    case "3":
        $title="Top 10 Reader";
        $columntitle='Reader';
        $canvas = "bar-chart-horizontal-3";
        break;
    case "4":
        $title="Total Visitors (Monthly)";
        $columntitle='Month';
        $canvas = "lineChart";
        break;
    case "5":
        $title="Total Documents Read (Monthly)";
        $columntitle='Month';
        $canvas = "mybarChart";
        break;
    case "6":
        $title="Total Visitors (Daily)";
        $columntitle='Date';
        $canvas = "mybarChart2";
        break;
    default:
        $title='Top 10 Visitor';
        $columntitle='Visitor';
        $canvas = "bar-chart-horizontal";
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
                     <a href="<?php echo $_SESSION['SES_PAGE']; ?>" class="btn btn-default btn-sm" role="button"><i class="fa fa-chevron-circle-left fa-fw"></i> Back</a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="row">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <a href="?page=Dashboard-Print&id=<?php echo $id; ?>" class="btn btn-info btn-sm"  width="100%" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-file-pdf-o fa-fw"></i>&nbsp;&nbsp;PDF&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a> 
                        </div>
                    </div>        
                  </div> 
                  



                  <div class="x_content table-responsive"> 
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th><?php echo $columntitle; ?></th> 
                                            <?php if ($id=='4') { 
                                                echo "<th>Web</th>";
                                                echo "<th>Mobile</th>";
                                            }   else {                                       
                                                echo "<th>Total</th>";
                                            }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php
                                    switch ($id) {
                                        case "1":
                                            $mySql 	= "select user_fullname as title, total from view_log_user_top10 order by total desc limit 10";
                                            break;
                                        case "2":
                                            $mySql 	= "select document_title_id as title, total from view_log_document_top10 order by total desc limit 10";
                                            break;
                                        case "3":
                                            $mySql 	= "select user_fullname as title, total from view_log_document_user_top10 order by total desc limit 10";
                                            break;
                                        case "4":
                                            $mySql 	= "select bulan as title, sum(web) as web, sum(mobile) as mobile, tahun from view_log_user_monthly_apps group by bulan order by tahun desc, bulanid limit 10";
                                            break;
                                        case "5":
                                            $mySql 	= "select bulan as title, sum(total) as total, tahun from view_log_document_monthly group by bulan order by tahun desc, bulanid limit 10";
                                            break;
                                        case "6":
                                            $mySql	= "select daily as title, sum(total) as total from view_log_user_daily where  (daily > DATE_SUB(now(), INTERVAL 30 DAY)) group by daily order by daily limit 10";
                                            break;
                                        default:
                                            $mySql 	= "select user_fullname as title, total from view_log_user_top10 order by total desc limit 10";
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
                                            <?php switch ($id) {
                                                case "1":
                                                    echo "<td><a href='?page=Dashboard-Detail&id=".$id."&id2=".urlencode($Code)."' target='_self'><u> ".$myData['total']." </u></a></td>";
                                                    break;
                                                case "2":
                                                    echo "<td><a href='?page=Dashboard-Detail&id=".$id."&id2=".urlencode($Code)."' target='_self'><u> ".$myData['total']." </u></a></td>";
                                                    break;
                                                case "3":
                                                    echo "<td><a href='?page=Dashboard-Detail&id=".$id."&id2=".urlencode($Code)."' target='_self'><u> ".$myData['total']." </u></a></td>";
                                                    break;
                                                case "4":
                                                    echo "<td><a href='?page=Dashboard-Detail&id=".$id."&id2=".urlencode($Code)."&id3=web&id4=".$myData['tahun']."' target='_self'><u> ".$myData['web']." </u></a></td>";
                                                    echo "<td><a href='?page=Dashboard-Detail&id=".$id."&id2=".urlencode($Code)."&id3=mobile&id4=".$myData['tahun']."' target='_self'><u> ".$myData['mobile']." </u></a></td>";
                                                    break;
                                                case "5":
                                                    echo "<td><a href='?page=Dashboard-Detail&id=".$id."&id2=".urlencode($Code)."&id3=".$myData['tahun']."' target='_self'><u> ".$myData['total']." </u></a></td>";
                                                    break;
                                                case "6":
                                                    echo "<td><a href='?page=Dashboard-Detail&id=".$id."&id2=".urlencode($Code)."' target='_self'><u> ".$myData['total']." </u></a></td>";   
                                                    break;
                                                default:
                                                    echo "<td><a href='?page=Dashboard-Detail&id=".$id."&id2=".urlencode($Code)."' target='_self'><u> ".$myData['total']." </u></a></td>";
                                                    
                                            } ?>
                                                
                                            
                                            
                                           
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
include "dashboard_footer.php";
?>


