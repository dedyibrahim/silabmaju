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
$this->datatables->add_column('view_selesai',"<button class='btn btn-sm btn-success' onclick=print_lhu('$1'); ><i class='fa fa-print'> </i> Print LHU </button>",'id_sampel');
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
        . 'lab_virus.hasil_virus,'
        . 'lab_virus.metode_virus,'
        . 'anamnesa.id_anamnesa');
$this->db->from('anamnesa');
$this->db->join('data_sampel', 'data_sampel.id_sampel = anamnesa.id_sampel');
$this->db->join('data_customer', 'data_customer.id_customer = data_sampel.id_customer');
$this->db->join('lab_virus', 'lab_virus.id_anamnesa = anamnesa.id_anamnesa');
$this->db->where('anamnesa.id_anamnesa',$id_anamnesa);

$query = $this->db->get();

return $query;
}


function petugas_lab($id_anamnesa,$nama_lab){
$this->db->select('data_user.nama_lengkap');
$this->db->from('disposisi');
$this->db->join('petugas_lab', 'petugas_lab.id_disposisi = disposisi.id_disposisi');
$this->db->join('data_user', 'data_user.id_user = petugas_lab.id_user');
$this->db->where('disposisi.id_anamnesa',$id_anamnesa);
$this->db->where('disposisi.nama_distribusi',$nama_lab);

$query = $this->db->get();
 
return $query;
}

function data_lhus_jamur($id_anamnesa){
$this->db->select('data_customer.nama_lengkap,'
        . 'data_sampel.id_sampel,'
        . 'data_sampel.jenis_sampel,'
        . 'lab_jamur.jumlah_jamur,'
        . 'lab_jamur.hasil_jamur,'
        . 'lab_jamur.metode_jamur,'
        . 'anamnesa.id_anamnesa');
$this->db->from('anamnesa');
$this->db->join('data_sampel', 'data_sampel.id_sampel = anamnesa.id_sampel');
$this->db->join('data_customer', 'data_customer.id_customer = data_sampel.id_customer');
$this->db->join('lab_jamur', 'lab_jamur.id_anamnesa = anamnesa.id_anamnesa');
$this->db->where('anamnesa.id_anamnesa',$id_anamnesa);

$query = $this->db->get();

return $query;
}

function data_lhus_bakteri($id_anamnesa){
$this->db->select('data_customer.nama_lengkap,'
        . 'data_sampel.id_sampel,'
        . 'data_sampel.jenis_sampel,'
        . 'lab_bakteri.jumlah_bakteri,'
        . 'lab_bakteri.hasil_bakteri,'
        . 'lab_bakteri.metode_bakteri,'
        . 'anamnesa.id_anamnesa');
$this->db->from('anamnesa');
$this->db->join('data_sampel', 'data_sampel.id_sampel = anamnesa.id_sampel');
$this->db->join('data_customer', 'data_customer.id_customer = data_sampel.id_customer');
$this->db->join('lab_bakteri', 'lab_bakteri.id_anamnesa = anamnesa.id_anamnesa');
$this->db->where('anamnesa.id_anamnesa',$id_anamnesa);

$query = $this->db->get();

return $query;
}
function data_lhus_parasit($id_anamnesa){
$this->db->select('data_customer.nama_lengkap,'
        . 'data_sampel.id_sampel,'
        . 'data_sampel.jenis_sampel,'
        . 'lab_parasit.jumlah_parasit,'
        . 'lab_parasit.hasil_parasit,'
        . 'lab_parasit.metode_parasit,'
        . 'anamnesa.id_anamnesa');
$this->db->from('anamnesa');
$this->db->join('data_sampel', 'data_sampel.id_sampel = anamnesa.id_sampel');
$this->db->join('data_customer', 'data_customer.id_customer = data_sampel.id_customer');
$this->db->join('lab_parasit', 'lab_parasit.id_anamnesa = anamnesa.id_anamnesa');
$this->db->where('anamnesa.id_anamnesa',$id_anamnesa);

$query = $this->db->get();

return $query;
}

function data_lhu($id_sampel){
$this->db->select('*');
$this->db->from('data_sampel');
$this->db->join('anamnesa', 'anamnesa.id_sampel = data_sampel.id_sampel');
$this->db->join('data_customer', 'data_customer.id_customer = data_sampel.id_customer');
$this->db->join('disposisi', 'disposisi.id_anamnesa = anamnesa.id_anamnesa');
$this->db->where('data_sampel.id_sampel',$id_sampel);

$query = $this->db->get();

return $query;
    
    
}

}
?>