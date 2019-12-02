<?

class userCount extends User { //Подсчет простых рабов
    function showInfo () {
        echo "<br>Всего простых рабов: " . self::$count . "<br>";
    }
}