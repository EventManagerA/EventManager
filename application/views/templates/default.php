<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?php echo $TITLE?></title>
	<link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css')?>" />
</head>
<body>
	<div id="container">
	  <?php //$this->load->view('template/header')?>
	  <?php $this->load->view('element/navbar')?>
	  <?php //echo $this->session->flashdata('update')?$this->session->flashdata('update'):false?>
	  <?php //echo $this->session->flashdata('delete')?$this->session->flashdata('delete'):false?>
	  <?php $this->load->view($contentPath)?>
	  <?php //$this->load->view('template/footer')?>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="<?php echo base_url('js/bootstrap.min.js')?>"></script>
</body>
</html>