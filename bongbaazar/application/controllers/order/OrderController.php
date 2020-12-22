<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrderController extends CI_Controller 
{ 
	function __construct()
	{
	  	parent::__construct(); 	
	  	$this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");	
	  	date_default_timezone_set('Asia/Kolkata');	
		$this->load->helper(array('common_helper', 'string', 'form', 'security','url'));
		$this->load->library(array('form_validation', 'email'));
		$this->load->model('order/Order_Model');
		$this->load->model('cart/Cart_Model');	
		$this->load->model('home/Home_Model');
		$this->load->model('address/Address_Model');
		date_default_timezone_set('Asia/Kolkata');
	} 

	public function index($address_id)
	{
	 	if(($this->session->userdata('loginDetail')!=NULL))
		{	
            if(($this->session->userdata('loginDetail')->email!=""))
            {
                $this->data['page_title']='Bongbazaar | Order';
                $this->data['subview']='order/order';
                $this->data['address_id']=$address_id;
                $this->data['capcha_value']=random_string('numeric',4);
                $this->data['menu_lebel'] = $this->Home_Model->get_categories();

                $this->data['cart_details']=$this->Cart_Model->get_cartItem($this->session->userdata('loginDetail')->uniqcode);
                //pr($this->data);
                $this->load->view('user/layout/default', $this->data);
            }
            else
            {
                redirect('address');
            }
		}
		else
		{
			$this->session->set_flashdata('error', 'You do not sing in...');
			redirect('');
		}
	}

	public function byOrder($address_id)
	{
		if(($this->session->userdata('loginDetail')!=NULL))
		{	
			$this->data['page_title']='Bongbazaar | Order';
			$this->data['subview']='order/buy_order';
			$this->data['address_id']=$address_id;
			$this->data['capcha_value']=random_string('numeric',4);
			$this->data['menu_lebel'] = $this->Home_Model->get_categories();

			$this->data['cart_details']=$this->Cart_Model->get_buyCartItem($this->session->userdata('loginDetail')->uniqcode);
			//pr($this->data);
			$this->load->view('user/layout/default', $this->data);
		}
		else
		{
			$this->session->set_flashdata('error', 'You do not sing in...');
			redirect('');
		}
	}

	public function cashOnDelivery()
	{	
		if(($this->session->userdata('loginDetail')!=NULL))
		{
			$address_id=$this->input->post('address_id');
			$user_id=$this->session->userdata('loginDetail')->uniqcode;

			$cart_details=array();
            $cart_details=$this->Cart_Model->get_cartItem($user_id);
            foreach ($cart_details as $key => $value) {
                $product_quantity[$key]=$this->Cart_Model->product_quantity( $value->product_features_id);
                if($product_quantity[$key]->stock_quentity < $value->quantity)
                {
                    $this->session->set_flashdata('error', 'product out of stock');
                    redirect('bag');
                }
            }
           
			$order_code='OR'.random_string('numeric',10);
			$payment_id='cod_'.random_string('alnum',14);
			$address1=$this->Address_Model->address_order($address_id);
			foreach($cart_details as $cart_row)
			{
				$gst=$this->Order_Model->productViewOrder($cart_row->product_id,$cart_row->product_features_id);
                $address=$this->Order_Model->UserDeliveryOrder($address_id);   
                $igst=0;
                $sgst=0;
                $cgst=0;
                $product_igst=0;
                $product_sgst=0;
                $product_cgst=0;

                $gst_rate=intval($gst->gst_rate);
                $sell_price=intval($gst->sell_price);
                $mrp_price=intval($gst->mrp_price);
                $discount=intval($gst->discount);
                $business_type=$gst->business_type;
                $size=$gst->size;
                if(empty($size))
                {
                	$size='null';
                }

                $fees=$this->Order_Model->fees($business_type);

                $taxable_value=(
                    $sell_price*100)/(100+$gst_rate);
                $service_fee=($sell_price*$fees->service_fee)/100;
                if($gst->state==$address->name)
                {
                    $product_igst=0;
                    $product_sgst=$sell_price*(18/100)/2;
                    $product_cgst=$sell_price*(18/100)/2;
                    $sgst=$service_fee*(18/100)/2;
                    $cgst=$service_fee*(18/100)/2;
                    $igst=0;
                }
                else
                {
                    $igst=$service_fee*(18/100);
                    $sgst=0;
                    $cgst=0;
                    $product_igst=$sell_price*(18/100);
                    $product_sgst=0;
                    $product_cgst=0;
                }

                $tds=$service_fee*intval($fees->tds_fee)/100;

                $tcs=$taxable_value*intval($fees->tcs_fee)/100;
                $shipping_gst=18;
                $shipping_discount=0;

                $data1=array(
                    'status'=>'Delete'
                );

                $where1=array(
                    'uniqcode'=>$cart_row->uniqcode
                );
            
                $data=array(
                    'uniqcode'=>"or".random_string('alnum',28),
                    'order_code'=>$order_code,
                    'user_id'=>$user_id,
                    'address'=>serialize($address1),
                    'product_id'=>$cart_row->product_id,
                    'product_features_id'=>$cart_row->product_features_id,
                    'mrp_price'=>$mrp_price,
                    'sell_price'=>$sell_price,
                    'discount'=>$discount,
                    'size'=>$size,
                    'color'=>$cart_row->color,
                    'quantity'=>$cart_row->quantity,
                    'fees_id'=>$fees->uniqcode,
                    'delivery_date'=>'',
                    'user_received_date'=>'',
                    'shipping_price'=>'',
                    'shipping_discount'=>$shipping_discount,
                    'shipping_gst'=>$shipping_gst,
                    'taxable_value'=>number_format($taxable_value,2),
                    'product_cgst'=>number_format($product_cgst,2),
                    'product_sgst'=>number_format($product_sgst,2),
                    'product_igst'=>number_format($product_igst,2),
                    'gst_rate'=>$gst->gst_rate,
                    'service_fee'=>number_format($service_fee,2),
                    'igst'=>number_format($igst,2),
                    'cgst'=>number_format($cgst,2),
                    'sgst'=>number_format($sgst,2),
                    'tds'=>number_format($tds,2),
                    'tcs'=>number_format($tcs,2),
                    'payment_mode'=>'PayOnDelivery',
                    'payment_id'=>$payment_id,
                    'datetime'=>date('Y-m-d H:i:s')
                );            
                $this->db->insert('tbl_order',$data);
                $this->Order_Model->update('tbl_cart',$where1,$data1);
		  	}
		  	echo json_encode(['result'=>1,'order_code'=>$order_code]);
		  	return false;
			
		}
		else
		{
			$this->session->set_flashdata('error', 'You do not sing in...');
			redirect('');
		}
	}

	public function cashOnDeliveryBuy()
	{	
		if(($this->session->userdata('loginDetail')!=NULL))
		{
			$address_id=$this->input->post('address_id');
			$user_id=$this->session->userdata('loginDetail')->uniqcode;

			$cart_details=array();
            $cart_details=$this->Cart_Model->get_buyCartItem($user_id);
            foreach ($cart_details as $key => $value) {
                $product_quantity[$key]=$this->Cart_Model->product_quantity( $value->product_features_id);
                if($product_quantity[$key]->stock_quentity < $value->quantity)
                {
                    redirect('bag');
                }
            }
			//pr($cart_details);
			$order_code='OR'.random_string('numeric',10);
			$payment_id='cod_'.random_string('alnum',14);
			$address1=$this->Address_Model->address_order($address_id);
			foreach($cart_details as $cart_row)
			{
				$gst=$this->Order_Model->productViewOrder($cart_row->product_id,$cart_row->product_features_id);
                $address=$this->Order_Model->UserDeliveryOrder($address_id);   
                $igst=0;
                $sgst=0;
                $cgst=0;
                $product_igst=0;
                $product_sgst=0;
                $product_cgst=0;

                $gst_rate=intval($gst->gst_rate);
                $sell_price=intval($gst->sell_price);
                $mrp_price=intval($gst->mrp_price);
                $discount=intval($gst->discount);
                $business_type=$gst->business_type;
                $size=$gst->size;
                if(empty($size))
                {
                	$size='null';
                }

                $fees=$this->Order_Model->fees($business_type);

                $taxable_value=(
                    $sell_price*100)/(100+$gst_rate);
                $service_fee=($sell_price*$fees->service_fee)/100;
                if($gst->state==$address->name)
                {
                    $product_igst=0;
                    $product_sgst=$sell_price*(18/100)/2;
                    $product_cgst=$sell_price*(18/100)/2;
                    $sgst=$service_fee*(18/100)/2;
                    $cgst=$service_fee*(18/100)/2;
                    $igst=0;
                }
                else
                {
                    $igst=$service_fee*(18/100);
                    $sgst=0;
                    $cgst=0;
                    $product_igst=$sell_price*(18/100);
                    $product_sgst=0;
                    $product_cgst=0;
                }

                $tds=$service_fee*intval($fees->tds_fee)/100;

                $tcs=$taxable_value*intval($fees->tcs_fee)/100;
                $shipping_gst=18;
                $shipping_discount=0;

                $data1=array(
                    'status'=>'Delete'
                );

                $where1=array(
                    'uniqcode'=>$cart_row->uniqcode
                );
            
                $data=array(
                    'uniqcode'=>"or".random_string('alnum',28),
                    'order_code'=>$order_code,
                    'user_id'=>$user_id,
                    'address'=>serialize($address1),
                    'product_id'=>$cart_row->product_id,
                    'product_features_id'=>$cart_row->product_features_id,
                    'mrp_price'=>$mrp_price,
                    'sell_price'=>$sell_price,
                    'discount'=>$discount,
                    'size'=>$size,
                    'color'=>$cart_row->color,
                    'quantity'=>$cart_row->quantity,
                    'fees_id'=>$fees->uniqcode,
                    'delivery_date'=>'',
                    'user_received_date'=>'',
                    'shipping_price'=>'',
                    'shipping_discount'=>$shipping_discount,
                    'shipping_gst'=>$shipping_gst,
                    'taxable_value'=>number_format($taxable_value,2),
                    'product_cgst'=>number_format($product_cgst,2),
                    'product_sgst'=>number_format($product_sgst,2),
                    'product_igst'=>number_format($product_igst,2),
                    'gst_rate'=>$gst->gst_rate,
                    'service_fee'=>number_format($service_fee,2),
                    'igst'=>number_format($igst,2),
                    'cgst'=>number_format($cgst,2),
                    'sgst'=>number_format($sgst,2),
                    'tds'=>number_format($tds,2),
                    'tcs'=>number_format($tcs,2),
                    'payment_mode'=>'PayOnDelivery',
                    'payment_id'=>$payment_id,
                    'datetime'=>date('Y-m-d H:i:s')
                );         
                $this->db->insert('tbl_order',$data);
                $this->Order_Model->update('tbl_cart',$where1,$data1);
		  	}
		  	echo json_encode(['result'=>1,'order_code'=>$order_code]);
		  	return false;
			
		}
		else
		{
			$this->session->set_flashdata('error', 'You do not sing in...');
			redirect('');
		}
	}

	public function payOnOnline()
	{
		if(($this->session->userdata('loginDetail')!=NULL))
		{
			$payment_id=$this->input->post('razorpay_payment_id');
			$address_id=$this->input->post('address_id');
			$totalAmount=$this->input->post('totalAmount');
			$user_id=$this->session->userdata('loginDetail')->uniqcode;

			$cart_details=array();
			$cart_details=$this->Cart_Model->get_cartItem($user_id);
			$address1=$this->Address_Model->address_order($address_id);
			//pr($cart_details);
			$order_code='OR'.random_string('numeric',10);
			foreach($cart_details as $cart_row)
			{
				$gst=$this->Order_Model->productViewOrder($cart_row->product_id,$cart_row->product_features_id);
                $address=$this->Order_Model->UserDeliveryOrder($address_id);   
                $igst=0;
                $sgst=0;
                $cgst=0;
                $product_igst=0;
                $product_sgst=0;
                $product_cgst=0;

                $gst_rate=intval($gst->gst_rate);
                $sell_price=intval($gst->sell_price);
                $mrp_price=intval($gst->mrp_price);
                $discount=intval($gst->discount);
                $business_type=$gst->business_type;
                $size=$gst->size;
                if(empty($size))
                {
                	$size='null';
                }

                $fees=$this->Order_Model->fees($business_type);

                $taxable_value=(
                    $sell_price*100)/(100+$gst_rate);
                $service_fee=($sell_price*$fees->service_fee)/100;
                if($gst->state==$address->name)
                {
                    $product_igst=0;
                    $product_sgst=$sell_price*(18/100)/2;
                    $product_cgst=$sell_price*(18/100)/2;
                    $sgst=$service_fee*(18/100)/2;
                    $cgst=$service_fee*(18/100)/2;
                    $igst=0;
                }
                else
                {
                    $igst=$service_fee*(18/100);
                    $sgst=0;
                    $cgst=0;
                    $product_igst=$sell_price*(18/100);
                    $product_sgst=0;
                    $product_cgst=0;
                }

                $tds=$service_fee*intval($fees->tds_fee)/100;

                $tcs=$taxable_value*intval($fees->tcs_fee)/100;
                $shipping_gst=18;
                $shipping_discount=0;

                $data1=array(
                    'status'=>'Delete'
                );

                $where1=array(
                    'uniqcode'=>$cart_row->uniqcode
                );
            
                $data=array(
                    'uniqcode'=>"or".random_string('alnum',28),
                    'order_code'=>$order_code,
                    'user_id'=>$user_id,
                    'address'=>serialize($address1),
                    'product_id'=>$cart_row->product_id,
                    'product_features_id'=>$cart_row->product_features_id,
                    'mrp_price'=>$mrp_price,
                    'sell_price'=>$sell_price,
                    'discount'=>$discount,
                    'size'=>$size,
                    'color'=>$cart_row->color,
                    'quantity'=>$cart_row->quantity,
                    'fees_id'=>$fees->uniqcode,
                    'delivery_date'=>'',
                    'user_received_date'=>'',
                    'shipping_price'=>'',
                    'shipping_discount'=>$shipping_discount,
                    'shipping_gst'=>$shipping_gst,
                    'taxable_value'=>number_format($taxable_value,2),
                    'product_cgst'=>number_format($product_cgst,2),
                    'product_sgst'=>number_format($product_sgst,2),
                    'product_igst'=>number_format($product_igst,2),
                    'gst_rate'=>$gst->gst_rate,
                    'service_fee'=>number_format($service_fee,2),
                    'igst'=>number_format($igst,2),
                    'cgst'=>number_format($cgst,2),
                    'sgst'=>number_format($sgst,2),
                    'tds'=>number_format($tds,2),
                    'tcs'=>number_format($tcs,2),
                    'payment_mode'=>'PayOnline',
                    'payment_id'=>$payment_id,
                    'datetime'=>date('Y-m-d H:i:s')
                );            
                $this->db->insert('tbl_order',$data);
                $this->Order_Model->update('tbl_cart',$where1,$data1);

		  	}
		  	echo json_encode(['result'=>1,'order_code'=>$order_code]);
		  	return false;
			
		}
		else
		{
			$this->session->set_flashdata('error', 'You do not sing in...');
			redirect('');
		}
	}

	public function payOnOnlineBuy()
	{
		if(($this->session->userdata('loginDetail')!=NULL))
		{
			$payment_id=$this->input->post('razorpay_payment_id');
			$address_id=$this->input->post('address_id');
			$totalAmount=$this->input->post('totalAmount');
			$user_id=$this->session->userdata('loginDetail')->uniqcode;

			$cart_details=array();
			$cart_details=$this->Cart_Model->get_buyCartItem($user_id);
			$address1=$this->Address_Model->address_order($address_id);
			//pr($cart_details);
			$order_code='OR'.random_string('numeric',10);
			foreach($cart_details as $cart_row)
			{
				$gst=$this->Order_Model->productViewOrder($cart_row->product_id,$cart_row->product_features_id);
                $address=$this->Order_Model->UserDeliveryOrder($address_id);   
                $igst=0;
                $sgst=0;
                $cgst=0;
                $product_igst=0;
                $product_sgst=0;
                $product_cgst=0;

                $gst_rate=intval($gst->gst_rate);
                $sell_price=intval($gst->sell_price);
                $mrp_price=intval($gst->mrp_price);
                $discount=intval($gst->discount);
                $business_type=$gst->business_type;
                $size=$gst->size;
                if(empty($size))
                {
                	$size='null';
                }

                $fees=$this->Order_Model->fees($business_type);

                $taxable_value=(
                    $sell_price*100)/(100+$gst_rate);
                $service_fee=($sell_price*$fees->service_fee)/100;
                if($gst->state==$address->name)
                {
                    $product_igst=0;
                    $product_sgst=$sell_price*(18/100)/2;
                    $product_cgst=$sell_price*(18/100)/2;
                    $sgst=$service_fee*(18/100)/2;
                    $cgst=$service_fee*(18/100)/2;
                    $igst=0;
                }
                else
                {
                    $igst=$service_fee*(18/100);
                    $sgst=0;
                    $cgst=0;
                    $product_igst=$sell_price*(18/100);
                    $product_sgst=0;
                    $product_cgst=0;
                }

                $tds=$service_fee*intval($fees->tds_fee)/100;

                $tcs=$taxable_value*intval($fees->tcs_fee)/100;
                $shipping_gst=18;
                $shipping_discount=0;

                $data1=array(
                    'status'=>'Delete'
                );

                $where1=array(
                    'uniqcode'=>$cart_row->uniqcode
                );
            
                $data=array(
                    'uniqcode'=>"or".random_string('alnum',28),
                    'order_code'=>$order_code,
                    'user_id'=>$user_id,
                    'address'=>serialize($address1),
                    'product_id'=>$cart_row->product_id,
                    'product_features_id'=>$cart_row->product_features_id,
                    'mrp_price'=>$mrp_price,
                    'sell_price'=>$sell_price,
                    'discount'=>$discount,
                    'size'=>$size,
                    'color'=>$cart_row->color,
                    'quantity'=>$cart_row->quantity,
                    'fees_id'=>$fees->uniqcode,
                    'delivery_date'=>'',
                    'user_received_date'=>'',
                    'shipping_price'=>'',
                    'shipping_discount'=>$shipping_discount,
                    'shipping_gst'=>$shipping_gst,
                    'taxable_value'=>number_format($taxable_value,2),
                    'product_cgst'=>number_format($product_cgst,2),
                    'product_sgst'=>number_format($product_sgst,2),
                    'product_igst'=>number_format($product_igst,2),
                    'gst_rate'=>$gst->gst_rate,
                    'service_fee'=>number_format($service_fee,2),
                    'igst'=>number_format($igst,2),
                    'cgst'=>number_format($cgst,2),
                    'sgst'=>number_format($sgst,2),
                    'tds'=>number_format($tds,2),
                    'tcs'=>number_format($tcs,2),
                    'payment_mode'=>'PayOnline',
                    'payment_id'=>$payment_id,
                    'datetime'=>date('Y-m-d H:i:s')
                );            
                $this->db->insert('tbl_order',$data);
                $this->Order_Model->update('tbl_cart',$where1,$data1);

		  	}
		  	echo json_encode(['result'=>1,'order_code'=>$order_code]);
		  	return false;
			
		}
		else
		{
			$this->session->set_flashdata('error', 'You do not sing in...');
			redirect('');
		}
	}
    public function order_place_email($data)
    {
        $actual_link = "http://$_SERVER[HTTP_HOST]".base_url('order-details/'.$data['user_order_details']->order_code.'');
      
        $address=unserialize($data['user_order_details']->address);
        $where=array(
            'id'=>$address->state
        );
        $state_name=$this->Order_Model->selectrow($where,'tbl_state_mast');
       // pr($data);
        $total=0;
        $total_shipping=0;
        $userdata=$this->session->userdata('loginDetail');
        if($userdata->name=="")
        {
            $name="Customer";
        }
        else
        {
            $user_name=explode("##",$userdata->name);
            $name=$user_name[0].' '.$user_name[1];
        }
        $message='<!DOCTYPE html>
        <html >
            <head>
                <meta charset="UTF-8" />
                <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                <meta name="viewport" content="width=device-width, initial-scale=1" />
                <title>Bongbasar</title>
        
                <style type="text/css">
                    p {
                        margin: 10px 0;
                        padding: 0;
                    }
                    table {
                        border-collapse: collapse;
                    }
                    h1,
                    h2,
                    h3,
                    h4,
                    h5,
                    h6 {
                        display: block;
                        margin: 0;
                        padding: 0;
                    }
                    img,
                    a img {
                        border: 0;
                        height: auto;
                        outline: none;
                        text-decoration: none;
                    }
                    body,
                    #bodyTable,
                    #bodyCell {
                        height: 100%;
                        margin: 0;
                        padding: 0;
                        width: 100%;
                    }
                    .mcnPreviewText {
                        display: none !important;
                    }
                    #outlook a {
                        padding: 0;
                    }
                    img {
                        -ms-interpolation-mode: bicubic;
                    }
                    table {
                        mso-table-lspace: 0pt;
                        mso-table-rspace: 0pt;
                    }
                    .ReadMsgBody {
                        width: 100%;
                    }
                    .ExternalClass {
                        width: 100%;
                    }
                    p,
                    a,
                    li,
                    td,
                    blockquote {
                        mso-line-height-rule: exactly;
                    }
                    a[href^="tel"],
                    a[href^="sms"] {
                        color: inherit;
                        cursor: default;
                        text-decoration: none;
                    }
                    p,
                    a,
                    li,
                    td,
                    body,
                    table,
                    blockquote {
                        -ms-text-size-adjust: 100%;
                        -webkit-text-size-adjust: 100%;
                    }
                    .ExternalClass,
                    .ExternalClass p,
                    .ExternalClass td,
                    .ExternalClass div,
                    .ExternalClass span,
                    .ExternalClass font {
                        line-height: 100%;
                    }
                    a[x-apple-data-detectors] {
                        color: inherit !important;
                        text-decoration: none !important;
                        font-size: inherit !important;
                        font-family: inherit !important;
                        font-weight: inherit !important;
                        line-height: inherit !important;
                    }
                    .templateContainer {
                        max-width: 600px !important;
                    }
                    a.mcnButton {
                        display: block;
                    }
                    .mcnImage,
                    .mcnRetinaImage {
                        vertical-align: bottom;
                    }
                    .mcnTextContent {
                        word-break: break-word;
                    }
                    .mcnTextContent img {
                        height: auto !important;
                    }
                    .mcnDividerBlock {
                        table-layout: fixed !important;
                    }
                    h1 {
                        /*@editable*/
                        color: #222222;
                        /*@editable*/
                        font-family: Helvetica;
                        /*@editable*/
                        font-size: 40px;
                        /*@editable*/
                        font-style: normal;
                        /*@editable*/
                        font-weight: bold;
                        /*@editable*/
                        line-height: 150%;
                        /*@editable*/
                        letter-spacing: normal;
                        /*@editable*/
                        text-align: center;
                    }
                    h2 {
                        /*@editable*/
                        color: #222222;
                        /*@editable*/
                        font-family: Helvetica;
                        /*@editable*/
                        font-size: 34px;
                        /*@editable*/
                        font-style: normal;
                        /*@editable*/
                        font-weight: bold;
                        /*@editable*/
                        line-height: 150%;
                        /*@editable*/
                        letter-spacing: normal;
                        /*@editable*/
                        text-align: left;
                    }
                    h3 {
                        /*@editable*/
                        color: #444444;
                        /*@editable*/
                        font-family: Helvetica;
                        /*@editable*/
                        font-size: 22px;
                        /*@editable*/
                        font-style: normal;
                        /*@editable*/
                        font-weight: bold;
                        /*@editable*/
                        line-height: 150%;
                        /*@editable*/
                        letter-spacing: normal;
                        /*@editable*/
                        text-align: left;
                    }
                    h4 {
                        /*@editable*/
                        color: #999999;
                        /*@editable*/
                        font-family: Georgia;
                        /*@editable*/
                        font-size: 20px;
                        /*@editable*/
                        font-style: italic;
                        /*@editable*/
                        font-weight: normal;
                        /*@editable*/
                        line-height: 125%;
                        /*@editable*/
                        letter-spacing: normal;
                        /*@editable*/
                        text-align: left;
                    }
                    #templateHeader {
                        /*@editable*/
                        background-color: #07c4f6;
                        /*@editable*/
                        background-image: none;
                        /*@editable*/
                        background-repeat: no-repeat;
                        /*@editable*/
                        background-position: center;
                        /*@editable*/
                        background-size: cover;
                        /*@editable*/
                        border-top: 0;
                        /*@editable*/
                        border-bottom: 0;
                        /*@editable*/
                        padding-top: 36px;
                        /*@editable*/
                        padding-bottom: 0;
                    }
                    .headerContainer {
                        /*@editable*/
                        background-color: #07c4f6;
                        /*@editable*/
                        background-image: none;
                        /*@editable*/
                        background-repeat: no-repeat;
                        /*@editable*/
                        background-position: center;
                        /*@editable*/
                        background-size: cover;
                        /*@editable*/
                        border-top: 0;
                        /*@editable*/
                        border-bottom: 0;
                        /*@editable*/
                        padding-top: 0px;
                        /*@editable*/
                        padding-bottom: 45px;
                    }
                    .headerContainer .mcnTextContent,
                    .headerContainer .mcnTextContent p {
                        /*@editable*/
                        color: #808080;
                        /*@editable*/
                        font-family: Helvetica;
                        /*@editable*/
                        font-size: 10px;
                        /*@editable*/
                        line-height: 150%;
                        /*@editable*/
                        text-align: justify;
                    }
                    .headerContainer .mcnTextContent a,
                    .headerContainer .mcnTextContent p a {
                        /*@editable*/
                        color: #37b4d3;
                        /*@editable*/
                        font-weight: normal;
                        /*@editable*/
                        text-decoration: underline;
                    }
                    #templateBody {
                        /*@editable*/
                        background-color: #f2f2f2;
                        /*@editable*/
                        background-image: none;
                        /*@editable*/
                        background-repeat: no-repeat;
                        /*@editable*/
                        background-position: center;
                        /*@editable*/
                        background-size: cover;
                        /*@editable*/
                        border-top: 0;
                        /*@editable*/
                        border-bottom: 0;
                        /*@editable*/
                        padding-top: 0;
                        /*@editable*/
                        padding-bottom: 0;
                    }
                    .bodyContainer {
                        /*@editable*/
                        background-color: #ffffff;
                        /*@editable*/
                        background-image: none;
                        /*@editable*/
                        background-repeat: no-repeat;
                        /*@editable*/
                        background-position: center;
                        /*@editable*/
                        background-size: cover;
                        /*@editable*/
                        border-top: 0;
                        /*@editable*/
                        border-bottom: 0;
                        /*@editable*/
                        padding-top: 0;
                        /*@editable*/
                        padding-bottom: 45px;
                    }
                    .bodyContainer .mcnTextContent,
                    .bodyContainer .mcnTextContent p {
                        /*@editable*/
                        color: #808080;
                        /*@editable*/
                        font-family: Helvetica;
                        /*@editable*/
                        font-size: 16px;
                        /*@editable*/
                        line-height: 150%;
                        /*@editable*/
                        text-align: left;
                    }
                    .bodyContainer .mcnTextContent a,
                    .bodyContainer .mcnTextContent p a {
                        /*@editable*/
                        color: #007e9e;
                        /*@editable*/
                        font-weight: normal;
                        /*@editable*/
                        text-decoration: underline;
                    }
                    #templateFooter {
                        /*@editable*/
                        background-color: #07c4f6;
                        /*@editable*/
                        background-image: none;
                        /*@editable*/
                        background-repeat: no-repeat;
                        /*@editable*/
                        background-position: center;
                        /*@editable*/
                        background-size: cover;
                        /*@editable*/
                        border-top: 0;
                        /*@editable*/
                        border-bottom: 0;
                        /*@editable*/
                        padding-top: 0;
                        /*@editable*/
                        padding-bottom: 0px;
                    }
                    .footerContainer {
                        /*@editable*/
                        background-color: #07c4f6;
                        /*@editable*/
                        background-image: none;
                        /*@editable*/
                        background-repeat: no-repeat;
                        /*@editable*/
                        background-position: center;
                        /*@editable*/
                        background-size: cover;
                        /*@editable*/
                        border-top: 0;
                        /*@editable*/
                        border-bottom: 0;
                        /*@editable*/
                        padding-top: 0px;
                        /*@editable*/
                        padding-bottom: 0px;
                    }
                    .footerContainer .mcnTextContent,
                    .footerContainer .mcnTextContent p {
                        /*@editable*/
                        color: #ffffff;
                        /*@editable*/
                        font-family: Helvetica;
                        /*@editable*/
                        font-size: 12px;
                        /*@editable*/
                        line-height: 150%;
                        /*@editable*/
                        text-align: center;
                    }
                    .footerContainer .mcnTextContent a,
                    .footerContainer .mcnTextContent p a {
                        /*@editable*/
                        color: #ffffff;
                        /*@editable*/
                        font-weight: normal;
                        /*@editable*/
                        text-decoration: underline;
                    }
                    @media only screen and (min-width: 768px) {
                        .templateContainer {
                            width: 600px !important;
                        }
                    }
                    @media only screen and (max-width: 480px) {
                        body,
                        table,
                        td,
                        p,
                        a,
                        li,
                        blockquote {
                            -webkit-text-size-adjust: none !important;
                        }
                    }
                    @media only screen and (max-width: 480px) {
                        body {
                            width: 100% !important;
                            min-width: 100% !important;
                        }
                    }
                    @media only screen and (max-width: 480px) {
                        .mcnRetinaImage {
                            max-width: 100% !important;
                        }
                    }
                    @media only screen and (max-width: 480px) {
                        .mcnImage {
                            width: 100% !important;
                        }
                    }
                    @media only screen and (max-width: 480px) {
                        .mcnCartContainer,
                        .mcnCaptionTopContent,
                        .mcnRecContentContainer,
                        .mcnCaptionBottomContent,
                        .mcnTextContentContainer,
                        .mcnBoxedTextContentContainer,
                        .mcnImageGroupContentContainer,
                        .mcnCaptionLeftTextContentContainer,
                        .mcnCaptionRightTextContentContainer,
                        .mcnCaptionLeftImageContentContainer,
                        .mcnCaptionRightImageContentContainer,
                        .mcnImageCardLeftTextContentContainer,
                        .mcnImageCardRightTextContentContainer,
                        .mcnImageCardLeftImageContentContainer,
                        .mcnImageCardRightImageContentContainer {
                            max-width: 100% !important;
                            width: 100% !important;
                        }
                    }
                    @media only screen and (max-width: 480px) {
                        .mcnBoxedTextContentContainer {
                            min-width: 100% !important;
                        }
                    }
                    @media only screen and (max-width: 480px) {
                        .mcnImageGroupContent {
                            padding: 9px !important;
                        }
                    }
                    @media only screen and (max-width: 480px) {
                        .mcnCaptionLeftContentOuter .mcnTextContent,
                        .mcnCaptionRightContentOuter .mcnTextContent {
                            padding-top: 9px !important;
                        }
                    }
                    @media only screen and (max-width: 480px) {
                        .mcnImageCardTopImageContent,
                        .mcnCaptionBottomContent:last-child .mcnCaptionBottomImageContent,
                        .mcnCaptionBlockInner .mcnCaptionTopContent:last-child .mcnTextContent {
                            padding-top: 18px !important;
                        }
                    }
                    @media only screen and (max-width: 480px) {
                        .mcnImageCardBottomImageContent {
                            padding-bottom: 9px !important;
                        }
                    }
                    @media only screen and (max-width: 480px) {
                        .mcnImageGroupBlockInner {
                            padding-top: 0 !important;
                            padding-bottom: 0 !important;
                        }
                    }
                    @media only screen and (max-width: 480px) {
                        .mcnImageGroupBlockOuter {
                            padding-top: 9px !important;
                            padding-bottom: 9px !important;
                        }
                    }
                    @media only screen and (max-width: 480px) {
                        .mcnTextContent,
                        .mcnBoxedTextContentColumn {
                            padding-right: 18px !important;
                            padding-left: 18px !important;
                        }
                    }
                    @media only screen and (max-width: 480px) {
                        .mcnImageCardLeftImageContent,
                        .mcnImageCardRightImageContent {
                            padding-right: 18px !important;
                            padding-bottom: 0 !important;
                            padding-left: 18px !important;
                        }
                    }
                    @media only screen and (max-width: 480px) {
                        .mcpreview-image-uploader {
                            display: none !important;
                            width: 100% !important;
                        }
                    }
                    @media only screen and (max-width: 480px) {
                        h1 {
                            /*@editable*/
                            font-size: 30px !important;
                            /*@editable*/
                            line-height: 125% !important;
                        }
                    }
                    @media only screen and (max-width: 480px) {
                        h2 {
                            /*@editable*/
                            font-size: 26px !important;
                            /*@editable*/
                            line-height: 125% !important;
                        }
                    }
                    @media only screen and (max-width: 480px) {
                        h3 {
                            /*@editable*/
                            font-size: 20px !important;
                            /*@editable*/
                            line-height: 150% !important;
                        }
                    }
                    @media only screen and (max-width: 480px) {
                        h4 {
                            /*@editable*/
                            font-size: 18px !important;
                            /*@editable*/
                            line-height: 150% !important;
                        }
                    }
                    @media only screen and (max-width: 480px) {
                        .mcnBoxedTextContentContainer .mcnTextContent,
                        .mcnBoxedTextContentContainer .mcnTextContent p {
                            /*@editable*/
                            font-size: 14px !important;
                            /*@editable*/
                            line-height: 150% !important;
                        }
                    }
                    @media only screen and (max-width: 480px) {
                        .headerContainer .mcnTextContent,
                        .headerContainer .mcnTextContent p {
                            /*@editable*/
                            font-size: 16px !important;
                            /*@editable*/
                            line-height: 150% !important;
                        }
                    }
                    @media only screen and (max-width: 480px) {
                        .bodyContainer .mcnTextContent,
                        .bodyContainer .mcnTextContent p {
                            /*@editable*/
                            font-size: 16px !important;
                            /*@editable*/
                            line-height: 150% !important;
                        }
                    }
                    @media only screen and (max-width: 480px) {
                        .footerContainer .mcnTextContent,
                        .footerContainer .mcnTextContent p {
                            /*@editable*/
                            font-size: 14px !important;
                            /*@editable*/
                            line-height: 150% !important;
                        }
                    }
                </style>
            </head>
            <body>
                <span class="mcnPreviewText" style="display: none; font-size: 0px; line-height: 0px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; visibility: hidden; mso-hide: all;">*|MC_PREVIEW_TEXT|*</span><!--<![endif]-->
                <!--*|END:IF|*-->
                <center>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">
                        <tr>
                            <td align="center" valign="top" id="bodyCell">
                                <!-- BEGIN TEMPLATE // -->
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td align="center" valign="top" id="templateHeader">
                                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer">
                                                <tr>
                                                    <td valign="top" class="headerContainer">
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width: 100%;">
                                                            <tbody class="mcnImageBlockOuter">
                                                                <tr>
                                                                    <td valign="top" style="padding: 0px;" class="mcnImageBlockInner">
                                                                        <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width: 100%;">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="mcnImageContent" valign="top" style="padding-right: 0px; padding-left: 0px; padding-top: 0; padding-bottom: 0; text-align: center;">
                                                                                        <img
                                                                                            align="center"
                                                                                            alt=""
                                                                                            src="'.base_url('webroot/user/email/logo.png').'"
                                                                                            width="114"
                                                                                            style="max-width: 1406px; padding-bottom: 0px; vertical-align: bottom; display: inline !important; border-radius: 0%;"
                                                                                            class="mcnRetinaImage"
                                                                                        />
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" valign="top" id="templateBody">
                                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer">
                                                <tr>
                                                    <td valign="top" class="bodyContainer">
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width: 100%;">
                                                            <tbody class="mcnImageBlockOuter">
                                                                <tr>
                                                                    <td valign="top" style="padding: 9px;" class="mcnImageBlockInner">
                                                                        <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width: 100%;">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="mcnImageContent" valign="top" style="padding-right: 9px; padding-left: 9px; padding-top: 0; padding-bottom: 0; text-align: center;">
                                                                                        <img
                                                                                            align="center"
                                                                                            alt=""
                                                                                            src="'.base_url('webroot/user/email/d-01.png').'"
                                                                                            width="177.6"
                                                                                            style="max-width: 480px; padding-bottom: 0; display: inline !important; vertical-align: bottom;"
                                                                                            class="mcnImage"
                                                                                        />
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width: 100%;">
                                                            <tbody class="mcnImageBlockOuter">
                                                                <tr>
                                                                    <td valign="top" style="padding: 9px;" class="mcnImageBlockInner">
                                                                        <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width: 100%;">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="mcnImageContent" valign="top" style="padding-right: 9px; padding-left: 9px; padding-top: 0; padding-bottom: 0; text-align: center;">
                                                                                    <a href="'.$actual_link.'" target="_blank">
                                                                                        <img
                                                                                            align="center"
                                                                                            alt=""
                                                                                            src="'.base_url('webroot/user/email/place.png').'"
                                                                                            width="282"
                                                                                            style="max-width: 1513px; padding-bottom: 0; display: inline !important; vertical-align: bottom;width: 100%;"
                                                                                            class="mcnImage"
                                                                                        />
                                                                                    </a>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnDividerBlock" style="min-width: 100%;">
                                                            <tbody class="mcnDividerBlockOuter">
                                                                <tr>
                                                                    <td class="mcnDividerBlockInner" style="min-width: 100%; padding: 9px 18px 0px;">
                                                                        <table class="mcnDividerContent" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width: 100%;">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <!-- order details -->
                                                                                    <td style="border: 1px solid #e0e0e0; border-bottom-left-radius: 6px; border-bottom-right-radius: 6px;">
                                                                                        <table style="width: 100%; max-width: 100%; margin: 0px; padding: 0px;" border="0" cellspacing="0" cellpadding="0">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td colspan="2" height="26"> 
                                                                                                        <p style="padding: 0px 0 5px 0; margin: 0px; color: #7e7e7e; font-family: arial; font-size: 12px;">&nbsp; Hi '.$name.',</p>
                                                                                                        <p style="padding: 0px; margin: 0px; color: #00c174; font-family: arial; font-size: 12px; font-weight: bold;">Your order has been successfully placed.</p>
                                                                                                    </td>
                                                                                                    <td style="float: right; width:190px">
                                                                                                    <p style="padding: 0px 0 5px 0; margin: 0px; color: #7e7e7e; font-family: arial; font-size: 12px;"> Order placed on '.date("D M d", strtotime($data['user_order_details']->order_date)).'</p>
                                                                                                    <p style="padding: 0px 0 5px 0; margin: 0px; color: #7e7e7e; font-family: arial; font-size: 12px;"> Order ID: '.$data['user_order_details']->order_code.'</p>
                                                                                                   
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td colspan="2" height="26">&nbsp;</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td style="text-align: center; padding: 0px 25px;" valign="top">
                                                                                                        <img src="'.base_url('webroot/user/email/calendar.png').'" alt="" width="17" height="19" class="CToWUd" />
                                                                                                    </td>
                                                                                                    <td style="float: left;">
                                                                                                        <p style="padding: 0px 0 5px 0; margin: 0px; color: #7e7e7e; font-family: arial; font-size: 12px;">We will deliver your order by</p>
                                                                                                        <p style="padding: 0px; margin: 0px; color: #00c174; font-family: arial; font-size: 12px; font-weight: bold;">'.date("D M d", strtotime($data['user_order_details']->user_order_details)).'</p>
                                                                                                    </td>
                                                                                                    
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td colspan="2" height="29">&nbsp;</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td style="text-align: center; padding: 0px 3px;" valign="top" width="17" height="19">
                                                                                                        <img src="'.base_url('webroot/user/email/farm-house.png').'" alt="" width="17" height="19" class="CToWUd" />
                                                                                                    </td>
                                                                                                    <td style="float: left;">
                                                                                                        <p style="padding: 0px 0 5px 0; margin: 0px; color: #7e7e7e; font-family: arial; font-size: 12px;">Your order will be sent to</p>
                                                                                                        <p style="padding: 0px 10px 0px 0; margin: 0px; color: #000000; font-family: arial; font-size: 12px; font-weight: bold; line-height: 18px;">
                                                                                                            '.$address->name.','.$address->address_details.','.$address->locality.','.$address->city_dist_town.','.$state_name->name.','.$address->pin_code.','.$address->landmark.'
                                                                                                        </p>
                                                                                                        <p style="padding: 0px; margin: 0px;">
                                                                                                            <span style="font-family: arial; font-size: 12px; color: #7e7e7e;">
                                                                                                                Mobile No: <strong style="color: #000000; font-weight: bold;">'.$address->mobile_no.'</strong>
                                                                                                            </span>
                                                                                                        </p>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td colspan="2" height="29">&nbsp;</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td style="text-align: center; padding: 0px 25px;" valign="top" width="17" height="19">
                                                                                                        <img src="'.base_url('webroot/user/email/rupee.png').'" alt="" width="17" height="19" class="CToWUd" />
                                                                                                    </td>
                                                                                                    <td style="float: left;">
                                                                                                        <p style="padding: 0px 0px 5px 0; margin: 0px; font-family: arial; font-size: 12px; color: #7e7e7e;">
                                                                                                            Payment Mode: <span style="color: #000000;">'.$data['user_order_item'][0]->payment_mode.'</span>.
                                                                                                        </p>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td colspan="2" height="26">&nbsp;</td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td style="width: 100%;">
                                                                                        <table
                                                                                            border="0"
                                                                                            width="100%"
                                                                                            cellspacing="0"
                                                                                            cellpadding="0"
                                                                                            style="border: #e0e0e0 solid 1px; font-family: Arial; font-size: 12px; color: #000000; border-radius: 6px; width: 100%;"
                                                                                        >
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td>
                                                                                                        <table width="100%" border="0" cellspacing="10" cellpadding="0">
                                                                                                            <tbody>';
                                                                                                            foreach ($data['user_order_item'] as $key => $value) {
                                                                                                                $product_img=unserialize($value->image);
                                                                                                                $total=Intval(($total+$value->sell_price)*$value->quantity);
                                                                                                                $total_shipping=Intval(($total_shipping+$value->shipping_price)*$value->quantity);
                                                                                                            $message=$message.'
                                                                                                                <tr>
                                                                                                                    <td valign="top" style="padding: 20px;">
                                                                                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                                                            <tbody>
                                                                                                                                <tr>
                                                                                                                                    <td width="10%" valign="top">
                                                                                                                                        <img width="63" height="63" src="'.base_url('webroot/admin/product/web/').$product_img[0].'" style="border: 1px solid #e0e0e0;" alt="product" class="CToWUd" />
                                                                                                                                    </td>
                                                                                                                                    <td width="3%" valign="top">&nbsp;</td>
                                                                                                                                    <td width="87%" valign="top">
                                                                                                                                        <table width="100%" border="0" cellspacing="5" cellpadding="0">
                                                                                                                                            <tbody style="line-height: 2;">
                                                                                                                                                <tr>
                                                                                                                                                    <td align="left" valign="middle" style="font-family: arial; font-size: 12px;">
                                                                                                                                                       '.$value->product_name.'
                                                                                                                                                    </td>
                                                                                                                                                </tr>
                                                                                                                                                <tr>
                                                                                                                                                    <td align="left" style="font-family: arial; font-size: 12px;" valign="middle">
                                                                                                                                                        <span style="color: #7e7e7e;">Quantity:</span>
                                                                                                                                                        <span style="display: inline-block; padding-right: 15px;">'.$value->quantity.'</span>
                                                                                                                                                        <span style="display: inline-block;">
                                                                                                                                                            <span style="color: #7e7e7e;">Unit price:</span>
                                                                                                                                                            Rs.'.Intval($value->mrp_price*$value->quantity).'
                                                                                                                                                        </span>
                                                                                                                                                    </td>
                                                                                                                                                </tr>
                                                                                                                                                <tr>
                                                                                                                                                    <td align="left" style="font-family: arial; font-size: 12px;" valign="middle">
                                                                                                                                                        <span style="display: inline-block; padding-right: 15px;">
                                                                                                                                                            <span style="color: #7e7e7e;">Discount:</span>
                                                                                                                                                            Rs.'.Intval($value->discount*$value->quantity).'
                                                                                                                                                        </span>
                                                                                                                                                        <span style="color: #7e7e7e;">Subtotal:</span>
                                                                                                                                                        <strong> Rs.'.Intval($value->sell_price*$value->quantity).' </strong>
                                                                                                                                                    </td>
                                                                                                                                                </tr>
                                                                                                                                            </tbody>
                                                                                                                                        </table>
                                                                                                                                    </td>
                                                                                                                                </tr>
                                                                                                                            </tbody>
                                                                                                                        </table>
                                                                                                                    </td>
                                                                                                                </tr>';
                                                                                                            }
                                                                                                            $message=$message.'
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td style="background: #e0e0e0;" height="1"></td>
                                                                                                </tr>
        
                                                                                                <tr>
                                                                                                    <td bgcolor="#f5f5f5">
                                                                                                        <table width="100%" border="0" cellspacing="10" cellpadding="0">
                                                                                                            <tbody>
                                                                                                                <tr>
                                                                                                                    <td valign="top" style="padding: 20px;">
                                                                                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                                                            <tbody>
                                                                                                                                <tr>
                                                                                                                                    <td width="12%" valign="top">&nbsp;</td>
                                                                                                                                    <td width="3%" valign="top">&nbsp;</td>
                                                                                                                                    <td width="85%" valign="top">
                                                                                                                                        <table width="100%" border="0" cellspacing="5" cellpadding="0">
                                                                                                                                            <tbody style="line-height: 2;">
                                                                                                                                                <tr>
                                                                                                                                                    <td width="60%" align="left" valign="top" style="font-family: arial; font-size: 12px;">
                                                                                                                                                        Subtotal:
                                                                                                                                                    </td>
                                                                                                                                                    <td width="40%" align="right" valign="top" style="font-family: arial; font-size: 12px;">
                                                                                                                                                       Rs.'.$total.'
                                                                                                                                                    </td>
                                                                                                                                                </tr>
        
                                                                                                                                                
        
                                                                                                                                               
                                                                                                                                                <tr>
                                                                                                                                                    <td align="left" valign="top" style="font-family: arial; font-size: 12px;">
                                                                                                                                                        Shipping Cost:
                                                                                                                                                    </td>
                                                                                                                                                    <td align="right" valign="top" style="font-family: arial; font-size: 12px;">
                                                                                                                                                        Rs.'.$total_shipping.'
                                                                                                                                                    </td>
                                                                                                                                                </tr>
        
                                                                                                                                                <tr>
                                                                                                                                                    <td align="left" valign="top" style="font-family: arial; font-size: 12px;">
                                                                                                                                                        <strong>Total</strong>
                                                                                                                                                    </td>
                                                                                                                                                    <td align="right" valign="top" style="font-family: arial; font-size: 12px;">
                                                                                                                                                        <strong>Rs.'.Intval($total+$total_shipping).'</strong>
                                                                                                                                                    </td>
                                                                                                                                                </tr>
                                                                                                                                            </tbody>
                                                                                                                                        </table>
                                                                                                                                    </td>
                                                                                                                                </tr>
                                                                                                                            </tbody>
                                                                                                                        </table>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" valign="top" id="templateFooter">
                                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer">
                                                <tr>
                                                    <td valign="top" class="footerContainer">
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowBlock" style="min-width: 100%;">
                                                            <tbody class="mcnFollowBlockOuter">
                                                                <tr>
                                                                    <td align="center" valign="top" style="padding: 9px;" class="mcnFollowBlockInner">
                                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentContainer" style="min-width: 100%;">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center" style="padding-left: 9px; padding-right: 9px;">
                                                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width: 100%;" class="mcnFollowContent">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td align="center" valign="top" style="padding-top: 9px; padding-right: 9px; padding-left: 9px;">
                                                                                                        <table align="center" border="0" cellpadding="0" cellspacing="0">
                                                                                                            <tbody>
                                                                                                                <tr>
                                                                                                                    <td align="center" valign="top">
                                                                                                                        <table align="left" border="0" cellpadding="0" cellspacing="0" class="mcnFollowStacked" style="display: inline;">
                                                                                                                            <tbody>
                                                                                                                                <tr>
                                                                                                                                    <td align="center" valign="top" class="mcnFollowIconContent" style="padding-right: 10px; padding-bottom: 9px;">
                                                                                                                                        <a href="https://www.facebook.com/Bongbasar/" target="_blank">
                                                                                                                                            <img
                                                                                                                                                src="'.base_url('webroot/user/email/facebook.png').'"
                                                                                                                                                alt="Facebook"
                                                                                                                                                class="mcnFollowBlockIcon"
                                                                                                                                                width="48"
                                                                                                                                                style="width: 48px; max-width: 48px; display: block;"
                                                                                                                                            />
                                                                                                                                        </a>
                                                                                                                                    </td>
                                                                                                                                </tr>
                                                                                                                            </tbody>
                                                                                                                        </table>
                                                                                                                        <table align="left" border="0" cellpadding="0" cellspacing="0" class="mcnFollowStacked" style="display: inline;">
                                                                                                                            <tbody>
                                                                                                                                <tr>
                                                                                                                                    <td align="center" valign="top" class="mcnFollowIconContent" style="padding-right: 10px; padding-bottom: 9px;">
                                                                                                                                        <a href="https://twitter.com/bongbasar" target="_blank">
                                                                                                                                            <img
                                                                                                                                                src="'.base_url('webroot/user/email/twitter.png').'"
                                                                                                                                                alt="Twitter"
                                                                                                                                                class="mcnFollowBlockIcon"
                                                                                                                                                width="48"
                                                                                                                                                style="width: 48px; max-width: 48px; display: block;"
                                                                                                                                            />
                                                                                                                                        </a>
                                                                                                                                    </td>
                                                                                                                                </tr>
                                                                                                                            </tbody>
                                                                                                                        </table>
                                                                                                                        
                                                                    
                                                                                                                        <table align="left" border="0" cellpadding="0" cellspacing="0" class="mcnFollowStacked" style="display: inline;">
                                                                                                                            <tbody>
                                                                                                                                <tr>
                                                                                                                                    <td align="center" valign="top" class="mcnFollowIconContent" style="padding-right: 10px; padding-bottom: 9px;">
                                                                                                                                        <a href="https://www.linkedin.com/company/bongbasar/?viewAsMember=true" target="_blank">
                                                                                                                                            <img
                                                                                                                                                src="'.base_url('webroot/user/email/linkedin.png').'"
                                                                                                                                                alt="LinkedIn"
                                                                                                                                                class="mcnFollowBlockIcon"
                                                                                                                                                width="48"
                                                                                                                                                style="width: 48px; max-width: 48px; display: block;"
                                                                                                                                            />
                                                                                                                                        </a>
                                                                                                                                    </td>
                                                                                                                                </tr>
                                                                                                                            </tbody>
                                                                                                                        </table>
                                                                                                                        <table align="left" border="0" cellpadding="0" cellspacing="0" class="mcnFollowStacked" style="display: inline;">
                                                                                                                            <tbody>
                                                                                                                                <tr>
                                                                                                                                    <td align="center" valign="top" class="mcnFollowIconContent" style="padding-right: 10px; padding-bottom: 9px;">
                                                                                                                                        <a href="https://www.instagram.com/bongbasar/?hl=en" target="_blank">
                                                                                                                                            <img
                                                                                                                                                src="'.base_url('webroot/user/email/instagram.png').'"
                                                                                                                                                alt="Instagram"
                                                                                                                                                class="mcnFollowBlockIcon"
                                                                                                                                                width="48"
                                                                                                                                                style="width: 48px; max-width: 48px; display: block;"
                                                                                                                                            />
                                                                                                                                        </a>
                                                                                                                                    </td>
                                                                                                                                </tr>
                                                                                                                            </tbody>
                                                                                                                        </table>
                                                                                                                        <table align="left" border="0" cellpadding="0" cellspacing="0" class="mcnFollowStacked" style="display: inline;">
                                                                                                                            <tbody>
                                                                                                                                <tr>
                                                                                                                                    <td align="center" valign="top" class="mcnFollowIconContent" style="padding-right: 0; padding-bottom: 9px;">
                                                                                                                                        <a href="https://www.youtube.com/channel/UCbFi94tAbxUafAfUtfY43rg" target="_blank">
                                                                                                                                            <img
                                                                                                                                                src="'.base_url('webroot/user/email/youtube.png').'"
                                                                                                                                                alt="YouTube"
                                                                                                                                                class="mcnFollowBlockIcon"
                                                                                                                                                width="48"
                                                                                                                                                style="width: 48px; max-width: 48px; display: block;"
                                                                                                                                            />
                                                                                                                                        </a>
                                                                                                                                    </td>
                                                                                                                                </tr>
                                                                                                                            </tbody>
                                                                                                                        </table>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <!-- // END TEMPLATE -->
                            </td>
                        </tr>
                    </table>
                </center>
            </body>
        </html>
        ';
        $config = Array(
            'protocol' => 'smtp',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'wordwrap' => TRUE
        );
        $this->load->library('email', $config);
        $from='developer.bongtechsolution@gmail.com';
        $from_name='Bongbasar';
        $to_email= $this->session->userdata('loginDetail')->email;
        $subject='Your Order has been successfully placed ';
        email_send();
        $this->email->from($from, $from_name);
        $this->email->to($to_email);
        $this->email->subject($subject);
        $this->email->message($message);
        $send=$this->email->send();
    }


	public function success($order_code)
	{
		if(($this->session->userdata('loginDetail')!=NULL))
		{	
            $user_id=$this->session->userdata('loginDetail')->uniqcode;
            // $this->data['menu_lebel'] = $this->Home_Model->get_categories();
            $this->data['user_order_details'] = $this->Order_Model->user_orders_details($user_id,$order_code);
            $this->data['user_order_item'] = $this->Order_Model->user_delivery_item($user_id,$order_code);
            // pr($this->data['user_order_item']);
            foreach ($this->data['user_order_item'] as $key => $user_order_item) 
            {
                $where=array(
                    'uniqcode'=>$user_order_item->product_features_id,
                );
                $product_data=$this->Order_Model->selectrow($where,'tbl_product_features');
                $final_stock_quentity=Intval($product_data->stock_quentity-$user_order_item->quantity);
                $data=array(
                    'stock_quentity'=>$final_stock_quentity
                );
                $this->Order_Model->update('tbl_product_features', $where,$data);
                $this-> order_place_email($this->data);
            }
           
			$this->data['page_title']='Bongbazaar | OrderSuccess';
			$this->data['subview']='order/success';
			// pr($this->data);
			$this->load->view('user/layout/default', $this->data);
		}
		else
		{
			$this->session->set_flashdata('error', 'You do not sing in...');
			redirect('');
		}
	}

	public function error()
	{
		if(($this->session->userdata('loginDetail')!=NULL))
		{	
			$this->data['page_title']='Bongbazaar | OrderError';
			$this->data['subview']='order/error';
			//pr($this->data);
			$this->load->view('user/layout/default', $this->data);
		}
		else
		{
			$this->session->set_flashdata('error', 'You do not sing in...');
			redirect('');
		}
	}

	public function Cancel()
	{
        $reason=$this->input->post('reason');
        $comment=$this->input->post('comment');
        $orderid=$this->input->post('orderid');
        $date=date('Y-m-d H:i:s');
        $data=array(
            'uniqcode' =>"st".random_string('alnum',28),
            'order_id'=>$orderid,
            'reason'=>$reason,
            'comments'=>$comment,
            'datetime' =>$date
        );
        if($this->Order_Model->insert($data,'tbl_cancel_order_reason'))
        {
            $where=array(
                'uniqcode'=>$orderid
            );
            $data=array(
                'order_status'=>'Cancel',
                'datetime'=>$date
            );
            if($this->Order_Model->update('tbl_order',$where,$data))
            {
                $this->session->set_flashdata('success', 'Your order cancel successfully');
                echo 'success';
            }
            else
            {
                $this->session->set_flashdata('error', 'Your order do not cancel!');
                echo 'error';
            }
        }
        
		
	}

	public function orderDetails($order_code)
	{
		if(($this->session->userdata('loginDetail')!=NULL))
		{	
            $user_id=$this->session->userdata('loginDetail')->uniqcode;
			$this->data['page_title']='Bongbazaar | Delivery';
			$this->data['user_order_details'] = $this->Order_Model->user_orders_details($user_id,$order_code);
			$this->data['user_order_item'] = $this->Order_Model->user_delivery_item($user_id,$order_code);
        	//pr($this->data);
			$this->data['subview']='delivery/delivery';
			$this->load->view('user/layout/default', $this->data);
		}
		else
		{
			$this->session->set_flashdata('error', 'You do not sing in...');
			redirect('');
		}
	}

	public function randomNumber()
	{
		$rst=random_string('numeric',4);
		echo $rst;
    }
    public function Order_time_Quantity_check()
    {
        $temp=0;
        if(($this->session->userdata('loginDetail')!=NULL))
		{
			$user_id=$this->session->userdata('loginDetail')->uniqcode;
            $cart_details=$this->Cart_Model->get_cartItem($user_id);
            foreach ($cart_details as $key => $value) {
                $product_quantity[$key]=$this->Cart_Model->product_quantity( $value->product_features_id);
                if($product_quantity[$key]->stock_quentity >$value->quantity)
                {
                    $temp=1;
                    $this->session->set_flashdata('error', 'product out of stock');
                    
                }
            }
            if($temp==1)
            {
                echo json_encode(['result'=>1]);
            }
        }
    }
}
    