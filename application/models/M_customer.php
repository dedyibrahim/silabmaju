<?php 
class M_customer extends CI_Model{
public function simpan_user($data){
$this->db->insert('data_user',$data);    
    
}
function json_data_sampel(){
    
$this->datatables->select('id_sampel,'
.'data_sampel.jenis_sampel as jenis_sampel,'
.'data_sampel.berat_sampel as berat_sampel,'
.'data_sampel.deskripsi_sampel as deskripsi_sampel,'
.'data_sampel.tgl_input as tgl_input,'
.'data_sampel.gejala as gejala,'
.'data_sampel.asal_sampel as asal_sampel,'
.'data_sampel.status_sampel as status_sampel,'
);
$this->datatables->from('data_sampel');
$this->datatables->where('data_sampel.id_customer',$this->session->userdata('id_customer'));
$this->datatables->add_column('view',"<button class='btn btn-sm btn-danger '  onclick=hapus_user('$1'); ><i class='fa fa-trash'></i></button>",'id_user');
return $this->datatables->generate();
}

}
?>