<?php

class Bee {
    // Propiedades del framework
    private string $framework = 'Bee Framework';
    private string $version = '1.0.0';
    private array $uri = [];

    // La función principal que se ejecuta al instanciar nuestra clase
    public function __construct()
    {
        $this->init();

        if (isset($_GET['uri']) && $_GET['uri'] === '/'){
            unset($_GET['uri']);
        }

        $this->filter_url();
        var_dump($this->uri);
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
        return $this->uri;
    }
}