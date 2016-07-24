<?php
  //handling error class
class dbconerr extends Exception{
	     //for error handling
	  public function processError($err) {
				
		 error_log($err,1,
         "enasadwan1@gmail.com","From: enasadwan1@gmail.com");
		 $this->session->databaseerr=1;
         $this->load->view('reg');
      }
	
 }
 
 
  //class for  data
class user_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->library('session');	
	}

	  //for inserting data
	public function insert($data){
    $insert=$this->db->insert('reg',$data);
	if($insert){
			return true ;
		}
	{
		try{
         if(!$insert){
			
			throw new dbconerr();

         }}
		catch (dbconerr $e){
			
				$err="something happen while connect to the server please try again later  ";
			
        $e->processError($err);
			
			
		}
	}
}


      //to change name
    public function change($id,$namechange){
    
	    $sql=" UPDATE reg SET name=? where id=?";
	    $query=$this->db->query($sql,array( $namechange,$id));
		     return true ;
	 }
	 
	 
	 //to change email
     public function changeemail($id,$newemail){
	    $sql=" UPDATE reg SET email=? where id=?";
	    $query=$this->db->query($sql,array( $newemail,$id));
		  return true ;
	}
	

       //to change phone
    public function changephone($id,$newphone){
	    $sql=" UPDATE reg SET phone=? where id=?";
	    $query=$this->db->query($sql,array( $newphone,$id));
	      return true ;
	 }
	 
	 
	 
	  //to change image
     public function changeimage($id,$image){

        $sql=" UPDATE reg SET image=? where id=?";
	    $query=$this->db->query($sql,array( $image,$id));
	    	return true ;
      }
      
      
        //to change updateactive
      public function updateactive($hash,$email){
      
         $sql = "SELECT name,image,active from reg where email=? && hash=?";
		 $query=$this->db->query($sql, array( $email, $hash));
		 
            if($query){
			    $row = $query->row();
			    if($row){
	            $active=$row->active;
		           if($active==0){
		                $sql2=" UPDATE reg SET active=1 where email=?";
			            $this->db->query($sql2, $email);
                        $this->session->set_flashdata('verificationdone', 'succesus');
                        return true ;
                     }
			        else{
	                   return true;
	                 }
			
			      }
			else{
		
		   return true;
	         }
			 }else{
		       return true;
	          }
          }
          
          
          
             //function for getting data
       public function selectinfo($email){
           $sql = "SELECT name,image,phone,email from reg where id=? ";
		   $id=$this->session->id;					 
           $query=$this->db->query($sql, $id);
           $row = $query->row();
	       $res[]=	array(
               'name' => 	$row->name,
                'email' => $row->email,
                'image' =>$row->image,
	            'phone' => $row->phone
                  );

              return $res;
				
		}
		
		
		 // to change password
	   public function changepassword($id,$newpassword){
	        $newpassword=password_hash($newpassword, PASSWORD_BCRYPT);
		    $sql=" UPDATE reg SET password=? where id=?";
	        $query=$this->db->query($sql,array( $newpassword,$id));
	          return true ;
	    }
	    
	    
	         // function for login
        public function authuser($email,$password){
             $sql1 = "SELECT password from reg where email=? ";
             $query=$this->db->query($sql1,  $email);
             $row1 = $query->row();
             
             if($row1){
                $passworddatabase=$row1->password;
                
                if(password_verify($password, $passworddatabase)){
                  $sql = "SELECT name,image,active,id from reg where email=? ";
				  $query=$this->db->query($sql,  $email);
				  
                      if($query){
			             $row = $query->row();
			                if($row){
			                  $this->session->id=$row->id;
				              $this->session->email=$email;
				              $this->session->loginflag=1;
                               return 1;
				             }else{
				        
					          $this->session->notauthenticate=1;
					          return 0;
					        }
				
				      }else{
					    $this->session->notauthenticate=1;
					    return 0;
					
				       }	
	
	           }else{
	
		           $this->session->wrongpassword=1;
					return 0;
					}
	
	     	}else{
					 $this->session->notauthenticate=1;
					return 0;
					
			}	
	     }
  }






?> 