<meta http-equiv="refresh" content="3">
<?php
class ConstructionCompany{
    const NAME = "Коровы и козы";

    function printName() {
        echo self::NAME;
        echo "<br>";
    }
}

echo ConstructionCompany :: NAME;

$company = new ConstructionCompany();
$company -> printName();

class Worker {
    public $name;
    public static $workerCount = 0;

    function __construct ($name) {
        if(!$name)
            throw new Exception ("ОШИБКА!!! УКАЖИТЕ ИМЯ РАБА!!!");

        $this->name = $name;
        ++self::$workerCount;
    }

    static function wellcome() {
        echo "Добро пожаловать! Вас уже " . self::$workerCount . "<br>";
    }
}

$w1 = new Worker("Genry Stuart");
$w2 = new Worker("Дурак Дуракович");
Worker :: wellcome();
echo "Текущее кол-во рабов: " . Worker::$workerCount . "<br>";