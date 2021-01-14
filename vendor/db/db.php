<?php
namespace vendor\DataBase;

class DB
{
    /* Переменные для соединения с базой данных */
    private $hostname = "127.0.0.1";
    private $username = "root";
    private $password = "root";
    private $dbName = "cloud";

    public function Get($table_name)
    {
        /* создать соединение */
        $mysqli = mysqli_connect($this->hostname, $this->username, $this->password, $this->dbName) or die("Не могу создать соединение ");
        /* подготавливаемый запрос, первая стадия: подготовка */
        if (!($stmt = $mysqli->prepare("SELECT * AS _news FROM table(_name)"))) {
            echo "Не удалось подготовить запрос: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        $result = mysqli_fetch_assoc($stmt);

        // /* Выборка результатов запроса */
        // while ($row = mysqli_fetch_row($result)) {
        //     $sales = new Sale(); //Инициализуем класс Sale
        //     $sales->sConstruct(intval($row[0]), $row[1], $row[2], $row[3]);
        //     array_push($list, $sales); //Добавляем в возвращаемую коллекцию
        // }
        // /* Освобождаем используемую память */
        // mysqli_free_result($result);
        return $result; //Возвращаем коллекцию
    }
}
