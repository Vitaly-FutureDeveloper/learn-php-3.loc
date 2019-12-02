<?

class SuperUser extends User implements ISuperUser {
    public $role;
    public static $superCount = 0;

    function __construct ($name, $login, $password, $role) {
        parent::__construct($name, $login, $password);
        $this->role = $role;
        ++self::$superCount;
    }

    function showInfo () {
        echo $this->role . " ";
        parent::showInfo();
    }

    function getInfo () {
        foreach(get_class_vars(__CLASS__) as $key => $arr) {
            $arrs[$key] = $this->$key;
        }
        echo "<pre>";
        print_r($arrs);
        echo "</pre>";
    }

    static function userCounter () {
        echo "Всего SUPER юзеров: " . self::$superCount . "<br>";
    }

    function __destruct(){
        echo "<h2>{$this->login} удалён из базы</h2>";
    }
}