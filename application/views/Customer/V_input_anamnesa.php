<div id="main-wrapper">
<?php $this->load->view('umum/V_topbar') ?>
<?php $this->load->view('umum/V_sidebar_customer') ?>
<div class="page-wrapper">
<div class="container-fluid">
<?php $this->load->view('umum/V_data_customer') ?>
<div class="row">
<div class="col">    
<div class="card">
<div class="card-body">  
<div class="col-12 d-flex no-block align-items-center">
<h4 class="page-title">Input Sampel</h4>
</div>
<hr>
<form  id="fileForm" method="post" action="<?php echo base_url('Customer/simpan_sampel') ?>">

<div class="row">
<div class="col-md-6">
<label>Jenis Sampel</label>
<input type="text" name="jenis_sample" class="form-control  jenis_sampel required" accept="text/plain">
<label>Berat Sampel</label> 
<input type="text" jenis="berat_sample" class="form-control berat_sampel required" accept="text/plain">
<label>Deskripsi Sampel</label> 
<textarea rows="5" name="deskripsi_sample" class="form-control deskripsi_sampel required" accept="text/plain"></textarea>
</div>
<div class="col-md-6">
<label>Gejala</label> 
<input type="text" name="gejala" class="form-control gejala required" accept="text/plain"">
<label>Asal Sampel</label> 
<input type="text" name="asal_sampel" class="form-control asal_sampel required" accept="text/plain">
<label>&nbsp;</label>
<button type="submit" class="btn btn-success btn-block btn-md" type="submit">Simpan Sample</button>
</div>
</form>

</div>
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