<?php defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;
class Pdf extends Dompdf{
    public $filename;
    public function __construct(){
        parent::__construct();
        $this->filename = "laporan.pdf";
    }
    protected function ci()
    {
        return get_instance();
    }
    public function load_view($view, $data = array()){
        $html = $this->ci()->load->view($view, $data, TRUE);
        $options = new \Dompdf\Options();
        $options->set('isRemoteEnabled', true);
        //$dompdf = new \Dompdf\Dompdf($options);

        $this->load_html($html);
        $this->render();
        $this->output(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $this->stream($this->filename, array("Attachment" => false,'isHtml5ParserEnabled', true));
    }
}