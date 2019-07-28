<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manajer_teknik extends CI_Controller {
public function __construct() {
    parent::__construct();
$this->load->model('M_teknik');
$this->load->library('Datatables');
$this->load->library('email');

if($this->session->userdata('level_pekerjaan') =='Manajer Teknik' || $this->session->userdata('level_pekerjaan') =='Super Admin' ){

    
}else{
redirect(base_url('Loginadmin'));        
}

}

public function index(){
$this->load->view('umum/V_header');
$this->load->view('Teknik/V_data_sampel_proses');        
}


public function json_data_sampel($status){
echo $this->M_teknik->json_data_sampel($status);       
}
public function logout(){
$this->session->sess_destroy();
redirect(base_url('Loginadmin'));    

}

public function ambil_data_lab(){
if($this->input->post()){
$input = $this->input->post();
$data_lab = $this->M_teknik->data_where_anamnesa($input['id_anamnesa']);
foreach ($data_lab->result_array() as $d){
$petugas_lab       = $this->M_teknik->petugas_where($d['nama_distribusi']);

echo "<div class='col-md-6'><h5 class='text-center'>Tentukan Petugas Parasit</h5><hr>"
."<label>Tentukan petugas</label>"
."<select onchange=simpan_petugas('".$d['id_disposisi']."','".$input['id_anamnesa']."') class='form-control ".$d['id_disposisi']."'>"
."<option></option>";
foreach ( $petugas_lab->result_array() as $petugas){
echo "<option value=".$petugas['id_user'].">".$petugas['nama_lengkap']."</option>";
}        
echo "</select>";
echo "<hr>";

$petugas_terdaftar = $this->M_teknik->petugas_terdaftar($d['id_disposisi']);
echo "<table class='table table-sm table-bordered text-center table-striped'>";
foreach ($petugas_terdaftar->result_array() as $p){
echo"<tr>"
    . "<td>".$p['nama_lengkap']."</td>"
     . "<td><button onclick=hapus_petugas('".$p['id_petugas']."','".$input['id_anamnesa']."') class='btn btn-sm btn-danger'> <span class='fa fa-trash pull-right'></span></button></td>"
   . "</tr>";
}

echo "</table></div>";    
}

}else{
redirect(404);    
}     
}

public function simpan_petugas_lab(){
if($this->input->post()){
$input = $this->input->post();

$cek_total_petugas  = $this->M_teknik->cek_petugas($input['id_disposisi']); 
$cek_petugas_sama   = $this->M_teknik->cek_petugas_sama($input['id_disposisi'],$input['id_user']); 

if($cek_total_petugas->num_rows() == 2 ){
$status = array(
'status'    =>'error',
'message'   =>'Petugas lab tidak boleh lebih dari dua insan'
);  
}else if($cek_petugas_sama->num_rows() == 1){
$status = array(
'status'    =>'error',
'message'   =>'Tidak boleh ada petugas yang sama dalam satu lab'
);        
}else{
$id_petugas = "PTG".str_pad($this->db->get('petugas_lab')->num_rows()+1,4,"0",STR_PAD_LEFT);  

$data = array(
'id_petugas'    => $id_petugas,
'id_disposisi'  => $input['id_disposisi'],
'id_user'       => $input['id_user'],
);
$this->db->insert("petugas_lab",$data);

$status = array(
'status'    =>'success',
'message'   =>'Petugas lab berhasil ditambahkan'
); 
}

echo json_encode($status);
}else{
redirect(404);    
}
    
}

public function hapus_petugas(){
if($this->input->post()){
$data = array(
'id_disposisi' => NULL,
'id_user'      => NULL    
);

$this->db->update('petugas_lab',$data,array('id_petugas'=>$this->input->post('id_petugas')));
    
}else{
redirect(404);   
}
    
}

}
