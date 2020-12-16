<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AddressController extends CI_Controller 
{ 
	function __construct()
	{
	  	parent::__construct(); 
	  	$this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");	
	  	date_default_timezone_set('Asia/Kolkata');		
		$this->load->helper(array('common_helper', 'string', 'form', 'security','url'));
		$this->load->library(array('form_validation', 'email'));
		$this->load->model('address/Address_Model');
		$this->load->model('cart/Cart_Model');	
		$this->load->model('user/User_Model');
		$this->load->model('home/Home_Model');
			

		// if(($this->session->userdata('loginDetail')==NULL))
		// {
		//    redirect('');
		// }	
	} 
	public function index()
	{
		if(($this->session->userdata('loginDetail')!=NULL))
		{
			$this->data['page_title']='Bongbazaar | Address';
			$this->data['subview']='address/address';
			//$this->data['menu_lebel'] = $this->Home_Model->get_categories();
			$this->data['cart_details']=$this->Cart_Model->get_cartItem($this->session->userdata('loginDetail')->uniqcode);
			$ar1=array(
				'status'=>'Active',
				'user_id'=>$this->session->userdata('loginDetail')->uniqcode
			);
			$this->data['allAddress']=$this->Address_Model->select_all($ar1,'tbl_users_delivery_address');
        	$this->data['all_state'] = $this->User_Model->all_state(['is_active'=>'Active','country_id'=>'101'],'tbl_state_mast');

			//pr($this->data);
			$this->load->view('user/layout/default', $this->data);
		}
		else
		{
			$this->session->set_flashdata('error', 'You do not sing in...');
			redirect('');
		}		
	}

	public function buyAddress()
	{
		if(($this->session->userdata('loginDetail')!=NULL))
		{
			$this->data['page_title']='Bongbazaar | Address';
			$this->data['subview']='address/buy_address';
			//$this->data['menu_lebel'] = $this->Home_Model->get_categories();
			$this->data['cart_details']=$this->Cart_Model->get_buyCartItem($this->session->userdata('loginDetail')->uniqcode);
			$ar1=array(
				'status'=>'Active',
				'user_id'=>$this->session->userdata('loginDetail')->uniqcode
			);
			$this->data['allAddress']=$this->Address_Model->select_all($ar1,'tbl_users_delivery_address');
        	$this->data['all_state'] = $this->User_Model->all_state(['is_active'=>'Active'],'tbl_state_mast');

			//pr($this->data);
			$this->load->view('user/layout/default', $this->data);
		}
		else
		{
			$this->session->set_flashdata('error', 'You do not sing in...');
			redirect('');
		}
	}

	public function addAddress()
	{
		if($_POST)
		{
			extract($_POST);

			$data1=array(
			'select_address'=>'0',

			);

			$check = $this->Address_Model->entty_check(['user_id'=>$user_id,'status'=>'Active'],'tbl_users_delivery_address');

			if($check)
			{
				$update = $this->Address_Model->update('tbl_users_delivery_address',['user_id'=>$user_id],$data1);
			}

			$data=array(
				'uniqcode' => random_string('alnum',20),
				'user_id'=>$user_id,
				'name' => $name,
				'mobile_no' => $mobile_no,
				'state' => $state,
				'city_dist_town' => $city_dist_town,
				'pin_code' => $pin_code,
				'locality' => $locality,
				'address_details' => $address_details,
				'landmark' => $landmark,
				'alternative_mob_no' => $alternative_mob_no,
				'address_type' => $address_type,
				'datetime' => date('Y-m-d H:i:s;)
			);
			$this->Address_Model->insert($data,'tbl_users_delivery_address');
			$this->session->set_flashdata('success', 'Address added successfully.');	
			redirect('profile');
			
		}

	}

	public function addressDestroy($uniqcode)
	{
		$this->db->where('status','Delete');
		$this->db->where('uniqcode', $uniqcode);
		$address_row=$this->db->get('tbl_users_delivery_address')->row();
		
		if(empty($address_row))
		{
			$data=array(
				'status'=> 'Delete',
				'datetime' => date('Y-m-d H:i:s;)
				);
			$this->db->where('uniqcode', $uniqcode);
			$update=$this->db->update('tbl_users_delivery_address', $data);
			// print_r($data);
			// die;
			$this->session->set_flashdata('success', 'Address deleted successfully.');	
			redirect('profile');
		}
		else
		{
			$this->session->set_flashdata('error', 'Address do not deleted successfully');                     
	 		redirect('profile');
		}	
	}

	public function editAddress()
	{
		
		$uniqcode=$this->input->post('uniqcode');
		$this->db->where('status <>', 'Delete');
		$this->db->where('uniqcode', $uniqcode);
		$address_row=$this->db->get('tbl_users_delivery_address')->row();
        $all_state = $this->User_Model->all_state(['is_active'=>'Active'],'tbl_state_mast');

		echo '
          		<form role="form" id="address-edit" action="'.base_url('address-update').'" method="post" enctype="multipart/form-data">
          			<input type="hidden" name="uniqcode" value="'.$address_row->uniqcode.'">

		            <div class="row">
		            <!-- <input type="hidden" name="edit_data" id="edit_data"> -->
		              <div class="col-lg-6">
		                <div class="form-group">
		                  <label>Name:</label>
		                  <input type="text" name="name" id="name" class="form-control only_character validate[required,custom[fullname]]" data-errormessage-value-missing="Name is required" data-prompt-position="bottomLeft" maxlength="200" value="'.$address_row->name.'">
		                </div>
		              </div>
		              <div class="col-lg-6">
		                <div class="form-group">
		                  <label>Mobile Number:</label>
		                  <input type="text" name="mobile_no" id="mobile_no" class="form-control only_integer validate[required,custom[phone]]minSize[10],maxSize[10]" data-errormessage-value-missing="Phone number is required" data-prompt-position="bottomLeft" maxlength="10"
		                  		value="'.$address_row->mobile_no.'">
		                </div>
		              </div>
		              <div class="col-lg-6">
		                <div class="form-group">
		                  <label>Pin Code:</label>
		                  <input type="text" name="pin_code" id="pin_code" class="form-control only_integer validate[required]" data-errormessage-value-missing="Pin code is required" data-prompt-position="bottomLeft"  maxlength="200"
		                  	value="'.$address_row->pin_code.'">
		                </div>
		              </div>
		              <div class="col-lg-6">
		                <div class="form-group">
		                  <label>Locality:</label>
		                  <input type="text" name="locality" id="locality" class="form-control form-control validate[required]" data-errormessage-value-missing="Locality  is required" data-prompt-position="bottomLeft" maxlength="200"value="'.$address_row->locality.'">
		                </div>
		              </div>
		              <div class="col-lg-6">
		                <div class="form-group">
		                	<label>State</label>
		                    <select id="state" name="state" class="form-control validate[required]" data-errormessage-value-missing="State is required" data-prompt-position="bottomLeft">';
		        
		                    foreach($all_state as $all_state_row)
		                    {
		                    	if($address_row->state==$all_state_row->id)
		                    	{
		                        	echo '<option value="'.$all_state_row->id.'" selected>'.$all_state_row->name.'</option>';
		                        	
		                        }
		                        else
		                        {
		                        	echo '<option value="'.$all_state_row->id.'">'.$all_state_row->name.'</option>';
		                        }
		                    }
		                    echo '</select> 
		       
		                </div>
		              </div>

		              
		              <div class="col-lg-6">
		                <div class="form-group">
		                  <label>City/District/Town:</label>
		                   <input type="text" name="city_dist_town" id="city_dist_town" class="form-control only_character validate[required]" data-errormessage-value-missing="City/District/Town is required" data-prompt-position="bottomLeft" maxlength="200"value="'.$address_row->city_dist_town.'">
		                </div>
		              </div>
		              <div class="col-lg-6">
		                <div class="form-group">
		                  <label>Landmark:</label>
		                  <input type="text" name="landmark" id="landmark" class="form-control validate[required]" data-errormessage-value-missing="Landmark is required" data-prompt-position="bottomLeft"maxlength="200"value="'.$address_row->landmark.'">
		                </div>
		              </div>
		              <div class="col-lg-6">
		                <div class="form-group">
		                <label>Alternative Mobile No:</label>
		                <input type="text" name="alternative_mob_no" id="alternative_mob_no" class="form-control only_integer minSize[10],maxSize[10]"value="'.$address_row->alternative_mob_no.'">
		                </div>
		              </div>
		               <div class="col-lg-6">
		                <div class="form-group">
		                  <label>Address Type:</label>';
		                  if($address_row->address_type=='home'){
		                 echo '
		                 	<input type="radio" id="add_home1" name="address_type"  value="home" checked>
		                	<label for="add_home1">Home</label>
		                    <input type="radio" id="add_work1" name="address_type" value="work" checked>
		                    <label for="add_work1">Work</label>';
		              }else{
		                  echo'
		                  <input type="radio" id="add_home1" name="address_type"  value="home">
		                	<label for="add_home1">Home</label>
		                  <input type="radio" id="add_work1" name="address_type" value="work" checked>
		                  <label for="add_work1">Work</label>';
		                }
		                echo'</div>
		              </div>
		              <div class="col-lg-12">
		                <div class="form-group">
		                  <label for="comment">Address:</label>
		                  <textarea class="form-control" rows="5" id="address_details" name="address_details">'.$address_row->address_details.'</textarea>
		                </div>
		              </div>
		            </div>
		            <div class="text-right">
		            <input type="submit" class="btn btn-primary disabled_banner" value="Save">
		            </div>
          </form>
		    <script>
			$(function () {
			$("#address-edit").validationEngine();
			});

			
			</script>';

	}
	public function updateAddress()
	{
		if($_POST)
		{
			extract($_POST);
			$data=array(
				'name' => $name,
				'mobile_no' => $mobile_no,
				'state' => $state,
				'city_dist_town' => $city_dist_town,
				'pin_code' => $pin_code,
				'locality' => $locality,
				'address_details' => $address_details,
				'landmark' => $landmark,
				'alternative_mob_no' => $alternative_mob_no,
				'address_type' => $address_type,
				'datetime' => date('Y-m-d H:i:s;)
			);
			$where=array('uniqcode'=>$uniqcode);
			
			if($this->Address_Model->update('tbl_users_delivery_address',$where,$data))
			{
				$this->session->set_flashdata('success', 'Address update successfully.');	
				redirect('profile');
			}
			else
			{
				$this->session->set_flashdata('error', 'Address do not update successfully.');	
				redirect('profile');
			}
			
			
		}
	}  

	public function addAddressOrder()
	{
		if($_POST)
		{
			extract($_POST);

			$data1=array(
			'select_address'=>'0',

			);

			$check = $this->Address_Model->entty_check(['user_id'=>$this->session->userdata('loginDetail')->uniqcode,'status'=>'Active'],'tbl_users_delivery_address');

			if($check)
			{

				$update = $this->Address_Model->update('tbl_users_delivery_address',['user_id'=>$this->session->userdata('loginDetail')->uniqcode],$data1);
			}
			$data=array(
				'uniqcode' => random_string('alnum',20),
				'user_id'=>$this->session->userdata('loginDetail')->uniqcode,
				'name' => $name,
				'mobile_no' => $mobile_no,
				'state' => $state,
				'city_dist_town' => $city_dist_town,
				'pin_code' => $pin_code,
				'locality' => $locality,
				'address_details' => $address_details,
				'landmark' => $landmark,
				'alternative_mob_no' => $alternative_mob_no,
				'address_type' => $address_type,
				'datetime' => date('Y-m-d H:i:s;)
			);
			$this->Address_Model->insert($data,'tbl_users_delivery_address');
			$this->session->set_flashdata('success', 'Address added successfully.');	
			redirect('address');
			
		}
	}

	public function buyAddAddressOrder()
	{
		if($_POST)
		{
			extract($_POST);

			$data1=array(
			'select_address'=>'0',

			);

			$check = $this->Address_Model->entty_check(['user_id'=>$this->session->userdata('loginDetail')->uniqcode,'status'=>'Active'],'tbl_users_delivery_address');

			if($check)
			{

				$update = $this->Address_Model->update('tbl_users_delivery_address',['user_id'=>$this->session->userdata('loginDetail')->uniqcode],$data1);
			}
			$data=array(
				'uniqcode' => random_string('alnum',20),
				'user_id'=>$this->session->userdata('loginDetail')->uniqcode,
				'name' => $name,
				'mobile_no' => $mobile_no,
				'state' => $state,
				'city_dist_town' => $city_dist_town,
				'pin_code' => $pin_code,
				'locality' => $locality,
				'address_details' => $address_details,
				'landmark' => $landmark,
				'alternative_mob_no' => $alternative_mob_no,
				'address_type' => $address_type,
				'datetime' => date('Y-m-d H:i:s;)
			);
			$this->Address_Model->insert($data,'tbl_users_delivery_address');
			$this->session->set_flashdata('success', 'Address added successfully.');	
			redirect('buy-address');
			
		}
	}

	public function editAddressOrder()
	{
		
		$uniqcode=$this->input->post('uniqcode');
		$this->db->where('status <>', 'Delete');
		$this->db->where('uniqcode', $uniqcode);
		$address_row=$this->db->get('tbl_users_delivery_address')->row();
        $all_state = $this->User_Model->all_state(['is_active'=>'Active'],'tbl_state_mast');
		
		echo '
          		<form role="form" id="address-edit" action="'.base_url('address-update-order').'" method="post" enctype="multipart/form-data">
          			<input type="hidden" name="uniqcode" value="'.$address_row->uniqcode.'">

		            <div class="row">
		            <!-- <input type="hidden" name="edit_data" id="edit_data"> -->
		              <div class="col-lg-6">
		                <div class="form-group">
		                  <label>Name:</label>
		                  <input type="text" name="name" id="name" class="form-control only_character validate[required,custom[fullname]]" data-errormessage-value-missing="Name is required" data-prompt-position="bottomLeft" maxlength="200" value="'.$address_row->name.'">
		                </div>
		              </div>
		              <div class="col-lg-6">
		                <div class="form-group">
		                  <label>Mobile Number:</label>
		                  <input type="text" name="mobile_no" id="mobile_no" class="form-control only_integer validate[required,custom[phone]]minSize[10],maxSize[10]" data-errormessage-value-missing="Phone number is required" data-prompt-position="bottomLeft" maxlength="10"
		                  		value="'.$address_row->mobile_no.'">
		                </div>
		              </div>
		              <div class="col-lg-6">
		                <div class="form-group">
		                  <label>Pin Code:</label>
		                  <input type="text" name="pin_code" id="pin_code" class="form-control only_integer validate[required]" data-errormessage-value-missing="Pin code is required" data-prompt-position="bottomLeft"  maxlength="200"
		                  	value="'.$address_row->pin_code.'">
		                </div>
		              </div>
		              <div class="col-lg-6">
		                <div class="form-group">
		                  <label>Locality:</label>
		                  <input type="text" name="locality" id="locality" class="form-control form-control validate[required]" data-errormessage-value-missing="Locality  is required" data-prompt-position="bottomLeft" maxlength="200"value="'.$address_row->locality.'">
		                </div>
		              </div>
		              <div class="col-lg-6">
		                <div class="form-group">
		                  <label>State:</label>
		                   <select id="state" name="state" class="form-control validate[required]" data-errormessage-value-missing="State is required" data-prompt-position="bottomLeft">';
		        
		                    foreach($all_state as $all_state_row)
		                    {
		                    	if($address_row->state==$all_state_row->id)
		                    	{
		                        	echo '<option value="'.$all_state_row->id.'" selected>'.$all_state_row->name.'</option>';
		                        	
		                        }
		                        else
		                        {
		                        	echo '<option value="'.$all_state_row->id.'">'.$all_state_row->name.'</option>';
		                        }
		                    }
		                    echo '</select>
		                </div>
		              </div>

		              
		              <div class="col-lg-6">
		                <div class="form-group">
		                  <label>City/District/Town:</label>
		                   <input type="text" name="city_dist_town" id="city_dist_town" class="form-control only_character validate[required]" data-errormessage-value-missing="City/District/Town is required" data-prompt-position="bottomLeft" maxlength="200"value="'.$address_row->city_dist_town.'">
		                </div>
		              </div>
		              <div class="col-lg-6">
		                <div class="form-group">
		                  <label>Landmark:</label>
		                  <input type="text" name="landmark" id="landmark" class="form-control validate[required]" data-errormessage-value-missing="Landmark is required" data-prompt-position="bottomLeft"maxlength="200"value="'.$address_row->landmark.'">
		                </div>
		              </div>
		              <div class="col-lg-6">
		                <div class="form-group">
		                <label>Alternative Mobile No:</label>
		                <input type="text" name="alternative_mob_no" id="alternative_mob_no" class="form-control only_integer minSize[10],maxSize[10]"value="'.$address_row->alternative_mob_no.'">
		                </div>
		              </div>
		               <div class="col-lg-6">
		                <div class="form-group">
		                  <label>Address Type:</label>';
		                  if($address_row->address_type=='home'){
		                 echo '
		                 	<input type="radio" id="add_home1" name="address_type"  value="home" checked>
		                	<label for="add_home1">Home</label>
		                    <input type="radio" id="add_work1" name="address_type" value="work" checked>
		                    <label for="add_work1">Work</label>';
		              }else{
		                  echo'
		                  <input type="radio" id="add_home1" name="address_type"  value="home">
		                	<label for="add_home1">Home</label>
		                  <input type="radio" id="add_work1" name="address_type" value="work" checked>
		                  <label for="add_work1">Work</label>';
		                }
		                echo'</div>
		              </div>
		              <div class="col-lg-12">
		                <div class="form-group">
		                  <label for="comment">Address:</label>
		                  <textarea class="form-control" rows="5" id="address_details" name="address_details">'.$address_row->address_details.'</textarea>
		                </div>
		              </div>
		            </div>
		            <div class="text-right">
		            <input type="submit" class="btn btn-primary disabled_banner" value="Save">
		            </div>
          </form>
		    <script>
			$(function () {
			$("#address-edit").validationEngine();
			});

			
			</script>';

	}

	public function buyEditAddressOrder()
	{
		$uniqcode=$this->input->post('uniqcode');
		$this->db->where('status <>', 'Delete');
		$this->db->where('uniqcode', $uniqcode);
		$address_row=$this->db->get('tbl_users_delivery_address')->row();
        $all_state = $this->User_Model->all_state(['is_active'=>'Active'],'tbl_state_mast');
		
		echo '
          		<form role="form" id="address-edit" action="'.base_url('buy-address-update-order').'" method="post" enctype="multipart/form-data">
          			<input type="hidden" name="uniqcode" value="'.$address_row->uniqcode.'">

		            <div class="row">
		            <!-- <input type="hidden" name="edit_data" id="edit_data"> -->
		              <div class="col-lg-6">
		                <div class="form-group">
		                  <label>Name:</label>
		                  <input type="text" name="name" id="name" class="form-control only_character validate[required,custom[fullname]]" data-errormessage-value-missing="Name is required" data-prompt-position="bottomLeft" maxlength="200" value="'.$address_row->name.'">
		                </div>
		              </div>
		              <div class="col-lg-6">
		                <div class="form-group">
		                  <label>Mobile Number:</label>
		                  <input type="text" name="mobile_no" id="mobile_no" class="form-control only_integer validate[required,custom[phone]]minSize[10],maxSize[10]" data-errormessage-value-missing="Phone number is required" data-prompt-position="bottomLeft" maxlength="10"
		                  		value="'.$address_row->mobile_no.'">
		                </div>
		              </div>
		              <div class="col-lg-6">
		                <div class="form-group">
		                  <label>Pin Code:</label>
		                  <input type="text" name="pin_code" id="pin_code" class="form-control only_integer validate[required]" data-errormessage-value-missing="Pin code is required" data-prompt-position="bottomLeft"  maxlength="200"
		                  	value="'.$address_row->pin_code.'">
		                </div>
		              </div>
		              <div class="col-lg-6">
		                <div class="form-group">
		                  <label>Locality:</label>
		                  <input type="text" name="locality" id="locality" class="form-control form-control validate[required]" data-errormessage-value-missing="Locality  is required" data-prompt-position="bottomLeft" maxlength="200"value="'.$address_row->locality.'">
		                </div>
		              </div>
		              <div class="col-lg-6">
		                <div class="form-group">
		                  <label>State:</label>
		                   <select id="state" name="state" class="form-control validate[required]" data-errormessage-value-missing="State is required" data-prompt-position="bottomLeft">';
		        
		                    foreach($all_state as $all_state_row)
		                    {
		                    	if($address_row->state==$all_state_row->id)
		                    	{
		                        	echo '<option value="'.$all_state_row->id.'" selected>'.$all_state_row->name.'</option>';
		                        	
		                        }
		                        else
		                        {
		                        	echo '<option value="'.$all_state_row->id.'">'.$all_state_row->name.'</option>';
		                        }
		                    }
		                    echo '</select>
		                </div>
		              </div>

		              
		              <div class="col-lg-6">
		                <div class="form-group">
		                  <label>City/District/Town:</label>
		                   <input type="text" name="city_dist_town" id="city_dist_town" class="form-control only_character validate[required]" data-errormessage-value-missing="City/District/Town is required" data-prompt-position="bottomLeft" maxlength="200"value="'.$address_row->city_dist_town.'">
		                </div>
		              </div>
		              <div class="col-lg-6">
		                <div class="form-group">
		                  <label>Landmark:</label>
		                  <input type="text" name="landmark" id="landmark" class="form-control validate[required]" data-errormessage-value-missing="Landmark is required" data-prompt-position="bottomLeft"maxlength="200"value="'.$address_row->landmark.'">
		                </div>
		              </div>
		              <div class="col-lg-6">
		                <div class="form-group">
		                <label>Alternative Mobile No:</label>
		                <input type="text" name="alternative_mob_no" id="alternative_mob_no" class="form-control only_integer minSize[10],maxSize[10]"value="'.$address_row->alternative_mob_no.'">
		                </div>
		              </div>
		               <div class="col-lg-6">
		                <div class="form-group">
		                  <label>Address Type:</label>';
		                  if($address_row->address_type=='home'){
		                 echo '
		                 	<input type="radio" id="add_home1" name="address_type"  value="home" checked>
		                	<label for="add_home1">Home</label>
		                    <input type="radio" id="add_work1" name="address_type" value="work" checked>
		                    <label for="add_work1">Work</label>';
		              }else{
		                  echo'
		                  <input type="radio" id="add_home1" name="address_type"  value="home">
		                	<label for="add_home1">Home</label>
		                  <input type="radio" id="add_work1" name="address_type" value="work" checked>
		                  <label for="add_work1">Work</label>';
		                }
		                echo'</div>
		              </div>
		              <div class="col-lg-12">
		                <div class="form-group">
		                  <label for="comment">Address:</label>
		                  <textarea class="form-control" rows="5" id="address_details" name="address_details">'.$address_row->address_details.'</textarea>
		                </div>
		              </div>
		            </div>
		            <div class="text-right">
		            <input type="submit" class="btn btn-primary disabled_banner" value="Save">
		            </div>
          </form>
		    <script>
			$(function () {
			$("#address-edit").validationEngine();
			});

			
			</script>';
	}

	public function updateAddressOrder()
	{
		if($_POST)
		{
			extract($_POST);
			$data=array(
				'name' => $name,
				'mobile_no' => $mobile_no,
				'state' => $state,
				'city_dist_town' => $city_dist_town,
				'pin_code' => $pin_code,
				'locality' => $locality,
				'address_details' => $address_details,
				'landmark' => $landmark,
				'alternative_mob_no' => $alternative_mob_no,
				'address_type' => $address_type,
				'datetime' => date('Y-m-d H:i:s;)
			);
			$where=array('uniqcode'=>$uniqcode);
			
			if($this->Address_Model->update('tbl_users_delivery_address',$where,$data))
			{
				$this->session->set_flashdata('success', 'Address update successfully.');	
				redirect('address');
			}
			else
			{
				$this->session->set_flashdata('error', 'Address do not update successfully.');	
				redirect('address');
			}
			
			
		}

	} 

	public function buyUpdateAddressOrder()
	{
		if($_POST)
		{
			extract($_POST);
			$data=array(
				'name' => $name,
				'mobile_no' => $mobile_no,
				'state' => $state,
				'city_dist_town' => $city_dist_town,
				'pin_code' => $pin_code,
				'locality' => $locality,
				'address_details' => $address_details,
				'landmark' => $landmark,
				'alternative_mob_no' => $alternative_mob_no,
				'address_type' => $address_type,
				'datetime' => date('Y-m-d H:i:s;)
			);
			$where=array('uniqcode'=>$uniqcode);
			
			if($this->Address_Model->update('tbl_users_delivery_address',$where,$data))
			{
				$this->session->set_flashdata('success', 'Address update successfully.');	
				redirect('buy-address');
			}
			else
			{
				$this->session->set_flashdata('error', 'Address do not update successfully.');	
				redirect('buy-address');
			}
			
			
		}

	} 

	public function addressDestroyOrder($uniqcode)
	{
		$this->db->where('status','Delete');
		$this->db->where('uniqcode', $uniqcode);
		$address_row=$this->db->get('tbl_users_delivery_address')->row();
		
		if(empty($address_row))
		{
			$data=array(
				'status'=> 'Delete',
				'datetime' => date('Y-m-d H:i:s;)
				);
			$this->db->where('uniqcode', $uniqcode);
			$update=$this->db->update('tbl_users_delivery_address', $data);
			// print_r($data);
			// die;
			$this->session->set_flashdata('success', 'Address deleted successfully.');	
			redirect('address');
		}
		else
		{
			$this->session->set_flashdata('error', 'Address do not deleted successfully');                     
	 		redirect('address');
		}	
	}

	public function BuyAddressDestroyOrder($uniqcode)
	{
		$this->db->where('status','Delete');
		$this->db->where('uniqcode', $uniqcode);
		$address_row=$this->db->get('tbl_users_delivery_address')->row();
		
		if(empty($address_row))
		{
			$data=array(
				'status'=> 'Delete',
				'datetime' => date('Y-m-d H:i:s;)
				);
			$this->db->where('uniqcode', $uniqcode);
			$update=$this->db->update('tbl_users_delivery_address', $data);
			// print_r($data);
			// die;
			$this->session->set_flashdata('success', 'Address deleted successfully.');	
			redirect('buy-address');
		}
		else
		{
			$this->session->set_flashdata('error', 'Address do not deleted successfully');                     
	 		redirect('buy-address');
		}	
	}
}
    