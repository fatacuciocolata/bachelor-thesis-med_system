<?php 
include 'inc/init.php';

$meta = array(
    'title' => 'Editare intervenție'
);

include 'inc/header.php';

if(isset($_GET['id_interventie']) && isset($_GET['id'])){
    $id_pacient = $_GET['id'];
    $id_interventie = $_GET['id_interventie'];
    $sql = "SELECT * FROM pacienti_tratamente WHERE id = '$id_interventie' LIMIT 1";
    $result = mysqli_query($link, $sql); 

    if(isset($_POST['submit'])){
        $nume = $_POST['nume'];
        $descriere = $_POST['descriere'];

        $sql_update = "UPDATE `pacienti_tratamente` 
        SET `nume` = '$nume',
            `descriere_interventie` = '$descriere'
        WHERE `id` = '$id_interventie'
        ";
    
        query_db($link, $sql_update, "pacient.php?id=" . $id_pacient);
    }
}

while($row = mysqli_fetch_assoc($result)): 

// convertim data 
$data_db = $row['data'];
$data = date("Y-m-d", $data_db);

$id_pacient = $row['id_pacient'];
$pacient = mysqli_query($link, "SELECT `nume_prenume` FROM `pacienti` WHERE id = '$id_pacient' LIMIT 1");
$nume_pacient = mysqli_fetch_assoc($pacient);

$id_doctor = $row['id_doctor'];
$doctor = mysqli_query($link, "SELECT `nume_prenume` FROM `doctori` WHERE id = '$id_doctor' LIMIT 1");
$nume_doctor = mysqli_fetch_assoc($doctor);
?>
<div class="row">
    
    <div class="col-md-6 formular">

        <form method="POST" action="">
            <div class="form-group">
                <label for="pacient">Pacient</label>
                <input class="form-control" type="text" disabled value="<?= $nume_pacient['nume_prenume'] ?>" />
                </select>
            </div>
            <div class="form-group">
                <label for="data">Data interventie: </label>
                <input disabled type="date" class="form-control" name="data" required value="<?= $data ?>"/>
            </div>
            <div class="form-group">
                <label for="nume_prenume">Nume: </label>
                <input name="nume" class="form-control" type="text" value="<?= $row['nume'] ?>" />
            </div>
            <div class="form-group">
                <label for="nume_prenume">Descriere: </label>
                <textarea name="descriere" class="form-control" type="text"><?= $row['descriere_interventie'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="nume_prenume">Doctor: </label>
                <input class="form-control" type="text" disabled value="<?= $nume_doctor['nume_prenume'] ?>" />
            </div>
            
            <input type="submit" class="btn btn-primary" name="submit" value="Editează programare"/>
        </form>
    </div>
</div>
<?php 
endwhile;
include 'inc/footer.php';?>
