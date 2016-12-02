
        <?php

class  Dispatcher {
    
    var $request;

    function __construct() {
        $this->request= new Request();
        $this->request->url;
        Router::parse($this->request->url, $this->request);
        $controller= $this->loadControler(); //charger 
        if(!in_array($this->request->action, get_class_methods($controller))){
            $this->error('Le controlleur '.$this->request->controller.' n\'a pas de methode : '.$this->request->action);
        }; 
        call_user_func_array(array( $controller, $this->request->action), $this->request->params);
        $controller->render($this->request->action);
       
       }
        function error($message) {
            header('HTTP/1.0 404 not found');
        $controller= new Controller($this->request);
        $controller->set('message', $message);
        $controller->render('/errors/404');
                
                
        die();
        
    } 
    /**
     * permet de charger automatiquement un controller
     * @return $name  nom du controller
     */
    function loadControler() {
        $name= ucfirst($this->request->controller).'Controller';
        $file=root.DIRECTORY_SEPARATOR.'controller'.DIRECTORY_SEPARATOR.$name.'.php';
        require $file;
        return new $name($this->request);
    }

} 


