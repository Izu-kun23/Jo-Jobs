<main class="sidebar">
<section class="left"
<?php include_once '../templates/layout/apply.html.php'; ?>
</section>

    <section class = "right">
        <h2>Apply for<?= $job['title']; ?> </h2>

        <form action="apply" method="POST" enctype="multipart/form-data">
            <label> ADD NAME </label>
            <input type="text" name="name"/>

            <label> E-MAIL </label>
            <input type="text" name="email"/>

            <label> CV </label>
            <input type="file" name="cv"/>

            <input type="hidden" name="jobId" value="<?= $job['id']; ?>"/>
            <input type="submit" name="submit" value="Apply"/>


        </form>

    </section>
</main>
