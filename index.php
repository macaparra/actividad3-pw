<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="assets/logo.png" type="image/x-icon"/>
    <title>Notes</title>
</head>

<body>
    <div class="container">
        <div class="image">
            <img src="assets/logo.png">
        </div>
        <div class="text">
            <h1>Notes</h1>
        </div>
    </div>

<div>    
    <div class="create" id="create">
        <div class="image">
            <img id="img-folder" src="assets/folder.png">
        </div>
        <form action="index.php" method="post">
            <input type="text" name="nombre" required="required" styles="padding: 2px 4px 2px 4px">
            <button type="submit" class="btn" name="crear" value="crear" styles="margin-left: 20px;">Crear</button>
        </form>
        <br>
    </div>

</div>

<?php

    $error = '';


    if (isset($_POST['crear']) &&  isset($_POST['nombre'])) {

        $nombre = $_POST['nombre'];
        $nombredir = "file/$nombre";

    try {

        if (!(is_dir($nombredir))) {

            mkdir($nombredir);
            $error = 'Directorio creado';
        } else {
            $error = '';
        }
    }   catch (Exception $e) {
         echo 'Error: ',  $e->getMessage(), "\n\n";
        }
    }

    unset($_POST['crear']);
    unset($_POST['nombre']);

?>

<div class="row row-cols-4 w-75 mx-auto">
    <?php
    try {
        $directorio = 'file';
        $directorios  = scandir($directorio);

        foreach ($directorios as $directorioec) {
            if ('.' !== $directorioec && '..' !== $directorioec) {

    ?>

    <div class="col">
        <div class="card m-4" style="width: auto; height:auto">
            <div class="card-body">
            <img id="img-folder-1" src="assets/folder.png">
                <h5 class="card-title"> <b><?php echo  $directorioec ?>  </b> </h5>
                <a href="directorio.php?dir=<?php echo $directorioec ?>" class="card-link">Abrir</a>
                <a href="eliminar/eliminar-directorio.php?dir=<?php echo $directorioec ?>" class="card-link text-danger">Eliminar</a>
            </div>
        </div>
    </div>

    <?php
            }
        }
    } catch (Exception $e) {
        echo 'error: ',  $e->getMessage(), "\n\n";
    }
    ?>
    </div>

</body>

</html>