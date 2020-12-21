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
                echo json_encode(['mobile_no'=>$mobile_no,'msg'=>'1']);
            }
            else
            {
                echo json_encode(['msg'=>'4']);
            }
        }
        else
        {
           echo json_encode(['msg'=>'2']);
        }   
    }

    public function UserRegisterStep()
    {

    	$mobile_no= $this->input->post('reg_mobile_no');
        $otp= $this->input->post('rotp');
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
                        'password'=>$password,
                        'status'=>'Active',
                        'datetime'=>date('Y-m-d H:i:s')
                    );
                    if($this->User_Model->insert($data,'tbl_users'))
                    {
                        $wallet_data=array(
                            'uniqcode'=>"wt".random_string('alnum',28),
                            'user_id'=>$data['uniqcode'],
                            'wallet_amount'=>'200',
                            'status'=>'Active',
                            'datetime'=>date('Y-m-d H:i:s')
                        );
                        $tid='T'.rand(10,99).time();
                        $wallet_transaction=array(
                            'user_id'=>$data['uniqcode'],
                            'transaction_id'=>$tid,
                            'description'=>'Added to wallet from Bongbasar. Transaction ID: '.$tid.'',
                            'credit_amount'=>'200',
                            'datetime'=>date('Y-m-d H:i:s')
                        );
                        $this->User_Model->insert($wallet_data,'tbl_wallet_details');
                        $this->User_Model->insert($wallet_transaction,'tbl_wallet_transaction');
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
                $this->session->set_userdata('otp',$otp);
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
                //insert user data
                $message=$otp." is your Bongbasar OTP. Don't share this with anyone. Thank you.- Bongbasar";
                send_sms($str,$message);
                $this->session->set_userdata('otp',$otp);
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
        $this->data['menu_lebel'] = $this->Home_Model->get_categories();
        $this->data['user_profile'] = $this->User_Model->selectrow(['uniqcode'=>$this->session->userdata('loginDetail')->uniqcode],'tbl_users');
        $this->data['user_address'] = $this->Address_Model->user_address($this->session->userdata('loginDetail')->uniqcode,'tbl_users_delivery_address');
        $this->data['user_order'] = $this->Order_Model->user_orders($this->session->userdata('loginDetail')->uniqcode);
        $this->data['user_wallet'] = $this->User_Model->user_wallet($this->session->userdata('loginDetail')->uniqcode);
        $this->data['user_wishlist'] = $this->User_Model->user_wishlist($this->session->userdata('loginDetail')->uniqcode);
        $this->data['all_state'] = $this->User_Model->all_state(['is_active'=>'Active','country_id'=>'101'],'tbl_state_mast');
        //pr($this->data);
        $this->data['subview']='profile/profile';
        $this->load->view('user/layout/default', $this->data);
    }

    public function ProfileUpdate()
    {
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
                    'datetime'=>date('Y-m-d H:i:s')
                );
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
        $chack_otp=$this->session->userdata('otp');
       
        if($otp==$chack_otp)
        {
            echo 1;
        }
        else
        {
            echo 0;
        }
    }

    public function review_add()
    {
        $rating=$this->input->post('rating');
        $review=$this->input->post('review');
        $order_uniqcode=$this->input->post('order_uniqcode');
        $image=array();
        
        for($i=1;$i<=5;$i++)
        {   $count=0;
            if(!empty($_FILES['file'.$i.'']['name']))
            {
                $config['upload_path']          = FCPATH.'/webroot/user/review_images/';
                $config['allowed_types']        = '*';
                $config['encrypt_name']         = TRUE;
                $config['file_name']            = $_FILES['file'.$i]['name'];
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('file'.$i.''))
                {
                    $image_data = $this->upload->data();
                    $image[$count]=$image_data['file_name'];
                    $count++;

                }
                else
                {
                    echo $this->upload->display_errors();
                   
                }
            }
        }
        $post=array(
            'uniqcode'=>'rr'.randomPassword(28),
            'order_id'=>$order_uniqcode,
            'image'=>serialize($image),
            'rating'=>$rating,
            'review'=>$review,
            'status'=>'Inactive',
            'datetime'=>date('Y-m-d H:i:s')
        );  
        if($this->User_Model->insert($post,'tbl_review'))
        {
            $this->session->set_flashdata('success', 'Thank you so much. Your review has been saved.');
            echo json_encode(['result'=>1]);
            return false;
        }
    }

    public function review_edit()
    {
        $order_uniqcode=$this->input->post('uniqcode');
        $this->db->select('uniqcode,image,rating,review');
        $this->db->from('tbl_review');
        $this->db->where('order_id',$order_uniqcode);
        $rating_row=$this->db->get()->row();
        $rating_image=unserialize($rating_row->image);
        $image_count=count($rating_image);
        echo '
       
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-2">
                <div class="product-img" id="rating_img_show_update">
                
                </div>
              </div>
              <div class="col-md-10">
                <div class="product-details">
                  <p class="product-title" id="rating_product_name_update"></p>
        
                  <div class="star">
                    <div class="star__item1';
                    if($rating_row->rating>=1 )
                    {
                        echo " star__item_select";
                    }
                    echo'" onclick="order_rating(1)"><i class="fa fa-star emoji--happy" aria-hidden="true"></i></div>
                    <div class="star__item1';
                    if($rating_row->rating>=2)
                    {
                        echo " star__item_select";
                    }
                    echo'" onclick="order_rating(2)"><i class="fa fa-star emoji--sad" aria-hidden="true"></i></div>
                    <div class="star__item1';
                    if($rating_row->rating>=3)
                    {
                        echo " star__item_select";
                    }
                    echo'" onclick="order_rating(3)"><i class="fa fa-star emoji--crying" aria-hidden="true"></i></div>
                    <div class="star__item1';
                    if($rating_row->rating>=4)
                    {
                        echo " star__item_select";
                    }
                    echo'" onclick="order_rating(4)"><i class="fa fa-star emoji--grimacing" aria-hidden="true"></i></div>
                    <div class="star__item1';
                    if($rating_row->rating==5)
                    {
                        echo " star__item_select";
                    }
                    echo'" onclick="order_rating(5)"><i class="fa fa-star emoji--love" aria-hidden="true"></i></div>
                    <input type="hidden" id="order_rating" value="'.$rating_row->rating.'">
                    <input type="hidden" id="order_uniqcode_update" value="">
                    
                  </div>
                </div>
              </div>
            </div>
            <p class="review-heading">Review this product</p>
            <div class="form-group">
              <textarea id="update_review" name="update_review" rows="4">'.$rating_row->review.'</textarea>
            </div>
            <form enctype="multipart/form-data" id="update_imageform" name="update_imageform">
            <div class="review-img-contaner">';
            
              for($x=0; $x<5; $x++)
              {
                if($x<$image_count)
                {
                echo '<span class="writeReview-gallery">
                <div tabindex="0" style="outline: none;">
                
                <img src="'.base_url('webroot/user/review_images/'.$rating_image[$x]).'" id="upload_photo_'.($x+6).'" onclick="get_upload_photo1('.($x+6).')" style="cursor: pointer; object-fit: contain; width="60px" height="60px" class="add_img_button">
                <input type="file" name="item_image_upload_'.($x+6).'" class="showTableImage image-upload selected_img" id="input_upload_'.($x+6).'" style="display: none" accept=".jpg,.jpeg,.png" onchange="show_photo1(this,'.($x+6).')">
                <input type="hidden" name="old_item_image_upload_'.($x+6).'" id="old_item_image_upload_'.($x+6).'" value="'.$rating_image[$x].'">  
            
                </div>
              </span>';
                }
                else
                {
                    echo '<span class="writeReview-gallery">
                        <div tabindex="0" style="outline: none;">
                        
                        <img src="'.base_url('webroot/user/images/Add-Photo-Button.png').'" id="upload_photo_'.($x+6).'" onclick="get_upload_photo1('.($x+6).')" style="cursor: pointer; object-fit: contain; width="60px" height="60px" class="add_img_button">
                        <input type="file" name="item_image_upload_'.($x+6).'" class="showTableImage image-upload selected_img" id="input_upload_'.($x+6).'" style="display: none" accept=".jpg,.jpeg,.png" onchange="show_photo1(this,'.($x+6).')">
                        <input type="hidden" name="old_item_image_upload_'.($x+6).'" id="old_item_image_upload_'.($x+6).'" value="">  
                        
                    
                        </div>
                    </span>';
                }
              }
              echo '
            
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn card-button-inner buy-btn save-btn" id="update_upload_img">
            <span>Submit</span>
          </button>
        </div>
        </form>
        <style>
            .star__item1 {
            color: rgb(255, 202, 117);
            margin: 2px;
            cursor: pointer;
            font-size: 30px;
            transform: scale(.5);
            text-shadow: 0 2px 4px rgba(0,0,0,.3);
            transition: 
              text-shadow .2s ease-in-out,
              transform .2s ease-in-out;
              font-size: 6rem;
            }
            .star__item1:hover {
                transform: scale(1) translatey(-20px);
                  text-shadow: 0 20px 20px rgba(0,0,0,.3);
            }
            .star__item1:hover .emoji--happy:before {
                content: "😡";
              }
              .star__item1:hover .emoji--sad:before {
                content: "😭";
              }
              .star__item1:hover .emoji--crying:before {
                content: "☹️";
              }
              .star__item1:hover .emoji--grimacing:before {
                content: "😁";
              }
              .star__item1:hover .emoji--love:before {
                content: "😍";
              }
          .star__item_select {
            color: rgb(255, 134, 0);
          }
      
          .star__item_active {
            /*color: rgb(255, 195, 48);*/
            color: rgb(255, 134, 0);
          }
        </style>
        <script>
            var stars = $(".star__item1");
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
        </script>
   
      
        ';
    }
    public function review_update()
    {
        $rating=$this->input->post('rating');
        $review=$this->input->post('review');
   
        $image=array();
        $order_uniqcode=$this->input->post('order_uniqcode');
        $old_image[6]=$this->input->post('old_item_image_upload_6');
        $old_image[7]=$this->input->post('old_item_image_upload_7');
        $old_image[8]=$this->input->post('old_item_image_upload_8');
        $old_image[9]=$this->input->post('old_item_image_upload_9');
        $old_image[10]=$this->input->post('old_item_image_upload_10');
        
        $count=0;
        $d="$";
        for($i=6;$i<=10;$i++)
        {
            if($_FILES['input_upload_'.$i])
            {
                $config['upload_path']          = FCPATH.'/webroot/user/review_images/';
                $config['allowed_types']        = '*';
                $config['encrypt_name']         = TRUE;
                $config['file_name']            = $_FILES['file'.$i]['name'];
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('input_upload_'.$i.''))
                {
                    $image_data = $this->upload->data();
                    $image[$count]=$image_data['file_name'];
                    $count++;


                }
                if($old_image[$i])
                {
                    $file = FCPATH.'/webroot/user/review_images/'.$old_image[$i];
                    if(file_exists($file))
                    {
                        unlink($file);
                    }
                }
            }
            else
            {
                if($old_image[$i])
                {
                    $image[$count]=$old_image[$i];
                    $count++;
                }

            }
        }
        $post=array(
            'image'=>serialize($image),
            'rating'=>$rating,
            'review'=>$review,
            'datetime'=>date('Y-m-d H:i:s')
        );  
      
        $where=array(
            'order_id'=>$order_uniqcode,
        );
        if($this->User_Model->update('tbl_review',$where,$post))
        {
            $this->session->set_flashdata('success', 'Thank you so much. Your review has been saved.');
            echo json_encode(['result'=>1]);
            return false;
        }

    }
    public function add_email()
    {
        $email=$this->input->post('email');
        $password=$this->input->post('password');
        $user_data=$this->session->userdata('loginDetail');
        $uniqcode=$this->session->userdata('loginDetail')->uniqcode;
        $where=array(
            'uniqcode'=>$uniqcode,
            'mobile_no'=>$this->session->userdata('loginDetail')->mobile_no,
            'password'=>md5($password)
        );
        $chack_password=$this->User_Model->entty_check($where,'tbl_users');
        if($chack_password)
        {
            $where=array(
                'uniqcode'=>$uniqcode 
            );
            $data=array(
                'email'=>$email
            );
            $update=$this->User_Model->update('tbl_users',$where,$data);
           
            if($update)
            {
                $new_user_data=array();
                foreach ($user_data as $key => $value) {
                if($key!='email')
                {
                    $new_user_data[$key]=$value;
                }
                else
                {
                    $new_user_data[$key]=$email;
                }
                
                }
                $this->session->unset_userdata('loginDetail');
                $this->session->set_userdata('loginDetail', (object)$new_user_data);
                $this->session->set_flashdata('success', 'Email Added successful');
                echo json_encode(['result'=>1]);
    
            }   
            else
            {
                $this->session->set_flashdata('error', 'Email Added Unsuccessful');
                echo json_encode(['result'=>0]);
            }
        }
        else
        {
            echo json_encode(['result'=>2]);
        }
        
        
        
    }
    
}
    