<input type="hidden" name="admin_id" id="admin_id" value="<?=$admin_id?>">
    <!-- --------------Seller head view start-------------- -->
    <input type="hidden" />
        <section id="seller-view">
            <div class="seller-view">
                <div class="seller-header">
                    <!-- <div class = 'search-box'>
                        <input class = "search-text" type="text" placeholder = "Search Anything">
                        <a href="#" class = "search-btn">
                          <i class="fa fa-search"></i>
                        </a>
                        
                      </div> -->
                    <div class="seller-banner">
                        <div class="seller-header-img-row">
                          <img src="<?=base_url('webroot/admin/shop_image/'.$shop_details->shop_image)?>">
                        </div>
                    </div>
                    <div class="seller-details">
                        <div class="seller-details-innerpart">
                            <p class="seller-name"><?=$shop_details->name?></p>
                           <!--  <div class="star-rating">
                                <span class="rating-heading">User Rating </span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div> -->
                            <p class="seller-address">
                                <?=$shop_details->shop_address?>
                            </p>
                        </div>
                    </div>
                        
                </div>
                
            </div>
        </section>
    <!-- Seller head view end -->

    <!-- ----------Side filter bar start---------- -->
      <div id="wrapper">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <p>
              <span class="tittle">Products</span>
              <!-- <span class="clear-all">
                Clear all
                <i class="fa fa-times" aria-hidden="true"></i>
              </span> -->
            </p>
          </div>
          <!-- Side bar start -->
          <ul class="sidebar-nav">
            <div class="narrowchart">
              <div id="accordion">
              <div class="accordianheader" >
                  <p>
                    Color <i class="fa fa-angle-down"></i></p>
                </div>
                <div class="accordianbody" >
                  <ul> 
                    <li class="search-in-box">
                      <div class="search-bar">
                        <input id="admin_search_text_color" class="searchbar" type="text" placeholder="Search...">
                        <a id="btnSearch" class="btn-search"><i class="fa fa-search"></i></a>
                      </div>
                    </li>
                    <li>
                      <ul class="navSearchItem" id="filterColor">
                        <?php foreach($find_by_color as $find_by_color_row){?>
                        <li>
                          <div class="aks-input-wrap">
                            <input class="aks-input comon_selector color" type="checkbox" id="checkbox" name="checkbox" value="<?=$find_by_color_row->uniqcode ;?>" onclick="shortByColor()" <?php if(in_array($find_by_color_row->uniqcode,@$color)){
                              echo 'checked';
                            } ?>>
                            <label class="aks-input-label" for="checkbox"><?=$find_by_color_row->color_name ;?></label>
                          </div>
                        </li>
                        <?php }?>
                      </ul>
                    </li>
                  </ul>
                </div>

                <div class="accordianheader">
                  <p>
                    Size <i class="fa fa-angle-down"></i></p>
                </div>
                <div class="accordianbody">
                  <ul> 
                    <li class="search-in-box">
                      <div class="search-bar">
                        <input id="admin_search_text_size" class="searchbar" type="text" placeholder="Search...">
                        <a id="btnSearch" class="btn-search"><i class="fa fa-search"></i></a>
                      </div>
                    </li>
                    <li>
                      <ul class="navSearchItem" id="filterSize">
                        <?php foreach($find_by_size as $find_by_size_row){?>
                        <li>
                          <div class="aks-input-wrap">
                            <input class="aks-input comon_selector size" type="checkbox" id="checkbox" name="checkbox" value="<?=$find_by_size_row->uniqcode ;?>" onclick="shortBySize()" <?php if(in_array($find_by_size_row->uniqcode,@$size)){
                              echo 'checked';
                            } ?>>
                            <label class="aks-input-label" for="checkbox"><?=$find_by_size_row->size_name ;?></label>
                          </div>
                        </li>
                        <?php }?>
                      </ul>
                    </li>
                  </ul>
                </div>

                <div class="accordianheader">
                  <p>
                    Brand <i class="fa fa-angle-down"></i></p>
                </div>
                <div class="accordianbody">
                  <ul> 
                    <li class="search-in-box">
                      <div class="search-bar">
                        <input id="admin_search_text_brand" class="searchbar" type="text" placeholder="Search...">
                        <a id="btnSearch" class="btn-search"><i class="fa fa-search"></i></a>
                      </div>
                    </li>
                    <li>
                      <ul class="navSearchItem" id="filterBrand">
                        <?php foreach($find_by_brand as $find_by_brand_row){?>
                        <li>
                          <div class="aks-input-wrap">
                            <input class="aks-input comon_selector brand" type="checkbox" id="checkbox" name="checkbox" value="<?=$find_by_brand_row->brand_name ;?>" onclick="shortByBrand()" <?php if(in_array($find_by_brand_row->brand_name,@$brand)){
                              echo 'checked';
                            } ?>>
                            <label class="aks-input-label" for="checkbox"><?=$find_by_brand_row->brand_name ;?></label>
                          </div>
                        </li>
                        <?php }?>
                      </ul>
                    </li>
                   
               
                  </ul>
                </div>
              </div>
            </div>

          </ul>
          <!-- Side bar end -->
        </aside>

        <div id="navbar-wrapper">
          <nav class="navbar navbar-inverse">
            <div class="container-fluid">
              <div class="navbar-header">
                <div class="col-md-6">
                  <a href="#" class="navbar-brand" id="sidebar-toggle"><i class="fa fa-bars"></i></a>
                </div>
                <div class="col-md-6">
                  <div class="search-field">
                    <input type="text" placeholder="Search Product...." name="" id="shop_product" onkeyup="shopProduct('<?=$shop_details->uniqcode?>')">
                    <!-- <input type="hidden" name="shopid" id="shopid" value=""> -->
                    <!-- <button type="submit" class="searchButton" onclick="shopProduct()">
                      <i class="fa fa-search"></i>
                   </button> -->
                  </div>
                </div>
              </div>
            </div>
          </nav>
        </div>

        <section id="content-wrapper">

          <!-- -----------Seller item category start----------- -->
            <!-- <section id="seller-item-category">
                <div class="seller-item-category">
                    <div class="container">
                        <div class="col-md-2">
                            <a href="product.html" class="category-tittle hvr-grow-shadow">T-Shirt</a>
                        </div>
                        <div class="col-md-2">
                            <a href="#" class="category-tittle hvr-grow-shadow">Shirt</a>
                        </div>
                        <div class="col-md-2">
                            <a href="#" class="category-tittle hvr-grow-shadow">Formal Shirt</a>
                        </div>
                        <div class="col-md-2">
                            <a href="#" class="category-tittle hvr-grow-shadow">Casual Shirt</a>
                        </div>
                        <div class="col-md-2">
                            <a href="#" class="category-tittle hvr-grow-shadow">Jeans</a>
                        </div>
                        <div class="col-md-2">
                            <a href="#" class="category-tittle hvr-grow-shadow">Jackets</a>
                        </div>
                    </div>
                </div>
            </section> -->
          <!-- Seller item category end -->
    <!-- ---------Products section start--------- -->
          <div class="product" id="filter_data" style="display: -webkit-box;">
            <?php foreach($seller_all_product as $prodct_all_row){
              //print_r($prodct_all_row);
              ?> 
              <div class="col-md-3 col-xs-12">
                <div class="dress-card">
                    <div class="dress-card-head">
                      <a class="dress-card-img" target="_blank"  href="<?=base_url('product/'.$prodct_all_row->slug.'?proid='.$prodct_all_row->sub_category_id.'_'.$prodct_all_row->uniqcode)?>">
                         <?php $product_img=unserialize($prodct_all_row->image); 
                          if(!empty($product_img))
                          {
                          
                              ?>
                              <img class="dress-card-img-top" src="<?=base_url('webroot/admin/product/web/').$product_img[0]?>" alt="">
                              <?php
                          }
                          else
                          {
                              ?><img src="<?=base_url('webroot/user/images/logo.png')?>"><?php
                          }
                        ?>
                      </a>
                      
                        <div class="surprise-bubble">
                          <span class="dress-card-heart">
                            <i class="fa fa-heart" aria-hidden="true"></i>
                          </span>
                          <p> <span onclick="wishlist()">Wishlist</span></p>
                        </div>
                
                        
        
                    </div>
                     <div class="dress-card-body">
                            <h4 class="dress-card-title"><?php
                                    $name = strlen($prodct_all_row->product_name) > 13 ? substr($prodct_all_row->product_name,0,13)."..." : $prodct_all_row->product_name;
                                    echo $name ;
                                    ?>
                            </h4>
                            <p class="seller-name"><a href="<?=base_url('shop/'.$prodct_all_row->admin_id)?>">By:<?=$prodct_all_row->admin_name?></a></p>
                    
                          <p>
                            <span class="dress-card-price">Rs.<?=intval($prodct_all_row->sell_price)?> &ensp;</span><span class="dress-card-crossed">Rs.<?=intval($prodct_all_row->mrp_price)?></span><span class="dress-card-off">&ensp;(<?=intval($prodct_all_row->discount)?>)% OFF)</span>
                          </p>
                         
                            
                        </div>
                </div>
              </div>
            <?php }?>
          </div>

        <!-- Product section end -->
        </section>

      </div>
    <!-- Side filter end -->