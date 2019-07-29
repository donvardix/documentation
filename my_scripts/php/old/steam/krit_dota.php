<?php
//Вычисляет примерное количество критов подряд с 6 предметов
$chance = 30; //Процент крита
$while = 0;
$step = 0; //Количество критов подряд
function crit($chance)
{
    if (rand(1, 100) <= $chance) {
        return false;
    } else {
        return true;
    }
}

while ($while < 1) {
    $step++;
    if (crit($chance)) {
        if (crit($chance)) {
            if (crit($chance)) {
                if (crit($chance)) {
                    if (crit($chance)) {
                        if (crit($chance)) {
                            $while = 1;
                        }
                    }
                }
            }
        }
    }
}
echo $step;