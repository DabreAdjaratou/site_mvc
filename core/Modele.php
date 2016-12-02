<?php

class Modele {
    
    static $connections= array();
 public $db='default';
 
    public function __construct() {
       
        $conf=Conf::$databases[$this->db];
        
       if(isset(Modele::$connections[$this->db])){
           return true;
       }
       try {
            $pdo= new PDO('mysql:host='.$conf['host'].';dbname='.$conf['database'].'',''.$conf['login'].'',''.$conf['password']);
            
            Modele::$connections[$this->db]= $pdo;
       } catch (Exception $exc) {
           if(Conf::$debug >=1 ){
           echo $exc->getMessage();
       } else {
           die('Impossible de se connecter a la base de données');
       }
    }
    echo 'j \'ai deja charger' ;
       }
    
    public function find($param) {
        
    }
    }

