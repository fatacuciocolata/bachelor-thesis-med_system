<?php 
include 'inc/init.php';

$meta = array(
    'title' => 'Adaugă programare'
);

include 'inc/header.php';

if ($logged_in == false) {
    $must_login = 'Trebuie sa fii logat pentru a vedea aceasta pagina!';
    die($must_login);
}

$result_pacienti = mysqli_query($link, "SELECT id, nume_prenume FROM pacienti");
$result_doctor = mysqli_query($link, "SELECT id, nume_prenume FROM doctori WHERE id = $id_doctor");
$doctor = mysqli_fetch_assoc($result_doctor);

if(isset($_POST['submit'])){
    $id_pacient = (int)$_POST['id'];
    $data = strtotime($_POST['data']);
    $ora = mysqli_real_escape_string($link, $_POST['ora']);
    $id_doctor = (int)$_POST['doctor'];
    query_db($link, 
    "INSERT INTO `programari` (`data`, `ora`, `id_pacient`, `id_doctor`) 
    VALUES ('$data', '$ora', '$id_pacient', '$id_doctor')", 
    "programari.php");

}
?>

<div class="row">
    
    <div class="col-md-6 formular">

        <form method="POST" action="">
            <div class="form-group">
                <label for="pacient">Alege un pacient existent:</label>
                <select class="form-control" name="id" id="pacient" required>
                    <?php if(!mysqli_num_rows($result_pacienti)): ?>
                        <option disabled="disabled">Nu exista pacienti in baza de date</option>
                    <?php endif;?>
                    <?php while($row=mysqli_fetch_assoc($result_pacienti)):?>
                        <option value="<?= $row['id'] ?>"><?= $row['nume_prenume']?></option>
                    <?php endwhile;?>
                </select>
            </div>

            <div class="form-group">
                <label for="nume_prenume">Data programare: </label>
                <input disable-past-date type="date" name="data" required>
            </div>

            <div class="form-group">
                <label for="ora">Ora: </label>
                <input type="time" name="ora" min="08:00" max="19:00" required />
                
            </div>
            <div class="form-group">
                <label for="nume_prenume">Doctor: </label>
                
                    <input disabled type="text" class="form-control" value="Dr. <?= $doctor['nume_prenume'] ?>"/>
                    <input type="hidden" name="doctor" value="<?= $doctor['id']?>"/>
            </div>
            
            <input type="submit" class="btn btn-primary" name="submit" value="Adaugă programare"/>
        </form>
    </div>
</div>
<script>
function _leading_zero (n) {
    if (n < 9) {
        return '0' + n;
    }
    return n.toString();
};

function getTodayDate () {
    var t = new Date();
    return [
        t.getFullYear(),
        _leading_zero(t.getMonth() + 1), 
        _leading_zero(t.getDate())
    ].join('-');
};

$(document).ready(function () {
    $('input[type="date"][disable-past-date]').each(function () {
        $(this).attr('min', getTodayDate())
    });
});
</script>


<?php 
include 'inc/footer.php';?>
