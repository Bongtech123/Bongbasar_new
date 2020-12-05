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
<!-- -------Product-view section start------- -->
      <section id="product-view">
        <div class="product-view">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6">
                <div class="product-image-gallery">
                  <div class="slider slider-for">
                    <?php $product_img=unserialize($product_view_price_image->image); 
                    for($i=0; $i<count($product_img); $i++){ ?>
                      <div class="big-slider-item example" >
                        <a href="">
                          <img src="<?=base_url('webroot/admin/product/web/').$product_img[0];?>" alt="Image To Zoom" class="block__pic">
                        </a>
                      </div>
                    <?php  }?> 
                  </div>
                  <div class="slider slider-nav">
                    <?php  for($i=0; $i<count($product_img); $i++){ ?>
                      <div class="small-slider-item">
                        <img src="<?=base_url('webroot/admin/product/web/').$product_img[0];?>">
                      </div>
                    <?php }?>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="description-wrappar">
                  <h2 class="product-tittle"><?=$product_view->product_name;?></h2>
                  <p class="seller-name">By: <a href="<?=base_url('shop/').$product_view->admin_id;?>"><?=$product_view->shop_name;?></a></p>
                  <p class="seller-name">Business type: <?=$product_view->business_type;?></p>
                  <input type="hidden" name="business_type" id="business_type" value="<?=$product_view->business_type;?>">
                  <p class="seller-name">Brand name: <?=$product_view->brand_name;?></p>
                  <p class="product-rate-chart">
                    <span class="dress-card-price">Rs. <?= intval($product_view_price_image->sell_price)?> &ensp;</span>
                    <span class="dress-card-crossed">Rs. <?=intval($product_view_price_image->mrp_price)?></span>
                    <span class="dress-card-off">&ensp;(<?=intval($product_view_price_image->discount)?> % OFF)</span>
                  </p>
                  <p class="tax-price">Inclusive of all taxes</p>
                  <div class="select-size-part select-color">
                    <ul class="nav nav-tabs">
                      <?php foreach($product_view_color as $key => $product_view_color_row){
                        $color_img=unserialize($product_view_color_row->image);
                        if(
                          $product_view_color_row->product_id==$product_view_price_image->product_id && 
                          $product_view_color_row->uniqcode==$product_view_price_image->uniqcode&&
                          $product_view_color_row->color==$product_view_price_image->color||$product_view_color_row->product_id==$product_view_price_image->product_id && $product_view_color_row->color==$product_view_price_image->color){
                        ?>
                        <li class="active">
                          <a href="<?=base_url('product/'.$product_view->slug.'?proid='.$product_view_color_row->product_id.'&feid='.$product_view_color_row->uniqcode.'&cid='.$product_view_color_row->color.'&type='.$product_view->product_type)?>">
                            <img class="dress-card-img-top" src="<?=base_url('webroot/admin/product/web/').$color_img[0]?>" alt="" >
                          </a>
                        </li>
                        <input type="hidden" name="product_id" id="product_id" value="<?=$product_view_color_row->product_id?>">
                        <input type="hidden" name="product_features_id" id="product_features_id" value="<?=$product_view_color_row->uniqcode?>">
                        <input type="hidden" name="color_id" id="color_id" value="<?=$product_view_color_row->color?>">
                      <?php }
                      else
                      {?>
                        <li class="">
                          <a href="<?=base_url('product/'.$product_view->slug.'?proid='.$product_view_color_row->product_id.'&feid='.$product_view_color_row->uniqcode.'&cid='.$product_view_color_row->color.'&type='.$product_view->product_type)?>">
                            <img class="dress-card-img-top" src="<?=base_url('webroot/admin/product/web/').$color_img[0]?>" alt="" >
                          </a>
                        </li>
                      <?php } }?>
                    <input type="hidden" name="image_selected" id="image_selected" value="">
                    </ul>
                  </div>
                  <div class="select-size-part">
                    <ul class="nav nav-tabs">
                      <?php foreach($product_view_size as $key => $product_view_size_row){
                        if(
                          $product_view_size_row->product_id==$product_view_price_image->product_id && 
                          $product_view_size_row->uniqcode==$product_view_price_image->uniqcode&&
                          $product_view_size_row->color==$product_view_price_image->color){
                        ?>

                          <li class="active" onclick="li_selected('<?=$product_view_size_row->size?>')">
                            <a href="<?=base_url('product/'.$product_view->slug.'?proid='.$product_view_size_row->product_id.'&feid='.$product_view_size_row->uniqcode.'&cid='.$product_view_size_row->color.'&type='.$product_view->product_type)?>">
                              <span><?=$product_view_size_row->size_name;?></span>
                            </a>
                          </li>
                      <?php }else{?>
                        <li class="" onclick="li_selected('<?=$product_view_size_row->size?>')">
                            <a  href="<?=base_url('product/'.$product_view->slug.'?proid='.$product_view_size_row->product_id.'&feid='.$product_view_size_row->uniqcode.'&cid='.$product_view_size_row->color.'&type='.$product_view->product_type)?>">
                              <span><?=$product_view_size_row->size_name;?></span>
                            </a>
                          </li>
                      <?php }}?>
                        
                        <input type="hidden" name="size_selected" id="size_selected" value="">
                    </ul>
                  </div>
                
                  <div class="row">
                      <div class="col-md-6 card-button">
                      <?php if($this->session->userdata('loginDetail')!=NULL){ 
                          $chack=array(
                            'user_id'=>$this->session->userdata('loginDetail')->uniqcode,
                            'product_id'=>$product_view_price_image->product_id,
                            'product_features_id'=>$product_view_price_image->uniqcode,
                            'color'=>$product_view_price_image->color,
                            'status'=>'Cart'
                          );
                            $count=$this->Cart_Model->entty_check($chack,'tbl_cart');
                            if($count)
                            {
                            ?>
                              <button type="button" class="btn card-button-inner bag-button bag-btn btn-block" onclick="goToBag()">
                                  <span>Go to Bag</span>
                              </button>
                            <?php }else{?>
                                <button type="button" class="btn card-button-inner bag-button bag-btn btn-block" onclick="addToBag()">
                                    <span>Add to Bag</span>
                                  </button>
                            <?php } ?>
                        
                          <?php } else {?>
                          <button type="button" class="btn card-button-inner bag-button bag-btn btn-block" onclick="addToBag()">
                            <span>Add to Bag</span>
                          </button>
                        <?php }?>
                      </div>
                      <div class="col-md-6 card-button">
                          <button type="button" class="btn card-button-inner buy-button buy-btn btn-block" onclick="buyNou()">
                            <span>Buy Now</span>
                          </button>
                      </div>
                  </div>
                  <div class="pincode-deliveryContainer">
                    <h4>
                      Delivery Options
                      <i class="fa fa-truck" aria-hidden="true"></i>
                    </h4>
                    <form autocomplete="off">
                      <input type="text" placeholder="Enter pincode" class="pincode-code" value="" name="pincode">
                      <input type="submit" class="pincode-check pincode-button" value="Check">
                    </form>
                    <p class="pincode-enterPincode">Please enter PIN code to check delivery time &amp; Pay on Delivery Availability</p>
                  </div>
                  <div class="details-tab">
                    <!-- Tab Header -->
                    <ul class="nav nav-tabs">
                      <li class="active"><a data-toggle="tab" href="#description">Description</a></li>
                      <li><a data-toggle="tab" href="#additionalInformation">Additional Information</a></li>
                      <!-- <li><a data-toggle="tab" href="#ratingReviews">Rating & Reviews</a></li> -->
                    </ul>
                    <!-- TAb content -->
                    <div class="tab-content">
                      <div id="description" class="tab-pane fade in active">
                        <h4>Product Description</h4>
                        <p>
                         <?=$product_view->description;?>
                        </p>
             
                      </div>
                      <div id="additionalInformation" class="tab-pane fade">
                        <h4>Additional Information</h4>
                        <table class="shop_attributes">
                          <tbody>
                            <?php 
                            $others_featurs=unserialize($product_view->others_featurs);
                            foreach ($others_featurs as $key => $value) {?>
                              <tr class="">
                                  <th><?php echo $key;?></th>
                                  <td class="product_weight"><?php echo $value;?></td>
                              </tr>
                            <?php } ?> 
                             
                          </tbody>
                      </table>

                      </div>
                      <!-- <div id="ratingReviews" class="tab-pane fade">
                        <h4>Rating & Reviews</h4>
                        <div class="rating-part">
                          <span class="heading">User Rating</span>
                          <span class="fa fa-star checked"></span>
                          <span class="fa fa-star checked"></span>
                          <span class="fa fa-star checked"></span>
                          <span class="fa fa-star checked"></span>
                          <span class="fa fa-star"></span>
                          <p>4.1 average based on 254 reviews.</p>
                          <hr style="border:3px solid #f1f1f1">

                          <div class="row">
                            <div class="side">
                              <div>5 star</div>
                            </div>
                            <div class="middle">
                              <div class="bar-container">
                                <div class="bar-5"></div>
                              </div>
                            </div>
                            <div class="side right">
                              <div>150</div>
                            </div>
                            <div class="side">
                              <div>4 star</div>
                            </div>
                            <div class="middle">
                              <div class="bar-container">
                                <div class="bar-4"></div>
                              </div>
                            </div>
                            <div class="side right">
                              <div>63</div>
                            </div>
                            <div class="side">
                              <div>3 star</div>
                            </div>
                            <div class="middle">
                              <div class="bar-container">
                                <div class="bar-3"></div>
                              </div>
                            </div>
                            <div class="side right">
                              <div>15</div>
                            </div>
                            <div class="side">
                              <div>2 star</div>
                            </div>
                            <div class="middle">
                              <div class="bar-container">
                                <div class="bar-2"></div>
                              </div>
                            </div>
                            <div class="side right">
                              <div>6</div>
                            </div>
                            <div class="side">
                              <div>1 star</div>
                            </div>
                            <div class="middle">
                              <div class="bar-container">
                                <div class="bar-1"></div>
                              </div>
                            </div>
                            <div class="side right">
                              <div>20</div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="comments-table">
                              <table class="table">
                                <tbody>
                                  <tr>
                                    <td>
                                      <div class="comment-table">
                                        <div class="user-prof-pic">
                                          <img src="<?base_url('webroot/admin/product/web/')?>https://pbs.twimg.com/media/DhPVk9eWsAAhTqm.jpg">
                                        </div>
                                        <div class="comment-msg">
                                          <p class="comment-user-name">Subhajit</p>
                                          <p class="comment-date">7th January, 2020</p>
                                          <div class="star-rating">
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                          </div>
                                          <p class="customer-comment">Excilent</p>
                                          <div class="like-dislike">
                                            <button class="btn likes" id="green">
                                              <i class="fa fa-thumbs-up fa-lg" aria-hidden="true"></i>
                                            </button>
                                            <div id="l-counter">0</div>
                                            <button class="btn dislikes" id="red">
                                              <i class="fa fa-thumbs-down fa-lg" aria-hidden="true"></i>
                                            </button>
                                            <div id="d-counter">0</div>
                                          </div>
                                        </div>
                                      </div>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </section>
    <!-- Product-view section end -->