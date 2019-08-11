<div class="row">

<!-- Column -->
<div class="col-md-6 col-lg-6 col-xlg-6">
<div class="card card-hover">
<div class="box bg-primary text-center">
<h2 class="text-white"><?php
 $this->db->select('*');
 $this->db->from('anamnesa');
 $this->db->join('disposisi','disposisi.id_anamnesa = anamnesa.id_anamnesa ');
 $this->db->join('petugas_lab','petugas_lab.id_disposisi = disposisi.id_disposisi ');
 $this->db->where('disposisi.status_distribusi','Proses');
 $this->db->where('disposisi.nama_distribusi','Lab Virus');
 $this->db->where('petugas_lab.id_user',$this->session->userdata('id_user'));
 $query = $this->db->get();
 echo $query->num_rows();
?>
</h2>
<h6 class="text-white">Jumlah Pekerjaan Proses</h6>
</div>
</div>
</div>
<div class="col-md-6 col-lg-6 col-xlg-6">
<div class="card card-hover">
<div class="box bg-success text-center">
<h2 class="text-white"><?php
 $this->db->select('*');
 $this->db->from('anamnesa');
 $this->db->join('disposisi','disposisi.id_anamnesa = anamnesa.id_anamnesa ');
 $this->db->join('petugas_lab','petugas_lab.id_disposisi = disposisi.id_disposisi ');
 $this->db->where('disposisi.status_distribusi','Selesai');
 $this->db->where('disposisi.nama_distribusi','Lab Virus');
 $this->db->where('petugas_lab.id_user',$this->session->userdata('id_user'));
 $query = $this->db->get();
 echo $query->num_rows();
?>
</h2>
<h6 class="text-white">Jumlah Pekerjaan Selesai</h6>
</div>
</div>
</div>

</div>