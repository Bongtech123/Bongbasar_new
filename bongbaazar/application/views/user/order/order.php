   <!-- -----------Cart section start----------- -->
   <?php 
      $total=0; 
      $delivery_price=0;
      foreach($cart_details as $cart_row)
      {
        $total=$total+($cart_row->sell_price*$cart_row->quantity);
        $delivery_price=100;

      }
    ?> 
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
              <div class="grap-step step">
                <div class="grap-step-underpart" style="background: #0069e4;border-color: #0069e4;">
                  <i class="fa fa-map-marker" aria-hidden="true"></i>
                </div>
                <!-- <p class="grap-tittle">Address</p> -->
              </div>
              <div class="grap-step step">
                <div class="grap-step-underpart" style="background: #0069e4;border-color: #0069e4;">
                  <i class="fa fa-cc-visa" aria-hidden="true"></i>
                </div>
                <!-- <p class="grap-tittle">Payment</p> -->
              </div>
            </div>
            <div class="col-md-8 col-xs-12 col-sm-12">
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
                          <li><a data-toggle="tab" href="#pay-on-online" onclick="">PAY ON ONLINE</a></li>
                         <!--  <li><a data-toggle="tab" href="#card-payment">CREDIT/DEBIT CARD</a></li>
                          <li><a data-toggle="tab" href="#upi-payment">PHONEPE/GOOGLE PAY/BHIM UPI</a></li> -->
                        </ul>
                      </div>
                      <div class="col-md-8 col-xs-12 col-sm-12">
                        <div class="tab-content">
                          <div id="pay-on-delivery" class="tab-pane fade in active">
                            <p class="payment-heading">PAY ON DELIVERY</p>
                            <p>Pay when your order is deliverd</p>
                            <p>Enter the text as shown in the image *</p>
                            <div class="captcha-box">
                              <input type="text" name="capcha" id="capcha">
                              <input type="hidden" name="hidencapcha" id="hidencapcha" value="<?=$capcha_value?>">
                              <div class="captcha-number">
                                <h1 id="showCapcha"><?=$capcha_value;?></h1>
                                <button onclick="createCapcha()"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                              </div>
                            </div>
                            <button type="button" class="btn card-button-inner bag-button buy-btn btn-block" onclick="payOnDelivery('<?=$address_id;?>')">
                            <span>Pay On Delivery</span>
                            </button>
                          </div>
                          <div id="pay-on-online" class="tab-pane fade">
                            <p class="payment-heading">PAY ON ONLINE</p>
                            <p>Pay your order is online</p>
                            <a href="javascript:void(0)" class="btn card-button-inner bag-button buy-btn btn-block buy_now" data-amount="<?=$total+$delivery_price?>" data-address="<?=$address_id;?>">
                            <span>Pay On Online</span>
                            </a>
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
                  <!-- <div class="priceDetail-base-row">
                    <span class="price-title">Bag Discount</span>
                    <span class="base-value price-discount">
                      <span>-</span>
                      <svg width="8" height="10" viewBox="0 0 8 10" class="priceDetail-base-icon">
                        <path fill-rule="nonzero" d="M1.951 5.845l3.91 3.602-.902.376L.7 5.845l.452-.711c.186-.005.392-.02.615-.048a5.2 5.2 0 0 0 1.347-.356c.218-.09.42-.201.604-.331.185-.13.345-.281.479-.455.134-.173.231-.371.29-.594H.865v-.841h3.644a1.759 1.759 0 0 0-.284-.667 1.826 1.826 0 0 0-.567-.512 2.964 2.964 0 0 0-.865-.332A5.22 5.22 0 0 0 1.63.882H.864V0h6.2v.882H4.18c.173.077.33.174.468.29a2.09 2.09 0 0 1 .612.848c.064.162.11.325.137.489h1.668v.84H5.383a2.38 2.38 0 0 1-.43 1.03 3.095 3.095 0 0 1-.8.748 4.076 4.076 0 0 1-1.043.482 6.15 6.15 0 0 1-1.159.236z"></path>
                      </svg>
                      <span>0</span>
                    </span>
                  </div>
                  <div class="priceDetail-base-row">
                    <span class="price-title">Order Total</span>
                    <span class="base-value">
                      <svg width="8" height="10" viewBox="0 0 8 10" class="priceDetail-base-icon">
                        <path fill-rule="nonzero" d="M1.951 5.845l3.91 3.602-.902.376L.7 5.845l.452-.711c.186-.005.392-.02.615-.048a5.2 5.2 0 0 0 1.347-.356c.218-.09.42-.201.604-.331.185-.13.345-.281.479-.455.134-.173.231-.371.29-.594H.865v-.841h3.644a1.759 1.759 0 0 0-.284-.667 1.826 1.826 0 0 0-.567-.512 2.964 2.964 0 0 0-.865-.332A5.22 5.22 0 0 0 1.63.882H.864V0h6.2v.882H4.18c.173.077.33.174.468.29a2.09 2.09 0 0 1 .612.848c.064.162.11.325.137.489h1.668v.84H5.383a2.38 2.38 0 0 1-.43 1.03 3.095 3.095 0 0 1-.8.748 4.076 4.076 0 0 1-1.043.482 6.15 6.15 0 0 1-1.159.236z"></path>
                      </svg>
                      <span>0</span>
                    </span>
                  </div> -->
                  <div class="priceDetail-base-row">
                    <span class="price-title">Delivery Charge</span>
                    <span class="base-value">
                      <svg width="8" height="10" viewBox="0 0 8 10" class="priceDetail-base-icon">
                        <path fill-rule="nonzero" d="M1.951 5.845l3.91 3.602-.902.376L.7 5.845l.452-.711c.186-.005.392-.02.615-.048a5.2 5.2 0 0 0 1.347-.356c.218-.09.42-.201.604-.331.185-.13.345-.281.479-.455.134-.173.231-.371.29-.594H.865v-.841h3.644a1.759 1.759 0 0 0-.284-.667 1.826 1.826 0 0 0-.567-.512 2.964 2.964 0 0 0-.865-.332A5.22 5.22 0 0 0 1.63.882H.864V0h6.2v.882H4.18c.173.077.33.174.468.29a2.09 2.09 0 0 1 .612.848c.064.162.11.325.137.489h1.668v.84H5.383a2.38 2.38 0 0 1-.43 1.03 3.095 3.095 0 0 1-.8.748 4.076 4.076 0 0 1-1.043.482 6.15 6.15 0 0 1-1.159.236z"></path>
                      </svg>
                      <span id="bag_delivery_price"><?=$delivery_price?></span>
                    </span>
                  </div>
                </div>
                <div class="priceDetail-base-row order-total">
                  <span class="price-title">Total</span>
                  <span class="base-value">
                    <svg width="8" height="10" viewBox="0 0 8 10" class="priceDetail-base-icon">
                      <path fill-rule="nonzero" d="M1.951 5.845l3.91 3.602-.902.376L.7 5.845l.452-.711c.186-.005.392-.02.615-.048a5.2 5.2 0 0 0 1.347-.356c.218-.09.42-.201.604-.331.185-.13.345-.281.479-.455.134-.173.231-.371.29-.594H.865v-.841h3.644a1.759 1.759 0 0 0-.284-.667 1.826 1.826 0 0 0-.567-.512 2.964 2.964 0 0 0-.865-.332A5.22 5.22 0 0 0 1.63.882H.864V0h6.2v.882H4.18c.173.077.33.174.468.29a2.09 2.09 0 0 1 .612.848c.064.162.11.325.137.489h1.668v.84H5.383a2.38 2.38 0 0 1-.43 1.03 3.095 3.095 0 0 1-.8.748 4.076 4.076 0 0 1-1.043.482 6.15 6.15 0 0 1-1.159.236z"></path>
                    </svg>
                    <span id="neet_amount"><?= $total+$delivery_price;?></span>
                  </span>
                </div>
                <div class="card-button">
                  <button type="button" class="btn card-button-inner address-btn  btn-block" id="prevBtn" onclick="backPage()" style="">
                    <span>Go to previous</span>
                  </button>
                  <!-- <button type="button"  id="prevBtn" onclick="nextPrev(-1)" >Next</button> -->
                </div>
                <!-- <div class="card-button">
                  <button id="nextBtn" type="button" class="btn card-button-inner bag-button buy-btn btn-block place-order" onclick="placeOrder1()">
                    <span >Place Order</span>
                  </button>
                </div> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Cart section end -->

<!-- payment getway start -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  var SITEURL = "<?php echo base_url() ?>";
  $('body').on('click', '.buy_now', function(e){
    var totalAmount = ($(this).attr("data-amount"));
    //var product_id =  $(this).attr("data-id");
    var address_id =  $(this).attr("data-address");
    var options = {
    "key": "rzp_test_5h1DS1nLF6IOpZ",
    "amount": (Number(totalAmount)*100), // 2000 paise = INR 20
    "name": "Bongbasar",
    "description": "Payment",
    "image": "<?php echo base_url('webroot/user/images/logo2.png')?>",
    "handler": function (response){
          console.log(response);
          $.ajax({
            url: SITEURL + 'pay-on-online',
            type: 'post',
            dataType: 'json',
            data: {
                razorpay_payment_id: response.razorpay_payment_id , totalAmount : totalAmount ,address_id : address_id
            }, 
            success: function (data) 
            {
              console.log(data);
              window.location.href = SITEURL + 'order-success';
            }
        });
     
    },

    "theme": {
        "color": "#528FF0"
    }
  };
  var rzp1 = new Razorpay(options);
  rzp1.open();
  e.preventDefault();
  });

</script>
<!-- payment getway -->