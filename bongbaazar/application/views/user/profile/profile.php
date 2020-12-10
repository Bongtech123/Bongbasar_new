<?php //$userdata=$this->session->userdata('loginDetail');?>
                
<!-- -------Profile dashboard section start------- -->
      <section id="dashboard">
        <div class="dashboard">
          <div class="container">
            <div class="row">
              <div class="col-md-4">
                <div class="profile-grid">

                  <div class="profile-image"> 
                      <form method="post" action="<?=base_url('profile-picture-update')?>" enctype="multipart/form-data">
                      <input type="hidden" name="uniqcode" value="<?=$user_profile->uniqcode?>">
                      <input type="hidden" name="old_image" value="<?=$user_profile->image?>">



                    <?php if(!empty($user_profile->image)){?>
                      <img src="<?= base_url('webroot/user/profile/web/'.$user_profile->image)?>" id="upload_profile" onclick="get_upload_profile()" class="add_img_button">
                      <input type="file" class="image-upload select_image" name="image" class="validate[required]" id="profile_input_upload" style="display: none" accept=".jpg,.jpeg,.png" onchange="profile_show_photo(this)">
                  
                    <?php }else{?>
                       <img src="<?= base_url('webroot/user/images/profile_default.jpg')?>" id="upload_profile" onclick="get_upload_profile()" class="add_img_button">
                      <input type="file" class="image-upload select_image" name="image" class="validate[required]" id="profile_input_upload" style="display: none" accept=".jpg,.jpeg,.png" onchange="profile_show_photo(this)">
             


                    <?php }?>
                  
                    <div class="change-profile-btn" style="display: none;">
                      <input type="submit" name="profile-image">
                      <i class="fa fa-check" aria-hidden="true"></i>
                    </div>
                    </form>

                  </div>
                  <?php if(!empty($user_profile->name)){
                      $un=explode("##",$user_profile->name);
                    ?>
                  <p class="prof-name"><?=$un[0].' '.$un[1];?></p>
                  <?php }?>
                </div>
                <div class="profile-options">
                  <ul class="nav">
                    <li class="active">
                      <a data-toggle="tab" href="#profile-details">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <span>Profile Details</span>
                      </a>
                    </li>
                    <li>
                      <a data-toggle="tab" href="#address">
                        <i class="fa fa-address-card" aria-hidden="true"></i>
                        <span>Address</span>
                      </a>
                    </li>
                    <li>
                      <a data-toggle="tab" href="#orders">
                        <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                        <span>Orders</span>
                      </a>
                    </li>
                    <li>
                      <a data-toggle="tab" href="#wishlist">
                        <i class="fa fa-heart" aria-hidden="true"></i>
                        <span>Wishlist</span>
                      </a>
                    </li>
                  <!--   <li>
                        <a data-toggle="tab" href="#wallet">
                            <i class="fa fa-university" aria-hidden="true"></i>
                            <span>Bong Wallet</span>
                        </a>
                    </li> -->
                    <!-- <li>
                      <a data-toggle="tab" href="#notifications">
                        <i class="fa fa-bell" aria-hidden="true"></i>
                        <span>Notifications</span>
                      </a>
                    </li> -->
                  </ul>
                </div>
                
              </div>
              <div class="col-md-8">
                <?php 
                  if(!empty($user_profile))
                  {
                      $str=$user_profile->name;
                      $name=explode("##",$str);
                  }
                ?>
                <div class="tab-content">
                  <div id="profile-details" class="tab-pane fade in active">
                    <div class="profile-heading">
                      <div class="ribbon9">
                        <h3>Profile Details</h3>
                      </div>
                    </div>
                    <div class="profile-details-innerpart">
                      <form method="post" id="user_profile" action="<?=base_url('profile-update')?>">
                        <input type="hidden" name="uniqcode" value="<?=$user_profile->uniqcode?>">
                        <input type="hidden" name="old_first_name" value="<?php if(!empty($name)){echo $name[0];}?>">
                        <input type="hidden" name="old_last_name" value="<?php if(!empty($name)){echo $name[1];}?>">
                      <div class="form-group">
                        <label>First Name: <span class="change" onclick="changefname()">Change</span></label>
                        <input type="text" name="first_name" class="form-control only_character validate[required]" id="first_name" placeholder="Enter first name" data-errormessage-value-missing="first name is required" data-prompt-position="bottomLeft" maxlength="200" value="<?=$name[0];?>" disabled>
                      </div>
                      <div class="form-group">
                        <label>Last Name: <span class="change" onclick="changelname()">Change</span></label>
                        <input type="text" name="last_name" class="form-control only_character validate[required]" id="last_name" placeholder="Enter Last name" data-errormessage-value-missing="Last name is required" data-prompt-position="bottomLeft" maxlength="200"  value="<?php if(!empty($name)){echo $name[1];}?>" disabled>
                      </div>
                    
                      <div class="form-group">
                        <label>Gender: <span class="change" onclick="changegender()">Change</span></label>
                        <?php if(empty($user_profile->gender)){?>
                        <div class="col-md-6">
                          <input type="radio" id="male" name="gender" disabled="true" value="male">
                          <label for="male">Male</label>
                        </div>
                        <div class="col-md-6">
                          <input type="radio" id="female" name="gender" disabled="true" value="female">
                          <label for="female">Female</label>
                        </div>
                        <?php }else{?>
                          <?php if($user_profile->gender=='male'){?>
                          <div class="col-md-6">
                            <input type="radio" id="male" name="gender" checked disabled="true" value="male">
                            <label for="male">Male</label>
                          </div>
                          <div class="col-md-6">
                            <input type="radio" id="female" name="gender" disabled="true" value="female">
                            <label for="female">Female</label>
                          </div>
                          <?php }else{?>
                             <div class="col-md-6">
                            <input type="radio" id="male" name="gender"  disabled="true" value="male">
                            <label for="male">Male</label>
                          </div>
                          <div class="col-md-6">
                            <input type="radio" id="female" name="gender" checked  disabled="true" value="female">
                            <label for="female">Female</label>
                          </div>
                          <?php }?>
                        <?php }?>
                      </div>
                      <div class="form-group">
                        <label>Mobile: </label>
                        <input type="text" name="mobile_no" id="mobile_no1" class="form-control" placeholder="Enter Mobile" value="<?php if(!empty($user_profile->mobile_no)){echo $user_profile->mobile_no;}?>" disabled>
                      </div>
                      <div class="form-group">
                        <label>Email: <span class="change" onclick="changeemail()">Change</span></label>
                        <input type="email" name="email" id="email" class="form-control validate[required,custom[email]]" data-errormessage-value-missing="Email is required" data-prompt-position="bottomLeft" placeholder="Enter email" maxlength="200"  disabled value="<?php if(!empty($user_profile->email)){echo $user_profile->email;}?>">
                      </div>
                       <input type="submit" id="submit" class="form-control" value="Save" disabled>
                      </form>
                    </div>
                  </div>
                  <div id="address" class="tab-pane fade">
                    <div class="profile-heading">
                      <div class="ribbon9">
                        <h3>Manage Address</h3>
                      </div>
                    </div>
                    <div class="delivery-part-header">
                      <div class="delivery-part-header-tittle">Saved Addresses</div>
                      <div class="add-address">
                        <button type="button" class="btn card-button-inner address-btn" data-toggle="modal" data-target="#myAddressModal">
                          <span>Add New Address</span>
                        </button>
                      </div>
                    </div>
                    <div class="all-address">
                      <?php if(!empty($user_address)){
                        foreach ($user_address as $address_row){
                      ?>
                      <div class="product-single-item">
                        <div class="product-single-item-innerpart">
                          <div class="delivery-own-name">
                            <span><?=$address_row->name?></span>
                            <span class="delivery-address-type"><?=$address_row->address_type?></</span>
                          </div>
                          <p class="main-address">
                            <?=$address_row->address_details?>
                          </p>
                          <p class="mobile-no">
                            Mobile
                            <span><?=$address_row->mobile_no?></span>
                          </p>
                          
                          <div class="button-part">
                            <a type="button" class="btn card-button-inner remove-btn" href="<?=base_url('address-destroy/'.$address_row->uniqcode)?>" onclick="return confirm('Are you sure delete this address?')">
                              <span>Remove</span>
                            </a>
                            <button type="button" class="btn card-button-inner edit-btn" onclick="editAddress('<?=$address_row->uniqcode?>')">
                              <span>Edit</span>
                            </button>
                          </div>
                        </div>
                      </div>
                     <?php }}?>
                    </div>
                  </div>
                  <div id="orders" class="tab-pane fade">
                    <div class="profile-heading">
                      <div class="ribbon9">
                        <h3>My Orders</h3>
                      </div>
                    </div>
                    <div class="my-orders">
                    <?php 
                    
                    foreach ($user_order as $user_order_row)
                    {
                      $user_details=unserialize($user_order_row->address);
                      if(!empty($user_details))
                      {
                    ?>
                    <a href="<?=base_url('order-details/'.$user_order_row->order_code)?>">
                        <div class="product-single-item">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="product-details">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="product-img more-img-outer">
                                                        <a class="dress-card-img" href="#">
                                                       
                                                          
                                                     
                                                           <?php 
                                                            $product_img=unserialize($user_order_row->image);
                                                            if(!empty($product_img))
                                                            {?>
                                                                <img class="" src="<?=base_url('webroot/admin/product/web/').$product_img[0]?>" alt="">
                                                                <?php
                                                            }
                                                            else
                                                            {
                                                                ?><img src="<?=base_url('webroot/user/images/no_image.jpg')?>"><?php
                                                            }
                                                            ?>
                                                
                                                        </a>
                                                        <?php $img=($user_order_row->count-1);
                                                        if($img!=0){
                                                        ?>
                                                        <div class="more-img">
                                                            <p><?=$img?>+</p>
                                                        </div>
                                                      <?php }?>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="product-title">ORDER NO:
                                                        <?=$user_order_row->order_code?>
                                                    </p>
                                                    <p class="product-description"><span class="product-title">Number of items: </span>
                                                        <?=$user_order_row->count?>
                                                    </p>
                                                    <p class="ship-to"><span class="product-title">Order From:</span>
                                                    <?php
                                                        if(!empty($user_order_row->order_from))
                                                        {
                                                          $user_name=explode("##",$user_order_row->order_from);
                                                          echo $user_name[0].' '.$user_name[1];
                                                        }
                                                        else{
                                                          echo $user_details->name;
                                                        }
                                                       
                                                      ?>
                                                    </p>
                                                    <p class="ship-to"><span class="product-title">Ship to:</span>
                                                        <?=$user_details->name?>
                                                    </p>
                                                    
                                                </div>
                                                <div class="col-md-4 product-details-right">
                                                    <p class="order-date product-title"><span>Order On:</span>
                                                        <?=$user_order_row->order_date?>
                                                    </p>
                                                    <p class="base-value">
                                                        <span class="product-title">Total Amount:</span>
                                                        <svg width="8" height="10" viewBox="0 0 8 10" class="priceDetail-base-icon">
                                                        <path fill-rule="nonzero" d="M1.951 5.845l3.91 3.602-.902.376L.7 5.845l.452-.711c.186-.005.392-.02.615-.048a5.2 5.2 0 0 0 1.347-.356c.218-.09.42-.201.604-.331.185-.13.345-.281.479-.455.134-.173.231-.371.29-.594H.865v-.841h3.644a1.759 1.759 0 0 0-.284-.667 1.826 1.826 0 0 0-.567-.512 2.964 2.964 0 0 0-.865-.332A5.22 5.22 0 0 0 1.63.882H.864V0h6.2v.882H4.18c.173.077.33.174.468.29a2.09 2.09 0 0 1 .612.848c.064.162.11.325.137.489h1.668v.84H5.383a2.38 2.38 0 0 1-.43 1.03 3.095 3.095 0 0 1-.8.748 4.076 4.076 0 0 1-1.043.482 6.15 6.15 0 0 1-1.159.236z"></path>
                                                        </svg>
                                                        <span ><?=Intval($user_order_row->sell_price+$user_order_row->shipping_price)?></span>
                                                    </p>
                                                    <p><span class="product-title">Deliverd: </span>
                                                    <?=$user_order_row->delivery_date?>
                                                    </p>
                                                    <p><span class="contact-no"><span class="product-title">Contact No:</span>
                                                    <?=$user_details->mobile_no?>
                                                    </p>
                                                </div>
                                            </div>
                                         
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                  <?php 
                      }
                    }
                  ?>
                </div>
                    
                  </div>
                  <div id="wishlist" class="tab-pane fade">
                    <div class="profile-heading">
                      <div class="ribbon9">
                        <h3>My Wishlist</h3>
                      </div>
                    </div>
                    <div class="all-wishlist">
                      <?php foreach($user_wishlist as $user_wishlist_row){?>
                      <div class="product-single-item">
                        <i class="fa fa-times" aria-hidden="true" onclick="wishlist('<?=$user_wishlist_row->product_uniqcode.'_'.$user_wishlist_row->uniqcode?>')"></i>
                        <div class="container-fluid">
                          <div class="row">
                            <div class="col-md-2">
                              <div  class="product-img">
                                <a class="dress-card-img" href="<?=base_url('product/'.$user_wishlist_row->slug.'?proid='.$user_wishlist_row->product_uniqcode.'&feid='.$user_wishlist_row->uniqcode.'&cid='.$user_wishlist_row->color.'&type='.$user_wishlist_row->product_type)?>">
                                <?php $product_img=unserialize($user_wishlist_row->image); 
                                if(!empty($product_img))
                                {
                                    ?>
                                  
                                    <img  src="<?=base_url('webroot/admin/product/web/').$product_img[0]?>" alt="">
                                    <?php
                                }
                                else
                                {
                                    ?><img src="<?=base_url('webroot/user/images/no_image.jpg')?>"><?php
                                }
                                ?>
                              </a>
                              </div>
                            </div>
                            <div class="col-md-10">
                              <div class="product-details">
                                <div class="row">
                                  <div class="col-md-8">
                                    <p class="product-title"><?=$user_wishlist_row->product_name?></p>
                                    <p class="sold-by"><a href="<?=base_url('shop/'.$user_wishlist_row->admin_id)?>">Sold By:<?=$user_wishlist_row->admin_name?></a></p>
                                    <p class="sold-by">Product Type:<?=$user_wishlist_row->product_type?></a></p>
                                    <p class="sold-by">Color:<?=$user_wishlist_row->color_name?></a></p>
                                  </div>
                                
                                  <div class="col-md-4 product-details-right">
                                    <p class="base-value product-title">
                                      <svg width="8" height="10" viewBox="0 0 8 10" class="priceDetail-base-icon">
                                        <path fill-rule="nonzero" d="M1.951 5.845l3.91 3.602-.902.376L.7 5.845l.452-.711c.186-.005.392-.02.615-.048a5.2 5.2 0 0 0 1.347-.356c.218-.09.42-.201.604-.331.185-.13.345-.281.479-.455.134-.173.231-.371.29-.594H.865v-.841h3.644a1.759 1.759 0 0 0-.284-.667 1.826 1.826 0 0 0-.567-.512 2.964 2.964 0 0 0-.865-.332A5.22 5.22 0 0 0 1.63.882H.864V0h6.2v.882H4.18c.173.077.33.174.468.29a2.09 2.09 0 0 1 .612.848c.064.162.11.325.137.489h1.668v.84H5.383a2.38 2.38 0 0 1-.43 1.03 3.095 3.095 0 0 1-.8.748 4.076 4.076 0 0 1-1.043.482 6.15 6.15 0 0 1-1.159.236z"></path>
                                      </svg>
                                      <span><?=intval($user_wishlist_row->sell_price)?></span>
                                    </p>
                                    <p class="base-value">
                                      <svg width="8" height="10" viewBox="0 0 8 10" class="priceDetail-base-icon">
                                        <path fill-rule="nonzero" d="M1.951 5.845l3.91 3.602-.902.376L.7 5.845l.452-.711c.186-.005.392-.02.615-.048a5.2 5.2 0 0 0 1.347-.356c.218-.09.42-.201.604-.331.185-.13.345-.281.479-.455.134-.173.231-.371.29-.594H.865v-.841h3.644a1.759 1.759 0 0 0-.284-.667 1.826 1.826 0 0 0-.567-.512 2.964 2.964 0 0 0-.865-.332A5.22 5.22 0 0 0 1.63.882H.864V0h6.2v.882H4.18c.173.077.33.174.468.29a2.09 2.09 0 0 1 .612.848c.064.162.11.325.137.489h1.668v.84H5.383a2.38 2.38 0 0 1-.43 1.03 3.095 3.095 0 0 1-.8.748 4.076 4.076 0 0 1-1.043.482 6.15 6.15 0 0 1-1.159.236z"></path>
                                      </svg>  
                                      <span class="dress-card-crossed"><?=intval($user_wishlist_row->mrp_price)?></span>
                                      <span class="dress-card-off">&ensp;(<?=intval($user_wishlist_row->discount)?>% OFF)</span>
                                    </p>
                                    <!-- <p>Delivery By: Wed Sep 2</p> -->
                                  </div>
                                </div>
                                
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php } ?>
                    </div>
                  </div>

                  <div id="wallet" class="tab-pane fade">
                    <div class="profile-heading">
                        <div class="ribbon9">
                            <h3>My Wallet</h3>
                        </div>
                    </div>
                    <div class="wallet">
                        <div class="wallet-header">
                            <div class="wallet-header-inner">
                                <img src="https://st2.depositphotos.com/1263399/7408/v/450/depositphotos_74080547-stock-illustration-colorful-henna-mandala-design.jpg">
                            </div>
                            <div class="wallet-name">
                                <p>Bong Wallet</p>
                            </div>
                            <div class="wallet-total">
                                <p>Total Value</p>
                            </div>
                            <div class="wallet-money">
                                <p>₹ 420</p>
                            </div>
                        </div>
                        <div class="wallet-content plus">
                            <div class="content-icon">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </div>
                            <div class="content-text">
                                <p class="text-bold">Apple iphone</p>
                                <p class="text-light">12 July, 2016</p>
                            </div>
                            <div class="content-money">
                                <p>₹ 420</p>
                            </div>
                        </div>
                        <div class="wallet-content minus">
                            <div class="content-icon">
                                <i class="fa fa-minus" aria-hidden="true"></i>
                            </div>
                            <div class="content-text">
                                <p class="text-bold">Apple iphone</p>
                                <p class="text-light">12 July, 2016</p>
                            </div>
                            <div class="content-money">
                                <p>₹ 420</p>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div id="notifications" class="tab-pane fade">
                    <div class="profile-heading">
                      <div class="ribbon9">
                        <h3>Notifications</h3>
                      </div>
                    </div>
                    <p>There are no notifications for you.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    <!-- Profile dashboard section end -->

<!-- address modal start -->
<div class="modal animated bounceInRight" id="myAddressModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Address Add</h4>
        </div>
        <div class="modal-body">
          <form role="form" id="address-add" action="<?=base_url('address-add')?>" method="post" enctype="multipart/form-data">
          <input type="hidden" name="user_id" value="<?=$user_profile->uniqcode?>">

            <div class="row">
            <!-- <input type="hidden" name="edit_data" id="edit_data"> -->
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Name:</label>
                  <input type="text" name="name" id="name" class="form-control only_character validate[required,custom[fullname]]" data-errormessage-value-missing="Name is required" data-prompt-position="bottomLeft" placeholder="Type name" maxlength="200">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Mobile Number:</label>
                  <input type="text" name="mobile_no" id="mobile_no" class="form-control only_integer validate[required,custom[phone]]minSize[10],maxSize[10]" data-errormessage-value-missing="Phone number is required" data-prompt-position="bottomLeft" placeholder="Enter phone number" maxlength="10">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Pin Code:</label>
                  <input type="text" name="pin_code" id="pin_code" class="form-control only_integer validate[required]" data-errormessage-value-missing="Pin code is required" data-prompt-position="bottomLeft" placeholder="Enter pin code" maxlength="200">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Locality:</label>
                  <input type="text" name="locality" id="locality" class="form-control form-control validate[required]" data-errormessage-value-missing="Locality  is required" data-prompt-position="bottomLeft" placeholder="Enter Locality " maxlength="200">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                    <label>State</label>
                    <select id="state" name="state" class="form-control validate[required]" data-errormessage-value-missing="State is required" data-prompt-position="bottomLeft">
                        <option value="">Select State</option>
                    <?php 
                     
                    foreach($all_state as $all_state_row){?>
                        <option value="<?=$all_state_row->id;?>"><?=$all_state_row->name?></option>
                    <?php }?>
                    </select>    
                </div> 
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>City/District/Town:</label>
                   <input type="text" name="city_dist_town" id="city_dist_town" class="form-control only_character validate[required]" data-errormessage-value-missing="City/District/Town is required" data-prompt-position="bottomLeft" placeholder="Type City/District/Town" maxlength="200">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Landmark:</label>
                  <input type="text" name="landmark" id="landmark" class="form-control validate[required]" data-errormessage-value-missing="Landmark is required" data-prompt-position="bottomLeft" placeholder="Enter Landmark " maxlength="200">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                <label>Alternative Mobile No:</label>
                <input type="text" name="alternative_mob_no" id="alternative_mob_no" class="form-control only_integer minSize[10],maxSize[10]">
                </div>
              </div>
               <div class="col-lg-6">
                <div class="form-group">
                  <label>Address Type:</label>
                  <input type="radio" id="add_home" name="address_type"  value="home" checked>
                  <label for="add_home">Home</label>

                  <input type="radio" id="add_work" name="address_type" value="work">
                  <label for="add_work">Work</label>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group">
                  <label for="comment">Address:</label>
                  <textarea class="form-control" rows="5" id="address_details" name="address_details"></textarea>
                </div>
              </div>
            </div>
            <div class="text-right">
            <input type="submit" class="btn btn-primary disabled_banner" value="Save">
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>


<div class="modal animated bounceInRight" id="update_address" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Address Edit</h4>
        </div>
        <div class="modal-body">
          <div id="address_show">
          </div>
        </div>
      </div>
    </div>
  </div>
