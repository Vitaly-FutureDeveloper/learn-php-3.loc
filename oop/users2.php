<meta http-equiv="refresh" content="3">
<?php

function __autoload($class){
    include $class.'.class.php';
}

class SuperUser implements ISuperUser {
    public $name;
    public $pass;
    public $role;
    public static $superUserCount = 0;

    function __construct ($n, $p, $r) {
        $this->name = $n;
        $this->pass = $p;
        $this->role = $r;

        ++self::$superUserCount;
    }

    function getInfo(){
        //print_r (get_class_vars(__CLASS__));
        foreach(get_class_vars(__CLASS__) as $key => $arr){
            $parr[$key] = "{$this->$key}";
        }
        echo "<pre>";
            print_r($parr);
        echo "</pre>";
        return $parr;
    }
}

$user1 = new SuperUser("Hacker", "12345", "admin");
$user2 = new SuperUser("Vint", "12345", "usver");
/*
$user1 -> name = "Hacker";
$user1 -> pass = "12345";
$user1 -> role = "admin";
$user2 -> name = "Vint";
$user2 -> pass = "12345";
$user2 -> role = "usver";
*/
$user1 -> getInfo();
$user2 -> getInfo();
echo "<br>===============================<br><pre>";
print_r($user1);
print_r($user2);

echo "</pre><br>===============================<br>";

echo "Всего обычных пользователей: " . User :: $userCount . "<br>";
echo "Всего cупер пользователей: " . SuperUser::$superUserCount . "<br>";