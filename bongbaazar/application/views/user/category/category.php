 <!-----------Category section start--------- -->
    <?php if(!empty($category_all)):?>

      <section id="category">
        <div class="category">
          <div class="container-fluid">
            <div class="row">
              <?php foreach($category_all as $category_all_row){?>
                <div class="col-md-3">
                  <div class="item">
                    <div class="item-overlay">
                      <div class="sale-tag"><span>NEW</span></div>
                      <div class="category-img">
                       <?php
                            if(!empty($category_all_row->image))
                            {
                                ?>
                                <img class="dress-card-img-top" src="<?=base_url('webroot/super_admin/child_category/'.$category_all_row->image)?>" alt="">
                                <?php
                            }
                            else
                            {
                                ?><img src="<?=base_url('webroot/user/images/no_image.jpg')?>"><?php
                            }
                          ?>
                      </div>
                    </div>
                    <div class="item-content">
                      <div class="item-top-content">
                        <div class="item-top-content-inner">
                          <div class="item-product">
                            <div class="item-top-title">
                              <h4><?=$category_all_row->child_category_name?></h4>
                              <!-- <p class="subdescription">
                                Pencil Heel - Silver
                              </p> -->
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="item-add-content">
                        <div class="item-add-content-inner"> 
                          <div class="section">
                            <!-- <a href="#" class="btn buy expand">Buy now</a> -->
                            <a href="<?=base_url('category-all-product/'.$category_all_row->uniqcode);?>" class="btn btn-lg btn-block hvr-icon-pulse hvr-bounce-to-right visit-store-btn">
                              View More
                              <i class="fa fa-hand-pointer-o" aria-hidden="true"></i>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php }  ?>
            </div>
          </div>
        </div>
      </section>
    <?php endif;?>
      
    <!-- Category section end