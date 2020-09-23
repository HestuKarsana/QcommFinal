<?php
$controller = $this->router->fetch_class();
$level = $this->session->userdata('ses_level'); //01=Agepos 02=pebisnis online 

?>

<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo base_url().'index.php/admin/home';//site_url(); ?>">
				<img alt="<?php echo config_item('web_title'); ?>" src="<?php echo config_item('img'); ?>logo_small.png">
			</a>
		</div>

		<!-- <p class="navbar-text">Anda login sebagai <?php //echo $this->session->userdata('ap_level_caption'); ?></p> -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
					    <li class="dropdown <?php if($controller == 'admin') { echo 'active'; } ?>">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<i class='fa fa-file-text-o fa-fw'></i> Laporan <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="<?php   echo base_url().'index.php/admin/laporan_rekap'  ?>">Rekapitulasi</a></li>
								<li><a href="<?php   echo base_url().'index.php/admin/laporan_auto_debet'  ?>">Laporan Auto Debet</a></li>
								<li><a href="<?php   echo base_url().'index.php/admin/laporan_kinerja_pebisol'  ?>">Laporan Kinerja Pebisol</a></li>
								<li><a href="<?php   echo base_url().'index.php/admin/laporan_mutasi_rekening'  ?>">Mutasi Rekening</a></li>
							</ul>
						</li>
						 <li class="dropdown <?php if($controller == 'admin/pemulihan_user') { echo 'active'; } ?>">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<i class='fa fa-file-text-o fa-fw'></i> User pebisol <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="<?php   echo base_url().'index.php/admin/pemulihan_user'  ?>">Pemulihan User</a></li>
							</ul>
						</li>
			</ul>
            		
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					<i class='fa fa-user fa-fw'></i> 
					<?php echo $this->session->userdata('ses_nopen')." | ".$this->session->userdata('ses_kode_agen')." | ".$this->session->userdata('ses_nama')." | ".$this->session->userdata('ses_id_user'); ?> <span class="caret"></span></a>
			            <ul class="dropdown-menu">
						<li><a href="<?php echo site_url('user/ubah-password'); ?>" id='GantiPass'>Ubah Password</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="<?php echo site_url('admin/logout'); ?>"><i class='fa fa-sign-out fa-fw'></i> Log Out</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>

<script>
$(document).on('click', '#GantiPass', function(e){
	e.preventDefault();

	$('.modal-dialog').removeClass('modal-lg');
	$('.modal-dialog').addClass('modal-sm');
	$('#ModalHeader').html('Ubah Password');
	$('#ModalContent').load($(this).attr('href'));
	$('#ModalGue').modal('show');
});
</script>