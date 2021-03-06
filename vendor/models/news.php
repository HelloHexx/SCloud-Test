<?php
namespace vendor\Model;

// if(include('../db/db.php') == TRUE){
//     ECHO "OK";
// }
// else{
//     echo "db is not load";
// }

class DB
{
    /* Переменные для соединения с базой данных */
    private $hostname = "127.0.0.1";
    private $username = "root";
    private $password = "root";
    private $dbName = "cloud";
    public $mysqli = null;

    public function __construct()
    {
        $this->mysqli = mysqli_connect($this->hostname, $this->username, $this->password, $this->dbName) or die("Не могу создать соединение ");
    }
    public function __destruct() {
        mysqli_close($this->mysqli);
    }

    public function All($table_name)
    {
        $result = array();
        /* создать соединение */
        /* подготавливаемый запрос, первая стадия: подготовка */
        if (!($stmt = mysqli_query($this->mysqli, "SELECT * FROM `$table_name`"))) {
            echo "Не удалось подготовить запрос: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        while ($obj = $stmt->fetch_object()) {
            array_push($result, $obj);
        }
        return $result; //Возвращаем коллекцию
    }
    public function first($table_name, $col, $value)
    {
        /* создать соединение */
        /* подготавливаемый запрос, первая стадия: подготовка */
        if (!($stmt = mysqli_query($this->mysqli, "SELECT * FROM `$table_name` WHERE $col = $value"))) {
            echo "Не удалось подготовить запрос: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        $result = $stmt->fetch_object();
        return $result; //Возвращаем коллекцию
    }
    public function insert($table_name, $params, $data)
    {
        $sql = "INSERT INTO `$table_name` (Title,text,created_at) VALUES (?,?,?)";
        if (!($stmt = $this->mysqli->prepare($sql))) {
            echo "Не удалось подготовить запрос: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        $title = $data->Title;
        $text = $data->Text;
        $time = $data->Time;
        if (!$stmt->bind_param("sss", $title, $text, $time)) {
            echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
        }
        if (!$stmt->execute()) {
            echo "Не удалось выполнить запрос: (" . $stmt->errno . ") " . $stmt->error;
            return false;
        } else {
            return header('Location: /admin');
        }

    }
    public function delete($table_name, $col, $value)
    {
        $sql = "DELETE FROM `$table_name` where `$col` = (?)";
        if (!($stmt = $this->mysqli->prepare($sql))) {
            echo "Не удалось подготовить запрос: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        $id = $value;
        if (!$stmt->bind_param("i", $id)) {
            echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
        }
        if (!$stmt->execute()) {
            echo "Не удалось выполнить запрос: (" . $stmt->errno . ") " . $stmt->error;
            return false;
        } else {
            return header('Location: /admin');
        }

    }
    public function update($table_name,$col,$data){
        $sql = "UPDATE `$table_name` SET Title = ?,text = ?,created_at = ? where id = ? ";
        if (!($stmt = $this->mysqli->prepare($sql))) {
            echo "Не удалось подготовить запрос: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        $title = $data->Title;
        $text = $data->Text;
        $time = date('Y-m-d');
        $id = $data->id;
        if (!$stmt->bind_param("sssi", $title, $text, $time,$id)) {
            echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
        }
        if (!$stmt->execute()) {
            echo "Не удалось выполнить запрос: (" . $stmt->errno . ") " . $stmt->error;
            return false;
        } else {
            return header('Location: /admin');
        }

        
    }
}

// use vendor\DataBase\db as DB;

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

    //Пустой конструктор
    public function __construct()
    {
        $this->DB = new DB();
    }

// Пользовательские конструкторы
    public function All()
    {
        $collect = array();
        $data = $this->DB->All($this->table);
        foreach ($data as $item) {
            array_push($collect, $item);
            # code...
        }
        return $collect;
    }
    public function get_by_id($value)
    {
        $collect = $this->DB->first($this->table, 'id', $value);
        return $collect;

    }
    public function save()
    {
        if($this->id == 0){
        $this->DB->insert($this->table, $this->col, $this);
        }else{
            $this->DB->update($this->table, $this->col, $this);
        }
    }
    public function destroy($id)
    {
        $db = new DB();
        $db->delete('news', 'id', $id);
    }

}
