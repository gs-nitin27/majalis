<?php
include('config.php');
include('userdataservice.php');

/*****************************************CODE FOR USER REGISTRATION****************************/

if($_REQUEST['act']=="register")
{

	 $name       =	urldecode($_POST ['name']);
	 $email      =	urldecode($_POST ['email']);
 	 $password1  =	md5(urldecode($_POST ['password']));
  	 $phone_no   =	urldecode($_POST ['phone_no']);
 	 $where  	 =	"WHERE `email` = '".$email."'";
 	 $req        =	new userdataservice();
 	 $res        =	$req->userVarify($where);
 	 $data       =	array('name'=>$name,'email'=>$email,'password'=> $password1,'phone_no'=>$phone_no);
  	 if($res != 0)
 	 {
	 $status = array('status' => 0, 'message' => 'User is  already Registered');
	 echo json_encode($status); 
 	 }
	 else
	 {
	 $req1 = new userdataservice();
	 $res1 = $req1->User_register($data);
	 if($res1 == '1')
	 {
	 $req2 = new userdataservice();
	 $res2 = $req2->userVarify($where);
	 if($res2 != 0)
	 {
	 $res3 = array('data' => $res2,'status' => 1);
	 echo json_encode($res3);  
	 }
	 }
	 else
	 {
	 $res3 = array('data' => 'record not saved','status' => 0);
	 echo json_encode($res3);  
	 }
	 }
}	

/********************************** Code For  Log In *********************************************/


	else if($_REQUEST['act']=="login")
	{
		$status   		= array('sucess' => 1, 'failure'=>0);
		$email   	 	= urldecode($_REQUEST['email']);
		$pass    		= md5(urldecode($_REQUEST['password']));
		$username 		= mysql_real_escape_string($email);
		$password 		= mysql_real_escape_string($pass);
        //$data       =	array('email'=>$email,'password'=> $password1);   
		//$req1 = new userdataservice();
		// $res1 = $req1->User_login($data);
		//if($res1 == '1')
		// {

		$validate = mysql_query("SELECT `name`,`email`,`password`,`phone_no` FROM `maj_signup` WHERE `email` = '$email' AND `password` = '$password' ");
	   		$row 	= mysql_num_rows($validate);
	   	   	if ($row == 1)
	   		{
	   		while($row1 = mysql_fetch_assoc($validate) )
	   		{								
	    	
	    	$res1 = array('data' => $row1,'status' => 1);
		 	echo json_encode($res1); 
			}
			}
	  		else 
	  		{
	   		$res2 = array('data' => 'Invalid login credentials','status' => 0);
		 	echo json_encode($res2); 
			}
	}


/*  ****************************** Code For Create Majalis *******************************************/



else if($_POST['act']=="createmajalis")
{
	
$status = array('FAILURE' => 0 , 'SUCCESS' => 1);
$data1 = json_decode($_POST[ 'data' ]);
$req = new userdataservice();
//$res = $req->create_user($item);
$res = $req->create_user($data1);
if($res != 0)
{
echo json_encode($status['SUCCESS']);
}
else
{	
echo json_encode($status['FAILURE']);
}
}

?>











