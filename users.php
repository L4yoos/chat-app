<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>
<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php 
            $sql = $conn->prepare("SELECT * FROM users WHERE unique_id = ?");
            $sql->bind_param('i', $_SESSION['unique_id']);
            $sql->execute();
            $res = $sql->get_result();
            if($res->num_rows > 0){
              $row = $res->fetch_assoc();
            }
          ?>
          <img src="php/images/<?php echo $row['img']; ?>" alt="">
          <div class="details">
            <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
            <p><?php echo $row['status']; ?></p>
          </div>
        </div>
        <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Wyloguj sie!</a>
      </header>
      <div class="search">
        <span class="text">Wybierz użytkownika do chatowania!</span>
        <input type="text" placeholder="Wpisz imie aby wyszukac...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">
  
      </div>
    </section>
  </div>

  <script src="javascript/users.js"></script>

</body>
</html>
