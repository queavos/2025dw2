<?php
class ImgRZ
{
  private  $img ;
    private    $file = $_POST['id'] . "_" . microtime() . ".jpg";
    private     $info = getimagesize($img['tmp_name']);
    private    $obj=720;
    private    $w;
    private    $h;
    private $mime;
    private $imagen;

    public function __construct($id, $file)
    {
        $info = getimagesize($file['tmp_name']);
        $obj = 720;
        $w = $info[0];
        $h = $info[1];
        $this->id=$id;
        $file = $id. "_" . microtime() . ".jpg"
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
        imagecopyresampled($nimage, $imagen, 0, 0, 0, 0, $nw, $nh, $w, $h);
        imagejpeg($nimage, $file, 90);
        return $nimage;
    }


}
?>