<?php

if (!function_exists('prindie')) {
  function prindie(...$var)
  {
    echo '<pre>';
    print_r($var);
    echo '</pre>';
    die;
  }
}

if (!function_exists('salt')) {
  function salt($len = 8)
  {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $len; $i++) {
      $index = rand(0, strlen($characters) - 1);
      $randomString .= $characters[$index];
    }

    return $randomString;
  }
}
