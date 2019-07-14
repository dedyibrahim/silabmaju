<?php 
class M_pengaturan_user extends CI_Model{
public function simpan_user($data){
$this->db->insert('data_user',$data);    
    
}
function json_data_user(){
    
$this->datatables->select('id_user,'
.'data_user.nama_lengkap as nama_lengkap,'
.'data_user.status as status,'
.'data_user.level_pekerjaan as level_pekerjaan,'
.'data_user.username as username,'
.'data_user.username as username,'
);
$this->datatables->from('data_user');
$this->datatables->add_column('view',"<button class='btn btn-sm btn-danger '  onclick=hapus_user('$1'); ><i class='fa fa-trash'></i></button>",'id_user');
return $this->datatables->generate();
}

function json_data_customer(){
$this->datatables->select('id_customer,'
.'data_customer.id_customer as id_customer,'
.'data_customer.nama_lengkap as nama_lengkap,'
.'data_customer.email_customer as email_customer,'
 );
$this->datatables->from('data_customer');
$this->datatables->where('data_customer.status','online');
$this->datatables->add_column('view',"<button class='btn btn-sm btn-danger '  onclick=hapus_customer('$1'); ><i class='fa fa-trash'></i></button>",'id_customer');
return $this->datatables->generate();
}

function hapus_user($id_user){
$this->db->delete('data_user',array('id_user'=>$id_user));    
}

function hapus_customer($id_customer,$data){
$this->db->update('data_customer',$data,array('id_customer'=>$id_customer));    
}

function simpan_customer($data){
$this->db->insert('data_customer',$data);    
}

}
?>