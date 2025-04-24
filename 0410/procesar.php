<?php
                session_start();

                if (!isset($_SESSION['historial_post'])) {
                    $_SESSION['historial_post'] = [];
                }

                if (!empty($_POST)) {
                    // Guardar una copia exacta del POST actual
                    $_SESSION['historial_post'][] = $_POST;
                }

                // Mostrar el historial
                echo "<pre>";
            //    print_r($_SESSION['historial_post']);
                echo "</pre>";

                ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <pre>
        <?php // print_r($_SESSION); 
                ?>
    </pre>
    <table>
        <tr>
            <td>Nombre</td>
            <td>Apellido</td>
        </tr>
        <?php foreach($_SESSION['historial_post'] as $dato )
        { ?>
        <tr>
            <td><?php echo $dato['nombre']; ?></td>
            <td><?php echo $dato['apellido']; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>

</html>