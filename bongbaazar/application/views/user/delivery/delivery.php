    <!-- --------Delivery details section start-------- -->
    <?php
   //pr($user_order_item);
      $user_order_details1=unserialize($user_order_details->address);
    ?>

      <section id="delivery-details">
        <div class="delivery-details">
          <div class="delivery-detailse-innerpart">
            <div class="container">
              <div class="row">
                <div class="col-md-4">

                  <p><span>Ship To:</span><?=$user_order_details1->name?></p>
                  <p class="delivery-person-ph"><span>Phone Number: </span><?=$user_order_details1->mobile_no?></p>
                  <p class="delivery-person-ph"><span>Alternate Number: </span><?=$user_order_details1->alternative_mob_no?></p>
                  <p class="delivery-person-address"><span>Shipping Address: </span>
                  <?=$user_order_details1->address_details?> <?=$user_order_details1->city_dist_town?> -<?=$user_order_details1->pin_code?>
                  </p>
                </div>
                <div class="col-md-5">
                  <ul class="tracking-upparpart">
                    <li><p><span>Order No: </span><?=$user_order_details->order_code?></p></li>
                    <li><p><span>Order Date: </span><?php echo date("D M d", strtotime($user_order_details->order_date));  ?></p></li>
                    <li><p><span>Order From: </span>
                    <?php
                      $user_name=explode("##",$this->session->userdata('loginDetail')->name);
                      echo $user_name[0].' '.$user_name[1];
                    ?></p></li>
                    <li><p><span>Expected Date: </span><?php echo date("D M d", strtotime($user_order_details->delivery_date));  ?></p></li>
                  </ul>
                  
                </div>
                <div class="col-md-3">
                  <div class="order-money">
                    <p class="order-heading">Price Details</p>
                    <div class="price-part">
                      <div class="priceDetail-base-row">
                        <span class="price-title">Bag Total</span>
                        <span class="base-value">
                          <svg width="8" height="10" viewBox="0 0 8 10" class="priceDetail-base-icon">
                            <path fill-rule="nonzero" d="M1.951 5.845l3.91 3.602-.902.376L.7 5.845l.452-.711c.186-.005.392-.02.615-.048a5.2 5.2 0 0 0 1.347-.356c.218-.09.42-.201.604-.331.185-.13.345-.281.479-.455.134-.173.231-.371.29-.594H.865v-.841h3.644a1.759 1.759 0 0 0-.284-.667 1.826 1.826 0 0 0-.567-.512 2.964 2.964 0 0 0-.865-.332A5.22 5.22 0 0 0 1.63.882H.864V0h6.2v.882H4.18c.173.077.33.174.468.29a2.09 2.09 0 0 1 .612.848c.064.162.11.325.137.489h1.668v.84H5.383a2.38 2.38 0 0 1-.43 1.03 3.095 3.095 0 0 1-.8.748 4.076 4.076 0 0 1-1.043.482 6.15 6.15 0 0 1-1.159.236z"></path>
                          </svg>
                          <span><?=$user_order_details->sell_price?></span>
                        </span>
                      </div>
                      
                      
                      <div class="priceDetail-base-row">
                        <span class="price-title">Delivery Charge</span>
                        <span class="base-value">
                          <svg width="8" height="10" viewBox="0 0 8 10" class="priceDetail-base-icon">
                            <path fill-rule="nonzero" d="M1.951 5.845l3.91 3.602-.902.376L.7 5.845l.452-.711c.186-.005.392-.02.615-.048a5.2 5.2 0 0 0 1.347-.356c.218-.09.42-.201.604-.331.185-.13.345-.281.479-.455.134-.173.231-.371.29-.594H.865v-.841h3.644a1.759 1.759 0 0 0-.284-.667 1.826 1.826 0 0 0-.567-.512 2.964 2.964 0 0 0-.865-.332A5.22 5.22 0 0 0 1.63.882H.864V0h6.2v.882H4.18c.173.077.33.174.468.29a2.09 2.09 0 0 1 .612.848c.064.162.11.325.137.489h1.668v.84H5.383a2.38 2.38 0 0 1-.43 1.03 3.095 3.095 0 0 1-.8.748 4.076 4.076 0 0 1-1.043.482 6.15 6.15 0 0 1-1.159.236z"></path>
                          </svg>
                          <span><?=Intval($user_order_details->shipping_price)?></span>
                        </span>
                      </div>
                      <div class="priceDetail-base-row">
                        <span class="price-title">Bag Discount</span>
                        <span class="base-value price-discount">
                          <span>-</span>
                          <svg width="8" height="10" viewBox="0 0 8 10" class="priceDetail-base-icon">
                            <path fill-rule="nonzero" d="M1.951 5.845l3.91 3.602-.902.376L.7 5.845l.452-.711c.186-.005.392-.02.615-.048a5.2 5.2 0 0 0 1.347-.356c.218-.09.42-.201.604-.331.185-.13.345-.281.479-.455.134-.173.231-.371.29-.594H.865v-.841h3.644a1.759 1.759 0 0 0-.284-.667 1.826 1.826 0 0 0-.567-.512 2.964 2.964 0 0 0-.865-.332A5.22 5.22 0 0 0 1.63.882H.864V0h6.2v.882H4.18c.173.077.33.174.468.29a2.09 2.09 0 0 1 .612.848c.064.162.11.325.137.489h1.668v.84H5.383a2.38 2.38 0 0 1-.43 1.03 3.095 3.095 0 0 1-.8.748 4.076 4.076 0 0 1-1.043.482 6.15 6.15 0 0 1-1.159.236z"></path>
                          </svg>
                          <span><?=Intval($user_order_details->mrp_price-$user_order_details->sell_price)?></span>
                        </span>
                      </div>
                    </div>
                    
                    <div class="priceDetail-base-row order-total">
                      <span class="price-title">Total</span>
                      <span class="base-value">
                        <svg width="8" height="10" viewBox="0 0 8 10" class="priceDetail-base-icon">
                          <path fill-rule="nonzero" d="M1.951 5.845l3.91 3.602-.902.376L.7 5.845l.452-.711c.186-.005.392-.02.615-.048a5.2 5.2 0 0 0 1.347-.356c.218-.09.42-.201.604-.331.185-.13.345-.281.479-.455.134-.173.231-.371.29-.594H.865v-.841h3.644a1.759 1.759 0 0 0-.284-.667 1.826 1.826 0 0 0-.567-.512 2.964 2.964 0 0 0-.865-.332A5.22 5.22 0 0 0 1.63.882H.864V0h6.2v.882H4.18c.173.077.33.174.468.29a2.09 2.09 0 0 1 .612.848c.064.162.11.325.137.489h1.668v.84H5.383a2.38 2.38 0 0 1-.43 1.03 3.095 3.095 0 0 1-.8.748 4.076 4.076 0 0 1-1.043.482 6.15 6.15 0 0 1-1.159.236z"></path>
                        </svg>
                        <span><?=Intval($user_order_details->sell_price+$user_order_details->shipping_price)?></span>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="delivery-items">
            <div class="container">
            <?php
                  foreach($user_order_item as $key => $user_order_item_row)
                  {
            ?>
              <div class="product-single-item">
                <!-- <i class="fa fa-times" aria-hidden="true"></i> -->
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-md-2">
                      <div  class="product-img">
                      <a class="" target="_blank" href="<?=base_url('product/'.$user_order_item_row->slug.'?proid='.$user_order_item_row->product_id.'&feid='.$user_order_item_row->product_features_id.'&cid='.$user_order_item_row->color.'&type='.$user_order_item_row->product_type)?>">
                          <?php 
                          $product_img=unserialize($user_order_item_row->image);
                          if(!empty($product_img))
                          {?>
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
                          <div class="col-md-3">
                            <p class="product-title"><?=$user_order_item_row->product_name?></p>
                            <a class=""  href="<?=base_url('shop/'.$user_order_item_row->admin_id)?>"> 
                            <p class="sold-by">Sold By: <?=$user_order_item_row->admin_name?></p>
                            </a>
                            <p class="product-color">Color:<?=$user_order_item_row->color_name?></p>
                            <p class="product-size"> Size: <?=$user_order_item_row->size_name?></p>
                            
                          </div>
                          <div class="col-md-5">
                          <?php
                                  if($status!='Cancel')
                                  {
                              ?>
                            <div class="delivery-status">
                              <div class="delivery-tracking 
                                <?php
                                      $status=$user_order_item_row->order_status;
                                      if($status=='Pending'||$status=='Packed'||$status=='Shipped'||$status=='Delivered'||$status=='Cancel') 
                                      {
                                        echo 'completed';
                                      }                               
                                ?>
                              ">
                                <p>Ordered</p>
                                <div class="order-tracking">
                                  <span class="is-complete"></span>
                                  <span>Mon, June 24</span>
                                </div>
                              </div>
                              
                              <div class="delivery-tracking 
                                  <?php
                                    if($status=='Packed'||$status=='Shipped'||$status=='Delivered')
                                    {
                                      echo 'completed';
                                    }
                                  ?>
                              ">
                                <p>Packed</p>
                                <div class="order-tracking">
                                  <span class="is-complete"></span>
                                  <span>Tue, June 25</span>
                                </div>
                              </div>
                              <div class="delivery-tracking 
                                <?php
                                    if($status=='Shipped'||$status=='Delivered')
                                    {
                                      echo 'completed';
                                    }
                                  ?>
                              ">
                                <p>Shipped</p>
                                <div class="order-tracking">
                                  <span class="is-complete"></span>
                                  <span>Tue, June 25</span>
                                </div>
                              </div>
                              <div class="delivery-tracking 
                                  <?php
                                    if($status=='Delivered')
                                    {
                                      echo 'completed';
                                    }
                                  ?>
                                ">
                                <p>Delivered</p>
                                <div class="order-tracking">
                                  <span class="is-complete"></span>
                                  <span>Fri, June 28</span>
                                </div>
                              </div>
                            </div>
                            <?php
                                  }
                                  else
                                  {
                            ?>
                            <div class="delivery-status cancel">
                                <div class="delivery-tracking completed">
                                    <p>Ordered</p>
                                    <div class="order-tracking">
                                        <span class="is-complete"></span>
                                        <span>Mon, June 24</span>
                                    </div>
                                </div>
                                <span class="cancel-bar"></span>
                                <span class="cancel-bar"></span>
                                <div class="delivery-tracking canceled">
                                    <p>Cancel</p>
                                    <div class="order-tracking">
                                        <span class="is-complete"></span>
                                        <span>Fri, June 28</span>
                                    </div>
                                </div>
                            </div>

                            <?php
                                  }
                            ?>
                          </div>
                          <div class="col-md-4 product-details-right">
                            <p class="base-value product-title">
                              <svg width="8" height="10" viewBox="0 0 8 10" class="priceDetail-base-icon">
                                <path fill-rule="nonzero" d="M1.951 5.845l3.91 3.602-.902.376L.7 5.845l.452-.711c.186-.005.392-.02.615-.048a5.2 5.2 0 0 0 1.347-.356c.218-.09.42-.201.604-.331.185-.13.345-.281.479-.455.134-.173.231-.371.29-.594H.865v-.841h3.644a1.759 1.759 0 0 0-.284-.667 1.826 1.826 0 0 0-.567-.512 2.964 2.964 0 0 0-.865-.332A5.22 5.22 0 0 0 1.63.882H.864V0h6.2v.882H4.18c.173.077.33.174.468.29a2.09 2.09 0 0 1 .612.848c.064.162.11.325.137.489h1.668v.84H5.383a2.38 2.38 0 0 1-.43 1.03 3.095 3.095 0 0 1-.8.748 4.076 4.076 0 0 1-1.043.482 6.15 6.15 0 0 1-1.159.236z"></path>
                              </svg>
                              <span><?=$user_order_item_row->sell_price?></span>
                            </p>
                            <p class="base-value">
                              <svg width="8" height="10" viewBox="0 0 8 10" class="priceDetail-base-icon">
                                <path fill-rule="nonzero" d="M1.951 5.845l3.91 3.602-.902.376L.7 5.845l.452-.711c.186-.005.392-.02.615-.048a5.2 5.2 0 0 0 1.347-.356c.218-.09.42-.201.604-.331.185-.13.345-.281.479-.455.134-.173.231-.371.29-.594H.865v-.841h3.644a1.759 1.759 0 0 0-.284-.667 1.826 1.826 0 0 0-.567-.512 2.964 2.964 0 0 0-.865-.332A5.22 5.22 0 0 0 1.63.882H.864V0h6.2v.882H4.18c.173.077.33.174.468.29a2.09 2.09 0 0 1 .612.848c.064.162.11.325.137.489h1.668v.84H5.383a2.38 2.38 0 0 1-.43 1.03 3.095 3.095 0 0 1-.8.748 4.076 4.076 0 0 1-1.043.482 6.15 6.15 0 0 1-1.159.236z"></path>
                              </svg>  
                              <span class="dress-card-crossed"><?=$user_order_item_row->mrp_price?></span>
                              <span class="dress-card-off">&ensp;(<?=Intval($user_order_item_row->discount)?>% OFF)</span>
                            </p>
                            <p>Delivery By:<?php echo date("D M d", strtotime($user_order_item_row->delivery_date));  ?></p>
                           
                            <div class="button-part">
                               <button type="button" class="btn card-button-inner hvr-icon-pop rate-btn" data-toggle="modal" data-target="#rateReview">
                                Rate & Review
                                <i class="fa fa-star hvr-icon" aria-hidden="true"></i>
                              </button>
                              <?php
                                if($status=='Pending')
                                {
                              ?>
                              <button type="button" class="btn card-button-inner remove-btn" data-toggle="modal" data-target="#cancelItem">
                                  <span>Cancel Item</span>
                              </button>
                                <?php }
                                if($status=='Delivered')
                                {?>
                              <button type="button" class="btn card-button-inner btn-block hvr-icon-down download-btn">
                                Download Invoice
                                <i class="fa fa-download hvr-icon" aria-hidden="true"></i>
                              </button>
                              <?php } ?>
                            </div>
                          </div>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      
                    </div>
                    <div class="col-md-4">
                      
                    </div>
                    <div class="col-md-4">
                      
                    </div>
                  </div>
                </div>
              </div>
            <?php
                }
            ?>
            </div>
          </div>
        </div>
      </section>
    <!-- Delivery details section end -->