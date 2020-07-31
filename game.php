<?php
// Input data form
?>
<form method = "POST">

<div> X:<input type="text" name="x" /> </div>
<div> Y:<input type="text" name="y" /> </div>
<div> Coordinate X:<input type="text" name="cor_x" /> </div>
<div> Coordinate Y:<input type="text" name="cor_y" /> </div>
<div> N:<input type="text" name="n" /> </div>
<div> <input type="submit" name="submit"></div>

</form>

<?php
// link to the user defined functions
require_once 'functions.php';

//assigning and validating data
if($_POST){
    if(is_numeric($_POST['x']) && is_numeric($_POST['y']) && is_numeric($_POST['cor_x']) && is_numeric($_POST['cor_y']) &&
       is_numeric($_POST['n']) && $_POST['cor_x'] < $_POST['x'] && $_POST['cor_y']<$_POST['y']) {
        $x = $_POST['x'];
        $y = $_POST['y'];
        $cor_x = $_POST['cor_x'];
        $cor_y = $_POST['cor_y'];
        $n = $_POST['n'];
        $green_found = 0;
    }
    else {
        echo 'Please enter valid data';
        exit();
    }
    

    // loop for creating the 'Generation Zero' matrix
    $gen_zero = [];
    $gen_nxt = [];
    for ($row=0 ; $row<$y ; $row++) {
        $gen_zero[$row] = [];
        for ($col=0 ; $col<$x ; $col++) {
            $gen_zero[$row][$col] = rand(0,1);
        }
    }
    
    echo 'Generation 0'  . '<table  border="1">';
    
    // visualization of 'Generation Zero' matrix
    foreach ($gen_zero as $kk => $kk1) {
        echo '<tr>';
        foreach ($kk1 as $mm => $mm1) {
            if( $mm1 == 1) {$color2 = 'style="background-color:#66ff66"';}
            else { $color2 = 'style="background-color:#ff3300"';}
            if ($kk == $cor_y && $mm == $cor_x) { $color2 = 'style="background-color:#ffff33"';}
            echo '<td ' . $color2  . '>' . $gen_zero[$kk][$mm] . '</td>';
        }
        echo '</tr> ';
    }
    echo '</table>';
    
// adding to counter of the total grean coordinates
    if($gen_zero[$cor_x][$cor_y]==1) {
        $green_found= $green_found + 1;
    }
    echo '<hr>';
    
// copying the Zero generation
    $gen_prv = $gen_zero;

    // loop depending on the total N of generations. In this loop we take the existing generation, find the neighbor cells of every individual cell, and acording to the 4 rules ...
    //we construct the next generation of the matrix. The functions are defined in the functions.php file
    for ($i = 1 ; $i <= $n ; $i++) {
        echo '<td> Generation ' . $i . '</td>';
        
        foreach ($gen_prv as $k => $k1) {
            $gen_nxt[$k] = [];
            
            foreach ($k1 as $m => $m1) {
                $neigh_sum = 0;                
                $neigh_sum = find_neighbors($gen_prv, $k, $m, $neigh_sum);
                
                $new_val = 0;
                $gen_nxt[$k][$m] = four_rules($gen_prv, $k, $m, $neigh_sum, $new_val);
        
            }
        }
//visualization of the next generation
        echo '<table  border="1">';
        
        foreach ($gen_nxt as $kk => $kk1) {
            echo '<tr>';
            
            foreach ($kk1 as $mm => $mm1) {
// Choosing the apropriate color of the cell
                if( $mm1 == 1) {$color = 'style="background-color:#66ff66"';}
                else { $color = 'style="background-color:#ff3300"';}
                if ($kk == $cor_y && $mm == $cor_x) { $color = 'style="background-color:#ffff33"';}
                
                echo '<td ' . $color  . '>' . $gen_nxt[$kk][$mm] . '</td>';
            } 
            echo '</tr> ';
        }
        echo '</table>';
// adding to the total counter and switching generations
        $gen_prv = $gen_nxt;
        if($gen_nxt[$cor_x][$cor_y]==1) {
            $green_found= $green_found + 1;
        }
        echo '<hr>';
    }
}

//table of information about the game
?>
<table  border="1">
<tr>
<td>Width: <?php echo $x ?> </td>
<td>Height: <?php echo $y ?> </td>
<td>Generations: <?php echo $n ?></td>
<td>Coordinates: X- <?php echo $cor_x ?>/ Y - <?php echo $cor_y ?></td>
<td>Times coordinates are green: <?php echo $green_found ?></td>
</tr>
Width and height starts from 1/generations don't include "Generation Zero"/ the coordinates start from 0
</table>
