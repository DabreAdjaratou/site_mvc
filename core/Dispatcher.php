
<?php

class Dispatcher {

    var $request;

    function __construct() {
        $this->request = new Request();
        $this->request->url;
        Router::parse($this->request->url, $this->request);
        $controller = $this->loadControler(); //charger 
        if (!in_array($this->request->action, get_class_methods($controller))) {
            $this->error('Le controlleur ' . $this->request->controller . ' n\'a pas de methode : ' . $this->request->action);
        };
        call_user_func_array(array($controller, $this->request->action), $this->request->params);
        $controller->render($this->request->action);
    }

    /**
     * permet de gerer les erreurs au niveau du routing (page inexistante)
     * @param type $message
     */
    function error($message) {
        $controller = new Controller($this->request);
        $controller->e404($message);
    }

    /**
     * permet de charger automatiquement un controller
     * @return $name  nom du controller
     */
    function loadControler() {
        $name = ucfirst($this->request->controller) . 'Controller';
        $file = root . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . $name . '.php';
        require $file;
        return new $name($this->request);
    }

}
