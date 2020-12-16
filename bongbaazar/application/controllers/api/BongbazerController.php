<?php
    if (!defined('BASEPATH')) exit('No direct script access allowed');

    //include Rest Controller library
    require APPPATH . '/libraries/REST_Controller.php';

    class BongbazerController extends REST_Controller 
    {

        public function __construct()
        {
            parent::__construct();
            $this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");   
            date_default_timezone_set('Asia/Kolkata');
            $this->load->helper(array('common_helper', 'string', 'form', 'security','url'));
            //load user model
            $this->load->model('api/Bongbazer_Model');
        }

        //Banner
        public function Banner_get()
        {
            $data = $this->Bongbazer_Model->banner_getRows('tbl_banner');            
            if(!empty($data))
            {
            //set the response and exit
            //OK (200) being the HTTP response code
                $this->response($data, REST_Controller::HTTP_OK);
            }
            else
            {
                //set the response and exit
                //NOT_FOUND (404) being the HTTP response code
                $this->response([[
                'status' => FALSE,
                'message' => 'No data were found.'
                ]], REST_Controller::HTTP_NOT_FOUND);
            }
        }
        
        //Category
        public function Category_get()
        {
            $data = $this->Bongbazer_Model->category_getRows('tbl_category');
            if(!empty($data))
            {

                $this->response($data, REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response([[
                'status' => FALSE,
                'message' => 'No data were found.'
                ]], REST_Controller::HTTP_NOT_FOUND);
            }
        }

        //Sub Category
        public function SubCategory_post()
        {
            $category_id= $this->post('category_id');
            if(!empty($category_id))
            {
            //insert user data
            $data = $this->Bongbazer_Model->subCategory_getRows($category_id);

            //check if the user data inserted
                if($data)
                {
                    $this->response($data, REST_Controller::HTTP_OK);
                }
                else
                {
                //set the response and exit
                    $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
                }
            }
            else
            {
                $this->response("Category category_id is blank.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }

        //Child Category
        public function ChildCategory_post()
        {
            $sub_category_id= $this->post('sub_category_id');

            if(!empty($sub_category_id))
            {
            //insert user data
                $data = $this->Bongbazer_Model->childCategory_getRows($sub_category_id);

                //check if the user data inserted
                if($data)
                {
                    $this->response($data, REST_Controller::HTTP_OK);
                }
                else
                {
                    //set the response and exit
                    $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
                }
            }
            else
            {
                $this->response("Chid Category sub_category_id is blank.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }
        //User Register
        public function UserRegister_post()
        {

            $userData = array();

            $userData['mobile_no'] = $this->post('mobile_no');

            if(!empty($userData['mobile_no']) )
            {

                $count=$this->Bongbazer_Model->entty_check(['mobile_no'=>$userData['mobile_no']],'tbl_users');

                if($count==0)
                {
                    $otp=rand(4,9999);
                    $userData['otp']=$otp;
                    $userData['uniqcode']='us'.randomPassword(28);
                    $userData['datetime']=date('Y-m-d H:i:s;);

                    //'datetime'=>date('Y-m-d H:i:s;)

                    //insert user data
                    $insert = $this->Bongbazer_Model->insert($userData,'tbl_users');

                    //check if the user data inserted
                    if($insert)
                    {
                        //set the response and exit
                        $this->response([[
                        'status' => TRUE,
                        'message' => 'OTP has been send in your mobile no.'
                        ]], REST_Controller::HTTP_OK);
                    }
                    else
                    {
                        //set the response and exit
                        $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
                    }
                }
                else
                {
                    $this->response("This mobile no. is allready exists.", REST_Controller::HTTP_BAD_REQUEST);
                }

            }
            else
            {
                //set the response and exit
                //BAD_REQUEST (400) being the HTTP response code
                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }

        //User Register Step
        public function UserRegisterStep_post()
        {

            $userData = array();

            $mobile_no= $this->post('mobile_no');
            $otp= $this->post('otp');
            $password= $this->post('password');

            if(!empty($mobile_no) && !empty($otp) && !empty($password) )
            {
                $row=$this->Bongbazer_Model->selectrow(['mobile_no'=>$mobile_no],'tbl_users');

                if($row->otp==$otp)
                {

                    $where=array(
                    'mobile_no'=>$mobile_no
                    );

                    $dataChange=array(
                        'password'=>md5($password),
                        'datetime'=>date('Y-m-d H:i:s;)
                    );


                    $update = $this->Bongbazer_Model->update('tbl_users',$where,$dataChange);

                    if($update)
                    {
                        //set the response and exit
                        $this->response([[
                        'status' => TRUE,
                        'message' => 'Register Successfuly'
                        ]], REST_Controller::HTTP_OK);
                    }
                    else
                    {
                        //set the response and exit
                        $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
                    }
                }
                else
                {
                    $this->response("OTP dose not match.", REST_Controller::HTTP_BAD_REQUEST);
                }

            }
            else
            {

                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }

        //User Login
        public function UserLogin_post()
        {

            $userData =array();

            $mobile_no= $this->post('mobile_no');
            $password = $this->post('password');
            
            if(!empty($mobile_no) && !empty($password))
            {

                $check=array(
                'password'=>md5($password),
                'mobile_no'=>$mobile_no,
                'status'=>'Active'
                );
                $count=$this->Bongbazer_Model->entty_check($check,'tbl_users');
                
                if(!empty($count))
                {
                    $check1=array(
                    'password'=>md5($password),
                    'mobile_no'=>$mobile_no,
                    'status'=>'Active'
                    );
                    $userData = $this->Bongbazer_Model->selectrow1($check1,'tbl_users');
                    //check if the user data inserted
                    if(!empty($userData))
                    {
                        $this->response($userData, REST_Controller::HTTP_OK);

                    }
                    else
                    {
                    //set the response and exit
                        $this->response("Contact bongbaazer support..", REST_Controller::HTTP_BAD_REQUEST);
                    }
                }
                else
                {
                    $check=array(
                    'password'=>md5($password),
                    'email'=>$mobile_no,
                    'status'=>'Active'
                    );
                    $count=$this->Bongbazer_Model->entty_check($check,'tbl_users');

                    if(!empty($count))
                    {
                        $check1=array(
                        'password'=>md5($password),
                        'email'=>$mobile_no,
                        'status'=>'Active'
                        );
                        $login_row = $this->Bongbazer_Model->selectrow1($check1,'tbl_users');
                        //check if the user data inserted
                        if(!empty($login_row))
                        {
                            $this->response($login_row, REST_Controller::HTTP_OK);

                        }
                        else
                        {
                            //set the response and exit
                            $this->response("Contact bongbaazer support..", REST_Controller::HTTP_BAD_REQUEST);
                        }
                    }
                    else
                    {
                
                        $this->response("UserId or password dose not match, please try again.", REST_Controller::HTTP_BAD_REQUEST);
                    }
                }

            }
            else
            {
                //set the response and exit
                //BAD_REQUEST (400) being the HTTP response code
                    $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }

        //User
        public function User_post()
        {
            $uniqcode= $this->post('uniqcode');
            
            if(!empty($uniqcode))
            {
                $login_row=$this->Bongbazer_Model->selectrow1(['uniqcode'=>$uniqcode],'tbl_users');

                if(!empty($login_row))
                {
                    $this->response($login_row, REST_Controller::HTTP_OK);
                }
                    
                else
                {
                    $this->response("Uniqcode dose not match.", REST_Controller::HTTP_BAD_REQUEST);
                }

            }
            else
            {

                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }

        //Personal Information
        public function PersonalInformation_post()
        {
            $uniqcode= $this->post('uniqcode');
            $first_name= $this->post('first_name');
            $last_name= $this->post('last_name');
            $gender= $this->post('gender');

            if(!empty($uniqcode) && !empty($first_name) && !empty($last_name) && !empty($gender))
            {
                $row=$this->Bongbazer_Model->selectrow(['uniqcode'=>$uniqcode],'tbl_users');

                if(!empty($row))
                {

                    $where=array(
                    'uniqcode'=>$uniqcode
                    );

                    $dataChange=array(
                    'name'=>$first_name."##".$last_name,
                    'gender'=>$gender,
                    'datetime'=>date('Y-m-d H:i:s;)
                    );


                    $update = $this->Bongbazer_Model->update('tbl_users',$where,$dataChange);

                    if($update)
                    {
                        //set the response and exit
                        $check1=array(
                        'uniqcode'=>$uniqcode,
                        'status'=>'Active'
                        );
                        $login_row = $this->Bongbazer_Model->selectrow1($check1,'tbl_users');
                        //check if the user data inserted
                        if(!empty($login_row))
                        {
                            $this->response($login_row, REST_Controller::HTTP_OK);

                        }
                        else
                        {
                            //set the response and exit
                            $this->response("Contact bongbaazer support..", REST_Controller::HTTP_BAD_REQUEST);
                        }
                    }
                    else
                    {
                        //set the response and exit
                        $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
                    }
                }
                else
                {
                    $this->response("Uniqcode dose not match.", REST_Controller::HTTP_BAD_REQUEST);
                }

            }
            else
            {

                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }

        //User Email
        public function UserEmail_post()
        {
            $uniqcode= $this->post('uniqcode');
            $email= $this->post('email');

            if(!empty($uniqcode) && !empty($email))
            {
                $row=$this->Bongbazer_Model->selectrow(['uniqcode'=>$uniqcode],'tbl_users');

                if(!empty($row))
                {

                    $where=array(
                    'uniqcode'=>$uniqcode
                    );

                    $dataChange=array(
                    'email'=>$email,
                    'datetime'=>date('Y-m-d H:i:s;)
                    );


                    $update = $this->Bongbazer_Model->update('tbl_users',$where,$dataChange);

                    if($update)
                    {
                        $check1=array(
                            'uniqcode'=>$uniqcode,
                            'status'=>'Active'
                        );
                        $login_row = $this->Bongbazer_Model->selectrow1($check1,'tbl_users');
                        //check if the user data inserted
                        if(!empty($login_row))
                        {
                            $this->response($login_row, REST_Controller::HTTP_OK);

                        }
                        else
                        {
                            //set the response and exit
                            $this->response("Contact bongbaazer support..", REST_Controller::HTTP_BAD_REQUEST);
                        }
                    }
                    else
                    {
                        //set the response and exit
                        $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
                    }
                }
                else
                {
                    $this->response("Uniqcode dose not match.", REST_Controller::HTTP_BAD_REQUEST);
                }

            }
            else
            {

                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }

        //User Image
        public function UserImage_post()
        {
            $uniqcode= $this->post('uniqcode');
            $image= $this->post('image');

            if(!empty($uniqcode) && !empty($image))
            {
                $row=$this->Bongbazer_Model->selectrow(['uniqcode'=>$uniqcode],'tbl_users');

                if(!empty($row))
                {
                    $a='us'.randomPassword(28);

                    $upload_path='webroot/user/images/'.$a.'.jpg';

                    file_put_contents($upload_path,base64_decode($image));

                    $where=array(
                    'uniqcode'=>$uniqcode
                    );

                    $dataChange=array(
                        'image'=>$a.'.jpg',
                        'datetime'=>date('Y-m-d H:i:s;)
                    );


                    $update = $this->Bongbazer_Model->update('tbl_users',$where,$dataChange);

                    if($update)
                    {
                        $check1=array(
                        'uniqcode'=>$uniqcode,
                        'status'=>'Active'
                        );
                        $login_row = $this->Bongbazer_Model->selectrow1($check1,'tbl_users');
                        //check if the user data inserted
                        if(!empty($login_row))
                        {
                            $this->response($login_row, REST_Controller::HTTP_OK);

                        }
                        else
                        {
                            //set the response and exit
                            $this->response("Contact bongbaazer support..", REST_Controller::HTTP_BAD_REQUEST);
                        }
                    }
                    else
                    {
                        //set the response and exit
                        $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
                    }
                }
                else
                {
                    $this->response("Uniqcode dose not match.", REST_Controller::HTTP_BAD_REQUEST);
                }

            }
            else
            {

                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }

        //Change Password
        public function ChangePassword_post()
        {

            $userData =array();

            $uniqcode= $this->post('uniqcode');
            $password = $this->post('password');
            $new_password = $this->post('new_password');
            
            if(!empty($uniqcode) && !empty($password) && !empty($new_password))
            {

                $check=array(
                'password'=>md5($password),
                'uniqcode'=>$uniqcode,
                'status'=>'Active'
                );
                $count=$this->Bongbazer_Model->entty_check($check,'tbl_users');
                if(!empty($count))
                {

                    $where=array(
                    'uniqcode'=>$uniqcode
                    );

                    $dataChange=array(
                    'password'=>md5($new_password)
                    );
                    $update = $this->Bongbazer_Model->update('tbl_users',$where,$dataChange);

                    if($update)
                    {
                        $login_row = $this->Bongbazer_Model->selectrow1($where,'tbl_users');
                        //check if the user data inserted
                        if(!empty($login_row))
                        {
                            $this->response($login_row, REST_Controller::HTTP_OK);

                        }
                        else
                        {
                            //set the response and exit
                            $this->response("Contact bongbaazer support..", REST_Controller::HTTP_BAD_REQUEST);
                        }
                    }
                    else
                    {
                        //set the response and exit
                        $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
                    }
                }
                else
                {
                
                    $this->response("UserId or password dose not match, please try again.", REST_Controller::HTTP_BAD_REQUEST);
                }

            }
            else
            {
                //set the response and exit
                //BAD_REQUEST (400) being the HTTP response code
                    $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }

        //Admin
        public function Admin_get()
        {
            $data = $this->Bongbazer_Model->shuffle_assoc($this->Bongbazer_Model->admin_getRows());
            if(!empty($data))
            {

                $this->response($data, REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response([
                'status' => FALSE,
                'message' => 'No data were found.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }

        //About Us
        public function AboutUs_get()
        {
            $data = $this->Bongbazer_Model->aboutUs_getRows('tbl_about_us');
            if(!empty($data))
            {

                $this->response($data, REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response([
                'status' => FALSE,
                'message' => 'No data were found.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }

        //Payment Policy
        public function PaymentPolicy_get()
        {
            $fdata=$this->Bongbazer_Model->policy('tbl_payment_policy');

            if(!empty($fdata))
            {

                $this->response($fdata, REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response([
                'status' => FALSE,
                'message' => 'No data were found.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }        
        }

        //Privacy Policy
        public function PrivacyPolicy_get()
        {
            $fdata=$this->Bongbazer_Model->policy('tbl_privacy_policy');

            if(!empty($fdata))
            {

                $this->response($fdata, REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response([
                'status' => FALSE,
                'message' => 'No data were found.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }        
        }

        //Terms Policy
        public function TermsPolicy_get()
        {
            $fdata=$this->Bongbazer_Model->policy('tbl_terms_condition');

            if(!empty($fdata))
            {

                $this->response($fdata, REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response([
                'status' => FALSE,
                'message' => 'No data were found.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }        
        }
        
        //Shiping Policy
        public function ShipingPolicy_get()
        {
            $fdata=$this->Bongbazer_Model->policy('tbl_shipping_policy');

            if(!empty($fdata))
            {

                $this->response($fdata, REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response([
                'status' => FALSE,
                'message' => 'No data were found.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }        
        }

        //Return Policy
        public function ReturnPolicy_get()
        {
            $fdata=$this->Bongbazer_Model->policy('tbl_return_policy');

            if(!empty($fdata))
            {

                $this->response($fdata, REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response([
                'status' => FALSE,
                'message' => 'No data were found.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }        
        }

        //Security Policy
        public function SecurityPolicy_get()
        {
            $fdata=$this->Bongbazer_Model->policy('tbl_security');

            if(!empty($fdata))
            {

                $this->response($fdata, REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response([
                'status' => FALSE,
                'message' => 'No data were found.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }        
        }

        //Report Infringement
        public function ReportInfringement_get()
        {
            $fdata=$this->Bongbazer_Model->policy('tbl_report_infringement');

            if(!empty($fdata))
            {

                $this->response($fdata, REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response([
                'status' => FALSE,
                'message' => 'No data were found.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }        
        }

        //Product Discount Clothing
        public function ProductDiscountClothing_get()
        {
            $fdata=$this->Bongbazer_Model->ProductDiscountAllClothing(9,'Clothing');
            //$fdata=$this->Bongbazer_Model->shuffle_assoc($data);

            if(!empty($fdata))
            {

                $this->response($fdata, REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response([
                'status' => FALSE,
                'message' => 'No data were found.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }        
        }

        // Product Discount All Clothing
        public function ProductDiscountAllClothing_get()
        {
            $fdata=$this->Bongbazer_Model->ProductDiscountAllClothing(30,'Clothing');
            //$fdata=$this->Bongbazer_Model->shuffle_assoc($data);

            if(!empty($fdata))
            {

                $this->response($fdata, REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response([
                'status' => FALSE,
                'message' => 'No data were found.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }        
        }

        //Product Discount Accessories
        public function ProductDiscountAccessories_get()
        {
            $fdata=$this->Bongbazer_Model->ProductDiscountAllClothing(9,'Accessories');
            //$fdata=$this->Bongbazer_Model->shuffle_assoc($data);

            if(!empty($fdata))
            {

                $this->response($fdata, REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response([
                'status' => FALSE,
                'message' => 'No data were found.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }        
        }

        //Product Discount All Accessories
        public function ProductDiscountAllAccessories_get()
        {
            $fdata=$this->Bongbazer_Model->ProductDiscountAllClothing(30,'Accessories');
            //$fdata=$this->Bongbazer_Model->shuffle_assoc($data);

            if(!empty($fdata))
            {

                $this->response($fdata, REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response([
                'status' => FALSE,
                'message' => 'No data were found.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }        
        }

        //Product Discount Shoes
        public function ProductDiscountShoes_get()
        {
            $fdata=$this->Bongbazer_Model->ProductDiscountAllClothing(9,'Shoes');
            //$fdata=$this->Bongbazer_Model->shuffle_assoc($data);

            if(!empty($fdata))
            {

                $this->response($fdata, REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response([
                'status' => FALSE,
                'message' => 'No data were found.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }        
        }

        //Product Discount All Shoes
        public function ProductDiscountAllShoes_get()
        {
            $fdata=$this->Bongbazer_Model->ProductDiscountAllClothing(30,'Shoes');
            //$fdata=$this->Bongbazer_Model->shuffle_assoc($data);

            if(!empty($fdata))
            {

                $this->response($fdata, REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response([
                'status' => FALSE,
                'message' => 'No data were found.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }        
        }

        //Clothing Scroll_get
        public function ClothingScroll_get()
        {
            $data = $this->Bongbazer_Model->ClothingScroll_getRows(9,'Clothing');

            $fdata=$this->Bongbazer_Model->shuffle_assoc($data);
            if(!empty($fdata))
            {

                $this->response($fdata, REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response([
                'status' => FALSE,
                'message' => 'No data were found.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }

        //Clothing All Category
        public function ClothingAll_get()
        {
            $fdata = $this->Bongbazer_Model->ClothingAll_getRows('Clothing');
            $data=$this->Bongbazer_Model->shuffle_assoc($fdata);
            if(!empty($data))
            {
                
                $this->response($data, REST_Controller::HTTP_OK);
               
            }
            else
            {
                $this->response([
                'status' => FALSE,
                'message' => 'No data were found.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
       
       //Accessories Scroll_get
        public function AccessoriesScroll_get()
        {
            $data = $this->Bongbazer_Model->ClothingScroll_getRows(9,'Accessories');

            $fdata=$this->Bongbazer_Model->shuffle_assoc($data);
            if(!empty($fdata))
            {

                $this->response($fdata, REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response([
                'status' => FALSE,
                'message' => 'No data were found.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }

        //Accessories All Category
        public function AccessoriesAll_get()
        {
            $fdata = $this->Bongbazer_Model->ClothingAll_getRows('Accessories');
            $data=$this->Bongbazer_Model->shuffle_assoc($fdata);
            if(!empty($data))
            {
                
                $this->response($data, REST_Controller::HTTP_OK);
               
            }
            else
            {
                $this->response([
                'status' => FALSE,
                'message' => 'No data were found.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }

        //Shoes Scroll_get
        public function ShoesScroll_get()
        {
            $data = $this->Bongbazer_Model->ClothingScroll_getRows(9,'Shoes');

            $fdata=$this->Bongbazer_Model->shuffle_assoc($data);
            if(!empty($fdata))
            {

                $this->response($fdata, REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response([
                'status' => FALSE,
                'message' => 'No data were found.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }

        //Shoes All Category
        public function ShoesAll_get()
        {
            $fdata = $this->Bongbazer_Model->ClothingAll_getRows('Shoes');
            $data=$this->Bongbazer_Model->shuffle_assoc($fdata);
            if(!empty($data))
            {
                
                $this->response($data, REST_Controller::HTTP_OK);
               
            }
            else
            {
                $this->response([
                'status' => FALSE,
                'message' => 'No data were found.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }

        //Child All Product
        public function ChildAllProduct_post()
        {
            $child_category_id=$this->input->post('child_category_id');
            if(!empty($child_category_id))
            {
                $data = $this->Bongbazer_Model->ChildAllProduct_getRows($child_category_id);

                if(!empty($data))
                {
                    
                    $this->response($data, REST_Controller::HTTP_OK);
                   
                }
                else
                {
                    $this->response([
                    'status' => FALSE,
                    'message' => 'No data were found.'
                    ], REST_Controller::HTTP_NOT_FOUND);
                }
            }
            else
            {
                $this->response("Child Category is blank.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }

        //Product Price Low To High
        public function ProductLowToHigh_get()
        {
            $data=$this->Bongbazer_Model->ProductLowToHigh(9);
            
            if(!empty($data))
            {

                $this->response($data, REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response([
                'status' => FALSE,
                'message' => 'No data were found.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }

        //All Product Price Low To High
        public function ProductLowToHighAll_get()
        {
            $data=$this->Bongbazer_Model->ProductLowToHigh(30);
            
            if(!empty($data))
            {

                $this->response($data, REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response([
                'status' => FALSE,
                'message' => 'No data were found.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }

        //Singel Admin Details
        public function SingelAdmin_post()
        {

            $admin_id= $this->post('admin_id');

            if(!empty($admin_id))
            {

                $data = $this->Bongbazer_Model->singel_admin($admin_id);

                $fdata=$this->Bongbazer_Model->shuffle_assoc($data);
                if(!empty($fdata))
                {

                    $this->response($fdata, REST_Controller::HTTP_OK);
                }
                else
                {
                    $this->response([
                    'status' => FALSE,
                    'message' => 'No data were found.'
                    ], REST_Controller::HTTP_NOT_FOUND);
                }
            }
            else
            {
                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }

        }

        //Product For Particular Admin
        public function AdminProduct_post()
        {

            $admin_id= $this->post('admin_id');

            if(!empty($admin_id))
            {

                $data = $this->Bongbazer_Model->admin_all_product($admin_id);

                $fdata=$this->Bongbazer_Model->shuffle_assoc($data);
                if(!empty($fdata))
                {

                    $this->response($fdata, REST_Controller::HTTP_OK);
                }
                else
                {
                    $this->response([
                    'status' => FALSE,
                    'message' => 'No data were found.'
                    ], REST_Controller::HTTP_NOT_FOUND);
                }
            }
            else
            {
                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }

        }
        
        //All City List For Active Admin
        public function AllAdminCity_get()
        {
            $data = $this->Bongbazer_Model->allAdminCity_getRows();
            if(!empty($data))
            {
                
                $this->response($data, REST_Controller::HTTP_OK);
               
            }
            else
            {
                $this->response([
                'status' => FALSE,
                'message' => 'No data were found.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }

        //All Active Shop
        public function AllShopName_post()
        {
            $city=$this->post('city');
            
            $data = $this->Bongbazer_Model->allShopName_getRows($city);        
            
            if(!empty($data))
            {
                $this->response($data, REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response([
                'status' => FALSE,
                'message' => 'No data were found.' 
                ], REST_Controller::HTTP_NOT_FOUND);  
            }
        } 

        //Search Admin
        public function SearchAdmin_post()
        {

            $city=$this->post('city');
            $shop_name=$this->post('shop_name');
            $data = $this->Bongbazer_Model->search_all_admin_getRows($shop_name,$city);        
            
                if(!empty($data))
                {
                    $this->response($data, REST_Controller::HTTP_OK);
                }
                else
                {
                    $this->response([
                    'status' => FALSE,
                    'message' => 'No data were found.' 
                    ], REST_Controller::HTTP_NOT_FOUND);  
                }
        } 

        //All Product Admin Name 
        public function AdminAllData_post()
        {
            $admin_id=$this->post('admin_id');
            $data = $this->Bongbazer_Model->all_admin_product_name($admin_id);
            if(!empty($data))
            {

                $this->response($data, REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response([[
                'status' => FALSE,
                'message' => 'No data were found.'
                ]], REST_Controller::HTTP_NOT_FOUND);
            }
        }

        //Search Produt For Particular Admin
        public function SearchAdminProduct_post()
        {

            $query=$this->post('query');
            $admin_id=$this->post('admin_id');
            if(!empty($query) && !empty($admin_id))
            {

                $data = $this->Bongbazer_Model->search_admin_getRows($query,$admin_id);        
            
                if(!empty($data))
                {
                    $this->response($data, REST_Controller::HTTP_OK);
                }
                else
                {
                    $this->response([
                    'status' => FALSE,
                    'message' => 'No data were found.' 
                    ], REST_Controller::HTTP_NOT_FOUND);  
                }
            }
            else
            {
                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }

        //All Product Name
        public function AllData_get()
        {
            $data = $this->Bongbazer_Model->all_product_name();
            if(!empty($data))
            {

                $this->response($data, REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response([[
                'status' => FALSE,
                'message' => 'No data were found.'
                ]], REST_Controller::HTTP_NOT_FOUND);
            }
        }

        // Mani Search Engiene
        public function SearchProduct_post()
        {

            $query=$this->post('query');
            if(!empty($query))
            {

                $data = $this->Bongbazer_Model->search_getRows($query);        
            
                if(!empty($data))
                {
                    $this->response($data, REST_Controller::HTTP_OK);
                }
                else
                {
                    $this->response([
                    'status' => FALSE,
                    'message' => 'No data were found.' 
                    ], REST_Controller::HTTP_NOT_FOUND);  
                }
            }
            else
            {
                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }

        //Add Or Remove Wish List
        public function Wishlist_post()
        {
            $product_id=$this->post('product_id');
            $user_id=$this->post('user_id');
            $product_features_id=$this->post('product_features_id');


            if( !empty($product_id) && !empty($user_id) && !empty($product_features_id) )
            {
              
                $where=array(
                'status<>'=>'Delete',
                'product_id'=>$product_id,
                'user_id'=>$user_id,
                'product_features_id'=>$product_features_id,
                );

                $count=$this->Bongbazer_Model->entty_check($where,'tbl_wishlist');
               
                if($count==0)
                {
                 
                    $post=array(
                        'uniqcode'=>'wl'.randomPassword(28),
                        'product_id'=>$product_id,
                        'user_id'=>$user_id,
                        'product_features_id'=>$product_features_id,
                        'notification'=>'',
                        'datetime'=>date('Y-m-d H:i:s;)
                        );
                        $insert = $this->Bongbazer_Model->insert($post,'tbl_wishlist');

                        //check if the user data inserted
                        if($insert)
                        {
                            //set the response and exit
                            $this->response([[
                            'status' => 'Added',
                            'message' => 'wishlist added successfuly.'
                            ]], REST_Controller::HTTP_OK);
                        }
                        else
                        {
                            //set the response and exit
                            $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
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
                    $this->response([[
                            'status' => 'Removed',
                            'message' => 'wishlist removed successfuly.'
                            ]], REST_Controller::HTTP_OK);
                }
            }
            else
            {
                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }

        //Wishlist Checking
        public function CheckWishlist_post()
        {
            $product_id=$this->post('product_id');
            $user_id=$this->post('user_id');
            $product_features_id=$this->post('product_features_id');


            if( !empty($product_id) && !empty($user_id) && !empty($product_features_id) )
            {

                $data = $this->Bongbazer_Model->check_wishlist($product_id,$user_id,$product_features_id);        
            
                if(!empty($data))
                {
                    $this->response([['status'=>TRUE]], REST_Controller::HTTP_OK);
                }
                else
                {
                    $this->response([[
                    'status' => FALSE,
                    'message' => 'No data were found.'
                    ]], REST_Controller::HTTP_NOT_FOUND);
                }
            }
            else
            {
                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }

        //All Wish List Details
        public function AllWishlist_post()
        {
            $user_id=$this->post('user_id');

            if(!empty($user_id))
            {

                $data = $this->Bongbazer_Model->allWishlist_getRows($user_id);        
            
                if(!empty($data))
                {
                    $this->response($data, REST_Controller::HTTP_OK);
                }
                else
                {
                    $this->response([
                    'status' => FALSE,
                    'message' => 'No data were found.'
                    ], REST_Controller::HTTP_NOT_FOUND);
                }
            }
            else
            {
                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }

        //Address uniqcode
        public function AddressUniqcode_post()
        {

            $uniqcode=$this->post('uniqcode');
            if(!empty($uniqcode))
            {

                $data = $this->Bongbazer_Model->allAddressUniqcode_getRows($uniqcode);        
            
                if(!empty($data))
                {
                    $this->response($data, REST_Controller::HTTP_OK);
                }
                else
                {
                    $this->response([
                    'status' => FALSE,
                    'message' => 'No data were found.' 
                    ], REST_Controller::HTTP_NOT_FOUND);  
                }
            }
            else
            {
                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }

        public function AddressInsert_post()
        {    
            $user_id=$this->post('user_id');
            $first_name=$this->post('first_name');
            $mobile_no=$this->post('mobile_no');
            $address_details=$this->post('address_details');
            $city_dist_town=$this->post('city_dist_town');
            $state=$this->post('state');
            $pin_code=$this->post('pin_code');
            $locality=$this->post('locality');
            $alternative_mob_no=$this->post('alternative_mob_no');
            $landmark=$this->post('landmark');

            if(!empty($user_id) && !empty($first_name) && !empty($mobile_no) && !empty($address_details) &&!empty($city_dist_town) &&!empty($state) &&!empty($locality) &&!empty($pin_code) )
            {

                $data1=array(
                    'select_address'=>'0',
                    
                );

                $check = $this->Bongbazer_Model->entty_check(['user_id'=>$user_id,'status'=>'Active'],'tbl_users_delivery_address');

                if($check)
                {
                    $update = $this->Bongbazer_Model->update('tbl_users_delivery_address',['user_id'=>$user_id],$data1);
                }

                $data=array(
                    'uniqcode'=>"ad".random_string('alnum',28),
                    'user_id'=>$user_id,
                    'name'=>$first_name,
                    'mobile_no'=>$mobile_no,
                    'address_details'=>$address_details,
                    'city_dist_town'=>$city_dist_town,
                    'state'=>$state,
                    'pin_code'=>$pin_code,
                    'locality'=>$locality,
                    'alternative_mob_no'=>$alternative_mob_no,
                    'landmark'=>$landmark,
                    'datetime'=>date('Y-m-d H:i:s;)
                );
               
                $insert = $this->Bongbazer_Model->insert($data,'tbl_users_delivery_address');

                //check if the user data inserted
                if($insert)
                {
                    //set the response and exit
                    $this->response([[
                    'status' => TRUE,
                    'message' => 'Insert Successfuly.'
                    ]], REST_Controller::HTTP_OK);
                }
                else
                {
                    //set the response and exit
                    $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
                }
                
                
            }
            else
            {
                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }        
        }

        public function AddressSelectUpdate_post()
        {    
            $uniqcode=$this->post('uniqcode');
            $user_id=$this->post('user_id');
            

            if(!empty($uniqcode) )
            {
                
                $data1=array(
                    'select_address'=>'1', 
                );

                $data=array(
                    'select_address'=>'0', 
                );
                $check = $this->Bongbazer_Model->entty_check(['uniqcode'=>$uniqcode,'status'=>'Active'],'tbl_users_delivery_address');

                if($check)
                {

                    $update = $this->Bongbazer_Model->update('tbl_users_delivery_address',['user_id'=>$user_id],$data);
                    $update = $this->Bongbazer_Model->update('tbl_users_delivery_address',['uniqcode'=>$uniqcode],$data1);
                    

                    if($update)
                    {
                        //set the response and exit
                        $this->response([[
                        'status' => TRUE,
                        'message' => 'Cart Update Successfuly'
                        ]], REST_Controller::HTTP_OK);
                    }
                    else
                    {
                        //set the response and exit
                        $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
                    } 

                }
                else
                {
                    $this->response("Cart Item Dose not exits.", REST_Controller::HTTP_OK);
                }
            }
            else
            {
                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }        
        } 

        public function Address_post()
        {

            $user_id=$this->post('user_id');
            if(!empty($user_id))
            {

                $data = $this->Bongbazer_Model->allAddress_getRows($user_id);        
            
                if(!empty($data))
                {
                    $this->response($data, REST_Controller::HTTP_OK);
                }
                else
                {
                    $this->response([
                    'status' => FALSE,
                    'message' => 'No data were found.' 
                    ], REST_Controller::HTTP_NOT_FOUND);  
                }
            }
            else
            {
                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }

        public function State_get()
        {

            $data = $this->Bongbazer_Model->allState_getRows('101');        
            
            if(!empty($data))
            {
                $this->response($data, REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response([
                'status' => FALSE,
                'message' => 'No data were found.' 
                ], REST_Controller::HTTP_NOT_FOUND);  
            }
        }

        public function StateCheck_Post()
        {

            $state=$this->post('name');

            $data1=array(
                    'name'=>$state,
                    'country_id'=>'101',
                    'is_active'=>'Active',
                    'is_delete'=>'N'
                );

                    
            $check = $this->Bongbazer_Model->entty_check($data1,'tbl_state_mast');

            if(!empty($check))
            {
                $this->response([[
                        'status' => TRUE,
                        'message' => 'State is Valid'
                        ]], REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response([[
                'status' => FALSE,
                'message' => 'No data were found.' 
                ]], REST_Controller::HTTP_NOT_FOUND);  
            }
        }

        public function SelectAddress_post()
        {

            $user_id=$this->post('user_id');
            if(!empty($user_id))
            {

                $data = $this->Bongbazer_Model->allSelectAddress_getRows($user_id);        
            
                if(!empty($data))
                {
                    $this->response($data, REST_Controller::HTTP_OK);
                }
                else
                {
                    $this->response([
                    'status' => FALSE,
                    'message' => 'No data were found.' 
                    ], REST_Controller::HTTP_NOT_FOUND);  
                }
            }
            else
            {
                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }

        public function AddressDelete_post()
        {    

            $uniqcode=$this->post('uniqcode');


            if(!empty($uniqcode))
            {
                
                $data=['status'=>'Delete'];       
                $delete = $this->Bongbazer_Model->update('tbl_users_delivery_address',['uniqcode'=>$uniqcode],$data);

                //check if the user data inserted
                if($delete)
                {
                    //set the response and exit
                    $this->response([['status' =>TRUE,
                    'message' => 'delevery address Item has been deleted.']], REST_Controller::HTTP_OK);
                }
                else
                {
                    $this->response("Address Item Dose not exits.", REST_Controller::HTTP_OK);
                }
            }
            else
            {
                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }        
        }

        public function AddressUpdate_post()
        {    
            $uniqcode=$this->post('uniqcode');
            $first_name=$this->post('first_name');
            $mobile_no=$this->post('mobile_no');
            $address_details=$this->post('address_details');
            $state=$this->post('state');
            $city_dist_town=$this->post('city_dist_town');
            $locality=$this->post('locality');
            $alternative_mob_no=$this->post('alternative_mob_no');
            $landmark=$this->post('landmark');
            $pin_code=$this->post('pin_code');
            

            if(!empty($uniqcode) )
            {
                
                $data=array(
                    'name'=>$first_name,
                    'mobile_no'=>$mobile_no,
                    'address_details'=>$address_details,
                    'state'=>$state,
                    'city_dist_town'=>$city_dist_town,
                    'pin_code'=>$pin_code,
                    'locality'=>$locality,
                    'alternative_mob_no'=>$alternative_mob_no,
                    'landmark'=>$landmark,
                    'datetime'=>date('Y-m-d H:i:s;)
                );
                $check = $this->Bongbazer_Model->entty_check(['uniqcode'=>$uniqcode],'tbl_users_delivery_address');
                //check if the user data inserted
                if($check)
                {
                    $update = $this->Bongbazer_Model->update('tbl_users_delivery_address',['uniqcode'=>$uniqcode],$data);

                    if($update)
                    {
                        //set the response and exit
                        $this->response([[
                        'status' => TRUE,
                        'message' => 'Address Update Successfuly'
                        ]], REST_Controller::HTTP_OK);
                    }
                    else
                    {
                        //set the response and exit
                        $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
                    } 
                }
                else
                {
                    $this->response("Cart Item Dose not exits.", REST_Controller::HTTP_OK);
                }
            }
            else
            {
                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }        
        }

        public function ProductView_post()
        {
            
            $product_id=$this->post('product_id');
        
            if(!empty($product_id))
            {
                $fdata=$this->Bongbazer_Model->productView($product_id);
                
                if(!empty($fdata))
                {

                    $this->response($fdata, REST_Controller::HTTP_OK);
                }
                else
                {
                    $this->response([
                    'status' => FALSE,
                    'message' => 'No data were found.'
                    ], REST_Controller::HTTP_NOT_FOUND);
                }

            }
            else
            {
                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }

        public function ProductViewColor_post()
        {
            
            $product_id=$this->post('product_id');
        
            if(!empty($product_id))
            {


                $fdata=$this->Bongbazer_Model->productViewColor($product_id);
                
                if(!empty($fdata))
                {

                    $this->response($fdata, REST_Controller::HTTP_OK);
                }
                else
                {
                    $this->response([
                    'status' => FALSE,
                    'message' => 'No data were found.'
                    ], REST_Controller::HTTP_NOT_FOUND);
                }

            }
            else
            {
                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }

        public function ProductViewSize_post()
        {
            
            $product_id=$this->post('product_id');
            $color=$this->post('color');
            if(!empty($product_id) && !empty($color))
            {
                $fdata=$this->Bongbazer_Model->productViewSize($product_id,$color);
                
                if(!empty($fdata))
                {

                    $this->response($fdata, REST_Controller::HTTP_OK);
                }
                else
                {
                    $this->response([
                    'status' => FALSE,
                    'message' => 'No data were found.'
                    ], REST_Controller::HTTP_NOT_FOUND);
                }

            }
            else
            {
                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }

        public function ProductViewPriceImage_post()
        {
            
            $product_features_id=$this->post('product_features_id');
        
            if(!empty($product_features_id))
            {
                $fdata=$this->Bongbazer_Model->productViewPriceImage($product_features_id);
                
                if(!empty($fdata))
                {

                    $this->response($fdata, REST_Controller::HTTP_OK);
                }
                else
                {
                    $this->response([
                    'status' => FALSE,
                    'message' => 'No data were found.'
                    ], REST_Controller::HTTP_NOT_FOUND);
                }

            }
            else
            {
                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }

        public function CartInsert_post()
        {    

            $user_id=$this->post('user_id');
            $product_id=$this->post('product_id');
            $quantity=$this->post('quantity');
            $product_features_id=$this->post('product_features_id');
            $color=$this->post('color');
            if(!empty($user_id) && !empty($product_id) && !empty($quantity) && !empty($product_features_id))
            {
                $data=array(
                    'uniqcode'=>"ca".random_string('alnum',28),
                    'user_id'=>$user_id,
                    'product_id'=>$product_id,
                    'quantity'=>$quantity,
                    'product_features_id'=>$product_features_id,
                    'color'=>$color,
                    'status'=>"Cart",
                    'datetime'=>date('Y-m-d H:i:s;)
                );
               
                $insert = $this->Bongbazer_Model->insert($data,'tbl_cart');

                //check if the user data inserted
                if($insert)
                {
                    //set the response and exit
                    $this->response([[
                    'status' => TRUE,
                    'message' => 'Cart has submited.'
                    ]], REST_Controller::HTTP_OK);
                }
                else
                {
                    //set the response and exit
                    $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
                }
            }
            else
            {
                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }        
        }

        public function CartCheck_post()
        {    

            $product_id=$this->post('product_id');
            $user_id=$this->post('user_id');
            $product_features_id=$this->post('product_features_id');


            if( !empty($product_id) && !empty($user_id)&& !empty($product_features_id))
            {
                
                $data=array(
                    
                    'user_id'=>$user_id,
                    'product_id'=>$product_id,
                    'product_features_id'=>$product_features_id,
                    'status'=>'Cart'
                    
                );
               
                $insert = $this->Bongbazer_Model->entty_check($data,'tbl_cart');

                //check if the user data inserted
                if($insert)
                {
                    //set the response and exit
                    $this->response([['status' =>TRUE,
                    'message' => 'Product already in Cart.']], REST_Controller::HTTP_OK);
                }
                else
                {
                    $this->response([['status' =>FALSE,
                    'message' => 'Product does not exists in Cart.']], REST_Controller::HTTP_OK);
                }
            }
            else
            {
                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }        
        }

        public function Cart_post()
        {
            
            $user_id=$this->post('user_id');

            if(!empty($user_id))
            {

                $data = $this->Bongbazer_Model->allCart_getRows($user_id);    

                if(!empty($data))
                {
                    $this->response($data, REST_Controller::HTTP_OK);
                }
                else
                {
                    $this->response([
                    'status' => FALSE,
                    'message' => 'No data were found.'
                    ], REST_Controller::HTTP_NOT_FOUND);
                }
            }
            else
            {
                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }
            
        }

        public function Size_post()
        {
            $size=$this->post('size');

            if(!empty($size))
            {
                
                $data = $this->Bongbazer_Model->size($size);
                if(!empty($data))
                {

                    $this->response($data, REST_Controller::HTTP_OK);
                }
                else
                {
                    $this->response([[
                    'status' => FALSE,
                    'message' => 'No data were found.'
                    ]], REST_Controller::HTTP_NOT_FOUND);
                }
            }
            else
            {
                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }        
        }

        public function CartDelete_post()
        {    

            $uniqcode=$this->post('uniqcode');
            
            if(!empty($uniqcode))
            {
                
                $data=['status'=>'Delete'];       
                $delete = $this->Bongbazer_Model->update('tbl_cart',['uniqcode'=>$uniqcode],$data);

                //check if the user data inserted
                if($delete)
                {
                    //set the response and exit
                    $this->response([['status' =>TRUE,
                    'message' => 'cart Item has been deleted.']], REST_Controller::HTTP_OK);
                }
                else
                {
                    $this->response("Cart Item Dose not exits.", REST_Controller::HTTP_OK);
                }
            }
            else
            {
                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }        
        }

        public function CartUpdate_post()
        {    
            $uniqcode=$this->post('uniqcode');
            $quantity=$this->post('quantity');
            

            if(!empty($quantity) && !empty($uniqcode) )
            {
                
                $data=array(
                    'quantity'=>$quantity,
                    'datetime'=>date('Y-m-d H:i:s;)
                );
                $check = $this->Bongbazer_Model->entty_check(['uniqcode'=>$uniqcode],'tbl_cart');
                //check if the user data inserted
                if($check)
                {
                    $update = $this->Bongbazer_Model->update('tbl_cart',['uniqcode'=>$uniqcode],$data);

                    if($update)
                    {
                        //set the response and exit
                        $this->response([[
                        'status' => TRUE,
                        'message' => 'Cart Update Successfuly'
                        ]], REST_Controller::HTTP_OK);
                    }
                    else
                    {
                        //set the response and exit
                        $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
                    } 
                }
                else
                {
                    $this->response("Cart Item Dose not exits.", REST_Controller::HTTP_OK);
                }
            }
            else
            {
                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }        
        }   

        public function BuyNowInsert_post()
        {
            $user_id=$this->post('user_id');
            $product_id=$this->post('product_id');
            $quantity=$this->post('quantity');
            $product_features_id=$this->post('product_features_id');
            $color=$this->post('color');
            
            if(!empty($user_id) && !empty($product_id) && !empty($quantity) && !empty($product_features_id))
            {
                $data=array(
                    'uniqcode'=>"ca".random_string('alnum',28),
                    'user_id'=>$user_id,
                    'product_id'=>$product_id,
                    'quantity'=>$quantity,
                    'product_features_id'=>$product_features_id,
                    'color'=>$color,
                    'status'=>"Buy",
                    'datetime'=>date('Y-m-d H:i:s;)
                );
               
                $insert = $this->Bongbazer_Model->insert($data,'tbl_cart');

                //check if the user data inserted
                if($insert)
                {
                    //set the response and exit
                    $this->response([[
                    'status' => TRUE,
                    'message' => 'Buy Now has submited.'
                    ]], REST_Controller::HTTP_OK);
                }
                else
                {
                    //set the response and exit
                    $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
                }
            }
            else
            {
                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }        
        }

        public function BuyNow_post()
        {
            
            $user_id=$this->post('user_id');

            if(!empty($user_id))
            {

                $data = $this->Bongbazer_Model->buyNow_getRows($user_id);    

                if(!empty($data))
                {
                    $this->response($data, REST_Controller::HTTP_OK);
                }
                else
                {
                    $this->response([
                    'status' => FALSE,
                    'message' => 'No data were found.'
                    ], REST_Controller::HTTP_NOT_FOUND);
                }
            }
            else
            {
                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }
            
        }

        public function BuyNowUpdate_post()
        {    
            $user_id=$this->post('user_id');            

            if(!empty($user_id))
            {
                $data=array(
                    'user_id'=>$user_id,
                    'status'=>"Buy"
                );

                $data2=array(
                    'status'=>"Cart",
                    'datetime'=>date('Y-m-d H:i:s;)
                );

                $data3=array(
                    'status'=>"Delete",
                    'datetime'=>date('Y-m-d H:i:s;)
                );

                $check = $this->Bongbazer_Model->entty_check($data,'tbl_cart');
                if($check){
                    
                    $data1 = $this->Bongbazer_Model->buyNowCheck_getRows($user_id);
                    
                    $data5=array(
                        'product_id'=>$data1->product_id,
                        'product_features_id'=>$data1->product_features_id,
                        'color'=>$data1->color,
                        'status'=>'Cart'
                    );
                    $check1 = $this->Bongbazer_Model->entty_check($data5,'tbl_cart');

                    $data4 = $this->Bongbazer_Model->buyNowCheck1_getRows($user_id);

                    if($check1){

                        $update = $this->Bongbazer_Model->update('tbl_cart',['uniqcode'=>$data4],$data3);

                        if($update)
                        {
                            //set the response and exit
                            $this->response([[
                            'status' => TRUE,
                            'message' => 'Buy Now Update Successfuly'
                            ]], REST_Controller::HTTP_OK);
                        }
                        else
                        {
                            //set the response and exit
                            $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
                        }
                        
                    }

                    else{

                        $update = $this->Bongbazer_Model->update('tbl_cart',['uniqcode'=>$data4],$data2);
                        if($update)
                        {
                            //set the response and exit
                            $this->response([[
                            'status' => TRUE,
                            'message' => 'Buy Now Update Successfuly'
                            ]], REST_Controller::HTTP_OK);
                        }
                        else
                        {
                            //set the response and exit
                            $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
                        }
                    }

                }
                else{
                    $this->response("No Item exits.", REST_Controller::HTTP_OK);
                }

            }
            else
            {
                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }        
        }

        public function OrderInsert_post()
        {    
            $order_code=$this->post('order_code');
            $user_id=$this->post('user_id');
            $address_id=$this->post('address_id');
            $product_id=$this->post('product_id');
            $product_features_id=$this->post('product_features_id');
            $quantity=$this->post('quantity');
            $color=$this->post('color');
            $shipping_price=$this->post('shipping_price');
            $delivery_date=$this->post('delivery_date');
            $payment_id=$this->post('payment_id');
            $payment_mode=$this->post('payment_mode');
            $cart_id=$this->post('cart_id');

            if(!empty($order_code) && !empty($user_id) && !empty($address_id) && !empty($product_features_id) && !empty($quantity) && !empty($color) && !empty($shipping_price) && !empty($delivery_date) && !empty($payment_id) && !empty($cart_id))
            {
                               
                $gst=$this->Bongbazer_Model->productViewOrder($product_id,$product_features_id);
                $address=$this->Bongbazer_Model->UserDeliveryOrder($address_id);

                $address1=serialize($this->Bongbazer_Model->address_order($address_id));

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
                if(empty($size)){
                    $size="null";
                }

                $fees=$this->Bongbazer_Model->fees($business_type);
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
                    'uniqcode'=>$cart_id
                );
            
                $data=array(
                    'uniqcode'=>"or".random_string('alnum',28),
                    'order_code'=>$order_code,
                    'user_id'=>$user_id,
                    'address'=>$address1,
                    'product_id'=>$product_id,
                    'product_features_id'=>$product_features_id,
                    'mrp_price'=>$mrp_price,
                    'sell_price'=>$sell_price,
                    'discount'=>$discount,
                    'size'=>$size,
                    'color'=>$color,
                    'quantity'=>$quantity,
                    'fees_id'=>$fees->uniqcode,
                    'delivery_date'=>$delivery_date,
                    'user_received_date'=>$user_received_date,
                    'shipping_price'=>$shipping_price,
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
                    'payment_mode'=>$payment_mode,
                    'payment_id'=>$payment_id,
                    'datetime'=>date('Y-m-d H:i:s;)
                );
 
              
                $insert = $this->Bongbazer_Model->insert($data,'tbl_order');

                //check if the user data inserted
                if($insert)
                {
                    //set the response and exit
                    $update=$this->Bongbazer_Model->update('tbl_cart',$where1,$data1);

                    if($update){

                        $this->response([[
                        'status' => TRUE,
                        'message' => 'Order Successfuly.'
                        ]], REST_Controller::HTTP_OK);
                    }
                    else{
                        $this->response([[
                        'status' => false
                        ]], REST_Controller::HTTP_OK);
                    }
                }
                else
                {
                    //set the response and exit
                    $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
                }
            }
            else
            {
                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }       
        }

        public function Order_post()
        {
            $user_id=$this->post('user_id');
            if(!empty($user_id))
            {

                $data = $this->Bongbazer_Model->allOrder_getRows($user_id);        
            
                if(!empty($data))
                {
                    $this->response($data, REST_Controller::HTTP_OK);
                }
                else
                {
                    $this->response([
                    'status' => FALSE,
                    'message' => 'No data were found.'
                    ], REST_Controller::HTTP_NOT_FOUND);
                }
            }
            else
            {
                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }

        public function Order_Details_post()
        {
            $order_code=$this->post('order_code');

            if(!empty($order_code))
            {

                $data = $this->Bongbazer_Model->allOrderDetails_getRows($order_code);        
            
                if(!empty($data))
                {
                    $this->response($data, REST_Controller::HTTP_OK);
                }
                else
                {
                    $this->response([
                    'status' => FALSE,
                    'message' => 'No data were found.'
                    ], REST_Controller::HTTP_NOT_FOUND);
                }
            }
            else
            {
                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }

        public function OrderCancel_post()
        {    

            $uniqcode=$this->post('uniqcode');


            if(!empty($uniqcode))
            {
                
                $data=['order_status'=>'Delete'];       
                $delete = $this->Bongbazer_Model->update('tbl_order',['uniqcode'=>$uniqcode],$data);

                //check if the user data inserted
                if($delete)
                {
                    //set the response and exit
                    $this->response([['status' =>TRUE,
                    'message' => 'Order Item has been deleted.']], REST_Controller::HTTP_OK);
                }
                else
                {
                    $this->response("order Item Dose not exits.", REST_Controller::HTTP_OK);
                }
            }
            else
            {
                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }        
        }

        public function OrderCancelCode_post()
        {    

            $order_code=$this->post('order_code');


            if(!empty($order_code))
            {
                
                $data=['order_status'=>'Delete'];       
                $delete = $this->Bongbazer_Model->update('tbl_order',['order_code'=>$order_code],$data);

                //check if the user data inserted
                if($delete)
                {
                    //set the response and exit
                    $this->response([['status' =>TRUE,
                    'message' => 'Order has been deleted.']], REST_Controller::HTTP_OK);
                }
                else
                {
                    $this->response("order Item Dose not exits.", REST_Controller::HTTP_OK);
                }
            }
            else
            {
                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }        
        }

        

        public function Test_post()
        {
            $query=$this->post('query');
            if(!empty($query))
            {

                $data = $this->Bongbazer_Model->test($query);        
            
                if(!empty($data))
                {
                    $this->response($data, REST_Controller::HTTP_OK);
                }
                else
                {
                    $this->response([
                    'status' => FALSE,
                    'message' => 'No data were found.' 
                    ], REST_Controller::HTTP_NOT_FOUND);  
                }
            }
            else
            {
                $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
            }
        } 

    }

?>