<?php

defined('BASEPATH') OR exit('No direct script access allowed');
 function testInput($data){

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data= strip_tags($data);
    $data=xss_clean($data);
    return $data;

  }

