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
				 return false ;

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

		}}	catch (dbconerr $e){

				$err="something happen while connect to the server please try again later  ";

        $e->processError($err);


		}
	}
}
public function insertImage($data){
				$insert=$this->db->insert('imagees',$data);



		}

public function addArticle($data){

  $insert=$this->db->insert('articles',$data);
if($insert){
		return true ;
	}
{
	try{
			 if(!$insert){

		throw new dbconerr();

	}}	catch (dbconerr $e){

			$err="something happen while connect to the server please try again later  ";

			$e->processError($err);


	}
}
}
public function updateArticleElement($res){

	foreach ($res as $reso => $list) {
		foreach ($res as $reso => $listt) {

			$id=$listt['id'];
			//$title=$listt['title'];
			$body=$listt['body'];
			$slug=$listt['slug'];
			$title=$listt['title'];

			$sql=" UPDATE articles SET title=?,body=?,slug=? WHERE id_article=?";
			$query=$this->db->query($sql,array( $title,$body,$slug,$id));

		 }
	 }


//  $insert=$this->db->insert('articles',$data);
/*if($insert){
		return true ;
	}
{
	try{
			 if(!$insert){

		throw new dbconerr();

	}}	catch (dbconerr $e){

			$err="something happen while connect to the server please try again later  ";

			$e->processError($err);


	}
}*/

}
public function updateArticleImage($ress){

	foreach ($ress as $reso => $list) {
		foreach ($ress as $reso => $listt) {

			$id=$listt['id_article'];
			//$title=$listt['title'];
			$img=$listt['image'];

		  $sql=" UPDATE imagees SET image=? where id_article=?";
			$query=$this->db->query($sql,array( $img,$id));

}}
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

				 try{
							 if(!$query){

					       throw new dbconerr();
                 return true ;
				 }}	catch (dbconerr $e){

						  $err="something happen while connect to the server please try again later  ";

							$e->processError($err);


				 }

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

			try{
						if(!$query){

							throw new dbconerr();
							return true ;
			}}	catch (dbconerr $e){

					 $err="something happen while connect to the server please try again later  ";

					 $e->processError($err);


			}
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

				try{
							if(!$query){

								throw new dbconerr();
								return true ;
				}}	catch (dbconerr $e){

						 $err="something happen while connect to the server please try again later  ";

						 $e->processError($err);


				}
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
				try{
							if(!$query){

								throw new dbconerr();
								 return true ;
				}}	catch (dbconerr $e){

						 $err="something happen while connect to the server please try again later  ";

						 $e->processError($err);


				}
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
                     }else{
	                   return false;
	                   }

			          }	else{

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
				public function selectArticle($slug = FALSE){

        if ($slug === FALSE)
        {
$id=$this->session->id;
					$this->db->select('*');
					$this->db->from('articles');
					$this->db->join('reg', 'reg.id = articles.id');
			//		$this->db->join('imagees', 'imagees.id_article = articles.id_article');
				$this->db->where('reg.id', $id);
						//$this->db->select('title, body,id_article ,id,slug');

				//	$query = $this->db->get('articles');

$query = $this->db->get();
									return $query->result_array();
        }
				$this->db->select('*');
				$this->db->from('articles');

					$this->db->join('imagees', 'imagees.id_article = articles.id_article');
				$this->db->where('articles.slug', $slug);
				$query = $this->db->get();

      //  $query = $this->db->get_where('articles', array('slug' => $slug));
        return $query->row_array();







//$query = $this->db->get_where('articles', array('slug' => $slug));
//return $query->row_array();


				 }
        public function selectAllImage($slug = FALSE){
					$this->db->select('*');
					$this->db->from('imagees');

					$this->db->join('articles', 'articles.id_article = imagees.id_article');
					//	 $this->db->where('images.id_article', $id);
						  $this->db->where('articles.slug', $slug);
				//	$this->db->where('articles.user_id', $user_id);
						//$this->db->select('title, body,id_article ,id,slug');

				//	$query = $this->db->get('articles');

 $query = $this->db->get();
									return $query->result_array();

				}



				 public function selectArticleall($slug = FALSE){

					if ($slug === FALSE)
					{
					 $this->db->select('*');
					 $this->db->from('articles');
					 $this->db->join('reg', 'reg.id = articles.id');
					// $this->db->join('imagees', 'imagees.id_article = articles.id_article');
				 //	$this->db->where('articles.user_id', $user_id);
						 //$this->db->select('title, body,id_article ,id,slug');

				 //	$query = $this->db->get('articles');

	$query = $this->db->get();
									 return $query->result_array();
					}
				 $this->db->select('*');
				 $this->db->from('articles');

					// $this->db->join('imagees', 'imagees.id_article = articles.id_article');
				 $this->db->where('articles.slug', $slug);
				 $query = $this->db->get();

				//  $query = $this->db->get_where('articles', array('slug' => $slug));
					return $query->row_array();







	//$query = $this->db->get_where('articles', array('slug' => $slug));
	//return $query->row_array();


					}
					public function updateArticle($id){
						$this->db->select('*');
						$this->db->from('articles');

							$this->db->join('imagees', 'imagees.id_article = articles.id_article');
						$this->db->where('articles.id_article', $id);
						$query = $this->db->get();

					//  $query = $this->db->get_where('articles', array('slug' => $slug));
						return $query->row_array();

 }


				 public function deleteArticle($id){
					 $this->db->query('DELETE   FROM imagees
WHERE imagees.id_article= '.$id.'');
$this->db->query('DELETE   FROM articles
WHERE articles.id_article= '.$id.'');
}
					/* $this->db->select('*');
 $this->db->from('articles');
$this->db->join('imagees', 'imagees.id_article = articles.id_article');
 $this->db->where( 'imagees.id_article = articles.id_article');
 $this->db->delete('articles', 'imagees ');
 return true;

//$this->db->where('articles.id_article', $id);
	// $this->db->join('imagees', 'imagees.id_article = articles.id_article');
	//->db->delete('articles', array('id_article' => $id));
//$this->db->delete('imagees', array('id_article' => $id));
			//		 $this->db->delete('articles');
				//	 $this->db->where( 'imagees.id_article = articles.id_article');
				//	  $this->db->delete('imagees');
					 //$this->db->from('articles');
				//	 $this->db->join('imagees', 'imagees.id_article = articles.id_article');

				// $this->db->where('articles.id_article', $id);
						 //$this->db->select('title, body,id_article ,id,slug');

				 //	$query = $this->db->get('articles');

	            //  $query = $this->db->get();

					}







	//$query = $this->db->get_where('articles', array('slug' => $slug));
	//return $query->row_array();








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

						try{
									if(!query){

										throw new dbconerr();
										return true ;
						}}	catch (dbconerr $e){

								 $err="something happen while connect to the server please try again later  ";

								 $e->processError($err);


						}
	    }

			public function getID_article($title){
				$sql = "SELECT id_article from articles where title = ?";

				$query=$this->db->query($sql, $title);
				$row = $query->row();
					$this->session->id_article= $row->id_article;



	 					try{
	 								if(!$query){

	 									throw new dbconerr();
	 									return true ;
	 					}}	catch (dbconerr $e){

	 							 $err="something happen while connect to the server please try again later  ";

	 							 $e->processError($err);


	 					}
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
                               return true;
				              }else{

					              $this->session->notauthenticate=1;
					               return false;
					            }

				           }else{
					            $this->session->notauthenticate=1;
					            return false;

				           }

	              }else{

		              $this->session->wrongpassword=1;
				        	return false;
				 	       }

	          	}else{
					    $this->session->notauthenticate=1;
					    return false;

		       	}
	     }
  }
