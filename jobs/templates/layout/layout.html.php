<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/styles.css"/>
    <title><?= $title ?? 'Jo\'s Job - Home' ?></title>

</head>
<body>
<header>
    <section>
        <aside>
            <h3>Office Hours:</h3>
            <p>Mon-Fri: 09:00-17:30</p>
            <p>Sat: 09:00-17:00</p>
            <p>Sun: Closed</p>
        </aside>
        <h1>Jo's Jobs</h1>

    </section>
</header>
<nav>
    <ul>
        <li><a href="/">Home</a></li>
        <li>Jobs
            <?php
            require '../templates/layout/list.php'
            ?>

        </li>
        <li><a href="/about">About Us</a></li>
        <li><a href="/FAQs">FAQs</a></li>
        <li><a href="/enquiries">Contact Us</a></li>


    </ul>
    <nav>
        <?php
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && $_SESSION['userDetails']['userType'] == 'admin') {
            echo '<div><p> Hello, '. $_SESSION['userDetails']['fullName'] . '<a href="../admin/index">Admin-Home</a> <a href="../admin/logout">Log-out</a> </p></div>';
        } else if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && $_SESSION['userDetails']['userType'] == 'client'){
            echo '<div><p> Hello, '. $_SESSION['userDetails']['fullName'] . '<a href="../admin/user">Client-Home</a> <a href="../admin/logout">Log-out</a> </p></div>';
        } else {
            echo '<button><a href="../admin/login">Admin Login</a></button>';
        }
        ?>
    </nav>


</nav>
<img src="/images/randombanner.php"/>
<?= $output ?? ''?>


<footer>
    &copy Jo's Jobs <?php echo date('Y') ?>
</footer>
</body>
</html>