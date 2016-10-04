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



else if($_POST['act']=="createmajalis")
{
	
$status   		= array('sucess' => 1, 'failure'=>0);
$data1 = json_decode($_POST[ 'data' ]);
$req = new userdataservice();
$res = $req->create_user($data1);
if($res != 0)
{

	$resp['status'] = "1";
   //echo json_encode($res);
//$res1 = ('status' => '1');
//$data = ($res1);
echo json_encode($resp);
}
else
{	
	$resp['status'] = "0";
   echo json_encode($resp);
//$res2 = ('status' => 0);
//$data = ($res2);
echo json_encode($resp);
}
}




        

/*  ********************* Code For Searching  Majalis *******************************************/

//urldecode(($_POST ['date']));
else if($_POST['act'] == "search")
	//else if($_POST['act']=="12")
{
if (isset($_POST["date"]))
{
  $event_date = urldecode(($_POST ['date']));
  //echo $event_date;
 } 
else
{
$event_date = null;
//echo $event_date;

}

if (isset($_POST["country"]))
{

$event_country =urldecode(($_POST ['country']));
//echo $event_country;
//echo "ram";
}
else
{
	$event_country=null;
	//$event_country="tata";
	//echo $event_country;
	//echo "ram";
}
  
if (isset($_POST["state"]))
{
$event_state  =urldecode(($_POST ['state']));
//echo $event_state;
//echo "TATA is ";

}
else
{
	$event_state=null;
	//echo $event_state;
	//echo "DOEACC";
}
if (isset($_POST["city"]))
{
$event_city  		=urldecode($_POST ['city']);



}
else
{
	$event_city=null;
	//echo "RAKEESH";
	//echo $city;
}

if (isset($_POST["para"]))
{
$para     					=urldecode($_POST ['para']);
//echo $para;
}
else
{
	$para=null;
	//echo $para;
}




				if($para == '') // For Default Search parameters
				 {
				$whereclause = "WHERE"." ";
				//echo $whereclause;
				
				//else 
				//{
				//	$whereclause=nulll;
				//}
				 if($event_date !="")
				{
				//echo $event_date;
				$where2= "`date` LIKE '%$event_date%' ";

				}
				else
				{
					$where2=null;

				}
				if($event_country != "") 
				{
				$where1= "`country` LIKE '%$event_country%' ";
				//echo $where1;
				}
				else
				{
					$where1=null;
				}
			
			
				if($event_state != "")
				{
				$where3 = "AND `sate` LIKE '%$event_state%'"; 
				//echo $where3;
				}
				else
				{
				$where3=null;	
				}
				if($event_city != "")
 				{
				$where4 = "AND  `city` LIKE '%$event_city%'"; 
				//echo $where4;
				}
				else
				{
					$where4=null;
				}
		
				
				//echo $where3;

				$wherenext = $where2.$where1.$where3.$where4;
			
//echo $wherenext;


		

 		if($wherenext == "" )
 			{
			$fwhere  = $whereclause."1";
 			}

 			
 			else
 			{
			// echo $fwhere;die();
			$fwhere  = $whereclause.$wherenext; 
			}
		
		
	}	
	else
		{
			
		$fwhere = $para;
		}


			$rev = new userdataservice();
			//echo $fwhere; 

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











