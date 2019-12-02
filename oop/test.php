<meta http-equiv="refresh" content="3">
<?
class Pet {
    public $type = "unknown";
    public $name;

    function __construct($type, $name) {
        $this -> type = $type;
        $this -> name = $name;
    }

    function say ($word) {
        echo $this -> name . " said $word";
        $this -> drawLine();
    }

    function drawLine() {
        echo "<hr>";
    }

    function __destruct() {
        echo "<p>" . $this -> name . " removed</p>";
    }
}

class SuperClass {
    function Name () {
        echo "<p>Вызвана функция " . __FUNCTION__ . " | В классе: " . __CLASS__ 
        . " | Методом: " . __METHOD__ . "</p>";
    }
}

$cat = new Pet ("cat", "Tailsy");
$dog = new Pet("dog", "German");

$obj = new SuperClass;
/*
$cat -> type = "cat";
$cat -> name = "Murzik";

$dog -> type = "dog";
$dog -> name = "Tuzik";
*/
echo gettype($cat);
echo "<br>";
echo is_object($dog);

echo "<br>";echo "<br>";

echo $cat -> type . $cat->name;
echo "<br>";
echo $dog -> type . $dog -> name;
echo "<br>";echo "<br>";

$cat -> say("meay");
$dog -> say ("gav");

echo "<br>";

$obj -> Name();