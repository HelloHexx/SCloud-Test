# SCloud-Test
## Описание
---
Тестовое задание для SCloud
## Описание классов vendor по namespace
---
1. Compact
- - Class Compact
2. Models
- - Class News
- - Class DB
<section id="compact"></section>

### Compact
>Клас для работы с выводом страниц. Имеет переменную для работы внутри html-php документов(Псевдо шаблонизатор)

```php
class Compact{
    public $_GLOBAL = NULL; //Глобальная переменная
    public function view($view,$data){
        //Возвращает страницу
        return require VIEW . $view.'.php'; 
    }
}
```
***
### Models
>Класс для работы с БД и коллекциями.<br>
>(UPD. FEATURE Коллекция не полностью в работе)<br>
>>DB - пользовательский клас обработчик SQL запросов.
```php
class DB
{
    /* Переменные для соединения с базой данных */
    private $hostname = "/* Адрес хоста БД */";
    private $username = "/* Имя пользователя для подключения к БД*/";
    private $password = "/* Пароль */";
    private $dbName = "/* Имя базы данных */";
    public $mysqli = null;//Переменная коннектор БД

    public function __construct()
    {
        //Инициализация соединения
        $this->mysqli = mysqli_connect($this->hostname, $this->username, $this->password, $this->dbName) or die("Не могу создать соединение ");
    }
    public function __destruct() {
        //Очищение соединения
        mysqli_close($this->mysqli);
    }

    public function All($table_name){
        //Получени массива с объектами из таблицы
    }
    public function first($table_name, $col, $value){
        //Получение единичного объекта
    }
    public function insert($table_name, $params,$data){
        //Метод INSERT. Добавление в базу данных записи
    }
    public function delete($table_name, $col, $value){
        //Удаление из базы данных записи.
    }
    public function update($table_name,$col,$data){ 
        //Обновление записи
    }
}
```
>>News - класс для работы с данными таблицы(Переопределение Obj полученного из запроса БД после fetch_obj)
```php

class News
{
    //Поля класса
    public $id = 0;
    public $Title = null;
    public $Text = null;
    public $Time = null;

    //Приватные поля
    private $table = "news";
    private $DB = null;
    private $col = array("Title", "text", "created_at");

    //конструктор
    public function __construct()
    {
        $this->DB = new DB();
    }

    //Методы
    public function All()
    {
        //Полечение коллекции всех записей в БД. Для получения конекретного числа записей, стоит переписать foreach на for
        $collect = array();
        $data = $this->DB->All($this->table);
        foreach ($data as $item) {
            array_push($collect, $item);
        }
        return $collect;
    }
    public function get_by_id($value)
    {
        //Получение запись с определенным id
        $collect = $this->DB->first($this->table, 'id', $value);
        return $collect;

    }
    public function save()
    {
        //Сохранение данных(INSERT) или обновление(UPDATE)
        if($this->id == 0){
        $this->DB->insert($this->table, $this->col, $this);
        }else{
            $this->DB->update($this->table, $this->col, $this);
        }
    }
    public function destroy($id)
    {
        //Удаление записей
        $db = new DB();
        $db->delete('news', 'id', $id);
    }
}
```
---
## Index.php
>Рутинг проекта
```php
switch ($_SERVER['REQUEST_METHOD']) { //Проверяем тип запроса
    case 'GET':{
            if ($_SERVER['REQUEST_URI'] == '/') { 
                //Главная страница
                $news = new news();
                $compact = new compact;
                $compact->_GLOBAL = $news->all();
                return $compact->view('main', $compact->_GLOBAL);
            } elseif ($_SERVER['REQUEST_URI'] == '/admin') {
                //Административная панель
                $news = new news();
                $compact = new compact;
                $compact->_GLOBAL = $news->all();
                return $compact->view('admin', $compact->_GLOBAL);
            } elseif (stripos($_SERVER['REQUEST_URI'], 'post')) {
                //Просмотр поста по Id`шнику
                $news = new news();
                $compact = new compact();
                $id = intval(preg_replace('/[^0-9]/', '', $_SERVER['REQUEST_URI']));
                $compact->_GLOBAL = $news->get_by_id($id);
                return $compact->view('post', $compact->_GLOBAL);
            }
            //Страница 404
            $compact = new compact();
            $compact->_GLOBAL = $_SERVER['REQUEST_URI'];
            return $compact->view('404', $compact->_GLOBAL);
        }
        //Только пост запросы
    case 'POST':{
            if ($_SERVER['REQUEST_URI'] == '/add_post') {
                //Добавление записей
                $new = new news();
                $new->Title = $_POST['title'];
                $new->Text = $_POST['text'];
                $new->Time = $_POST['date'];
                $new->save();
            } elseif ($_SERVER['REQUEST_URI'] == '/del_post') {
                //Удаление записей
                var_dump($_POST['del']);
                news::destroy($_POST['del']);
            }
            elseif ($_SERVER['REQUEST_URI'] == '/upd_post'){
                //Обновление записей
                $news = new news();
                $new = $news->get_by_id($_POST['upd']);
                $news->id=$new->id;
                if(isset($_POST['title'])){
                    $news->Title = $_POST['title'];
                }
                else{
                    $news->Title=$new->Title;
                }
                if(isset($_POST['text'])){
                    $news->Text = $_POST['text'];

                }else{
                    $news->Text = $new->Text;
                }
                if(isset($_POST['date'])){
                    $news->Time = $_POST['date'];
                }
                else{
                    $news->Time =$news->Time;
                }
                $news->save();
            }

        }

};
```
