<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<?php

if(isset($_POST['submit']))

{
echo ('
<div class="alert alert-success">
<p><strong>Success!</strong> Your Order has been placed successfully.</p>
<p>Use this order Id: <strong>'.uniqid().'</strong> to track your order.</p>
</div>
');

}
?>
</body>
</html>