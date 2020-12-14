     <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller 
{ 
	function __construct()
	{
	  	parent::__construct(); 	
        $this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");   
        date_default_timezone_set('Asia/Kolkata');	
		$this->load->helper(array('common_helper', 'string', 'form', 'security','url'));
		$this->load->library(array('form_validation', 'email'));
		$this->load->model('user/User_Model');	
        $this->load->model('home/Home_Model');
        $this->load->model('address/Address_Model'); 
        $this->load->model('order/Order_Model'); 
        // if(($this->session->userdata('loginDetail')==NULL)){
        //    redirect('');
        // }  
	} 
    
	public function index()
	{
		$this->data['page_title']='Bongbazaar | Cart';
		$this->data['subview']='cart/cart';
		$this->data['allCartData']=$this->Cart_Model->select_all(['status'=>'1'],'tbl_cart');
		$this->load->view('user/layout/default', $this->data);
	}

	public function UserRegister()
    {
        
    	$mobile_no=$this->input->post('mobile_no');
        if(!empty($mobile_no))
        {   
            $count=$this->User_Model->entty_check(['mobile_no'=>$mobile_no,'status'=>'Active'],'tbl_users');
            if(!$count)
            {
                $otp=random_string('numeric',4);
                $this->session->set_userdata('otp',$otp);
                $message=$otp." is your Bongbasar OTP. Don't share this with anyone. Thank you.- Bongbasar";
                send_sms($mobile_no,$message); 
                echo '<div class="col-md-12 modal-form-underpart">                
                <form role="form" id="register-step"  method="post">
                        <div class="form-group">
                            <label for="mobile_no">Phone no:</label>
                            <input type="text" class="form-control validate[required]" id="mobile_no" placeholder="Enter phone no" name="mobile_no" data-errormessage-value-missing="phone is required" data-prompt-position="bottomLeft" maxlength="200" value="'.$mobile_no.'"disabled>
                        </div>
                        <div class="form-group">
                            <label for="password1">Password:</label>
                            <input type="password" class="form-control validate[required]" id="password1" placeholder="Enter password" name="password1" data-errormessage-value-missing="password is required" data-prompt-position="bottomLeft" maxlength="200">
                        </div>
                        <div class="form-group">
                            <label for="otp">OTP</label>
                            <input type="text" class="form-control validate[required]" id="otp" placeholder="Enter otp no" name="otp" data-errormessage-value-missing="OTP is required" data-prompt-position="bottomLeft" maxlength="200">
                        </div>
                        <span class="reg-step-error" style="color: red"></span>
                        <button type="submit" class="btn btn-block submit-btn hvr-bounce-to-right hvr-icon-pulse-grow">
                            Sign Up
                            <i class="fa fa-sign-in hvr-icon" aria-hidden="true"></i>
                        </button>
                        
                    </form>
                </div>                       
                <script>
                    $(function () {                
                        $("#register-step").validationEngine();
                    });
                    $("#register-step").on("submit", function (e) 
                    {
                        if($("#password1").val() != "" && $("#otp").val() != "")
                        {  
                            $(".reg-step-error").hide();
                            var base_url=$("#base_url").val();
                            var mobile_no=$("#mobile_no").val();
                            var otp=$("#otp").val();
                            e.preventDefault();
                            $.ajax({
                            type: "post",
                            dataType: "json",
                            url:base_url+"register-step",
                            data: {mobile_no:mobile_no,otp:otp},
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
                        }
                    
                    });
                </script>'
                ;
            }
            else
            {
                echo '4';
            }
        }
        else
        {
            echo '2';     
        }   
    }

    public function UserRegisterStep()
    {

    	$mobile_no= $this->input->post('mobile_no');
        $otp= $this->input->post('otp');
        $password=md5($this->security->xss_clean($this->input->post('password1')));
        if(!empty($otp) &&  !empty($password))
        {
            if($this->session->userdata('otp')==$otp)
            {
                $count=$this->User_Model->entty_check(['mobile_no'=>$mobile_no,'status'=>'Active'],'tbl_users');
                if(!$count)
                {
                    $data=array(
                        'uniqcode'=>"ur".random_string('alnum',28),
                        'mobile_no'=>$mobile_no,
                        'otp'=>$otp,
                        'status'=>'Active',
                        'datetime'=>date('Y-m-d h:i:s')
                    );
                    if($this->User_Model->insert($data,'tbl_users'))
                    {
                        $message="Congrats! You have successfully registered with Bongbasar from your mobile no. ".$mobile_no.". SHOPPING KI SOCH BADLO BONGBASAR KE SATH -Bongbasar";
                        send_sms($mobile_no,$message);
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
                    echo json_encode(['result'=>4]);            
                }
                
            }
            else
            {
                echo json_encode(['result'=>3]);            
            }
        }
        else
        {
            echo json_encode(['result'=>'']);            
        }

    }

    public function forgot()
    {
        $str=$this->input->post('user_id');

        if(strpos($str,'@'))
        {
            $count=$this->User_Model->entty_check(['email'=>$str,'status'=>'Active'],'tbl_users');
            if($count)
            {
                $otp=random_string('numeric',4);
                $Data['otp']=$otp;
                $config = Array(
                    'protocol' => 'smtp',
                    'mailtype' => 'html',
                    'charset' => 'utf-8',
                    'wordwrap' => TRUE
                );
                $this->load->library('email', $config);
                $from='developer.bongtechsolution@gmail.com';
                $from_name='Bongbasar';
                $to_email= $str;
                $subject='Forget Password ';
                $message=$otp." is your Bongbasar OTP. Don't share this with anyone. Thank you.- Bongbasar";
               // send_sms($str,$message);
                email_send();
                $this->email->from($from, $from_name);
			    $this->email->to($to_email);
			    $this->email->subject($subject);
			    $this->email->message($message);
			    $send=$this->email->send();
                $this->User_Model->update('tbl_users',['email'=>$str],['otp'=>$otp]);
                echo json_encode(['user_id'=>$str,'message'=>"success"]);
            }
            else
            {
                echo json_encode(['message'=>"error"]);
            }
        }
        else
        {
            $count=$this->User_Model->entty_check(['mobile_no'=>$str,'status'=>'Active'],'tbl_users');
            if($count)
            {
                $otp=random_string('numeric',4);
                $Data['otp']=$otp;
                //insert user data
                $message=$otp." is your Bongbasar OTP. Don't share this with anyone. Thank you.- Bongbasar";
               // send_sms($str,$message);
                $this->User_Model->update('tbl_users',['mobile_no'=>$str],['otp'=>$otp]);
                echo json_encode(['user_id'=>$str,'message'=>"success"]);
            }
            else
            {
                echo json_encode(['message'=>"error"]);
            }   
        }
    }

    public function forgotVerify()
    {
        $user_id=$this->input->post('user_id');
        $otp=$this->input->post('otp');
        $password=$this->input->post('password');
        $fv=$this->User_Model->update_password('tbl_users',$user_id,md5($password));
        if($fv==1)
        {
            $this->session->set_flashdata('success', 'Your Password updated successfully');
        }
        else
        {
            $this->session->set_flashdata('error', 'Your Password updated unsuccessfully');
        }

    }

    public function profile()
    {
        $this->data['page_title']='Bongbazaar | profile';
        //$this->data['menu_lebel'] = $this->Home_Model->get_categories();
        $this->data['user_profile'] = $this->User_Model->selectrow(['uniqcode'=>$this->session->userdata('loginDetail')->uniqcode],'tbl_users');
        $this->data['user_address'] = $this->Address_Model->user_address($this->session->userdata('loginDetail')->uniqcode,'tbl_users_delivery_address');
        $this->data['user_order'] = $this->Order_Model->user_orders($this->session->userdata('loginDetail')->uniqcode);
        //pr($this->data['user_order']);
        $this->data['user_wishlist'] = $this->User_Model->user_wishlist($this->session->userdata('loginDetail')->uniqcode);
         //pr($this->data['user_wishlist']);
        $this->data['all_state'] = $this->User_Model->all_state(['is_active'=>'Active','country_id'=>'101'],'tbl_state_mast');
        //pr($this->data);

   
        $this->data['subview']='profile/profile';
        $this->load->view('user/layout/default', $this->data);
    }

    public function ProfileUpdate()
    {
        //pr($this->input->post());
        $uniqcode=$this->input->post('uniqcode');
        $first_name=$this->input->post('first_name');
        $last_name=$this->input->post('last_name');
        $old_first_name=$this->input->post('old_first_name');
        $old_last_name=$this->input->post('old_last_name');
        $gender=$this->input->post('gender');
        $mobile_no=$this->input->post('mobile_no');
        $email=$this->input->post('email');

        $row=$this->User_Model->selectrow(['uniqcode'=>$uniqcode],'tbl_users');
        if(!empty($row))
        {
            $data=array();
            if(!empty($first_name))
            {
                $data['name']=$first_name.'##'.$old_last_name; 
            }
            if(!empty($last_name))
            {
                $data['name']=$old_first_name.'##'.$last_name;
            }
            if(!empty($first_name) && !empty($last_name))
            {
                $data['name']=$first_name.'##'.$last_name;
            }
           
            if(!empty($email))
            {
                $data['email']=$email;
            }
            if(!empty($gender))
            {
                $data['gender']=$gender;
            }
           
            $condition=array(
                'uniqcode'=>$uniqcode,
            );
            $this->User_Model->update('tbl_users',$condition,$data);
            $this->session->set_flashdata('success', 'Your profile updated successfully');
            redirect('profile');
        }
        else
        {
            $this->session->set_flashdata('error', 'Your profile do not update successfully');
            redirect('profile');
        }
     
    }

    public function ProfilePictureUpdate()
    {
        if(!empty($_FILES['image']['name']))
        {
           $uniqcode=$this->input->post('uniqcode');
            $config['upload_path']          = FCPATH.'/webroot/user/images/';
            $config['allowed_types']        = '*';
            $config['encrypt_name']         = TRUE;
            $config['max_size']             = 1024;
            $config['file_name']            = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image'))
            {
                $image_data = $this->upload->data();
                $config['image_library'] = 'gd2';
                $config['source_image'] = $image_data['full_path'];
                $config['create_thumb'] = TRUE;
                $config['maintain_ratio'] = TRUE;
                $config['new_image'] = 'webroot/user/profile/web/'.$image_data['file_name'];
                $config['width'] = 500;
                $config['height'] = 400;
                $this->load->library('image_lib', $config);
                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                $category_upload_image=$image_data['raw_name'].'_thumb'.$image_data['file_ext'];
                if (!$this->image_lib->resize())
                {
                    $this->handle_error($this->image_lib->display_errors());
                }

                $config['image_library'] = 'gd2';
                $config['source_image'] = $image_data['full_path'];
                $config['create_thumb'] = TRUE;
                $config['maintain_ratio'] = TRUE;
                $config['new_image'] = 'webroot/user/profile/mobile/'.$image_data['file_name'];
                $config['width'] = 300;
                $config['height'] = 200;
                $this->load->library('image_lib', $config);
                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                $category_upload_image=$image_data['raw_name'].'_thumb'.$image_data['file_ext'];
                if (!$this->image_lib->resize())
                {
                $this->handle_error($this->image_lib->display_errors());
                }
                $old_image=$this->input->post('old_image');
                $file = FCPATH.'/webroot/user/profile/web/'.$old_image;
                if(file_exists($file))
                {
                    unlink($file);
                }
                $file = FCPATH.'/webroot/user/profile/mobile/'.$old_image;
                if(file_exists($file))
                {
                    unlink($file);
                }
                $file = FCPATH.'/webroot/user/images/'.$image_data['file_name'];
                if(file_exists($file))
                {
                    unlink($file);
                }
                if(!empty($category_upload_image))
                {
                    $data['image']=$category_upload_image;
                }
               
                $condition=array(
                    'uniqcode'=>$uniqcode,
                );
                $this->User_Model->update('tbl_users',$condition,$data);
                $this->session->set_flashdata('success', 'Your profile image updated successfully');
                redirect('profile');
            }
        }
        else
        {
            $this->session->set_flashdata('error', 'File can not be empty!');
            redirect('profile');
        }
    }

    public function wishlist()
    {
       
        if(($this->session->userdata('loginDetail')!=''))
        {
            $spid=$this->input->post('pf_id');
            $sp=explode("_",$spid);
            $product_id=$sp[0];
            $product_features_id=$sp[1];
            $user_id=$this->session->userdata('loginDetail')->uniqcode;
            $where=array(
                'status<>'=>'Delete',
                'product_id'=>$product_id,
                'product_features_id'=>$product_features_id,
                'user_id'=>$user_id
            );

            $count=$this->User_Model->entty_check($where,'tbl_wishlist');

            if($count==0)
            {
                $post=array(
                    'uniqcode'=>'wl'.randomPassword(28),
                    'product_id'=>$product_id,
                    'user_id'=>$user_id,
                    'product_features_id'=>$product_features_id,
                    'notification'=>'',
                    'datetime'=>date('Y-m-d h:i:s')
                );
                //pr($post);
                if($this->User_Model->insert($post,'tbl_wishlist'))
                {
                    $this->session->set_flashdata('success', 'Add to your wishlist.'); 
                    echo json_encode(['result'=>1]);  
                    return false;  
                }   
            }
            else
            {
                $where1=array(
                    'product_id'=>$product_id,
                    'user_id'=>$user_id,
                    'product_features_id'=>$product_features_id
                );
                $this->db->where($where1);
                $this->db->delete('tbl_wishlist');
                $this->session->set_flashdata('success', 'Remove form your wishlist'); 
                echo json_encode(['result'=>1]);  
                return false; 
            }
        }
        else
        {
            echo json_encode(['result'=>0]);  
            return false;
        } 
    }

    public function notifications()
    {
           
    }
    public function otp_check()
    {
        $user_id=$this->input->post('userid');
        $otp=$this->input->post('otp');
        $result=$this->User_Model->checkOtp($user_id,$otp);
        echo $result;
    }
}
    