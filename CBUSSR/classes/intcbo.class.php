<?php

interface intcbo {

    function checkXMLfile(); //проверка на актуальность
    function selector(); //формирует выбор 1 валюты для запроса на сервер
    function cycleOne($idval); //Выцепить 1 запись по ID
    function cycleAll(); //Выцепить все записи

}