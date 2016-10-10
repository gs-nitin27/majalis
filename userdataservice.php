<?php 
  class userdataservice 
  {
/********** Code for check the existing user while registration*************/ 

  public function userVarify($where)
  {
     $query  = mysql_query("SELECT `name`,`email`,`password`,`phone_no` FROM `maj_signup` ".$where);
  if(mysql_num_rows($query)>0)
  {
  while($row = mysql_fetch_assoc($query))
  {
  $data = $row;
  }
  return $data;
  }
  else 
  {
    return 0;
  }
  }
  /**************  Code of  Sign UP  *****************************/ 
  public function User_register($data)
  {
     $name         =  $data['name'];
     $email        =  $data['email'];
     $password     =  $data['password'];
     $phone_no     =  $data['phone_no'];
     $query = mysql_query("INSERT into `maj_signup`(`name`,`email`,`password`,`phone_no`) values('$name','$email','$password','$phone_no')");
     if($query)
     {
          return 1;
     }
     else
     {    
          return 0;
     }  
     }

/*******************Code of  Create user ****************************/

public function create_user($item)
{
 
  $query = mysql_query("INSERT INTO `maj_create`(`name`, `phone_no`, `address1`, `address2`, `country`, `state`, `city`, `pincode`, `zakisname`, `date`, `time`, `type`) VALUES ('$item->name','$item->phone_no','$item->address1','$item->address2','$item->country','$item->state','$item->city','$item->pincode','$item->zakisname','$item->date','$item->time','$item->type' ) ON DUPLICATE KEY UPDATE `name` ='$item->name', `phone_no` = '$item->phone_no',`address1` = '$item->address1' ,`address2` = '$item->address2' ,`country` = '$item->country' ,`state` = '$item->state' , `city` = '$item->city' , `pincode` = '$item->pincode' , `zakisname` = '$item->zakisname' , `date` = '$item->date',`time` = '$item->time' ,`type` = '$item->type'");

  if($query)
  return true;
  else
  return false;
}

/******************Code of  Searching the Event**************************/

public function event_search($fwhere)
  {
     $query = mysql_query("SELECT  IFNull(`name`,'') AS name, IFNull(`phone_no`,'') AS phone_no, IFNull(`address1`,'') AS address1 , IFNull(`address2`,'') AS address2,IFNull(`country`,'') AS country,IFNull(`state`,'') AS state,IFNull(`city`,'') AS city,IFNull(`pincode`,'') AS pincode,IFNull(`zakisname`,'') AS zakisname,IFNull(`date`,'') AS date,IFNull(`time`,'') AS time,IFNull(`type`,'') AS type FROM `maj_create`".$fwhere."");
 $query1 = $query;
if(mysql_num_rows($query1) > 0)
{
while($row = mysql_fetch_assoc($query1))
{
$rows[] = $row;
}
  return $rows;
} 
else
{
  return 0;
}
}

/*******************Code of  Show the Country State and city********************/

public function place_search($fwhere)
{
  $query = mysql_query("SELECT  id,IFNull(`name`,'') AS name FROM ".$fwhere."");
  if(mysql_num_rows($query) > 0)
  {
  while($row = mysql_fetch_assoc($query))
  {
  $data[]= $row; 
  }
  return $data;
  } 
  else
  {
  return 0;
  }
}  










    

























/*public function search_place($fwhere)
  {
   // echo $fwhere;
    //echo "SELECT  IFNull(`name`,'') AS name FROM `countries`".$fwhere."";
     $query = mysql_query("SELECT  IFNull(`name`,'') AS country  FROM `countries`".$fwhere."");
 
$query1 = $query;
//echo $query1; die();
if(mysql_num_rows($query1) > 0)
{
while($row = mysql_fetch_assoc($query1))
{
$rows[] = $row;
//echo $rows;
}
  
  return $rows;
} 
else
{
  return 0;
}
}
*/
















}




?>