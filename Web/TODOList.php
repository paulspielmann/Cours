<?php
class TODOList {
      private $to_dos;

      public function __construct() {
      	     $this->to_dos = [];
      }

      public function add_to_do($str) {
      	     if(!empty($str) && !ctype_space($str)) {
	     	  array_push($this->to_dos, $str);
	     }
      }

    public function remove_to_do($index) {
        unset($this->to_dos[$index]);
    }

    public function is_empty() {
      	return empty($this->to_dos);
    }

    public function get_html() {
    	if ($this->is_empty()) {
     		return "<p>Aucune tache a faire !</p>";
    }
    $res = "\n<table>\n";

    foreach ($this->to_dos as $index => $item) {
		$link = "http://localhost/~12316971/ex11.php?rm=" . $index;
		$temp = "<a href=\"". $link . "\">" . $item . "</a>";
    	$res .= "<tr><td>" . $temp  . "</td></tr>";
    }
	$res .= "\n</table>";
	    return $res;
    }

	public function get_representation() {
		return implode("///", $this->to_dos);
	}

	public function set_representation($rep) {
		$this->to_dos = explode("///", $rep);
	}
}

require 'fin_code.php';
?>