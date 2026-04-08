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

class OceanPage extends Page {
    public function __construct() {
        parent::__construct();
        $this->name = "ocean";
        $facts = $this->createOceanFacts();
        $template = "
        <div class='ocean-page'>
            <h1 class='page-title'>🌊 Тайны Океана</h1>
            <p class='page-subtitle'>Удивительные факты о мировом океане</p>
            <div class='facts-container'>$facts</div>
            <a href='?page=home' class='back-button'>🏠 На главную</a>
        </div>";
        $this->setTemplate($template);
    }

    private function createOceanFacts(): string {
        $factsData = [
            ['number' => '1', 'fact' => 'Океан покрывает 71% поверхности Земли', 'icon' => '🌍'],
            ['number' => '2', 'fact' => 'Исследовано менее 5% мирового океана', 'icon' => '🔍'],
            ['number' => '3', 'fact' => 'Самая глубокая точка - 11 034 метра', 'icon' => '📏'],
            ['number' => '4', 'fact' => 'В океане содержится 97% всей воды', 'icon' => '💧'],
            ['number' => '5', 'fact' => 'Океан производит более 50% кислорода', 'icon' => '💨'],
            ['number' => '6', 'fact' => 'В океане более 3 миллионов кораблекрушений', 'icon' => '🚢']
        ];
        $factsHtml = '';
        foreach ($factsData as $fact) {
            $factsHtml .= "
            <div class='fact-card'>
                <div class='fact-number'>{$fact['number']}</div>
                <div class='fact-icon'>{$fact['icon']}</div>
                <p class='fact-text'>{$fact['fact']}</p>
            </div>";
        }
        return $factsHtml;
    }
}

$currentPage = isset($_GET['page']) ? $_GET['page'] : 'home';
$pageContent = '';

switch($currentPage) {
    case 'page':
        // ✅ Default Page - вывод из класса Page с оформлением
        $page = new Page();
        ob_start(); $page->render(); $rawContent = ob_get_clean();
        $pageContent = "
        <div class='default-page-wrapper'>
            <div class='default-page-indicator'>
                <span class='indicator-icon'>📄</span>
                <strong>Default Page</strong> — вывод из класса <code>Page</code>
            </div>
            <div class='default-page-content'>$rawContent</div>
            <div class='debug-info'>
                <small>🔍 Отладка: <code>&lt;div&gt;&lt;p&gt;It is a default page&lt;/p&gt;&lt;/div&gt;</code></small>
            </div>
        </div>";
        break;
    case 'marine':
        $marinePage = new MarinePage();
        ob_start(); $marinePage->render(); $pageContent = ob_get_clean();
        break;
    case 'ocean':
        $oceanPage = new OceanPage();
        ob_start(); $oceanPage->render(); $pageContent = ob_get_clean();
        break;
    default:  // ← ГЛАВНАЯ ПО УМОЛЧАНИЮ
        $pageContent = "
        <div class='home-page'>
            <h1>🌊 OceanWorld</h1>
            <p>Погрузись в удивительный подводный мир</p>
            <div class='buttons-container' style='position: relative; z-index: 100;'>
                <a href='?page=marine' class='ocean-button'>
                    <div class='button-icon'>🐠</div>
                    <span>Морские Обитатели</span>
                </a>
                <a href='?page=ocean' class='ocean-button'>
                    <div class='button-icon'>🌊</div>
                    <span>Тайны Океана</span>
                </a>
            </div>
            <div class='ocean-waves' style='z-index: 1;'>
                <div class='wave wave1'></div>
                <div class='wave wave2'></div>
                <div class='wave wave3'></div>
            </div>
            <div class='bubbles' style='z-index: 0; pointer-events: none;'>
                <div class='bubble'></div>
                <div class='bubble'></div>
                <div class='bubble'></div>
                <div class='bubble'></div>
                <div class='bubble'></div>
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


	.bubbles {
	    position: fixed;
	    width: 100%;
	    height: 100%;
	    overflow: hidden;
	    z-index: 1;
	    pointer-events: none;  /* ← Пропускать клики сквозь пузырьки */
	    top: 0;
	    left: 0;
	}

	.bubble {
	    position: absolute;
	    bottom: -50px;
	    background: rgba(255, 255, 255, 0.1);
	    border-radius: 50%;
	    animation: rise 15s infinite ease-in;
	}

	.bubble:nth-child(1) { width: 40px; height: 40px; left: 10%; animation-duration: 8s; }
	.bubble:nth-child(2) { width: 20px; height: 20px; left: 20%; animation-duration: 5s; animation-delay: 1s; }
	.bubble:nth-child(3) { width: 50px; height: 50px; left: 35%; animation-duration: 10s; animation-delay: 2s; }
	.bubble:nth-child(4) { width: 80px; height: 80px; left: 50%; animation-duration: 11s; }
	.bubble:nth-child(5) { width: 35px; height: 35px; left: 80%; animation-duration: 6s; animation-delay: 1s; }

	@keyframes rise {
	    0% { 
		bottom: -50px; 
		transform: translateX(0);
		opacity: 1;
	    }
	    50% { 
		transform: translateX(100px);
	    }
	    100% { 
		bottom: 100%; 
		transform: translateX(-200px); 
		opacity: 0; 
	    }
	}


	.ocean-waves {
	    position: absolute;
	    bottom: 0;
	    left: 0;
	    width: 100%;
	    height: 200px;
	    overflow: hidden;
	    z-index: 2;
	    pointer-events: none;
	}

	.wave {
	    position: absolute;
	    bottom: 0;
	    left: 0;
	    width: 200%;
	    height: 100px;
	    background: url('data:image/svg+xml;utf8,<svg viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg"><path d="M0,60 C150,120 350,0 600,60 C850,120 1050,0 1200,60 L1200,120 L0,120 Z" fill="rgba(255,255,255,0.1)"/></svg>');
	    background-size: 50% 100%;
	    animation: wave 10s linear infinite;
	}

	.wave1 { animation-duration: 10s; opacity: 0.3; }
	.wave2 { animation-duration: 7s; opacity: 0.5; bottom: 10px; }
	.wave3 { animation-duration: 5s; opacity: 0.7; bottom: 20px; }

	@keyframes wave {
	    0% { transform: translateX(0); }
	    100% { transform: translateX(-50%); }
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

	
	.default-page-wrapper {
	    width: 100%;
	    max-width: 600px;
	    text-align: center;
	    animation: fadeIn 0.5s ease-in;
	}

	@keyframes fadeIn {
	    from { opacity: 0; transform: translateY(20px); }
	    to { opacity: 1; transform: translateY(0); }
	}

	.default-page-indicator {
	    background: linear-gradient(135deg, rgba(255, 193, 7, 0.2), rgba(255, 152, 0, 0.2));
	    border: 2px solid rgba(255, 193, 7, 0.5);
	    border-radius: 15px;
	    padding: 1rem 1.5rem;
	    margin-bottom: 2rem;
	    display: flex;
	    align-items: center;
	    justify-content: center;
	    gap: 0.75rem;
	    color: #ffd54f;
	    font-size: 1rem;
	}

	.indicator-icon { 
	    font-size: 1.5rem; 
	    animation: bounce 2s infinite;
	}

	@keyframes bounce {
	    0%, 100% { transform: translateY(0); }
	    50% { transform: translateY(-5px); }
	}

	.default-page-indicator code {
	    background: rgba(0, 0, 0, 0.3);
	    padding: 2px 6px;
	    border-radius: 4px;
	    font-family: monospace;
	    font-size: 0.9em;
	    color: #fff;
	}

	.default-page-content {
	    background: rgba(255, 255, 255, 0.95);
	    border: 3px dashed #667eea;
	    border-radius: 15px;
	    padding: 3rem 2rem;
	    margin: 0 auto;
	    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
	}

	.default-page-content > div {
	    background: #f8f9fa;
	    border: 2px solid #667eea;
	    border-radius: 10px;
	    padding: 2rem;
	    animation: pulseBorder 2s infinite;
	}

	@keyframes pulseBorder {
	    0%, 100% { border-color: #667eea; }
	    50% { border-color: #00ffff; }
	}

	.default-page-content > div > p {
	    font-size: 1.5rem;
	    color: #667eea;
	    font-weight: bold;
	    margin: 0;
	    text-shadow: 0 0 10px rgba(102, 126, 234, 0.3);
	}

	.debug-info {
	    margin-top: 1.5rem;
	    padding: 0.75rem;
	    background: rgba(0, 255, 255, 0.1);
	    border: 1px solid rgba(0, 255, 255, 0.3);
	    border-radius: 10px;
	    color: #a8dadc;
	    font-size: 0.9rem;
	}

	.debug-info code {
	    background: rgba(0, 0, 0, 0.3);
	    padding: 2px 6px;
	    border-radius: 4px;
	    font-family: monospace;
	    font-size: 0.85em;
	    color: #00ffff;
	    display: block;
	    margin-top: 0.5rem;
	    word-break: break-all;
	}

	
	.ocean-page {
	    width: 100%;
	    text-align: left;
	    background: rgba(0, 51, 102, 0.8);
	    padding: 3rem;
	    border-radius: 30px;
	    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
	    backdrop-filter: blur(10px);
	    border: 2px solid rgba(255, 255, 255, 0.2);
	    animation: slideIn 0.5s ease-out;
	}

	@keyframes slideIn {
	    from { opacity: 0; transform: translateX(-30px); }
	    to { opacity: 1; transform: translateX(0); }
	}

	.ocean-page .page-title {
	    font-size: 2.5rem;
	    margin-bottom: 0.5rem;
	    text-shadow: 0 0 20px rgba(0, 255, 255, 0.5);
	    color: #fff;
	}

	.ocean-page .page-subtitle { 
	    color: #a8dadc; 
	    margin-bottom: 2rem; 
	    font-size: 1.2rem;
	}

	.facts-container {
	    display: grid;
	    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
	    gap: 20px;
	    margin-bottom: 2rem;
	}

	.fact-card {
	    background: linear-gradient(135deg, rgba(0, 105, 148, 0.6) 0%, rgba(0, 51, 102, 0.6) 100%);
	    border-radius: 20px;
	    padding: 25px;
	    border: 2px solid rgba(255, 255, 255, 0.2);
	    transition: all 0.4s ease;
	    backdrop-filter: blur(10px);
	    display: flex;
	    align-items: center;
	    gap: 20px;
	    animation: floatCard 3s ease-in-out infinite;
	}

	@keyframes floatCard {
	    0%, 100% { transform: translateY(0); }
	    50% { transform: translateY(-5px); }
	}

	.fact-card:hover {
	    transform: translateX(10px) scale(1.02);
	    border-color: rgba(0, 255, 255, 0.6);
	    box-shadow: 0 15px 40px rgba(0, 255, 255, 0.3);
	    animation-play-state: paused;
	}

	.fact-card:nth-child(1) { animation-delay: 0s; }
	.fact-card:nth-child(2) { animation-delay: 0.2s; }
	.fact-card:nth-child(3) { animation-delay: 0.4s; }
	.fact-card:nth-child(4) { animation-delay: 0.6s; }
	.fact-card:nth-child(5) { animation-delay: 0.8s; }
	.fact-card:nth-child(6) { animation-delay: 1s; }

	.fact-number {
	    font-size: 2.5rem;
	    font-weight: 700;
	    color: rgba(0, 255, 255, 0.8);
	    min-width: 50px;
	    text-shadow: 0 0 10px rgba(0, 255, 255, 0.5);
	}

	.fact-icon {
	    font-size: 2.5rem;
	    animation: iconPop 2s infinite;
	}

	@keyframes iconPop {
	    0%, 100% { transform: scale(1); }
	    50% { transform: scale(1.2); }
	}

	.fact-text {
	    color: #a8dadc;
	    font-size: 1rem;
	    line-height: 1.6;
	    margin: 0;
	}


	.ocean-page .back-button {
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

	.ocean-page .back-button:hover {
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


    <div class="bubbles">
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
    </div>


    <div class="container">
        <?php echo $pageContent; ?>
    </div>


    <?php if($currentPage == 'home'): ?>
    <div class="ocean-waves">
        <div class="wave wave1"></div>
        <div class="wave wave2"></div>
        <div class="wave wave3"></div>
    </div>
    <?php endif; ?>
</body>
</html>