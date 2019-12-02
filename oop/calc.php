<meta http-equiv="refresh" content="3">
<?php

trait br{

    public $br;

    function __construct ($br) {
        $this->br = $br;
    }
    function br () {
        echo $this->br;
    }
}

//$br = new br('<br><hr>');

class Calcul {
    use br;
    public $num1;
    public $increment;
    public $num2;

    public $rez;

    function __construct($num1, $increment, $num2) {
        $this->num1 = $num1;
        $this->increment = $increment;
        $this->num2 = $num2;
    }

    function result () {
        switch ($this->increment){
            case '+' :
                echo $this->num1 + $this->num2;
                break;

            case '-' :
                echo $this->num1 - $this->num2;
                break;

            case '*' :
                echo $this->num1 * $this->num2;
                break;

            case '/' :
                if($this->num2 != 0)
                    echo $this->num1 / $this->num2;
                else
                    echo "Error! Can't calc '/' to 0";
                
                break;
        }
    }
}

$calc = new Calcul(mt_rand(0, 15), '*', mt_rand(0, 15));
$calc->result();

class Calcul2 extends Calcul {

 

    function result () {
        if ( is_numeric($this->num1) && is_numeric($this->num2) ){
            parent::result();
        }
        else 
            echo "Значения должны быть цифрами";
    }

    function __destruct () {
        $this->br();
        echo "Calc, off!!!";
    }
}

$br->br();
$calc = new Calcul2('160', '*', '80');
$calc->result();