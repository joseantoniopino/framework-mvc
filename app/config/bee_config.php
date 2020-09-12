<?php

// Saber si estamos trabajando de forma local o remota
define('IS_LOCAL', in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1', '172.19.0.1']));

// Definir el uso horario o timezone del sistema
date_default_timezone_set('Europe/Madrid');

// Idioma
define('LANG', 'es');

// Ruta base de nuestro proyecto
define('BASEPATH', IS_LOCAL ? '/home/jose/www/bee-framework/' : '__EL BASEPATH EN PRODUCCION__');

//Salt del sistema
define('AUTH_SALT', 'BeeFramework<3');

// Puerto y URL del sitio
define('PORT', '255');
define('URL', IS_LOCAL ? 'http://127.0.0.1:' . PORT . BASEPATH : '__URL EN PRODUCCIÓN__');

// Las rutas de directorios y archivos
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', getcwd() . DS);

define('APP', ROOT . 'app' . DS);
define('CLASSES', APP . 'classes' . DS);
define('CONFIG', APP . 'config' . DS);
define('CONTROLLERS', APP . 'controllers' . DS);
define('FUNCTIONS', APP . 'functions' . DS);
define('MODELS', APP . 'models' . DS);

define('TEMPLATES', ROOT . 'templates' . DS);
define('INCLUDES', TEMPLATES . 'includes' . DS);
define('MODULES', TEMPLATES . 'views' . DS);
define('VIEWS', TEMPLATES . 'views' . DS);

// Rutas de archivos o assets con base URL
define('ASSETS', URL . 'assets/');
define('CSS', ASSETS . 'css/');
define('FAVICON', ASSETS . 'favicon/');
define('FONTS', ASSETS . 'fonts/');
define('IMAGES', ASSETS . 'images/');
define('JS', ASSETS . 'js/');
define('PLUGINS', ASSETS . 'plugins/');
define('UPLOADS', ASSETS . 'uploads/');

// Credenciales de la base de datos
// Set para conexión local o de desarrollo
define('LDB_ENGINE', 'mariadb');
define('LDB_HOST', 'localhost');
define('LDB_NAME', 'bee_db');
define('LDB_USER', 'user');
define('LDB_PASS', 'root');
define('LDB_PORT', '36000');
define('LDB_CHARSET', 'utf8');

// Set para conexión local o de desarrollo
define('DB_ENGINE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'REMOTE_DATABASE');
define('DB_USER', 'REMOTE_DATABASE');
define('DB_PASS', 'REMOTE_DATABASE');
define('DB_PORT', 'REMOTE_DATABASE');
define('DB_CHARSET', 'utf8');
