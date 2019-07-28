<?php

class Lab_virus extends CI_Controller{
public function __construct() {
parent::__construct();
$this->load->model('M_lab_virus');
$this->load->library('Datatables');
$this->load->library('email');
if($this->session->userdata('level_pekerjaan') !='Lab Virus'){
redirect(base_url('Loginadmin'));    
}
}

public function index(){
$this->load->view('umum/V_header');
$this->load->view('Lab_virus/V_data_pekerjaan');

}

public function json_data_pekerjaan(){
echo $this->M_lab_virus->json_data_pekerjaan();       
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
'tgl_virus'     => date('Y/m/d'),
'hasil_virus'   => $input['hasil_uji'],
'jumlah_virus'  => $input['jumlah_uji']
);

$this->M_lab_virus->simpan_hasil($data);


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
$query = $this->M_lab_virus->hasil_lab_where($input['id_anamnesa']);

echo "<table class='table table-sm table-bordered table-striped table-condensed'>"
. "<thead>"
. "<tr>"
. "<td>Nama Virus</td>"
. "<td>Jumlah Virus</td>"
. "<td>Aksi</td>"
. "</tr>"
. "</thead>";

foreach ( $query->result_array() as $data){
echo "<tr>"
. "<td>".$data['hasil_virus']."</td>"
. "<td>".$data['jumlah_virus']."</td>"
. "<td><button class='btn btn-sm btn-block btn-danger' onclick=hapus('".$data['id_virus']."','".$data['id_anamnesa']."');><span class='fa fa-trash'></span></button></td>"
. "</tr>";
}


echo "</table>";


}else{
redirect(404);    
}    
}

public function hapus_virus(){
if($this->input->post('id_virus')){
$input = $this->input->post();
$this->db->delete('lab_virus',array('id_virus'=>$input['id_virus']));    
}else{
redirect(404);    
}    
    
}

}


