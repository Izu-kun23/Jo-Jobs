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
			<h2>Jobs</h2>

			<a class="new" href="addjob">Add new job</a>

			<?php
			echo '<table>';
			echo '<thead>';
			echo '<tr>';
			echo '<th>Title</th>';
			echo '<th style="width: 15%">Salary</th>';
			echo '<th style="width: 5%">&nbsp;</th>';
			echo '<th style="width: 15%">&nbsp;</th>';
			echo '<th style="width: 5%">&nbsp;</th>';
			echo '<th style="width: 5%">&nbsp;</th>';
			echo '</tr>';

			$stmt = $pdo->query('SELECT * FROM job');

			foreach ($stmt as $job) {
				$applicants = $pdo->prepare('SELECT count(*) as count FROM applicants WHERE jobId = :jobId');

				$applicants->execute(['jobId' => $job['id']]);

				$applicantCount = $applicants->fetch();

				echo '<tr>';
				echo '<td>' . $job['title'] . '</td>';
				echo '<td>' . $job['salary'] . '</td>';
				echo '<td><a style="float: right" href="editJob?id=' . $job['id'] . '">Edit</a></td>';
				echo '<td><a style="float: right" href="applicants.php?id=' . $job['id'] . '">View applicants (' . $applicantCount['count'] . ')</a></td>';
                if($job['archive'] == 1)
                {
				echo '<td><form method="post" action="archive">
				<input type="hidden" name="id" value="' . $job['id'] . '" />
				<input type="submit" name="submit" value="archive" />
				</form></td>';}
                else{
                    echo '<td><form method="post" action="postjob">
				<input type="hidden" name="id" value="' . $job['id'] . '" />
				<input type="submit" name="submit" value="postjob" />
				</form></td>';
                }
				echo '</tr>';
			}

			echo '</thead>';
			echo '</table>';

        ?>

</section>
	</main>




