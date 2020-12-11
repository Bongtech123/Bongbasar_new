<!-- -----------Cart section start----------- -->
<?php
    $product_available=0;
    $outofstock=0;
    $temp=0;
?>
<section id="shopping-cart">
    <div id="regForm" class="shopping-cart">
        <div class="container">
            <?php
if(!empty($cart_details))
{
?>
            <div class="row">
                <div class="delivery-grap">
                    <div class="grap-step step">
                        <div class="grap-step-underpart" style="background: #0069e4; border-color: #0069e4;">
                            <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                        </div>
                        <!-- <p class="grap-tittle">Shopping Bag</p> -->
                    </div>
                    <div class="grap-step step">
                        <div class="grap-step-underpart">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                        </div>
                        <!-- <p class="grap-tittle">Address</p> -->
                    </div>
                    <div class="grap-step step">
                        <div class="grap-step-underpart">
                            <i class="fa fa-cc-visa" aria-hidden="true"></i>
                        </div>
                        <!-- <p class="grap-tittle">Payment</p> -->
                    </div>
                </div>
                <div class="col-md-8 col-xs-12 col-sm-12">
                    <div class="product-items deliverystep">
                        <div class="product-header">
                            <div class="count-bag-item">
                                My Shopping Bag (<?php if(!empty($cart_details))
{
echo count($cart_details);
}
else
{
echo "0";
}
?>
                                Items)
                            </div>
                            <div class="base-value">
                                Total:
                                <svg width="8" height="10" viewBox="0 0 8 10" class="priceDetail-base-icon">
                                    <path
                                        fill-rule="nonzero"
                                        d="M1.951 5.845l3.91 3.602-.902.376L.7 5.845l.452-.711c.186-.005.392-.02.615-.048a5.2 5.2 0 0 0 1.347-.356c.218-.09.42-.201.604-.331.185-.13.345-.281.479-.455.134-.173.231-.371.29-.594H.865v-.841h3.644a1.759 1.759 0 0 0-.284-.667 1.826 1.826 0 0 0-.567-.512 2.964 2.964 0 0 0-.865-.332A5.22 5.22 0 0 0 1.63.882H.864V0h6.2v.882H4.18c.173.077.33.174.468.29a2.09 2.09 0 0 1 .612.848c.064.162.11.325.137.489h1.668v.84H5.383a2.38 2.38 0 0 1-.43 1.03 3.095 3.095 0 0 1-.8.748 4.076 4.076 0 0 1-1.043.482 6.15 6.15 0 0 1-1.159.236z"
                                    ></path>
                                </svg>
                                <?php
                                    $total=0;
                                    foreach($cart_details as  $key => $cart_row)
                                    {
                                    $total=$total+(intval($cart_row->sell_price)*intval($cart_row->quantity)); } ?>
                                <span id="totalamount_view"><?= $total;?></span>
                                <input type="hidden" id="totalamount" value="<?=$total;?>" />
                            </div>
                        </div>
                        <?php foreach($cart_details as $key => $cart_row){?>
                        <div class="product-single-item">
                            <i class="fa fa-times" aria-hidden="true" onclick="removeItem('<?=$cart_row->uniqcode?>')"></i>
                            <div class="container-fluid">
                                <div class="row">
                                    <input type="hidden" id="uniqcode<?=$cart_row->uniqcode?>" value="<?=$cart_row->uniqcode?>" />
                                    <div class="col-md-2 col-xs-12 col-sm-12">
                                        <div class="product-img">
                                            <a
                                                class="dress-card-img"
                                                target="_blank"
                                                href="<?=base_url('product/'.$cart_row->slug.'?proid='.$cart_row->product_id.'&feid='.$cart_row->product_features_id.'&cid='.$cart_row->color.'&type='.$cart_row->product_type)?>"
                                            >
                                                <?php
                                                 $product_img=unserialize($cart_row->image); if(!empty($product_img)) {?>
                                                <img class="" src="<?=base_url('webroot/admin/product/web/').$product_img[0]?>" alt="" />
                                                <?php
                                                }
                                                else
                                                {
                                                ?>
                                                <img src="<?=base_url('webroot/user/images/no_image.jpg')?>" />
                                                <?php
                                                }
                                                ?>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-10 col-xs-12 col-sm-12">
                                        <div class="product-details">
                                            <div class="row">
                                                <div class="col-md-8 col-xs-12 col-sm-12">
                                                    <p class="product-title">
                                                        <?php
                                                            $name = strlen($cart_row->product_name) > 80 ? substr($cart_row->product_name,0,80)."..." : $cart_row->product_name; echo $name ; ?>
                                                    </p>
                                                    <p class="sold-by">
                                                        <a href="<?=base_url('shop/'.$cart_row->admin_id)?>">Sold By:<?=$cart_row->admin_name?></a>
                                                    </p>
                                                    <?php if(!empty($cart_row->color)){ $color=$this->Cart_Model->get_color($cart_row->color); ?>
                                                    <p class="product-color">
                                                        Color:
                                                        <?=$color?>
                                                    </p>
                                                    <?php }?>

                                                    <?php if(!empty($cart_row->size)){ $size=$this->Cart_Model->get_size($cart_row->size); ?>
                                                    <p class="product-size">
                                                        Size:
                                                        <?= $size;?>
                                                    </p>
                                                    <?php }?>

                                                    <div class="number-of-products" id="buyBlock">
                                                        <?php
                                                            if($product_quantity[$key]->stock_quentity>0 && $product_quantity[$key]->business_type=="Retailer" || $product_quantity[$key]->stock_quentity>50 && $product_quantity[$key]->business_type=="Wholesaler" || $product_quantity[$key]->stock_quentity>50 && $product_quantity[$key]->business_type=="Manufacture" )
                                                            {
                                                                $temp=0;
                                                        ?>
                                                        <span id="priceATC" class="quantity-up-down">
                                                            <label>Qty</label>
                                                            <span class="icon-minus-squared <?= $cart_row->quantity == 1 ? 'off' : '';?>" onclick="quentityDecrement('<?=$cart_row->uniqcode?>')">&ndash;</span>
                                                            <input name="Quantity" type="number" value="<?=$cart_row->quantity?>" id="quen<?=$cart_row->uniqcode?>" class="qty-field" min="1" max="200" onblur="quentityadd('<?=$cart_row->uniqcode?>')" />
                                                            <span class="icon-plus-squared" onclick="quentityUpdate('<?=$cart_row->uniqcode?>')">+</span>
                                                        </span>
                                                        <?php
                                                            }
                                                            else
                                                            {
                                                               $outofstock=1; 
                                                               $temp=1;
                                                        ?>
                                                        <span id="priceATC" class="quantity-up-down">
                                                            <label>Qty:<?=$cart_row->quantity?></label>
                                                        </span>
                                                        <span>
                                                            <label style="color: red;
                                                            margin-left: 71px;
                                                            font-size: 20px;
                                                            ">Out Of Stock.</label>
                                                        </span>
                                                        <?php
                                                            }
                                                        ?>
                                                       
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-md-4 col-xs-12 col-sm-12 product-details-right">
                                                    <p class="base-value product-title">
                                                        <svg width="8" height="10" viewBox="0 0 8 10" class="priceDetail-base-icon">
                                                            <path
                                                                fill-rule="nonzero"
                                                                d="M1.951 5.845l3.91 3.602-.902.376L.7 5.845l.452-.711c.186-.005.392-.02.615-.048a5.2 5.2 0 0 0 1.347-.356c.218-.09.42-.201.604-.331.185-.13.345-.281.479-.455.134-.173.231-.371.29-.594H.865v-.841h3.644a1.759 1.759 0 0 0-.284-.667 1.826 1.826 0 0 0-.567-.512 2.964 2.964 0 0 0-.865-.332A5.22 5.22 0 0 0 1.63.882H.864V0h6.2v.882H4.18c.173.077.33.174.468.29a2.09 2.09 0 0 1 .612.848c.064.162.11.325.137.489h1.668v.84H5.383a2.38 2.38 0 0 1-.43 1.03 3.095 3.095 0 0 1-.8.748 4.076 4.076 0 0 1-1.043.482 6.15 6.15 0 0 1-1.159.236z"
                                                            ></path>
                                                        </svg>
                                                        <span><?=intval($cart_row->sell_price)?></span>
                                                        <input type="hidden" id="sell_price<?=$cart_row->uniqcode?>" value="<?=$cart_row->sell_price?>" />
                                                    </p>
                                                    <p class="base-value">
                                                        <svg width="8" height="10" viewBox="0 0 8 10" class="priceDetail-base-icon">
                                                            <path
                                                                fill-rule="nonzero"
                                                                d="M1.951 5.845l3.91 3.602-.902.376L.7 5.845l.452-.711c.186-.005.392-.02.615-.048a5.2 5.2 0 0 0 1.347-.356c.218-.09.42-.201.604-.331.185-.13.345-.281.479-.455.134-.173.231-.371.29-.594H.865v-.841h3.644a1.759 1.759 0 0 0-.284-.667 1.826 1.826 0 0 0-.567-.512 2.964 2.964 0 0 0-.865-.332A5.22 5.22 0 0 0 1.63.882H.864V0h6.2v.882H4.18c.173.077.33.174.468.29a2.09 2.09 0 0 1 .612.848c.064.162.11.325.137.489h1.668v.84H5.383a2.38 2.38 0 0 1-.43 1.03 3.095 3.095 0 0 1-.8.748 4.076 4.076 0 0 1-1.043.482 6.15 6.15 0 0 1-1.159.236z"
                                                            ></path>
                                                        </svg>
                                                        <span class="dress-card-crossed"><?=intval($cart_row->mrp_price)?> </span>
                                                        <span class="dress-card-off">&ensp;(<?=intval($cart_row->discount)?>% OFF)</span>
                                                    </p>
                                                    <p>Delivery By: Wed Sep 2</p>
                                                    <?php
                                                        if($cart_row->quantity > $product_quantity[$key]->stock_quentity &&  $temp==0)
                                                        {
                                                            $product_available=1;
                                                    ?>
                                                    <p><h5 style="color: red;">Number of quantity is unavailable!</h5></p>
                                                    <?php
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }?>
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
                                        <path
                                            fill-rule="nonzero"
                                            d="M1.951 5.845l3.91 3.602-.902.376L.7 5.845l.452-.711c.186-.005.392-.02.615-.048a5.2 5.2 0 0 0 1.347-.356c.218-.09.42-.201.604-.331.185-.13.345-.281.479-.455.134-.173.231-.371.29-.594H.865v-.841h3.644a1.759 1.759 0 0 0-.284-.667 1.826 1.826 0 0 0-.567-.512 2.964 2.964 0 0 0-.865-.332A5.22 5.22 0 0 0 1.63.882H.864V0h6.2v.882H4.18c.173.077.33.174.468.29a2.09 2.09 0 0 1 .612.848c.064.162.11.325.137.489h1.668v.84H5.383a2.38 2.38 0 0 1-.43 1.03 3.095 3.095 0 0 1-.8.748 4.076 4.076 0 0 1-1.043.482 6.15 6.15 0 0 1-1.159.236z"
                                        ></path>
                                    </svg>
                                    <span id="bag_total"><?=$total?></span>
                                </span>
                            </div>
                        </div>
                        <div class="priceDetail-base-row order-total">
                            <span class="price-title">Total</span>
                            <span class="base-value">
                                <svg width="8" height="10" viewBox="0 0 8 10" class="priceDetail-base-icon">
                                    <path
                                        fill-rule="nonzero"
                                        d="M1.951 5.845l3.91 3.602-.902.376L.7 5.845l.452-.711c.186-.005.392-.02.615-.048a5.2 5.2 0 0 0 1.347-.356c.218-.09.42-.201.604-.331.185-.13.345-.281.479-.455.134-.173.231-.371.29-.594H.865v-.841h3.644a1.759 1.759 0 0 0-.284-.667 1.826 1.826 0 0 0-.567-.512 2.964 2.964 0 0 0-.865-.332A5.22 5.22 0 0 0 1.63.882H.864V0h6.2v.882H4.18c.173.077.33.174.468.29a2.09 2.09 0 0 1 .612.848c.064.162.11.325.137.489h1.668v.84H5.383a2.38 2.38 0 0 1-.43 1.03 3.095 3.095 0 0 1-.8.748 4.076 4.076 0 0 1-1.043.482 6.15 6.15 0 0 1-1.159.236z"
                                    ></path>
                                </svg>
                                <span id="neet_amount"><?=$total;?></span>
                            </span>
                        </div>
                        <div class="card-button">
                            <button id="nextBtn" type="button" class="btn card-button-inner bag-button buy-btn btn-block place-order" onclick="placeOrder('<?=$product_available?>','<?=$outofstock?>')">
                                <span>Place Order</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
}
else
{
?>
            <div class="row">
                <div class="empty-bag">
                    <div class="empty-bag-inner">
                        <div class="bag-image">
                            <img src="<?=base_url()?>webroot/user/images/bag.png " />
                        </div>
                        <p>Your bag is empty</p>
                        <a href="<?=base_url()?>" class="btn card-button-inner bag-button buy-btn">
                            <span>Add items from Home</span>
                        </a>
                    </div>
                </div>
            </div>
            <?php
}
?>
        </div>
    </div>
</section>
<?php
    // echo $outofstock;
    // echo $product_available;
?>
<!-- Cart section end -->
