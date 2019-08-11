<?php 
class M_lab_bakteri extends CI_Model{

function json_data_pekerjaan($status){
$this->datatables->select('anamnesa.id_anamnesa,'
.'anamnesa.id_anamnesa,'
.'data_user.nama_lengkap as nama_lengkap,'
.'data_sampel.jenis_sampel as jenis_sampel,'
.'data_sampel.gejala as gejala,'
.'data_sampel.asal_sampel as asal_sampel'        
);

$this->datatables->from('disposisi');
$this->datatables->join('petugas_lab','petugas_lab.id_disposisi = disposisi.id_disposisi');
$this->datatables->join('anamnesa','anamnesa.id_anamnesa = disposisi.id_anamnesa');
$this->datatables->join('data_sampel','data_sampel.id_sampel = anamnesa.id_sampel');
$this->datatables->join('data_user','data_user.id_user = petugas_lab.id_user');
$this->datatables->where('disposisi.nama_distribusi','Lab Bakteri');
$this->datatables->where('disposisi.status_distribusi',$status);
$this->datatables->where('petugas_lab.id_user',$this->session->userdata('id_user'));
$this->datatables->add_column('view',""
        . "<button class='btn btn-sm btn-success'  onclick=buat_hasil_uji('$1'); ><i class='fa fa-plus'></i> Hasil Uji</button> || "
        . "<button class='btn btn-sm btn-success'  onclick=lihat_hasil('$1'); ><i class='fa fa-eye'></i> Lihat hasil</button>",'id_anamnesa');
$this->datatables->add_column('view_selesai',""
        . "<button class='btn btn-sm btn-success'  onclick=lihat_hasil('$1'); ><i class='fa fa-eye'></i> Lihat hasil</button>",'id_anamnesa');
return $this->datatables->generate();
}

function simpan_hasil($data){
$this->db->insert('lab_bakteri',$data);    
}


function hasil_lab_where($id_anamnesa,$status){
     
 $this->db->select('*');
 $this->db->from('lab_bakteri');
 $this->db->join('disposisi','disposisi.id_anamnesa = lab_bakteri.id_anamnesa ');
 $this->db->where('lab_bakteri.id_anamnesa',$id_anamnesa);
 $this->db->where('disposisi.nama_distribusi','Lab Bakteri');
 $this->db->where('disposisi.status_distribusi',$status);
 $query = $this->db->get();
 return $query;
   
}

}
?>