<meta http-equiv="refresh" content="3">
<?PHP

interface Paintable {
    function paint();
}

interface Brick{}
interface Panel{}

abstract class HouseAbstract {
    public $model;
    public $square;
    public $floors;

    function __construct ($model, $square, $floors) {
        if (!$model)
            throw new Exception ('Ошибка! Укажите модель');

        $this->model = $model;
        $this->square = $square;
        $this->floors = $floors;
    }

    function startProject () {
        echo "Start. Model {$this->model} <br>";
    }

    function stopProject () {
        echo "Stop. Model {$this->model} <br><br>";
    }

    abstract function build();
}

class SimpleHouse extends HouseAbstract implements Paintable, Brick{
    public $color = "none";

    function build(){
        echo "Build. House: {$this -> square} X {$this -> floors} <br>";
    }

    function paint() {
        echo "Paint. Color : {$this -> color} <br>";
    }
}

$simple = new SimpleHouse("A-100-123", 120, 2);
$simple->color = "red";
$simple->startProject ();
$simple->build ();

if ($simple instanceof Paintable)
    $simple->paint();
$simple -> stopProject ();