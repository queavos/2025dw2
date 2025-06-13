<?php

if ($_POST['id']) {
    //$img = $_FILES[$_POST['imagen']];
    $img = $_FILES['imagen'];
    $file = $_POST['id'] . "_" . microtime() . ".jpg";
    $info = getimagesize($img['tmp_name']);
    $obj=720;
    $w= $info[0];
    $h= $info[1];
    switch ($info['mime']) {
        case 'image/jpeg':
            $imagen=imagecreatefromjpeg($img['tmp_name']);
            echo "entro jpg";
            break;
        case 'image/png':
            $imagen = imagecreatefrompng($img['tmp_name']);
            echo "entro png";
            break;
        case 'image/gif':
            $imagen = imagecreatefromgif($img['tmp_name']);
            echo "entro git";
            break;
        default:
            # code...
            break;
    }
    if ($w>$h)
    {
        $nw= $obj;
        $nh=($h*$nw)/$w;
    } elseif($w < $h)
    {
        $nh= $obj;
        $nw=($w*$nh)/$h;
    } else
    {
        $nw = $obj;
        $nh = $obj;
    }
    $nimage=imagecreatetruecolor($nw, $nh);
    imagecopyresampled($nimage,$imagen,0,0,0,0,$nw,$nh,$w,$h);
    
    imagejpeg($nimage, $file,90);
    echo "<pre>";
    print_r($info);
    echo "</pre>";
    
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="img.php" method="post" enctype="multipart/form-data">
        <input type="text" name="id" value="33">
        <label for="imagen">Imagen</label>
        <input type="file" name="imagen" />
        <button type="submit">Enviar</button>


    </form>
</body>

</html>