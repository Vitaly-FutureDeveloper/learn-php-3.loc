<meta http-equiv="refresh" content="3">
<?PHP

abstract class HouseAbstract {
    public $model = "";
    public $square; //Площадь
    public $floors; //этажей

    function __construct($model, $square = 0, $floors=1) {
        if(!$model)
            throw new Exception('Ошибка! Укажите модель!');
        
        $this->model = $model;
        $this->square = $square;
        $this->floors = $floors;
    }

    function startProject() {
        echo "Start. Model {$this->model} <br>";
    }
    function stopProject() {
        echo "Stop. Model {$this->model} <br><br>";
    }

    abstract function build();
}

class SimpleHouse extends HouseAbstract {
    public $color = "none";

    function build() {
        echo "Build. House: {$this->square} X {$this->floors} <br>";
    }
    function paint() {
        echo "Paint. Color: {$this->color} <br>";
    }
}

$simple = new SimpleHouse("A-100-123", 120, 2);
$simple->color = 'red';
$simple->startProject();
$simple->build();
$simple->paint();
$simple->stopProject();

class SuperHouse extends SimpleHouse {
    public $fireplace = true;
    public $patio = true;

    function fire() {
        if ($this->fireplace)
            echo "Fueled fireplace <br>";
    }
    function pati() {
        if ($this->patio)
            echo "We have rest street <br>";
    }
}

$super = new SuperHouse("A-100-125", 320, 3);
$super->color = "green";
$super->startProject();
$super->build();
$super->paint();
$super->fire();
$super->pati();
$super->stopProject();

// Создание супер-класса
class FabricHouse extends HouseAbstract {
    function build() {
        echo "Build. Fabric: {$this->square} x {$this->floors}<br>";
    }
}

$fabric = new FabricHouse("B-200-007", 3250, 5);
$fabric->startProject();
$fabric->build();
$fabric->stopProject();

class SuperFabricHouse extends FabricHouse
{
    function build(){
        echo "==================================== <br>";
        parent :: build();
        echo "====================================== <br>";
    }
}

$super_fabric = new SuperFabricHouse("C-201-034", 5150, 7);
$super_fabric -> startProject();
$super_fabric -> build();
$super_fabric -> stopProject();