<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CartController extends CI_Controller 
{ 
	function __construct()
	{
	  	parent::__construct(); 	
	  	$this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");	
	  	date_default_timezone_set('Asia/Kolkata');
		$this->load->helper(array('common_helper', 'string', 'form', 'security','url'));
		$this->load->library(array('form_validation', 'email'));
		$this->load->model('home/Home_Model');
		$this->load->model('cart/Cart_Model');	
	} 

	public function Bag()
	{
		if(($this->session->userdata('loginDetail')!=NULL))
		{
			$product_quantity=array();
			$this->BuyNowUpdate();
			$this->data['page_title']='Bongbazaar | Cart';
			//$this->data['menu_lebel'] = $this->Home_Model->get_categories();
			$this->data['subview']='cart/cart';
			$this->data['cart_details']=$this->Cart_Model->get_cartItem($this->session->userdata('loginDetail')->uniqcode);
			foreach ($this->data['cart_details'] as $key => $cart_details) {
				$product_quantity[$key]=$this->Cart_Model->product_quantity( $cart_details->product_features_id);
			}
			pr($product_quantity);
			$this->data['product_quantity']=$product_quantity;
			$this->load->view('user/layout/default', $this->data);
		}
		else
		{
			$this->session->set_flashdata('error', 'You do not sing in...');
			redirect('');
		}

	}

	public function BuyNowUpdate()
    {   
    	if(($this->session->userdata('loginDetail')!=NULL))
		{
			$user_id=$this->session->userdata('loginDetail')->uniqcode;           

            if(!empty($user_id))
            {
                $data=array(
                    'user_id'=>$user_id,
                    'status'=>"Buy"
                );

                $data2=array(
                    'status'=>"Cart",
                    'datetime'=>date('Y-m-d h:i:s')
                );

                $data3=array(
                    'status'=>"Delete",
                    'datetime'=>date('Y-m-d h:i:s')
                );

                $check = $this->Cart_Model->entty_check($data,'tbl_cart');
                if($check)
                {
                    
                    $data1 = $this->Cart_Model->buyNowCheck_getRows($user_id);
                    
                    $data5=array(
                        'product_id'=>$data1->product_id,
                        'product_features_id'=>$data1->product_features_id,
                        'color'=>$data1->color,
                        'status'=>'Cart'
                    );
                    $check1 = $this->Cart_Model->entty_check($data5,'tbl_cart');

                    $data4 = $this->Cart_Model->buyNowCheck1_getRows($user_id);

                    if($check1)
                    {
                        $update = $this->Cart_Model->update('tbl_cart',['uniqcode'=>$data4],$data3);
                    }
                    else
                    {
                        $update = $this->Cart_Model->update('tbl_cart',['uniqcode'=>$data4],$data2);
                    }

                }
            }  
		}
    }
	
	public function addToBag()
	{
		if($this->session->userdata('loginDetail')!=NULL)
		{
			$this->BuyNowUpdate();
			$product_id=$this->input->post('product_id');
			$product_features_id=$this->input->post('product_features_id');
			$color=$this->input->post('color_id');
			
			$business_type=$this->input->post('business_type');

			$quantity=1;
			if($business_type=='Wholesaler')
			{
				$quantity=50;
			}
			
			$newData=array(
                'uniqcode'=>"ca".random_string('alnum',28),
                'user_id'=>$this->session->userdata('loginDetail')->uniqcode,
                'product_id'=>$product_id,
                'product_features_id'=>$product_features_id,
                'quantity'=>$quantity,
				'color'=>$color,
                'status'=>'Cart',
                'datetime'=>date('Y-m-d h:i:s')
            );
			// pr($newData);
			// die;
			$chack=array(
				'user_id'=>$newData['user_id'],
				'product_id'=>$newData['product_id'],
				'product_features_id'=>$newData['product_features_id'],
				'color'=>$newData['color'],
				'status <>'=>'Delete'
			);
			$count=$this->Cart_Model->entty_check($chack,'tbl_cart');
			
			if($count==0)
            {
				if($this->Cart_Model->insert($newData,'tbl_cart'))
				{
					$this->session->set_flashdata('success', 'Item into add your bag.');
					echo json_encode(['result'=>1]);
					return false;
				}
				else
				{
					$this->session->set_flashdata('error', 'Some problem.');
					echo json_encode(['result'=>2]);
					return false;
				}
			}
			else
			{
				$this->session->set_flashdata('error', 'Item allready added into your bag.');
				echo json_encode(['result'=>4]);
				return false;
			}
		
		}
		else
		{
			echo json_encode(['result'=>0]);
			return false;
		}
		
	}

	public function addToBagBuyNou()
	{
		if($this->session->userdata('loginDetail')!=NULL)
		{
			$this->BuyNowUpdate();
			$product_id=$this->input->post('product_id');
			$product_features_id=$this->input->post('product_features_id');
			$color=$this->input->post('color_id');
			$business_type=$this->input->post('business_type');

			$quantity=1;
			if($business_type=='Wholesaler')
			{
				$quantity=50;
			}
			
			$newData=array(
                'uniqcode'=>"ca".random_string('alnum',28),
                'user_id'=>$this->session->userdata('loginDetail')->uniqcode,
                'product_id'=>$product_id,
                'product_features_id'=>$product_features_id,
                'quantity'=>$quantity,
                'color'=>$color,
                'status'=>'Buy',
                'datetime'=>date('Y-m-d h:i:s')
            );
			// pr($newData);
			// die;
			if($this->Cart_Model->insert($newData,'tbl_cart'))
			{
				echo json_encode(['result'=>1]);
				return false;
			}
			else
			{
				$this->session->set_flashdata('error', 'Some problem.');
				echo json_encode(['result'=>2]);
				return false;
			}
			
		
		}
		else
		{
			echo json_encode(['result'=>0]);
			return false;
		}
	}
	
	public function bagUpdate()
	{

		if(($this->session->userdata('loginDetail')!=NULL))
		{
			$uniqcode=$this->input->post('uniqcode');
			$quantity=$this->input->post('quantity');
			if(!empty($uniqcode) && !empty($quantity))
			{
				$where=array(
					'uniqcode'=>$uniqcode
				);
				$cart_data=$this->Cart_Model->selectrow($where,'tbl_cart');
				$where=array(
					'uniqcode'=>$cart_data->product_features_id
				);
				$product_data=$this->Cart_Model->selectrow($where,'tbl_product_features');
				if($product_data->stock_quentity>=$quantity)
				{
					if($quantity>0)
					{
						$where=array(
							'uniqcode'=>$uniqcode
						);
						$data=array(
							'quantity'=>$quantity
						);
						$cart_row=$this->Cart_Model->update('tbl_cart',$where,$data);
						if($cart_row)
						{
							echo json_encode(['result'=>1]);
							return false;
						}
					}
					else
					{
						$this->session->set_flashdata('error', 'Minimum one quantity required...');
						echo json_encode(['result'=>2]);
						return false;
					}
				}
				else
				{
					$this->session->set_flashdata('error', 'Number of quantity is unavailable!');
					echo json_encode(['result'=>2]);
					return false;
				}
			}
		}
		else
		{
			$this->session->set_flashdata('error', 'You do not sing in...');
			echo json_encode(['result'=>3]);
			return false;
		}
	}
	public function decrementbagUpdate()
	{

		if(($this->session->userdata('loginDetail')!=NULL))
		{
			$uniqcode=$this->input->post('uniqcode');
			$quantity=$this->input->post('quantity');
			if(!empty($uniqcode) && !empty($quantity))
			{
				
					if($quantity>0)
					{
						$where=array(
							'uniqcode'=>$uniqcode
						);
						$data=array(
							'quantity'=>$quantity
						);
						$cart_row=$this->Cart_Model->update('tbl_cart',$where,$data);
						if($cart_row)
						{
							echo json_encode(['result'=>1]);
							return false;
						}
					}
					else
					{
						$this->session->set_flashdata('error', 'Minimum one quantity required...');
						echo json_encode(['result'=>2]);
						return false;
					}
				
			}
		}
		else
		{
			$this->session->set_flashdata('error', 'You do not sing in...');
			echo json_encode(['result'=>3]);
			return false;
		}
	}
	
	public function destroy()
	{
		$uniqcode=$this->input->post('uniqcode');
		if(!empty($uniqcode))
		{
			$data=array(
			'status'=>'Delete',
			'datetime'=>date('Y-m-d H:i:s'),
			);
			$this->db->where('uniqcode', $uniqcode);
			$this->db->update('tbl_cart', $data);
			$this->session->set_flashdata('success', 'Bag Item Remove Successfully');
			//echo json_encode(['result'=>1]);
			return false;
		}
		else
		{
			//$this->session->set_flashdata('success', 'Bag Item Remove Successfully');
			//redirect('bag');
			//echo json_encode(['result'=>1]);
			return false;
		}
		
	}
}
    