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
<h4 class="page-title">Data Sampel Masuk</h4>
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
<div class="modal fade" id="modal_anamnesa" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog  modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Buat Data Anamnesa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form  id="fileForm" method="post" action="<?php echo base_url('Nekropsi/simpan_nekropsi') ?>">

          <div class="row">
              <div class="col">    
          <label>Id Sampel</label>
          <input type="text" name="id_sampel" readonly="" class="form-control id_sampel required" accept="text/plain">
          <label>Pelaksana1</label>
          <select name="pelaksana1" class="form-control pelaksana1 required" accept="text/plain">
          <option></option>
          <?php foreach ($data_user->result_array() as $d){ ?>
          <option value="<?php echo$d['nama_lengkap'] ?>"><?php echo$d['nama_lengkap'] ?></option>
          <?php } ?>
          </select>
          <label>Pelaksana2</label>
          <select name="pelaksana2" class="form-control pelaksana2 required" accept="text/plain">
          <option></option>
          <?php foreach ($data_user->result_array() as $d){ ?>
          <option value="<?php echo$d['nama_lengkap'] ?>"><?php echo$d['nama_lengkap'] ?></option>
          <?php } ?>
          </select>
          
          <label>Lokasi sampel</label>
          <input type="text" name="lokasi_sampel" class="form-control lokasi_sampel required" accept="text/plain">
              </div>
          <div class="col-md-3 card">
          <div class="text-center">
              <h5>Jenis Pengecekan</h5>
          </div>
              <hr>
          <label>Cek Parasit</label>
          <input type="checkbox" name="cek_parasit" class="form-check cek_parasit" value="aktif" ><br>
          <label>Cek Virus</label>
          <input type="checkbox" name="cek_virus" class="form-check cek_virus"  value="aktif"><br>
          <label>Cek Bakteri</label>
          <input type="checkbox" name="cek_bakteri" class="form-check cek_bakteri" value="aktif" ><br>
          <label>Cek Jamur</label>
          <input type="checkbox" name="cek_jamur" class="form-check cek_jamur" value="aktif" >
          </div>
              <div class="col-md-3 card">
                   <div class="text-center">
              <h5>Kaji Ulang</h5>
                   </div>
                  <hr>
          <label>Kesiapan personel</label>
          <input type="checkbox" value="siap" name="kesiapan_personel" class="form-check kesiapan_personel required" accept="text/plain" >Siap<br>
          <label>Kondisi akomodasi</label>
          <input type="checkbox" value="siap" name="kondisi_akomodasi" class="form-check kondisi_akomodasi required" accept="text/plain" >Siap<br>
          <label>Beban pekerjaan</label>
          <input type="checkbox" value="siap" name="beban_pekerjaan" class="form-check beban_pekerjaan required" accept="text/plain" >Siap<br>
          <label>Kondisi peralatan</label>
          <input type="checkbox" value="siap" name="kondisi_peralatan" class="form-check kondisi_peralatan required" accept="text/plain">Siap
          <label>Kesesuain metode</label>
          <input type="checkbox" value="siap" name="kesesuaian_metode" class="form-check kesesuaian_metode required" accept="text/plain">Siap
          
             
              </div>   
              
          </div>
              
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan Anamnesa</button>
      </form>
      </div>
    </div>
  </div>
</div>

</body>

<script type="text/javascript">
    
function proses_anamnesa(id_sampel){
$(".id_sampel").val(id_sampel);    
$('#modal_anamnesa').modal('show');
}

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
formData.append('pelaksana1',$(".pelaksana1 option:selected").val()),
formData.append('pelaksana2',$(".pelaksana2 option:selected").val()),
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
ajax: {"url": "<?php echo base_url('Nekropsi/json_data_sampel/Masuk') ?> ", 
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
{"data": "view"}

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