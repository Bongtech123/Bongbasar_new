
<!-- ---------All Seler section start--------- -->
<?php if(!empty($all_shop)){?>
    <section id="category">
      <div class="category seller-details">
        <div class="container-fluid">
         <div class="row">
            <form>
              <div class="col-sm-4">
                <div class="form-group search-by-location">
                  <select class="form-control selectpicker" id="select-country" data-live-search="true" onchange="shopLocation()">
                    <option value="">Choose Your Location</option>
                    <?php
                      foreach ($all_admin_city as $key => $value) 
                      {?>
                        <option data-tokens="<?=$value->city?>" value="<?=$value->city?>"><?=$value->city?></option>
                      <?php }?>
                  </select>
                </div>
              </div>
              <div class="col-sm-4">
                
              </div>
              <div class="col-sm-4">
                <div class="form-group auto-search-box">
                  <i class="fa fa-search" aria-hidden="true"></i>
                  <input type="text" class="form-control" placeholder="Search your shop name" name="shop_search_name" id="shop_search_name" onkeyup="shopSelect()">
                  <i type="button" class="fa fa-times" aria-hidden="true" onclick="shop_refresh()"></i>
                </div>
              </div>
              
          </form>
         </div>
          <div class="row" id="edid_shop">
            <?php foreach($all_shop as $shop_row){?>

              <div class="col-md-2">
                <div class="item">
                  <a href="<?=base_url('shop/'.$shop_row->uniqcode)?>">
                    <div class="item-overlay">
                      <div class="category-img">
                        <img src="<?=base_url('webroot/admin/shop_image/'.$shop_row->shop_image)?>">
                      </div>
                    </div>
                    <div class="item-content">
                      <div class="item-top-content">
                        <div class="item-top-content-inner">
                          <div class="item-product">
                            <div class="item-top-title">
                              <h4><?=$shop_row->shop_name?></h4>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="item-add-content">
                        <div class="item-add-content-inner">
                          <div class="section">
                            <!-- <a href="#" class="btn buy expand">Buy now</a> -->

                            <p class="shop-address">
                            <?=$shop_row->shop_address?>
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            <?php }?>
        
          </div>
        </div>
      </div>
    </section>
<?php } ?>
<!-- All Seler section end -->