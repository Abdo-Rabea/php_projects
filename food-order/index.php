<?php include('partials-front/menu.php'); ?>

<section class="food-search text-center">
	<div class="container">

		<form action="./food-search.php" method="POST">
			<input type="search" name="search" placeholder="Search for Food.." required>
			<input type="submit" name="submit" value="Search" class="btn btn-primary">
		</form>

	</div>
</section>

<?php
if (isset($_SESSION['order'])) {
	echo $_SESSION['order'];
	unset($_SESSION['order']);
}
?>

<section class="categories">
	<div class="container">
		<h2 class="text-center">Explore Foods</h2>

		<?php
		$sql = "SELECT * FROM category WHERE active='Yes' AND featured='Yes' LIMIT 3";
		$res = mysqli_query($conn, $sql);
		//Count rows to check whether the category is available or not
		$count = mysqli_num_rows($res);

		if ($count > 0) {
			//CAtegories Available
			while ($row = mysqli_fetch_assoc($res)) {
				//Get the Values like id, title, image_name
				$id = $row['id'];
				$title = $row['title'];
				$image_name = $row['image_name'];
		?>

				<a href="./category-foods.php?category_id=<?= $id; ?>">
					<div class="box-3 float-container">
						<?php
						if ($image_name == "") {
							echo "<div class='error'>Image not Available</div>";
						} else {
						?>
							<img src="./images/category/<?= $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
						<?php
						}
						?>


						<h3 class="float-text text-white"><?= $title; ?></h3>
					</div>
				</a>

		<?php
			}
		} else {
			echo "<div class='error'>Category not Added.</div>";
		}
		?>


		<div class="clearfix"></div>
	</div>
</section>

<section class="food-menu">
	<div class="container">
		<h2 class="text-center">Food Menu</h2>
		<?php
		$sql2 = "SELECT * FROM food WHERE active='Yes' AND featured='Yes' LIMIT 6";
		$res2 = mysqli_query($conn, $sql2);
		$count2 = mysqli_num_rows($res2);
		if ($count2 > 0) {
			//Food Available
			while ($row = mysqli_fetch_assoc($res2)) {
				//Get all the values
				$id = $row['id'];
				$title = $row['title'];
				$price = $row['price'];
				$description = $row['description'];
				$image_name = $row['image_name'];
		?>

				<div class="food-menu-box">
					<div class="food-menu-img">
						<?php
						if ($image_name == "") {
							echo "<div class='error'>Image not available.</div>";
						} else {
						?>
							<img src="./images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
						<?php
						}
						?>

					</div>

					<div class="food-menu-desc">
						<h4><?php echo $title; ?></h4>
						<p class="food-price">$<?php echo $price; ?></p>
						<p class="food-detail">
							<?php echo $description; ?>
						</p>
						<br>

						<a href="./order.php?food_id=<?= $id; ?>" class="btn btn-primary">Order Now</a>
					</div>
				</div>

		<?php
			}
		} else {
			//Food Not Available 
			echo "<div class='error'>Food not available.</div>";
		}
		?>
		<div class="clearfix"></div>
	</div>
	<p class="text-center">
		<a href="#">See All Foods</a>
	</p>
</section>

<?php include('partials-front/footer.php'); ?>