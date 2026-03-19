<?php
// Проверяем, что форма отправлена методом POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

// Получаем данные из формы
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$name = $_POST['name'] ?? '';
$gender = $_POST['gender'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';
$agreement = isset($_POST['agreement']);

// Массив для хранения ошибок
$errors = [];

// Валидация email
if (empty($email)) {
    $errors[] = "Поле 'Почта' обязательно для заполнения";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Введите корректный email адрес";
}

// Валидация пароля
if (empty($password)) {
    $errors[] = "Поле 'Пароль' обязательно для заполнения";
} elseif (strlen($password) < 6) {
    $errors[] = "Пароль должен содержать минимум 6 символов";
}

// Проверка совпадения паролей
if ($password !== $confirm_password) {
    $errors[] = "Пароли не совпадают";
}

// Валидация имени
if (empty($name)) {
    $errors[] = "Поле 'Имя' обязательно для заполнения";
}

// Валидация пола
if (empty($gender)) {
    $errors[] = "Выберите пол";
}

// Валидация согласия
if (!$agreement) {
    $errors[] = "Необходимо согласиться с условиями использования";
}

// Если есть ошибки, выводим их
if (!empty($errors)) {
    ?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ошибки регистрации</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 20px;
            }
            .error-container {
                background: white;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
                max-width: 500px;
                width: 100%;
            }
            h2 {
                color: #e74c3c;
                margin-bottom: 20px;
            }
            .error-list {
                list-style: none;
                padding: 0;
            }
            .error-list li {
                padding: 10px;
                margin: 5px 0;
                background: #fdf2f2;
                border-left: 4px solid #e74c3c;
                color: #c0392b;
            }
            .back-link {
                display: inline-block;
                margin-top: 20px;
                padding: 10px 20px;
                background: #667eea;
                color: white;
                text-decoration: none;
                border-radius: 5px;
            }
            .back-link:hover {
                background: #764ba2;
            }
        </style>
    </head>
    <body>
        <div class="error-container">
            <h2>❌ Ошибки при регистрации:</h2>
            <ul class="error-list">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
            <a href="index.php" class="back-link">← Вернуться к форме</a>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// Если все поля валидны, показываем успешную регистрацию
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация успешна</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .success-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            width: 100%;
            text-align: center;
        }
        h2 {
            color: #27ae60;
            margin-bottom: 20px;
        }
        .success-icon {
            font-size: 60px;
            margin-bottom: 20px;
        }
        .user-info {
            text-align: left;
            margin: 20px 0;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 5px;
        }
        .user-info p {
            margin: 10px 0;
            color: #555;
        }
        .user-info strong {
            color: #333;
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 30px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .back-link:hover {
            background: #764ba2;
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="success-icon">✅</div>
        <h2>Регистрация успешна!</h2>
        <p>Добро пожаловать, <?= htmlspecialchars($name) ?>!</p>
        
        <div class="user-info">
            <p><strong>Имя:</strong> <?= htmlspecialchars($name) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
            <p><strong>Пол:</strong> <?= htmlspecialchars($gender === 'male' ? 'Мужской' : ($gender === 'female' ? 'Женский' : 'Другой')) ?></p>
        </div>
        
        <p style="color: #27ae60; font-weight: bold;">Все данные прошли валидацию!</p>
        
        <a href="index.php" class="back-link">← Вернуться на главную</a>
    </div>
</body>
</html>