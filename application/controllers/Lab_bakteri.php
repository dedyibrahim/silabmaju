<?php

class Lab_bakteri extends CI_Controller{
public function __construct() {
parent::__construct();
$this->load->model('M_lab_bakteri');
$this->load->library('Datatables');
$this->load->library('email');
if($this->session->userdata('level_pekerjaan') =='Lab Bakteri' || $this->session->userdata('level_pekerjaan') =='Super Admin'){
}else{
redirect(base_url('Loginadmin'));        
}
}

public function index(){
$this->load->view('umum/V_header');
$this->load->view('Lab_bakteri/V_data_pekerjaan');

}
public function bakteri_selesai(){
$this->load->view('umum/V_header');
$this->load->view('Lab_bakteri/V_data_pekerjaan_selesai');

}

public function json_data_pekerjaan($status){
echo $this->M_lab_bakteri->json_data_pekerjaan($status);       
}

public function logout(){
$this->session->sess_destroy();
redirect(base_url('Login'));    
}

public function simpan_hasil_uji(){
if($this->input->post()){
$input = $this->input->post();

$data = array(
'id_anamnesa'   => $input['id_anamnesa'],
'tgl_bakteri'     => date('Y/m/d'),
'hasil_bakteri'   => $input['hasil_bakteri'],
'jumlah_bakteri'  => $input['jumlah_uji'],
'metode_bakteri'  => $input['metode_bakteri']
);

$this->M_lab_bakteri->simpan_hasil($data);


$status = array(
'status'    =>'success',
'message'   =>'Data tersimpan'
);  

echo json_encode($status);

}else{
redirect(404);    
}    
}

public function lihat_hasil(){
if($this->input->post('id_anamnesa')){
$input = $this->input->post();
$query = $this->M_lab_bakteri->hasil_lab_where($input['id_anamnesa'],$input['status']);
$id_disposisi = $query->row_array();

echo "<input type='hidden' class='id_disposisi' value='".$id_disposisi['id_disposisi']."'>";
echo "<table class='table table-sm table-bordered table-striped table-condensed'>"
. "<thead>"
. "<tr>"
. "<td>Nama Bakteri</td>"
. "<td>Jumlah Bakteri</td>"
. "<td>Metode  Bakteri</td>";

if($input['status'] != 'Selesai'){
echo "<td>Aksi</td>";
}

echo "</tr>"
. "</thead>";

foreach ( $query->result_array() as $data){
echo "<tr>"
. "<td>".$data['hasil_bakteri']."</td>"
. "<td>".$data['jumlah_bakteri']."</td>"
. "<td>".$data['metode_bakteri']."</td>";
if($input['status'] != 'Selesai'){

echo "<td><button class='btn btn-sm btn-block btn-danger' onclick=hapus('".$data['id_virus']."','".$data['id_anamnesa']."');><span class='fa fa-trash'></span></button></td>";
}
        echo "</tr>";
}
echo "</table>";


}else{
redirect(404);    
}    
}

public function hapus_bakteri(){
if($this->input->post('id_bakteri')){
$input = $this->input->post();
$this->db->delete('lab_bakteri',array('id_bakteri'=>$input['id_bakteri']));    
}else{
redirect(404);    
}    
    
}
public function selesai_bakteri(){
if($this->input->post('id_disposisi')){
$input = $this->input->post();
    
 $data = array(
  'status_distribusi' =>'Selesai'   
 );   
     
 $this->db->update('disposisi',$data,array('id_disposisi'=>$input['id_disposisi']));    


}else{
redirect(404);    
}    
}

}

