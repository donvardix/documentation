<?php

//products(id, name, price)
//tags(id, name)
//products_tags(products_id, tags_id)

$count=(SELECT COUNT(id) FROM products)

for($i=1; $i<=$count; $i++){
  $sql=(SELECT COUNT(tags_id) FROM products_tags WHERE products_id = $i);
  $arr=[];
  if($sql>10){
    $arr[]=$i;
  }
}
