<?php

namespace Index;

include(__DIR__ . '\vendor\db\db.php');
define("VIEW","./views/");

use vendor\DataBase\DB;

// ПРостенький рутинг для приведения образа работы приложения к MVC

switch ($_SERVER['REQUEST_METHOD']) { //Проверяем тип запроса
    case 'GET': {
            if ($_SERVER['REQUEST_URI'] == '/') {//Проверяем точку вхождения в приложение
                return require(VIEW.'main.php');//Возвращаем страничку
            } elseif(stripos($_SERVER['REQUEST_URI'], 'post')){
                return require(VIEW.'post.php'); 
            }
            break;
        }




    case 'POST': {
            if ($_SERVER['REQUEST_URI'] = '/getorderbydate') {
                header('Content-Type: application/json');
                $min =$_POST['min'] ;
                $max =$_POST['max'];
                $data = new DB();
                $result = json_encode($data->GetOrderByDate($min,$max), JSON_UNESCAPED_UNICODE);
                echo $result;
            }
            break;
        }
}
?>


