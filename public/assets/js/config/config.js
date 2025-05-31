/**
 * Webeetools Configuration
 */

export const CONFIG = {
    // Site Information
    site: {
        name: 'Webeetools',
        url: 'https://webeetools.com',
        description: 'Sua caixa de ferramentas completa para desenvolvimento web',
        author: 'Douglas Soares',
        version: '2.0.0'
    },

    // API Configuration
    api: {
        baseUrl: '/api',
        timeout: 10000,
        retries: 3
    },

    // Feature Flags
    features: {
        audioPlayer: true,
        darkMode: true,
        tutorials: true,
        analytics: false,
        serviceWorker: true
    },

    // Audio Configuration
    audio: {
        defaultVolume: 0.5,
        fadeInDuration: 2000,
        fadeOutDuration: 1000,
        sources: [
            'https://stream.zeno.fm/f3eaqezcv7zuv',
            'https://relay.publicdomainproject.org/chillout_lounge.m3u',
            'https://streams.radio.co/se8cb38047/listen'
        ]
    },

    // Animation Configuration
    animations: {
        duration: {
            fast: 150,
            normal: 300,
            slow: 500
        },
        easing: 'ease',
        reducedMotion: false
    },

    // Storage Keys
    storage: {
        theme: 'webeetools_theme',
        audioSettings: 'webeetools_audio',
        userPreferences: 'webeetools_preferences',
        tutorialProgress: 'webeetools_tutorial_progress'
    },

    // UI Configuration
    ui: {
        breakpoints: {
            sm: '640px',
            md: '768px',
            lg: '1024px',
            xl: '1280px',
            '2xl': '1536px'
        },
        debounceDelay: 300,
        scrollOffset: 80
    },

    // Social Links
    social: {
        github: 'https://github.com/8ito4',
        linkedin: 'https://www.linkedin.com/in/douglas-soares-204084235/',
        email: 'contact@webeetools.com'
    },

    // SEO Configuration
    seo: {
        defaultTitle: 'Webeetools - Ferramentas para Desenvolvedores',
        titleSeparator: ' - ',
        defaultDescription: 'Sua caixa de ferramentas completa para desenvolvimento web. Todas as ferramentas que você precisa, 100% gratuitas e sem coleta de dados.',
        defaultKeywords: 'ferramentas, desenvolvimento, web, json, password, whatsapp, tutoriais, programação',
        ogImage: '/assets/images/og-image.png',
        twitterCard: 'summary_large_image'
    },

    // Performance Configuration
    performance: {
        lazyLoadImages: true,
        prefetchLinks: true,
        cacheTimeout: 3600000, // 1 hour
        compressionLevel: 9
    },

    // Error Messages
    messages: {
        errors: {
            generic: 'Ops! Algo deu errado. Tente novamente.',
            network: 'Erro de conexão. Verifique sua internet.',
            notFound: 'Página não encontrada.',
            timeout: 'A operação demorou muito para responder.',
            validation: 'Por favor, verifique os dados inseridos.'
        },
        success: {
            copied: 'Copiado para a área de transferência!',
            saved: 'Dados salvos com sucesso!',
            updated: 'Atualizado com sucesso!',
            sent: 'Enviado com sucesso!'
        },
        info: {
            loading: 'Carregando...',
            processing: 'Processando...',
            saving: 'Salvando...',
            updating: 'Atualizando...'
        }
    },

    // Development Configuration
    development: {
        debug: false,
        verbose: false,
        showPerformanceMetrics: true,
        enableHotReload: false
    }
};

// Environment detection
export const ENV = {
    isDevelopment: window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1',
    isProduction: window.location.hostname === 'webeetools.com',
    isStaging: window.location.hostname.includes('staging'),
    isMobile: /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent),
    isTablet: /iPad|Android/i.test(navigator.userAgent) && !/Mobile/i.test(navigator.userAgent),
    isDesktop: !(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)),
    supportsWebP: (function() {
        const canvas = document.createElement('canvas');
        return canvas.toDataURL('image/webp').indexOf('webp') > -1;
    })(),
    supportsServiceWorker: 'serviceWorker' in navigator,
    supportsLocalStorage: (function() {
        try {
            const test = '__localStorage_test__';
            localStorage.setItem(test, test);
            localStorage.removeItem(test);
            return true;
        } catch (e) {
            return false;
        }
    })()
};

// Feature detection and configuration updates
export function initializeConfig() {
    // Update config based on environment
    if (ENV.isDevelopment) {
        CONFIG.development.debug = true;
        CONFIG.development.verbose = true;
    }

    // Disable animations if user prefers reduced motion
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        CONFIG.animations.reducedMotion = true;
        CONFIG.animations.duration.fast = 0;
        CONFIG.animations.duration.normal = 0;
        CONFIG.animations.duration.slow = 0;
    }

    // Disable service worker if not supported
    if (!ENV.supportsServiceWorker) {
        CONFIG.features.serviceWorker = false;
    }

    // Log configuration in development
    if (CONFIG.development.debug) {
        console.group('🔧 Webeetools Configuration');
        console.log('Environment:', ENV);
        console.log('Config:', CONFIG);
        console.groupEnd();
    }
}

// Export default configuration
export default CONFIG; 