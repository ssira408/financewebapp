<?php
require __DIR__ . '/config.php';
if (empty($_SESSION['user_id'])) respond(['ok'=>true,'user'=>null]);
$stmt = db()->prepare('SELECT id,name,email FROM users WHERE id=?');
$stmt->execute([(int)$_SESSION['user_id']]); $u = $stmt->fetch();
if (!$u) { session_destroy(); respond(['ok'=>true,'user'=>null]); }
respond(['ok'=>true,'user'=>['id'=>(int)$u['id'],'name'=>$u['name'],'email'=>$u['email']]]);
