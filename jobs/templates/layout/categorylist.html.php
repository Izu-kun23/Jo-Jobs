<?php
$pdo = new PDO('mysql:dbname=job;host=mysql', 'student', 'student');
//session_start();
?>

<main class="sidebar">

    <section class="left">
        <ul>
            <ul>
                <?php
                foreach ($category as $category) {
                    echo "<li><a href='categorylist?categoryId=" . $category['id'] . "'>" .  $category['name'] . "</a></li>";
                    
                }
                ?>
            </ul>
        </ul>
    </section>

    <section class="right">

        <h1><?= $currentCategory['name'] ?> Job</h1>
        <ul class="listing">
            <?php
            foreach ($jobs as $job) {
                echo '<li>';

                echo '<div class="details">';
                echo '<h2>' . $job['title'] . '</h2>';
                echo '<h3>' . $job['salary'] . '</h3>';
                echo '<p>' . nl2br($job['description']) . '</p>';

                echo '<a class="more" href="/apply?id=' . $job['id'] . '">Apply for this job</a>';

                echo '</div>';
                echo '</li>';
            }

            ?>

        </ul>

    </section>
</main>