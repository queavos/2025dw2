<?php
session_start();
$variable = "Pepe";
$lista = [];
$lista = ["limon", "naranja", 2];
$personas = [];
$personas[0]["nombre"] = "Pepe";
$personas[0]["apellido"] = "Pena";
array_push($personas, ['nombre' => "Jose", 'apellido' => 'Meza']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h3><?php echo "Hola " . $variable . ", te gustan los " . $lista[0] . " o las " . $lista[1]; ?></h3>
    <pre>
        <?php
        ///print_r($personas);
        ?>
    </pre>
    <form action="procesar.php?mod=recibir" method="POST">
        <input type="text" name="apellido" placeholder="Apellido" /> <br />
        <input type="text" name="nombre" placeholder="Nombre" /><br />
        <button type="submit">Enviar</button>
    </form>
</body>

</html>