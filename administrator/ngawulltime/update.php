<?php
require_once "../database/config.php";

if (isset($_POST['update'])) {
  $deskripsi = trim(mysqli_real_escape_string($conn, $_POST['summernote']));
  
  if (mysqli_query($conn, "UPDATE tb_news SET deskripsi='$deskripsi' WHERE id='1'")) {
    echo "<script>window.location='../ngawulltime/';</script>";
  } else {
    die(mysqli_error($conn));
  }
}
?>