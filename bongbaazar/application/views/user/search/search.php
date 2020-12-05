<!-- ---------Products section start--------- -->
<?php if(!empty($prodct_all)){?>
<div class="product search-view">
  <div class="row">
    <?php foreach($prodct_all as $prodct_all_row){?> 
    <div class="col-md-2 col-xs-12">
      <div class="dress-card">
          <div class="dress-card-head">
            <a class="dress-card-img" target="_blank" href="<?=base_url('product/'.$prodct_all_row->slug.'?proid='.$prodct_all_row->product_uniqcode.'&feid='.$prodct_all_row->uniqcode.'&cid='.$prodct_all_row->color.'&type='.$prodct_all_row->product_type)?>">
              <?php $product_img=unserialize($prodct_all_row->image); 
                if(!empty($product_img))
                {
                    ?>
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
              $wishlist_row=$this->User_Model->check_wishlist($prodct_all_row->product_uniqcode,$prodct_all_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode);
            ?> 
            <div class="surprise-bubble <?= $wishlist_row == 1 ? 'active' : '';?>">
              <span class="dress-card-heart">
                <i class="fa fa-heart" aria-hidden="true"></i>
              </span>
              <p> <span onclick="wishlist('<?=$prodct_all_row->product_uniqcode.'_'.$prodct_all_row->uniqcode?>')" >Wishlist</span></p>
            </div>
            <?php }else{?>
            <div class="surprise-bubble">
              <span class="dress-card-heart">
                <i class="fa fa-heart" aria-hidden="true"></i>
              </span>
              <p> <span onclick="wishlist('<?=$prodct_all_row->product_uniqcode.'_'.$prodct_all_row->uniqcode?>')">Wishlist</span></p>
            </div>
          <?php }?>
          </div>
          <div class="dress-card-body">
              <h4 class="dress-card-title"><?php
                      $name = strlen($prodct_all_row->product_name) > 13 ? substr($prodct_all_row->product_name,0,13)."..." : $prodct_all_row->product_name;
                      echo $name ;
                      ?>
              </h4>
              <p class="seller-name"><a href="<?=base_url('shop/'.$prodct_all_row->admin_id)?>">By:<?=$prodct_all_row->admin_name?></a></p>
              <p>
                <span class="dress-card-price">Rs.<?=intval($prodct_all_row->sell_price)?> &ensp;</span>
                <span class="dress-card-crossed">Rs.<?=intval($prodct_all_row->mrp_price)?></span>
                <span class="dress-card-off">&ensp;(<?=intval($prodct_all_row->discount)?>)% OFF)</span>
              </p>
              
          </div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>
<?php } ?>
<!-- Product section end -->
