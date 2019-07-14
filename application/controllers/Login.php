<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller{
public function __construct() {
parent::__construct();

if($this->session->userdata('nama_lengkap')){
redirect(base_url('Customer'));    
}

}



    public function index(){
$this->load->view('umum/V_header');
$this->load->view('V_login');    
}

public function proses_login(){
if($this->input->post()){
$input = $this->input->post();
$data = $this->db->get_where('data_customer',array('email_customer'=>$input['email'],'status'=>'online'))->row_array();
if(password_verify($input['password'],$data['password'])){
$sesi = array(
'nama_depan'        =>$data['nama_depan'],
'nama_belakang'     =>$data['nama_belakang'],
'nama_lengkap'      =>$data['nama_lengkap'],
'email'             =>$data['email'],
'alamat'            =>$data['alamat_lengkap'],
'no_kontak'         =>$data['no_kontak'],    
);
$this->session->set_userdata($sesi);    
redirect(base_url('Customer'));    
}else{
redirect($this->index());    
}
}else{
redirect(404);    
}        
}

}

