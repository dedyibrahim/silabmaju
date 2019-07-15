<div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-primary">
<div class="container-fluid">

<div class="row mt-5">
<div class="col text-center text-white">
<h1>Selamat Datang di Aplikasi Sistem Laboratorium Mamuju</h1>
</div>
</div>    

<div class="row mt-5 text-white">

<div onclick="cek_akses('Nekropsi','Nekropsi');" class="col-md-1 m-3 mx-auto text-center pointer card-hover"><span class="fas fa-5x fa-user"></span> <br><br>Nekropsi</div>
<div onclick="cek_akses('Manajer Teknik','Manajer_teknik');" class="col-md-1 m-3 mx-auto text-center pointer card-hover"><i class="fas fa-5x fa-users "></i><br><br>Manajer Teknik</div>
<div onclick="cek_akses('Lab Virus','Lab_virus');" class="col-md-1 m-3 mx-auto text-center pointer card-hover"><span class="fas fa-5x fas fa-flask"></span> <br><br>Lab Virus</div>
<div onclick="cek_akses('Lab Bakteri','Lab_bakteri');" class="col-md-1 m-3 mx-auto text-center pointer card-hover"><span class="fas fa-5x fas fa-flask"></span> <br><br>Lab Bakteri</div>
<div onclick="cek_akses('Lab Parasit','Lab_parasit');" class="col-md-1 m-3 mx-auto text-center pointer card-hover"><span class="fas fa-5x fas fa-flask"></span> <br><br>Lab Parasit</div>
<div onclick="cek_akses('Lab Jamur','Lab_jamur');" class="col-md-1 m-3 mx-auto text-center pointer card-hover"><span class="fas fa-5x fas fa-flask"></span> <br><br>Lab Jamur</div>
<div onclick="cek_akses('Super Admin','Pengaturan_user');" class="col-md-1 m-3 mx-auto text-center pointer card-hover"><span class="fas fa-5x fa-cogs"></span> <br><br>Pengaturan User</div>


</div>
<style>
.pointer {cursor: pointer;}
</style>    

<div class="row mt-5">
<div class="col mt-5 text-center text-white">
&copy; 2019 Mamuju 2019
</div>
</div>

<script type="text/javascript">
function cek_akses(level,controller){
$.ajax({
type:"post",
data:"level="+level,
url:"<?php echo base_url('Menu/cek_akses') ?>",
success:function(data){
var r = JSON.parse(data);
if(r.status == "success" ){
window.location.href="<?php echo base_url() ?>"+controller

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
title: r.message
});
}

}
});  
}

</script>

</div>
</div>    