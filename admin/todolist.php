<?php
include_once "library/inc.seslogin.php";
include "header.php";
?>

<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>To do list <small></small></h3>
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
                    <h2>Put Away <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="" ><i class="fa fa-wrench"></i></a>
                        
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content table-responsive">                    
                    <table id="datatable-responsive-1" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Code Penerimaan</th>                                           
                                            <th>Tanggal Penerimaan</th>
                                            <th>Warehouse</th>
                                            <th>Nomor PO</th>
                                            <th>Status</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php
									$mySql 	= "SELECT * FROM receive r, master_warehouse w WHERE r.warehouse_id=w.warehouse_id AND r.receive_status='Received' ORDER BY r.receive_id DESC";
									$myQry 	= mysqli_query($koneksidb,$mySql)  or die ("Error query ".mysqli_error());
									$nomor  = 0; 
									while ($myData = mysqli_fetch_array($myQry)) {
										$nomor++;
										$Code = $myData['receive_id'];
									?>
                                    
                                        <tr>
                                            <td><?php echo $nomor; ?></td>                                            
                                            
                                            <td><?php echo $myData['receive_id']; ?></td>
                                            <td><?php echo $myData['receive_date']; ?></td>
                                            <td><?php echo $myData['warehouse_name']; ?></td>
                                            <td><?php echo $myData['po_number']; ?></td>
                                            <td><?php echo $myData['receive_status']; ?></td>
                                            
                                        </tr>
                                        <?php } ?>
                                      </tbody>                                                                        
                                </table>
                  </div>
                </div>
                </div>
             </div><!-- /row -->
                
             
        
        	
             
             <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Picking Order <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="" ><i class="fa fa-wrench"></i></a>
                        
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content table-responsive">                    
                    <table id="datatable-responsive-2" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>OrderID</th>                                           
                                            <th>Tgl Order</th>
                                            <th>Tgl Minta Diterima</th>
                                            <th>Produk ID</th>
                                            <th>Product Name</th>
                                            <th>Qty</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php
									$mySql 	= "SELECT * FROM sales s, sales_detail sd, master_product p WHERE s.sales_id=sd.sales_id AND sd.product_id=p.product_id AND s.sales_status='Order' ORDER BY s.sales_id DESC";
									$myQry 	= mysqli_query($koneksidb,$mySql)  or die ("Error query ".mysqli_error());
									$nomor  = 0; 
									while ($myData = mysqli_fetch_array($myQry)) {
										$nomor++;
										$Code = $myData['sales_id'];
									?>
                                    
                                        <tr>
                                            <td><?php echo $nomor; ?></td>
                                            <td><?php echo $myData['sales_id']; ?></td>
                                            <td><?php echo $myData['sales_date']; ?></td>
                                            <td><?php echo $myData['request_date']; ?></td>
                                            <td><?php echo $myData['product_id']; ?></td>
                                            <td><?php echo $myData['product_name']; ?></td>
                                            <td><?php echo $myData['qty']; ?></td>
                                            <td><?php echo number_format(($myData['qty']*$myData['selling_price'])-$myData['discount']); ?></td>
                                            <td><?php echo $myData['sales_status']; ?></td>
                                            
                                           
                                        </tr>
                                        <?php } ?>
                                      </tbody>                                                                        
                                </table>
                  </div>
                </div>
             </div>
           </div>
           
           
           <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Packing Order <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="" ><i class="fa fa-wrench"></i></a>
                        
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content table-responsive">                    
                    <table id="datatable-responsive-3" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>OrderID</th>                                           
                                            <th>Tgl Order</th>
                                            <th>Tgl Minta Diterima</th>
                                            <th>Produk ID</th>
                                            <th>Product Name</th>
                                            <th>Qty</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php
									$mySql 	= "SELECT * FROM sales s, sales_detail sd, master_product p WHERE  s.sales_id=sd.sales_id AND sd.product_id=p.product_id AND s.sales_status='Picking' ORDER BY s.sales_id DESC";
									$myQry 	= mysqli_query($koneksidb,$mySql)  or die ("Error query ".mysqli_error());
									$nomor  = 0; 
									while ($myData = mysqli_fetch_array($myQry)) {
										$nomor++;
										$Code = $myData['sales_id'];
									?>
                                    
                                        <tr>
                                            <td><?php echo $nomor; ?></td>
                                            <td><?php echo $myData['sales_id']; ?></td>
                                            <td><?php echo $myData['sales_date']; ?></td>
                                            <td><?php echo $myData['request_date']; ?></td>
                                            <td><?php echo $myData['product_id']; ?></td>
                                            <td><?php echo $myData['product_name']; ?></td>
                                            <td><?php echo $myData['qty']; ?></td>
                                            <td><?php echo number_format(($myData['qty']*$myData['selling_price'])-$myData['discount']); ?></td>
                                            <td><?php echo $myData['sales_status']; ?></td>
                                            
                                           
                                        </tr>
                                        <?php } ?>
                                      </tbody>                                                                        
                                </table>
                  </div>
                </div>
             </div>
           </div>
           
           <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Delivery Order <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="" ><i class="fa fa-wrench"></i></a>
                        
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content table-responsive">                    
                    <table id="datatable-responsive-4" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>OrderID</th>                                           
                                            <th>Tgl Order</th>
                                            <th>Tgl Minta Diterima</th>
                                            <th>Produk ID</th>
                                            <th>Product Name</th>
                                            <th>Qty</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php
									$mySql 	= "SELECT * FROM sales s, sales_detail sd, master_product p WHERE  s.sales_id=sd.sales_id AND sd.product_id=p.product_id AND s.sales_status like 'Delivery%' ORDER BY s.sales_id DESC";
									$myQry 	= mysqli_query($koneksidb,$mySql)  or die ("Error query ".mysqli_error());
									$nomor  = 0; 
									while ($myData = mysqli_fetch_array($myQry)) {
										$nomor++;
										$Code = $myData['sales_id'];
									?>
                                    
                                        <tr>
                                            <td><?php echo $nomor; ?></td>
                                            <td><?php echo $myData['sales_id']; ?></td>
                                            <td><?php echo $myData['sales_date']; ?></td>
                                            <td><?php echo $myData['request_date']; ?></td>
                                            <td><?php echo $myData['product_id']; ?></td>
                                            <td><?php echo $myData['product_name']; ?></td>
                                            <td><?php echo $myData['qty']; ?></td>
                                            <td><?php echo number_format(($myData['qty']*$myData['selling_price'])-$myData['discount']); ?></td>
                                            <td><?php echo $myData['sales_status']; ?></td>
                                            
                                           
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


