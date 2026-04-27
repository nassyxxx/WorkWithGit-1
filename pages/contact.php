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
    <?php
	$statusMessage = '';

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	    $name = trim($_POST['name'] ?? '');
	    $email = trim($_POST['email'] ?? '');
	    $message = trim($_POST['message'] ?? '');

	    // Простая валидация
	    if ($name && $email && filter_var($email, FILTER_VALIDATE_EMAIL) && $message) {
		// Здесь можно добавить mail() или запись в БД
		$statusMessage = '<div class="alert success">Спасибо, ' . htmlspecialchars($name) . '! Сообщение успешно отправлено.</div>';
		// Очистка $_POST предотвращает повторную отправку при обновлении страницы
		$_POST = [];
	    } else {
		$statusMessage = '<div class="alert error">Заполните все поля корректно. Проверьте формат Email.</div>';
	    }
	}
	?>
	<?php include '../includes/header.php'; ?>

	<main>
	    <h1>Контакты</h1>
	    
	    <?php if ($statusMessage): ?>
		<?= $statusMessage ?>
	    <?php endif; ?>

	    <form method="post" action="">
		<input type="text" name="name" placeholder="Имя" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required>
		<input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
		<textarea name="message" placeholder="Ваше сообщение" required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
		<button type="submit">Отправить</button>
	    </form>
	</main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>