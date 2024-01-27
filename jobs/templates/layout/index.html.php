<main class="home">
    <form action="home" method="get">

        <select  name="location">
            <?php
            foreach ($locations as $location) {
                echo '<option class="search" value="' . $location['location'] . '">' . $location['location'] . '</option>';
            } ?>
            <input type="submit" name="submit" value="Filter">
        </select>
    </form>


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

</main>

