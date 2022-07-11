<?php
 
function bsq($M, $R, $C)
{

    if ($M[0] === ""){
        echo "";
        return 0;
    }
    $S = array(array()) ;
    // transform les "o" et "." en 1 et 0
    for($i = 0; $i < $R; $i++){
        for($j = 0; $j < $C; $j++){
            if ($M[$i][$j] == "o"){
                $M[$i][$j] = 0;
            }
            elseif($M[$i][$j]== "."){
                $M[$i][$j] = 1;
            }
            // echo $M[$i][$j];
        }
        // echo "\n";
     }
 
    /* Premiere colonne de S[][]*/
    for($i = 0; $i < $R; $i++){
        $S[$i][0] = $M[$i][0];
    }

     
    /* Premire ligne de S[][]*/
    for($j = 0; $j < $C; $j++){
        $S[0][$j] = $M[0][$j];
    }

    /* Autres entrées de S[][]*/
    for($i = 1; $i < $R; $i++){
        for($j = 1; $j < $C; $j++)
        {
            if($M[$i][$j] == 1){
                $S[$i][$j] = min($S[$i][$j - 1],
                                 $S[$i - 1][$j],
                                 $S[$i - 1][$j - 1]) + 1;
            }
            else
                $S[$i][$j] = 0;
        }
    }
     
    /* Trouve l'entrée max et son index dans S[][] */
    $max_of_s = $S[0][0];
    $max_i = 0;
    $max_j = 0;
    for($i = 0; $i < $R; $i++)
    {
        for($j = 0; $j < $C; $j++)
        {
            if($max_of_s < $S[$i][$j])
            {
                $max_of_s = $S[$i][$j];
                $max_i = $i;
                $max_j = $j;
            }
        }            
    }
    //  print_r($M);
    //  for($i = 0; $i < $R; $i++){
    //     for($j = 0; $j < $C; $j++){
    //         echo $M[$i][$j];
    //     }
    //     echo "\n";
    //  }
    
    // find bsq
    // echo "max of s: ";
    // var_dump($max_of_s);
    // echo "\n";
    // echo "max of i: ";
    // var_dump($max_i);
    // echo "\n";
    for($i = $max_i;
        $i > $max_i - $max_of_s; $i--)
    {
        for($j = $max_j;
            $j > $max_j - $max_of_s; $j--)
        {
            // if ($M[$i][$j] == 0){
            //     $M[$i][$j] = "o";
            // }
            if($M[$i][$j]== 1){
                $M[$i][$j] = "x";
            }
            // echo $M[$i][$j], " " ;
        }
        // echo "\n" ;
    }
    for($i = 0; $i < $R; $i++){
        for($j = 0; $j < $C; $j++){
            if ($M[$i][$j] == 0){
                $M[$i][$j] = "o";
            }
            elseif($M[$i][$j]== 1){
                $M[$i][$j] = ".";
            }
            echo $M[$i][$j];
        }
        echo "\n";
     }
}

function get_tab($argv, $argc){

    if($argc != 2)
        echo "Besoin d'un seul argument\n";
    elseif (!is_file($argv[1]))
        echo "doit être un fichier\n";
    else{
        // echo $argv[1]."\n";
        $file = $argv[1];
        $chaine = file_get_contents($file, false, null);
        $M = explode("\n", $chaine);
        $poubelle = array_pop($M);
        $poubelle = array_shift($M);
        $poubelle = intval($poubelle, 10);
    }
    return $M;
}

$poubelle = null;
$M = get_tab($argv, $argc, $poubelle);
$R = count($M);
// echo "$R\n";
// print_r($M);

$i = 0;
$j = 0;

if (!empty($M)){
    // while ($M[$i][$j]){
    //     $j++;
    // }
    $j = strlen($M[$i]);
}
// echo "$j\n";
$C = $j ;        
if (!empty($M)){

    bsq($M, $R, $C);
}