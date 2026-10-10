<?php
require __DIR__ . '/config.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') respond(['ok'=>false,'error'=>'Method not allowed'],405);
$d = json_input();
$email = strtolower(trim((string)($d['email'] ?? '')));
$password = (string)($d['password'] ?? '');
$name = trim((string)($d['name'] ?? ''));
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 190) respond(['ok'=>false,'error'=>'กรุณากรอกอีเมลให้ถูกต้อง'],422);
if (strlen($password) < 8) respond(['ok'=>false,'error'=>'รหัสผ่านต้องมีอย่างน้อย 8 ตัวอักษร'],422);
if ($name === '') $name = strstr($email, '@', true) ?: 'ผู้ใช้';
try {
  $stmt = db()->prepare('INSERT INTO users (name,email,password_hash) VALUES (?,?,?)');
  $stmt->execute([mb_substr($name,0,100), $email, password_hash($password, PASSWORD_DEFAULT)]);
  session_regenerate_id(true); $_SESSION['user_id'] = (int)db()->lastInsertId();
  respond(['ok'=>true,'user'=>['id'=>$_SESSION['user_id'],'name'=>$name,'email'=>$email]],201);
} catch (PDOException $e) {
  if ($e->getCode() === '23000') respond(['ok'=>false,'error'=>'อีเมลนี้มีบัญชีอยู่แล้ว'],409);
  error_log($e->getMessage()); respond(['ok'=>false,'error'=>'ไม่สามารถสร้างบัญชีได้ ตรวจสอบการตั้งค่าฐานข้อมูล'],500);
}
