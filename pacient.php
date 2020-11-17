<?php 
include 'inc/init.php';

$meta = array(
  'title' => 'Vizualizare pacient'
);

include 'inc/header.php';

if(isset($_GET['id'])){
  $id_pacient = $_GET['id'];
  $sql = "SELECT * FROM pacienti WHERE id = '$id_pacient' LIMIT 1";
  $result = mysqli_query($link, $sql);

  if (mysqli_num_rows($result) == 0){
    header("location: 404.php");
  }
}

$sql_int = "SELECT * FROM pacienti_tratamente WHERE id_pacient = '$id_pacient' ORDER BY `data`";
$result_int = mysqli_query($link, $sql_int);

if(isset($_GET['delete_id']) && isset($_GET['id'])){
  $id_pacient = $_GET['id'];
  $id_interventie = $_GET['delete_id'];
  delete_db($link, "DELETE FROM `pacienti_tratamente` WHERE `id` = '$id_interventie'");
  header("location: pacient.php?id=". $id_pacient);
}
?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Nume, prenume</th>
      <th scope="col">Email</th>
      <th scope="col">Telefon</th>
      <th scope="col">Alergii</th>
      <th scope="col">Acțiuni</th>
    </tr>
  </thead>
  <tbody>
  <?php while($row = mysqli_fetch_assoc($result)):?>
    <tr>
      <td><?= $row['nume_prenume'] ?></td>
      <td><?= $row['email'] ?></td>
      <td><?= $row['telefon'] ?></td>
      <td><?= $row['alergii'] ?></td>
      <td class="actions">
        <a href="editare_pacient.php?id=<?= $row['id'] ?>"><i class="fas fa-edit"></i></a>
        <a href="?delete_id=<?= $row['id'] ?>&id_pacient=<?=$row['id'] ?>"><i class="fas fa-trash-alt"></i></a>
      </td>
    </tr>
  <?php endwhile;?>

  </tbody>
  <thead>
        <tr>
          <th class="bg-light heading" colspan="5">Intervenții pacient</th>
          <th class="bg-light text-right" colspan="2"></th>
        </tr>
    <tr>
      <th scope="col">Nume</th>
      <th scope="col">Data</th>
      <th scope="col">Descriere</th>
      <th scope="col">Doctor</th>
      <th scope="col">Acțiuni</th>
    </tr>
  </thead>
  <tbody>
  <?php 
   if(mysqli_num_rows($result_int) == 0){
    echo "<td>Nu exista interventii!</td>";
  }
  while($row = mysqli_fetch_assoc($result_int)):
 
  $data_db = $row['data'];
  $data = date("d-m-Y", $data_db);  
  ?>
    <tr>
      <td><?= $row['nume'] ?></td>
      <td><?= $data ?></td>
      <td><?= $row['descriere_interventie'] ?></td>
      <td><?= $udata['nume_prenume'] ?></td>

      <td class="actions">
        <a href="editare_interventie.php?id_interventie=<?= $row['id'] ?>&id=<?= $row['id_pacient'] ?>"><i class="fas fa-edit"></i></a>
        <a href="?delete_id=<?= $row['id'] ?>&id=<?= $row['id_pacient'] ?>"><i class="fas fa-trash-alt"></i></a>
      </td>
    </tr>
  <?php endwhile;?>
  </tbody>
</table>

<?php 
include 'inc/footer.php';?>
