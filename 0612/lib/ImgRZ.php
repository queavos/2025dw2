<?php

class ImgRZ
{
    private $id;
    private $img ;
    private $file;
    private $info;
    public  $obj=720;
    private $w;
    private $h;
    private $mime;
    private $imagen;
    public  $outdir=".";
    public function __construct($id, $file)
    {
        $info = getimagesize($file['tmp_name']);
    
        $this->w = $info[0];
        $this->h = $info[1];
        $this->id=$id;
        $this->file = $id. "_" . microtime(true) . ".jpg";
        $this->mime= $info['mime'];
        switch ($info['mime']) {
            case 'image/jpeg':
                $this->imagen = imagecreatefromjpeg($file['tmp_name']);
                echo "entro jpg";
                break;
            case 'image/png':
                $this->imagen = imagecreatefrompng($file['tmp_name']);
                echo "entro png";
                break;
            case 'image/gif':
                $this->imagen = imagecreatefromgif($file['tmp_name']);
                echo "entro git";
                break;
            default:
                # code...
                break;
        }
    }
    public function guardar() {
        if ($this->w > $this->h) {
            $nw = $this->obj;
            $nh = ($this->h * $nw) / $this->w;
        } elseif ($this->w < $this->h) {
            $nh = $this->obj;
            $nw = ($this->w * $nh) / $this->h;
        } else {
            $nw = $this->obj;
            $nh = $this->obj;
        }
        $nimage = imagecreatetruecolor($nw, $nh);
        imagecopyresampled($nimage,  $this->imagen, 0, 0, 0, 0, $nw, $nh, $this->w, $this->h);
        imagejpeg($nimage, $this->outdir.'/'. $this->file, 90);
        return $this->file;
    }

}
?>