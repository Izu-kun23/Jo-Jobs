<?php
$pdo = new PDO('mysql:dbname=job;host=mysql', 'student', 'student');
//session_start();
?>


<main class="sidebar">

    <section class="left">
        <ul>
            <li><a href="jobs">Jobs</a></li>
            <li><a href="categories">Categories</a></li>

        </ul>
    </section>

    <section class="right">

                <h2>Add Category</h2>

                <form action="addcategory" method="POST">
                    <label>Name</label>
                    <input type="text" name="name" />
                    <input type="submit" name="submit" value="Add Category" />

                </form>


    </section>
</main>




