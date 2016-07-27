<?php
echo "<br><br>";
defined('BASEPATH') OR exit('No direct script access allowed');
class News extends CI_Controller {
	public function goarab()
	{
		$this->load->view('news');
	}
}




?>
