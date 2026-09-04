<?php
declare(strict_types=1);
if (session_status() === PHP_SESSION_NONE) session_start();
function e(string $v): string { return htmlspecialchars($v, ENT_QUOTES, 'UTF-8'); }
function go(string $u): never { header("Location: $u"); exit; }
function logged(): bool { return isset($_SESSION['user']); }
function admin(): bool { return isset($_SESSION['admin_user']) && ($_SESSION['admin_user']['role'] ?? '') === 'admin'; }
function flash(string $t, string $m): void { $_SESSION['flash'] = [$t, $m]; }
function flash_get(): ?array { $x = $_SESSION['flash'] ?? null; unset($_SESSION['flash']); return $x; }
function cart_count(): int { return array_sum($_SESSION['cart'] ?? []); }
function cart_total(PDO $pdo): float { $t=0; foreach($_SESSION['cart']??[] as $id=>$q){$s=$pdo->prepare('SELECT price FROM products WHERE id=?');$s->execute([(int)$id]);if($p=$s->fetch())$t+=(float)$p['price']*(int)$q;} return $t; }
function require_admin(): void { if (!admin()) go('login.php'); }
function sync_user_cart(PDO $pdo): void {
    if (!isset($_SESSION['user']['id'])) return;
    $uid=(int)$_SESSION['user']['id'];
    $pdo->prepare('DELETE FROM cart_items WHERE user_id=?')->execute([$uid]);
    if (!empty($_SESSION['cart'])) { $s=$pdo->prepare('INSERT INTO cart_items(user_id,product_id,quantity) VALUES(?,?,?)'); foreach($_SESSION['cart'] as $pid=>$qty){$s->execute([$uid,(int)$pid,(int)$qty]);} }
}
function sync_user_wishlist(PDO $pdo): void {
    if (!isset($_SESSION['user']['id'])) return;
    $uid=(int)$_SESSION['user']['id'];
    $pdo->prepare('DELETE FROM wishlist_items WHERE user_id=?')->execute([$uid]);
    if (!empty($_SESSION['wishlist'])) { $s=$pdo->prepare('INSERT INTO wishlist_items(user_id,product_id) VALUES(?,?)'); foreach($_SESSION['wishlist'] as $pid){$s->execute([$uid,(int)$pid]);} }
}
function load_user_lists(PDO $pdo): void {
    if (!isset($_SESSION['user']['id'])) return;
    $uid=(int)$_SESSION['user']['id'];
    $s=$pdo->prepare('SELECT product_id,quantity FROM cart_items WHERE user_id=?');$s->execute([$uid]);$_SESSION['cart']=[];foreach($s as $r)$_SESSION['cart'][(int)$r['product_id']]=(int)$r['quantity'];
    $s=$pdo->prepare('SELECT product_id FROM wishlist_items WHERE user_id=?');$s->execute([$uid]);$_SESSION['wishlist']=array_map('intval',$s->fetchAll(PDO::FETCH_COLUMN));
}
