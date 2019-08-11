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
$this->load->view('Teknik/V_data_sampel_masuk');        
}
public function proses(){
$this->load->view('umum/V_header');
$this->load->view('Teknik/V_data_sampel_proses');        
}
public function selesai(){
$this->load->view('umum/V_header');
$this->load->view('Teknik/V_data_sampel_selesai');        
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
$id_sampel = $data_lab->row_array();


foreach ($data_lab->result_array() as $d){
$petugas_lab       = $this->M_teknik->petugas_where($d['nama_distribusi']);

echo "<div class='col-md-6'><h5 class='text-center'>Tentukan Petugas ".$d['nama_distribusi']."</h5><hr>"
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
echo   '<button onclick=update_disposisi("'.$id_sampel['id_sampel'].'"); class="btn btn-success btn-block selesai_disposisikan">Selesai Disposisikan</button>';
   


}else{
redirect(404);    
}     
}

public function cek_status_lab(){
if($this->input->post()){
$input = $this->input->post();

$data_disposisi = $this->M_teknik->data_disposisi($input['id_anamnesa']);

echo "<table class='table table-sm table-bordered table-stripped'>"
."<thead>"
. "<tr>"
. "<th>No</th>"
. "<th>Nama Lab</th>"
. "<th>Status Lab</th>"
. "</tr>"
. "<thead>";

$no =1;
foreach ($data_disposisi->result_array() as $d){
echo "<tr>"
    . "<td>".$no++."</td>"
    . "<td>".$d['nama_distribusi']."</td>"
    . "<td>".$d['status_distribusi']."</td>"
    . "</tr>";    
}


echo" </table>";

    
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

public function selesaikan_pekerjaan(){
 if($this->input->post()){
 $input  = $this->input->post();    
     
 $data_customer = $this->M_teknik->data_user($input['id_sampel'])->row_array();    
     
$config = Array(
'protocol' => 'smtp',
'smtp_host' => 'ssl://smtp.googlemail.com',
'smtp_port' => 465,
'smtp_user' => 'ronilece18@gmail.com',
'smtp_pass' => 'alfiansyah18',
'mailtype' => 'html',
'charset' => 'iso-8859-1',
'wordwrap' => TRUE
);   
$this->email->initialize($config);
$this->email->set_newline("\r\n");
$this->email->from("ronilece18@gmail.com");
$this->email->to($data_customer['email_customer']);
$this->email->subject('Konfirmasi Silabmaju');

$data_kirim  ="<h3>Pemohon atas nama ".$data_customer['nama_lengkap']." </h3><br>";
$data_kirim .="<p>Uji Lab dengan No. Sample ".$input['id_sampel']." Telah selesai"
            . "<br>Silahkan Cek Melalui Link berikut ". base_url()."</p>";
$data_kirim .="<p>Silahkan Print LHU yang telah tersedia kemudian segera laporkan kepada BKIPM mamuju untuk melakukan pengecapan</p>";
$this->email->message($data_kirim);
if (!$this->email->send()){    
echo $this->email->print_debugger();

}else{

$data = array(
'status_sampel' => 'Selesai'
);

$this->db->update('data_sampel',$data,array('id_sampel'=>$this->input->post('id_sampel')));
    
}
 
}else{
redirect(404);   
}
    
}

public function update_sampel(){
 if($this->input->post()){
     $input = $this->input->post();
  $data = array(
   'status_sampel' =>'Proses',   
  );   
  $this->db->update('data_sampel',$data,array('id_sampel'=>$input['id_sampel']));
     $status = array(
'status'    =>'success',
'message'   =>'Sampel Berhasil diperbaharui'
); 
     echo json_encode($status);
 }else{
     redirect(404);   
 }   
}



}
