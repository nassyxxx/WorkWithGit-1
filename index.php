<?php

class Page {
    private string $name;
    private string $template;
    public function __construct() {
        $this->name = "page";
        $this->template = "<div><p>It is a default page</p></div>";
    }
    public function render(): void { echo $this->template; }
    protected function getName(): string { return $this->name; }
    protected function setTemplate(string $template): void { $this->template = $template; }
}


class MarinePage extends Page {
    public function __construct() {
        parent::__construct();
        $this->name = "marine";
        $cards = $this->createMarineCards();
        $template = "
        <div class='marine-page'>
            <h1 class='page-title'>🐠 Морские Обитатели</h1>
            <p class='page-subtitle'>Удивительные создания подводного мира</p>
            <div class='cards-container'>$cards</div>
            <a href='?page=home' class='back-button'>🏠 На главную</a>
        </div>";
        $this->setTemplate($template);
    }

    private function createMarineCards(): string {
        $marineData = [
            ['title' => 'Голубой Кит', 'description' => 'Самое большое животное на планете.', 'depth' => '0-500м', 'status' => 'Уязвимый', 'icon' => '🐋'],
            ['title' => 'Большая Белая Акула', 'description' => 'Крупнейшая хищная рыба.', 'depth' => '0-1200м', 'status' => 'Уязвимый', 'icon' => '🦈'],
            ['title' => 'Морской Конёк', 'description' => 'Уникальная рыба, самцы вынашивают потомство.', 'depth' => '0-50м', 'status' => 'Близкий к уязвимому', 'icon' => '🐴'],
            ['title' => 'Осьминог', 'description' => 'Одно из самых умных беспозвоночных.', 'depth' => '0-5000м', 'status' => 'Не оценён', 'icon' => '🐙']
        ];
        $cardsHtml = '';
        foreach ($marineData as $marine) {
            $cardsHtml .= "
            <div class='card'>
                <div class='card-icon'>{$marine['icon']}</div>
                <div class='card-body'>
                    <h2 class='card-title'>{$marine['title']}</h2>
                    <p class='card-description'>{$marine['description']}</p>
                    <div class='card-meta'>
                        <span class='card-depth'>🌊 {$marine['depth']}</span>
                        <span class='card-status'>{$marine['status']}</span>
                    </div>
                </div>
            </div>";
        }
        return $cardsHtml;
    }
}


$currentPage = isset($_GET['page']) ? $_GET['page'] : 'home';
$pageContent = '';

switch($currentPage) {
    case 'page':
        $page = new Page();
        ob_start(); $page->render(); $pageContent = ob_get_clean();
        break;
    case 'marine':
        $marinePage = new MarinePage();
        ob_start(); $marinePage->render(); $pageContent = ob_get_clean();
        break;
    default:
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
        break;
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

	.marine-page {
            width: 100%;
            text-align: left;
            background: rgba(0, 51, 102, 0.8);
            padding: 3rem;
            border-radius: 30px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.2);
        }
        .page-title {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            text-shadow: 0 0 20px rgba(0, 255, 255, 0.5);
        }
        .page-subtitle { color: #a8dadc; margin-bottom: 2rem; font-size: 1.2rem; }
        .cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 2rem;
        }
        .card {
            background: linear-gradient(135deg, rgba(0, 105, 148, 0.6) 0%, rgba(0, 51, 102, 0.6) 100%);
            border-radius: 20px;
            padding: 25px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            transition: all 0.4s ease;
            backdrop-filter: blur(10px);
        }
        .card:hover {
            transform: translateY(-10px) scale(1.02);
            border-color: rgba(0, 255, 255, 0.6);
            box-shadow: 0 15px 40px rgba(0, 255, 255, 0.3);
        }
        .card-icon { font-size: 4rem; margin-bottom: 15px; display: block; text-align: center; }
        .card-title { font-size: 1.4rem; margin-bottom: 10px; color: #fff; }
        .card-description { color: #a8dadc; font-size: 0.95rem; margin-bottom: 15px; line-height: 1.6; }
        .card-meta { display: flex; justify-content: space-between; font-size: 0.9rem; }
        .card-depth { color: #a8dadc; }
        .card-status { background: rgba(255, 255, 255, 0.2); padding: 5px 10px; border-radius: 15px; font-size: 0.8rem; }
        .back-button {
            display: inline-block;
            padding: 14px 35px;
            background: linear-gradient(135deg, rgba(0, 105, 148, 0.8), rgba(0, 51, 102, 0.8));
            color: #fff;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 700;
            transition: all 0.3s;
            border: 2px solid rgba(255, 255, 255, 0.3);
            margin-top: 1rem;
        }
        .back-button:hover {
            background: rgba(0, 255, 255, 0.3);
            border-color: rgba(0, 255, 255, 0.8);
            box-shadow: 0 0 30px rgba(0, 255, 255, 0.5);
            transform: translateY(-3px);
        }

        @media (max-width: 768px) {
            .home-page h1 { font-size: 3rem; }
            .buttons-container { flex-direction: column; }
	    .marine-page { padding: 1.5rem; }
            .cards-container { grid-template-columns: 1fr; }
            .nav-links { position: static; justify-content: center; margin-bottom: 1rem; }
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