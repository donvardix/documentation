<?php

class Vector
{

private $x;
private $y;

public function plus($x2, $y2){
  return $x+$x2.', '.$y+$y2;
}

public function minus($x, $y){
  return $x-$x2.', '.$y-$y2;
}

public function ymnoz($x, $y){
  return $x*$x2.', '.$y*$y2;
}

}

?>
