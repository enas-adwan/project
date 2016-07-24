<?php


$name="anoos";
$id=$this->session->id;


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




   // $this->load->view('reg.php?action=logout');

 // }
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


<script type="text/javascript">
   function ajaxFunctionname(){




       jQuery.validator.addMethod("name2", function(value, element){
          if (/^[a-zA-Z0-9._-]{3,16}$/i.test(value)) {
              return true;
          } else {
              return false;
          };
      }, "name should be from 3to 15 char ");

      jQuery.validator.classRuleSettings.checkTotal = { name2: true };

    $.validator.addClassRules({
        changename : { name2 : true }
    });



       jQuery.validator.addMethod("namereq", function(value, element){
      if ( $('#changename').val() !='' ) {

          return true;
      } else {

        document.getElementById("nameerr").innerHTML="";
                    return false;

      };
      }, "you need to fill the field ");

      jQuery.validator.classRuleSettings.checkTotal = { namereq: true };

    $.validator.addClassRules({
        changename : { namereq : true }
    });







$( "#updatenameform" ).validate({
    rules: {

      changename: {

              required: true

              }
    }
    });}
  var frm = $('#updatenameform');

  $(function () {

    var frm = $('#updatenameform');


     var url="User_controller/changeNamee";
    frm.submit(function (ev) {
      	if (frm.valid()) {

        $.ajax({
            type: "POST",
            url:"<?php echo base_url() ?>"+url,
            data: frm.serialize(),
            success: function (data) {
          //  alert(data);
	 var responseArray = data.split("||");
 					 document.getElementById("nametext").innerHTML=responseArray[0];
 					 document.getElementById("nameerr").innerHTML=responseArray[1];
            }
        })};
      ev.preventDefault();
    });
});

</script>

<!--<script type="text/javascript">
  $(document).ready(function(){

    var dataString = $("#name").serialize();
    var url="Data/changenamee"
        $.ajax({
        type:"POST",
        url:"<?php echo base_url() ?>"+url,
        data:dataString,
        success:function (data) {
       	 var responseArray = ajaxRequest.responseText.split("||");
  							 document.getElementById("nametext").innerHTML=responseArray[0];
  							 document.getElementById("nameerr").innerHTML=responseArray[1];
        }
        });

  })
</script>-->
  <script>
    function ajaxFunctionemail(){




 jQuery.validator.addMethod("email2", function(value, element){
        if (/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/i.test(value)) {
            return true;
        } else {
            return false;
              document.getElementById("emailerr").innerHTML="";
                      };
    }, "Invalid email format");

    jQuery.validator.classRuleSettings.checkTotal = { email2: true };

  $.validator.addClassRules({
     changeemail : {email2: true }
  });



  /* $( "#updateemailform" ).validate({
     rules: {

       changeemail: {

               required: true

               }
     }
     });*/



     jQuery.validator.addMethod("emailreq", function(value, element){
           if ( $('#changeemail').val() !='' ) {
               return true;
           } else {

             document.getElementById("emailerr").innerHTML="";
                         return false;

           };
        }, "you need to fill the field");

        jQuery.validator.classRuleSettings.checkTotal = { emailreq: true };

      $.validator.addClassRules({
         changeemail : {emailreq: true }
      });
     }
    var frm = $('#updateemailform');

  $(function () {

    var frm = $('#updateemailform');


     var url="User_controller/changeEmail";
    frm.submit(function (ev) {
      	if (frm.valid()) {

        $.ajax({
            type: "POST",
            url:"<?php echo base_url() ?>"+url,
            data: frm.serialize(),
            success: function (data) {
          //  alert(data);
	 var responseArray = data.split("||");
 					 document.getElementById("emailtext").innerHTML=responseArray[0];
 					 document.getElementById("emailerr").innerHTML=responseArray[1];
            }
        })};
      ev.preventDefault();
    });
});

</script>


  <script language="javascript" type="text/javascript">

  //Browser Support Code
  function ajaxFunctionphone(){


   jQuery.validator.addMethod("phone1", function(value, element){
        if (/^00972-[0-9]{3}-[0-9]{3}-[0-9]{4}$/i.test(value)) {
            return true;
        } else {

          document.getElementById("phoneerr").innerHTML="";
                      return false;

        };
    }, "Invalid phone format"


    );


    jQuery.validator.classRuleSettings.checkTotal = { phone1: true };

  $.validator.addClassRules({
    changephone : {phone1: true }
  });






 /* $( "#updatephoneform" ).validate({


    rules: {

      changephone: {

              required: true

              }
    }
    });*/



 jQuery.validator.addMethod("phone2", function(value, element){
      if ( $('#changephone').val() !='' ) {
          return true;
      } else {

        document.getElementById("phoneerr").innerHTML="";
                    return false;

      };
  }, "you need to fill the field"


  );


  jQuery.validator.classRuleSettings.checkTotal = { phone2: true };

$.validator.addClassRules({
  changephone : {phone2: true }
});   }

 var frm = $('#updatephoneform');

  $(function () {

    var frm = $('#updatephoneform');


     var url="User_controller/changePhone";
    frm.submit(function (ev) {
      	if (frm.valid()) {

        $.ajax({
            type: "POST",
            url:"<?php echo base_url() ?>"+url,
            data: frm.serialize(),
            success: function (data) {
          //  alert(data);
	 var responseArray = data.split("||");
 					 document.getElementById("phonetext").innerHTML=responseArray[0];
 					 document.getElementById("phoneerr").innerHTML=responseArray[1];
            }
        })};
      ev.preventDefault();
    });
});

</script>


<script type="text/javascript">
$(document).ready(function (e) {
   var url="User_controller/changeImage";
$("#uploadimage").on('submit',(function(e) {
e.preventDefault();
$("#message").empty();
//$('#loading').show();
$.ajax({
  url:"<?php echo base_url() ?>"+url, // Url to which the request is send
type: "POST",             // Type of request to be send, called as method
data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
contentType: false,       // The content type used when sending data to the server.
cache: false,             // To unable request pages to be cached
processData:false,        // To send DOMDocument or non processed data file it is set to false
success: function(data)   // A function to be called if request succeeds
{
//$('#loading').hide();
$("#message").html(data);
//$('#previewing').attr('src', data.target.result);
}
});
}));

// Function to preview image after validation
$(function() {
$("#img").change(function() {
$("#message").empty(); // To remove the previous error message
var file = this.files[0];
var imagefile = file.type;
var match= ["image/jpeg","image/png","image/jpg"];
if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
{
//$('#previewing').attr('src','noimage.png');
$("#message").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
return false;
}
else
{
var reader = new FileReader();
reader.onload = imageIsLoaded;
reader.readAsDataURL(this.files[0]);
}
});
});
function imageIsLoaded(e) {
$("#img").css("color","green");

$('#previewing').attr('src', e.target.result);

};

});
</script>



   </head>
   <body>







<?php


        echo "<br /><br /><img  id='previewing' width='200' height='200' src='".base_url($image)."' alt='Profile Pic'>";
          // echo $image;
           //  }



               echo "Welcom  ";
         echo "  <span id='nametext' >$name</span> ";

                echo"<br />";
               echo "  <span id='emailtext' >$email</span> ";


                echo "<br />";
             echo "  <span id='phonetext' >$phone</span> ";



?>
<br>
<br>
 <!--<form method="get" id="updatenameform" name="updatenameform" action="" role="form"> -->
   <?php
  $info=array('id'=>'updatenameform',
              'name'=>'updatenameform',

              );


            echo form_open_multipart('User_controller/changeNamee',$info);
            ?>
         <?php   $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
);

?>

<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
           name:  <input type="text" class="form-control  required changename"  name="name" id="name"  >
              <br>
               <span class="error"  id="nameerr" name="nameerr" ></span>
         <?php echo form_error('name'); ?>


   <br>

      <input type="submit"  class="btn btn-default" onclick=" ajaxFunctionname()" id="updatename" value="update name "name="updatename"/><br />



     </form>

        <?php
  $info=array('id'=>'updateemailform',
              'name'=>'updateemailform',

              );


            echo form_open_multipart('User_controller/changeEmail',$info);
            ?>
         <?php   $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
);

?>

<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
           email:  <input type="text" class="form-control  required changeemail"  name="changeemail" id="changeemail"  >
              <br>
               <span class="error"  id="emailerr" name="emailerr" ></span>
         <?php echo form_error('changeemail'); ?>


   <br>

      <input type="submit"  class="btn btn-default" onclick=" ajaxFunctionemail()" id="updatemail" value="update email "name="updateemail"/><br />



     </form>
           <?php
  $info=array('id'=>'updatephoneform',
              'name'=>'updatephoneform',

              );


            echo form_open_multipart('User_controller/changePhone',$info);
            ?>
         <?php   $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
);

?>

<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
           phone:  <input type="tel" class="form-control  required changephone"  name="changephone" id="changephone"  >
              <br>
               <span class="error"  id="phoneerr" name="phoneerr" ></span>
         <?php echo form_error('changeemail'); ?>


   <br>

      <input type="submit"  class="btn btn-default" onclick=" ajaxFunctionphone()" id="updatephone" value="update email "name="updatephone"/><br />



     </form>
     <div class="main">

<hr>

   <?php
  $info=array('id'=>'uploadimage',
              'name'=>'uploadimage',

              );


            echo form_open_multipart('User_controller/changeImage',$info);
            ?>
         <?php   $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
);

?>

<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />

<div id="selectImage">
<label>Select Your Image</label><br/>
<input type="file" name="img" id="img" required accept="image/*" />
    <?php echo form_error('img'); ?>
<input type="submit" value="Upload"  value="update profile picture" class="submit" />
</div>
</form>
</div>

<div id="message"></div>

     </body>
     </html>
