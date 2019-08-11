<?php

class Lab_jamur extends CI_Controller{
public function __construct() {
parent::__construct();
$this->load->model('M_lab_jamur');
$this->load->library('Datatables');
$this->load->library('email');
if($this->session->userdata('level_pekerjaan') =='Lab Jamur' || $this->session->userdata('level_pekerjaan') =='Super Admin'){
}else{
redirect(base_url('Loginadmin'));        
}
}

public function index(){
$this->load->view('umum/V_header');
$this->load->view('Lab_jamur/V_data_pekerjaan');
}
public function lab_jamur_selesai(){
$this->load->view('umum/V_header');
$this->load->view('Lab_jamur/V_data_pekerjaan_selesai');
}

public function json_data_pekerjaan($status){
echo $this->M_lab_jamur->json_data_pekerjaan($status);       
}
public function logout(){
$this->session->sess_destroy();
redirect(base_url('Login'));    
}

public function simpan_hasil_uji(){
if($this->input->post()){
$input = $this->input->post();

echo print_r($input);$data = array(
'id_anamnesa'   => $input['id_anamnesa'],
'tgl_jamur'     => date('Y/m/d'),
'hasil_jamur'   => $input['hasil_jamur'],
'jumlah_jamur'  => $input['jumlah_uji'],
'metode_jamur'  => $input['metode_jamur']
);

$this->M_lab_jamur->simpan_hasil($data);


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
$query = $this->M_lab_jamur->hasil_lab_where($input['id_anamnesa'],$input['status']);
$id_disposisi = $query->row_array();

echo "<input type='hidden' class='id_disposisi' value='".$id_disposisi['id_disposisi']."'>";
echo "<table class='table table-sm table-bordered table-striped table-condensed'>"
. "<thead>"
. "<tr>"
. "<td>Nama jamur</td>"
. "<td>Jumlah jamur</td>"
. "<td>Metode  jamur</td>";

if($input['status'] != 'Selesai'){
echo "<td>Aksi</td>";
}

echo "</tr>"
. "</thead>";

foreach ( $query->result_array() as $data){
echo "<tr>"
. "<td>".$data['hasil_jamur']."</td>"
. "<td>".$data['jumlah_jamur']."</td>"
. "<td>".$data['metode_jamur']."</td>";
if($input['status'] != 'Selesai'){

echo "<td><button class='btn btn-sm btn-block btn-danger' onclick=hapus('".$data['id_jamur']."','".$data['id_anamnesa']."');><span class='fa fa-trash'></span></button></td>";
}
        echo "</tr>";
}
echo "</table>";
}else{
redirect(404);    
}
}

public function hapus_jamur(){
if($this->input->post('id_jamur')){
$input = $this->input->post();
$this->db->delete('lab_jamur',array('id_jamur'=>$input['id_jamur']));    
}else{
redirect(404);    
}    
    
}
public function selesai_jamur(){
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


