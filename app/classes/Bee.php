<?php

class Bee {
    // Propiedades del framework
    private string $framework = 'Bee Framework';
    private string $version = '1.0.0';
    private array $uri = [];

    // La función principal que se ejecuta al instanciar nuestra clase
    public function __construct()
    {
        if (isset($_GET['uri']) && $_GET['uri'] === '/'){
            unset($_GET['uri']);
        }
        $this->init();
    }

    /**
     * Método para ejecutar cada "método" de forma subsecuente
     */
    private function init(): void
    {
        $this->init_session();
        $this->init_load_config();
        $this->init_load_functions();
        $this->init_autoload();
        $this->dispatch();
    }

    /**
     * Método para iniciar la sesión en el sistema
     */
    private function init_session(): void
    {
        if (!session_start()) session_start();
    }

    /*
     * Método para cargar la configuración del sistema
     */
    private function init_load_config(): void
    {
        $file = 'bee_config.php';
        if (!is_file('app/config/' . $file)){
            die(sprintf('El archivo %s no se encuentra, es requerido para %s funcione', $file, $this->framework));
        }
        require_once 'app/config/' . $file;
    }

    /**
     * Métodos para cargar las funciones del sistema y del usuario
     */
    private function init_load_functions(): void
    {
        $file = 'bee_core_functions.php';
        if (!is_file(FUNCTIONS . $file)){
            die(sprintf('El archivo %s no se encuentra, es requerido para %s funcione', $file, $this->framework));
        }
        require_once FUNCTIONS . $file;

        $file = 'bee_custom_functions.php';
        if (!is_file(FUNCTIONS . $file)){
            die(sprintf('El archivo %s no se encuentra, es requerido para %s funcione', $file, $this->framework));
        }
        require_once FUNCTIONS . $file;
    }

    /*
     * Método para cargar todos los archivos de forma automática
     */
    private function init_autoload(): void
    {
        require_once CLASSES.'Db.php';
        require_once CLASSES.'Model.php';
        require_once CLASSES.'Controller.php';
        require_once CONTROLLERS.DEFAULT_CONTROLLER.'Controller.php';
        require_once CONTROLLERS.DEFAULT_ERROR_CONTROLLER.'Controller.php';
    }

    /**
     * Método para filtrar y descomponer los elementos de nuestra url y uri
     */
    private function filter_url(): array
    {
        if (isset($_GET['uri'])){
            $_GET['uri'] = trim($_GET['uri'], '/');
            $_GET['uri'] = filter_var($_GET['uri'], FILTER_SANITIZE_URL);
            $this->uri = explode('/', strtolower($_GET['uri']));
        }
        // var_dump($this->uri);
        return $this->uri;
    }

    /**
     * Método para ejecutar y cargar de forma automática el controlador solicitado por el usuario
     */
    private function dispatch()
    {
        // Filtrar la URL y separar la URI
        $this->filter_url();

        ///////////////////////////////////////////////////////////////
        /// Obtenemos el controlador, que viene en el primer
        ///  segmento de la uri,
        ///  si no existe cargamos el default.
        ///////////////////////////////////////////////////////////////
        if (isset($this->uri[0])){
            $current_controller = $this->uri[0];
            unset($this->uri[0]);
        } else {
            $current_controller = DEFAULT_CONTROLLER;
        }

        // Le añadimos el sufijo 'Controller' y comprobamos si existe la clase.
        // Si no existe, lanzamos el errorController.
        $controller = $current_controller . 'Controller';
        if (!class_exists($controller)){
            $controller = DEFAULT_ERROR_CONTROLLER.'Controller';
        }

        ///////////////////////////////////////////////////////////////
        /// Ejecución del método solicitado
        ///////////////////////////////////////////////////////////////
        if (isset($this->uri[1])){
            $method = str_replace('-', '_', $this->uri[1]);

            // Validamos si existe el método en la clase
            if (!method_exists($controller, $method)){
                $controller = DEFAULT_ERROR_CONTROLLER . 'Controller';
                $current_method = DEFAULT_METHOD;
            } else {
                $current_method = $method;
            }
            unset($this->uri[1]);
        } else {
            $current_method = DEFAULT_METHOD;
        }
        var_dump($current_method);

    }
}