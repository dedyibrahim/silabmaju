<div id="main-wrapper">
<?php $this->load->view('umum/V_topbar_nekropsi') ?>
<?php $this->load->view('umum/V_sidebar_nekropsi') ?>
<div class="page-wrapper">
<div class="container-fluid">
<?php $this->load->view('umum/V_data_customer') ?>
<div class="row">
<div class="col">    
<div class="card">
<div class="card-body">  
<div class="col-12 d-flex no-block align-items-center">
<h4 class="page-title">Data Sampel Proses</h4>
</div>
<hr>
<table style="width:100%;" id="data_anamnesa" class="table table-striped table-condensed table-sm table-bordered  table-hover table-sm"><thead>
<tr role="row">
<th  align="center" aria-controls="datatable-fixed-header" >No</th>
<th  align="center" aria-controls="datatable-fixed-header" >Id Sampel</th>
<th  align="center" aria-controls="datatable-fixed-header" >Nama customer</th>
<th  align="center" aria-controls="datatable-fixed-header" >Jenis Sampel</th>
<th  align="center" aria-controls="datatable-fixed-header" >Berat Sampel</th>
<th  align="center" aria-controls="datatable-fixed-header" >Deskripsi</th>
<th  align="center" aria-controls="datatable-fixed-header" >Tgl Input</th>
<th  align="center" aria-controls="datatable-fixed-header" >Gejala</th>
<th  align="center" aria-controls="datatable-fixed-header" >Asal Sampel</th>
<th  align="center" aria-controls="datatable-fixed-header" >Status Sampel</th>
</thead>
<tbody align="center">
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
    

$("#fileForm").submit(function(e) {
e.preventDefault();
$.validator.messages.required = '<span class="text-danger">tidak boleh kosong</span>';
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
formData.append('id_sampel',$(".id_sampel").val()),
formData.append('pelaksana1',$(".pelaksana1").val()),
formData.append('pelaksana2',$(".pelaksana2").val()),
formData.append('lokasi_sampel',$(".lokasi_sampel").val()),


formData.append('kesiapan_personel',$(".kesiapan_personel").val()),
formData.append('kondisi_akomodasi',$(".kondisi_akomodasi").val()),
formData.append('beban_pekerjaan',$(".beban_pekerjaan").val()),
formData.append('kondisi_peralatan',$(".kondisi_peralatan").val()),
formData.append('kesesuaian_metode',$("input[name=kesesuaian_metode]:checked").val()),

formData.append('cek_parasit',$("input[name=cek_parasit]:checked").val()),
formData.append('cek_virus',$("input[name=cek_virus]:checked").val()),
formData.append('cek_bakteri',$("input[name=cek_bakteri]:checked").val()),
formData.append('cek_jamur',$("input[name=cek_jamur]:checked").val()),



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

<script type="text/javascript">
$(document).ready(function() {
$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
{
return {
"iStart": oSettings._iDisplayStart,
"iEnd": oSettings.fnDisplayEnd(),
"iLength": oSettings._iDisplayLength,
"iTotal": oSettings.fnRecordsTotal(),
"iFilteredTotal": oSettings.fnRecordsDisplay(),
"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
};
};

var t = $("#data_anamnesa").dataTable({
initComplete: function() {
var api = this.api();
$('#data_anamnesa')
.off('.DT')
.on('keyup.DT', function(e) {
if (e.keyCode == 13) {
api.search(this.value).draw();
}
});
},
oLanguage: {
sProcessing: "loading..."
},
processing: true,
serverSide: true,
ajax: {"url": "<?php echo base_url('Nekropsi/json_data_sampel/Proses') ?> ", 
"type": "POST",
data: function ( d ) {
d.token = '<?php echo $this->security->get_csrf_hash(); ?>';
}
},
columns: [
{
"data": "id_sampel",
"orderable": false
},
{"data": "id_sampel"},
{"data": "nama_lengkap"},
{"data": "jenis_sampel"},
{"data": "berat_sampel"},
{"data": "deskripsi_sampel"},
{"data": "tgl_input"},
{"data": "gejala"},
{"data": "asal_sampel"},
{"data": "status_sampel"},

],
order: [[0, 'desc']],
rowCallback: function(row, data, iDisplayIndex) {
var info = this.fnPagingInfo();
var page = info.iPage;
var length = info.iLength;
var index = page * length + (iDisplayIndex + 1);
$('td:eq(0)', row).html(index);
}
});
});

</script>

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