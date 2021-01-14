<?php

namespace Index;

// include __DIR__ . '\vendor\db\db.php';
include __DIR__ . '\vendor\models\news.php';
include __DIR__.'\vendor\compact\compact.php';
// use vendor\DataBase\db as DB;
use vendor\Model\news;
use Compact\compact;
// ПРостенький рутинг для приведения образа работы приложения к MVC
switch ($_SERVER['REQUEST_METHOD']) { //Проверяем тип запроса
    case 'GET':{
            if ($_SERVER['REQUEST_URI'] == '/') { //Проверяем точку вхождения в приложение
                $news = new news();
                $compact = new compact;
                $compact->_GLOBAL = $news->all();
                return $compact->view('main',$compact->_GLOBAL);
            } 
            elseif ($_SERVER['REQUEST_URI'] == '/admin'){
                $news = new news();
                $compact = new compact;
                $compact->_GLOBAL = $news->all();
                return $compact->view('admin',$compact->_GLOBAL);
            }
            elseif (stripos($_SERVER['REQUEST_URI'], 'post')) {
                $news = new news();
                $compact = new compact();
                $id = intval(preg_replace('/[^0-9]/', '', $_SERVER['REQUEST_URI']));
                $compact->_GLOBAL = $news->get_by_id($id);
                return $compact->view('post',$compact->_GLOBAL);
            }
            break;
        }
    case 'POST':{
        if($_SERVER['REQUEST_URI']=='/add_post'){
            $new = new news();
            $new->Title = $_POST['title'];
            $new->Text = $_POST['text'];
            $new->Time = $_POST['date'];
            $new->save();
        }
    }
    
};

