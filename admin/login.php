<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
if (admin()) go('index.php');
$error='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $email=trim($_POST['email']??''); $password=$_POST['password']??'';
    $s=$pdo->prepare("SELECT * FROM users WHERE email=? AND role='admin' LIMIT 1"); $s->execute([$email]); $u=$s->fetch();
    if ($u && password_verify($password,$u['password'])) { unset($_SESSION['user']); $_SESSION['admin_user']=$u; go('index.php'); }
    $error='Invalid admin email or password.';
}
?><!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Rasit Watch Admin Login</title><link rel="stylesheet" href="../assets/css/style.css"><style>
.admin-login{min-height:100vh;display:grid;place-items:center;padding:24px;background:radial-gradient(circle at top,#241d10,#090909 55%)}
.admin-box{width:min(460px,100%);padding:38px;border:1px solid #3a3020;border-radius:22px;background:#111;box-shadow:0 25px 70px #0009}.admin-brand{text-align:center;margin-bottom:26px}.admin-brand h1{margin:8px 0}.admin-brand p{color:#999}.admin-badge{display:inline-block;padding:7px 12px;border:1px solid #6c562b;border-radius:99px;color:#d7b86c;font-size:12px;text-transform:uppercase;letter-spacing:1.5px}.admin-help{margin-top:16px;color:#888;font-size:13px;text-align:center}.admin-help strong{color:#d7b86c}
</style></head><body><main class="admin-login"><div class="admin-box"><div class="admin-brand"><span class="admin-badge">Rasit Watch</span><h1>Admin Login</h1><p>Secure administration area</p></div><?php if($error):?><div class="alert error"><?=e($error)?></div><?php endif;?><form method="post"><div class="group"><label>Admin Email</label><input class="input" type="email" name="email" placeholder="admin@gmail.com" required></div><div class="group"><label>Password</label><input class="input" type="password" name="password" placeholder="••••••••" required></div><button class="btn" style="width:100%">Login to Admin</button></form><div class="admin-help">Admin credentials: <strong>admin@gmail.com</strong> / <strong>admin123</strong><br><a href="../index.php">← Back to Website</a></div></div></main></body></html>
