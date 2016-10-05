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
	   		while($row1 = mysql_fetch_assoc($validate))
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



else if($_REQUEST['act']=="createmajalis")
{
	
$status   		= array('sucess' => 1, 'failure'=>0);
$data1 = json_decode($_REQUEST[ 'data' ]);
$req = new userdataservice();
$res = $req->create_user($data1);
if($res != 0)
{

	$resp['status'] = "1";
   echo json_encode($resp);
}
else
{	
	$resp['status'] = "0";
  // echo json_encode($resp);
	echo json_encode($resp);
}
}




        

/*  ********************* Code For Searching  Majalis *******************************************/


else if($_REQUEST['act'] == "search")
	
 {
if (isset($_REQUEST["date"]))
 {
  $event_date = urldecode(($_REQUEST ['date']));
  } 
else
{
$event_date = null;
}
if (isset($_REQUEST["country"]))
{
$event_country =urldecode(($_REQUEST ['country']));
}
else
{
	$event_country=null;
}
if (isset($_REQUEST["state"]))
{
$event_state  =urldecode(($_REQUEST ['state']));
}
else
{
	$event_state=null;
	
}
if (isset($_REQUEST["city"]))
{
$event_city  		=urldecode($_REQUEST ['city']);
}
else
{
	$event_city=null;
	
}

if (isset($_REQUEST["para"]))
{
$para     					=urldecode($_REQUEST ['para']);

}
else
{
	$para=null;
}
				if($para == '') // For Default Search parameters
				 {
				$whereclause = "WHERE"." ";
				
				 if($event_date !="")
				{
				$where2="`date` LIKE '$event_date'";
				}
				else
				{
					$where2=null;
				}
				if($event_country != "") 
				{
				$where1= "AND `country` LIKE '%$event_country%' ";
				
				}
				else
				{
					
					$where1=null;
					
				}
			
			
				if($event_state != "")
				{
				$where3 = "AND `state` LIKE '%$event_state%'"; 
				
				}
				else
				{
				$where3=null;	
				}
				if($event_city != "")
 				{
				$where4 = "AND  `city` LIKE '%$event_city%'"; 
				
				}
				else
				{
					$where4=null;
				}
		
				$wherenext = $where2.$where1.$where3.$where4;
				//echo $wherenext;
		
 			if($wherenext == "" )
 			{
			$fwhere  = $whereclause."1";
 			}
 			else
 			{
			$fwhere  = $whereclause.$wherenext; 
			}
			}	
			else
			{
			$fwhere = $para;
			}
			$rev = new userdataservice();
			$res = $rev->event_search($fwhere);
			if($res != 0)
 			{
    			$data = array('data'=>$res , 'status'=>'1');
    		    echo json_encode($data);
    		}
    		else
   			{
    		$data = array('data'=>'0' , 'status'=>'0');
   			 echo json_encode($data);
   			}

}


?>











