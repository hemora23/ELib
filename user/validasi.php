<?php
$id  = isset($_POST['cari']) ?  $_POST['cari'] : '';

if (isset($_POST['btnCari'])) {
  echo "<meta http-equiv='refresh' content='0; url=?page=Search&id=" . $id . "'>";
}
