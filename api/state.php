<?php
require __DIR__ . '/config.php';
$userId = require_user_id();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $stmt = db()->prepare('SELECT state_json,updated_at FROM user_states WHERE user_id=?');
  $stmt->execute([$userId]); $row = $stmt->fetch();
  respond(['ok'=>true,'state'=>$row ? json_decode($row['state_json'], true) : null]);
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') respond(['ok'=>false,'error'=>'Method not allowed'],405);
$d = json_input(); $state = $d['state'] ?? null;
if (!is_array($state) || !isset($state['tx']) || !is_array($state['tx'])) respond(['ok'=>false,'error'=>'รูปแบบข้อมูลไม่ถูกต้อง'],422);
$json = json_encode($state, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
if ($json === false || strlen($json) > 5_000_000) respond(['ok'=>false,'error'=>'ข้อมูลมีขนาดใหญ่เกินไปหรือแปลงข้อมูลไม่ได้'],413);
$stmt = db()->prepare('INSERT INTO user_states (user_id,state_json) VALUES (?,?) ON DUPLICATE KEY UPDATE state_json=VALUES(state_json), updated_at=CURRENT_TIMESTAMP');
$stmt->execute([$userId,$json]);
respond(['ok'=>true,'saved'=>true]);
