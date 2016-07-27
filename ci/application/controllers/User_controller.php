<?php


class user_controller extends CI_Controller{
  /**
   * counstruct function load all neccessary libraries and helpers
   * @author Enas Adwan
    */
  function __construct(){

   parent::__construct();
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
   $this->load->helper('test');//helper done by me to test input to prevent script and html injection
  }






   /**
    * default function if login flag is set go directly to the profile page
    * @author Enas Adwan
     */
  public function index(){

      if($this->session->loginflag==1){
        $this->auth();
	    base_url('User_controller/auth');

       }
       else{  $this->load->view('reg');
         $this->load->view('footer');

       }

    }


    /**
     * function for registraion (add user)
     * @author Enas Adwan
      */
  public function addUser(){

     $this->form_validation->set_error_delimiters('<div class="error">', '</div>'); // Displaying Errors in Div
     $this->form_validation->set_rules('img', 'Img', 'callback_imgCheck');
     $this->form_validation->set_rules('name', 'Username', 'trim|required|alpha|min_length[3]|max_length[30]|is_unique[reg.name]|xss_clean');
     $this->form_validation->set_rules('email', 'Email ', 'trim|required|valid_email|is_unique[reg.email]');
	   $this->form_validation->set_rules('phone', 'Home Phone', 'required|regex_match[/^00972-[0-9]{3}-[0-9]{3}-[0-9]{4}$/i]|xss_clean');
	   $this->form_validation->set_rules('zipcode','zipcode','trim|required|min_length[5]|numeric|xss_clean');
	   $this->form_validation->set_rules('city', 'City', 'trim|required|max_length[30]|xss_clean');
	   $this->form_validation->set_rules('state', 'State', 'trim|required|max_length[30]|xss_clean');
	   $this->form_validation->set_rules('birthday', 'Birthday', 'trim|required|max_length[30]|xss_clean');
     $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[passwordconfirm]');
     $this->form_validation->set_rules('passwordconfirm', 'Confirm Password', 'trim|required');

       if ($this->form_validation->run() == FALSE){

            //if there is error load the page to show the error
          $this->load->view('reg');

       }else {

          $config['upload_path'] ='./uploads/'; // for the profile photo path
          $this->upload->initialize($config);
          $this->load->library('upload', $config);
          $data_upload_files = $this->upload->data();
          $image = $data_upload_files['full_path'];
          $email=testInput($this->input->post('email'));
          $hash= random_string('unique');
          $password=testInput($this->input->post('password'));
          $password= password_hash($password, PASSWORD_DEFAULT);

          $data=array(
            'name '=>testInput($this->input->post('name')),
            'password '=>$password,
            'email '=>$email,
            'gender '=>testInput($this->input->post('gender')),
            'phone '=>testInput($this->input->post('phone')),
            'city '=>testInput($this->input->post('city')),
            'state'=>testInput($this->input->post('state')),
            'hash' => $hash,
            'birthday'=>testInput($this->input->post('birthday')),
            'image'=>testInput($image.$_FILES['img']['name'])

             );

    	    $data = $this->security->xss_clean($data);
          $user_model_bool  =$this->User_model->insert($data);//insert the data
           if( !$user_model_bool){
            $this->load->view('reg');
           }
          $this->emailVerification($email,$hash); //send a verfication email


        }

   }


     /**
      * function for sending email verfication
      * @param string email and hash
      * @author Enas Adwan
       */

   public function emailVerification($email,$hash){

     $config['wordwrap'] = TRUE;
     $this->email->initialize($config);
     $this->email->from('enasadwansite');
     $this->email->to($email);
     $this->email->subject('signup اهلا وسهلا بكم');
     $this->email->message('
       Thanks for signing up!
       Your account has been created,
       you can login with the following credentials after you have activated your account by pressing the url below.
       اهلا وسهلا بكم
       م يرجى الضغط على الينك في الاسفل لتفعيل الحساب

       Please click this link to activate your account:

     '.base_url('User_controller/verify').'?email='.$email.'&hash='.$hash.
    '');
     $this->email->send();

      $this->session->set_flashdata('verification', 'succesus');

     redirect('User_controller/reg','refresh');


    }

   public function reg(){

       $this->load->view('reg');
       $this->load->view('footer');
   }



     /**
      * function for verify email
      * @author Enas Adwan
       */

   public function verify(){

      if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){

        $email = $_GET['email']; // Set email variable
        $hash = $_GET['hash'];
        $user_model_bool=$this->User_model->updateActive($hash,$email);
         if( !$user_model_bool){
          $this->load->view('reg');
         }


          redirect('User_controller/reg','refresh');
       }else{

        redirect('User_controller/reg','refresh');
       }
    }


      /**
       * login function(authintication)
       * @author Enas Adwan
        */

   public function auth(){
        if($this->session->loginflag==1){//if login flag is set go to profilepage

         $this->loginUser();
        }else{// if login flag not set then we need to see the email and the password


          $this->form_validation->set_rules('email1', 'Email', 'required|valid_email'); // Validation for E-mail field.
          $this->form_validation->set_rules('password1', 'password', 'required');

           if ($this->form_validation->run() == FALSE) {
                $this->load->view('reg');
                  $this->load->view('footer');
           }else{

               $password =testInput($this->input->post('password1'));
               $email =testInput($this->input->post('email1'));

               $user_model_bool= $this->User_model->authUser($email,$password);
                if( !$user_model_bool){
                  $this->load->view('reg');
                }
                 if($this->session->loginflag==1){
                     $this->loginUser();
                  }else{
                     $this->load->view('reg');
                      $this->load->view('footer');
                  }

             }
          }
      }


      /**
       * function for show profile and userinfo
       * @author Enas Adwan
        */

   public function loginUser(){
      $email=$this->session->email;
	  $res=$this->User_model->selectInfo($email);
	  $data['res']=$res;
	  $this->load->view('loginheader');

      $this->load->view('loguser', $data);
       $this->load->view('footer');
    }

    /**
     * function for the update page
     * @author Enas Adwan
      */

    public function update(){
	   if($this->session->loginflag==1)  {// if login flag set go to it

       $email=$this->session->email;
		   $res=$this->User_model->selectInfo($email);
		   $data['res']=$res;
		   $this->load->view('loginheader');
       $this->load->view('updatepage',$data);
       $this->load->view('footer');

		 }else{
         $this->load->view('reg');
         $this->load->view('footer');
       }//if login flag not set go to the registration and login page

	}


  /**
   *function for changephone
   * @author Enas Adwan
    */

	public function changePhone(){

	  	$id=$this->session->id;
	  	$email=$this->session->email;
	    $res=$this->User_model->selectInfo($email);
	  	$data['res']=$res;
           foreach ($res as $reso => $list) {
             foreach ($res as $reso => $listt) {

                $phone= $listt['phone'] ;

             }
          }

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	    $this->form_validation->set_rules('changephone', 'Phone No.', 'required|regex_match[/^00972-[0-9]{3}-[0-9]{3}-[0-9]{4}$/]');

           if ($this->form_validation->run() == FALSE) {
             echo $phone;// echo the old one
             echo "||";
             echo validation_errors();// echo the error using Ajax
            }else {

        $newephone=$this->input->post('changephone');
        $user_model_bool=$this->User_model->changePhone($id,$newephone);
        if( !$user_model_bool){
         $this->load->view('reg');
        }
        echo $newephone;
        echo " || ";
        echo"<span style='color:green'>updated successfuly</span>";
	         }

	}


  /**
   * function for change name
   * @author Enas Adwan
    */

    public function changeNamee(){

       $id=$this->session->id;
	     $email=$this->session->email;
	     $res=$this->User_model->selectInfo($email);
	     $data['res']=$res;
          foreach ($res as $reso => $list) {
            foreach ($res as $reso => $listt) {
               $name= $listt['name'] ;
             }
            }

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	      $this->form_validation->set_rules('name', 'name', 'required|is_unique[reg.name]');

         if ($this->form_validation->run() == FALSE) {
           echo $name;
           echo "||";
           echo validation_errors();

          }else {

        $newname=$this->input->post('name');
        $this->User_model->change($id,$newname);
        echo $newname;
        echo " || ";
        echo"<span style='color:green'>updated successfuly</span>";
          }

	}



   /**
    * function for change email
    * @author Enas Adwan
     */

	public function changeEmail(){

	   $id=$this->session->id;
	   $email=$this->session->email;
	   $res=$this->User_model->selectInfo($email);
	   $data['res']=$res;
         foreach ($res as $reso => $list) {
             foreach ($res as $reso => $listt) {
       $email= $listt['email'] ;
              }
          }

       $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	   $this->form_validation->set_rules('changeemail', 'changeemail', 'required|is_unique[reg.email]|valid_email');

         if ($this->form_validation->run() == FALSE) {
           echo $email;
           echo "||";
           echo validation_errors();

         }else {
           $newemail=$this->input->post('changeemail');
           $user_model_bool=$this->User_model->changeEmail($id,$newemail);
           if( !$user_model_bool){
            $this->load->view('reg');
           }
           echo $newemail;
           echo " || ";
           echo"<span style='color:green'>updated successfuly</span>";

	      }
      }


      /**
       * function for change image
       * @author Enas Adwan
        */


      public function changeImage(){

		   $id=$this->session->id;
		   $email=$this->session->email;
	     $res=$this->User_model->selectInfo($email);
	     $data['res']=$res;
            foreach ($res as $reso => $list) {
                    foreach ($res as $reso => $listt) {
                       $image= $listt['image'] ;

                    }
                }

         $this->form_validation->set_error_delimiters('<div class="error">', '</div>'); // Displaying Errors in Div
         $this->form_validation->set_rules('img', 'Img', 'callback_imgCheck');

           if ($this->form_validation->run() == FALSE) {
               echo validation_errors();
            }else {

        $config['upload_path'] ='./uploads/';
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        $data_upload_files = $this->upload->data();
        $image = $data_upload_files['full_path'];
        $image=$image.$_FILES['img']['name'];
        $this->User_model->changeImage($id,$image);

       }

     }


     /**
      * function for logout
      * @author Enas Adwan
       */

    public function loc(){
         $this->session->sess_destroy();

         $this->load->view('reg');
          $this->load->view('footer');
     }


       /**
        * for checking image
        * @author Enas Adwan
         */
    public function imgCheck(){
      $config['upload_path'] ='./uploads/';
      $config['allowed_types'] = 'gif|jpg|png|jpeg';
      $config['max_size'] = 1000;
      $this->upload->initialize($config);
      $this->load->library('upload', $config);
      $data_upload_files = $this->upload->data();
      $image = $data_upload_files['full_path'];
        if (!$this->upload->do_upload('img')) {
           $this->form_validation->set_message('imgCheck', $this->upload->display_errors());
           return false;

        }else{

            $this->upload_data['file'] =  $this->upload->data();
            return true;

        }

      }



         /**
          * to show updatepass page
          * @author Enas Adwan
           */

    public function updatePass(){
       if($this->session->loginflag==1){
        $this->load->view('loginheader');
         $this->load->view('updatepass');
          $this->load->view('footer');
         }else{  $this->load->view('reg');

       $this->load->view('footer');
        }
       }
       public function authorPanel(){
          if($this->session->loginflag==1){
          // $this->load->view('loginheader');
           $this->load->view('authorpanel');

            // $this->load->view('footer');
            }else{  $this->load->view('reg');

          $this->load->view('footer');
           }
          }

          public function addArticle(){
             if($this->session->loginflag==1){
             // $this->load->view('loginheader');
              $this->load->view('addarticle');

               // $this->load->view('footer');
               }else{  $this->load->view('reg');

             $this->load->view('footer');
              }
             }
             public function addArticleLogic(){
                if($this->session->loginflag==1){
                // $this->load->view('loginheader');
                       $id=$this->session->id;
                       $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
                	   $this->form_validation->set_rules('title', 'title', 'required');
                     $this->form_validation->set_rules('content', 'content', 'required');
                     $this->form_validation->set_rules('img', 'Img', 'callback_imgCheck');

                         if ($this->form_validation->run() == FALSE) {

                          $this->load->view('addarticle');

                         }else {
                           $config['upload_path'] ='./uploads/';
                           $this->upload->initialize($config);
                           $this->load->library('upload', $config);
                           $data_upload_files = $this->upload->data();
                           $image = $data_upload_files['full_path'];
                           $image=$image.$_FILES['img']['name'];

                           $this->User_model->changeImage($id,$image);



  $this->load->view('addarticle');
  $id=$this->session->id;
   $slug = url_title($this->input->post('title'), 'dash', TRUE);
 $data=array(
   'title '=>testInput($this->input->post('title')),
   'body'=>testInput($this->input->post('content')),
    'id'=>$id,


    );

$title=testInput($this->input->post('title'));
$data = $this->security->xss_clean($data);
//insert the data
$user_model_bool  =$this->User_model->addArticle($data);
$this->User_model->getID_article($title);
	$id_article=$this->session->id_article;
  $data=array(
    'id_article '=>	$id_article,
    'image'=>$image,


     );
$this->User_model->insertImage($data);
$this->load->view('addarticle');

                        //    $this->session->i= $i;
            /*  for ($k = 0; $k < count($_FILES['img']['name']); $k++) {
                $config['upload_path'] ='./uploads/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = 1000;
                $this->upload->initialize($config);
                $this->load->library('upload', $config);
                //$image[$k]=$_FILES['img']['name'][$k];
                $image[$k]=$_FILES['img']['name'][$k];
                $data_upload_files = $this->upload->data($image[$k]);
                $data_upload_files= array('img' => $this->upload->data());


                $image[$k] = $data_upload_files['full_path'];}

                        /*   $config['upload_path'] ='./uploads/';
                           $this->upload->initialize($config);
                           $this->load->library('upload', $config);

                           $data_upload_files = $this->upload->do_upload('img');
                         $image[ $k] = $data_upload_files['full_path'];
                        $image[$k]=$image[$k].$_FILES['img']['name'];
                            $data_upload_files = $this->upload->do_upload( $image[$k]);
                       $k++;

                     }*/
/*
                     $this->load->library('upload');

    $files = $_FILES;
    $cpt = count($_FILES['img']['name']);
    for($i=0; $i<$cpt; $i++)
     foreach($files as $key=>$value)
    {
      if($i==0){
       $this->session->m0=$value['name'][0];}
       if($i==1){
        $this->session->m1=$value['name'][1];}
        $_FILES['img']['name']= $value['name'][$i];
        $_FILES['img']['type']= $value['type'][$i];
        $_FILES['img']['tmp_name']= $value['tmp_name'][$i];
      //  $_FILES['img']['error']= $files['img']['error'][$i];
        //$_FILES['img']['size']= $files['img']['size'][$i];

        $this->upload->initialize($this->set_upload_options());
        $data_upload_files = $this->upload->data($_FILES['img']['name']);
        $image = $data_upload_files['full_path'];
      //  $this->upload->do_upload($_FILES['img']['name']);
        $this->session->m= $i;
          $this->load->view('addarticle');


}*/
}
}
}
              //  $this->session->m0=$image[0];
            //   $this->session->m1=$image[1];

                  //  $this->session->m= $k;


public function home(){
  $this->load->view('loginheader');

$data['articles']=$this->User_model->selectArticle();

$this->load->view('articles',$data);
   $this->load->view('footer');
}

public function editArticles(){


$data['articles']=$this->User_model->selectArticle();

$this->load->view('editarticles',$data);

}

public function deleteArticle($id){

$this->User_model->deleteArticle($id);

}

public function set_upload_options()
{
    //upload an image options
    $config = array();
    $config['upload_path'] = './uploads/';
    $config['allowed_types'] = 'gif|jpg|png';


    //$config['overwrite']     = FALSE;

    return $config;
}


/*public function imgChecks(){
    for ($k = 0; $k < count($_FILES['img']['name']); $k++) {
  $config['upload_path'] ='./uploads/';
  $config['allowed_types'] = 'gif|jpg|png|jpeg';
  $config['max_size'] = 1000;
  $this->upload->initialize($config);
  $this->load->library('upload', $config);
  $data_upload_files = $this->upload->data('img',$k);
  $image = $data_upload_files['full_path'];
    if (!$this->upload->do_upload('img')) {
       $this->form_validation->set_message('imgCheck', $this->upload->display_errors());
       return false;

    }else{

        $this->upload_data['file'] =  $this->upload->data();
        return true;

    }}
    $this->session->m0=$image[0];
   $this->session->m1=$image[1];

     $this->session->m= $k;

  }*/

//$images = array();

   /*foreach ( $_FILES['img'] as $key => $image) {
       $_FILES['img']['name']=  $_FILES['name'][$key];
       //$_FILES['img']['type']=  $_FILES'type'][$key];
       $_FILES['img']['tmp_name']=  $_FILES['tmp_name'][$key];


       $fileName = $title .'_'. $image;

       $img[] = $fileName;

       $config['file_name'] = $fileName;
       $config['upload_path'] ='./uploads/';
       $this->upload->initialize($config);



       if ($this->upload->do_upload('img')) {
           $this->upload->data();
       }}*
                            $id=$this->session->id;
                           $data=array(
                             'title '=>testInput($this->input->post('title')),
                             'body'=>testInput($this->input->post('content')),
                              'id'=>$id,

                              );


                          $data = $this->security->xss_clean($data);
                    //insert the data
                    $user_model_bool  =$this->User_model->addArticle($data);
                    $this->load->view('addarticle');

                            if( !$user_model_bool){
                             $this->load->view('reg');
                            }



                  // $this->load->view('footer');
                 }
                  }else{  $this->load->view('reg');

                $this->load->view('footer');
                 }
                }




       /**
        * to changepassword
        * @author Enas Adwan
         */
     public function changePassword(){
       $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	   $this->form_validation->set_rules('changepassword', 'changepassword', 'required|min_length[3]|max_length[15]');
	   $this->form_validation->set_rules('newpassword', 'newpassword', 'required|min_length[3]|max_length[15]');
	   $this->form_validation->set_rules('confirmnewpassord', 'confirmnewpassword', 'required|min_length[3]|max_length[15]|matches[newpassword]');

         if ($this->form_validation->run() == FALSE) {
           echo"<br>";
           print ' <br /><br /><br /><br /><div id="h2"  class="alert alert-danger">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Wrong!</strong>  '.validation_errors().'



                     </div> ';
		     }else {
             $currentpassword =$this->input->post('changepassword');
             $newpassword =$this->input->post('newpassword');
	           $id=$this->session->id;
             $sql = "SELECT password from reg where id=? ";
			       $query=$this->db->query($sql, $id);
             $row = $query->row();
 	           $password = 	$row->password;

               if(  password_verify($currentpassword,$password)){
                   $email=$this->session->email;
                   $user_model_bool=$this->User_model->changePassword($id,$newpassword);
                      print ' <br /><br /><br /><br /><div id="h2"  class="alert alert-success">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Success!</strong>  your password has been changed you can log in with your new password
                     </div> ';
                     if( !$user_model_bool){
                       $this->load->view('reg');
                     }

               }else{
                       print ' <br /><br /><br /><br /><div id="h2"  class="alert alert-danger">
                       <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Wrong!</strong>  wrong password please write your current password  properly



                     </div> ';


               }

	       }

    }



}
