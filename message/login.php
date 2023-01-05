<?php
session_start();
if (isset($_SESSION['unique_id'])) {
  header("location: users.php");
}
?>


<?php include_once "header.php"; ?>

<body>

  <div class="loader">
    <?php
    include "../loader/loader.php";
    ?>
  </div>

  <div class="bodyActual" hidden>
    <div class="wrapper">
      <section class="form login p-5">
        <div class="text-center mb-4"><img src="../sidebar/img/fullLogoMessengerBlack.png" class="img-fluid" style="width:70%;border-radius: 0px;"></div>
        <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
          <div class="error-text"></div>
          <div class="field input mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="email" class="form-control" placeholder="" required>
          </div>
          <div class="field input mb-4">
            <label class="form-label">Password</label>
            <div class="input-group">
              <input type="password" name="password" class="form-control" required>
              <span class="input-group-text" id="basic-addon2"><i class="fas fa-eye"></i></span>
            </div>
          </div>
          <div class="field button">
            <input class="btn btn-primary w-100" type="submit" name="submit" value="Login">
          </div>
        </form>
        <p class="text-muted text-center" style="font-size: small;">
          Don't have an account yet? <a href="../pages-register.php">Sign Up</a>.
        </p>
      </section>
    </div>
  </div>

  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/login.js"></script>
  <script src="../loader/loader.js"></script>

</body>

</html>