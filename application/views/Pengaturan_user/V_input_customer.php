<div id="main-wrapper">
<?php $this->load->view('umum/V_topbar') ?>
<?php $this->load->view('umum/V_sidebar_user') ?>
<div class="page-wrapper">
<div class="container-fluid">
<?php $this->load->view('umum/V_data') ?>
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-body">  
<div class="col-12 d-flex no-block align-items-center">
<h4 class="page-title">Input User</h4>
</div> 
<form  id="fileForm" method="post" action="<?php echo base_url('Pengaturan_user/simpan_customer') ?>">
<div class="divide-bottom"><hr></div>
<div class="row ">
<div class="col-md-6">
    
<label>Nama Depan</label>
<input type="text" name="nama_depan" class="form-control nama_depan required" accept="text/plain">

<label>Nama Belakang</label>
<input type="text" name="nama_belakang" class="form-control nama_belakang required" accept="text/plain">

<label>Alamat Lengkap</label>
<textarea class="form-control required alamat_lengkap" accept="text/plain"></textarea>

</div>

<div class="col-md-6">
<label>No Kontak</label>
<input type="text" name="no_kontak" class="form-control no_kontak required" accept="text/plain">

<label>Email</label>
<input type="text" name="email_customer" class="form-control email_customer required" accept="text/plain">

<label>&nbsp;</label>
<button type="submit" class="btn btn-block btn-primary btn-md">Simpan Customer <span class="fa fa-save"></span></button>
</div>


</div>    
</div>    
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
formData.append('nama_depan',$(".nama_depan").val()),
formData.append('nama_belakang',$(".nama_belakang").val()),
formData.append('alamat_lengkap',$(".alamat_lengkap").val()),
formData.append('email_customer',$(".email_customer").val()),
formData.append('no_kontak',$(".no_kontak").val()),

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