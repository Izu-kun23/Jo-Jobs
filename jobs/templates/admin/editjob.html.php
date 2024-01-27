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

			<h2>Edit Job</h2>

			<form action="../admin/editjob" method="POST">

				<input type="hidden" name="id" value="<?php echo $jobs['id']; ?>" />
				<label>Title</label>
				<input type="text" name="title" value="<?php echo $jobs['title']; ?>" />

				<label>Description</label>
				<textarea name="description"><?php echo $jobs['description']; ?></textarea>

				<label>Location</label>
				<input type="text" name="location" value="<?php echo $jobs['location']; ?>" />


				<label>Salary</label>
				<input type="text" name="salary" value="<?php echo $jobs['salary']; ?>" />

				<label>Category</label>

				<select name="categoryId">
				<?php
                foreach ($stmt as $row) {
						if ($job['categoryId'] == $row['id']) {
							echo '<option selected="selected" value="' . $row['id'] . '">' . $row['name'] . '</option>';
						}
						else {
							echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
						}
					}

				?>

				</select>

				<label>Closing Date</label>
				<input type="date" name="closingDate" value="<?php echo $jobs['closingDate']; ?>"  />

				<input type="submit" name="submit" value="Save" />

			</form>

</section>
	</main>


