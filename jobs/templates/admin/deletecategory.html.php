<?php
$pdo = new PDO('mysql:dbname=job;host=mysql', 'student', 'student');
//session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

	$stmt = $pdo->prepare('DELETE FROM category WHERE id = :id');
	$stmt->execute(['id' => $_POST['id']]);


	header('location: categories.php');
}


