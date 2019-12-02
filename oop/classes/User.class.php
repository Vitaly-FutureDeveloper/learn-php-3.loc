<?php

class User extends UserAbstract {
    public $name;
    public $login;
    public $password;

    public static $count = 0;

    function __construct ($name, $login, $password) {
        $this->name = $name;
        $this->login = $login;
        $this->password = $password;
        ++self::$count;
    }

    function showInfo () {
        echo $this->name . " ";
        echo $this->login . " ";
        echo $this->password . "<br>";
    }

    static function userCounter () {
        echo "Всего простых юзеров: " . self::$count . "<br>";
        echo print_r(get_class_methods(__CLASS__));
    }

    function __destruct() {
        echo "Пользователь {$this->login} удалён <br>";
    }
}

