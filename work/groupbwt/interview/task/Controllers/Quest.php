<?php

class Quest
{

static function task1_1($arr){
  $max=$arr[0];
  foreach($arr as $a){
    if($max<$a){
      $max=$a;
    }
  }
  return $max;
}
static function task1_2($arr){
  $max=$arr[0];
  $l=count($arr)-1;
  for($i=1; $i<=$l; $i++){
    if($max<$arr[$i]){
      $max=$arr[$i];
    }
  }
  return $max;
}

static function task2($arr){
  $flag=true;
  while($flag){
    $flag=false;
    $l=count($arr)-2;
    for($i=0; $i<=$l; $i++){
      if($arr[$i]>$arr[$i+1]){
        $temp=$arr[$i];
        $arr[$i]=$arr[$i+1];
        $arr[$i+1]=$temp;
        $flag=true;
      }
    }
  }
  return $arr;
}

static function task4($arr, $search){
  $count=0;
  $l=count($arr)-1;
  while($count<=$l){
    $middle=floor(($count+$l)/2);
    if($arr[$middle]==$search){
      return $middle;
    }elseif($arr[$middle]>$search){
      $l=$middle-1;
    }else{
      $count=$middle+1;
    }
  }
  return 'Совпадений нет.';
}

static function task6_1($str){
  $str_new=$str;
  $l=(strlen($str)-1)/2;
  for($i=0; $i<$l; $i++){
    $temp = $str[$i];
    $str[$i] = $str[$l-$i];
    $str[$l-$i] = $temp;
  }
  return ($str==$str_new) ? $str.' - палиндром' : $str.' - не палиндром';
}

static function task6_2($str){
  $str_low=strtolower($str);
  $str_new=strrev($str_low);
  return ($str_low==$str_new) ? $str.' - палиндром' : $str.' - не палиндром';
}

}

?>
