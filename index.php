<?php
session_start();
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>お問い合わせフォーム</title>
</head>
<body>
    <h1>お問い合わせフォーム</h1>
    <form action="email.php" method="post">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>"/>
        <div>
            <label for="name">名前:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="email">メールアドレス:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="message">メッセージ:</label>
            <textarea id="message" name="message" required></textarea>
        </div>
        <button type="submit">送信</button>
    </form>
    <?php if (isset($_SESSION['feedback'])): ?>
        <p><?= $_SESSION['feedback']; ?></p>
        <?php unset($_SESSION['feedback']); ?>
    <?php endif; ?>
</body>
</html>
