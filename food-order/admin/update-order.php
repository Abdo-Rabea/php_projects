<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h3>Update Order</h1>

      <?php
      if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT * FROM `order` WHERE id=$id";
        include("../config/constants.php");
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        if ($count == 1) {
          $row = mysqli_fetch_assoc($res);

          $food = $row['food'];
          $price = $row['price'];
          $qty = $row['qty'];
          $status = $row['status'];
          $customer_name = $row['customer_name'];
          $customer_contact = $row['customer_contact'];
          $customer_email = $row['customer_email'];
          $customer_address = $row['customer_address'];
        } else {
          header('location:./manage-order.php');
        }
      } else {
        //REdirect to Manage ORder PAge
        header('location:./manage-order.php');
      }

      ?>

      <form action="" method="POST" style="height: 300px;">

        <div>
          <label>Food Name</label>
          <b> <?php echo $food; ?> </b>
        </div>

        <div>
          <label>Price</label>
          <b> $ <?php echo $price; ?></b>
        </div>

        <div>
          <label>Qty</label>
          <input type="number" name="qty" value="<?php echo $qty; ?>">
        </div>

        <div>
          <label>Status</label>
          <select name="status">
            <option <?php if ($status == "Ordered") {
                      echo "selected";
                    } ?> value="Ordered">Ordered</option>
            <option <?php if ($status == "On Delivery") {
                      echo "selected";
                    } ?> value="On Delivery">On Delivery</option>
            <option <?php if ($status == "Delivered") {
                      echo "selected";
                    } ?> value="Delivered">Delivered</option>
            <option <?php if ($status == "Cancelled") {
                      echo "selected";
                    } ?> value="Cancelled">Cancelled</option>
          </select>
        </div>

        <div>
          <label>Customer Name: </label>
          <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
        </div>

        <div>
          <label>Customer Contact: </label>
          <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
        </div>

        <div>
          <label>Customer Email: </label>
          <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
        </div>

        <div>
          <label>Customer Address: </label>
          <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
        </div>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="price" value="<?php echo $price; ?>">
        <input type="submit" name="submit" value="Update Order" class="btn btn-secondary">
      </form>


      <?php
      //CHeck whether Update Button is Clicked or Not
      if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];

        $total = $price * $qty;

        $status = $_POST['status'];

        $customer_name = $_POST['customer_name'];
        $customer_contact = $_POST['customer_contact'];
        $customer_email = $_POST['customer_email'];
        $customer_address = $_POST['customer_address'];

        //Update the Values
        $sql2 = "UPDATE `order` SET 
                    qty = $qty,
                    total = $total,
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                    WHERE id=$id
                ";
        $res2 = mysqli_query($conn, $sql2);

        if ($res2 == true) {
          $_SESSION['update'] = "<div class='success'>Order Updated Successfully.</div>";
          header('location:./manage-order.php');
        } else {
          //Failed to Update
          $_SESSION['update'] = "<div class='error'>Failed to Update Order.</div>";
          header('location:./manage-order.php');
        }
      }
      ?>


  </div>
</div>

<?php include('partials/footer.php'); ?>