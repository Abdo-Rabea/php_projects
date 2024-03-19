<?php include('partials-front/menu.php'); ?>

<?php
if (isset($_GET['category_id'])) {
	$category_id = $_GET['category_id'];
	echo $category_id;
	$sql = "SELECT title FROM category WHERE id=$category_id";
	$res = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($res);
	$category_title = $row['title'];
} else {
	header('location: ./');
}
?>

<!-- search -->
<section class="food-search text-center">
	<div class="container">
		<h2>Foods on <a href="#" class="text-white">"<?= $category_title; ?>"</a></h2>
	</div>
</section>
<!-- search -->

<!-- menu -->
<section class="food-menu">
	<div class="container">
		<h2 class="text-center">Food Menu</h2>

		<?php
		$sql2 = "SELECT * FROM food WHERE category_id=$category_id";
		$res2 = mysqli_query($conn, $sql2);
		$count2 = mysqli_num_rows($res2);
		if ($count2 > 0) {
			while ($row2 = mysqli_fetch_assoc($res2)) {
				$id = $row2['id'];
				$title = $row2['title'];
				$price = $row2['price'];
				$description = $row2['description'];
				$image_name = $row2['image_name'];
		?>
				<div class="food-menu-box">
					<div class="food-menu-img">
						<?php
						if ($image_name == "") {
							echo "<div class='error'>Image not Available.</div>";
						} else {
						?>
							<img src="./images/food/<?= $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
						<?php
						}
						?>

					</div>

					<div class="food-menu-desc">
						<h4><?= $title; ?></h4>
						<p class="food-price">$<?= $price; ?></p>
						<p class="food-detail">
							<?php echo $description; ?>
						</p>
						<br>

						<a href="./order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
					</div>
				</div>

		<?php
			}
		} else {
			//Food not available
			echo "<div class='error'>Food not Available.</div>";
		}

		?>



		<div class="clearfix"></div>



	</div>

</section>
<!-- end menue -->

<?php include('partials-front/footer.php'); ?>