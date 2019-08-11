<div class="row">

<!-- Column -->
<div class="col-md-4 col-lg-4 col-xlg-3">
<div class="card card-hover">
<div class="box bg-primary text-center">
<h1 class="font-light text-white"><?php echo $this->db->get_where('data_sampel',array('status_sampel'=>'Disposisi'))->num_rows(); ?></h1>
<h6 class="text-white">Data Sampel Masuk</h6>
</div>
</div>
</div>
<div class="col-md-4 col-lg-4 col-xlg-3">
<div class="card card-hover">
<div class="box bg-success text-center">
<h1 class="font-light text-white"><?php echo $this->db->get_where('data_sampel',array('status_sampel'=>'Proses'))->num_rows(); ?></h1>
<h6 class="text-white">Data Sampel Proses</h6>
</div>
</div>
</div>
<div class="col-md-4 col-lg-4 col-xlg-3">
<div class="card card-hover">
<div class="box bg-primary text-center">
<h1 class="font-light text-white"><?php echo $this->db->get_where('data_sampel',array('status_sampel'=>'Selesai'))->num_rows(); ?></h1>
<h6 class="text-white">Data Sampel Selesai</h6>
</div>
</div>
</div>

</div>