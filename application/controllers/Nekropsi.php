<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nekropsi extends CI_Controller {
public function __construct() {
    parent::__construct();
$this->load->model('M_nekropsi');
$this->load->library('Datatables');
$this->load->library('email');

if($this->session->userdata('level_pekerjaan') !='Nekropsi'){
redirect(base_url('Loginadmin'));    
}
}

public function index(){
$this->input_anamnesa();    
}

public function input_anamnesa(){
$data_user = $this->db->get_where('data_user',array('level_pekerjaan !='=>'Super Admin','level_pekerjaan = '=>'Nekropsi'));

$this->load->view('umum/V_header');
$this->load->view('Nekropsi/V_data_sampel',['data_user'=>$data_user]);    
}

public function proses(){
$this->load->view('umum/V_header');
$this->load->view('Nekropsi/V_data_sampel_proses');    
}

public function json_data_sampel($status){
echo $this->M_nekropsi->json_data_sampel($status);       
}



public function simpan_user(){
if($this->input->post()){
$input = $this->input->post();
$data = $this->db->get_where('data_user',array('username'=>$input['username']));
if($data->num_rows() == 1){
$status = array(
'status'    =>'warning',
'message'   =>'Username sudah digunakan'
);    
}else if($input['password'] != $input['ulangi_password']){
$status = array(
'status'    =>'error',
'message'   =>'Password yang dimasukan tidak sesuai'
);    
}else{
$id_user  = $id_user    = "U".str_pad($this->db->get('data_user')->num_rows()+1,4,"0",STR_PAD_LEFT);  
    
$data =array(
'id_user'                       =>$id_user,   
'nama_depan'                    =>$input['nama_depan'],
'nama_belakang'                 =>$input['nama_belakang'],
'nama_lengkap'                  =>$input['nama_depan']." ".$input['nama_belakang'],    
'status'                        =>$input['status'],
'level_pekerjaan'               =>$input['level_pekerjaan'],
'username'                      =>$input['username'],
'password'                      =>password_hash($input['password'],PASSWORD_DEFAULT),
);


$this->M_pengaturan_user->simpan_user($data);

$status = array(
'status'    =>'success',
'message'   =>'Data user berhasil disimpan'
); 

}
echo json_encode($status);   
}     
}

public function data_user(){
$this->load->view('umum/V_header');
$this->load->view('Pengaturan_user/V_data_user');   
}
public function hapus_user(){
if($this->input->post()){
$this->M_pengaturan_user->hapus_user($this->input->post('id_user'));
    
}else{
redirect(404);    
}        
}
public function hapus_customer(){
if($this->input->post()){
$data =array(
'status'                        =>'offline'    
);    
    
$this->M_pengaturan_user->hapus_customer($this->input->post('id_customer'),$data);
    
}else{
redirect(404);    
}        
}
function randomPassword() {
$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
$pass = array(); //remember to declare $pass as an array
$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
for ($i = 0; $i < 8; $i++) {
$n = rand(0, $alphaLength);
$pass[] = $alphabet[$n];
}
return implode($pass); //turn the array into a string
}

public function simpan_customer(){
if($this->input->post()){ 
$password_random = $this->randomPassword();    
$input           = $this->input->post();    
$config = Array(
'protocol' => 'smtp',
'smtp_host' => 'ssl://smtp.googlemail.com',
'smtp_port' => 465,
'smtp_user' => 'sintamasnah@gmail.com',
'smtp_pass' => 'admin@112233',
'mailtype' => 'html',
'charset' => 'iso-8859-1',
'wordwrap' => TRUE
);   
$this->email->initialize($config);
$this->email->set_newline("\r\n");
$this->email->from("sintamasnah@gmail.com");
$this->email->to($input['email_customer']);
$this->email->subject('Konfirmasi Silabmaju');

$data_kirim  ="<h3>Terimakasih anda telah melakukan pendaftaran di aplikasi Silabmaju</h3><br>";
$data_kirim .="<p>data anda dapat di akses melalui link berikut ".base_url()." "
            . "dengan cara memasukan email dan password dibawah ini</p>";
$data_kirim .="<p>Email : ".$input['email_customer']."<br>"
        . "Password : ".$password_random."</p>";
$data_kirim .="<p>Jangan beritahukan password ini kepada siapapun kecuali orang yang anda tunjuk sebagai ahli waris "
        . "berikutnya. <br>"
        . "Atas perhatian dan kerjasamanya kami ucapkan terimakasih.</p>";

$this->email->message($data_kirim);
if (!$this->email->send()){    
echo $this->email->print_debugger();
}else{
$id_customer = "C".str_pad($this->db->get('data_customer')->num_rows()+1,4,"0",STR_PAD_LEFT);  
    
$data = array(
'id_customer'    => $id_customer,    
'nama_depan'     => $input['nama_depan'],
'nama_belakang'  => $input['nama_belakang'],
'nama_lengkap'   => $input['nama_depan']." ".$input['nama_belakang'],
'alamat_lengkap' => $input['alamat_lengkap'],
'email_customer' => $input['email_customer'],
'no_kontak'      => $input['no_kontak'],
'password'       => password_hash($password_random,PASSWORD_DEFAULT),
'status'         => 'online'  
);

$this->M_pengaturan_user->simpan_customer($data);

$status = array(
'status'    =>'success',
'message'   =>'Data Customer berhasil dimasukan'
); 
echo json_encode($status);


}

}else{
redirect(404);    
}

}

public function data_customer(){
$this->load->view('umum/V_header');
$this->load->view('Pengaturan_user/V_data_customer');   
}

public function json_data_customer(){
echo $this->M_pengaturan_user->json_data_customer();       
}

public function logout(){
$this->session->sess_destroy();
redirect(base_url('Loginadmin'));    

}

public function simpan_nekropsi(){
if($this->input->post()){
$input = $this->input->post();
$id_anamnesa  = "A".str_pad($this->db->get('anamnesa')->num_rows()+1,4,"0",STR_PAD_LEFT);  

$anamnesa = array(
'id_anamnesa'   =>$id_anamnesa,   
'id_sampel'     =>$input['id_sampel'],
'pelaksana1'    =>$input['pelaksana1'],
'pelaksana2'    =>$input['pelaksana2'],
'lokasi_sampel' =>$input['lokasi_sampel'],
'cek_parasit'   =>$input['cek_parasit'],
'cek_virus'     =>$input['cek_virus'],
'cek_bakteri'   =>$input['cek_bakteri'],
'cek_jamur'     =>$input['cek_jamur']
);
        
$this->db->insert('anamnesa',$anamnesa);        

$kaji_ulang = array(
'id_anamnesa'       =>$id_anamnesa,   
'kesiapan_personel' =>$input['kesiapan_personel'],
'kondisi_akomodasi' =>$input['kondisi_akomodasi'],
'beban_pekerjaan'   =>$input['beban_pekerjaan'],
'kondisi_peralatan' =>$input['kondisi_peralatan'],        
'kesesuaian_metode'  =>$input['kesesuaian_metode']        
);
$this->db->insert('kaji_ulang',$kaji_ulang);

$update_sampel = array(
'status_sampel' =>'Proses'    
);
$this->db->update('data_sampel',$update_sampel,array('id_sampel'=>$input['id_sampel']));

if($input['cek_parasit'] =='aktif'){
    $id_disposisi = "DSPS".str_pad($this->db->get('disposisi')->num_rows()+1,4,"0",STR_PAD_LEFT);  

$data_disposisi_parasit =array(
'id_disposisi'      => $id_disposisi,
'id_anamnesa'       => $id_anamnesa,
'nama_distribusi'   => 'Lab Parasit',
'status_distribusi' => 'Proses'  
);   
$this->db->insert('disposisi',$data_disposisi_parasit);
}

if($input['cek_virus'] =='aktif'){
    $id_disposisi = "DSPS".str_pad($this->db->get('disposisi')->num_rows()+1,4,"0",STR_PAD_LEFT);  

$data_disposisi_virus =array(
'id_disposisi'      => $id_disposisi,
'id_anamnesa'       => $id_anamnesa,
'nama_distribusi'   => 'Lab Virus',
'status_distribusi' => 'Proses'  
);       
$this->db->insert('disposisi',$data_disposisi_virus);
}

if($input['cek_bakteri'] =='aktif'){
    $id_disposisi = "DSPS".str_pad($this->db->get('disposisi')->num_rows()+1,4,"0",STR_PAD_LEFT);  

$data_disposisi_bakteri =array(
'id_disposisi'      => $id_disposisi,
'id_anamnesa'       => $id_anamnesa,
'nama_distribusi'   => 'Lab Bakteri',
'status_distribusi' => 'Proses'  
);       
$this->db->insert('disposisi',$data_disposisi_bakteri);
}

if($input['cek_jamur'] =='aktif'){
$id_disposisi = "DSPS".str_pad($this->db->get('disposisi')->num_rows()+1,4,"0",STR_PAD_LEFT);  

$data_disposisi_jamur =array(
'id_disposisi'      => $id_disposisi,
'id_anamnesa'       => $id_anamnesa,
'nama_distribusi'   => 'Lab Jamur',
'status_distribusi' => 'Proses'  
);       
$this->db->insert('disposisi',$data_disposisi_jamur);
}




}else{
redirect(404);    
}
}



}
