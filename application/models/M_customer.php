<?php 
class M_customer extends CI_Model{
public function simpan_user($data){
$this->db->insert('data_user',$data);    
    
}
function json_data_sampel($param){
    
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
$this->datatables->where('data_sampel.status_sampel',$param);
$this->datatables->add_column('view',"<button class='btn btn-sm btn-danger '  onclick=hapus_user('$1'); ><i class='fa fa-trash'></i></button>",'id_user');
return $this->datatables->generate();
}



function data_sampel_proses(){
$query = $this->db->get_where('data_sampel',array('id_customer'=>$this->session->userdata('id_customer'),'status_sampel'=>'Proses'));        

return $query;
}

function data_lhus_virus($id_anamnesa){
$this->db->select('data_customer.nama_lengkap,'
        . 'data_sampel.id_sampel,'
        . 'data_sampel.jenis_sampel,'
        . 'lab_virus.jumlah_virus,'
        . 'lab_virus.hasil_virus');
$this->db->from('anamnesa');
$this->db->join('data_sampel', 'data_sampel.id_sampel = anamnesa.id_sampel');
$this->db->join('data_customer', 'data_customer.id_customer = data_sampel.id_customer');
$this->db->join('lab_virus', 'lab_virus.id_anamnesa = anamnesa.id_anamnesa');
$this->db->where('anamnesa.id_anamnesa',$id_anamnesa);

$query = $this->db->get();

return $query;
}



}
?>