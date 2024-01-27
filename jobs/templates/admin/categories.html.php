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

11    </section>

    <section class="right">

        <h2>Categories</h2>

        <a class="new" href="addcategory">Add new category</a>

        <?php
            echo '<table>';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Name</th>';
            echo '<th style="width: 5%">&nbsp;</th>';
            echo '<th style="width: 5%">&nbsp;</th>';
            echo '</tr>';

            $categories = $pdo->query('SELECT * FROM category');

            foreach ($categories as $category) {
                echo '<tr>';
                echo '<td>' . $category['name'] . '</td>';
                echo '<td><a style="float: right" href="editcategory?id=' . $category['id'] . '">Edit</a></td>';
                if($category['archive'] == 1)
                {
                    echo '<td><form method="post" action="archive">
				<input type="hidden" name="id" value="' . $category['id'] . '" />
				<input type="submit" name="submit" value="archive" />
				</form></td>';
                }
                else{
                    echo '<td><form method="post" action="repost">
				<input type="hidden" name="id" value="' . $category['id'] . '" />
				<input type="submit" name="submit" value="repost" />
				</form></td>';

            }

        }

            echo '</thead>';
            echo '</table>';

        ?>

    </section>
</main>

