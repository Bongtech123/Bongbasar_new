<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	function pr($print)
	{
		echo "<pre>";
		print_r($print);
		echo "</pre>";
        die;
	}	
	 // function site_settings_data()
	 // {
	 // 	$ci = get_instance();
	 // 	$ci->db->where('id', 1);
	 // 	$data=$ci->db->get('tbl_site_settings')->row();
	 // 	return $data;
	 // }
	 
    function email_send()
    {
		$CI = get_instance();
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.gmail.com';
        $config['smtp_port'] = '465';
        $config['smtp_timeout'] = '7';

        $config['smtp_user'] = 'developer.bongtechsolution@gmail.com';
        $config['smtp_pass'] = 'Bong@123#';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not
        $CI->email->initialize($config);
        $CI->load->library('Email', $config);

	}	

    function create_slug($string) 
    {
	   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
	   $string = strtolower($string);

	   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}
    function randomPassword($len = 10) 
    {

    //enforce min length 8
    if($len < 10)
        $len = 10;

    //define character libraries - remove ambiguous characters like iIl|1 0oO
    $sets = array();
    $sets[] = 'ABCDEFGHJKLMNPQRSTUVWXYZ';
    $sets[] = 'abcdefghjkmnpqrstuvwxyz';
    $sets[] = '0123456789';
    //$sets[]  = '~!@#$%^&*(){}[],./?';

    $password = '';
    
    //append a character from each set - gets first 4 characters
    foreach ($sets as $set) {
        $password .= $set[array_rand(str_split($set))];
    }

    //use all characters to fill up to $len
    while(strlen($password) < $len) 
    {
        //get a random set
        $randomSet = $sets[array_rand($sets)];
        
        //add a random char from the random set
        $password .= $randomSet[array_rand(str_split($randomSet))]; 
    }
    
    //shuffle the password string before returning!
    return str_shuffle($password);
}
function randomID($len = 10) 
{

    //enforce min length 8
    if($len < 10)
        $len = 10;

    //define character libraries - remove ambiguous characters like iIl|1 0oO
    $sets = array();
    // $sets[] = 'ABCDEFGHJKLMNPQRSTUVWXYZ';
    // $sets[] = 'abcdefghjkmnpqrstuvwxyz';
    $sets[] = '0123456789';
    //$sets[]  = '~!@#$%^&*(){}[],./?';

    $password = '';
    
    //append a character from each set - gets first 4 characters
    foreach ($sets as $set) {
        $password .= $set[array_rand(str_split($set))];
    }

    //use all characters to fill up to $len
    while(strlen($password) < $len) {
        //get a random set
        $randomSet = $sets[array_rand($sets)];
        
        //add a random char from the random set
        $password .= $randomSet[array_rand(str_split($randomSet))]; 
    }
    
    //shuffle the password string before returning!
    return str_shuffle($password);
}

function send_sms($mobile,$message)
{
    $authKey = "36573A52iu3Oow5f881623P30";
    $senderId = "NEWMSG";
    $route = "default";
    $postData = array(
    'authkey' => $authKey,
    'mobiles' => $mobile,
    'message' => $message,
    'sender' => $senderId,
    'route' => $route
    );
    $url="http://fastsms.fastsmsindia.com/api/sendhttp.php";
    $ch = curl_init();
    curl_setopt_array($ch, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $postData
    ));
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $output = curl_exec($ch);
    curl_close($ch);
    //return $output;
}