 <html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.2.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>




<link rel="stylesheet" type="text/css" href="<? echo base_url();?>style.css">

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


</head>
<body>

<nav class="navbar-fixed-top" id="na">








<ul>

<li> <a href="#home.php">Home</a> </li>
<li> <a href="<?php echo base_url('data/auth')?>">profile</a></li>
<li> <a href="<?php echo base_url('data/update')?>">update</a></li>
  <li> <a href="<?php echo base_url('data/updatepass')?>">updatepassword</a></li>
<!--<li> <a href="update.php?se=<?php echo    $_SESSION["update"]  ?> ">Update</a></li> -->
<li><a href="contact.php">contact us</a></li>
 <li> <a href="<?php echo base_url('data/loc')?>">Logout</a></li>
  </ul>

</nav><br />
</body>
</html>