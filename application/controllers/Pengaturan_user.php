<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan_user extends CI_Controller {
public function __construct() {
    parent::__construct();
$this->load->model('M_pengaturan_user');
$this->load->library('Datatables');
$this->load->library('email');

if($this->session->userdata('level_pekerjaan') !='Super Admin'){
redirect(base_url('Loginadmin'));    
}

}


public function index(){
$this->input_customer();
    
}

public function input_user(){
$this->load->view('umum/V_header');
$this->load->view('Pengaturan_user/V_input_user');    
}

public function input_customer(){
$this->load->view('umum/V_header');
$this->load->view('Pengaturan_user/V_input_customer');    
}

public function json_data_user(){
echo $this->M_pengaturan_user->json_data_user();       
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
$id_user  = "U".str_pad($this->db->get('data_user')->num_rows()+1,4,"0",STR_PAD_LEFT);  
    
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

}
