
<Html>
<head>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript">
	
// var university = "";
// var data = '{"class_name":"Test Class3","start_date":"2016-02-15","end_date":"2016-02-16","user_id":"16","start_time":"09 am"}';


//var jsondata = {"id":505,"name":"nitin"};
var jsondata = {"name":"Dr Rakesh","phone_no":99379546,"address1":"Devria","address2":"GKP","country":"India","state":"UP","city":"Gorakhpur","pincode":273008,"zakisname":"tata","date":"2016-08-22","time":"3:45","type":1};

//`name`, `phone_no`, `address1`, `address2`, `country`, `state`, `city`, `pincode`, `zakisname`, `date`, `time`, `type`





var data = JSON.stringify(jsondata);
$.ajax({

    type: "POST",
    url: "user.php",
    dataType:"json",
    data: "act=createmajalis&data="+data,
    //data: "act=getresource&title",
//echo "ram",
   // dataType: "json",
    success: function(result) 
    {

    }
});
</script>
</head>
<form id="con" enctype='multipart/form-data' action="Image_upload.php" method="POST">
	<input type="file" name="eventImage">
    <input type="text" name="userid" value="16">
	<input name="submit" type="submit" value="Submit">
</form>
<body>
	
</body>
</html>