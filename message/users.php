<?php
session_start();
include_once "php/config.php";
if (!isset($_SESSION['unique_id'])) {
  header("location: login.php");
}
?>
<?php include_once "header.php"; ?>

<body>
  <div class="wrapper user-wrapper">
    <section class="users p-5">
      <header class="mb-5">
        <div class="content">
          <?php
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
          if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
          }
          ?>

          <div class="row">
            <div class="col-2">
              <img src="php/images/<?php echo $row['img']; ?>" alt="">
            </div>
            <div class="col d-flex justify-content-start align-items-center">
              <div class="details">
                <span class="h5"><?php echo $row['fname'] . " " . $row['lname'] ?></span>
                <p class="m-0 text-success"><?php echo $row['status']; ?></p>
              </div>
            </div>
            <div class="col-3 text-end">
              <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="btn btn-sm btn-danger">Logout</a>
            </div>
          </div>
        </div>
      </header>

      <div class="search">
        <div class="input-group mb-5">
          <input type="text" class="form-control" style="height: 50px;" placeholder="Search">
          <span class="input-group-text bg-primary border-0"  style="height: 50px;" id="basic-addon2"><button class="btn btn-primary btn-sm"><i class="fas fa-search"></i></button></span>
        </div>
      </div>
      <div class="users-list">
      </div>
    </section>
  </div>

  <script src="javascript/users.js"></script>

</body>

</html>