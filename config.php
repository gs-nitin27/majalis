<?php
$con = mysql_connect('localhost','root','');
if($con)
{
$selected = mysql_select_db('majalis_database')  or die("Database is not selected   ram " );
}
else
{
echo "Could no Connected Database";
} 
?>