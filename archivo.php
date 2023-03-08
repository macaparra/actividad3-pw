<!DOCTYPE html>
<html lang="en">

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

<?php

    if (isset($_GET['dir']) && isset($_GET['note'])) {
        $dir = $_GET['dir'];
        $note = $_GET['note'];
    } else {
        header("Location: index.php");
    }

?>

<body>
    <div class="container-directorio">
        <div class="image-2">
            <img src="assets/logo.png">
        </div>
        <div class="text">
            <h1>Archivo  <?php echo rtrim($note, '(.html)') ?></h1>
        </div>
    </div>

    <?php

    try {

        $file = "file\\" . $dir . '\\' . $note;
        $tam = filesize($file);
        if ($tam > 0) {
            $con = file_get_contents($file, FILE_USE_INCLUDE_PATH);
        } else {
            $con = '';
        }
    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n\n";
        $con = "";
    }
    ?>

    <div class="area">
        <form action="directorio.php?dir=<?php echo $dir ?>&note=<?php echo $note ?>" method="post">
            <textarea  name="valor-nota" style="height: 500px;" class="valor-nota w-75 d-block mx-auto" id="" cols="30" rows="10"><?php echo $con; ?></textarea>
            
            <button type="submit" class="btn-2">Guardar</button>
        </form>
    </div>
</body>

</html>