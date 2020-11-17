<?php 
include 'inc/init.php';

$meta = array(
    'title' => 'Adaugă pacient'
);

include 'inc/header.php';

if(isset($_POST['submit'])){
    $nume_prenume = mysqli_real_escape_string($link, $_POST['nume_prenume']);
    $adresa = mysqli_real_escape_string($link, $_POST['adresa']);
    $telefon = mysqli_real_escape_string($link, $_POST['telefon']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $alergii = mysqli_real_escape_string($link, $_POST['alergii']);

    query_db($link, 
    "INSERT INTO pacienti (`nume_prenume`, `adresa`, `telefon`, `email`, `alergii`) VALUES ('$nume_prenume','$adresa', '$telefon', '$email', '$alergii')",
    "pacienti.php");
}
?>

<div class="row">
    
    <div class="col-md-6 formular">
        <form method="POST" action="">
            <div class="form-group">
                <label for="nume_prenume">Nume și prenume</label>
                <input type="text" class="form-control" name="nume_prenume" required>
            </div>
            <div class="form-group">
                <label for="adresa">Adresă</label>
                <input type="text" class="form-control" name="adresa" required>
            </div>
            <div class="form-group">
                <label for="telefon">Telefon</label>
                <input type="text" class="form-control" name="telefon" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label for="alergii">Alergii</label>
                <textarea type="text" class="form-control" name="alergii"></textarea>
            </div>
            <input type="submit" class="btn btn-primary" name="submit" value="Adaugă pacient"/>

            <br />
        </form>
    </div>
</div>
<?php 
include 'inc/footer.php';?>
