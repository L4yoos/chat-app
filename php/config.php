<?php
$conn = new mysqli("localhost","root","","chatapp");

if ($conn -> connect_errno) {
  echo "Błąd z połączeniem do Bazy Danych: " . $conn -> connect_error;
  exit();
}
?>
