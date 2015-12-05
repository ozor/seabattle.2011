<?php

error_reporting(E_ALL);

set_include_path(implode(PATH_SEPARATOR, array(
    realpath(dirname(__FILE__)),
    realpath(dirname(__FILE__) . '/../inc'),
    realpath(dirname(__FILE__) . '/../lib'),
    realpath(dirname(__FILE__) . '/../tpl'),
    get_include_path(),
)));


// Параметры коннекта к БД
// указать здесь свои параметры соединения

  define('DB_HOST', 'localhost');
  define('DB_NAME', 'seabattle');
  define('DB_USER', 'root');
  define('DB_PASSWORD', '');


  
function __autoload($class_name) {
  include_once(str_replace('_', DIRECTORY_SEPARATOR, $class_name).'.php');
}


// Разбиваем путь в массив
if (!empty ($_SERVER['PATH_INFO'])) {
    $PATH = explode('/', $_SERVER['PATH_INFO']);
    $ID = (int)$PATH[1];
}
else $ID = 0;