<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica de validacion</title>
</head>

<body>

    <form method="post" action="">
        Email: <input type="text" name="email"><br>
        Edad: <input type="number" name="edad"><br>
        Sitio web: <input type="text" name="web"><br>
        Comentario:<br>
        <textarea name="comentario"></textarea><br>
        <input type="submit" value="Validar">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Validar email
        if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            echo "✅ Email válido<br>";
        } else {
            echo "❌ Email inválido<br>";
        }

        // Edad entre 1 y 120
        $options = ["options" => ["min_range" => 1, "max_range" => 120]];
        if (filter_var($_POST["edad"], FILTER_VALIDATE_INT, $options)) {
            echo "✅ Edad válida<br>";
        } else {
            echo "❌ Edad fuera del rango<br>";
        }

        // Validar URL
        if (filter_var($_POST["web"], FILTER_VALIDATE_URL)) {
            echo "✅ URL válida<br>";
        } else {
            echo "❌ URL inválida<br>";
        }

        // Sanear comentario
        $comentario = filter_var($_POST["comentario"], FILTER_SANITIZE_STRING);
        echo "🧼 Comentario limpio: <br><pre>$comentario</pre>";
    }
    ?>

</body>

</html>