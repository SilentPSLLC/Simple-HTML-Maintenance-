// pages/maintenance.js
import { useEffect, useState } from 'react';

// Translations object
const translations = {
  en: {
    title: 'Site Maintenance',
    heading: "We'll be back soon!",
    text: 'We\'re just sprucing things up a bit! In the meantime, feel free to <a href="{contact_link}">join us on Discord</a> for a chat or to get any assistance you need. We\'ll be up and running in just a moment, and the page will automatically refresh at the end of the countdown below.',
    team: '— The Team',
    day: 'Days',
    hour: 'Hours',
    minute: 'Minutes',
    second: 'Seconds',
  },
  ar: {
    title: 'صيانة الموقع',
    heading: 'سنعود قريبا!',
    text: 'نحن نعمل على تحسين الموقع لك! في هذه الأثناء، لا تتردد في <a href="{contact_link}">الانضمام إلينا على ديسكورد</a> للدردشة أو للحصول على المساعدة التي تحتاجها. سنعود للعمل في لحظات قليلة، وسيتم تحديث الصفحة تلقائياً عند انتهاء العد التنازلي أدناه.',
    team: '— فريق العمل',
    day: 'أيام',
    hour: 'ساعات',
    minute: 'دقائق',
    second: 'ثواني',
  },
  fr: {
    title: 'Maintenance du site',
    heading: 'Nous reviendrons bientôt!',
    text: 'Nous apportons juste quelques améliorations! En attendant, n\'hésitez pas à <a href="{contact_link}">nous rejoindre sur Discord</a> pour discuter ou obtenir l\'aide dont vous avez besoin. Nous serons de retour en un instant, et la page se rafraîchira automatiquement à la fin du compte à rebours ci-dessous.',
    team: '— L\'équipe',
    day: 'Jours',
    hour: 'Heures',
    minute: 'Minutes',
    second: 'Secondes',
  },
  de: {
    title: 'Wartung der Website',
    heading: 'Wir sind bald zurück!',
    text: 'Wir verbessern gerade ein paar Dinge für dich! In der Zwischenzeit kannst du dich gerne <a href="{contact_link}">uns auf Discord anschließen</a>, um zu chatten oder um die Hilfe zu erhalten, die du benötigst. Wir sind in Kürze wieder da, und die Seite wird am Ende des Countdowns unten automatisch aktualisiert.',
    team: '— Das Team',
    day: 'Tage',
    hour: 'Stunden',
    minute: 'Minuten',
    second: 'Sekunden',
  },
  es: {
    title: 'Mantenimiento del sitio',
    heading: '¡Volveremos pronto!',
    text: '¡Estamos mejorando algunas cosas para ti! Mientras tanto, siéntete libre de <a href="{contact_link}">unirte a nosotros en Discord</a> para charlar o para obtener la asistencia que necesitas. Estaremos operativos en un instante, y la página se recargará automáticamente al final de la cuenta regresiva a continuación.',
    team: '— El equipo',
    day: 'Días',
    hour: 'Horas',
    minute: 'Minutos',
    second: 'Segundos',
  },
  zh: {
    title: '网站维护',
    heading: '我们很快就会回来！',
    text: '我们正在为您改善一些事物！同时，欢迎您<a href="{contact_link}">加入我们的Discord</a>进行交流或获取您所需的帮助。我们将很快恢复运行，页面将在下方倒计时结束时自动刷新。',
    team: '— 团队',
    day: '天',
    hour: '小时',
    minute: '分钟',
    second: '秒',
  },
  pt: {
    title: 'Manutenção do Site',
    heading: 'Voltaremos em breve!',
    text: 'Estamos aprimorando algumas coisas para você! Enquanto isso, sinta-se à vontade para <a href="{contact_link}">se juntar a nós no Discord</a> para conversar ou obter a ajuda que precisa. Estaremos de volta num piscar de olhos, e a página será recarregada automaticamente ao final da contagem abaixo.',
    team: '— O time',
    day: 'Dias',
    hour: 'Horas',
    minute: 'Minutos',
    second: 'Segundos',
  },
};

const MaintenancePage = ({ lang, contactLink, timeToWait }) => {
  const [countdown, setCountdown] = useState({ days: 0, hours: 0, minutes: 0, seconds: 0 });

  useEffect(() => {
    const endDate = new Date(Date.now() + timeToWait * 1000);
    
    const updateCountdown = () => {
      const now = new Date();
      const difference = endDate - now;
      
      if (difference <= 0) {
        window.location.reload();
        return;
      }

      const seconds = Math.floor(difference / 1000) % 60;
      const minutes = Math.floor(difference / 1000 / 60) % 60;
      const hours = Math.floor(difference / 1000 / 60 / 60) % 24;
      const days = Math.floor(difference / 1000 / 60 / 60 / 24);

      setCountdown({ days, hours, minutes, seconds });
    };

    updateCountdown();
    const interval = setInterval(updateCountdown, 1000);
    return () => clearInterval(interval);
  }, [timeToWait]);

  const translation = translations[lang] || translations.en;
  const formattedText = translation.text.replace('{contact_link}', contactLink);

  return (
    <div style={{ textAlign: 'center', padding: '20px', fontSize: '20px', fontFamily: 'Helvetica, sans-serif', color: '#333', backgroundColor: '#ffffff' }}>
      <h1>{translation.heading}</h1>
      <div>
        <p dangerouslySetInnerHTML={{ __html: formattedText }} />
        <p>{translation.team}</p>
      </div>
      <div style={{ display: 'flex', justifyContent: 'space-between' }}>
        <p>{countdown.days} {translation.day}</p>
        <p>{countdown.hours} {translation.hour}</p>
        <p>{countdown.minutes} {translation.minute}</p>
        <p>{countdown.seconds} {translation.second}</p>
      </div>
    </div>
  );
};

export async function getServerSideProps(context) {
  const { req } = context;
  const timeToWait = 60; // in seconds
  const contactLink = '#'; // Change as needed

  // Get user's preferred languages from the Accept-Language header
  const languages = (req.headers['accept-language'] || '').split(',');
  let lang = 'en'; // Default language

  // Loop through user's preferred languages
  for (const language of languages) {
    const langCode = language.toLowerCase().substring(0, 2);
    if (Object.keys(translations).includes(langCode)) {
      lang = langCode;
      break;
    }
  }

  return {
    props: {
      lang,
      contactLink,
      timeToWait
    }
  };
}

export default MaintenancePage;
