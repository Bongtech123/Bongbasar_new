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

  // Modal open close start
    $("#forget1").click(function()
    {
      $("#forget").css("display", "block");
      $("#login").css("display", "none");
    });

    $("#sign_in1").click(function()
    {
      $("#forget").css("display", "none");
      $("#login").css("display", "block");
    });

    $("#sign_in2").click(function()
    {
      $("#submit_forget").css("display", "none");
      $("#login").css("display", "block");
    });
  // Modal open close end

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
/* -0-----Custom select dropdown js start-0-----*/
var x, i, j, l, ll, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("custom-select");
l = x.length;
for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  ll = selElmnt.length;
  /*for each element, create a new DIV that will act as the selected item:*/
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < ll; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);
// Custom select dropdown js End




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
    $("#forget").validationEngine();
    $("#submit_forget").validationEngine();
    $("#email_check").validationEngine();
   
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
      url:base_url+'verify',
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
      dataType:'json',
      data:{mobile_no:str},
          success: function (data) 
          {
            if(data.msg == 1)
            {
              $("#register").css('display','none');
              $("#register-step").css('display','block');
              $("#reg_mobile_no").val(data.mobile_no);
              timer_set1();
            }
            else
            {
              
              $('#home').removeClass('tab-pane fade in');
              $('#menu1').removeClass('tab-pane fade in');
              $('#home').addClass('tab-pane fade active in');
              $('#menu1').addClass('tab-pane fade');
              $('#limenu').removeClass('active');
              $('#lihome').addClass('active');
              $("#userId").val(str);
              $("#register").css('display','none');
            }
          }
      });
    }
  }
});
$('#limenu').on('click', function (e) 
{ 
  $("#register").css('display','block');
});

$("#register-step").on("submit", function (e) 
{
 
       $(".reg-step-error").hide();
        var base_url=$("#base_url").val();
        var mobile_no=$("#reg_mobile_no").val();
        var password=$("#password1").val();
        var otp=$("#rotp").val();
        e.preventDefault();
    if( password!= "" &&  otp!= "")
    {  
       
        $.ajax({
        type: "post",
        dataType: "json",
        url:base_url+"register-step",
        data: {reg_mobile_no:mobile_no,rotp:otp,password1:password},
            success: function (data) 
            {
                console.log(data.result)
                if (data.result==1)
                {
                    location.reload();
                }
                else if(data.result ==3)
                {
                    $(".reg-step-error").show();  
                    $(".reg-step-error").html("OTP dose not match.").delay(4000).fadeOut("slow");
                }
                else if(data.result ==4)
                {
                    $(".reg-step-error").show();  
                    $(".reg-step-error").html("You are already registered. Please log in.").delay(4000).fadeOut("slow"); 
                }
                
            }
            });
            //swapna
    }
    else
    {
      return false;
    }

});

$('#forget').on('submit', function (e) 
{  
  //alert($('#FuserId').val());
  e.preventDefault(); 
  if($('#FuserId').val() != '')
  {
    var str=$('#FuserId').val();
  
      $('.error1').hide();
      var base_url=$('#base_url').val();
      
      $.ajax({
      type: 'post',
      url:base_url+'forgot',
      dataType: 'json',
      data:{user_id:str},
          success: function (data) 
          {
           
            if(data.message == "error")
            {
         
              $('.error1').show();
              $('.error1').html('User Id Dose Not Exist !').delay(1200).fadeOut('show');
            }
            else
            {
              $("#forget").css('display', 'none');
              $("#submit_forget").css('display', 'block');
              $("#change_mobile_no").val(data.user_id);
              timer_set()
            }
          }
      });
  }
});

$('#submit_forget').on('submit', function (e) 
{  
 
  e.preventDefault(); 
  var change_mobile_no= $('#change_mobile_no').val();
  var fotp=$('#fotp').val();
  var new_password=$('#new_password').val();
  if(change_mobile_no !='' && fotp !='' && new_password !='')
  {
   
      $('.error2').hide();
      var base_url=$('#base_url').val(); 
      $.ajax({
      type: 'post',
      url:base_url+'forgot-verify',
      
      data:{
            user_id:change_mobile_no,
            otp:fotp,
            password:new_password
          },
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
});

function timer_set()
{
  var minit=2;
  var sec=60;

  var x = setInterval(function() 
  {

    sec--;
    if(sec==0)
    {
      minit=minit-1;
      sec=59;
    }
    if(sec<10)
    {
      fsec="0"+sec;
    }
    else{
      fsec=sec;
    }
    document.getElementById("timer").innerHTML=minit+":"+fsec;
    if (minit < 0) 
    {
      clearInterval(x);
      document.getElementById("timer").innerHTML = "";
      $("#resend").attr("onclick","resend_otp('change_mobile_no')");
      $("#resend").css('color', '#006ae4');
      $("#resend").css('cursor', 'pointer');
    }
  }, 1000);
}

function resend_otp(id)
{
  $("#resend").removeAttr('onclick');
  let userid=$('#'+id).val();
  var base_url=$('#base_url').val();
      
  $.ajax({
  type: 'post',
  url:base_url+'forgot',
  dataType: 'json',
  data:{user_id:userid},
      success: function (data) 
      {
          timer_set()
      }
  });
  
}
function timer_set1()
{
  var minit=2;
  var sec=60;

  var x = setInterval(function() 
  {

    sec--;
    if(sec==0)
    {
      minit=minit-1;
      sec=59;
    }
    if(sec<10)
    {
      fsec="0"+sec;
    }
    else{
      fsec=sec;
    }
    document.getElementById("timer1").innerHTML=minit+":"+fsec;
    if (minit < 0) 
    {
      clearInterval(x);
      document.getElementById("timer1").innerHTML = "";
      $("#resend1").attr("onclick","resend_otp1('reg_mobile_no')");
      $("#resend1").css('color', '#006ae4');
      $("#resend1").css('cursor', 'pointer');
    }
  }, 1000);
}

function resend_otp1(id)
{
  $("#resend1").removeAttr('onclick');
  let userid=$('#'+id).val();
  var base_url=$('#base_url').val();
      
  $.ajax({
  type: 'post',
  url:base_url+'forgot',
  dataType: 'json',
  data:{user_id:userid},
      success: function (data) 
      {
          timer_set1()
      }
  });
  
}


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
  $('#chackEmail').modal('show'); 
    return false;
}
function changemobile()
{
  $('#chackmobile').modal('show'); 
    return false;
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
  var current_url=window.location.href;
  var url = new URL(current_url);
  var business_type=$('#business_type').val(); 
  var product_id=url.searchParams.get("proid");
  var product_features_id=url.searchParams.get("feid");
  var color_id=url.searchParams.get("cid");
 // alert(business_type+" "+product_id+" "+product_features_id+" "+color_id);
  var base_url=$('#base_url').val();
  if(business_type != '' && product_id != '' && product_features_id != '' && color_id != '')
  {
    $.ajax({
      type: 'post',
      url:base_url+'add-to-bag',
      dataType: 'json',
      data:{
        business_type:business_type,
        product_id:product_id,
        product_features_id:product_features_id,
        color_id:color_id,
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
  
  var current_url=window.location.href;
  var url = new URL(current_url);
  var business_type=$('#business_type').val(); 
  var product_id=url.searchParams.get("proid");
  var product_features_id=url.searchParams.get("feid");
  var color_id=url.searchParams.get("cid");
  var base_url=$('#base_url').val();

  //alert(business_type+" "+product_id+" "+product_features_id+" "+color_id);
  if(business_type != '' && product_id != '' && product_features_id != '' && color_id != '')
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
function quentityDecrement(id,business_type)
{
  var cart_id=$("#uniqcode"+id).val();
  var sell_price=parseInt($("#sell_price"+id).val());
  var quantity=((parseInt($("#quen"+id).val())-1));
  var totalamount=parseInt($("#totalamount").val());
  var base_url=$('#base_url').val();
    $.ajax({
      type: 'post',
      url:base_url+'update-bag-decrement',
      dataType: 'json',
      data:{uniqcode:cart_id,quantity:quantity,business_type:business_type},
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
            location.reload();    
          }
          else
          {
            location.reload();    
          }
        }
    });
}
function quentityadd(id)
{
  var cart_id=$("#uniqcode"+id).val();
  var sell_price=parseInt($("#sell_price"+id).val());
  var quantity=(parseInt($("#quen"+id).val()));
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
            location.reload();    
          }
          else
          {
            location.reload();    
          }
        }
    });
}

function placeOrder(product_available,outofstock,email)
{
  
    if(outofstock==1)
    {
      alert('Remove Out of Stock Product');
    }
    else if(product_available==1)
    {
      
      alert('Change Product Quantity');
    }
    else
    {
      var base_url=$('#base_url').val();
      var url=base_url+'address';
      location.assign(url);
    }
 
  
}
function placeOrder1(email)
{
  var address_id=$("input[name='order_address']:checked").val();
  var base_url=$('#base_url').val();
  var current_url=$('#current_url').val();
  if(email !='')
  {
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
  else
  {
    $('#chackEmail').modal('show'); 
    return false;
  }
 
}

function buyPlaceOrder1(email)
{
  var address_id=$("input[name='order_address']:checked").val();
  var base_url=$('#base_url').val();
  var current_url=$('#current_url').val();
  if(email !='')
  {
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
  else
  {
    $('#chackEmail').modal('show'); 
    return false;
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
              var url=base_url+'order-success/'+data.order_code;
              location.assign(url);
            }
            else
            {
              var url=base_url+'order-error';
              location.assign(url);   
            }
            if(data.result==5)
            {
              window.location=base_url+'bag';
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
function payOnDeliveryBuy(address_id)
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
        url:base_url+'pay-on-delivery-buy',
        dataType: 'json',
        data:{address_id:address_id},
          success: function (data) 
          {
            
            if(data.result==1)
            {
              var url=base_url+'order-success/'+data.order_code;
              location.assign(url);
            }
            else
            {
              var url=base_url+'order-error';
              location.assign(url);   
            }
            if(data.result==5)
            {
              window.location=base_url+'bag';
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

  $('#search_text_color_discount').keyup(function()
  {
    var base_url=$('#base_url').val();
    var product_type=$('#product_type').val();
    var search = $(this).val(); 
    if(search != '')
    {
      $.ajax({
          url     : base_url+'type-color',
          method  : "POST",
          //dataType:'json',
          data: { product_type:product_type,color:search},
          success: function(data) 
          {
            $('#filterColor').html(data);
          }
      });
    }
    
  });

  $('#search_text_size_discount').keyup(function()
  {
    var base_url=$('#base_url').val();
    var product_type=$('#product_type').val();
    var search = $(this).val(); 
    if(search != '')
    {
      $.ajax({
          url     : base_url+'type-size',
          method  : "POST",
          //dataType:'json',
          data: { product_type:product_type,size:search},
          success: function(data) 
          {
            $('#filterSize').html(data);
          }
      });
    }
    
  });

  $('#search_text_brand_discount').keyup(function()
  {
    var base_url=$('#base_url').val();
    var product_type=$('#product_type').val();
    var search = $(this).val(); 
    if(search != '')
    {
      $.ajax({
          url     : base_url+'type-brand',
          method  : "POST",
          //dataType:'json',
          data: { product_type:product_type,brand:search},
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
      var per_page=url.searchParams.get("per_page");
      if(shortBy!=null)
      {
        if(per_page!=null)
        {
          url.searchParams.set("per_page",'0');
          url.searchParams.set("shortBy",order);
          
        }
        else{
          url.searchParams.set("shortBy",order);
        }
        window.location=url;
        // res=current_url.replace(shortBy,order);
        // window.location=res;
      }
      else
      {
        if(per_page!=null)
        {
          url.searchParams.set("per_page",'0');
          url=url+"&shortBy="+order;
        }
        else{
          url=current_url+"&shortBy="+order;
        }
        window.location=url;
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
      var per_page=url.searchParams.get("per_page");

      if(color!=null)
      {
        if(per_page!=null)
        {
          url.searchParams.set("per_page",'0');
          url.searchParams.set("color",filter);
          
        }
        else{
          url.searchParams.set("color",filter);
        }
        window.location=url;
        // res=current_url.replace(color,filter);
        // window.location=res;
      }
      else
      {
        if(per_page!=null)
        {
          url.searchParams.set("per_page",'0');
          url=url+"&color="+filter;
        }
        else{
          url=current_url+"&color="+filter;
        }
        window.location=url;
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
      var per_page=url.searchParams.get("per_page");

      if(size!=null)
      {
        if(per_page!=null)
        {
          url.searchParams.set("per_page",'0');
          url.searchParams.set("size",filter);
          
        }
        else{
          url.searchParams.set("size",filter);
        }
        window.location=url;
        
        // res=current_url.replace(size,filter);
        // window.location=res;
      }
      else
      {
        if(per_page!=null)
        {
          url.searchParams.set("per_page",'0');
          url=url+"&size="+filter;
        }
        else{
          url=current_url+"&size="+filter;
        }
        window.location=url;
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
      var per_page=url.searchParams.get("per_page");

      if(brand!=null)
      {
        if(per_page!=null)
        {
          url.searchParams.set("per_page",'0');
          url.searchParams.set("brand",filter);
          
        }
        else{
          url.searchParams.set("brand",filter);
        }
        window.location=url;
        // res=current_url.replace(brand,filter);
        // window.location=res;
      }
      else
      {
        if(per_page!=null)
        {
          url.searchParams.set("per_page",'0');
          url=url+"&brand="+filter;
        }
        else{
          url=current_url+"&brand="+filter;
        }
        window.location=url;
      }
    }
    else
    {
      res=current_url+"?brand="+filter;
      window.location=res;
    }
    
  }
  function shopProduct()
  {
    var current_url=window.location.href;
    var url = new URL(current_url);
    var query=$('#shop_product').val();

    if(window.location.search)
    {
      var search=url.searchParams.get("search");
      var per_page=url.searchParams.get("per_page");
      if(search!=null)
      {
        if(per_page!=null)
        {
          url.searchParams.set("per_page",'0');
          url.searchParams.set("search",query);
          
        }
        else{
          url.searchParams.set("search",query);
        }
        window.location=url;
        // res=current_url.replace(shortBy,order);
        // window.location=res;
      }
      else
      {
        if(per_page!=null)
        {
          url.searchParams.set("per_page",'0');
          url=url+"&search="+query;
        }
        else
        {
          url=current_url+"&search="+query;
        }
        window.location=url;
      }
      
    }
    else
    {
      res=current_url+"?search="+query;
      window.location=res;
    }
  }

  function rangeSlider()
  {
    var rangestart=$('#rangestart').val();
    var rangeend=$('#rangeend').val();
    console.log(rangestart+" "+rangeend);
    var current_url=window.location.href;
    var url = new URL(current_url);
    if(window.location.search)
    {
      var rangestart1=url.searchParams.get("rangestart");
      var rangeend1=url.searchParams.get("rangeend");
      var per_page=url.searchParams.get("per_page");
      if(rangestart1!=null && rangeend1!=null)
      {
        if(per_page!=null)
        {
          url.searchParams.set("per_page",'0');
          url.searchParams.set("rangestart",rangestart);
          url.searchParams.set("rangeend",rangeend);
          
        }
        else
        {
          
          url.searchParams.set("rangestart",rangestart);
          url.searchParams.set("rangeend",rangeend);
        }
        window.location=url;
        
      }
      else
      {
        if(per_page!=null)
        {
          url.searchParams.set("per_page",'0');
          url=url+"&rangestart="+rangestart+"&rangeend="+rangeend;
        }
        else
        {
          url=current_url+"&rangestart="+rangestart+"&rangeend="+rangeend;
        }
        window.location=url;
      }
      
    }
    else
    {
      res=current_url+"?rangestart="+rangestart+"&rangeend="+rangeend;
      window.location=res;
    }
   
   
    
  }



  function setCancelId(orderid)
  {
    $('#cancelorderId').val(orderid);
  }
  function orderCancel()
  {
    var reason=$('#reason').val();
    var comment=$('#comments').val();
    var orderid=$('#cancelorderId').val();
    if(reason!="")
    {
      var base_url=$('#base_url').val();
      $.ajax({
            url     : base_url+'order-cancel',
            method  : "POST",
            data    : { reason:reason,comment:comment,orderid:orderid},
            success: function(data) 
            {
              if(data=='success')
              {
                location.reload();   
              }
              else
              {
                location.reload();   
              }

            }
              
        });
    }
    else
    {
      return false;
    }
   
    
  }
 
 function otpcheck(otp,id)
 {
  
  var base_url=$('#base_url').val();
    let userid=$('#'+id).val();
    if(otp)
    {
      $.ajax({
        type: 'post',
        url:base_url+'otp-check',
        dataType: 'json',
        data:{
              userid:userid,
              otp:otp,
            },
            success: function (data) 
            {
            
              if(data=='0')
              {
                $('.error2').show();
                $('.error2').html('OTP is Incorrect!').delay(1200).fadeOut('show');
                $("#fotp").val('');
              }
              else
              {
                $("#fotp").attr("readonly","true");
                $("#new_password_filed").css('display', 'block');
                $("#resend").css('display', 'none');
                
              }
            }
        });
    }
    else
    {
        return false;
    }
    
 }
 function otpcheck1(otp,id)
 {
  
  var base_url=$('#base_url').val();
    let userid=$('#'+id).val();
    if(otp)
    {
      $.ajax({
        type: 'post',
        url:base_url+'otp-check',
        dataType: 'json',
        data:{
              userid:userid,
              otp:otp,
            },
            success: function (data) 
            {
            
              if(data=='0')
              {
                $('.reg-step-error').show();
                $('.reg-step-error').html('OTP is Incorrect!').delay(1200).fadeOut('show');
                $("#rotp").val("");

              }
              else
              {
                $("#rotp").attr("readonly","true");
                $("#reg_password_filed").css('display', 'block');
                $("#resend1").css('display', 'none');
                
              }
            }
        });
    }
    else
    {
        return false;
    }
    
 }

 function rating(rating)
 {
   //alert(rating);
   $("#rating").val(rating);
 }
 function order_rating(rating)
 {
  $("#order_rating").val(rating);
 }
 $(document).ready(function() 
 {
    $(document).on('click', '#upload_img', function() 
    {
      
      let rating=$('#rating').val();
      let review=$('#review').val();
      let order_uniqcode=$('#order_uniqcode').val();
     
      var formData = new FormData();
      for(let i=1; i<=5; i++ )
      {
        var fileInput = document.getElementById('input_upload_'+i);
        var file1 = fileInput.files[0];
        formData.append('file'+i,file1);
      }
     
     
      
      //formData.append('file', $('#input_upload_3').files);
      formData.append('rating',rating);
      formData.append('review',review);
      formData.append('order_uniqcode',order_uniqcode);
      var base_url=$('#base_url').val();
      if(order_uniqcode!='')
      {
        $.ajax({
          type: 'post',
          url:base_url+'review-add',
          dataType: 'json',
          data:formData,
          contentType: false,
          cache: false,
          processData: false,
          success: function (data) 
          {
            if(data.result==1)
            {
              location.reload();
            }
          }
          });
      }
      else
      {
        return false;
      }
      

    });

    $(document).on('click', '#update_upload_img', function() 
    {    
      let rating=$('#order_rating').val();
      let review=$('#update_review').val();
      let order_uniqcode=$('#order_uniqcode_update').val();
      var base_url=$('#base_url').val();

      var formData = new FormData();
      for(let i=6; i<=10; i++ )
      {
        var oldfileInput= document.getElementById('old_item_image_upload_'+i).value;
        formData.append('old_item_image_upload_'+i,oldfileInput);
      }
      for(let i=6; i<=10; i++ )
      {
        var fileInput= document.getElementById('input_upload_'+i);
        if(fileInput)
        {
          var file1 = fileInput.files[0];
          formData.append('input_upload_'+i,file1);
        }
        else
        {
          formData.append('input_upload_'+i,'');
        }
      }
      formData.append('rating',rating);
      formData.append('review',review);
      formData.append('order_uniqcode',order_uniqcode);
      if(order_uniqcode!='')
      {
        $.ajax({
          type: 'post',
          url:base_url+'review-update',
          dataType: 'json',
          data:formData,
          contentType: false,
          cache: false,
          processData: false,
          success: function (data) 
          {
            if(data.result==1)
            {
              location.reload();
            }
          }
          });
      }
      else
      {
        return false;
      }

      

       
    });

});

function get_upload_photo1(x) 
{
    $("#input_upload_"+x+"").trigger("click");
}
function show_photo1(input, x) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();
      var FileSize = input.files[0].size / 1024 / 1024; // in MB
      var FileType = input.files[0].type;
      var ext = $("#input_upload_" + x + "")
          .val()
          .split(".")
          .pop()
          .toLowerCase();
      if ($.inArray(ext, ["JPEG", "PNG", "JPG", "png", "jpg", "jpeg"]) == -1) {
          alert("invalid extension!");
      } else {
          if (FileSize < 1) {
              $("#selected_images_count").val("1");
              reader.onload = function (e) {
                  $("#upload_photo_" + x + "")
                      .attr("src", e.target.result)
                      .width(60)
                      .height(60);
              };
              reader.readAsDataURL(input.files[0]);
          } else {
              alert("Maximum file size 1MB can be upload");
              $(input).val("");
          }
      }
  }
}

function rateAndreview(uniqcode,image,name)
{
  var base_url=$('#base_url').val();
  img_url=base_url+'/webroot/admin/product/web/'+image;
  $('#rating_img_show').html('<img src="'+img_url+'" />');
  $('#rating_product_name').html(name);
  $('#order_uniqcode').val(uniqcode);
   
}

function rateAndreviewUpdate(uniqcode,image,name)
{
  var base_url=$('#base_url').val();
  img_url=base_url+'/webroot/admin/product/web/'+image;
  $.ajax({
    type: 'post',
    url:base_url+'review-edit',
    data:{uniqcode:uniqcode},
    success: function (data) 
    {
      console.log(data)
      $('#rating_modal').html(data);
      $('#rating_img_show_update').html('<img src="'+img_url+'" />');
      $('#rating_product_name_update').html(name);
      $('#order_uniqcode_update').val(uniqcode);
    }
  });
}

function timer_set3()
{
  var minit=2;
  var sec=60;

  var x = setInterval(function() 
  {

    sec--;
    if(sec==0)
    {
      minit=minit-1;
      sec=59;
    }
    if(sec<10)
    {
      fsec="0"+sec;
    }
    else{
      fsec=sec;
    }
    document.getElementById("timer3").innerHTML=minit+":"+fsec;
    if (minit < 0) 
    {
      clearInterval(x);
      document.getElementById("timer3").innerHTML = "";
      $("#resend3").attr("onclick","resend_otp3()");
      $("#resend3").css('color', '#006ae4');
      $("#resend3").css('cursor', 'pointer');
    }
  }, 1000);
}
function resend_otp3()
{
  $("#resend").removeAttr('onclick');
  let email=$('#email').val();
  var base_url=$('#base_url').val();    
  $.ajax({
  type: 'post',
  url:base_url+'verify-email',
  dataType: 'json',
  data:{email:email},
      success: function (data) 
      {
          timer_set3();
      }
  });
  
}
$(document).ready(function()
{
  $('#email_check').on('submit', function (e) 
  {

    let email=$('#email').val();
    var base_url=$('#base_url').val();
    e.preventDefault();
    if(email)
    {
      $.ajax({
        type: 'post',
        url:base_url+'verify-email',
        dataType: 'json',
        data:{email:email},
        success: function (data) 
        {
          if(data.message=='success')
          {
            $("#email_otp").css('display', 'block');
            $("#email_verify_submit").css('display', 'none');
            $("#email_submit").css('display', 'block');
            $("#email_submit").css('float', 'right');
            timer_set3();
          } 
          else if(data.message=='email')
          {
            
            $('.error2').show();
            $('.error2').html('Email ID already Exist').delay(1200).fadeOut('show');
          }
        }  
      });
    }
    
  });
  
});
 function email_otpcheck(otp)
 {
  var base_url=$('#base_url').val();
    let userid="";
    if(otp)
    {
      $.ajax({
        type: 'post',
        url:base_url+'otp-check',
        dataType: 'json',
        data:{
              userid:userid,
              otp:otp,
            },
            success: function (data) 
            {
            
              if(data=='0')
              {
                $('.error2').show();
                $('.error2').html('OTP is Incorrect!').delay(1200).fadeOut('show');
              }
              else
              {
                $("#otp").attr("readonly","true");
                $("#email_passwod1").css('display', 'block');
                $("#parmission").val("1");
                $('.msg').show();
                $('.msg').html('OTP verify Successful.').delay(1200).fadeOut('show');
               
              }
            }
        });
        return false;
    }
    else
    {
        return 0;
    }
    
 }

 $('#email_submit').on('click', function (e) 
 {
  
    
  
      let email=$('#email').val();
      let otp=$('#otp').val();
      let password=$('#email_passwod').val();
      
    var base_url=$('#base_url').val();

      if(otp && password)
      { 
       
        let parmission=$('#parmission').val();
          if(parmission==1)
          {
            $.ajax({
                  type: 'post',
                  url:base_url+'add-email',
                  dataType: 'json',
                  data:{email:email,password:password},
                  success: function (data) 
                  {
                    if(data.result==1)
                    {
                      location.reload();
                    }
                    else if(data.result==2)
                    {
                      $('.error2').show();
                      $('.error2').html("Password doesn't match!").delay(1200).fadeOut('show');
                    }
                  }  
              });
          }
          else
          {
            return false;
          }
      }
      else
      {
        return false;
      }
   
   
 });
  
 /***********************update Mobile*********************** */
  // $('#mobile_check').on('submit', function (e) 
  //   {

  //     let mobile=$('#update_mobile').val();
  //     var base_url=$('#base_url').val();
  //     e.preventDefault();
  //     if(mobile)
  //     {
  //       alert('hi');
  //       // $.ajax({
  //       //   type: 'post',
  //       //   url:base_url+'verify-mobile',
  //       //   dataType: 'json',
  //       //   data:{mobile:mobile},
  //       //   success: function (data) 
  //       //   {
  //       //     if(data.message=='success')
  //       //     {
  //       //       $("#email_otp").css('display', 'block');
  //       //       $("#email_verify_submit").css('display', 'none');
  //       //       $("#email_submit").css('display', 'block');
  //       //       $("#email_submit").css('float', 'right');
  //       //       timer_set3();
  //       //     } 
  //       //     else if(data.message=='email')
  //       //     {
              
  //       //       $('.error2').show();
  //       //       $('.error2').html('Email ID already Exist').delay(1200).fadeOut('show');
  //       //     }
  //       //   }  
  //       // });
  //     }
      
  //   });
 /***********************end update Mobile*********************** */
 $('#payonline').on('click', function (e) 
 {
    var base_url=$('#base_url').val();
    $.ajax({
      type: 'post',
      url:base_url+'Order-time-Quantity-check',
      dataType: 'json',
      success: function (data) 
      {
        if(data.result==1)
        {
          window.location=base_url+'bag';
        }
      }
    });
});
  
  
  
  
  
  