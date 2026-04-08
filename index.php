<?php

class Page {
    private string $name;
    private string $template;

    public function __construct() {
        $this->name = "page";
        $this->template = "<div><p>It is a default page</p></div>";
    }

    public function render(): void {
        echo $this->template;
    }

    protected function getName(): string {
        return $this->name;
    }

    protected function setTemplate(string $template): void {
        $this->template = $template;
    }
}


$currentPage = isset($_GET['page']) ? $_GET['page'] : 'home'; 
$pageContent = '';

// Простой роутинг для первой версии
if($currentPage == 'home') {
    $pageContent = "
    <div class='home-page'>
        <h1>🌊 OceanWorld</h1>
        <p>Погрузись в удивительный подводный мир</p>
        <div class='buttons-container'>
            <a href='?page=marine' class='ocean-button'>
                <div class='button-icon'>🐠</div>
                <span>Морские Обитатели</span>
            </a>
            <a href='?page=ocean' class='ocean-button'>
                <div class='button-icon'>🌊</div>
                <span>Тайны Океана</span>
            </a>
        </div>
    </div>";
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OceanWorld - Подводный мир</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(180deg, #006994 0%, #003366 50%, #001a33 100%);
            min-height: 100vh;
            color: #fff;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .home-page { text-align: center; }
        .home-page h1 {
            font-size: 5rem;
            margin-bottom: 1rem;
            text-shadow: 0 0 20px rgba(0, 255, 255, 0.5);
            animation: glow 3s ease-in-out infinite alternate;
        }
        @keyframes glow {
            from { text-shadow: 0 0 20px rgba(0, 255, 255, 0.5); }
            to { text-shadow: 0 0 40px rgba(0, 255, 255, 0.8); }
        }
        .home-page p { font-size: 1.5rem; color: #a8dadc; margin-bottom: 4rem; }
        .buttons-container {
            display: flex;
            gap: 3rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        .ocean-button {
            cursor: pointer;
            text-decoration: none;
            color: #fff;
            transition: all 0.4s ease;
            padding: 2rem 3rem;
            background: linear-gradient(135deg, rgba(0, 105, 148, 0.8) 0%, rgba(0, 51, 102, 0.8) 100%);
            border-radius: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            min-width: 280px;
        }
        .ocean-button:hover {
            transform: translateY(-10px) scale(1.05);
            border-color: rgba(0, 255, 255, 0.8);
        }
        .button-icon { font-size: 4rem; margin-bottom: 1rem; display: block; }
        .ocean-button span {
            font-weight: 700;
            font-size: 1.3rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .nav-links {
            position: fixed;
            top: 20px;
            right: 20px;
            display: flex;
            gap: 1rem;
            z-index: 100;
        }
        .nav-link {
            padding: 12px 25px;
            background: rgba(0, 105, 148, 0.6);
            color: #fff;
            text-decoration: none;
            border-radius: 30px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s;
            font-weight: 600;
        }
        .nav-link:hover {
            background: rgba(0, 255, 255, 0.3);
            border-color: rgba(0, 255, 255, 0.8);
        }
        @media (max-width: 768px) {
            .home-page h1 { font-size: 3rem; }
            .buttons-container { flex-direction: column; }
        }
    </style>
</head>
<body>
    <nav class="nav-links">
        <a href="?page=home" class="nav-link">🏠 Главная</a>
        <a href="?page=page" class="nav-link">📄 Default</a>
        <a href="?page=marine" class="nav-link">🐠 Обитатели</a>
        <a href="?page=ocean" class="nav-link">🌊 Океан</a>
    </nav>
    <div class="container">
        <?php echo $pageContent; ?>
    </div>
</body>
</html>