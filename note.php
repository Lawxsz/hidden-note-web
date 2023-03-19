<!DOCTYPE html>
<html>
<head>
    <title>Hidden Note</title>
    <body class="thunder">
    <h1 id="hd1">Hidden Note</h1>
    <h1 id="hd2">Hidden Note</h1>

    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- to adapt to mobile devices-->
</body>
    <style>

        body {
            background-color: #1E1E1E;
            color: #EDEDED;
            font-family: Arial, sans-serif;
            animation: color-change 10s infinite;
            overflow-x: hidden;
            margin: 0;
            padding: 0; 
        }

        @keyframes color-change {
            0% {
                background-color: #1E1E1E;
            }


        }
    #hd1 {
    display: none;
}

    @media (max-width: 767px) {
    #hd1 {
    display: block;
  }
}
    #hd1 {
        position: relative;
        top: -10px;
        left: 5%;
        font-size: 350%;
        text-shadow: 0 0 1px rgb(255, 255, 255),
        0 0 1px rgb(255, 255, 255),
        0 0 1px rgb(255, 255, 255),
        0 0 1px rgb(255, 255, 255),
        0 0 1px rgb(255, 255, 255);
    }
    #hd2 {
    display: none;
}

@media (min-width: 768px) {
  #hd2 {
    display: block;
  }
}
    #hd2 {
        position: relative;
        top: -10px;
        left: 35%;
        font-size: 350%;
        text-shadow: 0 0 1px rgb(255, 255, 255),
        0 0 1px rgb(255, 255, 255),
        0 0 1px rgb(255, 255, 255),
        0 0 1px rgb(255, 255, 255),
        0 0 1px rgb(255, 255, 255);
    }

        form {
            background-color: #2C2C2C;
            border-radius: 5px;
            padding: 35px;
            margin: 20px auto;
            max-width: 600px;
            animation: slide-in 0.5s ease-out;
        }

        @keyframes slide-in {
            0% {
                transform: translateY(-20px);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        label {
            text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.3);
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
            transition: transform 0.2s ease-in-out;
            position: relative;
            top: 30px;
            left: 555px;
        }

        textarea {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #3B3B3B;
            resize: vertical;
            color: #EDEDED;
        }

        input[type='submit'] {
            background-color: transparent;
            background-image: linear-gradient(to right, #A374EF, #AE7DFD, #7A33EE);
            border: none;
            color: #EDEDED;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s ease-in-out;
        }

        input[type='submit']:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .enlace {
            background-color: #2C2C2C;
            border-radius: 5px;
            padding: 20px;
            margin: 20px auto;
            max-width: 600px;
            text-align: center;
    </style>

</head>
<body>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mensaje = $_POST['mensaje'];
    $tiempo_vida = $_POST['tiempo_vida'];

    $nombre_archivo = uniqid();
    $archivo = fopen($nombre_archivo, 'w');

    fwrite($archivo, $mensaje . "\n");
    fwrite($archivo, time() + $tiempo_vida);

    fclose($archivo);

    echo "<div class='enlace'>Note created!: <a href='http://{$_SERVER['HTTP_HOST']}/note.php?clave={$nombre_archivo}'>{$_SERVER['HTTP_HOST']}/note.php?clave={$nombre_archivo}</a></div>";
    exit;
}


if (isset($_GET['clave'])) {
    $clave = $_GET['clave'];

    $archivo = fopen($carpeta_notas . $clave, 'r');
    $contenido = fread($archivo, filesize($carpeta_notas . $clave));
    fclose($archivo);

    list($mensaje, $fecha_caducidad) = explode("\n", $contenido);

    if (time() > $fecha_caducidad) {
        echo "<label>Expired note.</label>";
    } else {
        echo "
        <form method='post'>
            <textarea name='mensaje' rows='10' cols='30'>$mensaje</textarea><br>
            <input a href='index.php' type='submit' value='Done'>
        </form>";
    }
    unlink($clave);
}
?>
