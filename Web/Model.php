<?php

class Model {
    private $bd;
    private static $instance = null;

    private function __construct() {
        $this->bd = new PDO('pgsql:host=aquabdd;dbname=etudiants', '12316971', '081289083CB');
        $this->bd->query("SET NAMES 'utf-8'");
        $this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getModel() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getTotal() {
        $req = $this->bd->prepare('SELECT count(*) FROM nobels');
        $req->execute();
        $tab = $req->fetch(PDO::FETCH_ASSOC);
        return $tab['count'];
    }

    public function getLast($amount) {
        $req = $this->bd->prepare('SELECT * FROM nobels ORDER BY year DESC LIMIT ' . $amount);
        $req->execute();
        return $req->fetchAll();
    }
}

?>