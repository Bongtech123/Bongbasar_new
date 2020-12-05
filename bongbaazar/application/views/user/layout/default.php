<?php $this->load->view('user/component/header'); ?>

<?php //$this->load->view('user/component/navbar');?>
<!--  ####################### load page ##########################   -->
<?php $this->load->view('user/'.$subview);?>
<!--  ####################### load page ##########################   -->
<?php $this->load->view('user/component/footer'); ?>
