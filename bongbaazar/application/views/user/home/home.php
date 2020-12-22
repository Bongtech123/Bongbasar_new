
    <!-- ----------Banner Section start---------- -->
    <?php if(!empty($banner)):?>

      <section id="banner" class="banner">
        <div class="banner-wrapper bannere">
          <div class="banner-slider banner-area">
            <?php  foreach ($banner as $key => $banner_data) {?>
              <div class="banner-item wow bounceInDown">
                <img src="<?=base_url('webroot/super_admin/banner/'.$banner_data->image)?>" alt="pic1"/ >
              </div>
            <?php }?> 
          </div>
        </div>
      </section>

    <?php endif;?>
    <!-- Banner Section end -->

    
    <!----------Low to high gallery section start---------->
    <?php if(!empty($low_to_high)){?>
      <section id="product-gallery">
        <div class="container-fluid product-gallery">
          <div class="row product-header  wow bounceInDown ">
             <div class="col-lg-6 col-sm-8 col-xs-8 product-heading">
               <h4>Product Price Low To Heigh</h4>
             </div> 
             <div class="col-lg-6 col-sm-4 col-xs-4">
                <a class="btn common-btn hvr-icon-wobble-horizontal hvr-bounce-to-right" href="<?=base_url('product-low-to-high-all')?>">
                  <span>View all</span>
                  <i class="fa fa-hand-o-right hvr-icon" aria-hidden="true"></i>
                </a>
             </div> 
          </div>
          <div class="container">
            <div class="gallery-wrapper">
              <div class="product-slider">
                <?php foreach($low_to_high as $low_to_high_row){?>

                <div class="product-item">
                  
                    <div class="dress-card wow bounceInUp">
                      <div class="dress-card-head">
                        <a class="dress-card-img" target="_blank" href="<?=base_url('product/'.$low_to_high_row->slug.'?proid='.$low_to_high_row->product_uniqcode.'&feid='.$low_to_high_row->uniqcode.'&cid='.$low_to_high_row->color.'&type='.$low_to_high_row->product_type)?>">
                          <?php 
                          $product_img=unserialize($low_to_high_row->image);
                          if(!empty($product_img))
                          {?>
                              <img class="dress-card-img-top" src="<?=base_url('webroot/admin/product/web/').$product_img[0]?>" alt="">
                              <?php
                          }
                          else
                          {
                              ?><img src="<?=base_url('webroot/user/images/no_image.jpg')?>"><?php
                          }
                          ?>
                        </a>
                        <?php if($this->session->userdata('loginDetail')!=''){
                            $wishlist_row=$this->User_Model->check_wishlist($low_to_high_row->product_uniqcode,$low_to_high_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode);
                          ?> 
                          <div class="surprise-bubble <?= $wishlist_row == 1 ? 'active' : '';?>">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$low_to_high_row->product_uniqcode.'_'.$low_to_high_row->uniqcode?>')" >Wishlist</span></p>
                          </div>
                          <?php }else{?>
                          <div class="surprise-bubble">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$low_to_high_row->product_uniqcode.'_'.$low_to_high_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }?>
                      </div>
                      <div class="dress-card-body">
                          <h4 class="dress-card-title"><?php
                              $name = strlen($low_to_high_row->product_name) > 13 ? substr($low_to_high_row->product_name,0,13)."..." : $low_to_high_row->product_name;
                                echo $name ;
                              ?>
                            </h4>
                          <p class="seller-name"><a href="<?=base_url('shop/'.$low_to_high_row->admin_id)?>">By:<?=$low_to_high_row->admin_name?></a></p>
                        

                        <p class="">
                          <span class="dress-card-price">Rs.<?=intval($low_to_high_row->sell_price)?> &ensp;</span><span class="dress-card-crossed">Rs.<?=intval($low_to_high_row->mrp_price)?></span><span class="dress-card-off">&ensp;(<?=intval($low_to_high_row->discount)?>)% OFF)</span>
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
    <!----------Low to high gallery section end---------->


    <!----------Top Discount Clothing gallery section start---------->
    <?php if(!empty($clothing_discount)){?>
      <section id="product-gallery">
        <div class="container-fluid product-gallery">
          <div class="row product-header  wow bounceInDown ">
             <div class="col-lg-6 col-sm-8 col-xs-8 product-heading">
               <h4>To Discount Of Clothing</h4>
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
                <?php foreach($clothing_discount as $clothing_discount_row){?>

                <div class="product-item">
                  
                    <div class="dress-card wow bounceInUp">
                      <div class="dress-card-head">
                        <a class="dress-card-img" target="_blank" href="<?=base_url('product/'.$clothing_discount_row->slug.'?proid='.$clothing_discount_row->product_uniqcode.'&feid='.$clothing_discount_row->uniqcode.'&cid='.$clothing_discount_row->color.'&type='.$clothing_discount_row->product_type)?>">
                          <?php 
                          $product_img=unserialize($clothing_discount_row->image);
                          if(!empty($product_img))
                          {?>
                              <img class="dress-card-img-top" src="<?=base_url('webroot/admin/product/web/').$product_img[0]?>" alt="">
                              <?php
                          }
                          else
                          {
                              ?><img src="<?=base_url('webroot/user/images/no_image.jpg')?>"><?php
                          }
                          ?>
                        </a>
                          <?php if($this->session->userdata('loginDetail')!=''){
                            $wishlist_row=$this->User_Model->check_wishlist($clothing_discount_row->product_uniqcode,$clothing_discount_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode);
                          ?> 
                          <div class="surprise-bubble <?= $wishlist_row == 1 ? 'active' : '';?>">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$clothing_discount_row->product_uniqcode.'_'.$clothing_discount_row->uniqcode?>')" >Wishlist</span></p>
                          </div>
                          <?php }else{?>
                          <div class="surprise-bubble">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$clothing_discount_row->product_uniqcode.'_'.$clothing_discount_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }?>
                      </div>
                      <div class="dress-card-body">
                          <h4 class="dress-card-title"><?php
                              $name = strlen($clothing_discount_row->product_name) > 13 ? substr($clothing_discount_row->product_name,0,13)."..." : $clothing_discount_row->product_name;
                              echo $name ;
                              ?>
                            </h4>
                          <p class="seller-name"><a href="<?=base_url('shop/'.$clothing_discount_row->admin_id)?>">By:<?=$clothing_discount_row->admin_name?></a></p>
                        

                        <p class="">
                          <span class="dress-card-price">Rs.<?=intval($clothing_discount_row->sell_price)?> &ensp;</span><span class="dress-card-crossed">Rs.<?=intval($clothing_discount_row->mrp_price)?></span><span class="dress-card-off">&ensp;(<?=intval($clothing_discount_row->discount)?>)% OFF)</span>
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
 
    <?php if(!empty($clothing)){?>
      <section id="product-gallery">
        <div class="container-fluid product-gallery">
          <div class="row product-header  wow bounceInDown ">
             <div class="col-lg-6 col-sm-8 col-xs-8 product-heading">
               <h4>Top Clothing</h4>
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
                        <a class="dress-card-img" target="_blank" href="<?=base_url('product/'.$clothing_row->slug.'?proid='.$clothing_row->product_uniqcode.'&feid='.$clothing_row->uniqcode.'&cid='.$clothing_row->color.'&type='.$clothing_row->product_type)?>">
                          <?php 
                          $product_img=unserialize($clothing_row->image);
                          if(!empty($product_img))
                          {?>
                              <img class="dress-card-img-top" src="<?=base_url('webroot/admin/product/web/').$product_img[0]?>" alt="">
                              <?php
                          }
                          else
                          {
                              ?><img src="<?=base_url('webroot/user/images/no_image.jpg')?>"><?php
                          }
                          ?>
                        </a>
                          <?php if($this->session->userdata('loginDetail')!=''){
                            $wishlist_row=$this->User_Model->check_wishlist($clothing_row->product_uniqcode,$clothing_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode);
                          ?> 
                          <div class="surprise-bubble <?= $wishlist_row == 1 ? 'active' : '';?>">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$clothing_row->product_uniqcode.'_'.$clothing_row->uniqcode?>')" >Wishlist</span></p>
                          </div>
                          <?php }else{?>
                          <div class="surprise-bubble">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$clothing_row->product_uniqcode.'_'.$clothing_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }?>
                      </div>
                      <div class="dress-card-body">
                          <h4 class="dress-card-title"><?php
                              $name = strlen($clothing_row->product_name) > 13 ? substr($clothing_row->product_name,0,13)."..." : $clothing_row->product_name;
                              echo $name ;
                              ?>
                            </h4>
                          <p class="seller-name"><a href="<?=base_url('shop/'.$clothing_row->admin_id)?>">By:<?=$clothing_row->admin_name?></a></p>
                        

                        <p class="">
                          <span class="dress-card-price">Rs.<?=intval($clothing_row->sell_price)?> &ensp;</span><span class="dress-card-crossed">Rs.<?=intval($clothing_row->mrp_price)?></span><span class="dress-card-off">&ensp;(<?=intval($clothing_row->discount)?>)% OFF)</span>
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
    <!----------Top Discount Clothing gallery section end---------->

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

    <!----------Top Discount Accessories gallery section start---------->
    <?php if(!empty($accessories_discount)){?>
      <section id="product-gallery">
        <div class="container-fluid product-gallery">
          <div class="row product-header  wow bounceInDown ">
             <div class="col-lg-6 col-sm-8 col-xs-8 product-heading">
               <h4>Top Discount Of Accessories</h4>
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
                <?php foreach($accessories_discount as $accessories_discount_row){?>

                <div class="product-item">
                  
                    <div class="dress-card wow bounceInUp">
                      <div class="dress-card-head">
                        <a class="dress-card-img" target="_blank" href="<?=base_url('product/'.$accessories_discount_row->slug.'?proid='.$accessories_discount_row->product_uniqcode.'&feid='.$accessories_discount_row->uniqcode.'&cid='.$accessories_discount_row->color.'&type='.$accessories_discount_row->product_type)?>">
                          <?php 
                          $product_img=unserialize($accessories_discount_row->image);
                          if(!empty($product_img))
                          {?>
                              <img class="dress-card-img-top" src="<?=base_url('webroot/admin/product/web/').$product_img[0]?>" alt="">
                              <?php
                          }
                          else
                          {
                              ?><img src="<?=base_url('webroot/user/images/no_image.jpg')?>"><?php
                          }
                          ?>
                        </a>
                         <?php if($this->session->userdata('loginDetail')!=''){
                            $wishlist_row=$this->User_Model->check_wishlist($accessories_discount_row->product_uniqcode,$accessories_discount_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode);
                          ?> 
                          <div class="surprise-bubble <?= $wishlist_row == 1 ? 'active' : '';?>">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$accessories_discount_row->product_uniqcode.'_'.$accessories_discount_row->uniqcode?>')" >Wishlist</span></p>
                          </div>
                          <?php }else{?>
                          <div class="surprise-bubble">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$accessories_discount_row->product_uniqcode.'_'.$accessories_discount_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }?>
                      </div>
                      <div class="dress-card-body">
                          <h4 class="dress-card-title"><?php
                              $name = strlen($accessories_discount_row->product_name) > 13 ? substr($accessories_discount_row->product_name,0,13)."..." : $accessories_discount_row->product_name;
                              echo $name ;
                              ?>
                            </h4>
                          <p class="seller-name"><a href="<?=base_url('shop/'.$accessories_discount_row->admin_id)?>">By:<?=$accessories_discount_row->admin_name?></a></p>
                        

                        <p class="">
                          <span class="dress-card-price">Rs.<?=intval($accessories_discount_row->sell_price)?> &ensp;</span><span class="dress-card-crossed">Rs.<?=intval($accessories_discount_row->mrp_price)?></span><span class="dress-card-off">&ensp;(<?=intval($accessories_discount_row->discount)?>)% OFF)</span>
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
   
    <?php if(!empty($accessories)){?>
      <section id="product-gallery">
        <div class="container-fluid product-gallery">
          <div class="row product-header  wow bounceInDown ">
             <div class="col-lg-6 col-sm-8 col-xs-8 product-heading">
               <h4>Top Accessories</h4>
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
                        <a class="dress-card-img" target="_blank" href="<?=base_url('product/'.$accessories_row->slug.'?proid='.$accessories_row->product_uniqcode.'&feid='.$accessories_row->uniqcode.'&cid='.$accessories_row->color.'&type='.$accessories_row->product_type)?>">
                          <?php 
                          $product_img=unserialize($accessories_row->image);
                          if(!empty($product_img))
                          {?>
                              <img class="dress-card-img-top" src="<?=base_url('webroot/admin/product/web/').$product_img[0]?>" alt="">
                              <?php
                          }
                          else
                          {
                              ?><img src="<?=base_url('webroot/user/images/no_image.jpg')?>"><?php
                          }
                          ?>
                        </a>
                          <?php if($this->session->userdata('loginDetail')!=''){
                            $wishlist_row=$this->User_Model->check_wishlist($accessories_row->product_uniqcode,$accessories_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode);
                          ?> 
                          <div class="surprise-bubble <?= $wishlist_row == 1 ? 'active' : '';?>">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$accessories_row->product_uniqcode.'_'.$accessories_row->uniqcode?>')" >Wishlist</span></p>
                          </div>
                          <?php }else{?>
                          <div class="surprise-bubble">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$accessories_row->product_uniqcode.'_'.$accessories_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }?>
                      </div>
                      <div class="dress-card-body">
                          <h4 class="dress-card-title"><?php
                              $name = strlen($accessories_row->product_name) > 13 ? substr($accessories_row->product_name,0,13)."..." : $accessories_row->product_name;
                              echo $name ;
                              ?>
                            </h4>
                          <p class="seller-name"><a href="<?=base_url('shop/'.$accessories_row->admin_id)?>">By:<?=$accessories_row->admin_name?></a></p>
                        

                        <p class="">
                          <span class="dress-card-price">Rs.<?=intval($accessories_row->sell_price)?> &ensp;</span><span class="dress-card-crossed">Rs.<?=intval($accessories_row->mrp_price)?></span><span class="dress-card-off">&ensp;(<?=intval($accessories_row->discount)?>)% OFF)</span>
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
    <!----------Top Discount Accessories gallery section end---------->


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

    <!----------Top Discount shoes gallery section start---------->
    <?php if(!empty($shoes_discount)){?>
      <section id="product-gallery">
        <div class="container-fluid product-gallery">
          <div class="row product-header  wow bounceInDown ">
             <div class="col-lg-6 col-sm-8 col-xs-8 product-heading">
               <h4>Top Discount Of Shoes</h4>
             </div> 
             <div class="col-lg-6 col-sm-4 col-xs-4">
                <a class="btn common-btn hvr-icon-wobble-horizontal hvr-bounce-to-right" href="<?=base_url('shoes-all-discountl')?>">
                  <span>View all</span>
                  <i class="fa fa-hand-o-right hvr-icon" aria-hidden="true"></i>
                </a>
             </div> 
          </div>
          <div class="container">
            <div class="gallery-wrapper">
              <div class="product-slider">
                <?php foreach($shoes_discount as $shoes_discount_row){?>

                <div class="product-item">
                  
                    <div class="dress-card wow bounceInUp">
                      <div class="dress-card-head">
                        <a class="dress-card-img" target="_blank" href="<?=base_url('product/'.$shoes_discount_row->slug.'?proid='.$shoes_discount_row->product_uniqcode.'&feid='.$shoes_discount_row->uniqcode.'&cid='.$shoes_discount_row->color.'&type='.$shoes_discount_row->product_type)?>">
                          <?php 
                          $product_img=unserialize($shoes_discount_row->image);
                          if(!empty($product_img))
                          {?>
                              <img class="dress-card-img-top" src="<?=base_url('webroot/admin/product/web/').$product_img[0]?>" alt="">
                              <?php
                          }
                          else
                          {
                              ?><img src="<?=base_url('webroot/user/images/no_image.jpg')?>"><?php
                          }
                          ?>
                        </a>
                          <?php if($this->session->userdata('loginDetail')!=''){
                            $wishlist_row=$this->User_Model->check_wishlist($shoes_discount_row->product_uniqcode,$accessories_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode);
                          ?> 
                          <div class="surprise-bubble <?= $wishlist_row == 1 ? 'active' : '';?>">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$shoes_discount_row->product_uniqcode.'_'.$shoes_discount_row->uniqcode?>')" >Wishlist</span></p>
                          </div>
                          <?php }else{?>
                          <div class="surprise-bubble">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$shoes_discount_row->product_uniqcode.'_'.$shoes_discount_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }?>
                      </div>
                      <div class="dress-card-body">
                          <h4 class="dress-card-title"><?php
                              $name = strlen($shoes_discount_row->product_name) > 13 ? substr($shoes_discount_row->product_name,0,13)."..." : $shoes_discount_row->product_name;
                              echo $name ;
                              ?>
                            </h4>
                          <p class="seller-name"><a href="<?=base_url('shop/'.$shoes_discount_row->admin_id)?>">By:<?=$shoes_discount_row->admin_name?></a></p>
                        

                        <p class="">
                          <span class="dress-card-price">Rs.<?=intval($shoes_discount_row->sell_price)?> &ensp;</span><span class="dress-card-crossed">Rs.<?=intval($shoes_discount_row->mrp_price)?></span><span class="dress-card-off">&ensp;(<?=intval($shoes_discount_row->discount)?>)% OFF)</span>
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
   
    <?php if(!empty($shoes)){?>
      <section id="product-gallery">
        <div class="container-fluid product-gallery">
          <div class="row product-header  wow bounceInDown ">
             <div class="col-lg-6 col-sm-8 col-xs-8 product-heading">
               <h4>Top Shoes</h4>
             </div> 
             <div class="col-lg-6 col-sm-4 col-xs-4">
                <a class="btn common-btn hvr-icon-wobble-horizontal hvr-bounce-to-right" href="<?=base_url('shoes-all')?>">
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
                        <a class="dress-card-img" target="_blank" href="<?=base_url('product/'.$shoes_row->slug.'?proid='.$shoes_row->product_uniqcode.'&feid='.$shoes_row->uniqcode.'&cid='.$shoes_rowp->color.'&type='.$shoes_row->product_type)?>">
                          <?php 
                          $product_img=unserialize($shoes_row->image);
                          if(!empty($product_img))
                          {?>
                              <img class="dress-card-img-top" src="<?=base_url('webroot/admin/product/web/').$product_img[0]?>" alt="">
                              <?php
                          }
                          else
                          {
                              ?><img src="<?=base_url('webroot/user/images/no_image.jpg')?>"><?php
                          }
                          ?>
                        </a>
                           <?php if($this->session->userdata('loginDetail')!=''){
                            $wishlist_row=$this->User_Model->check_wishlist($shoes_row->product_uniqcode,$shoes_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode);
                          ?> 
                          <div class="surprise-bubble <?= $wishlist_row == 1 ? 'active' : '';?>">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$shoes_row->product_uniqcode.'_'.$shoes_row->uniqcode?>')" >Wishlist</span></p>
                          </div>
                          <?php }else{?>
                          <div class="surprise-bubble">
                            <span class="dress-card-heart">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                            <p> <span onclick="wishlist('<?=$shoes_row->product_uniqcode.'_'.$shoes_row->uniqcode?>')">Wishlist</span></p>
                          </div>
                        <?php }?>
                      </div>
                      <div class="dress-card-body">
                          <h4 class="dress-card-title"><?php
                              $name = strlen($shoes_row->product_name) > 13 ? substr($shoes_row->product_name,0,13)."..." : $shoes_row->product_name;
                              echo $name ;
                              ?>
                            </h4>
                          <p class="seller-name"><a href="<?=base_url('shop/'.$shoes_row->admin_id)?>">By:<?=$shoes_row->admin_name?></a></p>
                        

                        <p class="">
                          <span class="dress-card-price">Rs.<?=intval($shoes_row->sell_price)?> &ensp;</span><span class="dress-card-crossed">Rs.<?=intval($shoes_row->mrp_price)?></span><span class="dress-card-off">&ensp;(<?=intval($shoes_row->discount)?>)% OFF)</span>
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
    <!----------Top Discount shoes gallery section end---------->


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
                                Understanding clients concept and converting his unstructured imagination into a structured reality needs great expertise and patience. I find this quality with "<strong>Bong Basar</strong>" people. They converted
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






