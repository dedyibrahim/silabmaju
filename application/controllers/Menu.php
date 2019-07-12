<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Menu extends CI_Controller {
    
public function index(){
$this->load->view('umum/V_header');
$this->load->view('V_menu');    
}
    
    
}