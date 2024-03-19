<?php
include('partials/menu.php');
include('../config/constants.php');

?>

<div class="main-content">
  <div class="wrapper">
    <h2>Dashboard</h2>
    <?php
    if (isset($_SESSION['login'])) {
      echo $_SESSION['login'];
      unset($_SESSION['login']);
    }
    ?>
    <div class="col-4">

      <div class="category">
        <?php
        $sql = "SELECT * FROM category";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        ?>
        <h1><?= $count; ?></h1>
        <br />
        <p>
          Categories
        </p>
      </div>

      <div class="category">
        <?php
        $sql2 = "SELECT * FROM food";
        $res2 = mysqli_query($conn, $sql2);
        $count2 = mysqli_num_rows($res2);
        ?>
        <h1><?= $count2; ?></h1>
        <br>
        <p>
          Foods
        </p>
      </div>

      <div class="category">

        <?php
        $sql3 = "SELECT * FROM `order`";
        $res3 = mysqli_query($conn, $sql3);
        $count3 = mysqli_num_rows($res3);
        ?>
        <h1><?= $count3; ?></h1>
        <br />
        <p>Total Orders</p>
      </div>

      <div class="category">
        <?php
        $sql4 = "SELECT SUM(total) AS Total FROM `order` WHERE status='Delivered'";
        $res4 = mysqli_query($conn, $sql4);
        $row4 = mysqli_fetch_assoc($res4);
        $total_revenue = $row4['Total'];
        ?>
        <h1>$<?php echo $total_revenue; ?></h1>
        <br />
        <p>Revenue Generated</p>
      </div>
    </div>

  </div>
</div>

<?php include('partials/footer.php') ?>