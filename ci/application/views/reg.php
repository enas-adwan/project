<?php



$loginErr="";

$msg=$name=$password=$passwordconfirm=$email=$gender=$birthday=$phone=$city=$state="";



if( $this->session->flashdata('verification')){

$msg = 'Your account has been made, <br /> please verify it by clicking the activation link that has been send to your email.';

   print '<br /><br /><br /><br /> <div id="h"  class="alert alert-success">
     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
     <strong>Success!</strong>  ' . $msg . '



    </div> ';

 }
 if( $this->session->flashdata( 'verificationdone')){

	       $msg="your account has been activated";
           print ' <br /><br /><br /><br /><br /><div id="h"  class="alert alert-success">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Success!</strong>  ' . $msg . '



            </div> ';


 }
  if($this->session->databaseerr==1){


    print ' <br /><br /><br /><br /><div id="h2"  class="alert alert-danger fade in">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Error!!</strong>  '.$err.'
																						    <br>
																						a msg has been sent to the adminstration about this error please try later!
																						thanks for your patient



                     </div> ';

		$this->session->unset_userdata('databaseerr');



 }

 if($this->session->notauthenticate==1){

	$loginErr="you are not authinticated";

	$this->session->unset_userdata('notauthenticate');

 }

 if( $this->session->wrongpassword==1){
 	$loginErr="wrong password";

	$this->session->unset_userdata('wrongpassword');

 }




?>









<html>
<head>
  <style>
.error {color: #FF0000;}

</style><meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.2.min.js"></script>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script><!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="<? echo base_url();?>style.css">

<script>






$(document).tooltip({ selector: "[title]",
                              placement: "right",
                              trigger: "focus",
                              animation: false});

                             </script>




<script >
$(document).ready( function() {




    /*  jQuery.validator.addMethod("name1", function(value, element){
         if (/^[a-zA-Z0-9._-]{3,16}$/i.test(value)) {
             return true;
         } else {
             return false;
         };
     }, "name should be from 3to 15 char");

     jQuery.validator.classRuleSettings.checkTotal = { name1: true };

   $.validator.addClassRules({
       name : { name1 : true }
   }); */
    jQuery.validator.addMethod("email2", function(value, element){
         if (/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/i.test(value)) {
             return true;
         } else {
             return false;
         };
     }, "Invalid email format");

     jQuery.validator.classRuleSettings.checkTotal = { email2: true };

   $.validator.addClassRules({
      email : {email2: true }
   });

  jQuery.validator.addMethod("password3", function(value, element){
        if (/^[a-zA-Z0-9._-]{3,16}$/i.test(value)) {
            return true;
        } else {
            return false;
        };
    }, "password must be from 3 to 16 char");

    jQuery.validator.classRuleSettings.checkTotal = { password3: true };

  $.validator.addClassRules({
     password : {password3: true }
  });




   jQuery.validator.addMethod("phone1", function(value, element){
        if (/^00972-[0-9]{3}-[0-9]{3}-[0-9]{4}$/i.test(value)) {
            return true;
        } else {
            return false;
        };
    }, "Invalid phone format");

    jQuery.validator.classRuleSettings.checkTotal = { phone1: true };

  $.validator.addClassRules({
    phone : {phone1: true }
  });


   jQuery.validator.addMethod("stateval", function(value, element){
        if (/^[a-zA-Z ]*$/i.test(value)) {
            return true;
        } else {
            return false;
        };
    }, "Invalid state format must be only letters");

    jQuery.validator.classRuleSettings.checkTotal = { stateval: true };

  $.validator.addClassRules({
    state : {stateval: true }
  });

 jQuery.validator.addMethod("cityval", function(value, element){
      if (/^[a-zA-Z ]*$/i.test(value)) {

                return true;
      } else {
          return false;
      };
  }, "Invalid city must only be letters");

  jQuery.validator.classRuleSettings.checkTotal = { cityval: true };

$.validator.addClassRules({
  city : {cityval: true }
});










  $( "#reg" ).validate({
    rules: {
      name: {
        required: true

      },
      email: {

              required: true

              },
     password: {
        required: true

      },
      passwordconfirm :{
      equalTo: "#password"
            }
    },
    messages: {
     name: {
        required: "name required!"
      },
     email: {
        required: "email required!"

      },
     password: {
        required: "password required"
      },

     passwordconfirm: {
        required: "confirm password required"
      } ,

      phone: {
         required: "phone number required"
       }


    }
  });









});


</script>

<script >

$(document).ready( function() {
$( "#log" ).validate({
  rules: {

    email1: {

            required: true

            },
   password1: {
      required: true

    }
  },
  messages: {

   email1: {
      required: "email required!"

    },
   password1: {
      required: "password required"
    }
  }
  });
});







</script>


   <script>
            $(function() {

                $(document).ready( function()
                {


                });

                // OnKeyDown Function
                $("#zipcode").keyup(function() {
                    var zip_in = $(this);
                    var zip_box = $('#zipbox');

                    if (zip_in.val().length<5)
                    {
                        zip_box.removeClass('error success');
                    }
                    else if ( zip_in.val().length>5)
                    {
                        zip_box.addClass('error').removeClass('success');
                    }
                    else if ((zip_in.val().length == 5) )
                    {

                        // Make HTTP Request
                        $.ajax({
                            url: "http://api.zippopotam.us/us/" + zip_in.val(),
                            cache: false,
                            dataType: "json",
                            type: "GET",
                          success: function(result, success) {
                                // Make the city and state boxes visible


                                // US Zip Code Records Officially Map to only 1 Primary Location
                                places = result['places'][0];
                                $("#city").val(places['place name']);
                                $("#state").val(places['state']);
                                zip_box.addClass('success').removeClass('error');
                            },
                            error: function(result, success) {
                                zip_box.removeClass('success').addClass('error');
                            }
                        });
                    }
            });
        });

    </script>



</head>
<body>



<nav class="navbar-fixed-top" id="na">


<ul>
<li> <a href="home.php">Home</a> </li>
<li> <a href="regandlog.php">Registration and Login</a></li>
<li>  <a href="contact.php">Contact us</a></li>
</ul>
</nav>




<div class="row" id="row">

<!--<div id="h"  class="alert alert-success">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> <?php echo $msg; ?>
title="Only charecters allowed in your name "
title="write a proper email you will need it for verfication"
title="Password must contain at least one number one letter and one caps"
title="Rewrite your password"
title="Write Full Palestinian format 00972-xxx-xxx-xxxx" </div> -->
  <div class="col-sm-6" id="col" >




 <h4 > <img src="<?php echo base_url('sign.png'); ?>"  alt="sign up" width="50" height="50"/> &nbsp;  Regestration Form : </h4>

  <?php
  $info=array('id'=>'reg',
              'name'=>'reg'
              );


            echo form_open_multipart('User_controller/addUser',$info);
            ?>
         *Name: <input type="text" class="form-control required name" title="write your full name" name="name" value="<?PHP print $name; ?>"id="name"  >
         <?php echo form_error('name'); ?>


        <br />
        *Email: <input type="email"  id="email"class="form-control required email" title="write a proper email you will need it for verfication" value="<?PHP print $email; ?>"  name="email"  >
          <?php echo form_error('email'); ?>
<br>
   *Password: <input type="password" value="<?PHP print $password; ?>" name="password" id="password"class="form-control required password" title="write your password" id="usr" >
     <?php echo form_error('password'); ?>
<br>
       *Confirm password: <input type="password" name="passwordconfirm" id="passwordconfirm"value="<?PHP echo $passwordconfirm;?>" class="form-control required passwordconfirm"  title="Rewrite your password"   >
         <?php echo form_error('passwordconfirm'); ?>
 <br />
       *Phone: <input placeholder="00972-xxx-xxx-xxxx"type="tel" class="form-control required phone" value="<?PHP echo $phone;?>" name="phone" title="Write Full Palestinian format 00972-xxx-xxx-xxxx" id="phone" >
         <?php echo form_error('phone'); ?>

       <br />       *Birthday:
       <input type="date" class="form-control required" id="birthday" name="birthday">
        <?php echo form_error('birthday'); ?>
          <br />
              Profile Picture:
<input type="file" class="form-control" id="usr" name="img">
<?php echo form_error('img'); ?>
 <br />

     To fill the state and city automatically:
     <br />
      ZipCode: <input type="text" class="form-control zipcode "  name="zipcode" id="zipcode" title="write your country zipcode"  >
  </span>
      <br />
      <?php echo form_error('zipcode'); ?>
     OR write your city and state :
         <br />
         *City: <input type="text" class="form-control city required "  name="city" id="city"  value="<?PHP echo $city;?>"   >
           <?php echo form_error('city'); ?>

             <br />
 *State: <input type="text" name="state" id="state" class="form-control state required "  value="<?PHP echo $state;?>" >
   <?php echo form_error('state'); ?>

      <br /><!-- *Gender: &nbsp; &nbsp;
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female " checked="yes">Female &nbsp; &nbsp; <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male-->

  Gender:
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female " >Female
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male" checked="yes">Male
  <br />

                  <button type="submit" id="submit" name="submit" class="btn btn-default">Submit</button>
                </div>



  <div class="col-sm-6"  id="col3" >


  <h4 ><img  src="<?php echo base_url('log.png'); ?>" alt="sign up" width="50" height="50" /> &nbsp;  Login Form : </h4>
  </form>

		  <?php
  $att=array('id'=>'log',
              'name'=>'log'
              );


            echo form_open('User_controller/auth',$att);
            ?>

  email:<input type="email" id="email1" class="form-control required email"  value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>" name="email1" />
  <br />
  password:<input type="password" id="password1" class="form-control required password" name="password1" value="<?php if(isset($_COOKIE["member_password"])) { echo$_COOKIE["member_password"]; } ?>" />

<!--<div class="checkbox">
  <label><input type="checkbox" name="remember" value="1"  <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> >Remember Me</label><br />
  <a href="forgetpassword.php">Forget Password ?</a>
</div>-->
<br>
<span class="error"><?php echo $loginErr;?></span>
  <br />

      <input type="submit"  class="btn btn-default" name="submit2" value="log in" /><br />


  </form>


  </div></div>








</body>







</html>
