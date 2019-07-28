
<?php 
class M_teknik extends CI_Model{
public function simpan_user($data){
$this->db->insert('data_user',$data);    
    
}
function json_data_sampel($status){
    
$this->datatables->select('disposisi.id_anamnesa,'
.'data_sampel.jenis_sampel as jenis_sampel,'
.'data_sampel.berat_sampel as berat_sampel,'
.'data_sampel.deskripsi_sampel as deskripsi_sampel,'
.'data_sampel.tgl_input as tgl_input,'
.'data_sampel.gejala as gejala,'
.'data_sampel.asal_sampel as asal_sampel,'
.'data_customer.nama_lengkap as nama_lengkap,'        
.'data_sampel.status_sampel as status_sampel,'        
);

$this->datatables->from('disposisi');
$this->datatables->join('anamnesa','anamnesa.id_anamnesa= disposisi.id_anamnesa');
$this->datatables->join('data_sampel','data_sampel.id_sampel = anamnesa.id_sampel');
$this->datatables->join('data_customer','data_customer.id_customer = data_sampel.id_customer');
$this->datatables->group_by('anamnesa.id_anamnesa');
$this->datatables->add_column('view',"<button onclick=proses_anamnesa('$1'); class='btn btn-sm btn-success '><i class='fa fa-plus'></i> Proses anamnesa</button>",'id_anamnesa');
return $this->datatables->generate();
}


function data_where_anamnesa($id_anamnesa){
$query = $this->db->get_where('disposisi',array('id_anamnesa'=>$id_anamnesa));    
return $query;       
}

function petugas_where($nama_lab){
$data_user  = $this->db->get_where('data_user',array('level_pekerjaan'=>$nama_lab));

return $data_user;
    
}

function cek_petugas($id_disposisi){
$query = $this->db->get_where('petugas_lab',array('id_disposisi'=>$id_disposisi));
return $query;
}
function cek_petugas_sama($id_disposisi,$id_user){
$query = $this->db->get_where('petugas_lab',array('id_disposisi'=>$id_disposisi,'id_user'=>$id_user));
return $query;
}

function petugas_terdaftar($id_disposisi){
$this->db->select('*');
$this->db->from('petugas_lab');
$this->db->join('data_user', 'data_user.id_user = petugas_lab.id_user');
$this->db->where('petugas_lab.id_disposisi',$id_disposisi);
$query = $this->db->get();  

return $query;
}

}
?>