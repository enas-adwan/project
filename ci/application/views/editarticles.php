
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

       </head>

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

            <li > <a style="color: white;" href="<?php echo base_url('User_controller/home')?>" >Home</a> </li>
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

        if( $this->session->deleted){

            // $msg = 'Your account has been made, <br /> please verify it by clicking the activation link that has been send to your email.';

             print ' <div id="h"  class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Success!</strong>  the article has been deleted
             </div> ';
$this->session->unset_userdata('deleted');

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

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">

                            <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>

                            <?php echo "<br><br>";
                            foreach ($articles as $news_item): ?>

                                    <h3><?php echo $news_item['title']; ?></h3>
                                    <div class="main">
                                            <?php echo $news_item['body']; ?>

                                    </div>
                                        <p><a href="<?php echo site_url('user_controller/deleteArticle/'.$news_item['id_article']); ?>">delete article</a></p>

                                <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
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
