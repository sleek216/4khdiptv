/**
 * BestLiveIPTV - Translation System
 * This script provides automatic translation of all page content
 */

// Complete translation data for all languages
const translations = {
    en: {
        // Navigation
        "Home": "Home",
        "Pricing": "Pricing",
        "Channels": "Channels",
        "FAQ": "FAQ",
        "Affiliate": "Affiliate",
        "Reseller": "Reseller",
        "Blog": "Blog",
        "Contact": "Contact",
        "Login": "Login",
        "Register": "Register",
        "My Profile": "My Profile",
        "Admin Panel": "Admin Panel",
        "Logout": "Logout",
        "Get Started": "Get Started",

        // Hero Section
        "Experience The": "Experience The",
        "Future": "Future",
        "of": "of",
        "Television": "Television",
        "Stream 20,000+ premium channels in stunning HD & 4K quality. Enjoy movies, sports, news, and entertainment from around the world with 99.9% uptime guarantee.": "Stream 20,000+ premium channels in stunning HD & 4K quality. Enjoy movies, sports, news, and entertainment from around the world with 99.9% uptime guarantee.",
        "20,000+ Channels": "20,000+ Channels",
        "100,000 VOD": "100,000 VOD",
        "150+ Countries": "150+ Countries",
        "Premium Sports & Entertainment": "Premium Sports & Entertainment",
        "Start Free Trial": "Start Free Trial",
        "View Pricing": "View Pricing",
        "SSL Secured": "SSL Secured",
        "100% Private": "100% Private",
        "Money Back": "Money Back",
        "4K Ultra HD": "4K Ultra HD",
        "Live Streaming": "Live Streaming",
        "Multi Device": "Multi Device",
        "Scroll to explore": "Scroll to explore",
        "Back": "Back",
        "Now Playing": "Now Playing",
        "Premium Content in 4K Ultra HD": "Premium Content in 4K Ultra HD",

        // Stats Section
        "Uptime Guarantee": "Uptime Guarantee",
        "Global Servers": "Global Servers",
        "Years in Business": "Years in Business",
        "Customer Support": "Customer Support",

        // Features Section
        "Premium Features for": "Premium Features for",
        "Premium Experience": "Premium Experience",
        "Discover why thousands of customers trust us for their entertainment needs": "Discover why thousands of customers trust us for their entertainment needs",
        "20,000+ Live Channels": "20,000+ Live Channels",
        "Access thousands of live TV channels from around the world including sports, movies, news, and entertainment.": "Access thousands of live TV channels from around the world including sports, movies, news, and entertainment.",
        "Sports": "Sports",
        "Movies": "Movies",
        "News": "News",
        "50,000+ VOD Library": "50,000+ VOD Library",
        "Enjoy our massive collection of movies and TV series on demand. New content added daily.": "Enjoy our massive collection of movies and TV series on demand. New content added daily.",
        "Series": "Series",
        "Documentaries": "Documentaries",
        "HD & 4K Quality": "HD & 4K Quality",
        "Experience crystal clear picture quality with our HD, Full HD, and 4K streaming options.": "Experience crystal clear picture quality with our HD, Full HD, and 4K streaming options.",
        "HD": "HD",
        "Full HD": "Full HD",
        "4K Ultra": "4K Ultra",
        "Multi-Device Support": "Multi-Device Support",
        "Watch on any device - Smart TV, Android, iOS, Fire Stick, MAG Box, and more.": "Watch on any device - Smart TV, Android, iOS, Fire Stick, MAG Box, and more.",
        "Smart TV": "Smart TV",
        "Mobile": "Mobile",
        "Fire Stick": "Fire Stick",
        "TV Guide (EPG)": "TV Guide (EPG)",
        "Never miss your favorite shows with our electronic program guide. Plan your viewing ahead.": "Never miss your favorite shows with our electronic program guide. Plan your viewing ahead.",
        "Schedule": "Schedule",
        "Reminders": "Reminders",
        "Listings": "Listings",
        "Anti-Freeze Technology": "Anti-Freeze Technology",
        "Our advanced anti-freeze technology ensures smooth, buffer-free streaming experience.": "Our advanced anti-freeze technology ensures smooth, buffer-free streaming experience.",
        "No Buffer": "No Buffer",
        "Smooth": "Smooth",
        "Stable": "Stable",

        // Devices Section
        "Works on": "Works on",
        "All Your Devices": "All Your Devices",
        "Stream your favorite content on any device, anywhere, anytime": "Stream your favorite content on any device, anywhere, anytime",
        "Android": "Android",
        "iOS/iPhone": "iOS/iPhone",
        "Windows PC": "Windows PC",
        "Mac": "Mac",
        "MAG Box": "MAG Box",
        "Xbox": "Xbox",

        // Pricing Section
        "Choose Your": "Choose Your",
        "Perfect Plan": "Perfect Plan",
        "Flexible pricing options to suit every need. All plans include all features.": "Flexible pricing options to suit every need. All plans include all features.",
        "1 Month": "1 Month",
        "3 Months": "3 Months",
        "6 Months": "6 Months",
        "12 Months": "12 Months",
        "Best Value": "Best Value",
        "Most Popular": "Most Popular",
        "Devices": "Devices",
        "Device": "Device",
        "20,000+ Channels & VOD": "20,000+ Channels & VOD",
        "HD & 4K Image Quality": "HD & 4K Image Quality",
        "Instant Delivery": "Instant Delivery",
        "24/7 Customer Support": "24/7 Customer Support",
        "View All Plans": "View All Plans",

        // How It Works Section
        "Get Started in": "Get Started in",
        "3 Easy Steps": "3 Easy Steps",
        "Start streaming your favorite content in just minutes": "Start streaming your favorite content in just minutes",
        "Choose Your Plan": "Choose Your Plan",
        "Select the subscription plan that best fits your needs. We offer flexible options for everyone.": "Select the subscription plan that best fits your needs. We offer flexible options for everyone.",
        "Secure Payment": "Secure Payment",
        "Complete your purchase using our secure payment gateway. We accept multiple payment methods.": "Complete your purchase using our secure payment gateway. We accept multiple payment methods.",
        "Start Watching": "Start Watching",
        "Receive your credentials instantly via email and start enjoying unlimited entertainment.": "Receive your credentials instantly via email and start enjoying unlimited entertainment.",

        // Testimonials Section
        "What Our": "What Our",
        "Customers Say": "Customers Say",
        "Join thousands of satisfied customers enjoying premium entertainment": "Join thousands of satisfied customers enjoying premium entertainment",

        // FAQ Section
        "Frequently Asked": "Frequently Asked",
        "Questions": "Questions",
        "Find answers to common questions about our service": "Find answers to common questions about our service",

        // CTA Section
        "Ready to Start Streaming?": "Ready to Start Streaming?",
        "Join thousands of satisfied customers and experience the future of television today": "Join thousands of satisfied customers and experience the future of television today",

        // Footer
        "Quick Links": "Quick Links",
        "Pricing Plans": "Pricing Plans",
        "Channel List": "Channel List",
        "Reseller Program": "Reseller Program",
        "Blog & News": "Blog & News",
        "Support": "Support",
        "How It Works": "How It Works",
        "Help Center": "Help Center",
        "Live Support": "Live Support",
        "Terms of Service": "Terms of Service",
        "Privacy Policy": "Privacy Policy",
        "Contact Us": "Contact Us",
        "Secure Payment Methods": "Secure Payment Methods",
        "All rights reserved": "All rights reserved",
        "Terms": "Terms",
        "Privacy": "Privacy",
        "Refund Policy": "Refund Policy",

        // Contact Page
        "Get in Touch": "Get in Touch",
        "Send Message": "Send Message",
        "Your Name": "Your Name",
        "Your Email": "Your Email",
        "Subject": "Subject",
        "Message": "Message",
        "Submit": "Submit",

        // Auth Pages
        "Email": "Email",
        "Password": "Password",
        "Remember me": "Remember me",
        "Forgot your password?": "Forgot your password?",
        "Already have an account?": "Already have an account?",
        "Don't have an account?": "Don't have an account?",
        "Create an account": "Create an account",
        "Sign in": "Sign in",
        "Sign up": "Sign up"
    },

    es: {
        // Navigation
        "Home": "Inicio",
        "Pricing": "Precios",
        "Channels": "Canales",
        "FAQ": "Preguntas",
        "Affiliate": "Afiliados",
        "Reseller": "Revendedor",
        "Blog": "Blog",
        "Contact": "Contacto",
        "Login": "Acceso",
        "Register": "Registro",
        "My Profile": "Mi Perfil",
        "Admin Panel": "Panel Admin",
        "Logout": "Salir",
        "Get Started": "Comenzar",

        // Hero Section
        "Experience The": "Experimenta El",
        "Future": "Futuro",
        "of": "de la",
        "Television": "Televisión",
        "Stream 20,000+ premium channels in stunning HD & 4K quality. Enjoy movies, sports, news, and entertainment from around the world with 99.9% uptime guarantee.": "Transmite más de 20,000 canales premium en impresionante calidad HD y 4K. Disfruta de películas, deportes, noticias y entretenimiento de todo el mundo con 99.9% de disponibilidad.",
        "20,000+ Channels": "20,000+ Canales",
        "100,000 VOD": "100,000 VOD",
        "150+ Countries": "150+ Países",
        "Premium Sports & Entertainment": "Deportes y Entretenimiento Premium",
        "Start Free Trial": "Prueba Gratis",
        "View Pricing": "Ver Precios",
        "SSL Secured": "SSL Seguro",
        "100% Private": "100% Privado",
        "Money Back": "Devolución",
        "4K Ultra HD": "4K Ultra HD",
        "Live Streaming": "En Vivo",
        "Multi Device": "Multi Dispositivo",
        "Scroll to explore": "Desplázate para explorar",
        "Back": "Atrás",
        "Now Playing": "Reproduciendo",
        "Premium Content in 4K Ultra HD": "Contenido Premium en 4K Ultra HD",

        // Stats Section
        "Uptime Guarantee": "Garantía de Disponibilidad",
        "Global Servers": "Servidores Globales",
        "Years in Business": "Años en el Negocio",
        "Customer Support": "Soporte al Cliente",

        // Features Section
        "Premium Features for": "Características Premium para",
        "Premium Experience": "Experiencia Premium",
        "Discover why thousands of customers trust us for their entertainment needs": "Descubre por qué miles de clientes confían en nosotros para su entretenimiento",
        "20,000+ Live Channels": "20,000+ Canales en Vivo",
        "Access thousands of live TV channels from around the world including sports, movies, news, and entertainment.": "Accede a miles de canales de TV en vivo de todo el mundo incluyendo deportes, películas, noticias y entretenimiento.",
        "Sports": "Deportes",
        "Movies": "Películas",
        "News": "Noticias",
        "50,000+ VOD Library": "Biblioteca VOD 50,000+",
        "Enjoy our massive collection of movies and TV series on demand. New content added daily.": "Disfruta de nuestra enorme colección de películas y series bajo demanda. Nuevo contenido agregado diariamente.",
        "Series": "Series",
        "Documentaries": "Documentales",
        "HD & 4K Quality": "Calidad HD y 4K",
        "Experience crystal clear picture quality with our HD, Full HD, and 4K streaming options.": "Experimenta calidad de imagen cristalina con nuestras opciones HD, Full HD y 4K.",
        "HD": "HD",
        "Full HD": "Full HD",
        "4K Ultra": "4K Ultra",
        "Multi-Device Support": "Soporte Multi-Dispositivo",
        "Watch on any device - Smart TV, Android, iOS, Fire Stick, MAG Box, and more.": "Mira en cualquier dispositivo - Smart TV, Android, iOS, Fire Stick, MAG Box y más.",
        "Smart TV": "Smart TV",
        "Mobile": "Móvil",
        "Fire Stick": "Fire Stick",
        "TV Guide (EPG)": "Guía de TV (EPG)",
        "Never miss your favorite shows with our electronic program guide. Plan your viewing ahead.": "Nunca te pierdas tus programas favoritos con nuestra guía electrónica. Planifica tu visualización.",
        "Schedule": "Horario",
        "Reminders": "Recordatorios",
        "Listings": "Listados",
        "Anti-Freeze Technology": "Tecnología Anti-Congelamiento",
        "Our advanced anti-freeze technology ensures smooth, buffer-free streaming experience.": "Nuestra tecnología avanzada garantiza una experiencia de streaming fluida y sin interrupciones.",
        "No Buffer": "Sin Buffer",
        "Smooth": "Fluido",
        "Stable": "Estable",

        // Devices Section
        "Works on": "Funciona en",
        "All Your Devices": "Todos Tus Dispositivos",
        "Stream your favorite content on any device, anywhere, anytime": "Transmite tu contenido favorito en cualquier dispositivo, donde sea, cuando sea",
        "Android": "Android",
        "iOS/iPhone": "iOS/iPhone",
        "Windows PC": "Windows PC",
        "Mac": "Mac",
        "MAG Box": "MAG Box",
        "Xbox": "Xbox",

        // Pricing Section
        "Choose Your": "Elige Tu",
        "Perfect Plan": "Plan Perfecto",
        "Flexible pricing options to suit every need. All plans include all features.": "Opciones de precios flexibles para cada necesidad. Todos los planes incluyen todas las características.",
        "1 Month": "1 Mes",
        "3 Months": "3 Meses",
        "6 Months": "6 Meses",
        "12 Months": "12 Meses",
        "Best Value": "Mejor Valor",
        "Most Popular": "Más Popular",
        "Devices": "Dispositivos",
        "Device": "Dispositivo",
        "20,000+ Channels & VOD": "20,000+ Canales y VOD",
        "HD & 4K Image Quality": "Calidad de Imagen HD y 4K",
        "Instant Delivery": "Entrega Instantánea",
        "24/7 Customer Support": "Soporte 24/7",
        "View All Plans": "Ver Todos los Planes",

        // How It Works Section
        "Get Started in": "Comienza en",
        "3 Easy Steps": "3 Pasos Fáciles",
        "Start streaming your favorite content in just minutes": "Comienza a transmitir tu contenido favorito en minutos",
        "Choose Your Plan": "Elige Tu Plan",
        "Select the subscription plan that best fits your needs. We offer flexible options for everyone.": "Selecciona el plan que mejor se adapte a tus necesidades. Ofrecemos opciones flexibles para todos.",
        "Secure Payment": "Pago Seguro",
        "Complete your purchase using our secure payment gateway. We accept multiple payment methods.": "Completa tu compra usando nuestra pasarela de pago segura. Aceptamos múltiples métodos de pago.",
        "Start Watching": "Comienza a Ver",
        "Receive your credentials instantly via email and start enjoying unlimited entertainment.": "Recibe tus credenciales al instante por email y empieza a disfrutar de entretenimiento ilimitado.",

        // Testimonials Section
        "What Our": "Lo Que Dicen",
        "Customers Say": "Nuestros Clientes",
        "Join thousands of satisfied customers enjoying premium entertainment": "Únete a miles de clientes satisfechos disfrutando entretenimiento premium",

        // FAQ Section
        "Frequently Asked": "Preguntas",
        "Questions": "Frecuentes",
        "Find answers to common questions about our service": "Encuentra respuestas a preguntas comunes sobre nuestro servicio",

        // CTA Section
        "Ready to Start Streaming?": "¿Listo para Empezar?",
        "Join thousands of satisfied customers and experience the future of television today": "Únete a miles de clientes satisfechos y experimenta el futuro de la televisión hoy",

        // Footer
        "Quick Links": "Enlaces Rápidos",
        "Pricing Plans": "Planes de Precios",
        "Channel List": "Lista de Canales",
        "Reseller Program": "Programa Revendedor",
        "Blog & News": "Blog y Noticias",
        "Support": "Soporte",
        "How It Works": "Cómo Funciona",
        "Help Center": "Centro de Ayuda",
        "Live Support": "Soporte en Vivo",
        "Terms of Service": "Términos de Servicio",
        "Privacy Policy": "Política de Privacidad",
        "Contact Us": "Contáctanos",
        "Secure Payment Methods": "Métodos de Pago Seguros",
        "All rights reserved": "Todos los derechos reservados",
        "Terms": "Términos",
        "Privacy": "Privacidad",
        "Refund Policy": "Política de Reembolso",

        // Contact Page
        "Get in Touch": "Contáctanos",
        "Send Message": "Enviar Mensaje",
        "Your Name": "Tu Nombre",
        "Your Email": "Tu Email",
        "Subject": "Asunto",
        "Message": "Mensaje",
        "Submit": "Enviar",

        // Auth Pages
        "Email": "Correo Electrónico",
        "Password": "Contraseña",
        "Remember me": "Recordarme",
        "Forgot your password?": "¿Olvidaste tu contraseña?",
        "Already have an account?": "¿Ya tienes cuenta?",
        "Don't have an account?": "¿No tienes cuenta?",
        "Create an account": "Crear cuenta",
        "Sign in": "Iniciar sesión",
        "Sign up": "Registrarse"
    },

    fr: {
        // Navigation
        "Home": "Accueil",
        "Pricing": "Tarifs",
        "Channels": "Chaînes",
        "FAQ": "FAQ",
        "Affiliate": "Affiliation",
        "Reseller": "Revendeur",
        "Blog": "Blog",
        "Contact": "Contact",
        "Login": "Connexion",
        "Register": "S'inscrire",
        "My Profile": "Mon Profil",
        "Admin Panel": "Panneau Admin",
        "Logout": "Déconnexion",
        "Get Started": "Commencer",

        // Hero Section
        "Experience The": "Découvrez Le",
        "Future": "Futur",
        "of": "de la",
        "Television": "Télévision",
        "Stream 20,000+ premium channels in stunning HD & 4K quality. Enjoy movies, sports, news, and entertainment from around the world with 99.9% uptime guarantee.": "Diffusez plus de 20 000 chaînes premium en qualité HD et 4K époustouflante. Profitez de films, sports, actualités et divertissements du monde entier avec 99,9% de disponibilité.",
        "20,000+ Channels": "20 000+ Chaînes",
        "100,000 VOD": "100 000 VOD",
        "150+ Countries": "150+ Pays",
        "Premium Sports & Entertainment": "Sports et Divertissement Premium",
        "Start Free Trial": "Essai Gratuit",
        "View Pricing": "Voir les Prix",
        "SSL Secured": "SSL Sécurisé",
        "100% Private": "100% Privé",
        "Money Back": "Remboursement",
        "4K Ultra HD": "4K Ultra HD",
        "Live Streaming": "Direct",
        "Multi Device": "Multi Appareils",
        "Scroll to explore": "Défiler pour explorer",
        "Back": "Retour",
        "Now Playing": "En Lecture",
        "Premium Content in 4K Ultra HD": "Contenu Premium en 4K Ultra HD",

        // Stats Section
        "Uptime Guarantee": "Garantie de Disponibilité",
        "Global Servers": "Serveurs Mondiaux",
        "Years in Business": "Années d'Expérience",
        "Customer Support": "Support Client",

        // Features Section
        "Premium Features for": "Fonctionnalités Premium pour une",
        "Premium Experience": "Expérience Premium",
        "Discover why thousands of customers trust us for their entertainment needs": "Découvrez pourquoi des milliers de clients nous font confiance pour leurs besoins en divertissement",
        "20,000+ Live Channels": "20 000+ Chaînes en Direct",
        "Access thousands of live TV channels from around the world including sports, movies, news, and entertainment.": "Accédez à des milliers de chaînes TV en direct du monde entier incluant sport, films, actualités et divertissement.",
        "Sports": "Sport",
        "Movies": "Films",
        "News": "Actualités",
        "50,000+ VOD Library": "Bibliothèque VOD 50 000+",
        "Enjoy our massive collection of movies and TV series on demand. New content added daily.": "Profitez de notre immense collection de films et séries à la demande. Nouveau contenu ajouté quotidiennement.",
        "Series": "Séries",
        "Documentaries": "Documentaires",
        "HD & 4K Quality": "Qualité HD et 4K",
        "Experience crystal clear picture quality with our HD, Full HD, and 4K streaming options.": "Découvrez une qualité d'image cristalline avec nos options HD, Full HD et 4K.",
        "HD": "HD",
        "Full HD": "Full HD",
        "4K Ultra": "4K Ultra",
        "Multi-Device Support": "Support Multi-Appareils",
        "Watch on any device - Smart TV, Android, iOS, Fire Stick, MAG Box, and more.": "Regardez sur tout appareil - Smart TV, Android, iOS, Fire Stick, MAG Box et plus.",
        "Smart TV": "Smart TV",
        "Mobile": "Mobile",
        "Fire Stick": "Fire Stick",
        "TV Guide (EPG)": "Guide TV (EPG)",
        "Never miss your favorite shows with our electronic program guide. Plan your viewing ahead.": "Ne manquez jamais vos émissions préférées avec notre guide électronique. Planifiez vos visionnages.",
        "Schedule": "Programme",
        "Reminders": "Rappels",
        "Listings": "Listes",
        "Anti-Freeze Technology": "Technologie Anti-Gel",
        "Our advanced anti-freeze technology ensures smooth, buffer-free streaming experience.": "Notre technologie avancée garantit une expérience de streaming fluide et sans interruption.",
        "No Buffer": "Sans Buffer",
        "Smooth": "Fluide",
        "Stable": "Stable",

        // Devices Section
        "Works on": "Fonctionne sur",
        "All Your Devices": "Tous Vos Appareils",
        "Stream your favorite content on any device, anywhere, anytime": "Diffusez votre contenu préféré sur tout appareil, partout, à tout moment",
        "Android": "Android",
        "iOS/iPhone": "iOS/iPhone",
        "Windows PC": "Windows PC",
        "Mac": "Mac",
        "MAG Box": "MAG Box",
        "Xbox": "Xbox",

        // Pricing Section
        "Choose Your": "Choisissez Votre",
        "Perfect Plan": "Plan Parfait",
        "Flexible pricing options to suit every need. All plans include all features.": "Options de tarification flexibles pour chaque besoin. Tous les plans incluent toutes les fonctionnalités.",
        "1 Month": "1 Mois",
        "3 Months": "3 Mois",
        "6 Months": "6 Mois",
        "12 Months": "12 Mois",
        "Best Value": "Meilleure Offre",
        "Most Popular": "Plus Populaire",
        "Devices": "Appareils",
        "Device": "Appareil",
        "20,000+ Channels & VOD": "20 000+ Chaînes et VOD",
        "HD & 4K Image Quality": "Qualité d'Image HD et 4K",
        "Instant Delivery": "Livraison Instantanée",
        "24/7 Customer Support": "Support 24/7",
        "View All Plans": "Voir Tous les Plans",

        // How It Works Section
        "Get Started in": "Commencez en",
        "3 Easy Steps": "3 Étapes Simples",
        "Start streaming your favorite content in just minutes": "Commencez à diffuser votre contenu préféré en quelques minutes",
        "Choose Your Plan": "Choisissez Votre Plan",
        "Select the subscription plan that best fits your needs. We offer flexible options for everyone.": "Sélectionnez le plan d'abonnement qui correspond le mieux à vos besoins. Nous offrons des options flexibles.",
        "Secure Payment": "Paiement Sécurisé",
        "Complete your purchase using our secure payment gateway. We accept multiple payment methods.": "Complétez votre achat avec notre passerelle de paiement sécurisée. Nous acceptons plusieurs méthodes.",
        "Start Watching": "Commencez à Regarder",
        "Receive your credentials instantly via email and start enjoying unlimited entertainment.": "Recevez vos identifiants instantanément par email et commencez à profiter d'un divertissement illimité.",

        // Testimonials Section
        "What Our": "Ce Que Disent",
        "Customers Say": "Nos Clients",
        "Join thousands of satisfied customers enjoying premium entertainment": "Rejoignez des milliers de clients satisfaits profitant d'un divertissement premium",

        // FAQ Section
        "Frequently Asked": "Questions",
        "Questions": "Fréquentes",
        "Find answers to common questions about our service": "Trouvez des réponses aux questions courantes sur notre service",

        // CTA Section
        "Ready to Start Streaming?": "Prêt à Commencer?",
        "Join thousands of satisfied customers and experience the future of television today": "Rejoignez des milliers de clients satisfaits et découvrez le futur de la télévision aujourd'hui",

        // Footer
        "Quick Links": "Liens Rapides",
        "Pricing Plans": "Plans Tarifaires",
        "Channel List": "Liste des Chaînes",
        "Reseller Program": "Programme Revendeur",
        "Blog & News": "Blog et Actualités",
        "Support": "Support",
        "How It Works": "Comment ça Marche",
        "Help Center": "Centre d'Aide",
        "Live Support": "Support en Direct",
        "Terms of Service": "Conditions d'Utilisation",
        "Privacy Policy": "Politique de Confidentialité",
        "Contact Us": "Contactez-nous",
        "Secure Payment Methods": "Méthodes de Paiement Sécurisées",
        "All rights reserved": "Tous droits réservés",
        "Terms": "Conditions",
        "Privacy": "Confidentialité",
        "Refund Policy": "Politique de Remboursement",

        // Contact Page
        "Get in Touch": "Contactez-nous",
        "Send Message": "Envoyer un Message",
        "Your Name": "Votre Nom",
        "Your Email": "Votre Email",
        "Subject": "Sujet",
        "Message": "Message",
        "Submit": "Envoyer",

        // Auth Pages
        "Email": "Email",
        "Password": "Mot de Passe",
        "Remember me": "Se souvenir de moi",
        "Forgot your password?": "Mot de passe oublié?",
        "Already have an account?": "Déjà un compte?",
        "Don't have an account?": "Pas de compte?",
        "Create an account": "Créer un compte",
        "Sign in": "Se connecter",
        "Sign up": "S'inscrire"
    },

    de: {
        // Navigation
        "Home": "Startseite",
        "Pricing": "Preise",
        "Channels": "Kanäle",
        "FAQ": "FAQ",
        "Affiliate": "Affiliate",
        "Reseller": "Wiederverkäufer",
        "Blog": "Blog",
        "Contact": "Kontakt",
        "Login": "Anmelden",
        "Register": "Registrieren",
        "My Profile": "Mein Profil",
        "Admin Panel": "Admin-Bereich",
        "Logout": "Abmelden",
        "Get Started": "Loslegen",

        // Hero Section
        "Experience The": "Erleben Sie Die",
        "Future": "Zukunft",
        "of": "des",
        "Television": "Fernsehens",
        "Stream 20,000+ premium channels in stunning HD & 4K quality. Enjoy movies, sports, news, and entertainment from around the world with 99.9% uptime guarantee.": "Streamen Sie über 20.000 Premium-Kanäle in atemberaubender HD- und 4K-Qualität. Genießen Sie Filme, Sport, Nachrichten und Unterhaltung aus aller Welt.",
        "20,000+ Channels": "20.000+ Kanäle",
        "100,000 VOD": "100.000 VOD",
        "150+ Countries": "150+ Länder",
        "Premium Sports & Entertainment": "Premium Sport & Unterhaltung",
        "Start Free Trial": "Kostenlos Testen",
        "View Pricing": "Preise Ansehen",
        "SSL Secured": "SSL Gesichert",
        "100% Private": "100% Privat",
        "Money Back": "Geld Zurück",
        "4K Ultra HD": "4K Ultra HD",
        "Live Streaming": "Live",
        "Multi Device": "Multi Geräte",
        "Scroll to explore": "Scrollen zum Erkunden",
        "Back": "Zurück",
        "Now Playing": "Aktuelle Wiedergabe",
        "Premium Content in 4K Ultra HD": "Premium Inhalte in 4K Ultra HD",

        // Stats Section
        "Uptime Guarantee": "Verfügbarkeitsgarantie",
        "Global Servers": "Globale Server",
        "Years in Business": "Jahre Erfahrung",
        "Customer Support": "Kundenbetreuung",

        // Pricing Section
        "Choose Your": "Wählen Sie Ihren",
        "Perfect Plan": "Perfekten Plan",
        "1 Month": "1 Monat",
        "3 Months": "3 Monate",
        "6 Months": "6 Monate",
        "12 Months": "12 Monate",
        "Best Value": "Bester Wert",
        "Most Popular": "Beliebteste",

        // Footer
        "Quick Links": "Schnelllinks",
        "Support": "Support",
        "Contact Us": "Kontaktieren Sie uns",
        "All rights reserved": "Alle Rechte vorbehalten",
        "Terms": "AGB",
        "Privacy": "Datenschutz",
        "Refund Policy": "Rückerstattung"
    },

    ar: {
        // Navigation
        "Home": "الرئيسية",
        "Pricing": "الأسعار",
        "Channels": "القنوات",
        "FAQ": "الأسئلة",
        "Affiliate": "الشركاء",
        "Reseller": "الموزعين",
        "Blog": "المدونة",
        "Contact": "اتصل بنا",
        "Login": "تسجيل الدخول",
        "Register": "التسجيل",
        "My Profile": "ملفي",
        "Admin Panel": "لوحة التحكم",
        "Logout": "خروج",
        "Get Started": "ابدأ الآن",

        // Hero Section
        "Experience The": "اختبر",
        "Future": "مستقبل",
        "of": "",
        "Television": "التلفزيون",
        "20,000+ Channels": "أكثر من 20,000 قناة",
        "100,000 VOD": "100,000 فيديو",
        "150+ Countries": "أكثر من 150 دولة",
        "Premium Sports & Entertainment": "رياضة وترفيه مميز",
        "Start Free Trial": "ابدأ التجربة المجانية",
        "View Pricing": "عرض الأسعار",

        // Pricing Section
        "1 Month": "شهر واحد",
        "3 Months": "3 أشهر",
        "6 Months": "6 أشهر",
        "12 Months": "12 شهر",
        "Best Value": "أفضل قيمة",
        "Most Popular": "الأكثر شعبية",

        // Footer
        "Quick Links": "روابط سريعة",
        "Support": "الدعم",
        "Contact Us": "اتصل بنا",
        "All rights reserved": "جميع الحقوق محفوظة"
    },

    pt: {
        // Navigation
        "Home": "Início",
        "Pricing": "Preços",
        "Channels": "Canais",
        "FAQ": "Perguntas",
        "Affiliate": "Afiliados",
        "Reseller": "Revendedor",
        "Blog": "Blog",
        "Contact": "Contato",
        "Login": "Entrar",
        "Register": "Cadastrar",
        "My Profile": "Meu Perfil",
        "Admin Panel": "Painel Admin",
        "Logout": "Sair",
        "Get Started": "Começar",

        // Hero Section
        "Experience The": "Experimente O",
        "Future": "Futuro",
        "of": "da",
        "Television": "Televisão",
        "20,000+ Channels": "20.000+ Canais",
        "100,000 VOD": "100.000 VOD",
        "150+ Countries": "150+ Países",
        "Premium Sports & Entertainment": "Esportes e Entretenimento Premium",
        "Start Free Trial": "Teste Grátis",
        "View Pricing": "Ver Preços",

        // Pricing Section
        "1 Month": "1 Mês",
        "3 Months": "3 Meses",
        "6 Months": "6 Meses",
        "12 Months": "12 Meses",
        "Best Value": "Melhor Valor",
        "Most Popular": "Mais Popular",

        // Footer
        "Quick Links": "Links Rápidos",
        "Support": "Suporte",
        "Contact Us": "Fale Conosco",
        "All rights reserved": "Todos os direitos reservados"
    },

    it: {
        // Navigation
        "Home": "Home",
        "Pricing": "Prezzi",
        "Channels": "Canali",
        "FAQ": "FAQ",
        "Affiliate": "Affiliazione",
        "Reseller": "Rivenditore",
        "Blog": "Blog",
        "Contact": "Contatto",
        "Login": "Accedi",
        "Register": "Registrati",
        "My Profile": "Profilo",
        "Admin Panel": "Pannello Admin",
        "Logout": "Esci",
        "Get Started": "Inizia",

        // Hero Section  
        "Experience The": "Scopri Il",
        "Future": "Futuro",
        "of": "della",
        "Television": "Televisione",
        "20,000+ Channels": "20.000+ Canali",
        "100,000 VOD": "100.000 VOD",
        "150+ Countries": "150+ Paesi",
        "Premium Sports & Entertainment": "Sport e Intrattenimento Premium",
        "Start Free Trial": "Prova Gratuita",
        "View Pricing": "Vedi Prezzi",

        // Footer
        "Quick Links": "Link Rapidi",
        "Support": "Supporto",
        "Contact Us": "Contattaci",
        "All rights reserved": "Tutti i diritti riservati"
    },

    nl: {
        // Navigation
        "Home": "Home",
        "Pricing": "Prijzen",
        "Channels": "Kanalen",
        "FAQ": "Veelgestelde Vragen",
        "Affiliate": "Affiliate",
        "Reseller": "Wederverkoper",
        "Blog": "Blog",
        "Contact": "Contact",
        "Login": "Inloggen",
        "Register": "Registreren",
        "My Profile": "Mijn Profiel",
        "Admin Panel": "Admin Paneel",
        "Logout": "Uitloggen",
        "Get Started": "Aan de Slag",

        // Hero Section
        "Experience The": "Ervaar De",
        "Future": "Toekomst",
        "of": "van",
        "Television": "Televisie",
        "20,000+ Channels": "20.000+ Kanalen",
        "100,000 VOD": "100.000 VOD",
        "150+ Countries": "150+ Landen",
        "Start Free Trial": "Gratis Proberen",
        "View Pricing": "Prijzen Bekijken",

        // Footer
        "Quick Links": "Snelle Links",
        "Support": "Ondersteuning",
        "Contact Us": "Neem Contact Op",
        "All rights reserved": "Alle rechten voorbehouden"
    }
};

// Get current locale from cookie or default to 'en'
function getCurrentLocale() {
    // Check for Laravel session cookie or URL parameter
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('locale')) {
        return urlParams.get('locale');
    }

    // Check localStorage
    const savedLocale = localStorage.getItem('siteLocale');
    if (savedLocale && translations[savedLocale]) {
        return savedLocale;
    }

    // Get from HTML lang attribute (set by Laravel)
    const htmlLang = document.documentElement.lang;
    if (htmlLang && translations[htmlLang]) {
        return htmlLang;
    }

    return 'en';
}

// Translate a single string
function translate(text, locale = null) {
    const currentLocale = locale || getCurrentLocale();

    if (currentLocale === 'en') return text;

    const langData = translations[currentLocale];
    if (!langData) return text;

    return langData[text] || text;
}

// Translate all text nodes in the page
function translatePage() {
    const locale = getCurrentLocale();

    // Update HTML lang attribute
    document.documentElement.lang = locale;

    if (locale === 'en') return; // No need to translate if English

    const langData = translations[locale];
    if (!langData) return;

    // Create reverse lookup for faster matching
    const enStrings = Object.keys(translations.en);

    // Walk through all text nodes
    const walker = document.createTreeWalker(
        document.body,
        NodeFilter.SHOW_TEXT,
        null,
        false
    );

    const nodesToUpdate = [];
    while (walker.nextNode()) {
        const node = walker.currentNode;
        const trimmedText = node.textContent.trim();

        if (trimmedText && langData[trimmedText]) {
            nodesToUpdate.push({
                node: node,
                original: trimmedText,
                translated: langData[trimmedText]
            });
        }
    }

    // Update nodes
    nodesToUpdate.forEach(item => {
        item.node.textContent = item.node.textContent.replace(item.original, item.translated);
    });

    // Also update input placeholders
    document.querySelectorAll('input[placeholder], textarea[placeholder]').forEach(el => {
        const placeholder = el.getAttribute('placeholder');
        if (langData[placeholder]) {
            el.setAttribute('placeholder', langData[placeholder]);
        }
    });

    // Update button values
    document.querySelectorAll('button, input[type="submit"]').forEach(el => {
        const text = el.textContent?.trim() || el.value?.trim();
        if (text && langData[text]) {
            if (el.tagName === 'BUTTON') {
                // Preserve icons
                const icon = el.querySelector('i');
                if (icon) {
                    el.innerHTML = icon.outerHTML + ' ' + langData[text];
                } else {
                    el.textContent = langData[text];
                }
            } else {
                el.value = langData[text];
            }
        }
    });

    // Update title
    const titleParts = document.title.split(' - ');
    if (titleParts.length > 1) {
        document.title = titleParts.map(part => langData[part.trim()] || part).join(' - ');
    }
}

// Save locale preference
function setLocale(locale) {
    if (translations[locale]) {
        localStorage.setItem('siteLocale', locale);
        // Trigger page reload to apply Laravel session change
        window.location.href = `/lang/${locale}`;
    }
}

// Initialize translation on page load
document.addEventListener('DOMContentLoaded', function () {
    // Small delay to ensure DOM is fully loaded
    setTimeout(translatePage, 100);
});

// Export for global use
window.BestLiveIPTV = window.BestLiveIPTV || {};
window.BestLiveIPTV.translate = translate;
window.BestLiveIPTV.translatePage = translatePage;
window.BestLiveIPTV.setLocale = setLocale;
window.BestLiveIPTV.getCurrentLocale = getCurrentLocale;
