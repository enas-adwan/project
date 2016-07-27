<html>
<head>


</style><meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.2.min.js"></script>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script><!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="<? echo base_url();?>style.css">



</head>
<body>

<nav class="navbar-fixed-top" id="na">


<ul>
  <li > <a style="color: white;" href="<?php echo base_url('User_controller/homeforall')?>">Home</a> </li>
<li > <a style="color: white;" href="<?php echo base_url('User_controller')?>">Registration and login</a> </li>
<li>  <a href="contact.php">Contact us</a></li>
</ul>
</nav>


<?php echo "<br><br>";
foreach ($articles as $news_item): ?>

       <h3><?php echo $news_item['title']; ?></h3>
     <div class="main">
    <?php echo $news_item['body']; ?>
                <br>
            Author:    <?php echo $news_item['name']; ?>

        </div>
  <p><a href="<?php echo site_url('user_controller/'.$news_item['slug']); ?>">View all article</a></p>

    <?php endforeach; ?>


</body>
</html>
