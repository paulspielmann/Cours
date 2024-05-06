<?php
class Controller_set extends Controller{

    public function action_default() { 
        $this->action_form_add();
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->action_add();
        }
    }
    public function action_form_add() {
        $m = Model::getModel();
        $cat = $m->getCategories();
        $res = "";
        foreach ($cat as $c) {
            $res .= '<div><input type="radio" name="category" value="' . $c . '"/><label for="' . $c . '">' . $c . '</label></div>';
        }
        $data = [ "res" => $res];
        $this->render("form_add", $data);
    }

    public function action_add() {
        $m = Model::getModel();

        $r = $this->checkData();
        $res = $m->addNobelPrize($r);
        $data = [ "message" => $res ? "Succes" : "Echec",
                  "title" => "Ajout prix Nobel"
    ];
        $this->render("message", $data);
    }

    public function action_remove() {
        $m = Model::getModel();
        $data = [ "title" => "Suppression d'un prix Nobel"];
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            if (is_numeric($id)) {
                $res = $m->removeNobelPrize($id);
                $data["message"] = $res ? "succes" : "Echec";
            } 
            else {
                $data["message"] = "Non numeric ID";
            }
        }
        else {
            $data["message"] = "ID parameter not set";    
        }
        $this->render("message", $data);
    }

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
}

?>