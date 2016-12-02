 <?php
class Request {
    public $url; //url appelé par l'utilisateur

    function __construct() {
        //on a contourner le probleme de $_SERVER['PATH_INFO']; qui n existe pas
        $req=$_SERVER['REQUEST_URI'];
        $req= str_replace(base_url,"",$req); // remplace la valeur de base_url par "" dans $req
        $this->url =$req;
    }

}
