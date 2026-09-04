<?php require_once '../config/database.php';require_once '../includes/functions.php';$id=(int)($_GET['id']??0);unset($_SESSION['cart'][$id]);sync_user_cart($pdo);go('../cart.php');
