<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
public function __construct() {
    parent::__construct();
$this->load->model('M_customer');
$this->load->library('Datatables');
$this->load->library('email');
if(!$this->session->userdata('id_customer')){
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
public function data_anamnesa(){
$this->load->view('umum/V_header');
$this->load->view('Customer/V_data_sampel');    
}

public function simpan_sampel(){
if($this->input->post()){
$input = $this->input->post();
$id_sampel  = "S".str_pad($this->db->get('data_sampel')->num_rows()+1,4,"0",STR_PAD_LEFT);  

$data = array(
'id_customer'       =>$this->session->userdata('id_customer'),    
'id_sampel'         =>$id_sampel,    
'jenis_sampel'      =>$input['jenis_sampel'],
'berat_sampel'      =>$input['berat_sampel'],
'deskripsi_sampel'  =>$input['deskripsi_sampel'],
'gejala'            =>$input['gejala'],
'tgl_input'         =>date('Y/m/d'),    
'asal_sampel'       =>$input['asal_sampel'],
'status_sampel'     =>"Masuk",
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
public function json_data_sampel(){
echo $this->M_customer->json_data_sampel();       
}


public function logout(){
$this->session->sess_destroy();
redirect(base_url('Login'));    

}



}
