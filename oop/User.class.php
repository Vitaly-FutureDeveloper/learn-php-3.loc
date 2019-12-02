<?
class User extends UserAbstract {
    public static $userCount = 0;
    function showInfo(){
        echo "Запущен showInfo";
    }
}