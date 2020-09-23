<!DOCTYPE html>
<html lang="en">
	<head>
		<?php $this->load->view('include/header'); ?>
	</head>

	<body class="no-skin">
			<div class="main-content">
				<div class="main-content-inner">
				

					<div class="page-content">
						<!--
						<div class="page-header">
							<h1>
								Order Form
								<!-- <small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									and Validation
								</small> -->
						<!--	</h1>
						</div><!-- /.page-header -->
						<div class="row">
							<div class="row">
							<div class="book">
							<table  class="table">
							<tbody>
							<?php $hal='0'; foreach ($kirimans as $kiriman): ?>
									<?php //if ($hal % 4 =) {}?>
									
									<div class="page">
										<div class="subpage">
										  
										  <tr><td class="left">
										  <div class="widget-box">
															<div class="center">
																<h4><img src="<?php $barcode=$kiriman->externalId; //$barcode=$kiriman->idorder;
																		echo site_url(); ?>/label_barcode/set_barcode/<?php echo $barcode ?>"> 
																	</img></h4>
																<div class="hr hr-dotted"></div> 
															</div>
															<div class="widget-body">
																<div class="widget-main">
																	<div id="fuelux-wizard-container">
																			<div class="form-horizontal" > 
																					<div class="space-2"></div>
																					<div class="form-group">
																						<label class="col-xs-12 col-sm-3 no-padding-right"><strong>Kepada : </strong></label>
																						<div class="col-xs-12 col-sm-9">
																							<div class="input-group">
																								<label><strong><?php echo $kiriman->receiverName ?>
																								<br> <?php echo $kiriman->receiverAddr ?><br>
																								No.HP : <?php echo $kiriman->receiverPhone ?><br>
																											</strong>
																								</label>
																							</div>
																							
																			
																						</div>
																					</div>
																					<div class="space-2"></div>
																					<div class="hr hr-dotted"></div>
																					<div class="form-group">
																						<label class="col-xs-12 col-sm-3 no-padding-right"><small>Dari : </small></label>
																						

																						<div class="col-xs-12 col-sm-9">
																							<div class="input-group">
																								<label><small><?php echo $kiriman->senderName ?>
																								<br> <?php echo $kiriman->senderAddr ?><br>
																								No.HP : <?php echo $kiriman->senderPhone ?><br>
																											</small>
																								</label>
																							</div>
																							
																			
																						</div>
																					</div>
																					

																					

																			</div>
																	</div>			
																</div>			
															</div>
													</div>		
										  </td>
													
													
												</tr>
										</div>    
									</div>
							<?php  $hal++;
							endforeach; ?>
							</tbody></table>
						 
							

						</div>
									<?php $hal='0'; foreach ($kirimans as $kiriman): ?>
									<?php //if ($hal % 4 =) {}?>
											
									<?php  $hal++;
										endforeach; ?>
									
									
									
								</div>

						</div>
					</div><!-- /.main-content -->
			

			<!--
			<div class="footer">
				<?php //$this->load->view("_dipecah/footer.php") ?>
			</div>
			-->

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->
		
		
		
			<!-- ace settings handler -->
		
	<script>
		window.print();
	</script>		
	</body>
</html>
