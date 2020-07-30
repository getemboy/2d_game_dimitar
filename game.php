<?php
$x = 5;
$y = 8;
$cor_x = 2;
$cor_y = 2;
$n = 6;
$green_found = 0;

$gen_zero = [];
$gen_nxt = [];
for ($row=0 ; $row<$y ; $row++) {
    $gen_zero[$row] = [];
    for ($col=0 ; $col<$x ; $col++) {
        $gen_zero[$row][$col] = rand(0,1);
    }
}
$gen_prv = $gen_zero;

for ($i = 0 ; $i < $n ; $i++) {
    echo PHP_EOL;
foreach ($gen_prv as $k => $k1) {

    $gen_nxt[$k] = [];
    foreach ($k1 as $m => $m1) {
        $neigh_sum = 0;
        if (isset($gen_prv[$k-1][$m-1])) { $neigh_sum+=$gen_prv[$k-1][$m-1];}
        if (isset($gen_prv[$k-1][$m])) { $neigh_sum+=$gen_prv[$k-1][$m];}
        if (isset($gen_prv[$k-1][$m+1])) { $neigh_sum+=$gen_prv[$k-1][$m+1];}
        if (isset($gen_prv[$k][$m-1])) { $neigh_sum+=$gen_prv[$k][$m-1];}
        if (isset($gen_prv[$k][$m+1])) { $neigh_sum+=$gen_prv[$k][$m+1];}
        if (isset($gen_prv[$k+1][$m-1])) { $neigh_sum+=$gen_prv[$k+1][$m-1];}
        if (isset($gen_prv[$k+1][$m])) { $neigh_sum+=$gen_prv[$k+1][$m];}
        if (isset($gen_prv[$k+1][$m+1])) { $neigh_sum+=$gen_prv[$k+1][$m+1];}
        
        if ($gen_prv[$k][$m] == 0 &&  ($neigh_sum ==3 || $neigh_sum == 6)) { $new_val = 1; }
        if ($gen_prv[$k][$m] == 0 &&  ($neigh_sum <3 || $neigh_sum == 4 || $neigh_sum == 5 || $neigh_sum > 6)) { $new_val = 0; }
        if ($gen_prv[$k][$m] == 1 &&  ($neigh_sum ==2 || $neigh_sum ==3 || $neigh_sum == 6)) { $new_val = 1; }
        if ($gen_prv[$k][$m] == 1 &&  ($neigh_sum <2 || $neigh_sum == 4 || $neigh_sum == 5 || $neigh_sum > 6)) { $new_val = 0; }
        $gen_nxt[$k][$m] = $new_val;
        
        //echo $gen_prv[$k][$m];
    }
}
if($gen_nxt[$cor_x][$cor_y]==1) {
    $green_found+=1;
}
    

foreach ($gen_nxt as $kk => $kk1) {
    echo PHP_EOL;
    foreach ($kk1 as $mm => $mm1) {
       echo $gen_nxt[$kk][$mm];
    }}
    
$gen_prv = $gen_nxt;
}

echo PHP_EOL, "found $green_found number of times";
