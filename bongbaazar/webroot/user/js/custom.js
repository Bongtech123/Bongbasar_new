$(document).ready(function(){
	// Banner Slick slider
    $(".banner-slider").slick({
      dots: false,
      infinite: true,
      autoplay:true,
      fade: true,
      adaptiveHeight: true,
      nextArrow: '<i class="slick-next wow shake"></i>',
      prevArrow: '<i class="slick-prev wow shake"></i>',
    });
  // End banner slick-slider

  /*Gallery slider start*/
    $(".product-slider").slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 5,
      slidesToScroll: 1,
      adaptiveHeight: true,
      nextArrow: '<i class="slick-next wow shake"></i>',
      prevArrow: '<i class="slick-prev wow shake"></i>',
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: true,
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });
  /*Gallery slider end*/

  /*Seller slider start*/
    $(".seller-slider").slick({
      slidesToShow: 7,
      slidesToScroll: 1,
      autoplay: false,
      autoplaySpeed: 2000,
      adaptiveHeight: true,
      cssEase: 'cubic-bezier(0.600, -0.280, 0.735, 0.045)',
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });
  /*Seller Slider end*/

  /*happy-customers slider start*/
    $(".massage-slider").slick({
      dots: false,
      infinite: true,
      speed: 500,
      fade: true,
      adaptiveHeight: true,
      cssEase: 'linear',
      autoplay: true,
    });
        
  /*Happy customers slider end*/

  /*Product view gallery start*/
    /*// add all to same gallery
    $(".gallery a").attr("data-fancybox","mygallery");
    // assign captions and title from alt-attributes of images:
    $(".gallery a").each(function(){
      $(this).attr("data-caption", $(this).find("img").attr("alt"));
      $(this).attr("title", $(this).find("img").attr("alt"));
    });
    // start fancybox:
    $(".gallery a").fancybox();*/
  /*Product view gallery end*/

  /*Product Show gallery start*/
    $('.slider-for').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      fade: true,
      adaptiveHeight: true,
      asNavFor: '.slider-nav'
    });
    $('.slider-nav').slick({
      slidesToShow: 5,
      slidesToScroll: 1,
      asNavFor: '.slider-for',
      dots: false,
      arrows: true,
      centerMode: true,
      adaptiveHeight: true,
      focusOnSelect: true
    });
  /*Product show gallery end*/

  /*----------Side filter bar start----------*/
    // const $button  = document.querySelector('#sidebar-toggle');
    // const $wrapper = document.querySelector('#wrapper');

    // $button.addEventListener('click', (e) => {
    //   e.preventDefault();
    //   $wrapper.classList.toggle('toggled');
    // });

    $("#sidebar-toggle").click(function(){
      $("#wrapper").toggleClass("toggled");
    });

  /*----------Side filter bar end----------*/

  /*----Mobile view search menu open start----*/
    $("#openSearch").click(function(){
      $("#myNavbar").toggleClass("open");
    });
  /*Mobile view search menu end*/

  /*---------Side nav accordian start---------*/
    $( "#accordion" ).accordion({
      heightStyle: "content",
      active:false,
      collapsible: true,
      header:"div.accordianheader"
    });
    /*Side nav accordian end*/

    /*---------More menu sidebar start---------*/
      /*$(".openClose").click(function(){
        $(".more-options").toggleClass("active");
      });*/

      $('html').click(function() {
          $('.more-files-directory').hide();
      })

      $('.more-options').click(function(e){
           e.stopPropagation();
      });

      $('.openClose').click(function(e) {
       $('.more-files-directory').toggle();
      });

    /*More menu side bar end*/

    /*Back to top start*/
      var btn = $('#back-to-top');

      $(window).scroll(function() {
        if ($(window).scrollTop() > 300) {
          btn.addClass('show');
        } else {
          btn.removeClass('show');
        }
      });

      btn.on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({scrollTop:0}, '300');
      });
    /*Back to top end*/
});

jQuery(document).ready(function($) {
    $(".counter").counterUp({
        delay: 10,
        time: 1000
    });
});

/* Increment product quantity  start*/
  //Up Down arrows for quantity field
  var qtyMin,
  qtyMax,
  qtyField,
  qtyVal;
  $('.icon-minus-squared').on('click', function() {
     qtyField = $(this).next('input[type=number]');
     qtyMin = parseInt($(qtyField).attr('min'));
     qtyVal = parseInt($(qtyField).val());
     if (qtyVal > qtyMin) {
         qtyVal--;
         $(qtyField).val(qtyVal);
         $(this).siblings('.icon-plus-squared').removeClass('off');
         if (qtyVal === qtyMin) {
             $(this).addClass('off');
         }
     }
  });
  $('.icon-plus-squared').on('click', function() {
     qtyField = $(this).prev('input[type=number]');
     qtyMax = parseInt($(qtyField).attr('max'));
     qtyVal = parseInt($(qtyField).val());
     if (qtyVal < qtyMax) {
         qtyVal++;
         $(qtyField).val(qtyVal);
         $(this).siblings('.icon-minus-squared').removeClass('off');
         if (qtyVal === qtyMax) {
             $(this).addClass('off');
         }
     }
  });

  //Validate numeric range of number fields (for quantity input
  $('input[type=number]').on('blur', function () {
      var $this = $(this);
      if ($this.attr('min').length > 0 && $this.attr('max').length > 0) {
          vQty = parseInt($this.val()),
          vMin = $this.attr('min'),
          vMax = $this.attr('max');
          if (!$.isNumeric(vQty)) {
              $this.val(vMin);
            $('.icon-plus-squared').removeClass('off')
            $('.icon-minus-squared').addClass('off')
          }
          else if (vQty < vMin) {
              $this.val(vMin);
            $('.icon-plus-squared').removeClass('off')
            $('.icon-minus-squared').addClass('off')
          }
          else if (vQty > vMax) {
              $this.val(vMax);
            $('.icon-minus-squared').removeClass('off')
            $('.icon-plus-squared').addClass('off')
          }
          else { return; }
      }
  });

/* Increment product quantity  emd*/

/*Give star rating start*/
  var stars = $(".star__item");
  var starsActive;
  var starsSelect;
    
  stars.hover(function(el) {
    starsActive = stars.slice(0, $(this).index()+1);
    starsActive.addClass("star__item_active");
  },
  function(){
    stars.removeClass("star__item_active");
  });

  stars.on("click", function() {
    stars.removeClass("star__item_select");
    starsActive.addClass("star__item_select");
    starsSelect = starsActive;
  });
/*Give star rating end*/


/*Like & dislike start*/
  /*var btn1 = document.querySelector('#green');
  var btn2 = document.querySelector('#red');

  btn1.addEventListener('click', function() {
    
      if (btn2.classList.contains('red')) {
        btn2.classList.remove('red');
      } 
    this.classList.toggle('green');
    
  });

  btn2.addEventListener('click', function() {
    
      if (btn1.classList.contains('green')) {
        btn1.classList.remove('green');
      } 
    this.classList.toggle('red');
    
  });*/

/*Like & dislike end*/

/*Like & Dislike Counter start*/
  var lClicks = 0;
  var dClicks = 0;

  $(".likes").on("click", function(){
    lClicks += 1;
      document.getElementById("l-counter").innerHTML = lClicks;
  })

  $(".dislikes").on("click", function(){
    dClicks += 1;
      document.getElementById("d-counter").innerHTML = dClicks;
  })
/*Like & Dislike Counter end*/

/*---------Window on load loader start---------*/
  // setTimeout(function(){
  //   $('body').addClass('loaded');
  // }, 100);
/*Window on load loader end*/
// SwapanStart
$(function () {                
    $("#login").validationEngine();
    $("#register").validationEngine();
    $("#register-step").validationEngine();
    $("#address-add").validationEngine();
    $("#address-edit").validationEngine();
    $("#user_profile").validationEngine();
    $("#searchEngine").validationEngine();
});
$(".only_character").keypress(function (e) {
      var regex = new RegExp("^[a-zA-Z ]+$");
      var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
      if (regex.test(str)) {
          return true;
      }

      e.preventDefault();
      return false;
  });

 $(".only_integer").keypress(function(event) {
  var inputValue = event.charCode;  
  if (!(inputValue >= 48 && inputValue <= 57)) {
    event.preventDefault();
  }  
});

function toggleShowPassword()
{
    var x = document.getElementById("password");
    var imgsrc = document.getElementById("showicon");
    if (x.type === "password") {
        $('#showicon').removeClass('fa fa-eye-slash');
        $('#showicon').addClass('fa fa-eye');
        x.type = "text";                    
    } else {
        
        $('#showicon').removeClass('fa fa-eye');
        $('#showicon').addClass('fa fa-eye-slash');
        x.type = "password";                    
    }
}
$(document).ready(function()
{

$('#login').on('submit', function (e) 
{
  if($('#userId').val() != '' && $('#password').val() != '')
  {
    $('.error').hide();
    var base_url=$('#base_url').val();
      e.preventDefault();
      $.ajax({
      type: 'post',
      dataType: 'json',
      url:base_url+'/verify',
      data: $('#login').serialize(),
          success: function (data) 
          {
                  console.log(data.result)
                  if (data.result ==1)
                  {
                       location.reload();
                  }
                  else
                  { 
                      $('.error').show();  
                      $('.error').html('Please enter your registered E-mail|mobile no. and valid password.').delay(4000).fadeOut('slow');  
                   
                  }
          }
      });
  }
});

});

$('#register').on('submit', function (e) 
{   
  if($('#mobile_no').val() != '')
  {
    var str=$('#mobile_no').val();
    var mobile_no=str.length;

    if(mobile_no=='10')
    {
      $('.reg-error').hide();
      var base_url=$('#base_url').val();
      e.preventDefault();
      $.ajax({
      type: 'post',
      url:base_url+'register',
      data: $('#register').serialize(),
          success: function (data) 
          {
            console.log(data);
            if(data==0)
            {
              $('.reg-error').show();
              $('.reg-error').html('Mobile number allreday exits !').delay(1000).fadeOut('show');
            }
            else
            {
              $('#menu1').html(data);  

              //alert('hi');
            }
          }
      });
    }
  }
});


function changefname()
{
  $("#first_name").prop( "disabled",false);
  $("#submit").prop( "disabled",false);
}
function changelname()
{
  $("#last_name" ).prop( "disabled",false);
  $("#submit").prop( "disabled",false);
}

function changeemail()
{
  $("#email").prop( "disabled",false);
  $("#submit").prop( "disabled",false);
}
function changegender()
{
  $("#male").prop( "disabled",false);
  $("#female").prop( "disabled",false);
  $("#submit").prop( "disabled",false);
}

function li_selected(str)
{
  var base_url=$('#base_url').val();
  var res = str.split("_sm_");
  $("#size_selected").val(res[0]);
  $("#size_selected_position").val(res[1]);
  var uniqcode=$('#hidden_uniqcode').val(); 
  var category_id=$('#hidden_category_id').val();
  var sub_category_id=$('#hidden_sub_category_id').val();
  var child_category_id=$('#hidden_child_category_id').val();
  var position=$('#hidden_position').val();
  var size=$('#size_selected').val();
  var size_position=$('#size_selected_position').val();
  if(uniqcode != '')
  {
    $.ajax({
      type: 'post',
      url:base_url+'bag-check',
      data:{
        product_id:uniqcode,
        category_id:category_id,
        sub_category_id:sub_category_id,
        child_category_id:child_category_id,
        size:size,
        size_position:size_position,
        position:position
        },
        success: function (data) 
        {
          if(data=='0')
          {
            return false;
          }
          else
          {
            $('#change_buton_type').html(data);
          }
        }
    });
  }

}

function addToBag()
{
  var business_type=$('#business_type').val(); 
  var product_id=$('#product_id').val(); 
  var product_features_id=$('#product_features_id').val(); 
  var color_id=$('#color_id').val(); 
  var base_url=$('#base_url').val();
  if(business_type != '' && product_id != '' && product_features_id != '' && color_id != 'Wholesaler')
  {
    $.ajax({
      type: 'post',
      url:base_url+'add-to-bag',
      dataType: 'json',
      data:{
        business_type:business_type,
        product_id:product_id,
        product_features_id:product_features_id,
        color_id:color_id
        },
        success: function (data) 
        {
          if(data.result==0)
          {
            $('#signIn').modal('show');
          }
          else
          {
            location.reload();    
          }
        }
    });
  }
}

function goToBag()
{
  var base_url=$('#base_url').val();
  var url=base_url+'bag';
  location.assign(url);
}

function buyNou()
{
  var business_type=$('#business_type').val(); 
  var product_id=$('#product_id').val(); 
  var product_features_id=$('#product_features_id').val(); 
  var color_id=$('#color_id').val(); 
  var base_url=$('#base_url').val();

  if(business_type != '' && product_id != '' && product_features_id != '' && color_id != 'Wholesaler')
  {
    $.ajax({
      type: 'post',
      url:base_url+'add-to-bag-buy-nou',
      dataType: 'json',
      data:{
        business_type:business_type,
        product_id:product_id,
        product_features_id:product_features_id,
        color_id:color_id
        },
        success: function (data) 
        {
          if(data.result==0)
          {
            $('#signIn').modal('show');
          }
          else
          {
            if(data.result=='1')
            {
              var url=base_url+'buy-address';
              location.assign(url); 
            }
            else
            {
              location.reload();  
            }
          }
        }
    });
  }
}

function removeItem(uniqcode)
{
  if(confirm("Are you sure you want to remove item in your bag!"))
  {
    if(uniqcode!=null)
    {
      var base_url=$('#base_url').val();
      $.ajax({
        type: 'post',
        url:base_url+'remove-bag',
        data:{uniqcode:uniqcode},
          success: function (data) 
          {
            location.reload();    
          }
      });
    }
    else
    {
        return false;
    }
  }
}

function quentityUpdate(id)
{
  //alert('hi');
  var cart_id=$("#uniqcode"+id).val();
  var sell_price=parseInt($("#sell_price"+id).val());
  var quantity=(1+parseInt($("#quen"+id).val()));
  var totalamount=parseInt($("#totalamount").val());

  var base_url=$('#base_url').val();
    $.ajax({
      type: 'post',
      url:base_url+'update-bag',
      dataType: 'json',
      data:{uniqcode:cart_id,quantity:quantity},
        success: function (data) 
        {
          console.log(data);
          if(data.result==1)
          {
          
            //var totalmrpamount=parseInt($("#totalmrpamount").val());

            var amount=(totalamount+sell_price);
            $("#totalamount").val(amount);
            $("#totalamount_view").html(amount);
            $("#bag_total").html(amount);
            $("#neet_amount").html(amount);
          }
          else
          {
            location.reload();    
          }
        }
    });
}
function quentityDecrement(id)
{
  var cart_id=$("#uniqcode"+id).val();
  var sell_price=parseInt($("#sell_price"+id).val());
  var quantity=((parseInt($("#quen"+id).val())-1));
  var totalamount=parseInt($("#totalamount").val());
  var base_url=$('#base_url').val();
    $.ajax({
      type: 'post',
      url:base_url+'update-bag',
      dataType: 'json',
      data:{uniqcode:cart_id,quantity:quantity},
        success: function (data) 
        {
          console.log(data);
          if(data.result==1)
          {
            var amount=(totalamount-sell_price);
            $("#totalamount").val(amount);
            $("#totalamount_view").html(amount);
            $("#bag_total").html(amount);
            $("#neet_amount").html(amount);
          }
          else
          {
            location.reload();    
          }
        }
    });
}

function placeOrder()
{
  var base_url=$('#base_url').val();
  var url=base_url+'address';
  location.assign(url);
}
function placeOrder1()
{
  var address_id=$("input[name='order_address']:checked").val();
  var base_url=$('#base_url').val();
  var current_url=$('#current_url').val();
  if(address_id != null)
  {
    var url=base_url+'order/'+address_id;
    location.assign(url); 
  }
  else
  {
    alert('You Do Not Select Any Address!');
    location.assign(current_url);
  }
 
}

function buyPlaceOrder1()
{
  var address_id=$("input[name='order_address']:checked").val();
  var base_url=$('#base_url').val();
  var current_url=$('#current_url').val();
  if(address_id != null)
  {
    
    var url=base_url+'buy-order/'+address_id;
    location.assign(url); 
  }
  else
  {
    alert('You Do Not Select Any Address!');
    location.assign(current_url);
  }
}

function removeAddress(uniqcode)
{
  if(uniqcode!=null)
  {
    alert('hi'+uniqcode);
    // var base_url=$('#base_url').val();
    // $.ajax({
    //   type: 'post',
    //   url:base_url+'remove-bag',
    //   data:{uniqcode:uniqcode},
    //     success: function (data) 
    //     {
    //       location.reload();    
    //     }
    // });
  }
  else
  {
      return false;

  }
}

function get_upload_profile(x) 
{
  $("#profile_input_upload").trigger("click"); 
}
function profile_show_photo(input, x) 
{
    if (input.files && input.files[0]) 
    {
    var reader = new FileReader();
    var FileSize = input.files[0].size / 1024 / 1024; // in MB
        var FileType = input.files[0].type;
        var ext = $('#profile_input_upload').val().split('.').pop().toLowerCase();
        if($.inArray(ext, ['JPEG','PNG','JPG','png','jpg','jpeg']) == -1) 
        {
            alert('invalid extension!');
            $("#profile_input_upload").val('');
        }
        else
        {
        
            if(FileSize < 1)
            {
                $(".change-profile-btn").css('display', 'block');
                reader.onload = function (e) {
                $('#upload_profile')
                .attr('src', e.target.result)
                .width(150)
                .height(150);
            };
                reader.readAsDataURL(input.files[0]);
            }
            else
            {
                alert('Maximum file size 1MB can be upload');
                $(input).val('');
            }
        } 
    }
}

function editAddress(uniqcode)
{
  if(uniqcode!=null)
  {
    var base_url=$('#base_url').val();
    $('#update_address').modal('show');

    $.ajax({
      type: 'post',
      url:base_url+'address-edit',
      data:{uniqcode:uniqcode},
        success: function (html) 
        {
          $('#address_show').html(html);  
        }
    });
  }
  else
  {
      return false;

  }
}

function editAddressOrder(uniqcode)
{
  if(uniqcode!=null)
  {
    var base_url=$('#base_url').val();
    $('#update_order_address').modal('show');

    $.ajax({
      type: 'post',
      url:base_url+'address-edit-order',
      data:{uniqcode:uniqcode},
        success: function (html) 
        {
          $('#address_show').html(html);  
        }
    });
  }
  else
  {
    return false;
  }
}

function buyEditAddressOrder(uniqcode)
{
   if(uniqcode!=null)
  {
    var base_url=$('#base_url').val();
    $('#update_order_address').modal('show');

    $.ajax({
      type: 'post',
      url:base_url+'buy-address-edit-order',
      data:{uniqcode:uniqcode},
        success: function (html) 
        {
          $('#address_show').html(html);  
        }
    });
  }
  else
  {
    return false;
  }
}


function backPage()
{
  var base_url=$('#base_url').val();
  var url=base_url+'address ';
  location.assign(url);
}

function buyBackPage()
{
  var base_url=$('#base_url').val();
  var url=base_url+'buy-address ';
  location.assign(url);
}

function backPageCart()
{
  var base_url=$('#base_url').val();
  var url=base_url+'bag ';
  location.assign(url);
}

function wishlist(spid)
{
  if(spid != '' )
  {
    var base_url=$('#base_url').val();
    $.ajax({
      type: 'post',
      url:base_url+'wishlist',
      dataType: 'json',
      data:{pf_id:spid},
        success: function (data) 
        {
          console.log(data);
          if(data.result==0)
          {
            $('#signIn').modal('show');
          }
          else
          {
            location.reload();    
          }
        }
    });
  }
}
function payOnDelivery(address_id)
{
  if(address_id != '')
  {
    var capcha=$('#capcha').val();
    var hidencapcha=$('#hidencapcha').val();
    if(capcha==hidencapcha)
    {
      var base_url=$('#base_url').val();
      $.ajax({
        type: 'post',
        url:base_url+'pay-on-delivery',
        dataType: 'json',
        data:{address_id:address_id},
          success: function (data) 
          {
         
            if(data.result==1)
            {
              var url=base_url+'order-success';
              location.assign(url);
            }
            else
            {
              var url=base_url+'order-error';
              location.assign(url);   
            }
          }
      });
    }
    else
    {
      alert('Invalid capcha!');
    }
  }
}

function lowToHighFilter()
{ 
  var sub_category_id=$('#sub_category_id').val();
  var child_category_id=$('#child_category_id').val();
  var base_url=$('#base_url').val();

  if(sub_category_id !='' && child_category_id!='')
  {
    var url=base_url+'filter-low-high/'+sub_category_id+'_'+child_category_id;
    $.ajax({
      type: 'post',
      url:url,
      data:{sub_category_id:sub_category_id,child_category_id:child_category_id},
        success: function (data) 
        {
          var all_data=data.split('##');
          // alert(all_data)
          $('#filter_data').html(all_data[0]);
          $('#pagination_data').html(all_data[1]);

        }
    });
  }    
}

function highTolowFilter()
{ 
  var sub_category_id=$('#sub_category_id').val();
  var child_category_id=$('#child_category_id').val();
  var base_url=$('#base_url').val();

  if(sub_category_id !='' && child_category_id!='')
  {
    var url=base_url+'filter-high-low/'+sub_category_id+'_'+child_category_id;
    
    $.ajax({
      type: 'post',
      url:url,
      data:{sub_category_id:sub_category_id,child_category_id:child_category_id},
        success: function (data) 
        {
          var all_data=data.split('##');
          // alert(all_data)
          $('#filter_data').html(all_data[0]);
          $('#pagination_data').html(all_data[1]);
        }
    });
  }
}

function atoz()
{
  var sub_category_id=$('#sub_category_id').val();
  var child_category_id=$('#child_category_id').val();
  var base_url=$('#base_url').val();

  if(sub_category_id !='' && child_category_id!='')
  {
    var url=base_url+'a-to-z/'+sub_category_id+'_'+child_category_id;
     
    $.ajax({
      type: 'post',
      url:url,
      data:{sub_category_id:sub_category_id,child_category_id:child_category_id},
        success: function (data) 
        {
          var all_data=data.split('##');
          // alert(all_data)
          $('#filter_data').html(all_data[0]);
          $('#pagination_data').html(all_data[1]);
        }
    });
  }
}

function ztoa()
{  
  var sub_category_id=$('#sub_category_id').val();
  var child_category_id=$('#child_category_id').val();
  var base_url=$('#base_url').val();
  if(sub_category_id !='' && child_category_id!='')
  {
    var url=base_url+'z-to-a/'+sub_category_id+'_'+child_category_id;
    $.ajax({
      type: 'post',
      url:url,
      data:{sub_category_id:sub_category_id,child_category_id:child_category_id},
        success: function (data) 
        {
          var all_data=data.split('##');
          // alert(all_data)
          $('#filter_data').html(all_data[0]);
          $('#pagination_data').html(all_data[1]);
        }
    });
  }
}
function rangeSlider()
{
  var sub_category_id=$('#sub_category_id').val();
  var child_category_id=$('#child_category_id').val();
  var base_url=$('#base_url').val();
  var rangestart=$('#rangestart').val();
  var rangeend=$('#rangeend').val();
  if(sub_category_id !='' && child_category_id!='')
  {
    var url=base_url+'range-slider/'+sub_category_id+'_'+child_category_id;
    $.ajax({
      type: 'post',
      url:url,
      data:{
        sub_category_id:sub_category_id,
        child_category_id:child_category_id,
        rangestart:rangestart,
        rangeend:rangeend
      },
        success: function (data) 
        {
          var all_data=data.split('##');
          // alert(all_data)
          $('#filter_data').html(all_data[0]);
          $('#pagination_data').html(all_data[1]);
        }
    });
  }
  
}
function shopLocation()
{
  var location = $('#select-country').val();
  //alert(location);
  if(location !='')
  {
    var base_url=$('#base_url').val();
    var url=base_url+'shop-select-city';
    $.ajax({
      type: 'post',
      url:url,
      data:{
        city:location
      },
        success: function (data) 
        {
          if(data=='empty')
          {
            $('#edid_shop').html();
          }
          else
          {
            $('#edid_shop').html(data);
          }
        }
    });
  }
  
}

function shopSelect()
{
  var location = $('#select-country').val();
  var shop_input = document.getElementById("shop_search_name").value;
  //alert(shop_input);
  if(shop_input !='')
  {
    var base_url=$('#base_url').val();
    var url=base_url+'shop-select';
    $.ajax({
      type: 'post',
      url:url,
      data:{
        shop_input:shop_input,
        location:location
      },
        success: function (data) 
        {
          if(data=='empty')
          {
            $('#edid_shop').html();
          }
          else
          {
            $('#edid_shop').html(data);
          }
        }
    });
  }
}

function shopProduct(shopid)
{
  var shop_product=$('#shop_product').val();
  //alert('hi'+shop_product+shopid);

  if(shop_product !='')
  {
    var base_url=$('#base_url').val();
    var url=base_url+'shop-product-select';
    $.ajax({
      type: 'post',
      url:url,
      data:{
        shop_product:shop_product,
        shopid:shopid
      },
        success: function (data) 
        {
          if(data=='empty')
          {

            $('#filter_data').html('<h1>data do not found</h1>');
          }
          else
          {
          
            $('#filter_data').html(data);
          }
        }
    });
  }   
}

function shop_refresh()
{
  location.reload();   
}

function changeStatusSearch()
{
  var search_product=$('#autocomplete1').val();
  if(search_product !='')
  {
    $('#sbutton').attr('type', 'submit');
  }
}

$(document).ready(function()
{
  //alert('hi');
  // filter_data();
  // function filter_data()
  // {
     
      
  // }
  $('.comon_selector').click(function()
  {
    var color=get_filter('color');
    var size=get_filter('size');
    var brand=get_filter('brand');
    var rangestart=$('#rangestart').val();
    var rangeend=$('#rangeend').val();
    console.log(color);
    console.log(size);
    console.log(brand);
    console.log(rangestart);
    console.log(rangeend);
    //  $.ajax({
    //     url     : "<?php echo base_url(); ?>Filter/getAll",
    //     method  : "POST",
    //     //dataType:'json',
    //     data: { action:action,Edu:Education,Ind:Industry},
    //     success: function(data) 
    //     {
    //       console.log(data);
    //        $('.filter_data').html(data);
    //     }
    // });
  });


  function get_filter(class_name)
  {
      var filter=[];
      $('.'+class_name+':checked').each(function(){
          filter.push($(this).val());
      });
      //console.log(filter);
      return filter;
  }

  $('#search_text_color').keyup(function()
  {
    var base_url=$('#base_url').val();
    var child_category_id=$('#child_category_id').val();
    var search = $(this).val(); 
    if(search != '')
    {
      $.ajax({
          url     : base_url+'color',
          method  : "POST",
          //dataType:'json',
          data: { child_category_id:child_category_id,color:search},
          success: function(data) 
          {
            $('#filterColor').html(data);
          }
      });
    }
    
  });

  $('#search_text_size').keyup(function()
  {
    var base_url=$('#base_url').val();
    var child_category_id=$('#child_category_id').val();
    var search = $(this).val(); 
    if(search != '')
    {
      $.ajax({
          url     : base_url+'size',
          method  : "POST",
          //dataType:'json',
          data: { child_category_id:child_category_id,size:search},
          success: function(data) 
          {
            $('#filterSize').html(data);
          }
      });
    }
    
  });

  $('#search_text_brand').keyup(function()
  {
    var base_url=$('#base_url').val();
    var child_category_id=$('#child_category_id').val();
    var search = $(this).val(); 
    if(search != '')
    {
      $.ajax({
          url     : base_url+'brand',
          method  : "POST",
          //dataType:'json',
          data: { child_category_id:child_category_id,brand:search},
          success: function(data) 
          {
            $('#filterBrand').html(data);
          }
      });
    }
    
  });
  
  $('#admin_search_text_color').keyup(function()
  {
    var base_url=$('#base_url').val();
    var admin_id=$('#admin_id').val();
    var search = $(this).val(); 
    if(search != '')
    {
      $.ajax({
          url     : base_url+'admin-color',
          method  : "POST",
          //dataType:'json',
          data: { admin_id:admin_id,color:search},
          success: function(data) 
          {
            $('#filterColor').html(data);
          }
      });
    }
    
  });

  $('#admin_search_text_size').keyup(function()
  {
    var base_url=$('#base_url').val();
    var admin_id=$('#admin_id').val();
    var search = $(this).val(); 
    if(search != '')
    {
      $.ajax({
          url     : base_url+'admin-size',
          method  : "POST",
          //dataType:'json',
          data: { admin_id:admin_id,size:search},
          success: function(data) 
          {
            $('#filterSize').html(data);
          }
      });
    }
    
  });

  $('#admin_search_text_brand').keyup(function()
  {
    var base_url=$('#base_url').val();
    var admin_id=$('#admin_id').val();
    var search = $(this).val(); 
    if(search != '')
    {
      $.ajax({
          url     : base_url+'admin-brand',
          method  : "POST",
          //dataType:'json',
          data: { admin_id:admin_id,brand:search},
          success: function(data) 
          {
            $('#filterBrand').html(data);
          }
      });
    }
    
  });
  

  

});

 function createCapcha()
  {
    var base_url=$('#base_url').val();
    $.ajax({
          url     : base_url+'random',
          method  : "POST",
          //dataType:'json',
          success: function(data) 
          {
            //$("#totalamount").val(amount);
            $("#showCapcha").html(data);
          }
            
      });
  }

  function shortBy(order)
  {
    var current_url=window.location.href;
    var url = new URL(current_url);
    if(window.location.search)
    {
      var shortBy=url.searchParams.get("shortBy");
      if(shortBy!=null)
      {
        res=current_url.replace(shortBy,order);
        window.location=res;
      }
      else
      {
        res=current_url+"&shortBy="+order;
        window.location=res;
      }
    }
    else
    {
      res=current_url+"?shortBy="+order;
      window.location=res;
    }
  }

  function shortByColor()
  {
    var current_url=window.location.href;
    var url = new URL(current_url);
    var filter='';
    $('.color:checked').each(function(){
        filter=filter+$(this).val()+",";
    });
    filter = filter.slice(0, -1)

    if(window.location.search)
    {
      var color=url.searchParams.get("color");
      if(color!=null)
      {
        res=current_url.replace(color,filter);
        window.location=res;
      }
      else
      {
        res=current_url+"&color="+filter;
        window.location=res;
      }
    }
    else
    {
      res=current_url+"?color="+filter;
      window.location=res;
    }
  }

  function shortBySize()
  {
    var current_url=window.location.href;
    var url = new URL(current_url);
    var filter='';
    $('.size:checked').each(function(){
        filter=filter+$(this).val()+",";
    });
    filter = filter.slice(0, -1)

    if(window.location.search)
    {
      var size=url.searchParams.get("size");
      if(size!=null)
      {
        res=current_url.replace(size,filter);
        window.location=res;
      }
      else
      {
        res=current_url+"&size="+filter;
        window.location=res;
      }
    }
    else
    {
      res=current_url+"?size="+filter;
      window.location=res;
    }
  }

  function shortByBrand()
  {
    var current_url=window.location.href;
    var url = new URL(current_url);
    var filter='';
    $('.brand:checked').each(function(){
        filter=filter+$(this).val()+",";
    });
    filter = filter.slice(0, -1)

    if(window.location.search)
    {
      var brand=url.searchParams.get("brand");
      if(brand!=null)
      {
        res=current_url.replace(brand,filter);
        window.location=res;
      }
      else
      {
        res=current_url+"&brand="+filter;
        window.location=res;
      }
    }
    else
    {
      res=current_url+"?brand="+filter;
      window.location=res;
    }
  }


