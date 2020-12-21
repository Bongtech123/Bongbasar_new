   <!-- -----------Cart section start----------- -->
    <section id="shopping-cart">
      <div id="regForm" class="shopping-cart">
        <div class="container">
          <div class="row">
            <div class="delivery-grap">
              <div class="grap-step step">
                <div class="grap-step-underpart" style="background: #0069e4;border-color: #0069e4;">
                  <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                </div>
                <!-- <p class="grap-tittle">Shopping Bag</p> -->
              </div>
              <div class="grap-step step" >
                <div class="grap-step-underpart" style="background: #0069e4;border-color: #0069e4;">
                  <i class="fa fa-map-marker" aria-hidden="true"></i>
                </div>
                <!-- <p class="grap-tittle">Address</p> -->
              </div>
              <div class="grap-step step">
                <div class="grap-step-underpart">
                  <i class="fa fa-cc-visa" aria-hidden="true"></i>
                </div>
                <!-- <p class="grap-tittle">Payment</p> -->
              </div>
            </div>
            <div class="col-md-8 col-xs-12 col-sm-12">
               <div class="delivery-part deliverystep">
                <div class="delivery-part-header">
                  <div class="delivery-part-header-tittle">Select Delivery Address</div>
                  <div class="add-address">
                    <button type="button" class="btn card-button-inner address-btn" data-toggle="modal" data-target="#oderaddressModal">
                      <span>Add New Address</span>
                    </button>
                  </div>
                </div>
              <?php if(!empty($allAddress)){?>             
                <p class="address-type">Your Address</p>
                <?php foreach($allAddress as $key => $address_row){ ?>
                  <div class="product-single-item">
                  <div class="radio-btn">
                    <input id="radio<?=$key?>" name="order_address" type="radio"value="<?=$address_row->uniqcode?>" <?php if($address_row->select_address==1){echo 'checked';}?>>
                    <label for="female"></label>
                  </div>
                  <div class="container-fluid">
                    <div class="product-single-item-innerpart">
                      <div class="delivery-own-name">
                        <span><?=$address_row->name?></span>
                        <span class="delivery-address-type"><?=$address_row->address_type?></span>
                      </div>
                      <p class="main-address">
                        <?=$address_row->address_details?>
                      </p>
                      <p class="mobile-no">
                        Mobile
                        <span><?=$address_row->mobile_no?></span>
                      </p>
                      <div class="button-part">
                      <a type="button" class="btn card-button-inner remove-btn" href="<?=base_url('buy-address-destroy-order/'.$address_row->uniqcode)?>" onclick="return confirm('Are you sure delete this address?')">
                              <span>Remove</span>
                            </a>
                        <button type="button" class="btn card-button-inner edit-btn" onclick="buyEditAddressOrder('<?=$address_row->uniqcode?>')">
                          <span>Edit</span>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

              <?php } }?>
              </div>

            </div>
            <?php 
              $total=0; 
              $delivery_price=0;
              foreach($cart_details as $cart_row)
              {
                $total=$total+($cart_row->sell_price*$cart_row->quantity);
              }
            ?> 
            <div class="col-md-4 col-xs-12 col-sm-12">
              <div class="order-money">
                <p class="order-heading">Price Details</p>
                <div class="price-part">
                  <div class="priceDetail-base-row">
                    <span class="price-title">Bag Total</span>
                    <span class="base-value">
                      <svg width="8" height="10" viewBox="0 0 8 10" class="priceDetail-base-icon">
                        <path fill-rule="nonzero" d="M1.951 5.845l3.91 3.602-.902.376L.7 5.845l.452-.711c.186-.005.392-.02.615-.048a5.2 5.2 0 0 0 1.347-.356c.218-.09.42-.201.604-.331.185-.13.345-.281.479-.455.134-.173.231-.371.29-.594H.865v-.841h3.644a1.759 1.759 0 0 0-.284-.667 1.826 1.826 0 0 0-.567-.512 2.964 2.964 0 0 0-.865-.332A5.22 5.22 0 0 0 1.63.882H.864V0h6.2v.882H4.18c.173.077.33.174.468.29a2.09 2.09 0 0 1 .612.848c.064.162.11.325.137.489h1.668v.84H5.383a2.38 2.38 0 0 1-.43 1.03 3.095 3.095 0 0 1-.8.748 4.076 4.076 0 0 1-1.043.482 6.15 6.15 0 0 1-1.159.236z"></path>
                      </svg>
                      <span id="bag_total"><?=$total?></span>
                    </span>
                  </div>
                </div>
                <div class="priceDetail-base-row order-total">
                  <span class="price-title">Total</span>
                  <span class="base-value">
                    <svg width="8" height="10" viewBox="0 0 8 10" class="priceDetail-base-icon">
                      <path fill-rule="nonzero" d="M1.951 5.845l3.91 3.602-.902.376L.7 5.845l.452-.711c.186-.005.392-.02.615-.048a5.2 5.2 0 0 0 1.347-.356c.218-.09.42-.201.604-.331.185-.13.345-.281.479-.455.134-.173.231-.371.29-.594H.865v-.841h3.644a1.759 1.759 0 0 0-.284-.667 1.826 1.826 0 0 0-.567-.512 2.964 2.964 0 0 0-.865-.332A5.22 5.22 0 0 0 1.63.882H.864V0h6.2v.882H4.18c.173.077.33.174.468.29a2.09 2.09 0 0 1 .612.848c.064.162.11.325.137.489h1.668v.84H5.383a2.38 2.38 0 0 1-.43 1.03 3.095 3.095 0 0 1-.8.748 4.076 4.076 0 0 1-1.043.482 6.15 6.15 0 0 1-1.159.236z"></path>
                    </svg>
                    <span id="neet_amount"><?= $total;?></span>
                  </span>
                </div>

                <div class="card-button">
                  <button id="nextBtn" type="button" class="btn card-button-inner bag-button buy-btn btn-block place-order" onclick="buyPlaceOrder1('<?=$this->session->userdata('loginDetail')->email?>')">
                    <span >Place Order</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Cart section end -->

    <!-- address modal start -->
<div class="modal animated bounceInRight" id="oderaddressModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Address Add</h4>
        </div>
        <div class="modal-body">
          <form role="form" id="address-add" action="<?=base_url('buy-address-add-order')?>" method="post" enctype="multipart/form-data">
          <!-- <input type="hidden" name="user_id" value="<?=$user_profile->uniqcode?>"> -->

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
                    <?php foreach($all_state as $all_state_row){?>
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


<div class="modal animated bounceInRight" id="update_order_address" role="dialog">
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


