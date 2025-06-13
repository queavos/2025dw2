<?php
include_once '../extlib/phpqrcode/qrlib.php';
class QrGen {

    private $outdir='../especies/qr/';
    private $file='qr.png';
    private $url='';
    private $ruta;    
    public function __construct($url,$id) {
        $this->url=$url;
        $this->file=$id.".png";
    }
    public function generarQR(){
        $ruta=$this->outdir.$this->file;
        QRcode::png($this->url, $ruta, QR_ECLEVEL_L, 10);
        return $ruta;
    }

}