<?php
class Data extends CI_Controller{

   //counstruct function load all neccessary libraries and helpers
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
  }
    
    
   //functions to prevent html and xss injection
  public function test_input($data){
  
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data= strip_tags($data);
    $data=xss_clean($data);
    return $data;
  
  }
  
   //default function if login flag is set go directly to the profile page
  public function index(){
  
      if($this->session->loginflag==1){
        $this->auth();
	    base_url('data/auth');
	
       }
       else{  $this->load->view('reg');
         $this->load->view('footer');
       
       }

    }
    
	  
    //function for registraion (add user)
  public function add_user(){
    
     $this->form_validation->set_error_delimiters('<div class="error">', '</div>'); // Displaying Errors in Div
     $this->form_validation->set_rules('img', 'Img', 'callback_img_check');
     $this->form_validation->set_rules('name', 'Username', 'trim|required|alpha|min_length[3]|max_length[30]|is_unique[reg.name]|xss_clean');
     $this->form_validation->set_rules('email', 'Email ', 'trim|required|valid_email|is_unique[reg.email]');
	 $this->form_validation->set_rules('phone', 'Home Phone', 'required|regex_match[/^00972-[0-9]{3}-[0-9]{3}-[0-9]{4}$/i]|xss_clean');
	 $this->form_validation->set_rules('zipcode','zipcode','trim|required|min_length[5]|numeric|xss_clean');
	 $this->form_validation->set_rules('city', 'City', 'trim|required|max_length[30]|xss_clean');
	 $this->form_validation->set_rules('state', 'State', 'trim|required|max_length[30]|xss_clean');	
	 $this->form_validation->set_rules('birthday', 'Birthday', 'trim|required|max_length[30]|xss_clean');	
     $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[passwordconfirm]');
     $this->form_validation->set_rules('passwordconfirm', 'Confirm Password', 'trim|required');

       if ($this->form_validation->run() == FALSE) //if there is error load the page to show the error
        {
          $this->load->view('reg');

        }
        else {

          $config['upload_path'] ='./uploads/'; // for the profile photo path
          $this->upload->initialize($config); 
          $this->load->library('upload', $config);
          $data_upload_files = $this->upload->data();
          $image = $data_upload_files['full_path'];
          $email=$this->test_input($this->input->post('email'));
          $hash= random_string('unique');
          $password=$this->test_input($this->input->post('password'));
          $password= password_hash($password, PASSWORD_DEFAULT);
    
          $data=array(
            'name '=>$this->test_input($this->input->post('name')),
            'password '=>$password,
            'email '=>$email,
            'gender '=>$this->test_input($this->input->post('gender')),
            'phone '=>$this->test_input($this->input->post('phone')),
            'city '=>$this->test_input($this->input->post('city')),
            'state'=>$this->test_input($this->input->post('state')),
            'hash' => $hash,
            'birthday'=>$this->test_input($this->input->post('birthday')),
            'image'=>$this->test_input($image.$_FILES['img']['name'])
                    
             );
             
    	  $data = $this->security->xss_clean($data);
          $this->User_model->insert($data);//insert the data
          $this->emailver($email,$hash); //send a verfication email
 
  
        }
    
   }
   
     //function for sending email verfication
   public function emailver($email,$hash){
 
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
       
     '.base_url('data/verify').'?email='.$email.'&hash='.$hash.
    ''); 
     $this->email->send();
    
      $this->session->set_flashdata('verification', 'succesus');
       
     redirect('data/reg','refresh');
  
     
    }
    
   public function reg(){
   
      $this->load->view('reg');
       $this->load->view('footer');
   }
     
     
     //function for verify email
   public function verify(){
   
      if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
        $email = $_GET['email']; // Set email variable
        $hash = $_GET['hash'];  
        $this->User_model->updateactive($hash,$email);
       
   
          redirect('data/reg','refresh');
       }
      else{
    
     
       redirect('data/reg','refresh');
       }
      } 
	
  
    //login function(authintication)
   public function auth(){
        if($this->session->loginflag==1)//if login flag is set go to profilepage
        {
         $this->loguser();
        }
  
        else// if login flag not set then we need to see the email and the password
        {

          $this->form_validation->set_rules('email1', 'Email', 'required|valid_email'); // Validation for E-mail field.
          $this->form_validation->set_rules('password1', 'password', 'required'); 

           if ($this->form_validation->run() == FALSE) {
                $this->load->view('reg');
                  $this->load->view('footer');
           } 


           else{

               $password =$this->test_input($this->input->post('password1'));
               $email =$this->test_input($this->input->post('email1'));
               
               $this->User_model->authuser($email,$password);
               
                 if($this->session->loginflag==1){
                     $this->loguser();
                  }
  
                 else{
                     $this->load->view('reg');
                      $this->load->view('footer');
                 } 
  
           }
         }
      }
      
      
      	//function for show profile and userinfo
   public function loguser(){
      $email=$this->session->email;
	  $res=$this->User_model->selectinfo($email);
	  $data['res']=$res;
	  $this->load->view('loginheader');
	  
      $this->load->view('loguser', $data);
       $this->load->view('footer');
    }
    
  
       //function for the update page
    public function update(){
	   if($this->session->loginflag==1)// if login flag set go to it 
	   {
           $email=$this->session->email;
		   $res=$this->User_model->selectinfo($email);
		   $data['res']=$res;
		    $this->load->view('loginheader');
           $this->load->view('updatepage',$data);
                  $this->load->view('footer');
		 }
       else{  
        $this->load->view('reg');
         $this->load->view('footer');
       }//if login flag not set go to the registration and login page
		
	}
	
	// function for changephone
	public function changephone(){
	
		$id=$this->session->id;
		$email=$this->session->email;
	    $res=$this->User_model->selectinfo($email);
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
            }
           else {

        $newephone=$this->input->post('changephone');
        $this->User_model->changephone($id,$newephone);
        echo $newephone;
        echo " || ";
        echo"<span style='color:green'>updated successfuly</span>";
	        }
	
	}
	
	//function for change name
    public function changenamee(){
	
       $id=$this->session->id;
	   $email=$this->session->email;
	   $res=$this->User_model->selectinfo($email);
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

          }
         else {
         
        $newname=$this->input->post('name');
        $this->User_model->change($id,$newname);
        echo $newname;
        echo " || ";
        echo"<span style='color:green'>updated successfuly</span>";
          }

	}
	
	
	 //function for change email
	public function changeemail(){

	   $id=$this->session->id;
	   $email=$this->session->email;
	   $res=$this->User_model->selectinfo($email);
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

         }
         else {
           $newemail=$this->input->post('changeemail');
           $this->User_model->changeemail($id,$newemail);
           echo $newemail;
           echo " || ";
           echo"<span style='color:green'>updated successfuly</span>";

	      }
      }
      
      
       //function for change image
      public function changeimage(){

		 $id=$this->session->id;
		 $email=$this->session->email;
	     $res=$this->User_model->selectinfo($email);
	     $data['res']=$res;
            foreach ($res as $reso => $list) {
                    foreach ($res as $reso => $listt) {  
                       $image= $listt['image'] ;

                    }
                }

         $this->form_validation->set_error_delimiters('<div class="error">', '</div>'); // Displaying Errors in Div
         $this->form_validation->set_rules('img', 'Img', 'callback_img_check');
         
           if ($this->form_validation->run() == FALSE) {
               echo validation_errors();
            }
       else {

        $config['upload_path'] ='./uploads/'; 
        $this->upload->initialize($config); 
        $this->load->library('upload', $config);
        $data_upload_files = $this->upload->data();
        $image = $data_upload_files['full_path'];
        $image=$image.$_FILES['img']['name'];
        $this->User_model->changeimage($id,$image);

       }

     }

     // function for logout
    public function loc(){
         $this->session->sess_destroy();
         
         $this->load->view('reg');
          $this->load->view('footer');
     }
    
       //for checking image
    public function img_check(){
      $config['upload_path'] ='./uploads/'; 
      $config['allowed_types'] = 'gif|jpg|png|jpeg';
      $config['max_size'] = 1000;
      $this->upload->initialize($config); 
      $this->load->library('upload', $config);
      $data_upload_files = $this->upload->data();
      $image = $data_upload_files['full_path'];
        if (!$this->upload->do_upload('img')) {
           $this->form_validation->set_message('img_check', $this->upload->display_errors());
           return false;

        }  

        else{

            $this->upload_data['file'] =  $this->upload->data();
            return true;

        } 
   
      }
     // to show updatepass page
    public function updatepass(){
       if($this->session->loginflag==1){
        $this->load->view('loginheader');
         $this->load->view('updatepass');
          $this->load->view('footer');
         }
       else{  $this->load->view('reg');
       
       $this->load->view('footer');
        }
       }
     
       //to changepassword
     public function changepassword(){
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
		 }
        else {
             $currentpassword =$this->input->post('changepassword');
             $newpassword =$this->input->post('newpassword');
	         $id=$this->session->id;
             $sql = "SELECT password from reg where id=? ";
			 $query=$this->db->query($sql, $id);
             $row = $query->row();
 	         $password = 	$row->password;
 	        
               if(  password_verify($currentpassword,$password)){ 
                   $email=$this->session->email;
                   $this->User_model->changepassword($id,$newpassword);
                      print ' <br /><br /><br /><br /><div id="h2"  class="alert alert-success">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Success!</strong>  your password has been changed you can log in with your new password
                     </div> '; 
      
               }else{
                       print ' <br /><br /><br /><br /><div id="h2"  class="alert alert-danger">
                       <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Wrong!</strong>  wrong password please write your current password  properly
                    
                     
                    
                     </div> '; 
		
      
               }

	    }

    }
    
   
    
}




?>
