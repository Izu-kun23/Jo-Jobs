<?php
//$pdo = new PDO('mysql:dbname=job;host=mysql', 'student', 'student');
//session_start();
?>
<html>
<head>
    <title>Login</title>
</head>
<h3>LOGIN</h3>
<form action="login" method ="post">
    <label for="username">Username</label> <input type="text" id="username" name="username"><br /><br />
    <label for="password">Password:</label> <input type="password" id="password" name="password"><br /><br />
    <input type="submit" name="submit" value="Log-in"/>
</form>
</html>
