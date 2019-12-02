<meta http-equiv="refresh" content="3">
<?
//Задание первичного SimpleHouse
class SimpleHouse {

    public $model;
    public $square = 0;
    public $floors = 0;
    public $color = "none";

    function __construct($model, $square=0, $floors=1) {
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

    function build () {
        echo "Build. House: " . $this->square . " X " . $this->floors . " <br>"; 
    }

    function paint() {
        echo "Paint. Color {$this->color} <br><br>";
    }
}

//Задание вторичного superHouse от SimpleHouse
class SuperHouse extends SimpleHouse{
    public $fireplace = true; //камин
    public $patio = true; //внутренний дворик

    function fire(){
        if($this->fireplace){
            echo "Fueled fireplace<br>";}
    }
}

//Ещё 1 класс-наследник FubricHouse от SimpleHouse
class FubricHouse extends SimpleHouse {
    function build () {
        echo "Build. Fubric: " . $this->square . " X " . $this->floors . " <br>"; 
    }
}
//От последнего наследник
class SuperFubricHouse extends FubricHouse {
    function build () {
        echo "============================================= <br>"; 
        parent :: build();
        echo "============================================= <br>"; 
    }
}


//Использование первичного SimpleHouse
$simple = new SimpleHouse("A-100-123", 120, 2);
$simple->color = "red";
$simple->startProject();
$simple -> build();
$simple -> paint();
$simple -> stopProject();

//Использование вторичного superHouse от SimpleHouse
$super = new SuperHouse("A-100-125", 320, 3);
$super -> color = "yellow";
$super -> startProject();
$super -> build();
$super -> paint();
$super -> fire();
$super -> stopProject();

//Использование ещё 1 класс-наследник FubricHouse от SimpleHouse
$fubric = new FubricHouse("B-200-007", 3250, 5);
$fubric -> color = "blue";
$fubric -> startProject();
$fubric -> build();
$fubric -> paint();
$fubric -> stopProject();

//От последнего наследник
$super_fubric = new SuperFubricHouse("C-201-034", 5150, 7);
$super_fubric->color = "green";
$super_fubric -> startProject();
$super_fubric -> build();
$super_fubric -> paint();
$super_fubric -> stopProject();