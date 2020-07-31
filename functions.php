<?php
function find_neighbors($gen_prv,$k , $m, $neigh_sum ) {
    if (isset($gen_prv[$k-1][$m-1])) { $neigh_sum+=$gen_prv[$k-1][$m-1];}
    if (isset($gen_prv[$k-1][$m])) { $neigh_sum+=$gen_prv[$k-1][$m];}
    if (isset($gen_prv[$k-1][$m+1])) { $neigh_sum+=$gen_prv[$k-1][$m+1];}
    if (isset($gen_prv[$k][$m-1])) { $neigh_sum+=$gen_prv[$k][$m-1];}
    if (isset($gen_prv[$k][$m+1])) { $neigh_sum+=$gen_prv[$k][$m+1];}
    if (isset($gen_prv[$k+1][$m-1])) { $neigh_sum+=$gen_prv[$k+1][$m-1];}
    if (isset($gen_prv[$k+1][$m])) { $neigh_sum+=$gen_prv[$k+1][$m];}
    if (isset($gen_prv[$k+1][$m+1])) { $neigh_sum+=$gen_prv[$k+1][$m+1];}
    return $neigh_sum;
}

function four_rules($gen_prv, $k , $m , $neigh_sum, $new_val){
    if ($gen_prv[$k][$m] == 0 &&  ($neigh_sum ==3 || $neigh_sum == 6)) { $new_val = 1; }
    if ($gen_prv[$k][$m] == 0 &&  ($neigh_sum <3 || $neigh_sum == 4 || $neigh_sum == 5 || $neigh_sum > 6)) { $new_val = 0; }
    if ($gen_prv[$k][$m] == 1 &&  ($neigh_sum ==2 || $neigh_sum ==3 || $neigh_sum == 6)) { $new_val = 1; }
    if ($gen_prv[$k][$m] == 1 &&  ($neigh_sum <2 || $neigh_sum == 4 || $neigh_sum == 5 || $neigh_sum > 6)) { $new_val = 0; }
    return $new_val;
}