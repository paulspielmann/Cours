<?php

$title = "Mon titre";
require 'debut_code.php';
$chats = 3;
$chiens = 2;


echo "<p>J'ai $chats chats et $chiens chiens, en tout " . ($chiens + $chats) . ' animaux </p>';

$t = ['english',
    'first'=>'html', 
    2 => 'css', 
    'best'=>'php', 
    'javascript',
    5 => 'jQuery'];

$t1 = [];
$t2 = [];

foreach ($t as $k => $v) {
	$t1[] = $k;
	$t2[] = $v;
}

sort($t1);
sort($t2);

$personnes = [
  'mdupond' => ['Prénom' => 'Martin', 'Nom' => 'Dupond', 'Age' => 25, 'Ville' => 'Paris'       ],
  'jm'      => ['Prénom' => 'Jean'  , 'Nom' => 'Martin', 'Age' => 20, 'Ville' => 'Villetaneuse'],
  'toto'    => ['Prénom' => 'Tom'   , 'Nom' => 'Tonge' , 'Age' => 18, 'Ville' => 'Epinay'      ],
  'arn'     => ['Prénom' => 'Arnaud', 'Nom' => 'Dupond', 'Age' => 33, 'Ville' => 'Paris'       ],
  'email'   => ['Prénom' => 'Emilie', 'Nom' => 'Ailta' , 'Age' => 46, 'Ville' => 'Villetaneuse'],
  'dask'    => ['Prénom' => 'Damien', 'Nom' => 'Askier', 'Age' => 7 , 'Ville' => 'Villetaneuse']
];

$scores = [
  ['Joueur' => 'Camille'  , 'score' => 157 ],
  ['Joueur' => 'Guillaume', 'score' => 254 ],
  ['Joueur' => 'Julien'   , 'score' => 192 ],
  ['Joueur' => 'Nabila'   , 'score' => 317 ],
  ['Joueur' => 'Lorianne' , 'score' => 235 ],
  ['Joueur' => 'Tom'      , 'score' => 83  ],
  ['Joueur' => 'Michael'  , 'score' => 325 ],
  ['Joueur' => 'Eddy'     , 'score' => 299 ]
];

function createTr($tab) {
	 $res = "\n<tr>";
	 foreach ($tab as $val) {
		 $res .= "\n <td>$val</td>\n";
         }				
	 $res .= "\n</tr>";
	 return $res;
}

function aux($mat) {
	 $res = "<table>";

	 $res .= createTr(array_keys(array_values($mat)[0]));

	 foreach ($mat as $tab) {
	 	 $res .= createTr($tab);
	 }		

	 $res .= "\n</table>";
	 return $res;
}


$tableau = aux($scores);
echo $tableau;

$tabMagazines = [
  'le monde'              => ['frequence' => 'quotidien', 'type' => 'actualité', 'prix' => 220],
  'le point'              => ['frequence' => 'hebdo'    , 'type' => 'actualité', 'prix' => 80 ],
  'causette'              => ['frequence' => 'mensuel'  , 'type' => 'féminin'  , 'prix' => 180],
  'politis'               => ['frequence' => 'hebdo'    , 'type' => 'opinion'  , 'prix' => 100],
  'le monde diplomatique' => ['frequence' => 'mensuel'  , 'type' => 'analyse'  , 'prix' => 60 ],
  'libération'            => ['frequence' => 'quotidien', 'type' => 'actualité', 'prix' => 190],
];

$tabMagazinesAbonne = ['le monde', 'le monde diplomatique'];

function afficheQuot($mat) {
  foreach ($mat as $nom => $tab) {
    if ($tab['frequence'] == 'quotidien') {
      echo $nom . ',';
    }
  }
}

function afficheMag($mat) {
  foreach ($mat as $nom => $tab) {
    echo $nom . '(' . implode(',', $tab) . ")\n";
  }
}

echo "test";
afficheMag($tabMagazines);

$total = 0;
foreach ($tabMagazinesAbonne as $nom) {
	foreach ($tabMagazines as $x => $tab) {
		if ($x == $nom) {
		       $total += $tab['prix'];
		}	
	}
}

echo $total;

/*
	Exercice 8 
*/

$tab = [
   "J'adore le php !" => true,
   "Génial le php !!!" => false,
   "Javascript est mieux" => false,
   "J'adore le javascript" => true
];


function check_er($str, $tab) {
	 
  foreach ($tab as $key => $val) {
    if (preg_match($str, $key) != $val) {
		  echo "\n";
		  echo "ERREUR: " . $key . ($val ? " ne verifie pas " : " verifie " ) . "l'ER alors que la valeur est " . ($val ? "TRUE" : "FALSE");
		}
	}
}

$tab_num = [
     "10" => true,
     "0" => true,
     "-34539" => true,
     "--44" => false,
     "" => false,
     "123a456" => false,
     "10.2" => false
];

$tab_dec = [
     "10" => true,
     "0" => true,
     "-34539" => true,
     "--44" => false,
     "" => false,
     "123a456" => false,
     "10.2" => true,
     "0.001" => true,
     ".001" => true,
     "10." => false
];

$tab_dates = [
     "10/10/2021" => true,
     "9/9/1234" => true,
     "90/9/5476" => true,
     "8/23/0014" => true,
     "111/23/0423" => false,
     "12/12/123" => false,
     "1/11234" => false,
     "10/2" => false,
     "1a/2b/8790" => false
];

echo "\n";
check_er("/^-?[0-9]+$/", $tab_num);
check_er("/^-?[0-9]+(?(?=\.)[0-9]+|)$/", $tab_dec);
check_er("/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/", $tab_dates);

require 'fin_code.php';
?>

