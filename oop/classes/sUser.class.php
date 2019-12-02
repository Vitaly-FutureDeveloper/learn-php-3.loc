<?

class sUser extends User { // изменяем деструктор
    function __destruct() {
        parent::__destruct();
        echo "<br>";
    }
}