<?php


	/**
	 * handling error class
	 * @author Enas Adwan
		*/
class dbconerr extends Exception{
	     //for error handling
	  public function processError($err) {

		 error_log($err,1,
         "enasadwan1@gmail.com","From: enasadwan1@gmail.com");
		 $this->session->databaseerr=1;
         $this->load->view('reg');
      }

 }



	/**
	 * class for  data
	 * @author Enas Adwan
		*/
class user_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->library('session');
	}


		/**
		 * for inserting data
		 * @param array data
		 * @author Enas Adwan
			*/
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



			/**
			 * to change name
			 * @param int id string namechange
			 * @return true or false
			 * @author Enas Adwan
				*/
    public function change($id,$namechange){

	    $sql=" UPDATE reg SET name=? where id=?";
	    $query=$this->db->query($sql,array( $namechange,$id));
		     return true ;
	 }



	 /**
		* to change email
		* @param int id string newemail
		* @return true or false
		* @author Enas Adwan
		 */
     public function changeEmail($id,$newemail){
	    $sql=" UPDATE reg SET email=? where id=?";
	    $query=$this->db->query($sql,array( $newemail,$id));
		  return true ;
	}



			 /**
			 * to change phone
			 * @param int id string newphone
			 * @return true or false
			 * @author Enas Adwan
				*/
    public function changePhone($id,$newphone){
	    $sql=" UPDATE reg SET phone=? where id=?";
	    $query=$this->db->query($sql,array( $newphone,$id));
	      return true ;
	 }




		/**
		* to change image
		* @param int id string image
		* @return true or false
		* @author Enas Adwan
		 */
     public function changeImage($id,$image){

        $sql=" UPDATE reg SET image=? where id=?";
	    $query=$this->db->query($sql,array( $image,$id));
	    	return true ;
      }



				/**
				* to change active
				* @param string hash string email
				* @return true or false
				* @author Enas Adwan
				 */
      public function updateActive($hash,$email){

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
	                   return false;
	                 }

			      }
			else{

		   return false;
	         }
			 }else{
		       return false;
	          }
          }




						 /**
						 * function for getting data
						 * @param  email
						 * @return array res
						 * @author Enas Adwan
							*/
       public function selectInfo($email){
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



		 /**
			* to change password
			* @param int id string newpassword
			* @return true or false
			* @author Enas Adwan
			 */
	   public function changepassword($id,$newpassword){
	        $newpassword=password_hash($newpassword, PASSWORD_BCRYPT);
		    $sql=" UPDATE reg SET password=? where id=?";
	        $query=$this->db->query($sql,array( $newpassword,$id));
	          return true ;
	    }



					 /**
						* function for login
						* @param string email  string password
						* @return true or false
						* @author Enas Adwan
						 */
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
