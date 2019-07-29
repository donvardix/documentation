<?php

function randArray($count, $start, $end)
{
    $arr = [];
    for ($i = 0; $i < $count; $i++) {
        $arr[] = rand($start, $end);
    }
    return $arr;
}

$array = randArray(10, 1, 100);

foreach ($array as $arr){
    echo $arr . '<br>';
}

echo '<hr>';

echo implode(', ', $array);