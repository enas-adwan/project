<?php

    $this->load->helper("url");
    $this->load->database();
    $this->load->library('upload');
    $this->load->helper('security');
    $this->load->helper('string');
    $this->load->library('email');
    $this->load->helper('form');
    $this->load->library('session');
    $this->load->model('User_model');
    $this->load->library('form_validation');


 // if( $this->session->loginflag){


          //echo $data;

    foreach ($res as $reso => $list) {
      foreach ($res as $reso => $listt) {

             $name= $listt['name'] ;
             $email=$listt['email'] ;
             $image=$listt['image'];
             $phone=$listt['phone'];
       }
     }


 echo"<br>";

   // $this->load->view('reg.php?action=logout');

 // }
?>

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

<img src="<?php echo base_url($image); ?>"  alt="sign up" width="200" height="200"/>
<?php



       echo "  Welcom  ";

       echo $name;
       echo"<br />";
       echo $email;
       echo "<br />";
       echo $phone;
?>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</body>


</html>
