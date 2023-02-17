<?php
class DB
{
    // создаем свойства класса и присваиваем им значение констант, записанных в файле config.php

    protected $conn = null; /* protected - позволяет обращатся в данному свойству дочерним классам объекта */
    private $_host = HOST;
    private $_dbname = DBNAME;
    private $_user = USER;
    private $_password = PASSWORD;
    private $_error;

    // осуществляет подключение, используя свойства класса

    public function __construct()
    {
        $dsn = "mysql:host=" . $this->_host . ";dbname=" . $this->_dbname . ";charset=utf8";
        try {
            $this->conn = new PDO($dsn, $this->_user, $this->_password);
        } catch (PDOException $e) {
            // $this->conn = null;
            $this->_error = $e->getMessage();
        }
    }

    // метод возвращает ошибку, если подключение не удалось
    public function getMesage()
    {
        return $this->_error;
    }


    public function getMaxLegth($table, $column)
    {
        $stmt = $this->conn->prepare('select COLUMN_NAME, CHARACTER_MAXIMUM_LENGTH from information_schema.columns where table_schema = DATABASE() AND table_name = :table AND COLUMN_NAME = :column');
        $stmt->execute(array('table' => $table, 'column' => $column));
        $column = $stmt->fetch(PDO::FETCH_LAZY);
        return $column['CHARACTER_MAXIMUM_LENGTH'];
    }
}
