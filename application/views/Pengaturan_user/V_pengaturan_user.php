<div id="main-wrapper">
<?php $this->load->view('umum/V_topbar') ?>
<?php $this->load->view('umum/V_sidebar_user') ?>
<div class="page-wrapper">
<div class="container-fluid">
<?php $this->load->view('umum/V_data') ?>
<div class="row">
<?php $this->load->view('V_konten') ?>
</div>
</div>
<?php $this->load->view('umum/V_footer') ?>
</div>
</div>
</body>
</html>