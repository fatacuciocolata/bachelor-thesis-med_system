<?php 
include 'inc/init.php';

$meta = array(
    'title' => 'Editare pacient'
);

include 'inc/header.php';

if(isset($_GET['id'])){
    $id_pacient = (int)$_GET['id'];
    $sql = "SELECT * FROM pacienti WHERE id = '$id_pacient'";
    $result = mysqli_query($link, $sql); 

    if(isset($_POST['submit'])){
        $nume_prenume = mysqli_real_escape_string($link, $_POST['nume_prenume']);
        $adresa = mysqli_real_escape_string($link, $_POST['adresa']);
        $telefon = mysqli_real_escape_string($link, $_POST['telefon']);
        $email = mysqli_real_escape_string($link, $_POST['email']);
        $alergii = mysqli_real_escape_string($link, $_POST['alergii']);

        $sql_update = "UPDATE `pacienti` SET 
        `nume_prenume` = '$nume_prenume',
        `adresa` = '$adresa', 
        `telefon` = '$telefon', 
        `email` = '$email', 
        `alergii` = '$alergii' 
        WHERE `id` = '$id_pacient'";

        query_db($link, $sql_update, "pacienti.php");
    }
}

while($row = mysqli_fetch_assoc($result)): 
?>

<div class="row">
    <div class="col-md-6 formular">
        <form method="POST" action="">
        <div class="form-group">
            <label for="nume_prenume">Nume și prenume</label>
            <input type="text" class="form-control" name="nume_prenume" value="<?= $row['nume_prenume'] ?>">
        </div>
        <div class="form-group">
            <label for="adresa">Adresă</label>
            <input type="text" class="form-control" name="adresa" value="<?= $row['adresa'] ?>">
        </div>
        <div class="form-group">
            <label for="telefon">Telefon</label>
            <input type="text" class="form-control" name="telefon" value="<?= $row['telefon'] ?>">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" value="<?= $row['email'] ?>">
        </div>
        <div class="form-group">
            <label for="alergii">Alergii</label>
            <textarea type="text" class="form-control" name="alergii"><?= $row['alergii'] ?></textarea>
        </div>
        <input type="submit" class="btn btn-primary" name="submit" value="Editează pacient"/>
        </form>
    </div>
</div>
<?php 
endwhile;
include 'inc/footer.php';?>
