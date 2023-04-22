<?php 
  session_start();
  if(isset($_SESSION['unique_id'])){
    header("location: users.php");
  }
?>

<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="form signup">
      <header class="center">Chat App</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
          <div class="field input">
            <label>Imie</label>
            <input type="text" name="fname" placeholder="Wprowadź Imie" required>
          </div>
          <div class="field input">
            <label>Nazwisko</label>
            <input type="text" name="lname" placeholder="Wprowadź Nazwisko" required>
          </div>
          <div class="field input">
            <label>Adres Email</label>
            <input type="text" name="email" placeholder="Wprowadź Email" required>
          </div>
          <div class="field input">
            <label>Hasło</label>
            <input type="password" name="password" placeholder="Wprowadź Hasło" required>
            <i class="fas fa-eye"></i>
          </div>
          <div class="field image">
            <label for="file-upload" class="custom-file-upload">Wybierz Obraz</label>
            <input id="file-upload" type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required/>
          </div>
          <div class="field button">
            <input type="submit" name="submit" value="Zaloguj sie do Czatu!">
          </div>
      </form>
      <hr>
      <div class="link">Jesteś Zarejestrowany? <a href="login.php" style="color: gold;">Zaloguj sie!</a></div>
    </section>
  </div>
  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/signup.js"></script>
</body>
</html>
