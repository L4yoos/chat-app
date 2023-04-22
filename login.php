<?php 
  session_start();
  if(isset($_SESSION['unique_id'])){
    header("location: users.php");
  }
?>

<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="form login">
      <header>Chat App</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="field input">
          <label>Adres Email</label>
          <input type="text" name="email" placeholder="Wprowadź Email" required>
        </div>
        <div class="field input">
          <label>Hasło</label>
          <input type="password" name="password" placeholder="Wprowadź Hasło" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Zaloguj sie do Czatu!">
        </div>
      </form>
      <hr>
      <div class="link">Nie jesteś zarejestrowany? <a href="index.php" style="color: gold;">Zarejestruj sie!</a></div>
    </section>
  </div>
  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/login.js"></script>

</body>
</html>
