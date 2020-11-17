<?php 
include 'inc/init.php';

$meta = array(
    'title' => 'Editare programare'
);

include 'inc/header.php';

if(isset($_GET['id_programare'])){
    $id_programare = $_GET['id_programare'];
    $sql = "SELECT * FROM programari WHERE id = '$id_programare' LIMIT 1";
    $result = mysqli_query($link, $sql); 

    if(isset($_POST['submit'])){
        $data = strtotime($_POST['data']);
        $ora = $_POST['ora'];

        $sql_update = " UPDATE `programari` 
        SET `data` = '$data',
            `ora` = '$ora'
        WHERE `id` = '$id_programare'
        ";
    
        query_db($link, $sql_update, "programari.php");
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
                <label for="nume_prenume">Data programare: </label>
                <input type="date" class="form-control" name="data" required value="<?= $data ?>"/>
            </div>

            <div class="form-group">
                <label for="ora">Ora: </label>
                <input type="time" name="ora" min="08:00" max="19:00" required value="<?= $row['ora'] ?>" />
                
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
