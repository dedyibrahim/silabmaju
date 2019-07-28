<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Menu extends CI_Controller {
public function __construct() {
parent::__construct();


if(!$this->session->userdata('id_user')){
redirect(base_url('Loginadmin'));   
}    
}


public function index(){
$this->load->view('umum/V_header');
$this->load->view('V_menu');    
}

public function cek_akses(){
if($this->input->post()){
$input = $this->input->post();
$sesi = $this->session->userdata();

if($sesi['level_pekerjaan'] == 'Super Admin'){
$status = array(
'status'    =>'success',
);         
}else if($sesi['level_pekerjaan'] != $input['level']){
$status = array(
'status'    =>'error',
'message'   =>'Anda tidak memiliki hak akses'
); 
}else{
$status = array(
'status'    =>'success',
);     
}

echo json_encode($status);


}else{
redirect(404);    
}
    
    
}
    
    
}