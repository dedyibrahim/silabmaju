<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Loginadmin extends CI_Controller{
public function __construct() {
parent::__construct();
 if($this->session->userdata('id_user')){
        redirect(base_url('Menu'));   
    } 

}
public function index(){
$this->load->view('umum/V_header');
$this->load->view('V_login_admin');    
}

public function proses_login(){
if($this->input->post()){
$input = $this->input->post();
$data = $this->db->get_where('data_user',array('username'=>$input['username'],'status'=>'Aktif'))->row_array();

if(password_verify($input['password'],$data['password'])){
$sesi = array(
'id_user'           =>$data['id_user'],
'nama_depan'        =>$data['nama_depan'],
'nama_belakang'     =>$data['nama_belakang'],
'nama_lengkap'      =>$data['nama_lengkap'],
'level_pekerjaan'    =>$data['level_pekerjaan'],
);
$this->session->set_userdata($sesi);    
redirect(base_url('Menu'));    
}else{
redirect(base_url('Loginadmin'));    
}
}else{
redirect(base_url('Loginadmin'));    
}
        
}

}

