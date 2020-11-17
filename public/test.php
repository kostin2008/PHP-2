<?php

$x = 1;
$y = 2;

if (add($x, $y) == 3) {
    echo "Add OK";
} else echo "Add False";


function add($x, $y)
{
    return $x + $y;
}