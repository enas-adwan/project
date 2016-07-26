<?php
$empty="";

?>



<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

  <!-- jQuery library -->
  <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.2.min.js"></script>
  <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
  <script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script><!-- Latest compiled JavaScript -->
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


<link rel="stylesheet" type="text/css" href="<? echo base_url();?>style.css">

<script src="http://malsup.github.com/jquery.form.js"></script>
    <style>
  .error {color: #FF0000;}

  </style>
  <script language="javascript" type="text/javascript">

  //Browser Support Code
  function ajaxFunctionpasswordblur(){


jQuery.validator.addMethod("password3", function(value, element){
      if (/^[a-zA-Z0-9._-]{3,16}$/i.test(value)) {
          return true;
      } else {
          return false;
      };
  }, "password must be from 3 to 16 char");

  jQuery.validator.classRuleSettings.checkTotal = { password3: true };

$.validator.addClassRules({
   changepassword : {password3: true }
});





  $( "#updatepasswordform" ).validate({
    rules: {

      changepassword: {

              required: true

              },
             confirmnewpassord :{
      equalTo: "#newpassword"
            }

    }
    });
    }
     var frm = $('#updatepasswordform');

  $(function () {

    var frm = $('#updatepasswordform');


     var url="User_controller/changePassword";
    frm.submit(function (ev) {
      	if (frm.valid()) {

        $.ajax({
            type: "POST",
            url:"<?php echo base_url() ?>"+url,
            data: frm.serialize(),
            success: function (data) {
          //  alert(data);
	 var responseArray = data.split("||");

   							  document.getElementById("successorwrongtext").innerHTML=responseArray[0];

            }
        })};
      ev.preventDefault();
    });
});

  </script>
</head>
<body>

<br>
 <span id='successorwrongtext' ><? echo $empty; ?></span>
<br>
<br>
<h1><small>Change your password :</small></h1>
<br>
<br>
   <?php
  $info=array('id'=>'updatepasswordform',
              'name'=>'updatepasswordform',

              );


            echo form_open_multipart('User_controller/changePassword',$info);
            ?>
         <?php   $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
);

?>
  <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
       current password: <input type="password" name="changepassword"  onclick='ajaxFunctionpasswordblur()' id="changepassword" class="form-control required changepassword"   >
   <span id='passwordtext' class="error"><? echo $empty; ?></span>
    <br />
     new password: <input type="password" style="width:60%;" name="newpassword" id="newpassword" onclick='ajaxFunctionpasswordblur()' class="form-control required changepassword"  >
     <span id='newtext' class="error"><? echo $empty; ?></span>
     <br>
      confirm new password: <input type="password" style="width:60%;" name="confirmnewpassord" id="confirmnewpassword" onclick='ajaxFunctionpasswordblur()' class="form-control required  confirmnewpassord changepassword"  >
     <span id='confirmtext' class="error"><? echo $empty; ?></span>
     <br>




      <input type="submit"  class="btn btn-default" onclick='ajaxFunctionpasswordblur()' value="update password" id="updatepassword" name="updatepassword"/><br />


     </form>
     <br><br><br><br><br><br><br><br><br><br>



</body>
</hrml>
