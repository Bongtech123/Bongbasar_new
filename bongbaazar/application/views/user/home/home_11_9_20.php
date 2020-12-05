

    <?php if(!empty($clothing)){?>
      <section id="product-gallery">
        <div class="container-fluid product-gallery">
          <div class="row product-header  wow bounceInDown ">
             <div class="col-lg-6 col-sm-8 col-xs-8 product-heading">
               <h4>Clothes</h4>
             </div> 
             <div class="col-lg-6 col-sm-4 col-xs-4">
                <a class="btn common-btn hvr-icon-wobble-horizontal hvr-bounce-to-right" href="<?=base_url('clothing-all')?>">
                  <span>View all</span>
                  <i class="fa fa-hand-o-right hvr-icon" aria-hidden="true"></i>
                </a>
             </div> 
          </div>
          <div class="container">
            <div class="gallery-wrapper">
              <div class="product-slider">
                <?php foreach($clothing as $clothing_row){
                  $sell_price=unserialize($clothing_row->sell_price); 
                  $mrp_price=unserialize($clothing_row->mrp_price); 
                  $images_all=unserialize($clothing_row->images); 
                  $price_index=$this->Home_Model->home_sell_price($sell_price,$mrp_price);
                ?>
                  <div class="product-item">
                  
                    <div class="dress-card wow bounceInUp">
                      <div class="dress-card-head">
                        <a class="dress-card-img" target="_blank" href="<?=base_url('product/'.$clothing_row->slug.'?proid='.$clothing_row->sub_category_id.'_'.$clothing_row->uniqcode)?>">
                          <?php  
                          
                          $product_img_data=$this->Home_Model->home_best_discount_product($images_all,$price_index);
                          $product_img=explode("##",$product_img_data['image']);
                          if(!empty($product_img))
                          {
                              $path=explode("##",$clothing_row->image_link);
                             
                              ?>
                              <img class="dress-card-img-top" src="<?=base_url('webroot/upload/product/').$path[1].'/'.$product_img[0]?>" alt="">
                              <?php
                          }
                          else
                          {
                              ?><img src="<?=base_url('webroot/user/images/no_image.jpg')?>"><?php
                          }
                          ?>
                        </a>
                        <?php if($this->session->userdata('loginDetail')!=''){
                            $wishlist_row=$this->User_Model->check_wishlist($clothing_row->uniqcode,$clothing_row->sub_category_id,$this->session->userdata('loginDetail')->uniqcode,$price_index);
                          ?> 
                          <div class="surprise-bubble <?= $wishlist_row == 1 ? 'active' : '';?>">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$clothing_row->sub_category_id.'_'.$clothing_row->uniqcode.'_'.$price_index?>')" >Wishlist</span></p>
                          </div>
                        <?php }else{?>
                          <div class="surprise-bubble">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$clothing_row->sub_category_id.'_'.$clothing_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }?>
                      </div>
                      <div class="dress-card-body">
                          <h4 class="dress-card-title"><a href="<?=base_url('product-discount-all')?>"><?php
                              $name = strlen($clothing_row->name) > 13 ? substr($clothing_row->name,0,13)."..." : $clothing_row->name;
                              echo $name ;
                              ?></a>
                            </h4>
                          <p class="seller-name"><a href="<?=base_url('shop/'.$clothing_rowadmin_id)?>">By:<?=$clothing_row->shop_name?></a></p>
                        

                        <p class="">
                          <span class="dress-card-price">Rs.<?=$sell_price[$price_index]?> &ensp;</span><span class="dress-card-crossed">Rs.<?=$mrp_price[$price_index]?></span><span class="dress-card-off">&ensp;(<?=intval((($mrp_price[$price_index]-$sell_price[$price_index])/$mrp_price[$price_index])*100)?>% OFF)</span>
                        </p>
                      </div>
                    </div>
                  
                </div>
                <?php }  ?>
              </div>
            </div>
          </div>
        </div>
      </section>
     <?php }?>
    <!--Clothes gallery section end -->

     <!-- ------seller gallery section start------ -->
    <?php if(!empty($shop)):?>

      <section id="seller-gallery">
        <div class="seller-gallery extra-tag">
          <div class="middle-heading-outer wow bounceInDown">
            <h2 class="middle-heading"><span></span>Best in Bong Bazar</h2>
          </div>
          
          <div class="container-fluid">
            <div class="seller-slider">
              <?php foreach($shop as $shop_row){?>
              <div class="slide-item wow fadeInLeft">
                <span class="ribbon16">BEST</span>
               <a href="<?=base_url('shop/'.$shop_row->uniqcode)?>">
                  <img src="<?=base_url('webroot/admin/shop_image/'.$shop_row->shop_image)?>">
                  <p class="store-name"><?=$shop_row->shop_name?></p>
                </a>
              </div>
              <?php }?>

            </div>
          </div>

          <div class="view-all">
            <a class="btn hvr-bounce-to-right btn-expand hvr-icon-pulse-grow" href="<?=base_url('all-shop')?>">
              View all sellers
              <i class="fa fa-user-circle-o hvr-icon" aria-hidden="true"></i>
            </a>
          </div>
        </div>
      </section>
    <?php endif;?>

    <!-- Seller gallery section end -->
    <!----------Accessories gallery section start---------->
    <?php if(!empty($accessories_discount)):?>
      <section id="product-gallery">
        <div class="container-fluid product-gallery">
          <div class="row product-header  wow bounceInDown ">
             <div class="col-lg-6 col-sm-8 col-xs-8 product-heading">
               <h4>To Discount Of Accessories</h4>
             </div> 
             <div class="col-lg-6 col-sm-4 col-xs-4">
                <a class="btn common-btn hvr-icon-wobble-horizontal hvr-bounce-to-right" href="<?=base_url('accessories-all-discount')?>">
                  <span>View all</span>
                  <i class="fa fa-hand-o-right hvr-icon" aria-hidden="true"></i>
                </a>
             </div> 
          </div>
          <div class="container">
            <div class="gallery-wrapper">
              <div class="product-slider">
                <?php foreach($accessories_discount as $discount_accessories_row){
                    $accessories_row=(object)$discount_accessories_row;
                    $sell_price=unserialize($accessories_row->sell_price); 
                    $mrp_price=unserialize($accessories_row->mrp_price); 
                    $images_all=unserialize($accessories_row->images); 
                    $price_index=$this->Home_Model->home_sell_price($sell_price,$mrp_price);
                  ?>

                <div class="product-item">
                  
                    <div class="dress-card wow bounceInUp">
                      <div class="dress-card-head">
                        <a class="dress-card-img" target="_blank" href="<?=base_url('product/'.$accessories_row->slug.'?proid='.$accessories_row->sub_category_id.'_'.$accessories_row->uniqcode)?>">
                          <?php 
                          $product_img_data=$this->Home_Model->home_best_discount_product($images_all,$price_index);
                          if(!empty($product_img))
                          {
                              $path=explode("##",$accessories_row->image_link);
                              ?>
                              <img class="dress-card-img-top" src="<?=base_url('webroot/upload/product/').$path[1].'/'.$product_img[0]?>" alt="">
                              <?php
                          }
                          else
                          {
                              ?><img class="dress-card-img-top" src="<?=base_url('webroot/user/images/no_image.jpg')?>"><?php
                          }
                          ?>
                        </a>
                       
                        <?php if($this->session->userdata('loginDetail')!=''){
                            $wishlist_row=$this->User_Model->check_wishlist($accessories_row->uniqcode,$accessories_row->sub_category_id,$this->session->userdata('loginDetail')->uniqcode,$price_index);
                          ?> 
                          <div class="surprise-bubble <?= $wishlist_row == 1 ? 'active' : '';?>">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$accessories_row->sub_category_id.'_'.$accessories_row->uniqcode.'_'.$price_index?>')" >Wishlist</span></p>
                          </div>
                        <?php }else{?>
                          <div class="surprise-bubble">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$accessories_row->sub_category_id.'_'.$accessories_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }?>
                  
                      </div>
                      <div class="dress-card-body">
                          <h4 class="dress-card-title"><a href="<?=base_url('accessories-all')?>"><?php
                              $name = strlen($accessories_row->name) > 13 ? substr($accessories_row->name,0,13)."..." : $accessories_row->name;
                              echo $name ;
                              ?></a>
                            </h4>
                          <p class="seller-name"><a href="<?=base_url('shop/'.$accessories_row->admin_id)?>">By:<?=$accessories_row->shop_name?></a></p>
                        <p class="">
                          <span class="dress-card-price">Rs.<?=$sell_price[$price_index]?> &ensp;</span><span class="dress-card-crossed">Rs.<?=$mrp_price[$price_index]?></span><span class="dress-card-off">&ensp;(<?=intval((($mrp_price[$price_index]-$sell_price[$price_index])/$mrp_price[$price_index])*100)?>% OFF)</span>
                        </p>
                        
                      </div>
                    </div>
                  
                </div>
                <?php }  ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php endif;?>
    
    <?php if(!empty($accessories)):?>
      <section id="product-gallery">
        <div class="container-fluid product-gallery">
          <div class="row product-header  wow bounceInDown ">
             <div class="col-lg-6 col-sm-8 col-xs-8 product-heading">
               <h4>Accessories</h4>
             </div> 
             <div class="col-lg-6 col-sm-4 col-xs-4">
                <a class="btn common-btn hvr-icon-wobble-horizontal hvr-bounce-to-right" href="<?=base_url('accessories-all')?>">
                  <span>View all</span>
                  <i class="fa fa-hand-o-right hvr-icon" aria-hidden="true"></i>
                </a>
             </div> 
          </div>
          <div class="container">
            <div class="gallery-wrapper">
              <div class="product-slider">
                <?php foreach($accessories as $accessories_row){
                  $sell_price=unserialize($accessories_row->sell_price); 
                  $mrp_price=unserialize($accessories_row->mrp_price); 
                  $images_all=unserialize($accessories_row->images); 
                  $price_index=$this->Home_Model->home_sell_price($sell_price,$mrp_price);
                ?>

                <div class="product-item">
                  
                    <div class="dress-card wow bounceInUp">
                      <div class="dress-card-head">
                        <a class="dress-card-img" target="_blank" href="<?=base_url('product/'.$accessories_row->slug.'?proid='.$accessories_row->sub_category_id.'_'.$accessories_row->uniqcode)?>">
                          <?php 
                          $product_img_data=$this->Home_Model->home_best_discount_product($images_all,$price_index);
                          if(!empty($product_img))
                          {
                              $path=explode("##",$accessories_row->image_link);
                              ?>
                              <img class="dress-card-img-top" src="<?=base_url('webroot/upload/product/').$path[1].'/'.$product_img[0]?>" alt="">
                              <?php
                          }
                          else
                          {
                              ?><img class="dress-card-img-top" src="<?=base_url('webroot/user/images/no_image.jpg')?>"><?php
                          }
                          ?>
                        </a>
                     

                         <?php if($this->session->userdata('loginDetail')!=''){
                            $wishlist_row=$this->User_Model->check_wishlist($accessories_row->uniqcode,$accessories_row->sub_category_id,$this->session->userdata('loginDetail')->uniqcode,$price_index);
                          ?> 
                          <div class="surprise-bubble <?= $wishlist_row == 1 ? 'active' : '';?>">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$accessories_row->sub_category_id.'_'.$accessories_row->uniqcode.'_'.$price_index?>')" >Wishlist</span></p>
                          </div>
                        <?php }else{?>
                          <div class="surprise-bubble">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$accessories_row->sub_category_id.'_'.$accessories_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }?>
                  
                      </div>
                      <div class="dress-card-body">
                          <h4 class="dress-card-title"><a href="<?=base_url('accessories-all')?>"><?php
                              $name = strlen($accessories_row->name) > 13 ? substr($accessories_row->name,0,13)."..." : $accessories_row->name;
                              echo $name ;
                              ?></a>
                            </h4>
                          <p class="seller-name"><a href="<?=base_url('shop/'.$accessories_row->admin_id)?>">By:<?=$accessories_row->shop_name?></a></p>
                        <p class="">
                          <span class="dress-card-price">Rs.<?=$sell_price[$price_index]?> &ensp;</span><span class="dress-card-crossed">Rs.<?=$mrp_price[$price_index]?></span><span class="dress-card-off">&ensp;(<?=intval((($mrp_price[$price_index]-$sell_price[$price_index])/$mrp_price[$price_index])*100)?>% OFF)</span>
                        </p>
                        
                      </div>
                    </div>
                  
                </div>
                <?php }  ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php endif;?>
    <!--Accessories gallery section end -->

    <!-- ------------About orders start------------ -->
      <section id="about-orders">
        <div class="about-orders">
          <div class="container-fluid">
            <div class="col-md-3 col-sm-6">
              <div class="section-underpart">
                <div class="img-part">
                  <img class="wow flipInX" src="<?=base_url()?>webroot/user/images/payment.png">
                </div>
                <p class="about-order-heading wow pulse">Secure Payment</p>
                <p class="about-order-desc wow pulse">Order in for yourself or for the family, with no restrictions on order value.</p>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="section-underpart">
                <div class="img-part">
                  <img class="wow flipInX" src="<?=base_url()?>webroot/user/images/Transport.webp">
                  <p class="about-order-heading wow pulse">Faster delivery</p>
                  <p class="about-order-desc wow pulse">Experience Bong Bazar superfast delivery for your delivered order & on time</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="section-underpart">
                <div class="img-part">
                  <img class="wow flipInX" src="<?=base_url()?>webroot/user/images/cash-on-delivery.jpg">
                   <p class="about-order-heading wow pulse">Cash on delivery</p>
                   <p class="about-order-desc wow pulse">You can pay your product amount on delivery time.</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="section-underpart">
                <div class="img-part">
                  <img class="wow flipInX" src="<?=base_url()?>webroot/user/images/24-7-service.png">
                   <p class="about-order-heading wow pulse">Always Support</p>
                   <p class="about-order-desc wow pulse">We are ready to help you 24/7.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    <!-- About orders end -->
    <!----------Shoes gallery section start---------->
    <?php if(!empty($shoes_discount)):?>
      <section id="product-gallery">
        <div class="container-fluid product-gallery">
          <div class="row product-header  wow bounceInDown ">
             <div class="col-lg-6 col-sm-8 col-xs-8 product-heading">
               <h4>Top Discount Of Shoes</h4>
             </div> 
             <div class="col-lg-6 col-sm-4 col-xs-4">
                <a class="btn common-btn hvr-icon-wobble-horizontal hvr-bounce-to-right" href="<?=base_url('shoes-all-discount')?>" >
                  <span>View all</span>
                  <i class="fa fa-hand-o-right hvr-icon" aria-hidden="true"></i>
                </a>
             </div> 
          </div>
          <div class="container">
            <div class="gallery-wrapper">
              <div class="product-slider">
                <?php foreach($shoes_discount as $discount_shoes_row){
                    $shoes_row=(object)$discount_shoes_row;
                    $sell_price=unserialize($shoes_row->sell_price); 
                    $mrp_price=unserialize($shoes_row->mrp_price); 
                    $images_all=unserialize($shoes_row->images); 
                    $price_index=$this->Home_Model->home_sell_price($sell_price,$mrp_price);
                  ?>

                <div class="product-item">
                  
                    <div class="dress-card wow bounceInUp">
                      <div class="dress-card-head">
                        <a class="dress-card-img"target="_blank" href="<?=base_url('product/'.$discount_shoes_row->slug.'?proid='.$discount_shoes_row->sub_category_id.'_'.$discount_shoes_row->uniqcode)?>">
                          <?php
                          $product_img_data=$this->Home_Model->home_best_discount_product($images_all,$price_index);
                          if(!empty($product_img))
                          {
                              $path=explode("##",$shoes_row->image_link);
                              ?>
                              <img class="dress-card-img-top" src="<?=base_url('webroot/upload/product/').$path[1].'/'.$product_img[0]?>" alt="">
                              <?php
                          }
                          else
                          {
                              ?><img class="dress-card-img-top" src="<?=base_url('webroot/user/images/no_image.jpg')?>"><?php
                          }
                          ?>
                        </a>
                        <?php if($this->session->userdata('loginDetail')!=''){
                            $wishlist_row=$this->User_Model->check_wishlist($shoes_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode)
                          ?> 
                          <div class="surprise-bubble <?= $wishlist_row == 1 ? 'active' : '';?>">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$shoes_row->sub_category_id.'_'.$shoes_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }else{?>
                          <div class="surprise-bubble">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$shoes_row->sub_category_id.'_'.$shoes_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }?>
                        
                      </div>
                      <div class="dress-card-body">
                          <h4 class="dress-card-title"><a href="<?=base_url('shoes-all')?>"><?php
                              $name = strlen($shoes_row->name) > 13 ? substr($shoes_row->name,0,13)."..." : $shoes_row->name;
                              echo $name ;
                              ?></a>
                            </h4>
                          <p class="seller-name"><a href="<?=base_url('shop/'.$shoes_row->admin_id)?>">By:<?=$shoes_row->shop_name?></a></p>
                      
                        <p class="">
                          <span class="dress-card-price">Rs.<?=$sell_price[$price_index]?> &ensp;</span><span class="dress-card-crossed">Rs.<?=$mrp_price[$price_index]?></span><span class="dress-card-off">&ensp;(<?=intval((($mrp_price[$price_index]-$sell_price[$price_index])/$mrp_price[$price_index])*100)?>% OFF)</span>
                        </p>
                      </div>
                    </div>
                  
                </div>
                <?php }  ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php endif;?>

    <?php if(!empty($shoes)):?>
      <section id="product-gallery">
        <div class="container-fluid product-gallery">
          <div class="row product-header  wow bounceInDown ">
             <div class="col-lg-6 col-sm-8 col-xs-8 product-heading">
               <h4>Shoes</h4>
             </div> 
             <div class="col-lg-6 col-sm-4 col-xs-4">
                <a class="btn common-btn hvr-icon-wobble-horizontal hvr-bounce-to-right" href="<?=base_url('shoes-all')?>" >
                  <span>View all</span>
                  <i class="fa fa-hand-o-right hvr-icon" aria-hidden="true"></i>
                </a>
             </div> 
          </div>
          <div class="container">
            <div class="gallery-wrapper">
              <div class="product-slider">
                <?php foreach($shoes as $shoes_row){
                  $sell_price=unserialize($shoes_row->sell_price); 
                  $mrp_price=unserialize($shoes_row->mrp_price); 
                  $images_all=unserialize($shoes_row->images); 
                  $price_index=$this->Home_Model->home_sell_price($sell_price,$mrp_price);
                ?>

                <div class="product-item">
                  
                    <div class="dress-card wow bounceInUp">
                      <div class="dress-card-head">
                        <a class="dress-card-img"target="_blank"   href="<?=base_url('product/'.$discount_shoes_row->slug.'?proid='.$discount_shoes_row->sub_category_id.'_'.$discount_shoes_row->uniqcode)?>">
                          <?php 
                          $product_img_data=$this->Home_Model->home_best_discount_product($images_all,$price_index);
                          if(!empty($product_img))
                          {
                              $path=explode("##",$shoes_row->image_link);
                              ?>
                              <img class="dress-card-img-top" src="<?=base_url('webroot/upload/product/').$path[1].'/'.$product_img[0]?>" alt="">
                              <?php
                          }
                          else
                          {
                              ?><img class="dress-card-img-top" src="<?=base_url('webroot/user/images/no_image.jpg')?>"><?php
                          }
                          ?>
                        </a>
                        <?php if($this->session->userdata('loginDetail')!=''){
                            $wishlist_row=$this->User_Model->check_wishlist($shoes_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode)
                          ?> 
                          <div class="surprise-bubble <?= $wishlist_row == 1 ? 'active' : '';?>">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$shoes_row->sub_category_id.'_'.$shoes_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }else{?>
                          <div class="surprise-bubble">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$shoes_row->sub_category_id.'_'.$shoes_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }?>
                        
                      </div>
                      <div class="dress-card-body">
                          <h4 class="dress-card-title"><a href="<?=base_url('shoes-all')?>"><?php
                              $name = strlen($shoes_row->name) > 13 ? substr($shoes_row->name,0,13)."..." : $shoes_row->name;
                              echo $name ;
                              ?></a>
                            </h4>
                          <p class="seller-name"><a href="<?=base_url('shop/'.$shoes_row->admin_id)?>">By:<?=$shoes_row->shop_name?></a></p>
                          <?php 
                            $sell_price=unserialize($shoes_row->sell_price); 
                            $mrp_price=unserialize($shoes_row->mrp_price); 
                            $price_index=$this->Home_Model->home_sell_price($sell_price,$mrp_price);
                          ?>
                       

                        <p class="">
                          <span class="dress-card-price">Rs.<?=$sell_price[$price_index]?> &ensp;</span><span class="dress-card-crossed">Rs.<?=$mrp_price[$price_index]?></span><span class="dress-card-off">&ensp;(<?=intval((($mrp_price[$price_index]-$sell_price[$price_index])/$mrp_price[$price_index])*100)?>% OFF)</span>
                        </p>
                      </div>
                    </div>
                  
                </div>
                <?php }  ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php endif;?>
    <!--Shoes gallery section end -->

    <!-- --------Product offer section start-------- -->
      <section id="product-offer">
        <div class="container-fluid product-offer">
          <div class="row">
            <div class="col-lg-4 col-sm-6 col-xs-6 col-md-4">
              <div class="offer-wrapper wow bounceInDown ">
                <img src="https://rukminim1.flixcart.com/flap/960/960/image/084789479074d2b2.jpg?q=50" alt="image1">
              </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-xs-6 col-md-4">
              <div class="offer-wrapper wow bounceInDown">
                <img src="https://rukminim1.flixcart.com/flap/960/960/image/399c64b61c0e1d00.jpg?q=50" alt="image1">
              </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-xs-6 col-md-4">
              <div class="offer-wrapper wow bounceInDown ">
                <img src="https://rukminim1.flixcart.com/flap/960/960/image/084789479074d2b2.jpg?q=50" alt="image1">
              </div>
            </div>
            
          </div>
        </div>
      </section>
    <!-- Product offer section end -->

    <!----------Special care section start---------->
    <?php if(!empty($special_care_discount)):?>
      <section id="product-gallery">
        <div class="container-fluid product-gallery">
          <div class="row product-header  wow bounceInDown ">
             <div class="col-lg-6 col-sm-8 col-xs-8 product-heading">
               <h4>Top Discount Of Special Care</h4>
             </div> 
             <div class="col-lg-6 col-sm-4 col-xs-4">
                <a class="btn common-btn hvr-icon-wobble-horizontal hvr-bounce-to-right" href="<?=base_url('special-care-all-discount')?>">
                  <span>View all</span>
                  <i class="fa fa-hand-o-right hvr-icon" aria-hidden="true"></i>
                </a>
             </div> 
          </div>
          <div class="container">
            <div class="gallery-wrapper">
              <div class="product-slider">
                <?php foreach($special_care_discount as $discount_special_care_row){
                    $special_care_row=(object)$discount_special_care_row;
                    $sell_price=unserialize($special_care_row->sell_price); 
                    $mrp_price=unserialize($special_care_row->mrp_price); 
                    $images_all=unserialize($special_care_row->images); 
                    $price_index=$this->Home_Model->home_sell_price($sell_price,$mrp_price);
                  ?>

                <div class="product-item">
                  
                    <div class="dress-card wow bounceInUp">
                      <div class="dress-card-head">
                        <a class="dress-card-img"target="_blank" href="<?=base_url('product/'.$special_care_row->slug.'?proid='.$special_care_row->sub_category_id.'_'.$special_care_row->uniqcode)?>">
                          <?php 
                          $product_img_data=$this->Home_Model->home_best_discount_product($images_all,$price_index); 
                          if(!empty($product_img))
                          {
                              $path=explode("##",$special_care_row->image_link);
                              ?>
                              <img class="dress-card-img-top" src="<?=base_url('webroot/upload/product/').$path[1].'/'.$product_img[0]?>" alt="">
                              <?php
                          }
                          else
                          {
                              ?><img src="<?=base_url('webroot/user/images/no_image.jpg')?>"><?php
                          }
                          ?>
                        </a>
                        <?php if($this->session->userdata('loginDetail')!=''){
                            $wishlist_row=$this->User_Model->check_wishlist($special_care_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode)
                          ?> 
                          <div class="surprise-bubble <?= $wishlist_row == 1 ? 'active' : '';?>">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$special_care_row->sub_category_id.'_'.$special_care_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }else{?>
                          <div class="surprise-bubble">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$special_care_row->sub_category_id.'_'.$special_care_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }?>
                         
                      </div>
                      <div class="dress-card-body">
                          <h4 class="dress-card-title"><a href="<?=base_url('product-discount-all')?>"><?php
                              $name = strlen($special_care_row->name) > 13 ? substr($special_care_row->name,0,13)."..." : $special_care_row->name;
                              echo $name ;
                              ?></a>
                            </h4>
                          <p class="seller-name"><a href="<?=base_url('shop/'.$special_care_row->admin_id)?>">By:<?=$special_care_row->shop_name?></a></p>
                          <p><span class="dress-card-price">Rs.<?=$sell_price[0]?> &ensp;</span><span class="dress-card-crossed">Rs.<?=$mrp_price[0]?></span><span class="dress-card-off">&ensp;(<?=intval((($mrp_price[0]-$sell_price[0])/$mrp_price[0])*100)?>% OFF)</span></p>
                          
                      </div>
                    </div>
                
                </div>
                <?php }  ?>
              </div>
            </div>
          </div>
        </div>
      </section>
     <?php endif;?>

    <?php if(!empty($special_care)):?>
      <section id="product-gallery">
        <div class="container-fluid product-gallery">
          <div class="row product-header  wow bounceInDown ">
             <div class="col-lg-6 col-sm-8 col-xs-8 product-heading">
               <h4>Special Care</h4>
             </div> 
             <div class="col-lg-6 col-sm-4 col-xs-4">
                <a class="btn common-btn hvr-icon-wobble-horizontal hvr-bounce-to-right" href="<?=base_url('special-care-all')?>">
                  <span>View all</span>
                  <i class="fa fa-hand-o-right hvr-icon" aria-hidden="true"></i>
                </a>
             </div> 
          </div>
          <div class="container">
            <div class="gallery-wrapper">
              <div class="product-slider">
                <?php foreach($special_care as $special_care_row){
                  $sell_price=unserialize($special_care_row->sell_price); 
                  $mrp_price=unserialize($special_care_row->mrp_price); 
                  $images_all=unserialize($special_care_row->images); 
                  $price_index=$this->Home_Model->home_sell_price($sell_price,$mrp_price);
                ?>

                <div class="product-item">
                  
                    <div class="dress-card wow bounceInUp">
                      <div class="dress-card-head">
                        <a class="dress-card-img"target="_blank"  href="<?=base_url('product/'.$special_care_row->slug.'?proid='.$special_care_row->sub_category_id.'_'.$special_care_row->uniqcode)?>">
                          <?php 
                          $product_img_data=$this->Home_Model->home_best_discount_product($images_all,$price_index);
                          if(!empty($product_img))
                          {
                              $path=explode("##",$special_care_row->image_link);
                              ?>
                              <img class="dress-card-img-top" src="<?=base_url('webroot/upload/product/').$path[1].'/'.$product_img[0]?>" alt="">
                              <?php
                          }
                          else
                          {
                              ?><img src="<?=base_url('webroot/user/images/no_image.jpg')?>"><?php
                          }
                          ?>
                        </a>
                        <?php if($this->session->userdata('loginDetail')!=''){
                            $wishlist_row=$this->User_Model->check_wishlist($special_care_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode)
                          ?> 
                          <div class="surprise-bubble <?= $wishlist_row == 1 ? 'active' : '';?>">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$special_care_row->sub_category_id.'_'.$special_care_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }else{?>
                          <div class="surprise-bubble">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$special_care_row->sub_category_id.'_'.$special_care_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }?>
                         
                      </div>
                      <div class="dress-card-body">
                          <h4 class="dress-card-title"><a href="<?=base_url('product-discount-all')?>"><?php
                              $name = strlen($special_care_row->name) > 13 ? substr($special_care_row->name,0,13)."..." : $special_care_row->name;
                              echo $name ;
                              ?></a>
                            </h4>
                          <p class="seller-name"><a href="<?=base_url('shop/'.$special_care_row->admin_id)?>">By:<?=$special_care_row->shop_name?></a></p>
                          <p><span class="dress-card-price">Rs.<?=$sell_price[0]?> &ensp;</span><span class="dress-card-crossed">Rs.<?=$mrp_price[0]?></span><span class="dress-card-off">&ensp;(<?=intval((($mrp_price[0]-$sell_price[0])/$mrp_price[0])*100)?>% OFF)</span></p>
                          
                      </div>
                    </div>
                
                </div>
                <?php }  ?>
              </div>
            </div>
          </div>
        </div>
      </section>
     <?php endif;?>
    <!--Special care section end -->
    <!-- ----------Banner Section start---------- -->
    <?php if(!empty($banner)):?>

      <section id="banner" class="banner">
        <div class="banner-wrapper bannere">
          <div class="banner-slider banner-area">
            <?php  foreach ($banner as $key => $banner_data) {?>
              <div class="banner-item wow bounceInDown">
                <img src="<?=base_url('webroot/banner/'.$banner_data->image)?>" alt="pic1"/ >
              </div>
            <?php }?> 
          </div>
        </div>
      </section>

    <?php endif;?>
    <!-- Banner Section end -->



   <!-- ------seller gallery section start------ -->
    <?php if(!empty($shop)):?>

      <section id="seller-gallery">
        <div class="seller-gallery">
          <div class="middle-heading-outer wow bounceInDown">
            <h2 class="middle-heading"><span></span>Popular Sellers</h2>
          </div>
          
          <div class="container-fluid">
            <div class="seller-slider">
              <?php foreach($shop as $shop_row){?>
              <div class="slide-item wow flip">
                <a href="<?=base_url('shop/'.$shop_row->uniqcode)?>">
                  <img src="<?=base_url('webroot/admin/shop_image/'.$shop_row->shop_image)?>">
                  <p class="store-name"><?=$shop_row->shop_name?></p>
                </a>
              </div>
              <?php }?>
              
            </div>
          </div>

          <div class="view-all">
            <a class="btn hvr-bounce-to-right btn-expand hvr-icon-pulse-grow" href="<?=base_url('all-shop')?>">
              View all sellers
              <i class="fa fa-user-circle-o hvr-icon" aria-hidden="true"></i>
            </a>
          </div>
        </div>
      </section>
    <?php endif;?>

    <!-- Seller gallery section end -->
     <!----------Clothes gallery section start---------->
    <?php if(!empty($clothing_discount)):?>
      <section id="product-gallery">
        <div class="container-fluid product-gallery">
          <div class="row product-header  wow bounceInDown ">
             <div class="col-lg-6 col-sm-8 col-xs-8 product-heading">
               <h4>Top Discount Of Clothes</h4>
             </div> 
             <div class="col-lg-6 col-sm-4 col-xs-4">
                <a class="btn common-btn hvr-icon-wobble-horizontal hvr-bounce-to-right" href="<?=base_url('clothing-all-discount')?>">
                  <span>View all</span>
                  <i class="fa fa-hand-o-right hvr-icon" aria-hidden="true"></i>
                </a>
             </div> 
          </div>
          <div class="container">
            <div class="gallery-wrapper">
              <div class="product-slider">
                <?php foreach($clothing_discount as $discount_clothing_row){
                    $clothing_row=(object)$discount_clothing_row;
                  ?>

                <div class="product-item">
                  
                    <div class="dress-card wow bounceInUp">
                      <div class="dress-card-head">
                        <a class="dress-card-img" target="_blank" href="<?=base_url('product/'.$clothing_row->slug.'?proid='.$clothing_row->sub_category_id.'_'.$clothing_row->uniqcode)?>">
                          <?php $product_img=unserialize($clothing_row->images); 
                          if(!empty($product_img))
                          {
                              $path=explode("##",$clothing_row->image_link);
                             
                              ?>
                              <img class="dress-card-img-top" src="<?=base_url('webroot/upload/product/').$path[1].'/'.$product_img[0]?>" alt="">
                              <?php
                          }
                          else
                          {
                              ?><img src="<?=base_url('webroot/user/images/no_image.jpg')?>"><?php
                          }
                          ?>
                        </a>
                        <?php if($this->session->userdata('loginDetail')!=''){
                            $wishlist_row=$this->User_Model->check_wishlist($clothing_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode)
                          ?> 
                          <div class="surprise-bubble <?= $wishlist_row == 1 ? 'active' : '';?>">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$clothing_row->sub_category_id.'_'.$clothing_row->uniqcode?>')" >Wishlist</span></p>
                          </div>
                        <?php }else{?>
                          <div class="surprise-bubble">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$clothing_row->sub_category_id.'_'.$clothing_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }?>
                      </div>
                      <div class="dress-card-body">
                          <h4 class="dress-card-title"><a href="<?=base_url('product-discount-all')?>"><?php
                              $name = strlen($clothing_row->name) > 13 ? substr($clothing_row->name,0,13)."..." : $clothing_row->name;
                              echo $name ;
                              ?></a>
                            </h4>
                          <p class="seller-name"><a href="<?=base_url('shop/'.$clothing_rowadmin_id)?>">By:<?=$clothing_row->shop_name?></a></p>
                          <?php 
                            $sell_price=unserialize($clothing_row->sell_price); 
                            $mrp_price=unserialize($clothing_row->mrp_price); 
                            $price_index=$this->Home_Model->home_sell_price($sell_price,$mrp_price);
                          ?>
                       

                        <p class="">
                          <span class="dress-card-price">Rs.<?=$sell_price[$price_index]?> &ensp;</span><span class="dress-card-crossed">Rs.<?=$mrp_price[$price_index]?></span><span class="dress-card-off">&ensp;(<?=intval((($mrp_price[$price_index]-$sell_price[$price_index])/$mrp_price[$price_index])*100)?>% OFF)</span>
                        </p>
                      </div>
                    </div>
                  
                </div>
                <?php }  ?>
              </div>
            </div>
          </div>
        </div>
      </section>
     <?php endif;?>
    <!--Clothes gallery section end -->

    <!----------Clothes gallery section start---------->
    <?php if(!empty($clothing)):?>
      <section id="product-gallery">
        <div class="container-fluid product-gallery">
          <div class="row product-header  wow bounceInDown ">
             <div class="col-lg-6 col-sm-8 col-xs-8 product-heading">
               <h4>Clothes</h4>
             </div> 
             <div class="col-lg-6 col-sm-4 col-xs-4">
                <a class="btn common-btn hvr-icon-wobble-horizontal hvr-bounce-to-right" href="<?=base_url('clothing-all')?>">
                  <span>View all</span>
                  <i class="fa fa-hand-o-right hvr-icon" aria-hidden="true"></i>
                </a>
             </div> 
          </div>
          <div class="container">
            <div class="gallery-wrapper">
              <div class="product-slider">
                <?php foreach($clothing as $clothing_row){?>

                <div class="product-item">
                  
                    <div class="dress-card wow bounceInUp">
                      <div class="dress-card-head">
                        <a class="dress-card-img" target="_blank" href="<?=base_url('product/'.$clothing_row->slug.'?proid='.$clothing_row->sub_category_id.'_'.$clothing_row->uniqcode)?>">
                          <?php $product_img=unserialize($clothing_row->images); 
                          if(!empty($product_img))
                          {
                              $path=explode("##",$clothing_row->image_link);
                              ?>
                              <img class="dress-card-img-top" src="<?=base_url('webroot/upload/product/').$path[1].'/'.$product_img[0]?>" alt="">
                              <?php
                          }
                          else
                          {
                              ?><img src="<?=base_url('webroot/user/images/no_image.jpg')?>"><?php
                          }
                          ?>
                        </a>
                        <?php if($this->session->userdata('loginDetail')!=''){
                            $wishlist_row=$this->User_Model->check_wishlist($clothing_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode)
                          ?> 
                          <div class="surprise-bubble <?= $wishlist_row == 1 ? 'active' : '';?>">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$clothing_row->sub_category_id.'_'.$clothing_row->uniqcode?>')" >Wishlist</span></p>
                          </div>
                        <?php }else{?>
                          <div class="surprise-bubble">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$clothing_row->sub_category_id.'_'.$clothing_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }?>
                      </div>
                      <div class="dress-card-body">
                          <h4 class="dress-card-title"><a href="<?=base_url('product-discount-all')?>"><?php
                              $name = strlen($clothing_row->name) > 13 ? substr($clothing_row->name,0,13)."..." : $clothing_row->name;
                              echo $name ;
                              ?></a>
                            </h4>
                          <p class="seller-name"><a href="<?=base_url('shop/'.$clothing_rowadmin_id)?>">By:<?=$clothing_row->shop_name?></a></p>
                          <?php 
                            $sell_price=unserialize($clothing_row->sell_price); 
                            $mrp_price=unserialize($clothing_row->mrp_price); 
                            $price_index=$this->Home_Model->home_sell_price($sell_price,$mrp_price);
                          ?>
                       

                        <p class="">
                          <span class="dress-card-price">Rs.<?=$sell_price[$price_index]?> &ensp;</span><span class="dress-card-crossed">Rs.<?=$mrp_price[$price_index]?></span><span class="dress-card-off">&ensp;(<?=intval((($mrp_price[$price_index]-$sell_price[$price_index])/$mrp_price[$price_index])*100)?>% OFF)</span>
                        </p>
                      </div>
                    </div>
                  
                </div>
                <?php }  ?>
              </div>
            </div>
          </div>
        </div>
      </section>
     <?php endif;?>
    <!--Clothes gallery section end -->

    <!-- ------seller gallery section start------ -->
<!--     <?php if(!empty($shop)):?>

      <section id="seller-gallery">
        <div class="seller-gallery extra-tag">
          <div class="middle-heading-outer wow bounceInDown">
            <h2 class="middle-heading"><span></span>Best in Bong Bazar</h2>
          </div>
          
          <div class="container-fluid">
            <div class="seller-slider">
              <?php foreach($shop as $shop_row){?>
              <div class="slide-item wow fadeInLeft">
                <span class="ribbon16">BEST</span>
               <a href="<?=base_url('shop/'.$shop_row->uniqcode)?>">
                  <img src="<?=base_url('webroot/admin/shop_image/'.$shop_row->shop_image)?>">
                  <p class="store-name"><?=$shop_row->shop_name?></p>
                </a>
              </div>
              <?php }?>

            </div>
          </div>

          <div class="view-all">
            <a class="btn hvr-bounce-to-right btn-expand hvr-icon-pulse-grow" href="<?=base_url('all-shop')?>">
              View all sellers
              <i class="fa fa-user-circle-o hvr-icon" aria-hidden="true"></i>
            </a>
          </div>
        </div>
      </section>
    <?php endif;?>

    <!-- Seller gallery section end -->
    <!----------Accessories gallery section start---------->
    <?php if(!empty($accessories_discount)):?>
      <section id="product-gallery">
        <div class="container-fluid product-gallery">
          <div class="row product-header  wow bounceInDown ">
             <div class="col-lg-6 col-sm-8 col-xs-8 product-heading">
               <h4>To Discount Of Accessories</h4>
             </div> 
             <div class="col-lg-6 col-sm-4 col-xs-4">
                <a class="btn common-btn hvr-icon-wobble-horizontal hvr-bounce-to-right" href="<?=base_url('accessories-all-discount')?>">
                  <span>View all</span>
                  <i class="fa fa-hand-o-right hvr-icon" aria-hidden="true"></i>
                </a>
             </div> 
          </div>
          <div class="container">
            <div class="gallery-wrapper">
              <div class="product-slider">
                <?php foreach($accessories_discount as $discount_accessories_row){
                    $accessories_row=(object)$discount_accessories_row;
                  ?>

                <div class="product-item">
                  
                    <div class="dress-card wow bounceInUp">
                      <div class="dress-card-head">
                        <a class="dress-card-img" target="_blank" href="<?=base_url('product/'.$accessories_row->slug.'?proid='.$accessories_row->sub_category_id.'_'.$accessories_row->uniqcode)?>">
                          <?php $product_img=unserialize($accessories_row->images); 
                          if(!empty($product_img))
                          {
                              $path=explode("##",$accessories_row->image_link);
                              ?>
                              <img class="dress-card-img-top" src="<?=base_url('webroot/upload/product/').$path[1].'/'.$product_img[0]?>" alt="">
                              <?php
                          }
                          else
                          {
                              ?><img class="dress-card-img-top" src="<?=base_url('webroot/user/images/no_image.jpg')?>"><?php
                          }
                          ?>
                        </a>
                         <?php if($this->session->userdata('loginDetail')!=''){
                            $wishlist_row=$this->User_Model->check_wishlist($accessories_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode)
                          ?> 
                          <div class="surprise-bubble <?= $wishlist_row == 1 ? 'active' : '';?>">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$accessories_row->sub_category_id.'_'.$accessories_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }else{?>
                          <div class="surprise-bubble">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$accessories_row->sub_category_id.'_'.$accessories_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }?>
                  
                      </div>
                      <div class="dress-card-body">
                          <h4 class="dress-card-title"><a href="<?=base_url('accessories-all')?>"><?php
                              $name = strlen($accessories_row->name) > 13 ? substr($accessories_row->name,0,13)."..." : $accessories_row->name;
                              echo $name ;
                              ?></a>
                            </h4>
                          <p class="seller-name"><a href="<?=base_url('shop/'.$accessories_row->admin_id)?>">By:<?=$accessories_row->shop_name?></a></p>
                          <?php 
                            $sell_price=unserialize($accessories_row->sell_price); 
                            $mrp_price=unserialize($accessories_row->mrp_price); 
                            $price_index=$this->Home_Model->home_sell_price($sell_price,$mrp_price);
                          ?>
                       

                        <p class="">
                          <span class="dress-card-price">Rs.<?=$sell_price[$price_index]?> &ensp;</span><span class="dress-card-crossed">Rs.<?=$mrp_price[$price_index]?></span><span class="dress-card-off">&ensp;(<?=intval((($mrp_price[$price_index]-$sell_price[$price_index])/$mrp_price[$price_index])*100)?>% OFF)</span>
                        </p>
                        
                      </div>
                    </div>
                  
                </div>
                <?php }  ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php endif;?>
    <!--Accessories gallery section en

    <!----------Accessories gallery section start---------->
    <?php if(!empty($accessories)):?>
      <section id="product-gallery">
        <div class="container-fluid product-gallery">
          <div class="row product-header  wow bounceInDown ">
             <div class="col-lg-6 col-sm-8 col-xs-8 product-heading">
               <h4>Accessories</h4>
             </div> 
             <div class="col-lg-6 col-sm-4 col-xs-4">
                <a class="btn common-btn hvr-icon-wobble-horizontal hvr-bounce-to-right" href="<?=base_url('accessories-all')?>">
                  <span>View all</span>
                  <i class="fa fa-hand-o-right hvr-icon" aria-hidden="true"></i>
                </a>
             </div> 
          </div>
          <div class="container">
            <div class="gallery-wrapper">
              <div class="product-slider">
                <?php foreach($accessories as $accessories_row){?>

                <div class="product-item">
                  
                    <div class="dress-card wow bounceInUp">
                      <div class="dress-card-head">
                        <a class="dress-card-img" target="_blank" href="<?=base_url('product/'.$accessories_row->slug.'?proid='.$accessories_row->sub_category_id.'_'.$accessories_row->uniqcode)?>">
                          <?php $product_img=unserialize($accessories_row->images); 
                          if(!empty($product_img))
                          {
                              $path=explode("##",$accessories_row->image_link);
                              ?>
                              <img class="dress-card-img-top" src="<?=base_url('webroot/upload/product/').$path[1].'/'.$product_img[0]?>" alt="">
                              <?php
                          }
                          else
                          {
                              ?><img class="dress-card-img-top" src="<?=base_url('webroot/user/images/no_image.jpg')?>"><?php
                          }
                          ?>
                        </a>
                         <?php if($this->session->userdata('loginDetail')!=''){
                            $wishlist_row=$this->User_Model->check_wishlist($accessories_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode)
                          ?> 
                          <div class="surprise-bubble <?= $wishlist_row == 1 ? 'active' : '';?>">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$accessories_row->sub_category_id.'_'.$accessories_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }else{?>
                          <div class="surprise-bubble">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$accessories_row->sub_category_id.'_'.$accessories_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }?>
                  
                      </div>
                      <div class="dress-card-body">
                          <h4 class="dress-card-title"><a href="<?=base_url('accessories-all')?>"><?php
                              $name = strlen($accessories_row->name) > 13 ? substr($accessories_row->name,0,13)."..." : $accessories_row->name;
                              echo $name ;
                              ?></a>
                            </h4>
                          <p class="seller-name"><a href="<?=base_url('shop/'.$accessories_row->admin_id)?>">By:<?=$accessories_row->shop_name?></a></p>
                          <?php 
                            $sell_price=unserialize($accessories_row->sell_price); 
                            $mrp_price=unserialize($accessories_row->mrp_price); 
                            $price_index=$this->Home_Model->home_sell_price($sell_price,$mrp_price);
                          ?>
                       

                        <p class="">
                          <span class="dress-card-price">Rs.<?=$sell_price[$price_index]?> &ensp;</span><span class="dress-card-crossed">Rs.<?=$mrp_price[$price_index]?></span><span class="dress-card-off">&ensp;(<?=intval((($mrp_price[$price_index]-$sell_price[$price_index])/$mrp_price[$price_index])*100)?>% OFF)</span>
                        </p>
                        
                      </div>
                    </div>
                  
                </div>
                <?php }  ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php endif;?>
    <!--Accessories gallery section end -->

    <!-- ------------About orders start------------ -->
      <section id="about-orders">
        <div class="about-orders">
          <div class="container-fluid">
            <div class="col-md-3 col-sm-6">
              <div class="section-underpart">
                <div class="img-part">
                  <img class="wow flipInX" src="<?=base_url()?>webroot/user/images/payment.png">
                </div>
                <p class="about-order-heading wow pulse">Secure Payment</p>
                <p class="about-order-desc wow pulse">Order in for yourself or for the family, with no restrictions on order value.</p>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="section-underpart">
                <div class="img-part">
                  <img class="wow flipInX" src="<?=base_url()?>webroot/user/images/Transport.webp">
                  <p class="about-order-heading wow pulse">Faster delivery</p>
                  <p class="about-order-desc wow pulse">Experience Bong Bazar superfast delivery for your delivered order & on time</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="section-underpart">
                <div class="img-part">
                  <img class="wow flipInX" src="<?=base_url()?>webroot/user/images/cash-on-delivery.jpg">
                   <p class="about-order-heading wow pulse">Cash on delivery</p>
                   <p class="about-order-desc wow pulse">You can pay your product amount on delivery time.</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="section-underpart">
                <div class="img-part">
                  <img class="wow flipInX" src="<?=base_url()?>webroot/user/images/24-7-service.png">
                   <p class="about-order-heading wow pulse">Always Support</p>
                   <p class="about-order-desc wow pulse">We are ready to help you 24/7.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    <!-- About orders end -->
     <!----------Shoes gallery section start---------->
    <?php if(!empty($shoes_discount)):?>
      <section id="product-gallery">
        <div class="container-fluid product-gallery">
          <div class="row product-header  wow bounceInDown ">
             <div class="col-lg-6 col-sm-8 col-xs-8 product-heading">
               <h4>Top Discount Of Shoes</h4>
             </div> 
             <div class="col-lg-6 col-sm-4 col-xs-4">
                <a class="btn common-btn hvr-icon-wobble-horizontal hvr-bounce-to-right" href="<?=base_url('shoes-all-discount')?>" >
                  <span>View all</span>
                  <i class="fa fa-hand-o-right hvr-icon" aria-hidden="true"></i>
                </a>
             </div> 
          </div>
          <div class="container">
            <div class="gallery-wrapper">
              <div class="product-slider">
                <?php foreach($shoes_discount as $discount_shoes_row){
                    $shoes_row=(object)$discount_shoes_row;
                  ?>

                <div class="product-item">
                  
                    <div class="dress-card wow bounceInUp">
                      <div class="dress-card-head">
                        <a class="dress-card-img"target="_blank" href="<?=base_url('product/'.$discount_shoes_row->slug.'?proid='.$discount_shoes_row->sub_category_id.'_'.$discount_shoes_row->uniqcode)?>">
                          <?php $product_img=unserialize($shoes_row->images); 
                          if(!empty($product_img))
                          {
                              $path=explode("##",$shoes_row->image_link);
                              ?>
                              <img class="dress-card-img-top" src="<?=base_url('webroot/upload/product/').$path[1].'/'.$product_img[0]?>" alt="">
                              <?php
                          }
                          else
                          {
                              ?><img class="dress-card-img-top" src="<?=base_url('webroot/user/images/no_image.jpg')?>"><?php
                          }
                          ?>
                        </a>
                        <?php if($this->session->userdata('loginDetail')!=''){
                            $wishlist_row=$this->User_Model->check_wishlist($shoes_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode)
                          ?> 
                          <div class="surprise-bubble <?= $wishlist_row == 1 ? 'active' : '';?>">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$shoes_row->sub_category_id.'_'.$shoes_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }else{?>
                          <div class="surprise-bubble">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$shoes_row->sub_category_id.'_'.$shoes_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }?>
                        
                      </div>
                      <div class="dress-card-body">
                          <h4 class="dress-card-title"><a href="<?=base_url('shoes-all')?>"><?php
                              $name = strlen($shoes_row->name) > 13 ? substr($shoes_row->name,0,13)."..." : $shoes_row->name;
                              echo $name ;
                              ?></a>
                            </h4>
                          <p class="seller-name"><a href="<?=base_url('shop/'.$shoes_row->admin_id)?>">By:<?=$shoes_row->shop_name?></a></p>
                          <?php 
                            $sell_price=unserialize($shoes_row->sell_price); 
                            $mrp_price=unserialize($shoes_row->mrp_price); 
                            $price_index=$this->Home_Model->home_sell_price($sell_price,$mrp_price);
                          ?>
                       

                        <p class="">
                          <span class="dress-card-price">Rs.<?=$sell_price[$price_index]?> &ensp;</span><span class="dress-card-crossed">Rs.<?=$mrp_price[$price_index]?></span><span class="dress-card-off">&ensp;(<?=intval((($mrp_price[$price_index]-$sell_price[$price_index])/$mrp_price[$price_index])*100)?>% OFF)</span>
                        </p>
                      </div>
                    </div>
                  
                </div>
                <?php }  ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php endif;?>
    <!--Shoes gallery section end -->
    <!----------Shoes gallery section start---------->
    <?php if(!empty($shoes)):?>
      <section id="product-gallery">
        <div class="container-fluid product-gallery">
          <div class="row product-header  wow bounceInDown ">
             <div class="col-lg-6 col-sm-8 col-xs-8 product-heading">
               <h4>Shoes</h4>
             </div> 
             <div class="col-lg-6 col-sm-4 col-xs-4">
                <a class="btn common-btn hvr-icon-wobble-horizontal hvr-bounce-to-right" href="<?=base_url('shoes-all')?>" >
                  <span>View all</span>
                  <i class="fa fa-hand-o-right hvr-icon" aria-hidden="true"></i>
                </a>
             </div> 
          </div>
          <div class="container">
            <div class="gallery-wrapper">
              <div class="product-slider">
                <?php foreach($shoes as $shoes_row){?>

                <div class="product-item">
                  
                    <div class="dress-card wow bounceInUp">
                      <div class="dress-card-head">
                        <a class="dress-card-img"target="_blank"   href="<?=base_url('product/'.$discount_shoes_row->slug.'?proid='.$discount_shoes_row->sub_category_id.'_'.$discount_shoes_row->uniqcode)?>">
                          <?php $product_img=unserialize($shoes_row->images); 
                          if(!empty($product_img))
                          {
                              $path=explode("##",$shoes_row->image_link);
                              ?>
                              <img class="dress-card-img-top" src="<?=base_url('webroot/upload/product/').$path[1].'/'.$product_img[0]?>" alt="">
                              <?php
                          }
                          else
                          {
                              ?><img class="dress-card-img-top" src="<?=base_url('webroot/user/images/no_image.jpg')?>"><?php
                          }
                          ?>
                        </a>
                        <?php if($this->session->userdata('loginDetail')!=''){
                            $wishlist_row=$this->User_Model->check_wishlist($shoes_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode)
                          ?> 
                          <div class="surprise-bubble <?= $wishlist_row == 1 ? 'active' : '';?>">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$shoes_row->sub_category_id.'_'.$shoes_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }else{?>
                          <div class="surprise-bubble">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$shoes_row->sub_category_id.'_'.$shoes_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }?>
                        
                      </div>
                      <div class="dress-card-body">
                          <h4 class="dress-card-title"><a href="<?=base_url('shoes-all')?>"><?php
                              $name = strlen($shoes_row->name) > 13 ? substr($shoes_row->name,0,13)."..." : $shoes_row->name;
                              echo $name ;
                              ?></a>
                            </h4>
                          <p class="seller-name"><a href="<?=base_url('shop/'.$shoes_row->admin_id)?>">By:<?=$shoes_row->shop_name?></a></p>
                          <?php 
                            $sell_price=unserialize($shoes_row->sell_price); 
                            $mrp_price=unserialize($shoes_row->mrp_price); 
                            $price_index=$this->Home_Model->home_sell_price($sell_price,$mrp_price);
                          ?>
                       

                        <p class="">
                          <span class="dress-card-price">Rs.<?=$sell_price[$price_index]?> &ensp;</span><span class="dress-card-crossed">Rs.<?=$mrp_price[$price_index]?></span><span class="dress-card-off">&ensp;(<?=intval((($mrp_price[$price_index]-$sell_price[$price_index])/$mrp_price[$price_index])*100)?>% OFF)</span>
                        </p>
                      </div>
                    </div>
                  
                </div>
                <?php }  ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php endif;?>
    <!--Shoes gallery section end -->

    <!-- --------Product offer section start-------- -->
      <section id="product-offer">
        <div class="container-fluid product-offer">
          <div class="row">
            <div class="col-lg-4 col-sm-6 col-xs-6 col-md-4">
              <div class="offer-wrapper wow bounceInDown ">
                <img src="https://rukminim1.flixcart.com/flap/960/960/image/084789479074d2b2.jpg?q=50" alt="image1">
              </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-xs-6 col-md-4">
              <div class="offer-wrapper wow bounceInDown">
                <img src="https://rukminim1.flixcart.com/flap/960/960/image/399c64b61c0e1d00.jpg?q=50" alt="image1">
              </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-xs-6 col-md-4">
              <div class="offer-wrapper wow bounceInDown ">
                <img src="https://rukminim1.flixcart.com/flap/960/960/image/084789479074d2b2.jpg?q=50" alt="image1">
              </div>
            </div>
            
          </div>
        </div>
      </section>
    <!-- Product offer section end -->
     <!----------Clothes gallery section start---------->
    <?php if(!empty($special_care_discount)):?>
      <section id="product-gallery">
        <div class="container-fluid product-gallery">
          <div class="row product-header  wow bounceInDown ">
             <div class="col-lg-6 col-sm-8 col-xs-8 product-heading">
               <h4>Top Discount Of Special Care</h4>
             </div> 
             <div class="col-lg-6 col-sm-4 col-xs-4">
                <a class="btn common-btn hvr-icon-wobble-horizontal hvr-bounce-to-right" href="<?=base_url('special-care-all-discount')?>">
                  <span>View all</span>
                  <i class="fa fa-hand-o-right hvr-icon" aria-hidden="true"></i>
                </a>
             </div> 
          </div>
          <div class="container">
            <div class="gallery-wrapper">
              <div class="product-slider">
                <?php foreach($special_care_discount as $discount_special_care_row){
                    $special_care_row=(object)$discount_special_care_row;
                  ?>

                <div class="product-item">
                  
                    <div class="dress-card wow bounceInUp">
                      <div class="dress-card-head">
                        <a class="dress-card-img"target="_blank" href="<?=base_url('product/'.$special_care_row->slug.'?proid='.$special_care_row->sub_category_id.'_'.$special_care_row->uniqcode)?>">
                          <?php $product_img=unserialize($special_care_row->images); 
                          if(!empty($product_img))
                          {
                              $path=explode("##",$special_care_row->image_link);
                              ?>
                              <img class="dress-card-img-top" src="<?=base_url('webroot/upload/product/').$path[1].'/'.$product_img[0]?>" alt="">
                              <?php
                          }
                          else
                          {
                              ?><img src="<?=base_url('webroot/user/images/no_image.jpg')?>"><?php
                          }
                          ?>
                        </a>
                        <?php if($this->session->userdata('loginDetail')!=''){
                            $wishlist_row=$this->User_Model->check_wishlist($special_care_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode)
                          ?> 
                          <div class="surprise-bubble <?= $wishlist_row == 1 ? 'active' : '';?>">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$special_care_row->sub_category_id.'_'.$special_care_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }else{?>
                          <div class="surprise-bubble">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$special_care_row->sub_category_id.'_'.$special_care_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }?>
                         
                      </div>
                      <div class="dress-card-body">
                          <h4 class="dress-card-title"><a href="<?=base_url('product-discount-all')?>"><?php
                              $name = strlen($special_care_row->name) > 13 ? substr($special_care_row->name,0,13)."..." : $special_care_row->name;
                              echo $name ;
                              ?></a>
                            </h4>
                          <p class="seller-name"><a href="<?=base_url('shop/'.$special_care_row->admin_id)?>">By:<?=$special_care_row->shop_name?></a></p>
                          <?php 
                            $sell_price=unserialize($shoes_row->sell_price); 
                            $mrp_price=unserialize($shoes_row->mrp_price); 
                          ?>
                          <p><span class="dress-card-price">Rs.<?=$sell_price[0]?> &ensp;</span><span class="dress-card-crossed">Rs.<?=$mrp_price[0]?></span><span class="dress-card-off">&ensp;(<?=intval((($mrp_price[0]-$sell_price[0])/$mrp_price[0])*100)?>% OFF)</span></p>
                          
                      </div>
                    </div>
                
                </div>
                <?php }  ?>
              </div>
            </div>
          </div>
        </div>
      </section>
     <?php endif;?>
    <!--Clothes gallery section end -->
    <!----------Clothes gallery section start---------->
    <?php if(!empty($special_care)):?>
      <section id="product-gallery">
        <div class="container-fluid product-gallery">
          <div class="row product-header  wow bounceInDown ">
             <div class="col-lg-6 col-sm-8 col-xs-8 product-heading">
               <h4>Special Care</h4>
             </div> 
             <div class="col-lg-6 col-sm-4 col-xs-4">
                <a class="btn common-btn hvr-icon-wobble-horizontal hvr-bounce-to-right" href="<?=base_url('special-care-all')?>">
                  <span>View all</span>
                  <i class="fa fa-hand-o-right hvr-icon" aria-hidden="true"></i>
                </a>
             </div> 
          </div>
          <div class="container">
            <div class="gallery-wrapper">
              <div class="product-slider">
                <?php foreach($special_care as $special_care_row){?>

                <div class="product-item">
                  
                    <div class="dress-card wow bounceInUp">
                      <div class="dress-card-head">
                        <a class="dress-card-img"target="_blank"  href="<?=base_url('product/'.$special_care_row->slug.'?proid='.$special_care_row->sub_category_id.'_'.$special_care_row->uniqcode)?>">
                          <?php $product_img=unserialize($special_care_row->images); 
                          if(!empty($product_img))
                          {
                              $path=explode("##",$special_care_row->image_link);
                              ?>
                              <img class="dress-card-img-top" src="<?=base_url('webroot/upload/product/').$path[1].'/'.$product_img[0]?>" alt="">
                              <?php
                          }
                          else
                          {
                              ?><img src="<?=base_url('webroot/user/images/no_image.jpg')?>"><?php
                          }
                          ?>
                        </a>
                        <?php if($this->session->userdata('loginDetail')!=''){
                            $wishlist_row=$this->User_Model->check_wishlist($special_care_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode)
                          ?> 
                          <div class="surprise-bubble <?= $wishlist_row == 1 ? 'active' : '';?>">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$special_care_row->sub_category_id.'_'.$special_care_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }else{?>
                          <div class="surprise-bubble">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$special_care_row->sub_category_id.'_'.$special_care_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }?>
                         
                      </div>
                      <div class="dress-card-body">
                          <h4 class="dress-card-title"><a href="<?=base_url('product-discount-all')?>"><?php
                              $name = strlen($special_care_row->name) > 13 ? substr($special_care_row->name,0,13)."..." : $special_care_row->name;
                              echo $name ;
                              ?></a>
                            </h4>
                          <p class="seller-name"><a href="<?=base_url('shop/'.$special_care_row->admin_id)?>">By:<?=$special_care_row->shop_name?></a></p>
                          <?php 
                            $sell_price=unserialize($shoes_row->sell_price); 
                            $mrp_price=unserialize($shoes_row->mrp_price); 
                          ?>
                          <p><span class="dress-card-price">Rs.<?=$sell_price[0]?> &ensp;</span><span class="dress-card-crossed">Rs.<?=$mrp_price[0]?></span><span class="dress-card-off">&ensp;(<?=intval((($mrp_price[0]-$sell_price[0])/$mrp_price[0])*100)?>% OFF)</span></p>
                          
                      </div>
                    </div>
                
                </div>
                <?php }  ?>
              </div>
            </div>
          </div>
        </div>
      </section>
     <?php endif;?>
    <!--Clothes gallery section end -->

    <!-- --------Product offer section start-------- -->
      <section id="product-offer">
        <div class="container-fluid product-offer">
          <div class="row">
            <div class="col-lg-4 col-sm-6 col-xs-6 col-md-4">
              <div class="offer-wrapper wow bounceInDown ">
                <img src="https://rukminim1.flixcart.com/flap/960/960/image/084789479074d2b2.jpg?q=50" alt="image1">
              </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-xs-6 col-md-4">
              <div class="offer-wrapper wow bounceInDown ">
                <img src="https://rukminim1.flixcart.com/flap/960/960/image/399c64b61c0e1d00.jpg?q=50" alt="image1">
              </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-xs-6 col-md-4">
              <div class="offer-wrapper wow bounceInDown ">
                <img src="https://rukminim1.flixcart.com/flap/960/960/image/084789479074d2b2.jpg?q=50" alt="image1">
              </div>
            </div>
          </div>
        </div>
      </section>
    <!-- Product offer section end -->


    <!-- -------Happy customers section start------- -->
      <section id="happy-customers">
        <div class="happy-customers">
          <div class="middle-heading-outer">
            <h2 class="middle-heading"><span></span>Happy Customers</h2>
          </div>

          <div class="container">
            <div class="row happy-customers-innerpart">
              <div class="col-md-6 col-sm-6">
                <div class="user-number wow shake">
                  <div class="ce-smiling-face-with-heart-eyes">
                    <div class="ce-eyes">
                        <div class="ce-eye ce-eye-left"></div>
                        <div class="ce-eye ce-eye-right"></div>
                    </div>
                    <div class="ce-mouth">
                        <div class="ce-teeth"></div>
                    </div>
                  </div>
                  <p class="number-of-user">
                    <span class="counter">10,000</span>
                  </p>
                  <p class="user-desc">
                    Customer service shouldn’t just be a department, it should be the entire company.
                  </p>
                </div>
              </div>
              <div class="col-md-6 col-sm-6">
                <div class="users-massage">
                  <!-- <h3>What user says</h3> -->
                  <div class="massage-slider">
                    <div class="massage-slider-item wow flipInX ">
                      <blockquote>
                        <p>
                            <a href="#">
                                Understanding clients concept and converting his unstructured imagination into a structured reality needs great expertise and patience. I find this quality with "<strong>Bong Bazar</strong>" people. They converted
                                my imagination into reality. No doubt there service is excellent, pro
                            </a>
                        </p>
                      </blockquote>
                      <div class="massage-slider-downarrow"></div>
                      <div class="massage-slider-author">
                        <div class="slider-author-thumbnail">
                          <img src="https://www.rnjcs.in/upload/1/testimonial/1531115276_1361802629-120x120.jpg" alt="">
                        </div>
                        <p><strong>Rahul Poddar</strong><span><a href="http://www.rahuludyog.com/" target="_blank">Rahul Udyog</a></span></p>
                      </div>
                    </div>

                    <div class="massage-slider-item wow flipInX ">
                      <blockquote>
                        <p>
                            <a href="#">
                                Understanding clients concept and converting his unstructured imagination into a structured reality needs great expertise and patience. I find this quality with "<strong>Bong Bazar</strong>" people. They converted
                                my imagination into reality. No doubt there service is excellent, pro
                            </a>
                        </p>
                      </blockquote>
                      <div class="massage-slider-downarrow"></div>
                      <div class="massage-slider-author">
                        <div class="slider-author-thumbnail">
                          <img src="https://www.rnjcs.in/upload/1/testimonial/1531115276_1361802629-120x120.jpg" alt="">
                        </div>
                        <p><strong>Sohel Poddar</strong><span><a href="http://www.rahuludyog.com/" target="_blank">Sohel Udyog</a></span></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    <!-- Happy customers section end -->
    <!-- ----------Banner Section start---------- -->
    <?php if(!empty($banner)):?>

      <section id="banner" class="banner">
        <div class="banner-wrapper bannere">
          <div class="banner-slider banner-area">
            <?php  foreach ($banner as $key => $banner_data) {?>
              <div class="banner-item wow bounceInDown">
                <img src="<?=base_url('webroot/banner/'.$banner_data->image)?>" alt="pic1"/ >
              </div>
            <?php }?> 
          </div>
        </div>
      </section>

    <?php endif;?>
    <!-- Banner Section end -->



   <!-- ------seller gallery section start------ -->
    <?php if(!empty($shop)):?>

      <section id="seller-gallery">
        <div class="seller-gallery">
          <div class="middle-heading-outer wow bounceInDown">
            <h2 class="middle-heading"><span></span>Popular Sellers</h2>
          </div>
          
          <div class="container-fluid">
            <div class="seller-slider">
              <?php foreach($shop as $shop_row){?>
              <div class="slide-item wow flip">
                <a href="<?=base_url('shop/'.$shop_row->uniqcode)?>">
                  <img src="<?=base_url('webroot/admin/shop_image/'.$shop_row->shop_image)?>">
                  <p class="store-name"><?=$shop_row->shop_name?></p>
                </a>
              </div>
              <?php }?>
              
            </div>
          </div>

          <div class="view-all">
            <a class="btn hvr-bounce-to-right btn-expand hvr-icon-pulse-grow" href="<?=base_url('all-shop')?>">
              View all sellers
              <i class="fa fa-user-circle-o hvr-icon" aria-hidden="true"></i>
            </a>
          </div>
        </div>
      </section>
    <?php endif;?>

    <!-- Seller gallery section end -->
     <!----------Clothes gallery section start---------->
    <?php if(!empty($clothing_discount)):?>
      <section id="product-gallery">
        <div class="container-fluid product-gallery">
          <div class="row product-header  wow bounceInDown ">
             <div class="col-lg-6 col-sm-8 col-xs-8 product-heading">
               <h4>Top Discount Of Clothes</h4>
             </div> 
             <div class="col-lg-6 col-sm-4 col-xs-4">
                <a class="btn common-btn hvr-icon-wobble-horizontal hvr-bounce-to-right" href="<?=base_url('clothing-all-discount')?>">
                  <span>View all</span>
                  <i class="fa fa-hand-o-right hvr-icon" aria-hidden="true"></i>
                </a>
             </div> 
          </div>
          <div class="container">
            <div class="gallery-wrapper">
              <div class="product-slider">
                <?php foreach($clothing_discount as $discount_clothing_row){
                    $clothing_row=(object)$discount_clothing_row;
                  ?>

                <div class="product-item">
                  
                    <div class="dress-card wow bounceInUp">
                      <div class="dress-card-head">
                        <a class="dress-card-img" target="_blank" href="<?=base_url('product/'.$clothing_row->slug.'?proid='.$clothing_row->sub_category_id.'_'.$clothing_row->uniqcode)?>">
                          <?php $product_img=unserialize($clothing_row->images); 
                          if(!empty($product_img))
                          {
                              $path=explode("##",$clothing_row->image_link);
                             
                              ?>
                              <img class="dress-card-img-top" src="<?=base_url('webroot/upload/product/').$path[1].'/'.$product_img[0]?>" alt="">
                              <?php
                          }
                          else
                          {
                              ?><img src="<?=base_url('webroot/user/images/no_image.jpg')?>"><?php
                          }
                          ?>
                        </a>
                        <?php if($this->session->userdata('loginDetail')!=''){
                            $wishlist_row=$this->User_Model->check_wishlist($clothing_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode)
                          ?> 
                          <div class="surprise-bubble <?= $wishlist_row == 1 ? 'active' : '';?>">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$clothing_row->sub_category_id.'_'.$clothing_row->uniqcode?>')" >Wishlist</span></p>
                          </div>
                        <?php }else{?>
                          <div class="surprise-bubble">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$clothing_row->sub_category_id.'_'.$clothing_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }?>
                      </div>
                      <div class="dress-card-body">
                          <h4 class="dress-card-title"><a href="<?=base_url('product-discount-all')?>"><?php
                              $name = strlen($clothing_row->name) > 13 ? substr($clothing_row->name,0,13)."..." : $clothing_row->name;
                              echo $name ;
                              ?></a>
                            </h4>
                          <p class="seller-name"><a href="<?=base_url('shop/'.$clothing_rowadmin_id)?>">By:<?=$clothing_row->shop_name?></a></p>
                          <?php 
                            $sell_price=unserialize($clothing_row->sell_price); 
                            $mrp_price=unserialize($clothing_row->mrp_price); 
                            $price_index=$this->Home_Model->home_sell_price($sell_price,$mrp_price);
                          ?>
                       

                        <p class="">
                          <span class="dress-card-price">Rs.<?=$sell_price[$price_index]?> &ensp;</span><span class="dress-card-crossed">Rs.<?=$mrp_price[$price_index]?></span><span class="dress-card-off">&ensp;(<?=intval((($mrp_price[$price_index]-$sell_price[$price_index])/$mrp_price[$price_index])*100)?>% OFF)</span>
                        </p>
                      </div>
                    </div>
                  
                </div>
                <?php }  ?>
              </div>
            </div>
          </div>
        </div>
      </section>
     <?php endif;?>
    <!--Clothes gallery section end -->

    <!----------Clothes gallery section start---------->
    <?php if(!empty($clothing)):?>
      <section id="product-gallery">
        <div class="container-fluid product-gallery">
          <div class="row product-header  wow bounceInDown ">
             <div class="col-lg-6 col-sm-8 col-xs-8 product-heading">
               <h4>Clothes</h4>
             </div> 
             <div class="col-lg-6 col-sm-4 col-xs-4">
                <a class="btn common-btn hvr-icon-wobble-horizontal hvr-bounce-to-right" href="<?=base_url('clothing-all')?>">
                  <span>View all</span>
                  <i class="fa fa-hand-o-right hvr-icon" aria-hidden="true"></i>
                </a>
             </div> 
          </div>
          <div class="container">
            <div class="gallery-wrapper">
              <div class="product-slider">
                <?php foreach($clothing as $clothing_row){?>

                <div class="product-item">
                  
                    <div class="dress-card wow bounceInUp">
                      <div class="dress-card-head">
                        <a class="dress-card-img" target="_blank" href="<?=base_url('product/'.$clothing_row->slug.'?proid='.$clothing_row->sub_category_id.'_'.$clothing_row->uniqcode)?>">
                          <?php $product_img=unserialize($clothing_row->images); 
                          if(!empty($product_img))
                          {
                              $path=explode("##",$clothing_row->image_link);
                              ?>
                              <img class="dress-card-img-top" src="<?=base_url('webroot/upload/product/').$path[1].'/'.$product_img[0]?>" alt="">
                              <?php
                          }
                          else
                          {
                              ?><img src="<?=base_url('webroot/user/images/no_image.jpg')?>"><?php
                          }
                          ?>
                        </a>
                        <?php if($this->session->userdata('loginDetail')!=''){
                            $wishlist_row=$this->User_Model->check_wishlist($clothing_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode)
                          ?> 
                          <div class="surprise-bubble <?= $wishlist_row == 1 ? 'active' : '';?>">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$clothing_row->sub_category_id.'_'.$clothing_row->uniqcode?>')" >Wishlist</span></p>
                          </div>
                        <?php }else{?>
                          <div class="surprise-bubble">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$clothing_row->sub_category_id.'_'.$clothing_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }?>
                      </div>
                      <div class="dress-card-body">
                          <h4 class="dress-card-title"><a href="<?=base_url('product-discount-all')?>"><?php
                              $name = strlen($clothing_row->name) > 13 ? substr($clothing_row->name,0,13)."..." : $clothing_row->name;
                              echo $name ;
                              ?></a>
                            </h4>
                          <p class="seller-name"><a href="<?=base_url('shop/'.$clothing_rowadmin_id)?>">By:<?=$clothing_row->shop_name?></a></p>
                          <?php 
                            $sell_price=unserialize($clothing_row->sell_price); 
                            $mrp_price=unserialize($clothing_row->mrp_price); 
                            $price_index=$this->Home_Model->home_sell_price($sell_price,$mrp_price);
                          ?>
                       

                        <p class="">
                          <span class="dress-card-price">Rs.<?=$sell_price[$price_index]?> &ensp;</span><span class="dress-card-crossed">Rs.<?=$mrp_price[$price_index]?></span><span class="dress-card-off">&ensp;(<?=intval((($mrp_price[$price_index]-$sell_price[$price_index])/$mrp_price[$price_index])*100)?>% OFF)</span>
                        </p>
                      </div>
                    </div>
                  
                </div>
                <?php }  ?>
              </div>
            </div>
          </div>
        </div>
      </section>
     <?php endif;?>
    <!--Clothes gallery section end -->

    <!-- ------seller gallery section start------ -->
    <?php if(!empty($shop)):?>

      <section id="seller-gallery">
        <div class="seller-gallery extra-tag">
          <div class="middle-heading-outer wow bounceInDown">
            <h2 class="middle-heading"><span></span>Best in Bong Bazar</h2>
          </div>
          
          <div class="container-fluid">
            <div class="seller-slider">
              <?php foreach($shop as $shop_row){?>
              <div class="slide-item wow fadeInLeft">
                <span class="ribbon16">BEST</span>
               <a href="<?=base_url('shop/'.$shop_row->uniqcode)?>">
                  <img src="<?=base_url('webroot/admin/shop_image/'.$shop_row->shop_image)?>">
                  <p class="store-name"><?=$shop_row->shop_name?></p>
                </a>
              </div>
              <?php }?>

            </div>
          </div>

          <div class="view-all">
            <a class="btn hvr-bounce-to-right btn-expand hvr-icon-pulse-grow" href="<?=base_url('all-shop')?>">
              View all sellers
              <i class="fa fa-user-circle-o hvr-icon" aria-hidden="true"></i>
            </a>
          </div>
        </div>
      </section>
    <?php endif;?>

    <!-- Seller gallery section end -->
    <!----------Accessories gallery section start---------->
    <?php if(!empty($accessories_discount)):?>
      <section id="product-gallery">
        <div class="container-fluid product-gallery">
          <div class="row product-header  wow bounceInDown ">
             <div class="col-lg-6 col-sm-8 col-xs-8 product-heading">
               <h4>To Discount Of Accessories</h4>
             </div> 
             <div class="col-lg-6 col-sm-4 col-xs-4">
                <a class="btn common-btn hvr-icon-wobble-horizontal hvr-bounce-to-right" href="<?=base_url('accessories-all-discount')?>">
                  <span>View all</span>
                  <i class="fa fa-hand-o-right hvr-icon" aria-hidden="true"></i>
                </a>
             </div> 
          </div>
          <div class="container">
            <div class="gallery-wrapper">
              <div class="product-slider">
                <?php foreach($accessories_discount as $discount_accessories_row){
                    $accessories_row=(object)$discount_accessories_row;
                  ?>

                <div class="product-item">
                  
                    <div class="dress-card wow bounceInUp">
                      <div class="dress-card-head">
                        <a class="dress-card-img" target="_blank" href="<?=base_url('product/'.$accessories_row->slug.'?proid='.$accessories_row->sub_category_id.'_'.$accessories_row->uniqcode)?>">
                          <?php $product_img=unserialize($accessories_row->images); 
                          if(!empty($product_img))
                          {
                              $path=explode("##",$accessories_row->image_link);
                              ?>
                              <img class="dress-card-img-top" src="<?=base_url('webroot/upload/product/').$path[1].'/'.$product_img[0]?>" alt="">
                              <?php
                          }
                          else
                          {
                              ?><img class="dress-card-img-top" src="<?=base_url('webroot/user/images/no_image.jpg')?>"><?php
                          }
                          ?>
                        </a>
                         <?php if($this->session->userdata('loginDetail')!=''){
                            $wishlist_row=$this->User_Model->check_wishlist($accessories_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode)
                          ?> 
                          <div class="surprise-bubble <?= $wishlist_row == 1 ? 'active' : '';?>">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$accessories_row->sub_category_id.'_'.$accessories_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }else{?>
                          <div class="surprise-bubble">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$accessories_row->sub_category_id.'_'.$accessories_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }?>
                  
                      </div>
                      <div class="dress-card-body">
                          <h4 class="dress-card-title"><a href="<?=base_url('accessories-all')?>"><?php
                              $name = strlen($accessories_row->name) > 13 ? substr($accessories_row->name,0,13)."..." : $accessories_row->name;
                              echo $name ;
                              ?></a>
                            </h4>
                          <p class="seller-name"><a href="<?=base_url('shop/'.$accessories_row->admin_id)?>">By:<?=$accessories_row->shop_name?></a></p>
                          <?php 
                            $sell_price=unserialize($accessories_row->sell_price); 
                            $mrp_price=unserialize($accessories_row->mrp_price); 
                            $price_index=$this->Home_Model->home_sell_price($sell_price,$mrp_price);
                          ?>
                       

                        <p class="">
                          <span class="dress-card-price">Rs.<?=$sell_price[$price_index]?> &ensp;</span><span class="dress-card-crossed">Rs.<?=$mrp_price[$price_index]?></span><span class="dress-card-off">&ensp;(<?=intval((($mrp_price[$price_index]-$sell_price[$price_index])/$mrp_price[$price_index])*100)?>% OFF)</span>
                        </p>
                        
                      </div>
                    </div>
                  
                </div>
                <?php }  ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php endif;?>
    <!--Accessories gallery section en

    <!----------Accessories gallery section start---------->
    <?php if(!empty($accessories)):?>
      <section id="product-gallery">
        <div class="container-fluid product-gallery">
          <div class="row product-header  wow bounceInDown ">
             <div class="col-lg-6 col-sm-8 col-xs-8 product-heading">
               <h4>Accessories</h4>
             </div> 
             <div class="col-lg-6 col-sm-4 col-xs-4">
                <a class="btn common-btn hvr-icon-wobble-horizontal hvr-bounce-to-right" href="<?=base_url('accessories-all')?>">
                  <span>View all</span>
                  <i class="fa fa-hand-o-right hvr-icon" aria-hidden="true"></i>
                </a>
             </div> 
          </div>
          <div class="container">
            <div class="gallery-wrapper">
              <div class="product-slider">
                <?php foreach($accessories as $accessories_row){?>

                <div class="product-item">
                  
                    <div class="dress-card wow bounceInUp">
                      <div class="dress-card-head">
                        <a class="dress-card-img" target="_blank" href="<?=base_url('product/'.$accessories_row->slug.'?proid='.$accessories_row->sub_category_id.'_'.$accessories_row->uniqcode)?>">
                          <?php $product_img=unserialize($accessories_row->images); 
                          if(!empty($product_img))
                          {
                              $path=explode("##",$accessories_row->image_link);
                              ?>
                              <img class="dress-card-img-top" src="<?=base_url('webroot/upload/product/').$path[1].'/'.$product_img[0]?>" alt="">
                              <?php
                          }
                          else
                          {
                              ?><img class="dress-card-img-top" src="<?=base_url('webroot/user/images/no_image.jpg')?>"><?php
                          }
                          ?>
                        </a>
                         <?php if($this->session->userdata('loginDetail')!=''){
                            $wishlist_row=$this->User_Model->check_wishlist($accessories_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode)
                          ?> 
                          <div class="surprise-bubble <?= $wishlist_row == 1 ? 'active' : '';?>">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$accessories_row->sub_category_id.'_'.$accessories_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }else{?>
                          <div class="surprise-bubble">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$accessories_row->sub_category_id.'_'.$accessories_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }?>
                  
                      </div>
                      <div class="dress-card-body">
                          <h4 class="dress-card-title"><a href="<?=base_url('accessories-all')?>"><?php
                              $name = strlen($accessories_row->name) > 13 ? substr($accessories_row->name,0,13)."..." : $accessories_row->name;
                              echo $name ;
                              ?></a>
                            </h4>
                          <p class="seller-name"><a href="<?=base_url('shop/'.$accessories_row->admin_id)?>">By:<?=$accessories_row->shop_name?></a></p>
                          <?php 
                            $sell_price=unserialize($accessories_row->sell_price); 
                            $mrp_price=unserialize($accessories_row->mrp_price); 
                            $price_index=$this->Home_Model->home_sell_price($sell_price,$mrp_price);
                          ?>
                       

                        <p class="">
                          <span class="dress-card-price">Rs.<?=$sell_price[$price_index]?> &ensp;</span><span class="dress-card-crossed">Rs.<?=$mrp_price[$price_index]?></span><span class="dress-card-off">&ensp;(<?=intval((($mrp_price[$price_index]-$sell_price[$price_index])/$mrp_price[$price_index])*100)?>% OFF)</span>
                        </p>
                        
                      </div>
                    </div>
                  
                </div>
                <?php }  ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php endif;?>
    <!--Accessories gallery section end -->

    <!-- ------------About orders start------------ -->
      <section id="about-orders">
        <div class="about-orders">
          <div class="container-fluid">
            <div class="col-md-3 col-sm-6">
              <div class="section-underpart">
                <div class="img-part">
                  <img class="wow flipInX" src="<?=base_url()?>webroot/user/images/payment.png">
                </div>
                <p class="about-order-heading wow pulse">Secure Payment</p>
                <p class="about-order-desc wow pulse">Order in for yourself or for the family, with no restrictions on order value.</p>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="section-underpart">
                <div class="img-part">
                  <img class="wow flipInX" src="<?=base_url()?>webroot/user/images/Transport.webp">
                  <p class="about-order-heading wow pulse">Faster delivery</p>
                  <p class="about-order-desc wow pulse">Experience Bong Bazar superfast delivery for your delivered order & on time</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="section-underpart">
                <div class="img-part">
                  <img class="wow flipInX" src="<?=base_url()?>webroot/user/images/cash-on-delivery.jpg">
                   <p class="about-order-heading wow pulse">Cash on delivery</p>
                   <p class="about-order-desc wow pulse">You can pay your product amount on delivery time.</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="section-underpart">
                <div class="img-part">
                  <img class="wow flipInX" src="<?=base_url()?>webroot/user/images/24-7-service.png">
                   <p class="about-order-heading wow pulse">Always Support</p>
                   <p class="about-order-desc wow pulse">We are ready to help you 24/7.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    <!-- About orders end -->
     <!----------Shoes gallery section start---------->
    <?php if(!empty($shoes_discount)):?>
      <section id="product-gallery">
        <div class="container-fluid product-gallery">
          <div class="row product-header  wow bounceInDown ">
             <div class="col-lg-6 col-sm-8 col-xs-8 product-heading">
               <h4>Top Discount Of Shoes</h4>
             </div> 
             <div class="col-lg-6 col-sm-4 col-xs-4">
                <a class="btn common-btn hvr-icon-wobble-horizontal hvr-bounce-to-right" href="<?=base_url('shoes-all-discount')?>" >
                  <span>View all</span>
                  <i class="fa fa-hand-o-right hvr-icon" aria-hidden="true"></i>
                </a>
             </div> 
          </div>
          <div class="container">
            <div class="gallery-wrapper">
              <div class="product-slider">
                <?php foreach($shoes_discount as $discount_shoes_row){
                    $shoes_row=(object)$discount_shoes_row;
                  ?>

                <div class="product-item">
                  
                    <div class="dress-card wow bounceInUp">
                      <div class="dress-card-head">
                        <a class="dress-card-img"target="_blank" href="<?=base_url('product/'.$discount_shoes_row->slug.'?proid='.$discount_shoes_row->sub_category_id.'_'.$discount_shoes_row->uniqcode)?>">
                          <?php $product_img=unserialize($shoes_row->images); 
                          if(!empty($product_img))
                          {
                              $path=explode("##",$shoes_row->image_link);
                              ?>
                              <img class="dress-card-img-top" src="<?=base_url('webroot/upload/product/').$path[1].'/'.$product_img[0]?>" alt="">
                              <?php
                          }
                          else
                          {
                              ?><img class="dress-card-img-top" src="<?=base_url('webroot/user/images/no_image.jpg')?>"><?php
                          }
                          ?>
                        </a>
                        <?php if($this->session->userdata('loginDetail')!=''){
                            $wishlist_row=$this->User_Model->check_wishlist($shoes_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode)
                          ?> 
                          <div class="surprise-bubble <?= $wishlist_row == 1 ? 'active' : '';?>">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$shoes_row->sub_category_id.'_'.$shoes_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }else{?>
                          <div class="surprise-bubble">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$shoes_row->sub_category_id.'_'.$shoes_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }?>
                        
                      </div>
                      <div class="dress-card-body">
                          <h4 class="dress-card-title"><a href="<?=base_url('shoes-all')?>"><?php
                              $name = strlen($shoes_row->name) > 13 ? substr($shoes_row->name,0,13)."..." : $shoes_row->name;
                              echo $name ;
                              ?></a>
                            </h4>
                          <p class="seller-name"><a href="<?=base_url('shop/'.$shoes_row->admin_id)?>">By:<?=$shoes_row->shop_name?></a></p>
                          <?php 
                            $sell_price=unserialize($shoes_row->sell_price); 
                            $mrp_price=unserialize($shoes_row->mrp_price); 
                            $price_index=$this->Home_Model->home_sell_price($sell_price,$mrp_price);
                          ?>
                       

                        <p class="">
                          <span class="dress-card-price">Rs.<?=$sell_price[$price_index]?> &ensp;</span><span class="dress-card-crossed">Rs.<?=$mrp_price[$price_index]?></span><span class="dress-card-off">&ensp;(<?=intval((($mrp_price[$price_index]-$sell_price[$price_index])/$mrp_price[$price_index])*100)?>% OFF)</span>
                        </p>
                      </div>
                    </div>
                  
                </div>
                <?php }  ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php endif;?>
    <!--Shoes gallery section end -->
    <!----------Shoes gallery section start---------->
    <?php if(!empty($shoes)):?>
      <section id="product-gallery">
        <div class="container-fluid product-gallery">
          <div class="row product-header  wow bounceInDown ">
             <div class="col-lg-6 col-sm-8 col-xs-8 product-heading">
               <h4>Shoes</h4>
             </div> 
             <div class="col-lg-6 col-sm-4 col-xs-4">
                <a class="btn common-btn hvr-icon-wobble-horizontal hvr-bounce-to-right" href="<?=base_url('shoes-all')?>" >
                  <span>View all</span>
                  <i class="fa fa-hand-o-right hvr-icon" aria-hidden="true"></i>
                </a>
             </div> 
          </div>
          <div class="container">
            <div class="gallery-wrapper">
              <div class="product-slider">
                <?php foreach($shoes as $shoes_row){?>

                <div class="product-item">
                  
                    <div class="dress-card wow bounceInUp">
                      <div class="dress-card-head">
                        <a class="dress-card-img"target="_blank"   href="<?=base_url('product/'.$discount_shoes_row->slug.'?proid='.$discount_shoes_row->sub_category_id.'_'.$discount_shoes_row->uniqcode)?>">
                          <?php $product_img=unserialize($shoes_row->images); 
                          if(!empty($product_img))
                          {
                              $path=explode("##",$shoes_row->image_link);
                              ?>
                              <img class="dress-card-img-top" src="<?=base_url('webroot/upload/product/').$path[1].'/'.$product_img[0]?>" alt="">
                              <?php
                          }
                          else
                          {
                              ?><img class="dress-card-img-top" src="<?=base_url('webroot/user/images/no_image.jpg')?>"><?php
                          }
                          ?>
                        </a>
                        <?php if($this->session->userdata('loginDetail')!=''){
                            $wishlist_row=$this->User_Model->check_wishlist($shoes_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode)
                          ?> 
                          <div class="surprise-bubble <?= $wishlist_row == 1 ? 'active' : '';?>">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$shoes_row->sub_category_id.'_'.$shoes_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }else{?>
                          <div class="surprise-bubble">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$shoes_row->sub_category_id.'_'.$shoes_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }?>
                        
                      </div>
                      <div class="dress-card-body">
                          <h4 class="dress-card-title"><a href="<?=base_url('shoes-all')?>"><?php
                              $name = strlen($shoes_row->name) > 13 ? substr($shoes_row->name,0,13)."..." : $shoes_row->name;
                              echo $name ;
                              ?></a>
                            </h4>
                          <p class="seller-name"><a href="<?=base_url('shop/'.$shoes_row->admin_id)?>">By:<?=$shoes_row->shop_name?></a></p>
                          <?php 
                            $sell_price=unserialize($shoes_row->sell_price); 
                            $mrp_price=unserialize($shoes_row->mrp_price); 
                            $price_index=$this->Home_Model->home_sell_price($sell_price,$mrp_price);
                          ?>
                       

                        <p class="">
                          <span class="dress-card-price">Rs.<?=$sell_price[$price_index]?> &ensp;</span><span class="dress-card-crossed">Rs.<?=$mrp_price[$price_index]?></span><span class="dress-card-off">&ensp;(<?=intval((($mrp_price[$price_index]-$sell_price[$price_index])/$mrp_price[$price_index])*100)?>% OFF)</span>
                        </p>
                      </div>
                    </div>
                  
                </div>
                <?php }  ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php endif;?>
    <!--Shoes gallery section end -->

    <!-- --------Product offer section start-------- -->
      <section id="product-offer">
        <div class="container-fluid product-offer">
          <div class="row">
            <div class="col-lg-4 col-sm-6 col-xs-6 col-md-4">
              <div class="offer-wrapper wow bounceInDown ">
                <img src="https://rukminim1.flixcart.com/flap/960/960/image/084789479074d2b2.jpg?q=50" alt="image1">
              </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-xs-6 col-md-4">
              <div class="offer-wrapper wow bounceInDown">
                <img src="https://rukminim1.flixcart.com/flap/960/960/image/399c64b61c0e1d00.jpg?q=50" alt="image1">
              </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-xs-6 col-md-4">
              <div class="offer-wrapper wow bounceInDown ">
                <img src="https://rukminim1.flixcart.com/flap/960/960/image/084789479074d2b2.jpg?q=50" alt="image1">
              </div>
            </div>
            
          </div>
        </div>
      </section>
    <!-- Product offer section end -->
     <!----------Clothes gallery section start---------->
    <?php if(!empty($special_care_discount)):?>
      <section id="product-gallery">
        <div class="container-fluid product-gallery">
          <div class="row product-header  wow bounceInDown ">
             <div class="col-lg-6 col-sm-8 col-xs-8 product-heading">
               <h4>Top Discount Of Special Care</h4>
             </div> 
             <div class="col-lg-6 col-sm-4 col-xs-4">
                <a class="btn common-btn hvr-icon-wobble-horizontal hvr-bounce-to-right" href="<?=base_url('special-care-all-discount')?>">
                  <span>View all</span>
                  <i class="fa fa-hand-o-right hvr-icon" aria-hidden="true"></i>
                </a>
             </div> 
          </div>
          <div class="container">
            <div class="gallery-wrapper">
              <div class="product-slider">
                <?php foreach($special_care_discount as $discount_special_care_row){
                    $special_care_row=(object)$discount_special_care_row;
                  ?>

                <div class="product-item">
                  
                    <div class="dress-card wow bounceInUp">
                      <div class="dress-card-head">
                        <a class="dress-card-img"target="_blank" href="<?=base_url('product/'.$special_care_row->slug.'?proid='.$special_care_row->sub_category_id.'_'.$special_care_row->uniqcode)?>">
                          <?php $product_img=unserialize($special_care_row->images); 
                          if(!empty($product_img))
                          {
                              $path=explode("##",$special_care_row->image_link);
                              ?>
                              <img class="dress-card-img-top" src="<?=base_url('webroot/upload/product/').$path[1].'/'.$product_img[0]?>" alt="">
                              <?php
                          }
                          else
                          {
                              ?><img src="<?=base_url('webroot/user/images/no_image.jpg')?>"><?php
                          }
                          ?>
                        </a>
                        <?php if($this->session->userdata('loginDetail')!=''){
                            $wishlist_row=$this->User_Model->check_wishlist($special_care_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode)
                          ?> 
                          <div class="surprise-bubble <?= $wishlist_row == 1 ? 'active' : '';?>">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$special_care_row->sub_category_id.'_'.$special_care_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }else{?>
                          <div class="surprise-bubble">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$special_care_row->sub_category_id.'_'.$special_care_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }?>
                         
                      </div>
                      <div class="dress-card-body">
                          <h4 class="dress-card-title"><a href="<?=base_url('product-discount-all')?>"><?php
                              $name = strlen($special_care_row->name) > 13 ? substr($special_care_row->name,0,13)."..." : $special_care_row->name;
                              echo $name ;
                              ?></a>
                            </h4>
                          <p class="seller-name"><a href="<?=base_url('shop/'.$special_care_row->admin_id)?>">By:<?=$special_care_row->shop_name?></a></p>
                          <?php 
                            $sell_price=unserialize($shoes_row->sell_price); 
                            $mrp_price=unserialize($shoes_row->mrp_price); 
                          ?>
                          <p><span class="dress-card-price">Rs.<?=$sell_price[0]?> &ensp;</span><span class="dress-card-crossed">Rs.<?=$mrp_price[0]?></span><span class="dress-card-off">&ensp;(<?=intval((($mrp_price[0]-$sell_price[0])/$mrp_price[0])*100)?>% OFF)</span></p>
                          
                      </div>
                    </div>
                
                </div>
                <?php }  ?>
              </div>
            </div>
          </div>
        </div>
      </section>
     <?php endif;?>
    <!--Clothes gallery section end -->
    <!----------Clothes gallery section start---------->
    <?php if(!empty($special_care)):?>
      <section id="product-gallery">
        <div class="container-fluid product-gallery">
          <div class="row product-header  wow bounceInDown ">
             <div class="col-lg-6 col-sm-8 col-xs-8 product-heading">
               <h4>Special Care</h4>
             </div> 
             <div class="col-lg-6 col-sm-4 col-xs-4">
                <a class="btn common-btn hvr-icon-wobble-horizontal hvr-bounce-to-right" href="<?=base_url('special-care-all')?>">
                  <span>View all</span>
                  <i class="fa fa-hand-o-right hvr-icon" aria-hidden="true"></i>
                </a>
             </div> 
          </div>
          <div class="container">
            <div class="gallery-wrapper">
              <div class="product-slider">
                <?php foreach($special_care as $special_care_row){?>

                <div class="product-item">
                  
                    <div class="dress-card wow bounceInUp">
                      <div class="dress-card-head">
                        <a class="dress-card-img"target="_blank"  href="<?=base_url('product/'.$special_care_row->slug.'?proid='.$special_care_row->sub_category_id.'_'.$special_care_row->uniqcode)?>">
                          <?php $product_img=unserialize($special_care_row->images); 
                          if(!empty($product_img))
                          {
                              $path=explode("##",$special_care_row->image_link);
                              ?>
                              <img class="dress-card-img-top" src="<?=base_url('webroot/upload/product/').$path[1].'/'.$product_img[0]?>" alt="">
                              <?php
                          }
                          else
                          {
                              ?><img src="<?=base_url('webroot/user/images/no_image.jpg')?>"><?php
                          }
                          ?>
                        </a>
                        <?php if($this->session->userdata('loginDetail')!=''){
                            $wishlist_row=$this->User_Model->check_wishlist($special_care_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode)
                          ?> 
                          <div class="surprise-bubble <?= $wishlist_row == 1 ? 'active' : '';?>">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$special_care_row->sub_category_id.'_'.$special_care_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }else{?>
                          <div class="surprise-bubble">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$special_care_row->sub_category_id.'_'.$special_care_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }?>
                         
                      </div>
                      <div class="dress-card-body">
                          <h4 class="dress-card-title"><a href="<?=base_url('product-discount-all')?>"><?php
                              $name = strlen($special_care_row->name) > 13 ? substr($special_care_row->name,0,13)."..." : $special_care_row->name;
                              echo $name ;
                              ?></a>
                            </h4>
                          <p class="seller-name"><a href="<?=base_url('shop/'.$special_care_row->admin_id)?>">By:<?=$special_care_row->shop_name?></a></p>
                          <?php 
                            $sell_price=unserialize($shoes_row->sell_price); 
                            $mrp_price=unserialize($shoes_row->mrp_price); 
                          ?>
                          <p><span class="dress-card-price">Rs.<?=$sell_price[0]?> &ensp;</span><span class="dress-card-crossed">Rs.<?=$mrp_price[0]?></span><span class="dress-card-off">&ensp;(<?=intval((($mrp_price[0]-$sell_price[0])/$mrp_price[0])*100)?>% OFF)</span></p>
                          
                      </div>
                    </div>
                
                </div>
                <?php }  ?>
              </div>
            </div>
          </div>
        </div>
      </section>
     <?php endif;?>
    <!--Clothes gallery section end -->

        <!-- --------Product offer section start-------- -->
      <section id="product-offer">
        <div class="container-fluid product-offer">
          <div class="row">
            <div class="col-lg-4 col-sm-6 col-xs-6 col-md-4">
              <div class="offer-wrapper wow bounceInDown ">
                <img src="https://rukminim1.flixcart.com/flap/960/960/image/084789479074d2b2.jpg?q=50" alt="image1">
              </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-xs-6 col-md-4">
              <div class="offer-wrapper wow bounceInDown ">
                <img src="https://rukminim1.flixcart.com/flap/960/960/image/399c64b61c0e1d00.jpg?q=50" alt="image1">
              </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-xs-6 col-md-4">
              <div class="offer-wrapper wow bounceInDown ">
                <img src="https://rukminim1.flixcart.com/flap/960/960/image/084789479074d2b2.jpg?q=50" alt="image1">
              </div>
            </div>
          </div>
        </div>
      </section>
    <!-- Product offer section end -->


    <!-- -------Happy customers section start------- -->
      <section id="happy-customers">
        <div class="happy-customers">
          <div class="middle-heading-outer">
            <h2 class="middle-heading"><span></span>Happy Customers</h2>
          </div>

          <div class="container">
            <div class="row happy-customers-innerpart">
              <div class="col-md-6 col-sm-6">
                <div class="user-number wow shake">
                  <div class="ce-smiling-face-with-heart-eyes">
                    <div class="ce-eyes">
                        <div class="ce-eye ce-eye-left"></div>
                        <div class="ce-eye ce-eye-right"></div>
                    </div>
                    <div class="ce-mouth">
                        <div class="ce-teeth"></div>
                    </div>
                  </div>
                  <p class="number-of-user">
                    <span class="counter">10,000</span>
                  </p>
                  <p class="user-desc">
                    Customer service shouldn’t just be a department, it should be the entire company.
                  </p>
                </div>
              </div>
              <div class="col-md-6 col-sm-6">
                <div class="users-massage">
                  <!-- <h3>What user says</h3> -->
                  <div class="massage-slider">
                    <div class="massage-slider-item wow flipInX ">
                      <blockquote>
                        <p>
                            <a href="#">
                                Understanding clients concept and converting his unstructured imagination into a structured reality needs great expertise and patience. I find this quality with "<strong>Bong Bazar</strong>" people. They converted
                                my imagination into reality. No doubt there service is excellent, pro
                            </a>
                        </p>
                      </blockquote>
                      <div class="massage-slider-downarrow"></div>
                      <div class="massage-slider-author">
                        <div class="slider-author-thumbnail">
                          <img src="https://www.rnjcs.in/upload/1/testimonial/1531115276_1361802629-120x120.jpg" alt="">
                        </div>
                        <p><strong>Rahul Poddar</strong><span><a href="http://www.rahuludyog.com/" target="_blank">Rahul Udyog</a></span></p>
                      </div>
                    </div>

                    <div class="massage-slider-item wow flipInX ">
                      <blockquote>
                        <p>
                            <a href="#">
                                Understanding clients concept and converting his unstructured imagination into a structured reality needs great expertise and patience. I find this quality with "<strong>Bong Bazar</strong>" people. They converted
                                my imagination into reality. No doubt there service is excellent, pro
                            </a>
                        </p>
                      </blockquote>
                      <div class="massage-slider-downarrow"></div>
                      <div class="massage-slider-author">
                        <div class="slider-author-thumbnail">
                          <img src="https://www.rnjcs.in/upload/1/testimonial/1531115276_1361802629-120x120.jpg" alt="">
                        </div>
                        <p><strong>Sohel Poddar</strong><span><a href="http://www.rahuludyog.com/" target="_blank">Sohel Udyog</a></span></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    <!-- Happy customers section end -->




