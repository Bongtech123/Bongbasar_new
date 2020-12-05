<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bong Bazzar</title>
    <!-- =========== STYLESHEETS ============== -->
    <link rel="stylesheet" href="<?=base_url()?>webroot/user/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url()?>webroot/user/css/slick.css" type="text/css"> <!-- slick slider -->
    <link rel="stylesheet" href="<?=base_url()?>webroot/user/css/slick-theme.css" type="text/css"> <!-- slick slider -->
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <link rel="stylesheet" href="<?=base_url()?>webroot/user/css/hover-min.css">
    <link rel="stylesheet" href="<?=base_url()?>webroot/user/css/animate.css">
    <!-- <link rel="stylesheet" href="css/jquery.fancybox.min.css"> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <!-- <link rel="stylesheet" href="css/easyzoom.min.css"> -->
    <link rel="stylesheet" href="<?=base_url()?>webroot/user/css/jquery-ui.css">
    <link rel="stylesheet" href="<?=base_url()?>webroot/user/css/style.css">
    <link href='<?=base_url()?>webroot/user/css/validationEngine.jquery.css' rel="stylesheet">
    <link href='<?=base_url()?>webroot/user/css/toastr.min.css' rel="stylesheet">
  </head>
 
  <body>
    <input type="hidden" name="base_url" id="base_url" value="<?=base_url()?>">
    <input type="hidden" name="current_url" id="current_url" value="<?=current_url();?>">
    <!-- Header Section start -->
    <header>
      <nav class="navbar" role="navigation">
        <a href="javascript:void(0);" class="ic menu" tabindex="1">
          <span class="line"></span>
          <span class="line"></span>
          <span class="line"></span>
        </a>
        <a href="javascript:void(0);" class="ic close"></a>

        <div class="navbar-fixed-top">
          <div class="container">
              <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <i class="fa fa-bars"></i>
                      </button>
                  <a class="navbar-brand" href="<?=base_url()?>">Bong Bazzar</a>
              </div>

               <div class="collapse navbar-collapse" id="myNavbar">
                  <form class="navbar-form navbar-left" action="<?=base_url('search-engine')?>" method="post" >
                      <div class="form-group">
                          <input type="text" name="search" class="form-control" placeholder="Search your Product" >
                      </div>
                      <button type="submit" class="btn btn-default">
                        <i class="fa fa-search" aria-hidden="true"></i>
                      </button>
                  </form>
                  <ul class="nav navbar-nav navbar-right">
                      <li><a href=""><i class="fa fa-shopping-bag" aria-hidden="true"></i> Bag<span class="badge"></span></a></li>
                      <?php $userdata=$this->session->userdata('loginDetail');
                            if(empty($userdata)){
                      ?>
                      <li><a href="javascript-void(0)" data-toggle="modal" data-target="#signIn"><i class="fa fa-sign-out" aria-hidden="true"></i> Login</a></li>
                      <?php 
                           }else{
                      ?>
                      <li class="profile">
                        <a href=""><i class="fa fa-user" aria-hidden="true"></i>
                          <span class="profile-name"><?=$userdata->name;?></span>
                        </a>
                        <div class="sub-options">
                          <span class="indicator"></span>
                          <ul>
                            <li><a href="<?=base_url('profile');?>">Profile</a></li>
                          </ul>
                          <a href="<?=base_url('logout');?>" class="btn card-button-inner bag-button buy-btn btn-block">
                            <span>Logout</span>
                          </a>
                        </div>
                      </li>
                    <?php } ?>
                  </ul>
              </div>
          </div>
        </div>

        <div class="mega-menu">
          <div class="container">
            <div class="dark">
              <ul class="main-nav">
                <li class="top-level-link">
                    <a><span>Home</span></a>
                </li>
                <?php foreach($menu_lebel as $category_row):?>
                <li class="top-level-link">
                    <a class="mega-menus"><span><?=$category_row->category_name?></span></a>
                    <div class="sub-menu-block">
                        <div class="row">
                          <?php foreach($category_row->sub as $sub_category_row):?>

                            <div class="col-md-2 col-lg-2 col-sm-2">
                                <h2 class="sub-menu-head"><?=$sub_category_row->sub_category_name?></h2>
                                <ul class="sub-menu-lists">
                                  <?php foreach($sub_category_row->child as $child_category_row):?>

                                    <li><a><?=$child_category_row->child_category_name?></a></li>
                                 
                                  <?php endforeach;?>

                                </ul>
                            </div>
                            <?php endforeach;?>

                        </div>

                        <!-- <div class="row banners-area">
                            <div class="col-md-6 col-lg-6 col-sm-6">
                                <img src="http://devitems.com/tf/teemo-preview/teemo/img/banner/banner-menu1.jpg" width="100%;">
                            </div>
                            <div class="col-md-6 col-lg-6 col-sm-6">
                                <img src="http://devitems.com/tf/teemo-preview/teemo/img/banner/banner-menu1.jpg" width="100%;">
                            </div>
                        </div> -->

                    </div>
                </li>
                <?php endforeach;?>
                
               
              </ul>
            </div>
            
          </div>
        </div>
      </nav>
    </header>
    <!-- Header Section end -->
      <!-- ------------Modal css start------------ -->
      <section id="modal-section">
        <div class="modal-section">
          <div class="modal inmodal" id="signIn" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content animated bounceInRight signin-modal">
                    <!-- <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Package Description</h4>

                    </div> -->
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-4 about-modal">
                          <div class="login_left">
                              <h2>All Shop in one STORE</h2>
                              <p>Now start your shopping in your favorite shop from home.</p>
                          </div>
                        </div>
                        <div class="col-md-8 modal-form">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                          <div class="login_right">
                            <div class="company-logo">
                              <img src="<?=base_url()?>webroot/user/images/logo.png">
                            </div>
                            <ul class="nav nav-tabs">
                              <li class="active"><a data-toggle="tab" href="#home">I AM A MEMBER</a></li>
                              <li><a data-toggle="tab" href="#menu1">I AM NEW HERE</a></li>
                            </ul>

                            <div class="tab-content">
                              <div id="home" class="tab-pane fade in active">
                                <div class="col-md-12 modal-form-underpart">
                                  <form  id="login" method="post">
                                    <div class="form-group">
                                      <label for="userId">User Id:</label>
                                      <input type="text" class="form-control validate[required]" id="userId" placeholder="Enter email or phone no" name="userId"data-errormessage-value-missing="Email or phone is required" data-prompt-position="bottomLeft" maxlength="200">
                                    </div>
                                    <div class="form-group">
                                      <label for="password">Password:</label>
                                      <input class="form-control effect-1 validate[required]" type="password" id="password" name="password" data-errormessage-value-missing="Password is required!" data-prompt-position="bottomLeft"  maxlength="20" placeholder="Enter your password">                                    

                                    <i class="fa fa-eye-slash showicon" onclick="toggleShowPassword()" id="showicon"></i>
                                            
                                    </div>
                                    <span class="error" style="color: red"></span>
                                    <button type="submit" class="btn btn-block submit-btn hvr-bounce-to-right hvr-icon-pulse-grow">
                                      Sign In
                                      <i class="fa fa-sign-in hvr-icon" aria-hidden="true"></i>
                                    </button>
                                  </form>
                                </div>
                              </div>
                              <div id="menu1" class="tab-pane fade">
                                <div id="step1">
                                <div class="col-md-12 modal-form-underpart">
                                 <form  id="register" method="post">
                                    <div class="form-group">
                                      <label for="mobile_no">Phone no:</label>
                                      <input type="text" name="mobile_no" id="mobile_no" class="form-control only_integer validate[required,custom[phone]]minSize[10],maxSize[10]" data-errormessage-value-missing="Phone number is required" data-prompt-position="bottomLeft" placeholder="Enter phone number" maxlength="10">
                                    </div>
                                    <span class="reg-error" style="color: red"></span>
                                    <button type="submit" class="btn btn-block submit-btn hvr-bounce-to-right hvr-icon-pulse-grow">
                                      Sign Up
                                      <i class="fa fa-sign-in hvr-icon" aria-hidden="true"></i>
                                    </button>
                                  </form>
                                </div>
                              </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>
                </div>
            </div>
          </div>
        </div>
      </section>
    <!-- Modal css end -->