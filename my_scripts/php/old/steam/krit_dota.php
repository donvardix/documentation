<?php
/**
 * Вычисляет примерное количество критов подряд с 6 предметов
 */

echo crit(30, 6);

function crit($chance, $countItem)
{
    $count = 0;
    $step = 1;
    while ($step <= $countItem) {
        if (rand(1, 100) <= $chance) {
            $count++;
            $step = 1;
            continue;
        } else {
            $step++;
        }
    }
    return $count;
}
