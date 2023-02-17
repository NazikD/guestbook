<?php

namespace Guestbook\Classes;

class User extends DB
{
    public $id;
    public $userName;
    public $email;
    public $firstName;
    public $lastName;
    public $password;

    public function save()
    {
        $stmt = $this->conn->prepare('INSERT INTO users(`username`, `email`, `password`, `first_name`, `last_name`) VALUES(:username, :email, :password, :first_name, :last_name)'); // гото  вит SQL зарос при помощи метода класса PDO 

        $stmt->execute(array('username' => $this->userName, 'email' => $this->email, 'password' => $this->password, 'first_name' => $this->firstName, 'last_name' => $this->lastName)); // выполняет подготовленный запрос prepare 

        $this->id = $this->conn->lastInsertId(); // используется функция которая возвращает id последней вставленной записи в таблицу
        return $this->id;
    }

    public function find($id)
    {
        $stmt = $this->conn->prepare('SELECT * FROM user WHERE id = :id');
        $stmt->execute(array('id' => $id));
        $user = $stmt->fetch(\PDO::FETCH_LAZY);
        if (!empty($user)) {
            $this->$id = $id;
            $this->userName = $user->user_name;
            $this->email = $user->email;
            $this->firstName = $user->first_name;
            $this->lastName = $user->last_name;
            return $this;
        }
    }

    public function checkLogin($userName, $password)
    {
        $stmt = $this->conn->prepare('SELECT id FROM users WHERE (username = :username or email = :username) and password =:password');
        $stmt->execute(array('username' => $userName, 'password' => $password));
        $user = $stmt->fetch(\PDO::FETCH_LAZY);
        if (!empty($user)) {
            $this->id = $user->id;
            $this->userName = $user->user_name;
            $this->email = $user->email;
            $this->firstName = $user->first_name;
            $this->lastName = $user->last_name;
            return $this;
        } else {
            return false;
        }
    }



    public function getUserName($userName)
    {
        $stmt = $this->conn->prepare('SELECT');
    }



    public function getEmail($email)
    {
        $stmt = $this->conn->prepare('SELECT email FROM users WHERE email = :email');
        $stmt->execute(array("email" => $email));
        $user = $stmt->fetch(\PDO::FETCH_LAZY);
        if (!empty($user->email)) {
            return $user->email;
        } else {
            return false;
        }
    }
}
