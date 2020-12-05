<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- Page Title -->
	<title>Forgot Password</title>
	<!--Fevicon-->
	 <link rel="icon" href="<?=base_url()?>webroot/admin/images/fav.jpg" type="image/x-icon">
    
    <link rel='stylesheet' href='<?=base_url()?>webroot/admin/css/animate.min.css'>
    <link rel='stylesheet' href='<?=base_url()?>webroot/admin/css/bootstrap.min2.css'>
    <link rel='stylesheet' href='<?=base_url()?>webroot/admin/css/login.css'>
    <link rel='stylesheet' href='<?=base_url()?>webroot/admin/css/font-awesome.min.css'>
    <link href='<?=base_url()?>webroot/admin/css/validationEngine_login.jquery.css' rel="stylesheet">
    <link href="<?=base_url()?>webroot/admin/css/plugins/toastr/toastr.min.css" rel="stylesheet">
</head>
<body>
    <input type="hidden" name="base_url" id="base_url" value="<?=base_url()?>">
    <input type="hidden" name="current_url" id="current_url" value="<?=current_url();?>">
<?php

         if($this->session->flashdata('success')){
                
                $this->load->view('admin/msg/success');


            }
            if($this->session->flashdata('error')){                
                $this->load->view('admin/msg/error');
                
            }
    ?>
            <div class="modal fade centered-modal in" id="sign_up">
                    <div class="container">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body">
                                <div class="header-section">    
                                    <img src="<?=base_url()?>webroot/admin/images/logo.png">
                                </div>                       
                                        <div class="model-half-section-first hide-on-mobile">  
                   <div id="carousel-example" class="carousel slide" data-ride="carousel">
             <div class="carousel-indicators-sec">        
              
            </div>
              <div class="carousel-inner">
                <div class="item active">
                  <a href="#"><img src="<?=base_url()?>webroot/admin/images/image-slider-1.png" /></a>

                </div>

              </div>


            </div>

            </div>
            <div class="model-half-section-second">
            <div class="login-detail-sec">
                <form class="m-t" role="form" action="<?=base_url('AdminController/forgotpassword')?>" id="form" method="post">
                <div class="login-header login-page-header"><span>Forgot Your Password</span></div>
                <div class="sab-header">Type register email and receive new password</div>
                   

                    <div class="col-lg-12 col-md-12 col-sm-12">
                        
                        <div class="form-label">Register Email</div>
                        <input class="effect-1 validate[required,custom[email]] formEmail" type="text"  data-errormessage-value-missing="Email is required" data-prompt-position="bottomLeft" id="email" name="email" placeholder="Register Email ID">
                        <span class="email_error" style="color: red;display: none" id="email_error">Email is not registered with us</span>
                        <!-- <div class="error-message">**Registered email is required</div> -->
                        <span class="focus-border"></span>    
                    </div>
                    
                    <div class="login-button"><button type="submit" id="email_submit" class="btn-hover color-3 forgot-page">Confirm</button></div>
                    </form>
                                                
                </div>
            </div>


<div class="model-half-section-first hide-on-pc">  
       <div id="carousel-example2" class="carousel slide" data-ride="carousel">
 <div class="carousel-indicators-sec">        

</div>
  <div class="carousel-inner">
    <div class="item active">
      <a href="#"><img src="<?=base_url()?>webroot/admin/images/image-slider-1.png" /></a>

    </div>
  </div>


</div>

</div>


                                                  
                    </div>
               
            
       
<footer>
                    <div class="footer-left-text" style="color: white;"> Copyright Bongtech (©) <?=date('Y')?></div>
                    <div class="footer-right-text" style="color: white;"> Design &amp; Developed by <a href="https://www.bongtechsolutions.com/" target="_blank"><strong>Bongtech Solutions Private Limited</strong></a></div>
                </footer>
    </div> </div></div> </div>
<style type="text/css">
    .formErrorContent {
  position: absolute;
    top: 17px !important;
    width: auto !important;
    left: 0px !important;
    z-index: 11 !important;
    text-transform: none !important;
    background-color: #f2dede !important;
    color: #a94442!important;
    padding: 3px 10px !important;
    font-size: 13px !important;
    font-weight: 500 !important;
    border-radius: 3px !important;
    border-color: #ebccd1;
}

.formErrorArrowBottom:after {
     content: '';
    position: absolute;
    bottom: 6px !important;
    left: -16px;
    width: 0;
    height: 0;
    border: 10px solid transparent;
    border-top-color: #f2dede!important;
    border-bottom: 0;
    margin-bottom: -11px;
    transform: rotate(180deg);
}

.email_error{
        position: absolute;
    top: 74px !important;
    width: auto !important;
    left: 15px !important;
    z-index: 11 !important;
    text-transform: none !important;
    background-color: #f2dede !important;
    color: #a94442!important;
    padding: 3px 10px !important;
    font-size: 13px !important;
    font-weight: 500 !important;
    border-radius: 3px !important;
    border-color: #ebccd1;
    }
    .email_error:after{
    content: '';
    position: absolute;
    bottom: 34px !important;
    left: 9px;
    width: 0;
    height: 0;
    border: 10px solid transparent;
    border-top-color: #f2dede!important;
    border-bottom: 0;
    margin-bottom: -11px;
    transform: rotate(180deg);
    }

</style>
  <script src='<?=base_url()?>webroot/admin/js/jquery-3.2.1.min.js'></script>
    <script src='<?=base_url()?>webroot/admin/js/common.js'></script>
    <script src='<?=base_url()?>webroot/admin/js/jquery.validationEngine.js'></script>
    <script src='<?=base_url()?>webroot/admin/js/jquery.validationEngine-en.js'></script>
    <!-- <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script> -->
    <script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'></script>
    <script src="<?=base_url()?>webroot/admin/js/plugins/toastr/toastr.min.js"></script>
</body>
</html>