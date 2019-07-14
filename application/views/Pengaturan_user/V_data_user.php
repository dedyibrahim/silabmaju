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
<h4 class="page-title">Data User</h4>
</div> 
<hr>
<div class="col">
<table style="width:100%;" id="data_user" class="table table-striped table-condensed table-sm table-bordered  table-hover table-sm"><thead>
<tr role="row">
<th  align="center" aria-controls="datatable-fixed-header" >No</th>
<th  align="center" aria-controls="datatable-fixed-header" >Nama lengkap</th>
<th  align="center" aria-controls="datatable-fixed-header" >Username</th>
<th  align="center" aria-controls="datatable-fixed-header" >Status</th>
<th  align="center" aria-controls="datatable-fixed-header" >Aksi</th>
</thead>
<tbody align="center">
</table>
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
   function hapus_user(id_user){
$.ajax({
type:"post",
data:"id_user="+id_user,
url:"<?php echo base_url('Pengaturan_user/hapus_user') ?>",
success:function(){
    
  refresh_table_user();  
}
    
});   
    
} 

function refresh_table_user(){
var table = $('#data_user').DataTable();
table.ajax.reload( function ( json ) {
$('#data_user').val( json.lastInput );
})
}

    
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

var t = $("#data_user").dataTable({
initComplete: function() {
var api = this.api();
$('#data_user')
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
ajax: {"url": "<?php echo base_url('Pengaturan_user/json_data_user') ?> ", 
"type": "POST",
data: function ( d ) {
d.token = '<?php echo $this->security->get_csrf_hash(); ?>';
}
},
columns: [
{
"data": "id_user",
"orderable": false
},
{"data": "nama_lengkap"},
{"data": "username"},
{"data": "status"},
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
</html>