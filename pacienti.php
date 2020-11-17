<?php 
include 'inc/init.php';

$meta = array(
  'title' => 'Pacienți'
);

include 'inc/header.php';

define('ROWS_PER_PAGE', 5);

$current_page = isset($_GET['p']) ? (int)$_GET['p'] : 1;

if ($current_page < 1) {
  $current_page = 1;
}

$query = mysqli_query($link, "SELECT COUNT(id) as total FROM `pacienti`");
$total_records = mysqli_fetch_array($query);
$total_records = $total_records['total'];

$total_pages = ceil($total_records / ROWS_PER_PAGE);
if ($current_page > $total_pages) {
  $current_page = $total_pages;
}

$result = mysqli_query($link, "SELECT * FROM `pacienti` LIMIT ".(($current_page - 1) * ROWS_PER_PAGE).", " . ROWS_PER_PAGE);

if(isset($_GET['delete_id'])){
    $id_pacient = $_GET['delete_id'];
    delete_db($link, "DELETE FROM `pacienti` WHERE `id` = '$id_pacient'");
    header("location: pacienti.php");
}

?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Nume, prenume</th>
      <th scope="col">Email</th>
      <th scope="col">Telefon</th>
      <th scope="col">Alergii</th>
      <th scope="col">Istoric medical</th>
      <th scope="col">Acțiuni</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  echo(!mysqli_num_rows($result) ? "<td>Nu există pacienți.</td>" : "");
  while($row = mysqli_fetch_assoc($result)):
  ?>
    <tr>
      <td><?= $row['nume_prenume'] ?></td>
      <td><?= $row['email'] ?></td>
      <td><?= $row['telefon'] ?></td>
      <td><?= $row['alergii'] ?></td>
      <td><a class="add_int" href="adauga_interventie.php?id=<?= $row['id'] ?>&add_int"><i class="fas fa-plus-square"></i> Adaugă</a?</td>
      <td class="actions">
        <a title="Vizualizare" href="pacient.php?id=<?= $row['id'] ?>"><i class="fas fa-eye"></i></a>
        <a title="Editare" href="editare_pacient.php?id=<?= $row['id'] ?>"><i class="fas fa-edit"></i></a>
        <a title="Ștergere" href="?delete_id=<?= $row['id'] ?>"><i class="fas fa-trash-alt"></i></a>
      </td>
    </tr>
    <?php endwhile;?>
  </tbody>
</table>

<style>
.pagination .page-link span {
  font-size: 24px;
  display: block;
  padding: 0 15px;
}
</style>
<?php
$first_page_href = $current_page > 1 ? '?p=1' : '#';
$prev_page_href = $current_page > 1 ? ('?p='.($current_page-1)) : '#';
$next_page_href = $current_page < $total_pages ? ('?p='.($current_page+1)) :'#';
$last_page_href = $current_page < $total_pages ? ('?p='.$total_pages) :'#';
?>
<ul class="pagination">
    <li class="page-item <?=($current_page <= 1 ? 'disabled' : '')?>">
      <a class="page-link" href="<?=$first_page_href?>">
        <span>&laquo;</span>
      </a>
    </li>

    <li class="page-item <?=($current_page <= 1) ? 'disabled': ''?>">
      <a class="page-link" href="<?=$prev_page_href?>">
        <span>&lsaquo;</span>
      </a>
    </li>

    <li class="page-item <?=($current_page >= $total_pages) ? 'disabled': ''?>">
      <a class="page-link" href="<?=$next_page_href?>">
        <span>&rsaquo;</span>
      </a>
    </li>

    <li class="page-item <?=($current_page >= $total_pages ? 'disabled' : '')?>">
      <a class="page-link" href="<?=$last_page_href?>">
        <span>&raquo;</span>
      </a>
    </li>
</ul>

<?php include 'inc/footer.php';?>
