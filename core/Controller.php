<?php

class Controller {

    public $request; //objet request
    private $vars = array(); //variable a passer a al vue
    public $layout = 'default'; //layout a utiliser pou rendre la vue
    private $rendered = false; // si le rendu a ete fait ou pas

    /**
     * permet de recuperer l'obget request envoyer par le dispatcher depuis sa fonction loadController()
     * @param type $request objet request de notre application
     */
    function __construct($request) {
        $this->request = $request;
    }

    /**
     * permet de rendre des vues automatiquement
     * @param string $view fichier view a rendre (chemin depuis vue ou nom de la vue )
     */
    public function render($view) {
        if ($this->rendered) {
            return false;
        } //verifie si la vue a deja ete rendu
        extract($this->vars); // extraire les variables contenu dans un tableau pour qu ils soint accessible dabs la vue
        if (strpos($view, '/') === 0) {
            $view = root . DIRECTORY_SEPARATOR . 'vue' . DIRECTORY_SEPARATOR . $view . '.php';
        } else {
            $view = root.DIRECTORY_SEPARATOR.'vue'.DIRECTORY_SEPARATOR.$this->request->controller.DIRECTORY_SEPARATOR.$view.'.php';
        }

        ob_start();
        require ($view);
        $content_for_layout = ob_get_clean();
        require root . DIRECTORY_SEPARATOR . 'vue' . DIRECTORY_SEPARATOR . 'layout' . DIRECTORY_SEPARATOR . $this->layout . '.php';
//      die($view); //affiche le contenu de $view
        $this->rendered = true;
    }

    /**
     * permet de passer une ou plusieurs variables a la vue 
     * @param type $key nom de la variable ou tableau des cariables
     * @param type $value valeur de la variable
     */
    public function set($key, $value = null) {
        if (is_array($key)) {
            $this->vars += $key;
        } else {

            $this->vars[$key] = $value;
        }
    }
    
    /**
     * permet de charger un modele
     * @param type $name nom du modele
     */
    function loadModele($name) { 
        $file= root.DIRECTORY_SEPARATOR.'modele'.DIRECTORY_SEPARATOR.$name.'.php';
        require_once $file;//inclure une seule fois
        if(!isset($this->$name)){
            $this->$name=new $name();
                    
        } //else {  echo 'pas charger'; } 
        
        }
        
        /**
         * permet de gerer les erreurs au niveau du modele
         * @param type $message
         */
        function e404($message) {
        header('HTTP/1.0 404 not found');
        $this->set('message', $message);
        $this->render('/errors/404');
            die();
        }

}
