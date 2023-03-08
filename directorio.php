<?php

date_default_timezone_set('America/Caracas');

if (isset($_GET['dir'])) {
    $dir = $_GET['dir'];
    $error = "";

    if (isset($_POST['crear-nota'])) {
   
            if (isset($_POST['nombre-nota']) && isset($_POST['valor-nota']) && isset($_POST['dir'])) {
                $name = $_POST['nombre-nota'];
                $dir = $_POST['dir'];
                $content = $_POST['valor-nota'];
                $direct = "file/$dir/$name.html";
                $error = '';
                try {

                    if (file_exists($direct)) {
                        $error = "Archivo ya existe&#10071&#10071&#10071";
                    } else {
                        $archivo = fopen($direct, 'a');
                        fputs($archivo, $content);
                        fclose($archivo);

                        header('Location: directorio.php?dir=' . $dir);
                    }
                } catch (Exception $e) {
                    echo 'Excepción capturada: ',  $e->getMessage(), "\n\n";
                }
            }
        
    }else{
        if (
            isset($_POST['valor-nota'])
            && isset($_GET['dir'])
            && isset($_GET['note'])
        ) {
            $name = $_GET['note'];
            $dir = $_GET['dir'];
            $content = $_POST['valor-nota'];
            $direct = "file/$dir/$name";
            $error = '';
            try {

                if (file_exists($direct)) {
                    // $error = "Archivo ya existe&#10071&#10071&#10071";
                    unlink($direct);
                }
                // else {
                    $archivo = fopen($direct, 'a');
                    fputs($archivo, $content);
                    fclose($archivo);

                    header('Location: directorio.php?dir=' . $dir);
                // }
            } catch (Exception $e) {
                echo 'Excepción capturada: ',  $e->getMessage(), "\n\n";
            }
        }
    }

    unset($_POST['crear-nota']);
    unset($_POST['nombre']);
} else {
    header("Location: index.php");
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <link rel="stylesheet" href="styles.css">

    <title>Notes</title>
</head>

<body>
    <div class="container-directorio">
        <div class="image-2">
            <img src="assets/logo.png">
        </div>
        <div class="text">
            <h1>Directorio <?php echo $dir ?></h1>
        </div>
    </div>

    <div class="container-2">
        
        <p id="crear-archivo">
            <button class="btn-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Crear archivo</button>
        </p>

        <div class="collapse" id="collapseExample">
            <form action="directorio.php?dir=<?php echo $dir ?>" method="post">
                <p><input type="text" required="required" name="nombre-nota" placeholder="Nombre del archivo" styles="padding: 2px 4px 2px 4px"> .txt</p>
                <textarea name="valor-nota" required class="valor-nota-1" id="" cols="30" placeholder="Escribe una nota" rows="10"></textarea>
                <br>
                <input type="hidden" name="dir" value="<?php echo $dir ?>">
                <button class="btn-2" type="submit" name="crear-nota" value="create" styles="margin-left: 20px;">Guardar</button>
            </form>
            <br>
        </div>
        

        <p><?php echo $error ?></p>

        <div class="row">

            <?php
            $directorio = "file/" . $dir;
            $direc  = scandir($directorio);

            if (count($direc) > 2) {
                foreach ($direc as $valor) {
                    if ('.' !== $valor && '..' !== $valor) {

                        $file = "file\\" . $dir . '\\' . $valor;

                        if (filesize($file) > 0) {
                            $contents = file_get_contents($file, FILE_USE_INCLUDE_PATH);
                        }else {
                            $contents = 'No hay contenido aun';
                        }

            ?>

            <div class="col">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h3>Propiedades:</h3>
                        <h6 class="card-subtitle mb-2 text-muted">Nombre: <?php echo rtrim($valor, '(.html)') ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted">Tamaño: <?php echo filesize($file) ?> bytes</h6>
                        <h6 class="card-subtitle mb-2 text-muted"> Nota: <i><?php echo substr($contents, 0, 20); ?>...</i></h6>
                        <h6 class="card-subtitle mb-2 text-muted"> Fecha de creacion: <?php echo date("d/m/y", filectime($file));?> </h6>
                        <h6 class="card-subtitle mb-2 text-muted"> Ultima modificacion: <?php echo date("d/m/y H:i:s", filemtime($file));?> </h6>
                        <a href="archivo.php?note=<?php echo $valor ?>&dir=<?php echo $dir ?>" class="card-link">Ver </a>
                        <a href="eliminar/eliminar-archivo.php?note=<?php echo $valor ?>&dir=<?php echo $dir ?>" class="card-link text-danger">Eliminar</a>
                    </div>
                </div>
            </div>
            <?php

                        
                    }
                }
            }

            ?>

        </div>

        <button class="btn-2" type="submit" onClick="document.location.href='index.php'"> Volver</button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>