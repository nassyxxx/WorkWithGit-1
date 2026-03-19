<?php
session_start();


if (!isset($_SESSION['registered']) || $_SESSION['registered'] !== true) {
    header("Location: index.php?error=register_first");
    exit;
}

$result = $_SESSION['calc_result'] ?? null;
$error = $_SESSION['calc_error'] ?? null;
$num1 = $_SESSION['calc_num1'] ?? '';
$num2 = $_SESSION['calc_num2'] ?? '';
$operation = $_SESSION['calc_operation'] ?? '';

unset($_SESSION['calc_result'], $_SESSION['calc_error'], $_SESSION['calc_num1'], $_SESSION['calc_num2'], $_SESSION['calc_operation']);


if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Калькулятор</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="calculator-container">
        <h2 class="calculator-title">🧮 Калькулятор</h2>
        
        <div style="background: #e3f2fd; padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: center;">
            <p style="color: #1976d2; margin: 0;">
                👤 Вы вошли как: <strong><?= htmlspecialchars($_SESSION['user_name'] ?? 'Пользователь') ?></strong>
                <a href="calculator.php?logout=1" style="color: #d32f2f; margin-left: 15px;">Выйти</a>
            </p>
        </div>
        
       
        <form class="calculator-form" method="POST" action="action.php">
            
            <!-- Скрытое поле для определения типа формы -->
            <input type="hidden" name="form_type" value="calculator">
            
            <div class="form-group">
                <label for="num1">Первое число:</label>
                <input type="number" 
                       id="num1" 
                       name="num1" 
                       placeholder="Например: 10" 
                       step="any"
                       value="<?= htmlspecialchars($num1) ?>"
                       required>
            </div>
            
            <div class="form-group">
                <label>Выберите операцию:</label>
                <div class="operation-buttons">
                    <input type="radio" id="add" name="operation" value="add"
                           <?= $operation === 'add' ? 'checked' : '' ?>>
                    <label for="add" title="Сложение">+</label>
                    
                    <input type="radio" id="subtract" name="operation" value="subtract"
                           <?= $operation === 'subtract' ? 'checked' : '' ?>>
                    <label for="subtract" title="Вычитание">−</label>
                    
                    <input type="radio" id="multiply" name="operation" value="multiply"
                           <?= $operation === 'multiply' ? 'checked' : '' ?>>
                    <label for="multiply" title="Умножение">×</label>
                    
                    <input type="radio" id="divide" name="operation" value="divide"
                           <?= $operation === 'divide' ? 'checked' : '' ?>>
                    <label for="divide" title="Деление">÷</label>
                </div>
            </div>
            
            <div class="form-group">
                <label for="num2">Второе число:</label>
                <input type="number" 
                       id="num2" 
                       name="num2" 
                       placeholder="Например: 5" 
                       step="any"
                       value="<?= htmlspecialchars($num2) ?>"
                       required>
            </div>
            
            <button type="submit">Рассчитать</button>
            
        
            <a href="calculator.php" class="clear-btn" style="display: block; text-align: center; padding: 14px; background: #6c757d; color: white; text-decoration: none; border-radius: 8px; font-weight: bold; margin-top: 10px;">Очистить</a>
        </form>
        
        <?php if ($error): ?>
            <div class="error-box">
                ❌ <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        
        <?php if ($result !== null && !$error): ?>
            <div class="result-box">
                <h3>✅ Результат:</h3>
                <div class="calculation">
                    <?= htmlspecialchars($result['num1']) ?> 
                    <?= htmlspecialchars($result['operation_symbol']) ?> 
                    <?= htmlspecialchars($result['num2']) ?> 
                    =
                </div>
                <div class="price"><?= htmlspecialchars($result['result']) ?></div>
            </div>
        <?php endif; ?>
        
        <div style="text-align: center;">
            <a href="index.php" class="back-link">← Вернуться к форме регистрации</a>
        </div>
    </div>
</body>
</html>
            
           