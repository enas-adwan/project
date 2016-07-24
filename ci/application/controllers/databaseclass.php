<?php
class Databaseclass extends CI_Controller {
  function __construct() { 
         parent::__construct(); 
         $this->load->helper('url'); 
         $this->load->database(); 
      } 
     public function index() { 
         $query = $this->db->get("reg"); 
         $data['records'] = $query->result(); 
			
         $this->load->helper('url'); 
         $this->load->view('reg_view',$data); 
      } 







}






?>