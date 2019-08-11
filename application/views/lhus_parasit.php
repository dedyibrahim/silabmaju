<link href="<?php echo base_url() ?>assets/dist/css/style.min.css" rel="stylesheet" type="text/css"/>
<body>
<?php $static = $query->row_array();?>    
<div class="container-fluid">
 
    <div class="col-sm-12">
        <img style="width: 110px; height: auto;" src="<?php echo base_url()?>assets/images/kkp.png">
        <div  class="text-center col-sm-9" style="position:absolute;">    
        <b><span style="font-size:18px; "> KEMENTERIAN KELAUTAN DAN PERIKANAN</span><br>
            <span style="font-size:19px; ">BADAN KARANTINA IKAN, PENGENDALIAN MUTU</span><br>
            <span style="font-size:19px; ">DAN KEAMANAN HASIL PERIKANAN</span></b><br>
            <span>Jl.Martadinata,Lorong Nelayan Pelabuhan Ferry,Simboro <br> Mamuju-Sulbar</span>
        </div>    
    </div>
    <hr>
    <div class="col-sm-12 text-center">
        <u>LAPORAN HASIL UJI SEMENTARA</u><br>
        REPORT OF TEMPORARY TEST RESULT
        
    </div>
    <br>
<div class="col-sm-12">
    <u>This is to certit'z that :</u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Hasil Lab Jamur &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tanggal : <?php echo date('d F Y ') ?><br>
<i>Menyatakan bahwa</i>
</div>
    <br>    
<div class="col-sm-12">
<u>Name Of sample :</u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $static['jenis_sampel'] ?><br>
<i>Nama Sample</i>
</div>
    <br>  
 <div class="col-sm-12">
<u>No Reference HC :</u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $static['id_anamnesa'] ?><br>
<i>No Referensi HC</i>
</div>
    <br>  
<div class="col-sm-12">
<u>Customer :</u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $static['nama_lengkap'] ?><br>
<i>Pelanggan </i>
</div>
    <br>
    <div class="col-sm-12">
      
        <table class="table table-sm table-hover table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Parameter</th>
            <th>Hasil</th>
            <th>Metode Lab</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        <?php  $no =1;foreach ($query->result_array() as $d){ ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td > VIRUS </td>
            <td><?php echo $d['hasil_parasit'] ?></td>
            <td><?php echo $d['metode_parasit'] ?></td>
            <td><?php echo $d['jumlah_parasit'] ?></td>
       </tr>
        <?php } ?>
    </tbody>
</table>
    </div>

    <div class="row">
    <div class="col-xs-4 ">
            Pelaksana Uji 1
        </div>
        <div class="col-xs-4 text-right">
            Pelaksana Uji 2
        </div>
    
    </div>
    <br> <br>
    <br> <br>
    <?php foreach ($petugas_lab->result_array() as $d){
        $p[] = array(
            'nama_lengkap' => $d['nama_lengkap']
        );
    }
    ?>
    <div class="row">
        
        <div class="col-xs-4 ">
            <?php echo $p[0]['nama_lengkap']; ?>
        </div>
        <div class="col-xs-4 text-right ">
    <?php echo $p[1]['nama_lengkap'];  ?>
        </div>
    </div>
</div>
    
    
  
</body>    