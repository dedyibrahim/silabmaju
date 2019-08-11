<?php

class Lab_parasit extends CI_Controller{
public function __construct() {
parent::__construct();
$this->load->model('M_lab_parasit');
$this->load->library('Datatables');
$this->load->library('email');
if($this->session->userdata('level_pekerjaan') =='Lab Parasit' || $this->session->userdata('level_pekerjaan') =='Super Admin'){
}else{
redirect(base_url('Loginadmin'));        
}
}

public function index(){
$this->load->view('umum/V_header');
$this->load->view('Lab_parasit/V_data_pekerjaan');

}
public function parasit_selesai(){
$this->load->view('umum/V_header');
$this->load->view('Lab_parasit/V_data_pekerjaan_selesai');

}

public function json_data_pekerjaan($status){
echo $this->M_lab_parasit->json_data_pekerjaan($status);       
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
'tgl_parasit'     => date('Y/m/d'),
'hasil_parasit'   => $input['hasil_uji'],
'jumlah_parasit'  => $input['jumlah_uji'],
'metode_parasit'  => $input['metode_parasit']
);

$this->M_lab_parasit->simpan_hasil($data);


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
$query = $this->M_lab_parasit->hasil_lab_where($input['id_anamnesa'],$input['status']);
$id_disposisi = $query->row_array();

echo "<input type='hidden' class='id_disposisi' value='".$id_disposisi['id_disposisi']."'>";
echo "<table class='table table-sm table-bordered table-striped table-condensed'>"
. "<thead>"
. "<tr>"
. "<td>Nama Parasit</td>"
. "<td>Jumlah Parasit</td>"
. "<td>Metode  Parasit</td>";

if($input['status'] != 'Selesai'){
echo "<td>Aksi</td>";
}

echo "</tr>"
. "</thead>";

foreach ( $query->result_array() as $data){
echo "<tr>"
. "<td>".$data['hasil_parasit']."</td>"
. "<td>".$data['jumlah_parasit']."</td>"
. "<td>".$data['metode_parasit']."</td>";
if($input['status'] != 'Selesai'){

echo "<td><button class='btn btn-sm btn-block btn-danger' onclick=hapus('".$data['id_parasit']."','".$data['id_anamnesa']."');><span class='fa fa-trash'></span></button></td>";
}
        echo "</tr>";
}
echo "</table>";
}else{
redirect(404);    
}    
}



public function hapus_parasit(){
if($this->input->post('id_parasit')){
$input = $this->input->post();
$this->db->delete('lab_parasit',array('id_parasit'=>$input['id_parasit']));    
}else{
redirect(404);    
}    
    
}
public function selesai_parasit(){
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

