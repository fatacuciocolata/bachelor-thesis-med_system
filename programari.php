<?php 
include 'inc/init.php';

$meta = array(
  'title' => 'Programări'
);

include 'inc/header.php';

$sql = "SELECT * FROM programari ORDER BY `data`, `ora` ";
$result = mysqli_query($link, $sql);

if(isset($_GET['delete_id'])){
  $id_programare = $_GET['delete_id'];
  delete_db($link, "DELETE FROM `programari` WHERE `id` = '$id_programare'");
  header("location: programari.php");
}

?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Pacient</th>
      <th scope="col">Data</th>
      <th scope="col">Ora</th>
      <th scope="col">Doctor</th>
      <th scope="col">Intervenții</th>
      <th scope="col">Acțiuni</th>
    </tr>
  </thead>
  <tbody>
  <?php 
    $i = 1;
    echo(!mysqli_num_rows($result) ? "<td>Nu există programări.</td>" : "");
    while($row = mysqli_fetch_assoc($result)): 
    $id_pacient = $row['id_pacient'];
    $result_pacienti = mysqli_query($link, "SELECT * FROM pacienti WHERE id = '$id_pacient'");
    $pacient = mysqli_fetch_assoc($result_pacienti);

    $id_doctor = $row['id_doctor'];
    $result_doctori = mysqli_query($link, "SELECT * FROM doctori WHERE id = '$id_doctor'");
    $doctor = mysqli_fetch_assoc($result_doctori);

    // convertim data 
    $data_db = $row['data'];
    $data = date("d-m-Y", $data_db);
    
  ?>

    <tr>
      <td><?php echo $i; $i++; ?></td>
      <td><?= $pacient['nume_prenume'] ?></td>
      <td><?= $data ?></td>
      <td><?= $row['ora'] ?></td>
      <td><?= $doctor['nume_prenume'] ?></td>
      <td><a class="add_int" href="adauga_interventie.php?id=<?= $id_pacient ?>&data=<?= $data ?>"><i class="fas fa-plus-square"></i> Adaugă</a?</td>
      <td class="actions">
        <a title="Editare" href="editare_programare.php?id_programare=<?= $row['id'] ?>"><i class="fas fa-edit"></i></a>
        <a title="Ștergere" href="?delete_id=<?= $row['id'] ?>"><i class="fas fa-trash-alt"></i></a>
      </td>
    </tr>
  <?php endwhile; ?>
  </tbody>
</table>


<?php 
include 'inc/footer.php';?>
