<div id="main-wrapper">
<?php $this->load->view('umum/V_topbar_customer') ?>
<?php $this->load->view('umum/V_sidebar_customer') ?>
<div class="page-wrapper">
<div class="container-fluid">
<?php $this->load->view('umum/V_data_customer') ?>
<div class="row">
<div class="col">    
<div class="card">
<div class="card-body">  
<div class="col-12 d-flex no-block align-items-center">
<h4 class="page-title">Data Anamnesa Proses</h4>
</div>
<hr>
<table style="width:100%;" id="data_anamnesa" class="table table-striped table-condensed table-sm table-bordered  table-hover table-sm"><thead>
<tr role="row">
<th  align="center" aria-controls="datatable-fixed-header" >No</th>
<th  align="center" aria-controls="datatable-fixed-header" >Id Sampel</th>
<th  align="center" aria-controls="datatable-fixed-header" >Jenis Sampel</th>
<th  align="center" aria-controls="datatable-fixed-header" >Berat Sampel</th>
<th  align="center" aria-controls="datatable-fixed-header" >Deskripsi</th>
<th  align="center" aria-controls="datatable-fixed-header" >Tgl Input</th>
<th  align="center" aria-controls="datatable-fixed-header" >Gejala</th>
<th  align="center" aria-controls="datatable-fixed-header" >Asal Sampel</th>
<th  align="center" aria-controls="datatable-fixed-header" >Status Sampel</th>
<th  align="center" aria-controls="datatable-fixed-header" >Aksi</th>
</thead>
<?php $no =1; foreach ($query->result_array() as $d){ ?>
<tr>
<td><?php echo $no++ ?></td>    
<td><?php echo $d['id_sampel'] ?></td>    
<td><?php echo $d['jenis_sampel'] ?></td>    
<td><?php echo $d['berat_sampel'] ?></td>    
<td><?php echo $d['deskripsi_sampel'] ?></td>    
<td><?php echo $d['tgl_input'] ?></td>    
<td><?php echo $d['gejala'] ?></td>    
<td><?php echo $d['asal_sampel'] ?></td>    
<td><?php echo $d['status_sampel'] ?></td>    
<td>
<select onchange="cek_lhus('<?php echo $d['id_sampel'] ?>')" class="form-control sampel<?php echo $d['id_sampel'] ?>" >
<option>--- Pilih Menu Pilihan ---</option>
<?php 
$this->db->select('disposisi.id_disposisi,'
        . 'nama_distribusi,'
        . 'disposisi.id_anamnesa');
$this->db->from('anamnesa');
$this->db->join('disposisi', 'disposisi.id_anamnesa = anamnesa.id_anamnesa');
$this->db->where('anamnesa.id_sampel',$d['id_sampel']);
$query2 = $this->db->get();
foreach ($query2->result_array() as $p){
echo "<option value=".$p['id_anamnesa'].">LHUS ".$p['nama_distribusi']."</option>";    
}
?>
 </select>        
</td>    
</tr>
<?php } ?>
</table>
</div>
</div>    

</div>
</div>    
</div>
<?php $this->load->view('umum/V_footer') ?>
</div>
</div>
</body>

<script type="text/javascript">
function cek_lhus(id_sampel){
var nama_lab = $(".sampel"+id_sampel+" option:selected").text();
var id_anamnesa = $(".sampel"+id_sampel+" option:selected").val();

$.ajax({
type:"post",
url:"<?php echo base_url('Customer/cek_lhu') ?>",
data:"nama_lab="+nama_lab+"&id_anamnesa="+id_anamnesa,
success:function(data){
var r = JSON.parse(data);

if(r.status == 'success'){
window.location.href="<?php echo base_url('Customer/') ?>"+r.controller+id_anamnesa;
}else{
const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated bounceInDown'
});

Toast.fire({
type: r.status,
title: r.pesan
});
}
}

});
$(".sampel"+id_sampel).prop('selectedIndex',0);
}

$("#fileForm").submit(function(e) {
e.preventDefault();
$.validator.messages.required = '';
}).validate({
highlight: function (element, errorClass) {
$(element).closest('.form-control').addClass('is-invalid');
},
unhighlight: function (element, errorClass) {
$(element).closest(".form-control").removeClass("is-invalid");
},    
submitHandler: function(form) {
$(".simpan_user").attr("disabled", true);
var token    = "<?php echo $this->security->get_csrf_hash() ?>";
formData = new FormData();
formData.append('jenis_sampel',$(".jenis_sampel").val()),
formData.append('berat_sampel',$(".berat_sampel").val()),
formData.append('deskripsi_sampel',$(".deskripsi_sampel").val()),
formData.append('gejala',$(".gejala").val()),
formData.append('asal_sampel',$(".asal_sampel").val()),

$.ajax({
url: form.action,
processData: false,
contentType: false,
type: form.method,
data: formData,
success:function(data){
$(".simpan_user").removeAttr("disabled", true);
$(".form-control").val("");    
var r = JSON.parse(data);
const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated bounceInDown'
});

Toast.fire({
type: r.status,
title: r.message
});

}

});
return false; 
}
});
</script> 



</html>