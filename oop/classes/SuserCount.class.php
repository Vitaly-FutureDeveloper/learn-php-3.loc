<?

class SuserCount extends SuperUser { //Подсчет супер юзеров
    function showInfo () {
        echo "<br>Всего супер юзеров: " . self::$superCount . "<br>";
    }
}