<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// `config.php`から設定をロード
$config = require('config.php');

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                   // SMTPのデバッグ出力を有効にする（デバッグ情報をブラウザに出力する）
    $mail->isSMTP();                                          // SMTPを使用する
    $mail->Host = $config['email']['host'];                   // メールサーバーのホスト名
    $mail->SMTPAuth = true;                                   // SMTP認証を有効にする
    $mail->Username = $config['email']['username'];           // SMTPユーザー名
    $mail->Password = $config['email']['password'];           // SMTPパスワード
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;       // 暗号化を有効にする
    $mail->Port = $config['email']['port'];                   // 接続するポート

    // Recipients
    $mail->setFrom($config['email']['from']['email'], $config['email']['from']['name']);
    $mail->addAddress($config['email']['addAddress']['email'], $config['email']['addAddress']['name']);  // 送信先を追加

    // Content
    $mail->isHTML(false);                                     // セット email format to plain text
    $mail->Subject = 'PHPMailer Test Subject';
    $mail->Body    = "This is a plain-text message body - PHPMailer test mail.";

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
