<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
public function __construct() {
    parent::__construct();
    
$this->load->library('pdf');
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
public function data_anamnesa_proses(){
$query = $this->M_customer->data_sampel_proses();    
    
$this->load->view('umum/V_header');
$this->load->view('Customer/V_data_sampel_proses',['query'=>$query]);    
}
public function data_anamnesa_selesai(){
$this->load->view('umum/V_header');
$this->load->view('Customer/V_data_sampel_selesai');    
}

public function simpan_sampel(){
if($this->input->post()){
$input = $this->input->post();
$id_sampel  = "SL".str_pad($this->db->get('data_sampel')->num_rows()+1,4,"0",STR_PAD_LEFT);  

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
public function json_data_sampel($param){
echo $this->M_customer->json_data_sampel($param);       
}


public function logout(){
$this->session->sess_destroy();
redirect(base_url('Login'));    

}

public function cek_lhu(){
if($this->input->post()){
$input = $this->input->post();

if($input['nama_lab'] == 'LHUS Lab Bakteri'){
$query = $this->db->get_where('lab_bakteri',array('id_anamnesa'=>$input['id_anamnesa']));

if( $query->num_rows() >= 1 ){
$status = array(
'status'    =>'success',
'controller'=>'print_lhus_bakteri/'   
); 
    
}else{
$status = array(
'status' =>'error',
'pesan'  =>'Data LHUS Bakteri Belum tersedia'    
); 
}
    
}else if($input['nama_lab'] == 'LHUS Lab Virus'){
$query = $this->db->get_where('lab_virus',array('id_anamnesa'=>$input['id_anamnesa']));

if( $query->num_rows() >= 1 ){
$status = array(
'status' =>'success',
'controller'=>'print_lhus_virus/'      
); 
    
}else{
$status = array(
'status' =>'error',
'pesan'  =>'Data LHUS Virus Belum tersedia'    
); 
}
    
}else if($input['nama_lab'] == 'LHUS Lab Jamur'){
$query = $this->db->get_where('lab_jamur',array('id_anamnesa'=>$input['id_anamnesa']));

if( $query->num_rows() >= 1 ){
$status = array(
'status' =>'success',
'controller'=>'print_lhus_jamur/'       
); 
    
}else{
$status = array(
'status' =>'error',
'pesan'  =>'Data LHUS Jamur tersedia'    
); 
}
    
}else if($input['nama_lab'] == 'LHUS Lab Parasit'){
$query = $this->db->get_where('lab_parasit',array('id_anamnesa'=>$input['id_anamnesa']));

if( $query->num_rows() >= 1 ){
$status = array(
'status' =>'success',
'controller'=>'print_lhus_parasit/'      
); 
    
}else{
$status = array(
'status' =>'error',
'pesan'  =>'Data LHUS Parasit Belum tersedia'    
); 
}
    
}else{
$status = array(
'status' =>'error',
'pesan'  =>'Pilihan belum ditentukan'    
); 
}
echo json_encode($status);
}else{
redirect(404);    
}
    
}

function print_lhus_virus(){
$query       = $this->M_customer->data_lhus_virus($this->uri->segment(3));
$data        = $query->row_array();
$petugas_lab = $this->M_customer->petugas_lab($data['id_anamnesa'],'Lab Virus');

    $this->pdf->setPaper('A4','potrait');
    $this->pdf->filename = "LHUSVIRUS.pdf";
    $this->pdf->load_view('laporan_pdf', ['query'=>$query,'petugas_lab'=>$petugas_lab]);

    
}
function print_lhus_jamur(){
$query       = $this->M_customer->data_lhus_jamur($this->uri->segment(3));
$data        = $query->row_array();
$petugas_lab = $this->M_customer->petugas_lab($data['id_anamnesa'],'Lab Jamur');

    $this->pdf->setPaper('A4','potrait');
    $this->pdf->filename = "LHUSJAMUR.pdf";
    $this->pdf->load_view('lhus_jamur', ['query'=>$query,'petugas_lab'=>$petugas_lab]);
    
}
function print_lhus_bakteri(){
$query       = $this->M_customer->data_lhus_bakteri($this->uri->segment(3));
$data        = $query->row_array();
$petugas_lab = $this->M_customer->petugas_lab($data['id_anamnesa'],'Lab Bakteri');

    $this->pdf->setPaper('A4','potrait');
    $this->pdf->filename = "LHUSBAKTERI.pdf";
    $this->pdf->load_view('lhus_bakteri', ['query'=>$query,'petugas_lab'=>$petugas_lab]);
    
}
function print_lhus_parasit(){
$query       = $this->M_customer->data_lhus_parasit($this->uri->segment(3));
$data        = $query->row_array();
$petugas_lab = $this->M_customer->petugas_lab($data['id_anamnesa'],'Lab Parasit');

    $this->pdf->setPaper('A4','potrait');
    $this->pdf->filename = "LHUSPARASIT.pdf";
    $this->pdf->load_view('lhus_parasit', ['query'=>$query,'petugas_lab'=>$petugas_lab]);
    
}

public function print_lhu(){
$id_sampel = $this->uri->segment(3);
$query       = $this->M_customer->data_lhu($id_sampel);

//$this->load->view('print_lhu',['query'=>$query]);
    $this->pdf->setPaper('A4','potrait');
    $this->pdf->filename = "LHU.pdf";
    $this->pdf->load_view('print_lhu', ['query'=>$query]);
    
}


}
