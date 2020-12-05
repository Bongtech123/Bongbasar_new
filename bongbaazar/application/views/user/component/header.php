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
    <link rel="stylesheet" href="<?=base_url()?>webroot/user/css/font-awesome.css">
    <link rel="stylesheet" href="<?=base_url()?>webroot/user/css/hover-min.css">
    <link rel="stylesheet" href="<?=base_url()?>webroot/user/css/animate.css">
    <!-- <link rel="stylesheet" href="css/jquery.fancybox.min.css"> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway" >
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <!-- <link rel="stylesheet" href="css/easyzoom.min.css"> -->
    <link rel="stylesheet" href="<?=base_url()?>webroot/user/css/jquery-ui.css">
    <link rel="stylesheet" href="<?=base_url()?>webroot/user/css/style.css">
    <!-- Swapan add -->
    <link href='<?=base_url()?>webroot/user/css/validationEngine.jquery.css' rel="stylesheet">
    <link href="<?=base_url()?>webroot/user/css/toastr.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url()?>webroot/user/css/bootstrap-select.min.css">
    <script type="text/javascript" charset="utf-8" src="<?=base_url()?>webroot/user/js/jquery.js"></script>

  </head>
 
  <body>
    <!-- Back to top button start -->
        <a class="bounce-2" id="back-to-top"></a>
    <!-- Back to top button end -->

    <!-- ----------Window loader start---------- -->
      <div class="loader-wrapper">
        <div class="loader"></div>
        
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
      </div>
    <!-- Window loader end -->

    <!-- Header Section start -->
      <header>
        <nav class="navbar" role="navigation">
          

          <div class="navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                          <i class="fa fa-bars"></i>
                        </button> -->
                    <a class="navbar-brand wow pulse" href="<?=base_url()?>">
                      <img src="<?=base_url()?>webroot/user/images/nwlogo.png">
                    </a>
                    <!-- Only for mobile -->
                    <ul>
                      <li>
                        <a href="javascript-void(0);">
                          <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                        </a>
                      </li>
                      <li>
                        <a href="javascript-void(0);">
                          <i class="fa fa-heart" aria-hidden="true"></i>
                        </a>
                      </li>
                      <li id="openSearch">
                        <a>
                          <i class="fa fa-search" aria-hidden="true"></i>
                        </a>
                      </li>
                    </ul>
                    <!-- end -->
                </div>

                <div class="collapse navbar-collapse " id="myNavbar">
                    <div id="searchfield" >
                      <form class="navbar-form navbar-left" action="<?=base_url('search-engine')?>" method="post">
                          <div class="form-group">
                            <input type="hidden" name="" id="search_data" value="">
                            <?php if($this->session->flashdata('searchItem')){?>
                              <input type="text" id="autocomplete1" name="autocomplete1" class="form-control"value="<?=$this->session->flashdata('searchItem')?>">
                            <?php }else{?>
                              <input type="text" id="autocomplete1" name="autocomplete1" class="form-control">
                            <?php }?>
                          </div>
                          <button type="button" id="sbutton" class="btn btn-default" onclick="changeStatusSearch()">
                            <i class="fa fa-search" aria-hidden="true"></i>
                          </button>
                      </form>
                    </div>
                    <ul class="nav navbar-nav navbar-right">
                        <?php $userdata=$this->session->userdata('loginDetail');?>
                        <?php if(!empty($userdata)){?>
                        <li><a href="<?=base_url('bag')?>" class="wow bounceInDown"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Bag<span class="badge">1</span></a></li>
                        <?php }else {?>
                          <li><a href="javascript-void(0)" class="wow bounceInDown" data-toggle="modal" data-target="#signIn"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Bag<span class="badge"></span></a></li>
                        <?php }?>
                        <!-- <li><a href="" class="wow bounceInDown"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a></li> -->
                        <?php
                            if(empty($userdata)){
                        ?>
                        <li><a href="javascript-void(0)" class="wow bounceInDown" data-toggle="modal" data-target="#signIn"><i class="fa fa-sign-out" aria-hidden="true"></i> Login</a></li>
                        <?php 
                           }else{
                        ?>
                         <li class="profile">
                          <a href="" class="wow bounceInDown"><i class="fa fa-user" aria-hidden="true"></i>
                            <span class="profile-name"><?=($userdata->name=="")?'My Account':$userdata->name?></span>
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
                <a href="javascript:void(0);" class="ic menu" tabindex="1">
                  <span class="line"></span>
                  <span class="line"></span>
                  <span class="line"></span>
                </a>
                <a href="javascript:void(0);" class="ic close"></a>

                <ul class="main-nav">
                  <li class="mobile-profile top-level-link">
                    <div class="after-login">
                      <div class="mobile-profile-img">
                        <img src="https://pbs.twimg.com/media/DhPVk9eWsAAhTqm.jpg">
                      </div>
                      <h3>Subhajit Manna</h3>
                    </div>
                    <div class="before-login container-fluid">
                      <div class="col-xs-6 col-sm-6">
                        <button type="submit" class="btn submit-btn btn-block hvr-bounce-to-right hvr-icon-pulse-grow">
                          Sign In
                          <i class="fa fa-sign-in hvr-icon" aria-hidden="true"></i>
                        </button>
                      </div>
                      <div class="col-xs-6 col-sm-6">
                        <button type="submit" class="btn submit-btn btn-block hvr-bounce-to-right hvr-icon-pulse-grow">
                          Sign Up
                          <i class="fa fa-sign-out hvr-icon" aria-hidden="true"></i>
                        </button>
                      </div>
                    </div>
                  </li>
                  <li class="top-level-link wow bounceInUp">
                      <a href="<?=base_url('all-shop')?>"><span>Shop</span></a>
                  </li>
                  <?php foreach($menu_lebel as $category_row){?>

                  <li class="top-level-link wow bounceInUp">
                      <a class="mega-menus"><span><?=$category_row->category_name?></span></a>
                      <div class="sub-menu-block">
                          <div class="row">
                            <?php foreach($category_row->sub as $sub_category_row){?>

                              <div class="col-md-2 col-lg-2 col-sm-2">
                                  <h2 class="sub-menu-head"><?=$sub_category_row->sub_category_name?></h2>
                                  <ul class="sub-menu-lists">
                                    <?php foreach($sub_category_row->child as $child_category_row){?>

                                      <li><a href="<?=base_url('category-all-product/'.$sub_category_row->uniqcode.'_'.$child_category_row->uniqcode);?>"><?=$child_category_row->child_category_name?></a></li>
                                    <?php }?>

                                  </ul>
                              </div>
                            <?php }?>
                          </div>

                         <!--  <div class="row banners-area">
                              <div class="col-md-6 col-lg-6 col-sm-6">
                                  <img src="<?=base_url()?>webroot/user/images/header-add.jpg">
                              </div>
                              <div class="col-md-6 col-lg-6 col-sm-6">
                                  <img src="<?=base_url()?>webroot/user/images/header-add.jpg">
                              </div>
                          </div> -->

                      </div>
                  </li>
                  <?php }?>
                </ul>
              </div>
            </div>
          </div>
        </nav>
        <!-- <nav role="navigation">
          <a href="javascript:void(0);" class="ic menu" tabindex="1">
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
          </a>
          <a href="javascript:void(0);" class="ic close"></a>
          
        </nav> -->
      </header>
    <!-- Header Section end -->

    <!-- ------------Modal css start------------ -->
      <section id="modal-section">
        <div class="modal-section">
          <!-- SignIn and register modal start -->
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
                              <img src="<?=base_url('webroot/user/')?>images/nwlogo.png">
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
                                <div class="col-md-12 modal-form-underpart">
                                  <form  id="register" method="post">

                                    

                                    <div class="form-group">
                                      <label for="mobile_no">Phone no:</label>
                                      <input type="text" name="mobile_no" id="mobile_no" class="form-control only_integer validate[required,custom[phone]]minSize[10],maxSize[10]" data-errormessage-value-missing="Phone number is required" data-prompt-position="bottomLeft" placeholder="Enter phone number" maxlength="10">
                                    </div>
                                    <span class="reg-error regErrorBottom" style="display: none;"></span>
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
          <!-- SignIn and register modal end -->

          <!-- --Rate & Review modal start-- -->
          <div class="modal inmodal" id="rateReview" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content animated bounceInRight rateReview-modal">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title middle-heading">Rating & Reviews<span></span></h4>
                    </div>
                    <div class="modal-body">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-md-2">
                            <div class="product-img">
                              <img src="https://assets.myntassets.com/w_111,h_148,q_95,c_limit,fl_progressive/h_148,q_95,w_111/v1/assets/images/productimage/2019/9/21/b7a40051-2ea0-44d0-805b-10761f4844dd1569013480119-1.jpg">
                            </div>
                          </div>
                          <div class="col-md-10">
                            <div class="product-details">
                              <p class="product-title">Formal Saree</p>
                              <p class="product-description">Mustard Silk Blend Woven Design Banarasi Saree</p>
                              <div class="star">
                                <div class="star__item"><i class="fa fa-star emoji--happy" aria-hidden="true"></i></div>
                                <div class="star__item"><i class="fa fa-star emoji--sad" aria-hidden="true"></i></div>
                                <div class="star__item"><i class="fa fa-star emoji--crying" aria-hidden="true"></i></div>
                                <div class="star__item"><i class="fa fa-star emoji--grimacing" aria-hidden="true"></i></div>
                                <div class="star__item"><i class="fa fa-star emoji--love" aria-hidden="true"></i></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <p class="review-heading">Review this product</p>
                        <div class="form-group">
                          <textarea id="product-review" name="product-review" rows="4" placeholder="Please write product review here"></textarea>
                        </div>
                        <div class="review-img-contaner">
                          <span class="writeReview-gallery">
                            <div tabindex="0" style="outline: none;">
                              <input type="file" name="product" accept="image/*" multiple="" >
                              <i class="fa fa-picture-o" aria-hidden="true"></i>
                            </div>
                          </span>
                          <div class="review-img">
                            <img src="https://assets.myntassets.com/w_111,h_148,q_95,c_limit,fl_progressive/h_148,q_95,w_111/v1/assets/images/productimage/2019/9/21/b7a40051-2ea0-44d0-805b-10761f4844dd1569013480119-1.jpg">
                            <i class="fa fa-minus-circle" aria-hidden="true"></i>
                          </div>
                        </div>
                      </div>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn card-button-inner buy-btn save-btn">
                        <span>Submit</span>
                      </button>
                    </div>
                </div>
            </div>
          </div>
          <!-- Rate & Review modal end -->


        </div>
      </section>
    <!-- Modal css end -->
    <input type="hidden" name="base_url" id="base_url" value="<?=base_url()?>">
    <input type="hidden" name="current_url" id="current_url" value="<?=current_url();?>">
    <?php
      if($this->session->flashdata('success'))
      {
        $this->load->view('msg/success');
      }
      if($this->session->flashdata('error'))
      {
        $this->load->view('msg/error');
      }
    ?>
<style type="text/css">
  .reg-error {
    position: absolute;
    top: 75px !important;
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
  
  .regErrorBottom:after {
    content: '';
    position: absolute;
    bottom: 35px !important;
    left: 16px;
    width: 0;
    height: 0;
    border: 10px solid transparent;
    border-top-color: #f2dede!important;
    border-bottom: 0;
    margin-bottom: -11px;
    transform: rotate(180deg);
  }
</style>