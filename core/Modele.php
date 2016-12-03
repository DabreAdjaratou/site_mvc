
<?php

class Modele {

    static $connections = array();
    public $conf = 'default';
    public $table = false;
    public $db;

    public function __construct() {
        // je me connect a la base de donnee
        $conf = Conf::$databases[$this->conf];
        //verifie si on est deja connecte a la bd
        if (isset(Modele::$connections[$this->conf])) {
            $this->db = Modele::$connections[$this->conf];
            return true;
        }
        try {
            $pdo = new PDO('mysql:host=' . $conf['host'] . ';dbname=' . $conf['database'], $conf['login'], $conf['password'], array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8 ')); // L e dernier parametre va forcer MYSQL a se connecter en utf8
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); //affichage des erreurs
            Modele::$connections[$this->conf] = $pdo;
            $this->db = $pdo;
        } catch (Exception $exc) {
            if (Conf::$debug >= 1) {
                echo $exc->getMessage();
            } else {
                die('Impossible de se connecter a la base de données');
            }
        }
        //echo 'bd deja charger et je me suis connecté a la bd' 
//        die($this->table);  
    }

    /**
     * permet de retourner tous les objets contenus dans une table
     * @param type $req qui est un tableau de condition
     * @return type
     */
    public function find($req) {
        $sql = 'select * from ' . $this->table . ' ';

        //construction de la condition
        if (isset($req['conditions'])) {
            $sql .= 'where ';
            if (!is_array($req['conditions'])) {
                $sql .= 'where ' . $req['conditions'];
            } else {
                $cond=array();
                foreach ($req['conditions'] as $k =>$v ){
                if (!is_numeric($v)){
                    $v=$this->db->quote($v);   //echapper $v    des caractere particulier
                    } 
                $cond []= "$k = $v";
                }
                 $sql .= implode(' AND ', $cond);
            }
        }

//        die($sql);
        $pre = $this->db->prepare($sql);
        $pre->execute();
        return $pre->fetchAll(PDO::FETCH_OBJ);
    }

    public function findFirst($req) {

        return current($this->find($req)); // recuperer l'enregistrement courant du table
    }

}
