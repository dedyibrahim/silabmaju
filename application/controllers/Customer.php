<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
public function __construct() {
    parent::__construct();
$this->load->model('M_pengaturan_user');
$this->load->library('Datatables');
$this->load->library('email');
if(!$this->session->userdata('nama_lengkap')){
redirect(base_url('Login'));    
}
}

public function index(){
$this->input_anamnesa();   
}

public function input_anamnesa(){
$this->load->view('umum/V_header');
$this->load->view('Customer/V_input_anamnesa');    
}

public function simpan_sampel(){
if($this->input->post()){
$input = $this->input->post();

$data = array(
'jenis_sampel'      =>$input['jenis_sampel'],
'berat_sampel'      =>$input['berat_sampel'],
'deskripsi_sampel'  =>$input['deskripsi_sampel'],
'gejala'            =>$input['gejala'],
'tgl_input'         =>date('Y/m/d'),    
'asal_sampel'       =>$input['asal_sampel'],
);

$this->db->insert('data_sampel',$data);
$status = array(
'status'    =>'success',
'message'   =>'Sampel berhasil disimpan'
);  

echo json_encode($status);
}else{
redirect(404);    
}    
}

}
