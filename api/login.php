<?php
require __DIR__ . '/config.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') respond(['ok'=>false,'error'=>'Method not allowed'],405);
$d = json_input(); $email = strtolower(trim((string)($d['email'] ?? ''))); $password = (string)($d['password'] ?? '');
$stmt = db()->prepare('SELECT id,name,email,password_hash FROM users WHERE email=? LIMIT 1');
$stmt->execute([$email]); $u = $stmt->fetch();
if (!$u || !password_verify($password, $u['password_hash'])) respond(['ok'=>false,'error'=>'อีเมลหรือรหัสผ่านไม่ถูกต้อง'],401);
session_regenerate_id(true); $_SESSION['user_id'] = (int)$u['id'];
respond(['ok'=>true,'user'=>['id'=>(int)$u['id'],'name'=>$u['name'],'email'=>$u['email']]]);
