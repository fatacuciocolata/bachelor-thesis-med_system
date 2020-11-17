<?php
include 'inc/init.php';

$meta = array(
    'title' => 'Adaugă intervenție'
); 

include 'inc/header.php';

$result_doctor = mysqli_query($link, "SELECT id, nume_prenume FROM doctori WHERE id = $id_doctor");
$doctor = mysqli_fetch_assoc($result_doctor);
if(!empty($_GET['data'])){
    $data_afisare = $_GET['data'];
}

if(isset($_POST['submit'])){

    if(isset($_GET['id']) && isset($_GET['add_int'])){

        $id_pacient = (int)$_GET['id'];
        $id_doctor = (int)$_POST['doctor'];
        $nume = mysqli_real_escape_string($link, $_POST['nume']);
        $data = strtotime($_POST['data']);
        $interventie = mysqli_real_escape_string($link, $_POST['interventie']);

        query_db($link, 
        "INSERT INTO pacienti_tratamente (`id_pacient`, `id_doctor`,`nume`, `data`, `descriere_interventie`) 
        VALUES ('$id_pacient', '$id_doctor', '$nume', '$data','$interventie')",
        "pacient.php?id=".$id_pacient);
    }

    if(isset($_GET['data']) && isset($_GET['id'])){
        
        $id_pacient = (int)$_GET['id'];
        $id_doctor = (int)$_POST['doctor'];
        $nume = mysqli_real_escape_string($link, $_POST['nume']);
        $data = strtotime($data_afisare);
        $interventie = mysqli_real_escape_string($link, $_POST['interventie']);
    
        query_db($link, 
        "INSERT INTO pacienti_tratamente (`id_pacient`, `id_doctor`,`nume`, `data`, `descriere_interventie`) 
        VALUES ('$id_pacient', '$id_doctor', '$nume', '$data','$interventie')",
        "pacient.php?id=".$id_pacient);
    }
}
?>

<div class="row">
    <div class="col-md-6 formular">

        <form method="POST" action="">
             <div class="form-group">
                <label for="nume">Nume intervenție: </label>
                <input type="text" class="form-control" name="nume" />
            </div>

            <div class="form-group">
                <label for="nume_prenume">Data: </label>
                <?php if(!empty($data_afisare)): ?>
                    <input disabled type="text" class="form-control" value="<?=$data_afisare?>" name="data" />
                <?php endif;?>
                <?php if(empty($data_afisare)):?>
                    <input type="date" class="form-control" name="data" />
                <?php endif;?>
            </div>

            <div class="form-group">
                <label for="interventie">Descriere tratament: </label>
                <textarea class="form-control" name="interventie"></textarea>
            </div>

            <div class="form-group">
                <label for="nume_prenume">Doctor: </label>
                    <input disabled type="text" class="form-control" value="Dr. <?= $doctor['nume_prenume'] ?>"/>
                    <input type="hidden" name="doctor" value="<?= $doctor['id']?>"/>
            </div>
            
            <input type="submit" class="btn btn-primary" name="submit" value="Adaugă intervenție"/>
        </form>
    </div>
</div>
<?php 
include 'inc/footer.php';?>
