<?php
class Data extends CI_Controller{
  function __construct(){
    parent::construct();
    $this->load->helper("url");
    $this->load->database();
    
    
    
    
  }
  public function index(){
    $query=$this->database->get('reg');
    $data['records']=$query->result();
    $this->load->helper("url");
    $this->load->view('reg_view',$data);
    
    
  }
  
  
  
}




?>
