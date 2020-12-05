<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home/HomeController';
$route['translate_uri_dashes'] = FALSE;

$route['product-low-to-high-all'] = 'product/ProductController/ProductLowToHighAll';

$route['clothing-all'] = 'product/ProductController/ClothingAll';
$route['clothing-all-discount'] = 'product/ProductController/ClothingAllDiscount';

$route['accessories-all'] = 'product/ProductController/AccessoriesAll';
$route['accessories-all-discount'] = 'product/ProductController/AccessoriesAllDiscount';

$route['shoes-all'] = 'product/ProductController/ShoesAll';
$route['shoes-all-discount'] = 'product/ProductController/ShoesAllDiscount';

$route['special-care-all'] = 'product/ProductController/SpecialCareAll';
$route['special-care-all-discount'] = 'product/ProductController/SpecialCareAllDiscount';

$route['all-shop'] = 'seller/SellerController/SellerAll';
$route['shop/([a-zA-Z0-9]+)'] ='seller/SellerController/Seller/$1';
$route['admin-color'] = 'seller/SellerController/productColor';
$route['admin-size'] = 'seller/SellerController/productSize';
$route['admin-brand'] = 'seller/SellerController/productBrand';

$route['shop-select-city'] ='seller/SellerController/shopSelectCity';

$route['shop-select'] ='seller/SellerController/sellerSelectCityName';
$route['shop-product-select'] ='seller/SellerController/sellerSelectProduct';


$route['category-all-product/([a-zA-Z0-9]+)'] ='product/ProductController/categoryAll/$1';
$route['category-all-product/([a-zA-Z0-9]+)/([a-zA-Z0-9]+)'] ='product/ProductController/categoryAll/$1';

$route['register'] = 'user/UserController/UserRegister';
$route['register-step'] = 'user/UserController/UserRegisterStep';
$route['verify'] = 'login/LoginController/verify';
$route['logout'] = 'login/LoginController/logout';
$route['profile'] = 'user/UserController/profile';
$route['oders'] = 'user/UserController/oders';
$route['wishlist'] = 'user/UserController/wishlist';
$route['notifications'] = 'user/UserController/notifications';

$route['profile-update'] = 'user/UserController/ProfileUpdate';
$route['profile-picture-update'] = 'user/UserController/ProfilePictureUpdate';
$route['search-engine'] = 'search/SearchController/searchEngine';
$route['all-product-name'] = 'search/SearchController/searchAllProductName';
//$route['test-test'] = 'user/UserController/test';


$route['product/(:any)'] = 'product/ProductController/product';
$route['color'] = 'product/ProductController/productColor';
$route['size'] = 'product/ProductController/productSize';
$route['brand'] = 'product/ProductController/productBrand';
$route['min-max'] = 'product/ProductController/ ';


$route['product-change'] = 'product/ProductController/productChange';

$route['add-to-bag'] = 'cart/CartController/addToBag';
$route['add-to-bag-buy-nou'] = 'cart/CartController/addToBagBuyNou';
$route['add-to-bag-hand'] = 'cart/CartController/addToBagHand';
$route['bag-check'] = 'cart/CartController/BagCheck';
$route['bag'] = 'cart/CartController/Bag';
$route['remove-bag'] = 'cart/CartController/destroy';
$route['update-bag'] = 'cart/CartController/bagUpdate';

$route['address'] = 'address/AddressController/index';
$route['address-add'] = 'address/AddressController/addAddress';
$route['address-add-order'] = 'address/AddressController/addAddressOrder';

$route['buy-address'] = 'address/AddressController/buyAddress';
$route['buy-address-add-order'] = 'address/AddressController/buyAddAddressOrder';



$route['address-edit'] = 'address/AddressController/editAddress';
$route['address-edit-order'] = 'address/AddressController/editAddressOrder';
$route['buy-address-edit-order'] = 'address/AddressController/buyEditAddressOrder';

$route['address-update'] = 'address/AddressController/updateAddress';
$route['address-update-order'] = 'address/AddressController/updateAddressOrder';
$route['buy-address-update-order'] = 'address/AddressController/buyUpdateAddressOrder';

$route['address-destroy/([a-zA-Z0-9]+)'] = 'address/AddressController/addressDestroy/$1';
$route['address-destroy-order/([a-zA-Z0-9]+)'] = 'address/AddressController/addressDestroyOrder/$1';
$route['buy-address-destroy-order/([a-zA-Z0-9]+)'] = 'address/AddressController/BuyAddressDestroyOrder/$1';

$route['order/([a-zA-Z0-9]+)'] = 'order/OrderController/index/$1';
$route['order-destroy/([a-zA-Z0-9]+)'] = 'order/OrderController/destroy/$1';
$route['delivery-details/([a-zA-Z0-9]+)'] = 'order/OrderController/deliveryDetails/$1';

$route['buy-order/([a-zA-Z0-9]+)'] = 'order/OrderController/byOrder/$1';


$route['random'] = 'order/OrderController/randomNumber';



$route['pay-on-online'] = 'order/OrderController/payOnOnline';
$route['pay-on-online-buy'] = 'order/OrderController/payOnOnlineBuy';
$route['pay-on-delivery']='order/OrderController/cashOnDelivery';
$route['pay-on-delivery-buy']='order/OrderController/cashOnDeliveryBuy';
$route['order-success']='order/OrderController/success';
$route['order-error']='order/OrderController/error';

$route['privacy-policy'] = 'policy/PolicyController/privacyPolicy';
$route['payment-policy'] = 'policy/PolicyController/paymentPolicy';
$route['shipping-policy'] = 'policy/PolicyController/shippingPolicy';
$route['term-conditions'] = 'policy/PolicyController/termConditions';
$route['replacement'] = 'policy/PolicyController/replacement';
$route['security'] = 'policy/PolicyController/security';
$route['report-infirngement'] = 'policy/PolicyController/reportInfirngement';

/*Filter search start*/
$route['filter-low-high'] = 'search/SearchController/lowToHigh';
$route['filter-low-high/([a-zA-Z0-9]+)'] = 'search/SearchController/lowToHigh';

/*Filter search end*/






	
/*web router end*/
//=========CUSTOM ERROR PAGE=======//
$route['403_override'] = 'ErrorController/error';
$route['404_override'] = 'ErrorController/error';
// $route['500_override'] = 'ErrorController/error';

