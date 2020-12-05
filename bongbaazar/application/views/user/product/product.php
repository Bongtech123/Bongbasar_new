<!-- <input type="hidden" name="child_category_id" id="child_category_id" value="<?=$child_category_id?>"> -->
<!----------Side filter bar start---------- -->
      <div id="wrapper">
    
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <p>
              <span class="tittle">Filters</span>
              <span class="clear-all">
                Clear all
                <i class="fa fa-times" aria-hidden="true"></i>
              </span>
            </p>
          </div>
          <!-- Side bar start -->
          <ul class="sidebar-nav">
            <div class="narrowchart">
              <div id="accordion">
                <div class="accordianheader nav-sorting">
                  <p>
                    Sort By <i class="fa fa-angle-down"></i></p>
                </div>
                <div class="accordianbody nav-sorting">
                  <ul>
                    <li>
                      <div class="aks-input-wrap">
                        <input class="aks-input" type="radio" id="radio1" name="radio" onclick="shortBy('LH')" <?php if(@$shortBy == 'LH') {
                              echo "checked";
                        }?>>
                        <label class="aks-input-label" for="radio1">Price -- Low to High</label>
                      </div>
                    </li>
                    <li>
                      <div class="aks-input-wrap">
                        <input class="aks-input" type="radio" id="radio2" name="radio" onclick="shortBy('HL')" <?php if(@$shortBy == 'HL') {
                              echo "checked";
                        }?>>
                        <label class="aks-input-label" for="radio2">Price -- High to Low</label>
                      </div>
                    </li>
                    <li>
                      <div class="aks-input-wrap">
                        <input class="aks-input" type="radio" id="radio3" name="radio" onclick="shortBy('AZ')">
                        <label class="aks-input-label" for="radio3">A to Z</label>
                      </div>
                    </li>
                    <li>
                      <div class="aks-input-wrap">
                        <input class="aks-input" type="radio" id="radio4" name="radio" onclick="shortBy('ZA')">
                        <label class="aks-input-label" for="radio4">Z to A</label>
                      </div>
                    </li>
                  </ul>
                </div>


                <div class="accordianheader" >
                  <p>
                    Color <i class="fa fa-angle-down"></i></p>
                </div>
                <div class="accordianbody" >
                  <ul> 
                    <li class="search-in-box">
                      <div class="search-bar">
                        <input id="search_text_color" class="searchbar" type="text" placeholder="Search...">
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
                        <input id="search_text_size" class="searchbar" type="text" placeholder="Search...">
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
                        <input id="search_text_brand" class="searchbar" type="text" placeholder="Search...">
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
                <!-- <div class="accordianheader">
                  <p>
                    Clothing and Accessories 
                    <i class="fa fa-angle-down"></i>
                  </p>
                </div>
                <div class="accordianbody">
                  <ul>
                    <li>
                      <a href="#">Winter wear</a>
                    </li>
                    <li>
                      <a href="#"> Topwear</a>
                    </li>
                    <li>
                      <a href="#"> Bottomwear</a>
                    </li>
                    <li>
                      <a href="#"> Raincots</a>
                    </li>
                    <li>
                      <a href="#"> Dresses and Gowns</a>
                    </li>
                    <li class="more-options">
                      <span class="more-btn openClose">+ 1887 MORE</span>
                      <div class="more-files-directory">
                        <div class="directory-head">
                          <div class="search-field">
                            <input type="text" placeholder="Search...." name="">
                            <button type="submit" class="searchButton">
                              <i class="fa fa-search"></i>
                           </button>
                          </div>
                          <div class="close-option openClose">
                            X
                          </div>
                        </div>
                        <div class="directory-body">
                          <div class="directory-item">
                            <a href="#">Winter Wear</a>
                          </div>
                          <div class="directory-item">
                            <a href="#">Winter Wear</a>
                          </div>
                          <div class="directory-item">
                            <a href="#">Winter Wear</a>
                          </div>
                          <div class="directory-item">
                            <a href="#">Winter Wear</a>
                          </div>
                          <div class="directory-item">
                            <a href="#">Winter Wear</a>
                          </div>
                          <div class="directory-item">
                            <a href="#">Winter Wear</a>
                          </div>
                          <div class="directory-item">
                            <a href="#">Winter Wear</a>
                          </div>
                          <div class="directory-item">
                            <a href="#">Winter Wear</a>
                          </div>
                          <div class="directory-item">
                            <a href="#">Winter Wear</a>
                          </div>
                          <div class="directory-item">
                            <a href="#">Winter Wear</a>
                          </div>
                          <div class="directory-item">
                            <a href="#">Winter Wear</a>
                          </div>
                          <div class="directory-item">
                            <a href="#">Winter Wear</a>
                          </div>
                          <div class="directory-item">
                            <a href="#">Winter Wear</a>
                          </div>
                          <div class="directory-item">
                            <a href="#">Winter Wear</a>
                          </div>
                          <div class="directory-item">
                            <a href="#">Winter Wear</a>
                          </div>
                          <div class="directory-item">
                            <a href="#">Winter Wear</a>
                          </div>
                          <div class="directory-item">
                            <a href="#">Winter Wear</a>
                          </div>
                          <div class="directory-item">
                            <a href="#">Winter Wear</a>
                          </div>
                          <div class="directory-item">
                            <a href="#">Winter Wear</a>
                          </div>
                          <div class="directory-item">
                            <a href="#">Winter Wear</a>
                          </div>
                          <div class="directory-item">
                            <a href="#">Winter Wear</a>
                          </div>
                          <div class="directory-item">
                            <a href="#">Winter Wear</a>
                          </div>
                          
                        </div>
                        <div class="directory-footer">
                          
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
                <div class="accordianheader">
                  <p>
                    Moving To Opportunity<i class="fa fa-angle-down"></i></p>
                </div>
                <div class="accordianbody">
                  <ul>
                    <li>
                      Provides vouchers that allow residents to enter private rental market.</li>
                    <li>
                      Requires residents to live in areas less than 10% poor</li>
                    <li>
                      Provides housing search counseling</li>
                    <li>
                      Requires residents to remain in new unit for at least one year</li>
                    <li>
                      Voucher can be used across entire metropolitan regions</li>
                    <li>
                      Conducts premove visits to new homes</li>
                  </ul>
                </div>
                <div class="accordianheader">
                  <p>
                    BHMP<i class="fa fa-angle-down"></i></p>
                </div>
                <div class="accordianbody">
                  <ul>
                    <li>
                      Provides vouchers that allow residents to enter private rental market.</li>
                    <li>
                      Requires residents to live in areas less than 10% poor</li>
                    <li>
                      Requires residents to live in areas less than 30% black</li>
                    <li>
                      Requires residents to live in areas with no more than 5% of residents in subsidized housing</li>
                    <li>
                      Provides housing search counseling</li>
                    <li>
                      Provides post-move counseling</li>
                    <li>
                      Requires residents to remain in new unit for at least one year</li>
                    <li>
                      Voucher can be used across entire metropolitan regions</li>
                    <li>
                      Provides financial literacy counseling</li>
                    <li>
                      Provides second-move counseling</li>
                    <li>
                      Conducts premove visits to new homes</li>
                    <li>
                      At least 80% low poverty neighborhood retention program</li>
                  </ul>
                </div> -->
              </div>
            </div>

            <div class="price-filter">
              <div class="range-slider">
                  <input type="text" class="js-range-slider" value=""/>
              </div>
              <div class="extra-controls form-inline">
                <div class="form-group">
                  <input type="text" class="js-input-from form-control " value="0" id="rangestart"/>
                  To
                  <input type="text" class="js-input-to form-control " value="0" id="rangeend"/>
                </div>
              </div>
            </div>
          </ul>
        </aside>
<!-- Side bar end -->
       
<!-- slide filter start -->
        <div id="navbar-wrapper">
          <nav class="navbar navbar-inverse">
            <div class="container-fluid">
              <div class="navbar-header">
                <a href="#" class="navbar-brand" id="sidebar-toggle"><i class="fa fa-bars"></i></a>
              </div>
              <div class="sorting">
                <div class="sorting-tittle">
                  <p>Sort By:</p>
                </div>
                <div class="aks-input-wrap">
                  <input class="aks-input" type="radio" id="radio1" name="radio" onclick="shortBy('LH')" <?php if(@$shortBy == 'LH') {
                              echo "checked";
                        }?>>
                  <label class="aks-input-label" for="radio1">Price -- Low to High</label>

                </div>
                <div class="aks-input-wrap">
                  <input class="aks-input" type="radio" id="radio2" name="radio" onclick="shortBy('HL')" <?php if(@$shortBy == 'HL') {
                              echo "checked";
                        }?>>
                  <label class="aks-input-label" for="radio2">Price -- High to Low</label>
                </div>
                <div class="aks-input-wrap">
                  <input class="aks-input" type="radio" id="radio3" name="radio" onclick="shortBy('AZ')" <?php if(@$shortBy == 'AZ') {
                              echo "checked";
                        }?>>
                  <label class="aks-input-label" for="radio3">A to Z</label>
                </div>
                <div class="aks-input-wrap">
                  <input class="aks-input" type="radio" id="radio4" name="radio" onclick="shortBy('ZA')" <?php if(@$shortBy == 'ZA') {
                              echo "checked";
                        }?>>
                  <label class="aks-input-label" for="radio4">Z to A</label>
                </div>
              </div>
            </div>
          </nav>
        </div>
<!-- slide filter end -->
    <section id="content-wrapper">
      <!-- --------Filter item print start-------- -->
        <!-- <div class="filter-items">
          <ul class="filter-summary-filterList">
            <li>
              <div class="filter-summary-filter">
                <span>Winter wear</span>
                <span><i class="fa fa-times" aria-hidden="true"></i></span>
              </div>
            </li>
            <li>
              <div class="filter-summary-filter">
                <span>Winter wear</span>
                <span><i class="fa fa-times" aria-hidden="true"></i></span>
              </div>
            </li>
          </ul>
        </div> -->
      <!-- Filter item print end -->

      <!-- ---------Products section start--------- -->
        <div class="product" id="filter_data" style="display: -webkit-box;">
          <?php foreach($prodct_all as $prodct_all_row){
            //print_r($prodct_all_row);
            ?> 
            <div class="col-md-3 col-xs-12">
              <div class="dress-card">
                  <div class="dress-card-head">
                    <a class="dress-card-img" target="_blank" href="<?=base_url('product/'.$prodct_all_row->slug)?>">
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
          <?php }?>
        </div>

      <!-- Product section end -->
     

      <!-- ------------Pagination start------------ -->
        <div class="pagination-wrappar" id="pagination_data"> 
          <span>Page <?=$page?> of <?=($totalpage)?></span>
          <?php echo $links; ?>
        </div> 
      <!-- Pagination end -->
    </section>
  </div>
<!-- Side filter end