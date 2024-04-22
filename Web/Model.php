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

    public function getNobelPrizeInfo($n) {
        $req = $this->bd->prepare('SELECT * FROM nobels WHERE id=' . $n);
        $req->execute();
        return $req->fetchAll();
    }

    public function getCategories() {
        $req = $this->bd->prepare('SELECT * FROM categories');
        $req->execute();
        return $req->fetchAll();
    }

    public function addNobelPrize($infos) {
        $vals = '';
        foreach ($infos as $info) {
            if (is_numeric($info)) {
                $vals .= intval($info) . ', ';
            } else {
                $vals .= '\'' . $info . '\'' . ', ';
            }
        }

        $vals = rtrim($vals, ", ");

        $req = $this->bd->prepare('INSERT INTO nobels (year, category, name, birthdate, birthplace, county, motivation) VALUES (' . $vals . ')');
        $req->execute();
        return true;
    }

    // TODO : Refactor this into repeated calls to a helper/auxiliary function
    public function checkData() {
        $res = [];
        
        if (!isset($_POST["year"]) || !is_numeric($_POST["year"]) || $_POST["year"] <= 0) {  
            return false;
        } else $res["year"] = $_POST["year"];
        
        if (!isset($_POST["category"]) || $_POST["category"] == '' || ctype_space($_POST["category"])) {
            return false;
        } else $res["category"] = $_POST["category"];
        
        if (!isset($_POST["name"]) || $_POST["name"] == '' || ctype_space($_POST["name"])) {
            return false;
        } else $res["name"] = $_POST["name"];
        
        if (isset($_POST["birthdate"]) && is_numeric($_POST["birthdate"])) {
            $res["birthdate"] = $_POST["birthdate"];
        } else $res["birthdate"] = "";
  
        if (!isset($_POST["birthplace"]) || $_POST["birthplace"] == '' || ctype_space($_POST["birthplace"])) {
            $res["birthplace"] = "";
        } else $res["birthplace"] = $_POST["birthplace"];

        if (!isset($_POST["county"]) || $_POST["county"] == '' || ctype_space($_POST["county"])) {
            $res["county"] = "";
        } else $res["county"] = $_POST["county"];
        
        if (!isset($_POST["motivation"]) || $_POST["motivation"] == '' || ctype_space($_POST["motivation"])) {
            $res["motivation"] = "";
        } else $res["motivation"] = $_POST["motivation"];

        return $res;
    }

    public function removeNobelPrize($id) {
        $req = $this->bd->prepare('DELETE FROM nobels WHERE id =' . $id);
        $req->execute();
    }

    public function exists($id) {
        $req = $this->bd->prepare('SELECT id FROM nobels WHERE id=' . $id);
        $req->execute();
        $res = $req->fetch();
        var_dump($res);
        if ($res)
            return true;
        else
            return false;
    }
}
?>