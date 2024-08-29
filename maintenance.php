<?php
const TIME_TO_WAITt = 60; // in seconds
const SITE_TITLE = 'My Site';
const CONTACT_LINK = 'http://example.com';

// Get the user's preferred languages from the Accept-Language header
$languages = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);

// Set the default language to English
$lang = 'en';

// Loop through the user's preferred languages and check if we have a translation available
foreach ($languages as $language) {
    $language = strtolower(substr($language, 0, 2));
    if (in_array($language, array('en', 'ar', 'fr', 'de', 'es', 'zh', 'pt'))) {
        $lang = $language;
        break;
    }
}

// Set the content-language header to the selected language
header("Content-Language: $lang");

// Translations object
$translations = array(
    'en' => array(
        'title' => 'Site Maintenance',
        'heading' => 'We\'ll be back soon!',
        'text' => 'We\'re just sprucing things up a bit! In the meantime, feel free to <a href="' . $contact_link . '">join us on Discord</a> for a chat or to get any assistance you need. We\'ll be up and running in just a moment, and the page will automatically refresh at the end of the countdown below.',
        'team' => '&mdash; The Team',
        'day' => 'Days',
        'hour' => 'Hours',
        'minute' => 'Minutes',
        'second' => 'Seconds',
    ),
    'ar' => array(
        'title' => 'صيانة الموقع',
        'heading' => 'سنعود قريبا!',
        'text' => 'نحن نعمل على تحسين الموقع لك! في هذه الأثناء، لا تتردد في <a href="' . $contact_link . '">الانضمام إلينا على ديسكورد</a> للدردشة أو للحصول على المساعدة التي تحتاجها. سنعود للعمل في لحظات قليلة، وسيتم تحديث الصفحة تلقائياً عند انتهاء العد التنازلي أدناه.',
        'team' => '&mdash; فريق العمل',
        'day' => 'أيام',
        'hour' => 'ساعات',
        'minute' => 'دقائق',
        'second' => 'ثواني',
    ),
    'fr' => array(
        'title' => 'Maintenance du site',
        'heading' => 'Nous reviendrons bientôt!',
        'text' => 'Nous apportons juste quelques améliorations! En attendant, n\'hésitez pas à <a href="' . $contact_link . '">nous rejoindre sur Discord</a> pour discuter ou obtenir l\'aide dont vous avez besoin. Nous serons de retour en un instant, et la page se rafraîchira automatiquement à la fin du compte à rebours ci-dessous.',
        'team' => '&mdash; L\'équipe',
        'day' => 'Jours',
        'hour' => 'Heures',
        'minute' => 'Minutes',
        'second' => 'Secondes',
    ),
    'de' => array(
        'title' => 'Wartung der Website',
        'heading' => 'Wir sind bald zurück!',
        'text' => 'Wir verbessern gerade ein paar Dinge für dich! In der Zwischenzeit kannst du dich gerne <a href="' . $contact_link . '">uns auf Discord anschließen</a>, um zu chatten oder um die Hilfe zu erhalten, die du benötigst. Wir sind in Kürze wieder da, und die Seite wird am Ende des Countdowns unten automatisch aktualisiert.',
        'team' => '&mdash; Das Team',
        'day' => 'Tage',
        'hour' => 'Stunden',
        'minute' => 'Minuten',
        'second' => 'Sekunden',
    ),
    'es' => array(
        'title' => 'Mantenimiento del sitio',
        'heading' => '¡Volveremos pronto!',
        'text' => '¡Estamos mejorando algunas cosas para ti! Mientras tanto, siéntete libre de <a href="' . $contact_link . '">unirte a nosotros en Discord</a> para charlar o para obtener la asistencia que necesitas. Estaremos operativos en un instante, y la página se recargará automáticamente al final de la cuenta regresiva a continuación.',
        'team' => '&mdash; El equipo',
        'day' => 'Días',
        'hour' => 'Horas',
        'minute' => 'Minutos',
        'second' => 'Segundos',
    ),
    'zh' => array(
        'title' => '网站维护',
        'heading' => '我们很快就会回来！',
        'text' => '我们正在为您改善一些事物！同时，欢迎您<a href="' . $contact_link . '">加入我们的Discord</a>进行交流或获取您所需的帮助。我们将很快恢复运行，页面将在下方倒计时结束时自动刷新。',
        'team' => '&mdash; 团队',
        'day' => '天',
        'hour' => '小时',
        'minute' => '分钟',
        'second' => '秒',
    ),
    'pt' => array(
        'title' => 'Manutenção do Site',
        'heading' => 'Voltaremos em breve!',
        'text' => 'Estamos aprimorando algumas coisas para você! Enquanto isso, sinta-se à vontade para <a href="' . $contact_link . '">se juntar a nós no Discord</a> para conversar ou obter a ajuda que precisa. Estaremos de volta num piscar de olhos, e a página será recarregada automaticamente ao final da contagem abaixo.',
        'team' => '&mdash; O time',
        'day' => 'Dias',
        'hour' => 'Horas',
        'minute' => 'Minutos',
        'second' => 'Segundos',
    ),
);

// Set the protocol
$protocol = isset($_SERVER['SERVER_PROTOCOL']) ?? '';
if (!in_array($protocol, array('HTTP/1.1', 'HTTP/2', 'HTTP/2.0'), true)) {
    $protocol = 'HTTP/1.0';
}

// Set the status code for crawlers like googlebot...
header("$protocol 503 Service Unavailable", true, 503);
header('Content-Type: text/html; charset=utf-8');
header('Retry-After: ' . $time_to_wait);
?>

<!doctype html>
<html lang="en">
<head>
    <title><?php echo $site_title . ' - ' . $translations[$lang]['title']; ?></title>
    <meta charset="utf-8">
    <meta name="robots" content="noindex">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        html body {
            text-align: center;
            padding: 20px;
            font: 20px Helvetica, sans-serif;
            color: #333;
            background-color: #ffffff;
        }
        @media (min-width: 768px) {
            html body {
                padding-top: 150px;
            }
        }
        h1 {
            font-size: 50px;
        }
        article {
            display: block;
            text-align: left;
            max-width: 650px;
            margin: 0 auto;
        }
        body a {
            color: #dc8100;
            text-decoration: none;
        }
        body a:hover {
            color: #333;
            text-decoration: none;
        }
        @media (prefers-color-scheme: dark) {
            html body {
                color: #efe8e8;
                background-color: #2e2929;
            }
            body a {
                color: #dc8100;
            }
            body a:hover {
                color: #efe8e8;
            }
        }
    </style>
</head>
<body>
<article>
    <h1><?php echo htmlspecialchars($translations[$lang]['heading'], ENT_QUOTES, 'UTF-8'); ?></h1>
    <div>
        <p><?php echo $translations[$lang]['text']; ?></p>
        <p><?php echo $translations[$lang]['team']; ?></p>
    </div>
    <div style="display: flex; flex-direction: row; justify-content: space-between;">
        <p class="day"></p>
        <p class="hour"></p>
        <p class="minute"></p>
        <p class="second"></p>
    </div>
    <div class="pyro">

    </div>
</article>

<script>
    const stringDate = new Date(Date.now() + <?php echo $time_to_wait ?> * 1000).toLocaleString();
    const countDay = new Date(stringDate); //format: MM/DD/YYYY HH:MM:SS
    const countDown = () => {
            const now = new Date();
            const counter = countDay - now;
            const second = 1000;
            const minute = second * 60;
            const hour = minute * 60;
            const day = hour * 24;
            const textDay = Math.floor(counter / day);
            const textHour = Math.floor((counter % day) / hour);
            const textMinute = Math.floor((counter % hour) / minute);
            const textSecond = Math.floor((counter % minute) / second);

            if (textSecond < 0) {
              theDay = 0;
              theHour = 0;
              theMinute = 0;
              theSecond = 0;

              window.location.reload();
            } else {
              theDay = textDay;
              theHour = textHour;
              theMinute = textMinute;
              theSecond = textSecond;
            }
            document.querySelector(".day").innerText = theDay + ' Days';
            document.querySelector(".hour").innerText = theHour + ' Hours';
            document.querySelector(".minute").innerText = theMinute + ' Minutes';
            document.querySelector(".second").innerText = theSecond + ' Seconds';
        }
        countDown();
        setInterval(countDown, 1000);
</script>
</body>
</html>
