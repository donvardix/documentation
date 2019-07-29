<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ParserController extends Controller
{
    public function index(){
      $init=curl_init('https://www.gismeteo.ua/weather-zaporizhia-5093/');
      curl_setopt($init, CURLOPT_FOLLOWLOCATION, true);
      curl_setopt($init, CURLOPT_RETURNTRANSFER, true);
      $html=curl_exec($init);
      curl_close($init);

      $num1=strpos($html, '<span class="js_value tab-weather__value_l">');
		  $num2=substr($html, $num1);
		  $weather=strip_tags(substr($num2, 0, strpos($num2, '</span>')));

      return view('weather', ['weather'=>$weather]);
    }

}
