<?php
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

$results1=$db->loadObject();

if($results!=NULL)
{
    if(($results[0]=="Admin")&&($results[1]=="admin"))
    {
echo "<html><head></head>";
echo "<body>";
echo "<p>Hello User ".$email." Welcome Admin to throucery</p>";
echo "<a href='#'><button>Logout</button></a>";
echo "<table><th>Id</th><th>Name</th><th>email</th><th>Contact</th>";
foreach ($results1 as $row)
{
echo "<tr><td>".$row->U_ID."</td><td>".$row->U_NAME."</td><td>".$row->U_EMAIL."</td><td>".$row->U_NUMBER."</td></tr>";
}
echo "</table>";
echo "</body>";
echo "</html>";
print_r ($results);
    }
    else
    {
        echo "<html><head></head>";
        echo "<body>";
        echo "<p>Hello User ".$email." Welcome user to throucery</p>";
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

?>