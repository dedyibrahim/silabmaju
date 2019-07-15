<?php 
class M_nekropsi extends CI_Model{
public function simpan_user($data){
$this->db->insert('data_user',$data);    
    
}
function json_data_sampel($status){
    
$this->datatables->select('id_sampel,'
.'data_sampel.jenis_sampel as jenis_sampel,'
.'data_sampel.berat_sampel as berat_sampel,'
.'data_sampel.deskripsi_sampel as deskripsi_sampel,'
.'data_sampel.tgl_input as tgl_input,'
.'data_sampel.gejala as gejala,'
.'data_sampel.asal_sampel as asal_sampel,'
.'data_customer.nama_lengkap as nama_lengkap,'        
.'data_sampel.status_sampel as status_sampel,'        
);

$this->datatables->from('data_sampel');
$this->datatables->join('data_customer','data_customer.id_customer = data_sampel.id_customer');
$this->datatables->where('data_sampel.status_sampel',$status);
$this->datatables->add_column('view',"<button onclick=proses_anamnesa('$1'); class='btn btn-sm btn-success '><i class='fa fa-plus'></i> Proses anamnesa</button>",'id_sampel');
return $this->datatables->generate();
}


}
?>