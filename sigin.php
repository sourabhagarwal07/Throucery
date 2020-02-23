{source}<!DOCTYPE html>
<html lang="en">
<head>
<title>Sign in page</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">

<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
<div class="form-group">
<label for="email">Username:</label>
<input type="text" class="form-control" id="email" placeholder="Enter Username/ Name" name="usr">
</div>
<div class="form-group">
<label for="pwd">Password:</label>
<input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd">
</div>
<button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>
</div>
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

if($results!=NULL)
{
echo "Succesfull Login";
print_r ($results);
}
else
{
echo "Error";
}
}

?>
</body>
</html>{/source}