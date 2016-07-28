
<?php
$this->session->updateid=$news_item['id_article'] ;
$image=$news_item['image'];

?>

<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">




    <html>

   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

   <!-- jQuery library -->
   <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.2.min.js"></script>

   <!-- Latest compiled JavaScript -->
   <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>




   <link rel="stylesheet" type="text/css" href="<? echo base_url();?>css/simple-sidebar.css">
    <link rel="stylesheet" type="text/css" href="<? echo base_url();?>css/bootstrap.min.css">

   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
   <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

   <style>
 .error {color: #FF0000;}

 </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

  <nav class="navbar navbar-inverse" style="background-color: gray;">
    <div class="container-fluid">

      <ul class="nav navbar-nav">

        <li > <a style="color: white;" href="<?php echo base_url('User_controller/home')?>">Home</a> </li>
        <li> <a style="color: white;" href="<?php echo base_url('User_controller/auth')?>">profile</a></li>
        <li> <a style="color: white;" href="<?php echo base_url('User_controller/update')?>">update</a></li>
        <li> <a style="color: white;" href="<?php echo base_url('User_controller/updatepass')?>">updatepassword</a></li>
        <li> <a style="color: white;" href="<?php echo base_url('User_controller/authorPanel')?>">Author Panel</a></li>
        <!--<li> <a href="update.php?se=<?php echo    $_SESSION["update"]  ?> ">Update</a></li> -->
        <li><a style="color: white;" href="contact.php">contact us</a></li>

        <li> <a style="color: white; " href="<?php echo base_url('User_controller/loc')?>">Logout</a></li>

      </ul>
    </div>
  </nav>
  <div>
    <?php

    if( $this->session->updated){

         $msg = 'Your account has been made, <br /> please verify it by clicking the activation link that has been send to your email.';

         print ' <div id="h"  class="alert alert-success">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         <strong>Success!</strong>  the article has been updated
         </div> ';
$this->session->unset_userdata('updated');

    }
    ?>
  </div>

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                      Author Panel
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('User_controller/addArticle')?>">Add Article</a>
                </li>
                <li>
                        <a href="<?php echo base_url('User_controller/editArticles')?>">Delete Articles</a>
                </li>
                <li>
                    <a href="<?php echo base_url('User_controller/authorViewArticle')?>">Edit your Articles</a>
                </li>
                <li>
                    <a href="#">Events</a>
                </li>
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
        	&nbsp; 	&nbsp; 	&nbsp;
          <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                      <h1 class="page-header">Update your Article</h1>
                      <?php
                    //  $info=array('id'=>'reg',
                                //  'name'=>'reg'
                                //  );


                              //  echo form_open_multipart('User_controller/updateArticleelement/$news_item['id_article'] ');
                          echo form_open_multipart(site_url('user_controller/updateArticleelement/'.$news_item['id_article']));
                                ?>

                 <div class="form-group">
                   <label for="title">Title</label>
                   <input type="text"  id="title" name="title" value="<?php echo $news_item['title'] ;?>" class="form-control">
                     <?php echo form_error('title'); ?>
                 </div>
                 <div class="row">
                   <div class="col-xs-12 col-sm-7 col-md-9">
                     <div class="form-group">
                       <textarea name="content" id="content" style="width:100% ; height:500px ;" ><?php echo $news_item['body'] ;?></textarea>
                       <script>CKEDITOR.replace('content');</script>
                         <?php echo form_error('content'); ?>
                     </div>
                   </div>
                   <div class="col-xs-5 col-md-3">
                     <div class="form-group">


                     </div>

                     <div class="form-group">
                       <label for="image">Image</label>
                       <input type="file" id="image" class="form-control"  name="img" value="<?php echo $news_item['image'] ;?>"/>
                         <?php echo form_error('img'); ?>
                              <button type="submit" class="btn btn-primary" >Publish</button>
                       <p class="help-block">Image definitions</p>
                     </div>
                     <a href="#" class="thumbnail">

                       <img    src="<?php echo base_url($image); ?>">
                     </a>

                  <!--   <a href="#" class="thumbnail">
                       <img src="http://fakeimg.pl/300/">
                     </a>-->
                   </div>
                 </div>

                    </div>
                </div>
            </div>
        </div>
      </form>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>




</body>
</html>
