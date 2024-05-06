<?php
class Controller_list extends Controller{

    public function action_default() { 
        $this->action_last();
    }

    public function action_last() {
        $m = Model::getModel();
        $tab = $m->getLast25();
        $res = "";
        foreach ($tab as $line) {
            $res .= '<tr><td><a href="?controller=list&action=informations&id=' . $line['id'] . '">' 
            . $line['name'] . '</td><td>' 
            . $line['category'] . '</td><td>'
            . $line['year'] . '</td><td><a href="?controller=set&action=remove&id='
            . $line['id'] .'"><img src="Content/img/remove_icon.png"class=icon/></a></td></tr>';
        }

        $data = ["infos" => $res];
        $this->render("last", $data);
    }

    public function action_informations() {
        $m = Model::getModel();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        
                if (is_numeric($id) && $id > 0) {
                $tab = $m->getNobelPrizeInformations($id);
                $res = "";
                if (is_null($tab)) {
                    $res .= "Pas de prix nobel associe a cet ID";
                } 
                else {
                    $res .= '<table>';
                    foreach ($tab as $line) {
                        $res .= '<tr>';
                        foreach ($line as $cell) {
                            if (isset($cell)) {
                                $res .= '<td>' . $cell .'</td>';
                            }
                            else {
                                $res .= '<td> ??? </td>';
                            }
                        }
                        $res .= '</tr>';
                    }
                    $res .= '</table>';
                }
            }
            $data = [
                "info" => $res,
                "id" => $id
            ];
            $this->render("informations", $data);
        }
    }
}

?>
