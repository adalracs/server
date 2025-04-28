let currentLanguage = 'en';
const i18n = {};
const supportedLanguages = ['en', 'de', 'es', 'fr', 'it', 'pt', 'ru'];

function initializeLanguage() {
    // Detectar el idioma del navegador
    const browserLang = navigator.language.split('-')[0];
    
    // Verificar si el idioma del navegador está soportado
    if (supportedLanguages.includes(browserLang)) {
        loadLanguage(browserLang);
    } else {
        loadLanguage('en'); // Cargar inglés si el idioma no está soportado
    }
}

async function loadLanguage(lang) {
    try {
        const response = await fetch(`lang/${lang}.json`);
        if (!response.ok) {
            throw new Error('Language file not found');
        }
        i18n[lang] = await response.json();
        currentLanguage = lang;
        updateContent();
    } catch (error) {
        console.error('Error loading language file:', error);
        if (lang !== 'en') {
            console.log('Falling back to English');
            loadLanguage('en');
        }
    }
}

function updateContent() {
  document.querySelectorAll('[data-i18n]').forEach(element => {
    const keys = element.getAttribute('data-i18n').split('.');
    let value = i18n[currentLanguage];
    for (const key of keys) {
      if (value) { // Agregar esta comprobación
        value = value[key];
      } else {
        console.warn(`Translation not found for ${element.getAttribute('data-i18n')}`);
        break; // Salir del bucle si no se encuentra la clave
      }
    }
    if (value) {
      element.textContent = value;
    }
  });
  document.documentElement.lang = currentLanguage;
}


