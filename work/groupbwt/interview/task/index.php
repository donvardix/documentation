<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php

    require_once 'Controllers/Quest.php';
    //require_once 'Controllers/Vector.php';

    $arr1=[-3,2,4,6,2,4,2,9,12,10];
    $arr2=[-3,-2,-5];

    echo '<h1>Task 1</h1>';
    echo Quest::task1_1($arr2);
    echo '<br>';
    echo Quest::task1_2($arr2);
    echo '<hr>';

    echo '<h1>Task 2</h1>';
    echo '<pre>';
    print_r(Quest::task2($arr1));
    echo '</pre>';
    echo '<hr>';

    echo '<h1>Task 4</h1>';
    print_r(Quest::task4([-2,-1,0,1,2,3], '0'));
    echo '<hr>';

    echo '<h1>Task 6</h1>';
    echo Quest::task6_1('Asddsa');
    echo '<br>';
    echo Quest::task6_2('Asddsa');
    echo '<hr>';

    ?>
  </body>
</html>
