<link href="<?php echo base_url() ?>assets/dist/css/style.min.css" rel="stylesheet" type="text/css"/>
<body>
<?php $static = $query->row_array();?>    
<div class="container-fluid">
 
    <div class="col-sm-12">
        <img style="width: 110px; height: auto;" src="<?php echo base_url()?>assets/images/kkp.png">
        <div  class="text-center col-sm-9" style="position:absolute;">    
        <b><span style="font-size:18px; "> THE REPUBLIC OF INDONESIA</span><br>
            <span style="font-size:19px; ">DAN KEAMANAN HASIL PERIKANAN</span></b><br>
        </div>    
    </div>
    <hr>
    <div class="col-sm-12 text-center">
        <u>TEST RESULT</u><br>
        HASIL UJI
        
    </div>
    <br>
<div class="col-sm-12">
    <u>This is to certit'z that :</u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Hasil Lab Bakteri &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tanggal : <?php echo date('d F Y ') ?><br>
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
            <th>Method</th>
            <th>Result</th>
            <th>Requirement</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="5"><?php echo $static['jenis_sampel'] ?></td>
        </tr>
        
        <?php $no=1; foreach ($query->result_array() as $p){ ?>
        <tr>
            <td><?php echo $no++; ?></td>    
            <td><?php echo $p['nama_distribusi']; ?></td>
            
           <?php if($p['nama_distribusi'] == 'Lab Virus'){ 
               $data_lab_virus = $this->db->get_where('lab_virus',array('id_anamnesa'=>$static['id_anamnesa']));
               ?>
            
            
            <td>
             <?php foreach ($data_lab_virus->result_array() as $v){ ?>
              <?php echo $v['metode_virus']; ?><br>
              <?php } ?>
                
            </td>
            <td><?php foreach ($data_lab_virus->result_array() as $v){ ?>
              <?php echo $v['hasil_virus']; ?><br>
              <?php } ?></td>
            <td><?php foreach ($data_lab_virus->result_array() as $v){ ?>
              <?php echo $v['jumlah_virus']; ?><br>
              <?php } ?></td>
           <?php }?>
            
            
            <?php if($p['nama_distribusi'] == 'Lab Jamur'){ 
                 $data_lab_jamur = $this->db->get_where('lab_jamur',array('id_anamnesa'=>$static['id_anamnesa']));
                ?>
            <td>
                <?php foreach ($data_lab_jamur->result_array() as $j){ ?>
              <?php echo $j['metode_jamur']; ?><br>
              <?php } ?>
            </td>
            <td>
                <?php foreach ($data_lab_jamur->result_array() as $j){ ?>
              <?php echo $j['hasil_jamur']; ?><br>
              <?php } ?>
            </td>
            <td><?php foreach ($data_lab_jamur->result_array() as $j){ ?>
              <?php echo $j['jumlah_jamur']; ?><br>
              <?php } ?></td>
            
            
            
           <?php }?>
            <?php if($p['nama_distribusi'] == 'Lab Parasit'){ 
             $data_lab_parasit = $this->db->get_where('lab_parasit',array('id_anamnesa'=>$static['id_anamnesa']));
                ?>
            <td><?php foreach ($data_lab_parasit->result_array() as $r){ ?>
              <?php echo $r['metode_parasit']; ?><br>
              <?php } ?></td>
            <td><?php foreach ($data_lab_parasit->result_array() as $r){ ?>
              <?php echo $r['hasil_parasit']; ?><br>
              <?php } ?></td></td>
            <td><?php foreach ($data_lab_parasit->result_array() as $r){ ?>
              <?php echo $r['jumlah_parasit']; ?><br>
              <?php } ?></td></td>
           <?php }?>
            
            <?php if($p['nama_distribusi'] == 'Lab Bakteri'){ 
                 $data_lab_bakteri = $this->db->get_where('lab_bakteri',array('id_anamnesa'=>$static['id_anamnesa']));
              
                ?>
            <td>
                <?php foreach ($data_lab_parasit->result_array() as $b){ ?>
              <?php echo $b['metode_parasit']; ?><br>
              <?php } ?>
            </td>
            <td><?php foreach ($data_lab_parasit->result_array() as $b){ ?>
              <?php echo $b['hasil_parasit']; ?><br>
              <?php } ?></td>
            <td><?php foreach ($data_lab_parasit->result_array() as $b){ ?>
              <?php echo $b['jumlah_parasit']; ?><br>
              <?php } ?></td>
           <?php }?>
            
        </tr>
           
        <?php } ?>
        
    </tbody>
</table>
    </div>

    
    
    
</div>
    
    
  
</body>    