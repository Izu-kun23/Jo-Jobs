<?php
$pdo = new PDO('mysql:dbname=job;host=mysql', 'student', 'student');
//session_start();
?>

<html>
<head>
    <title>Register</title>
<form action="register" method="post">
    <label for="fullName">Full Name:</label>
    <input type="text" id="name" name="fullName"><br><br>

    <label for="username">Username:</label>
    <input type="text" id="username" name="username"><br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password"><br><br>

    <input type="submit" value="Submit">
</form>


