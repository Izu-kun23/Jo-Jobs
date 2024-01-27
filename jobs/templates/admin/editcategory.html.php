<?php
$pdo = new PDO('mysql:dbname=job;host=mysql', 'student', 'student');
//session_start();
?>

	<main class="sidebar">

	<section class="left">
		<ul>
			<li><a href="jobs">Jobs</a></li>
			<li><a href="categories">Categories</a></li>
            <li><a href="adduser">Add User</a></li>


		</ul>
	</section>

	<section class="right">

	<?php


			?>


				<h2>Edit Category</h2>

				<form action="" method="POST">

					<input type="hidden" name="id" value="<?php echo $currentCategory['id']; ?>" />
					<label>Name</label>
					<input type="text" name="name" value="<?php echo $currentCategory['name']; ?>" />


					<input type="submit" name="submit" value="Save Category" />

				</form>


</section>
	</main>

</body>
</html>

