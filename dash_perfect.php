{source}<?php
if(isset($_POST['submit']))
{
defined('_JEXEC') or die('Restricted Access');
$db = JFactory::getDbo();
$query=$db->getQuery(true);

$app = JFactory::getApplication();
$input = $app->input;
$password = $input->POST->get('pswd', 'password');
$email = $input->POST->get('usr', 'username');

$query->select($db->quoteName(array(U_NAME,U_PASSWORD)));

$query->from($db->quoteName('NEW_USER'));

$query->where($db->quoteName(U_PASSWORD).'='.$db->quote($password).'AND'.$db->quoteName(U_NAME).'='.$db->quote($email));

$db->setQuery($query);

$results= $db->loadRow();


$query->clear('where');

$query->clear('select')->select('*');

$db->setQuery($query);

$results1=$db->loadAssocList();


$query->clear('select')->select('*');

$query->clear('from')->from($db->quoteName('COUPON'));

$db->setQuery($query);

$results2=$db->loadAssocList();


$query->clear('select')->select($db->quoteName('COUPON_IMG'));

$query->order('RAND() LIMIT 1');

$db->setQuery($query);

$result3=$db->loadAssoc();


if($results!=NULL)
{
if(($results[0]=="Admin")&&($results[1]=="admin"))
{
echo "<html>
<head>
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
</head>";
echo "<body>";
echo "<p>Hello ".$email." Welcome to throucery</p>";
echo "<div class='container'>";
echo "<table class='table table-striped' style='border:2px solid black;'>";
echo "<thead><th>Id</th><th>Name</th><th>email</th><th>Contact</th></thead>";
echo "<tbody>";
foreach ($results1 as $row)
{
echo "<tr><td>".$row['U_ID']."</td><td>".$row['U_NAME']."</td><td>".$row['U_EMAIL']."</td><td>".$row['U_NUMBER']."</td></tr>";
}
echo "</tbody>";
echo "</table> <br> <br>";

echo "<div class='container'>";
echo "<table class='table table-striped' style='border:2px solid black;'>";
echo "<thead><th>Id</th><th>Coupon ID</th><th>Coupon</th></thead>";
echo "<tbody>";
foreach ($results2 as $row)
{
header("Content-type: image/jpg");
echo "<tr><td>".$row['ID']."</td><td>".$row['COUPON_ID']."</td><td>
<img src='data:image/jpg;base64,".base64_encode($row['COUPON_IMG'])."'/></td></tr>";
}
echo "</tbody>";
echo "</table> <br> <br>";

echo "<a href='#'><button>Logout</button></a>";
echo "</body>";
echo "</html>";
}
else
{
echo "<html><head></head>";
echo "<body>";
echo "<p>Hello User ".$email." Welcome user to throucery</p>";
echo "<table><tbody>";
echo "<tr><td><p>As for our customer we are providing an exciting offer. Do checkout and continue shopping with us!!</p></td>";
echo "<td><img src='data:image/jpg;base64,".base64_encode($result3['COUPON_IMG'])."'/></td></tr>";
echo "</tbody></table>";
echo "<a href='#'><button>Logout</button></a>";
echo "</body>";
echo "</html>"; 
}
}
else
{
echo "Error";
}
}

?>{/source}