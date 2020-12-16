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

		// if(($this->session->userdata('loginDetail')==NULL))
		// {
		//    redirect('');
		// }
	} 

	public function index($address_id)
	{
	 	if(($this->session->userdata('loginDetail')!=NULL))
		{	
			$this->data['page_title']='Bongbazaar | Order';
			$this->data['subview']='order/order';
			$this->data['address_id']=$address_id;
			$this->data['capcha_value']=random_string('numeric',4);
			//$this->data['menu_lebel'] = $this->Home_Model->get_categories();

			$this->data['cart_details']=$this->Cart_Model->get_cartItem($this->session->userdata('loginDetail')->uniqcode);
			//pr($this->data);
			$this->load->view('user/layout/default', $this->data);
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
			//$this->data['menu_lebel'] = $this->Home_Model->get_categories();

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
                    'datetime'=>date('Y-m-d H:i:s;)
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
                    'datetime'=>date('Y-m-d H:i:s;)
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
                    'datetime'=>date('Y-m-d H:i:s;)
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
                    'datetime'=>date('Y-m-d H:i:s;)
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
        $date=date('Y-m-d H:i:s;);
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
}
    