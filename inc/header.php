<?php

if(isset($udata['id'])){
    $id_doctor = $udata['id'];
    $result_doctor = mysqli_query($link, "SELECT id, nume_prenume FROM doctori WHERE id='$id_doctor'");
}   else{
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?=(isset($meta['title']) ? $meta['title'] : 'Sistem Administratie Pacienti')?></title>
        <script src="https://kit.fontawesome.com/e36e6e1086.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">

    </head>
 
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="index.php">SYS Med</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Dashboard <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pacienti.php">Pacienți</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="programari.php">Programări</a>
                        </li>
                        </ul>
                        <div class="text-right">
                            <button type="button" class="btn add_patient"><i class="fas fa-plus"></i> <a href="adauga_pacient.php">Adaugă pacient</a></button>
                            <button type="button" class="btn add_apt"><i class="fas fa-plus"></i> <a href="adauga_programare.php">Adaugă programare</a></button>
                        </div>

                    </div>
                    </nav>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar bg-light head">
                        <span><?= $meta['title']?></span>
                        <div class="text-right">
                            <?php while($row = mysqli_fetch_assoc($result_doctor)): ?>
                                Dr. <?=$row['nume_prenume']?> <a title="Logout" href="?logout"><i class="fas fa-sign-out-alt"></i></a>
                            <?php endwhile;?>
                        </div>
                    </nav>
                </div>
            </div>