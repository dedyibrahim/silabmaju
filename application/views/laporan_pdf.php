<link href="<?php echo base_url() ?>assets/dist/css/style.min.css" rel="stylesheet" type="text/css"/>
<div class="container-fluid">
<div class="row">
    <div class="col-md-4">
        <img style="width: 110px; height: auto;" src="<?php echo base_url()?>assets/images/kkp.png">
    </div>
    <div class="col text-center">
        <b><span style="font-size:18px; "> KEMENTERIAN KELAUTAN DAN PERIKANAN</span><br>
            <span style="font-size:19px; ">BADAN KARANTINA IKAN, PENGENDALIAN MUTU</span><br>
            <span style="font-size:18px; ">DAN KEAMANAN HASIL PERIKANAN</span></b><br>
            <span>Jl.Martadinata,Lorong Nelayan Pelabuhan Ferry,Simboro <br> Mamuju-Sulbar</span>
    </div>    
</div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-sm table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Parameter</th>
            <th>Hasil</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        <?php  $no =1;foreach ($query->result_array() as $d){ ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td rospan="2"> VIRUS </td>
            <td><?php echo $d['hasil_virus'] ?></td>
            <td><?php echo $d['jumlah_virus'] ?></td>
       </tr>
        <?php } ?>
    </tbody>
    
        </div>
    </div>    
  
    
</table>
</div>