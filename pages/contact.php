<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контакты</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="icon" href="/assets/images/favicon.jpeg" type="image/jpeg">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <main>
        <h1>Контакты</h1>
        <form method="post" action="">
            <input type="text" name="name" placeholder="Имя" required>
            <input type="email" name="email" placeholder="Email" required>
            <textarea name="message" placeholder="Ваше сообщение" required></textarea>
            <button type="submit">Отправить</button>
        </form>
    </main>
    <?php include '../includes/footer.php'; ?>
</body>
</html>