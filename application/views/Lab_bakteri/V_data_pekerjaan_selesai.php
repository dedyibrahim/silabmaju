<div id="main-wrapper">
<?php $this->load->view('umum/V_topbar_lab_jamur') ?>
<?php $this->load->view('umum/V_sidebar_lab_jamur') ?>
<div class="page-wrapper">
<div class="container-fluid">
<?php $this->load->view('umum/V_data_bakteri') ?>
<div class="row">
<div class="col">    
<div class="card">
<div class="card-body">  
<div class="col-12 d-flex no-block align-items-center">
<h4 class="page-title">Data Sampel Proses</h4>
</div>
<hr>
<table style="width:100%;" id="data_pekerjaan" class="table table-striped table-condensed table-sm table-bordered  table-hover table-sm"><thead>
<tr role="row">
<th  align="center" aria-controls="datatable-fixed-header" >No</th>
<th  align="center" aria-controls="datatable-fixed-header" >Nama petugas</th>
<th  align="center" aria-controls="datatable-fixed-header" >Jenis sampel</th>
<th  align="center" aria-controls="datatable-fixed-header" >Gejala</th>
<th  align="center" aria-controls="datatable-fixed-header" >Asal sampel</th>
<th  align="center" aria-controls="datatable-fixed-header" >Aksi</th>
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


<!-- Modal -->
<div class="modal fade" id="buat_hasil_uji" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog  modal-md modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalCenterTitle">Berikan hasil uji</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form  id="fileForm" method="post" action="<?php echo base_url('Lab_jamur/simpan_hasil_uji') ?>">
    
<div class="row">
    <label>Hasil uji</label> 
    <input type="hidden" name="id_anamnesa" placeholder="id_anamnesa" class="form-control id_anamnesa required" accept="text/plain">
    <input type="text" name="hasil_uji" placeholder="hasil uji" class="form-control hasil_uji required" accept="text/plain">
    <label>Jumlah</label> 
    <input type="text" name="jumlah_uji" placeholder="jumlah uji" class="form-control jumlah_uji required" accept="text/plain">
    <label>Metode Jamur</label> 
    <input type="text" name="metode_jamur" placeholder="metode jamur" class="form-control metode_jamur required" accept="text/plain">
</div>
</div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success btn-block btn-sm simpan_hasil_uji">Simpan hasil uji</button>
    </div>    
</div>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="hasil_uji" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog  modal-lg modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalCenterTitle">Hasil Uji</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body data_hasil">

</div>    
</div>
</div>
</div>


</body>

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

var t = $("#data_pekerjaan").dataTable({
initComplete: function() {
var api = this.api();
$('#data_pekerjaan')
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
ajax: {"url": "<?php echo base_url('Lab_bakteri/json_data_pekerjaan/Selesai') ?> ", 
"type": "POST",
data: function ( d ) {
d.token = '<?php echo $this->security->get_csrf_hash(); ?>';
}
},
columns: [
{
"data": "id_anamnesa",
"orderable": false
},
{"data": "nama_lengkap"},
{"data": "jenis_sampel"},
{"data": "gejala"},
{"data": "asal_sampel"},
{"data": "view_selesai"}

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


function buat_hasil_uji(id_anamnesa){
$('#buat_hasil_uji').modal('show');
$(".id_anamnesa").val(id_anamnesa);
}

function hapus(id_jamur,id_anamnesa){
$.ajax({
type:"post",
data:"id_jamur="+id_jamur,
url:"<?php echo base_url("Lab_jamur/hapus_jamur") ?>",
success:function(data){
lihat_hasil(id_anamnesa);    
}
});   
}

function lihat_hasil(id_anamnesa){
var status = "Selesai";
$.ajax({
type:"post",
data:"id_anamnesa="+id_anamnesa+"&status="+status,
url:"<?php echo base_url("Lab_bakteri/lihat_hasil") ?>",
success:function(data){
$(".data_hasil").html(data);    
$('#hasil_uji').modal('show');    
}
});
}


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
formData.append('hasil_uji',$(".hasil_uji").val()),
formData.append('jumlah_uji',$(".jumlah_uji").val()),
formData.append('metode_jamur',$(".metode_jamur").val()),
formData.append('id_anamnesa',$(".id_anamnesa").val()),

$.ajax({
url: form.action,
processData: false,
contentType: false,
type: form.method,
data: formData,
success:function(data){
$(".simpan_hasil_uji").removeAttr("disabled", true);
$('#buat_hasil_uji').modal('hide');
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