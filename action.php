<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}


$form_type = $_POST['form_type'] ?? 'registration';

if ($form_type === 'calculator') {
    

    if (!isset($_SESSION['registered']) || $_SESSION['registered'] !== true) {
        header("Location: index.php?error=register_first");
        exit;
    }
    
    $num1 = $_POST['num1'] ?? '';
    $num2 = $_POST['num2'] ?? '';
    $operation = $_POST['operation'] ?? '';
    
    $error = null;
    $result = null;
    
    // Валидация
    if ($num1 === '' || $num2 === '') {
        $error = "Введите оба числа";
    } elseif (!is_numeric($num1) || !is_numeric($num2)) {
        $error = "Введите корректные числа";
    } elseif (empty($operation)) {
        $error = "Выберите операцию";
    } else {
        $num1 = (float)$num1;
        $num2 = (float)$num2;
        

        switch ($operation) {
            case 'add':
                $result = $num1 + $num2;
                $operation_symbol = '+';
                break;
            case 'subtract':
                $result = $num1 - $num2;
                $operation_symbol = '−';
                break;
            case 'multiply':
                $result = $num1 * $num2;
                $operation_symbol = '×';
                break;
            case 'divide':
                if ($num2 == 0) {
                    $error = "Деление на ноль невозможно!";
                } else {
                    $result = $num1 / $num2;
                    $operation_symbol = '÷';
                }
                break;
            default:
                $error = "Неизвестная операция";
        }
    }
    

    $_SESSION['calc_result'] = [
        'num1' => $num1,
        'num2' => $num2,
        'operation_symbol' => $operation_symbol ?? '',
        'result' => $result
    ];
    $_SESSION['calc_error'] = $error;
    $_SESSION['calc_num1'] = $num1;
    $_SESSION['calc_num2'] = $num2;
    $_SESSION['calc_operation'] = $operation;
    

    header("Location: calculator.php");
    exit;
}


else {
    

    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $name = trim($_POST['name'] ?? '');
    $gender = $_POST['gender'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $agreement = isset($_POST['agreement']);
    
    $errors = [];
    
    if (empty($name)) {
        $errors[] = "Поле 'Имя' обязательно для заполнения";
    } elseif (strlen($name) < 2) {
        $errors[] = "Имя должно содержать минимум 2 символа";
    }
    
    if (empty($email)) {
        $errors[] = "Поле 'Почта' обязательно для заполнения";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Введите корректный email адрес";
    }
    
    if (empty($gender)) {
        $errors[] = "Выберите пол";
    }
    
    if (empty($password)) {
        $errors[] = "Поле 'Пароль' обязательно для заполнения";
    } elseif (strlen($password) < 6) {
        $errors[] = "Пароль должен содержать минимум 6 символов";
    }
    
    if ($password !== $confirm_password) {
        $errors[] = "Пароли не совпадают";
    }
    
    if (!$agreement) {
        $errors[] = "Необходимо согласиться с условиями использования";
    }
    

    if (!empty($errors)) {
        ?>
        <!DOCTYPE html>
        <html lang="ru">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Ошибки регистрации</title>
            <link rel="stylesheet" href="style.css">
            <style>
                .error-container {
                    background: white;
                    padding: 30px;
                    border-radius: 10px;
                    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
                    max-width: 500px;
                    width: 100%;
                    margin: 40px auto;
                }
                h2 { color: #e74c3c; margin-bottom: 20px; text-align: center; }
                .error-list { list-style: none; padding: 0; }
                .error-list li {
                    padding: 12px;
                    margin: 8px 0;
                    background: #fdf2f2;
                    border-left: 4px solid #e74c3c;
                    color: #c0392b;
                    border-radius: 3px;
                }
                .back-link {
                    display: inline-block;
                    margin-top: 25px;
                    padding: 12px 25px;
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    color: white;
                    text-decoration: none;
                    border-radius: 5px;
                    font-weight: bold;
                    text-align: center;
                    width: 100%;
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
    
    $_SESSION['registered'] = true;
    $_SESSION['user_name'] = $name;
    $_SESSION['user_email'] = $email;
    
    ?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Регистрация успешна</title>
        <link rel="stylesheet" href="style.css">
        <style>
            .success-container {
                background: white;
                padding: 40px;
                border-radius: 10px;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
                max-width: 500px;
                width: 100%;
                text-align: center;
                margin: 40px auto;
            }
            h2 { color: #27ae60; margin-bottom: 20px; }
            .success-icon { font-size: 60px; margin-bottom: 20px; }
            .user-info {
                text-align: left;
                margin: 25px 0;
                padding: 20px;
                background: #f8f9fa;
                border-radius: 5px;
            }
            .user-info p { margin: 12px 0; color: #555; }
            .user-info strong { color: #333; }
            .back-link, .calculator-link {
                display: inline-block;
                margin-top: 15px;
                padding: 12px 30px;
                text-decoration: none;
                border-radius: 5px;
                font-weight: bold;
            }
            .back-link {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
            }
            .calculator-link {
                background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
                color: white;
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
                <p><strong>Пол:</strong> 
                    <?= htmlspecialchars($gender === 'male' ? 'Мужской' : ($gender === 'female' ? 'Женский' : 'Другой')) ?>
                </p>
            </div>
            
            <p style="color: #27ae60; font-weight: bold; margin-top: 20px;">
                Все данные прошли валидацию!
            </p>
            
            <a href="calculator.php" class="calculator-link">🧮 Перейти к калькулятору</a>
            <br>
            <a href="index.php" class="back-link">← Вернуться на главную</a>
        </div>
    </body>
    </html>
    <?php
}
?>

