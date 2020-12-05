   <!-- -----------Cart section start----------- -->
    <section id="shopping-cart">
      <div id="regForm" class="shopping-cart">
        <div class="container">
          <div class="row">
            <div class="delivery-grap">
              <div class="grap-step step">
                <div class="grap-step-underpart">
                  <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                </div>
                <!-- <p class="grap-tittle">Shopping Bag</p> -->
              </div>
              <div class="grap-step step">
                <div class="grap-step-underpart">
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
              <div class="product-items deliverystep">
                <div class="product-header">
                  <div class="count-bag-item">My Shopping Bag (<?php if(!empty($cart_details))
                          {
                            echo count($cart_details);
                          }
                          else
                          { 
                            echo "0";
                          }
                          ?> Items)</div>
                  <div class="base-value">
                    Total:
                    <svg width="8" height="10" viewBox="0 0 8 10" class="priceDetail-base-icon">
                      <path fill-rule="nonzero" d="M1.951 5.845l3.91 3.602-.902.376L.7 5.845l.452-.711c.186-.005.392-.02.615-.048a5.2 5.2 0 0 0 1.347-.356c.218-.09.42-.201.604-.331.185-.13.345-.281.479-.455.134-.173.231-.371.29-.594H.865v-.841h3.644a1.759 1.759 0 0 0-.284-.667 1.826 1.826 0 0 0-.567-.512 2.964 2.964 0 0 0-.865-.332A5.22 5.22 0 0 0 1.63.882H.864V0h6.2v.882H4.18c.173.077.33.174.468.29a2.09 2.09 0 0 1 .612.848c.064.162.11.325.137.489h1.668v.84H5.383a2.38 2.38 0 0 1-.43 1.03 3.095 3.095 0 0 1-.8.748 4.076 4.076 0 0 1-1.043.482 6.15 6.15 0 0 1-1.159.236z"></path>
                    </svg>
                    <?php 
                        $total=0; 
                        foreach($cart_details as $cart_row)
                        {
                          $total=$total+($cart_row->sell_price*$cart_row->quantity);
                        }
                      ?>
                    <span id="totalamount_view"><?= $total;?></span>
                    <input type="hidden" id="totalamount" value="<?=$total;?>">
                  </div>
                </div>
                <?php foreach($cart_details as $cart_row){?>
                <div class="product-single-item">
                  <i class="fa fa-times" aria-hidden="true" onclick="removeItem('<?=$cart_row->uniqcode?>')"></i>
                  <div class="container-fluid">
                    <div class="row">
                      <input type="hidden" id="uniqcode<?=$cart_row->uniqcode?>" value="<?=$cart_row->uniqcode?>">
                      <div class="col-md-2 col-xs-12 col-sm-12">
                        <div  class="product-img">
                          <a class="dress-card-img" target="_blank" href="<?=base_url('product/'.$cart_row->slug.'?proid='.$cart_row->product_id.'&feid='.$cart_row->product_features_id.'&cid='.$cart_row->color.'&type='.$cart_row->product_type)?>">
                          <?php 
                          $product_img=unserialize($cart_row->image);
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
                        </div>
                      </div>
                      <div class="col-md-10 col-xs-12 col-sm-12">
                        <div class="product-details">
                          <div class="row">
                            <div class="col-md-8 col-xs-12 col-sm-12">
                              <p class="product-title"><?php
                                    $name = strlen($cart_row->product_name) > 80 ? substr($cart_row->product_name,0,80)."..." : $cart_row->product_name;
                                    echo $name ;
                                    ?></p>
                              <p class="sold-by"><a href="<?=base_url('shop/'.$cart_row->admin_id)?>">Sold By:<?=$cart_row->admin_name?></a></p>
                              <?php if(!empty($cart_row->color)){
                                $color=$this->Cart_Model->get_color($cart_row->color);

                                ?>
                              <p class="product-color">Color: <?=$color?></p>
                              <?php }?>

                              <?php if(!empty($cart_row->size)){
                                $size=$this->Cart_Model->get_size($cart_row->size);

                                ?>
                                  <p class="product-size"> Size: <?= $size;?></p>
                              <?php }?>

                              <div class="number-of-products" id="buyBlock">
                                <span id="priceATC" class="quantity-up-down">
                                  <label>Qty</label>
                                  <span class="icon-minus-squared <?= $cart_row->quantity == 1 ? 'off' : '';?>"onclick="quentityDecrement('<?=$cart_row->uniqcode?>')">&ndash;</span>
                                  <input name="Quantity" type="number" value="<?=$cart_row->quantity?>" id="quen<?=$cart_row->uniqcode?>" class="qty-field" min="1" max="12">
                                  <span class="icon-plus-squared" onclick="quentityUpdate('<?=$cart_row->uniqcode?>')">+</span>
                                </span>
                              </div>
                            </div>
                            <div class="col-md-4 col-xs-12 col-sm-12 product-details-right">
                              <p class="base-value product-title">
                                <svg width="8" height="10" viewBox="0 0 8 10" class="priceDetail-base-icon">
                                  <path fill-rule="nonzero" d="M1.951 5.845l3.91 3.602-.902.376L.7 5.845l.452-.711c.186-.005.392-.02.615-.048a5.2 5.2 0 0 0 1.347-.356c.218-.09.42-.201.604-.331.185-.13.345-.281.479-.455.134-.173.231-.371.29-.594H.865v-.841h3.644a1.759 1.759 0 0 0-.284-.667 1.826 1.826 0 0 0-.567-.512 2.964 2.964 0 0 0-.865-.332A5.22 5.22 0 0 0 1.63.882H.864V0h6.2v.882H4.18c.173.077.33.174.468.29a2.09 2.09 0 0 1 .612.848c.064.162.11.325.137.489h1.668v.84H5.383a2.38 2.38 0 0 1-.43 1.03 3.095 3.095 0 0 1-.8.748 4.076 4.076 0 0 1-1.043.482 6.15 6.15 0 0 1-1.159.236z"></path>
                                </svg>
                                <span><?=intval($cart_row->sell_price)?></span>
                                <input type="hidden" id="sell_price<?=$cart_row->uniqcode?>" value="<?=$cart_row->sell_price?>">
                              </p>
                              <p class="base-value">
                                <svg width="8" height="10" viewBox="0 0 8 10" class="priceDetail-base-icon">
                                  <path fill-rule="nonzero" d="M1.951 5.845l3.91 3.602-.902.376L.7 5.845l.452-.711c.186-.005.392-.02.615-.048a5.2 5.2 0 0 0 1.347-.356c.218-.09.42-.201.604-.331.185-.13.345-.281.479-.455.134-.173.231-.371.29-.594H.865v-.841h3.644a1.759 1.759 0 0 0-.284-.667 1.826 1.826 0 0 0-.567-.512 2.964 2.964 0 0 0-.865-.332A5.22 5.22 0 0 0 1.63.882H.864V0h6.2v.882H4.18c.173.077.33.174.468.29a2.09 2.09 0 0 1 .612.848c.064.162.11.325.137.489h1.668v.84H5.383a2.38 2.38 0 0 1-.43 1.03 3.095 3.095 0 0 1-.8.748 4.076 4.076 0 0 1-1.043.482 6.15 6.15 0 0 1-1.159.236z"></path>
                                </svg>  
                                <span class="dress-card-crossed"><?=intval($cart_row->mrp_price)?></span>
                                <span class="dress-card-off">&ensp;(<?=intval($cart_row->discount)?>% OFF)</span>
                              </p>
                              <p>Delivery By: Wed Sep 2</p>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php }?>
              </div>
              <div class="delivery-part deliverystep">
                <div class="delivery-part-header">
                  <div class="delivery-part-header-tittle">Select Delivery Address</div>
                  <div class="add-address">
                    <button type="button" class="btn card-button-inner address-btn">
                      <span>Add New Address</span>
                    </button>
                  </div>
                </div>
                <p class="address-type">Default Address</p>
                <div class="product-single-item">
                  <div class="radio-btn">
                    <input id="radio-1" name="radio-group" type="radio" checked>
                    <!-- <input type="radio" id="female" name="female" checked> -->
                    <label for="male"></label>
                  </div>
                  <div class="container-fluid">
                    <div class="product-single-item-innerpart">
                      <div class="delivery-own-name">
                        <span>Subhajit Manna</span>
                        <span class="delivery-address-type">Office</span>
                      </div>
                      <p class="main-address">
                        15/1, Russa Rd 3rd Ln, Netajinagar, Rajendra Prasad Colony, Tollygunge, Kolkata, West Bengal 700033
                      </p>
                      <p class="mobile-no">
                        Mobile
                        <span>9093256070</span>
                      </p>
                      <p class="pay-on-delivery">
                        <i class="fa fa-certificate" aria-hidden="true"></i>
                        Pay on delivery available
                      </p>
                      <div class="button-part">
                        <button type="button" class="btn card-button-inner remove-btn">
                          <span>Remove</span>
                        </button>
                        <button type="button" class="btn card-button-inner edit-btn">
                          <span>Edit</span>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <p class="address-type">Other Address</p>
                <div class="product-single-item">
                  <div class="radio-btn">
                    <input id="radio-2" name="radio-group" type="radio">
                    <label for="female"></label>
                  </div>
                  <div class="container-fluid">
                    <div class="product-single-item-innerpart">
                      <div class="delivery-own-name">
                        <span>Subhajit Manna</span>
                        <span class="delivery-address-type">Home</span>
                      </div>
                      <p class="main-address">
                        15/1, Russa Rd 3rd Ln, Netajinagar, Rajendra Prasad Colony, Tollygunge, Kolkata, West Bengal 700033
                      </p>
                      <p class="mobile-no">
                        Mobile
                        <span>9093256070</span>
                      </p>
                      <!-- <div class="button-part">
                        <button type="button" class="btn card-button-inner remove-btn">
                          <span>Remove</span>
                        </button>
                        <button type="button" class="btn card-button-inner edit-btn">
                          <span>Edit</span>
                        </button>
                      </div> -->
                    </div>
                  </div>
                </div>
              </div>
              <div class="deliverystep payment-part">
                <div class="delivery-part-header">
                  <div class="delivery-part-header-tittle">Choose Payment Mode</div>
                  <!-- <div class="add-address">
                    <button type="button" class="btn card-button-inner address-btn">
                      <span>Add New Address</span>
                    </button>
                  </div> -->
                </div>
                <div class="payment-category">
                  <div class="container-fluid">
                    <div class="payment-category-innerpart">
                      <div class="col-md-4 col-xs-12 col-sm-12">
                        <ul class="nav">
                          <li class="active"><a data-toggle="tab" href="#pay-on-delivery">PAY ON DELIVERY</a></li>
                          <li><a data-toggle="tab" href="#card-payment">CREDIT/DEBIT CARD</a></li>
                          <li><a data-toggle="tab" href="#upi-payment">PHONEPE/GOOGLE PAY/BHIM UPI</a></li>
                        </ul>
                      </div>
                      <div class="col-md-8 col-xs-12 col-sm-12">
                        <div class="tab-content">
                          <div id="pay-on-delivery" class="tab-pane fade in active">
                            <p class="payment-heading">PAY ON DELIVERY</p>
                            <p>Pay when your order is deliverd</p>
                            <button type="button" class="btn card-button-inner bag-button buy-btn btn-block">
                              <span>Pay On Delivery</span>
                            </button>
                          </div>
                          <div id="card-payment" class="tab-pane fade">
                            <p class="payment-heading">CREDIT/DEBIT CARD</p>
                            <form name="cardForm" id="cardForm" action="">
                              <div class="container-fluid">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label>Card Number<sup>*</sup></label>
                                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label>Name On Card<sup>*</sup></label>
                                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Expiry Month<sup>*</sup></label>
                                    <select name="month" id="month">
                                      <optgroup label="Expiry Month">
                                        <option value="january">January</option>
                                        <option value="february">February</option>
                                      </optgroup>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Expiry Year<sup>*</sup></label>
                                    <select name="year" id="year">
                                      <optgroup label="Expiry Year">
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                      </optgroup>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label>CVV<sup>*</sup></label>
                                    <input type="number" class="form-control" id="cvv" name="cvv">
                                  </div>
                                </div>
                                <div class="col-md-8">
                                  <p class="cvv">Last 3 digits printed on the back of the card</p>
                                </div>
                                <div class="col-md-12">
                                  <div class="checkbox">
                                    <label><input type="checkbox" name="remember">Save this card for faster payment</label>
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <button type="button" class="btn card-button-inner bag-button buy-btn btn-block" onclick="nextPrev(1)">
                                    <span>Pay Now</span>
                                  </button>
                                </div>
                              </div>
                            </form>
                          </div>
                          <div id="upi-payment" class="tab-pane fade">
                            <p class="payment-heading">PHONEPE/GOOGLE PAY/BHIM UPI</p>
                            <div class="upi-types">
                              <div class="each-type">
                                <div class="radio-btn">
                                  <input id="radio-1" name="radio" type="radio" checked>
                                </div>
                                <div class="upi-img">
                                  <img src="./images/phone-pe.png">
                                </div>
                                <span>PhonePe</span>
                              </div>
                              <div class="each-type">
                                <div class="radio-btn">
                                  <input id="radio-2" name="radio" type="radio">
                                </div>
                                <div class="upi-img">
                                  <img src="./images/google-pay.png">
                                </div>
                                <span>Google Pay</span>
                              </div>
                              <div class="each-type">
                                <div class="radio-btn">
                                  <input id="radio-3" name="radio" type="radio">
                                </div>
                                <div class="upi-img">
                                  <img src="./images/paytm.webp">
                                </div>
                                <span>Paytm</span>
                              </div>
                              <div class="each-type">
                                <div class="radio-btn">
                                  <input id="radio-4" name="radio" type="radio">
                                </div>
                                <div class="upi-img">
                                  <img src="./images/upi.png">
                                </div>
                                <span>Other UPI</span>
                              </div>
                            </div>
                            <button type="button" class="btn card-button-inner bag-button buy-btn btn-block" onclick="nextPrev(1)">
                              <span>Pay Now</span>
                            </button>
                          </div>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
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
                    <span id="neet_amount"><?=$total;?></span>
                  </span>
                </div>
                <div class="card-button">
                  <button id="nextBtn" type="button" class="btn card-button-inner bag-button buy-btn btn-block place-order" onclick="nextPrev(1)">
                    <span >Place Order</span>
                  </button>
                  <button type="button" class="btn card-button-inner address-btn  btn-block" id="prevBtn" onclick="nextPrev(-1)">
                    <span>Go to previous</span>
                  </button>
                  <!-- <button type="button"  id="prevBtn" onclick="nextPrev(-1)" >Next</button> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Cart section end -->



    <script type="text/javascript">
      var currentTab = 0; // Current tab is set to be the first tab (0)
      showTab(currentTab); // Display the current tab

      function showTab(n) {
        // window.alert(n);
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("deliverystep");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
          document.getElementById("prevBtn").style.display = "none";
        } else {
          document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
          // document.getElementById("nextBtn").innerHTML = "Pay Now";
          document.getElementById("nextBtn").style.display = "none";
        } else {
          // document.getElementById("nextBtn").innerHTML = "Place Order";
        }
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n)
      }

      function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("deliverystep");
        // Exit the function if any field in the current tab is invalid:
        // if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form...
        if (currentTab >= x.length) {
          // ... the form gets submitted:
          document.getElementById("regForm").submit();
          return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
      }

      function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
          x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += " active";
      }
    </script>